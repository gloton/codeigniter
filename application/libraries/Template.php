<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	
	protected $CI;//guarda la instancia de CI_Controller
	private $configs;//guardara las configuraciones echas en config/templates
	private $data;//guardara la data para las vistas
	private $js;
	private $css;
	private $table;//va a guardar el nombre de la tabla de template, por si luego cambiamos el nombre de la tabla (esto lo vamos a utilizar par los querys)
	private $id;//va a guardar el id del template de la plantilla actual
	private $name;//va a guardar el nombre del template de la plantilla actual
	private $default_id; //creo que son para llamar a una plantilla por defecto
	private $default_name;//creo que son para llamar a una plantilla por defecto
	private $message;
	private $panel;
	
	/*======================================*/
	public function __construct()
	{
		# & get_instance();
		#en este caso cuando ejecuto el controlador test, es decir:
		#http://desarrollo.local/php/codeigniter/index.php/test
		#$this->CI contendra la clase Test que a su ves hereda la clase CMS_Controller que a su ves hereda la clase CI_Controller
		$this->CI =& get_instance();
		//cargara el archivo (config/templates.php) de configuracion de los templates
		$this->CI->load->config('templates');
		//guarda las configuraciones echas en config/templates
		$this->configs = $this->CI->config->item( 'templates' );
		#$this->data
		# es quien va guardar los datos para la vista
		$this->data = array();
		$this->js = array();
		$this->css = array();
		$this->table = 'templates'; 
		$this->id = null;
		$this->default_id = null;
		$this->default_name = null;
		
		//de aca sabremos si estamos en el backend o frontend
		$this->panel = $this->CI->admin_panel() ? 'b' : 'f';
	} 
	
	/*================ADICIONAR VARIABLES QUE PUEDAN SER USADAS EN EL RENDER (funcion render)======================*/
	public function set(  $key , $value ) 
	{
		if ( ! empty($key)) {
			$this->data[$key] = $value;
		}
	}
	
	/*======================================*/
	public function add_js($type, $value, $charset = null, $defer = null, $async = null)
	{
		$this->_add_asset($type, $value, array('charset' => $charset, 'defer' => $defer, 'async' => $async), 'script');
	}

	/*======================================*/
	public function add_css($type, $value, $media = null)
	{
		$this->_add_asset($type, $value, array('media' => $media), 'style' );
	}
	
	/*==============METODO QUE CARGARA LAS VISTAS========================*/
	public function render( $view = null )
	{
		//obtener ruta del template
		$template = $this->_route();
		
		$routes = array();
		$this->_set_assets();
		echo '<pre>';
		print_r($this->css);
		print_r($this->js);
		echo '</pre>';
		exit();
		/*
		esta funcion tratara a la vista como un arreglo, por lo tanto se puede pasar
		mas de una vista. Cuando solo se solicita una vista, por ejemplo:
		en controllers/test.php $this->template->render('test');
		este if igual crea un array con esa unica vista
		*/
		if (!empty($view)) 
		{
			if (! is_array($view))
			{
				$view = array($view);
			}

			foreach ($view as $file)
			{
				$route = $this->panel == 'b' ? 'admin/' : '';
				#str_replace('admin/', '', $file);
				# busca admin/ en $file y lo remplaza con una cadena vacia
				/*
				busca el nombre del template, si no hay, coloca dafault
				luego busca dentro de esa carpeta "default" una subcarpeta llamada html
				si no la encuentra ir a buscar la vista a la carpeta views
				*/
				/*
				 En la carpeta html iran los archivos que compondran todas las vistas
				 */
				$route .= $this->name . '/html/' . str_replace('admin/', '', $file);
				if (file_exists(APPPATH . "views/templates/{$route}.php")) {
					$routes[] = APPPATH . "views/templates/{$route}.php";
				}
				elseif(file_exists(APPPATH . "views/{$file}.php"))
				{
					$routes[] = APPPATH . "views/{$file}.php";
				}
				else
				{
					show_error('View error');
				}
				
				//para tener disponible la vista la ruta de la administracion
				$this->data['_admin_panel_uri'] = $this->CI->admin_panel_uri();
				//todas las vistas son cargadas aca para que sean cargadas en template.php
				$this->data['_content'] = $routes;
				$this->CI->load->view($template, $this->data);
			}
		}
		
	} 
	
	/*=================RUTA AL TEMPLATE=====================*/
	//metodo que seteara el template por defecto, lo llamo _route porque me devolvera la ruta del template
	private  function _route() 
	{
		$route = 'templates/';
		if (empty($this->name)) {
			$template = 	$this->CI->db->select( array( 'id' , 'name' ) )
							->get_where( $this->table , array('panel'=>$this->panel , 'default'=>1) )
							->row();
			if ( sizeof($template) == 0 || empty($template->name) ) 
			{
				show_error('Template error');
			}
			
			#$template->name
			# es el nombre del campo del registro que se va a traer
			# si no hay ningun $this->name, este asigna el string default a $template->name (en la parte de arriba)
			# y aca asigna $template->name que seria default a $this->name
			$this->name = $template->name;
		}
		
		//si estamos trabajando en la carpeta de administracion el sistema ira a buscar la carpeta admin
		$route .= $this->panel == 'b' ? 'admin/' : '';
		$route .= "{$this->name}/template.php"; 
		
		//JAGL
		//echo $route; //templates/default/template.php
		
		#APPPATH
		# me devuelve la ruta de la carpeta application
		if (!file_exists(APPPATH . "views/{$route}")) {
			show_error('No template found');
		}
		
		return $route; 
	}
	
	/*==============================================*/
	private function _add_asset($type, $value, $options = array(), $asset_type)
	{
		if (! empty($type)) {
			if (is_array($value)) {
				foreach ($value as $val)
				{
					$asset[] = array('type' => $type, 'value' => $val, 'options' => $options);
				}
			}
			else
			{
				//el valor el $value porque no es un arreglo, es decir, es un solo valor asi que no hay para que recorrerlo
				$asset[] = array('type' => $type, 'value' => $value, 'options' => $options);
			}
		}
	
		if ($asset_type == 'script')
		{
			$this->js = array_merge($this->js, $asset);
		}
		elseif($asset_type == 'style')
		{
			$this->css = array_merge($this->css, $asset);
		}
	}
	
	/*====================VA A SETEAR EL HTML FINAL DE LOS SCRIPT ===========================*/
	private function _set_assets()
	{
		if ( ! empty($this->name) ) 
		{
			$panel = $this->panel == 'b' ? 'admin' : 'front';
			
			if (isset($this->configs[$panel][$this->name]['scripts']) && sizeof($this->configs[$panel][$this->name]['scripts']) > 0 ) {
				$scripts = $this->js;
				$this->js = array();
				
				foreach ($this->configs[$panel][$this->name]['scripts'] as $script)
				{
					$this->_add_asset($script['type'], $script['value'], isset($script['options']) ? $script['options'] : array(), 'script');
				}
				//exit();
				
				$this->js = array_merge($this->js, $scripts);
			}
			/*
			if (isset($this->configs[$panel][$this->name]['styles']) && sizeof($this->configs[$panel][$this->name]['styles']) > 0 )
			{
				$styles = $this->css;
				$this->css = array();
			
				foreach ($this->configs[$panel][$this->name]['styles'] as $style)
				{
					$this->_add_asset($style['type'], $style['value'], isset($style['options']) ? $style['options'] : array(), 'style');
				}
			
				$this->css = array_merge($this->css, $styles);
			}
			*/
		}
		
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */