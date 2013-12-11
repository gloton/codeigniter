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
	
	public function __construct()
	{
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
		echo '<pre>';
		print_r($this->panel);
		echo '</pre>';
		exit();
	} 
	
	//seteara la data
	public function set(  $key , $value ) 
	{
		if ( ! empty($key)) {
			$this->data[$key] = $value;
		}
	}
	
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
			$this->name = $template->name;
		}
		
		//si estamos trabajando en la carpeta de administracion el sistema ira a buscar la carpeta admin
		$route .= $this->panel == 'b' ? 'admin/' : '';
		$route .= "{$this->name}/template.php";
	}
}

/* End of file welcome.php */
/* Location: ./application/libraries/Template.php */