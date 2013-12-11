<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS_Controller extends CI_Controller {
	private $admin_panel;
	
	public function __construct()
	{
		parent::__construct();
		//carga el archivo de configuracion creado por mi, y que esta dentro de la carpta application/config
		$this->load->config('cms');
		
		#el metodo item
		# nos devuelve el valor del elemento que le indiquemos como parametro, en este caso cms_admin_panel_uri, cargado anteriormente mediante $this->load->config('cms');
		if ( ! $this->config->item('cms_admin_panel_uri') ) {
			show_error('Configuration error');
		}
		
		//quita la barra de cms_admin_panel_uri para utilizarla en el metodo admin_panel
		$this->admin_panel = trim( substr( $this->config->item( 'cms_admin_panel_uri' ), 0, -1 ) );
		
		//cargo libreria template, estara disponible para los controladores que extiendan de CMS_Controller
		//si imprimo algo directamente en el archivo libraries/template.php, se imprime en cualquier controlador que extienda de CMS_Controller
		$this->load->library('template');
	} 
	
	# admin_panel
	#esta funcion es la que me indicara donde estamos trabajando. Les va a indicar a los controladores que extiendan del controlador  CMS_Controller si estan trabajando
	#en el backend o frontend
	public function admin_panel() 
	{
		#el primer segmento de la uri seria admin, con lo cual me retornaria true. Con lo cual
		#se determina si estoy trabajando en el frontend o el backend
		return strtolower( $this->uri->segment( 1 ) ) == $this->admin_panel;
	}

	#esta funcion se colocara porsi mas adelante se quiere cambiar el nombre cms_admin_panel_uri desde la configuracion. 
	
	#si quisiera podria llamar directamente al item desde cualquier clase que extienda de CMS_Controller, pero al parecerer en el curso, en vez de acceder al item para obtener 
	#el uri, por ahora configurado como admin/ 
	public function admin_panel_uri() 
	{
		return $this->config->item('cms_admin_panel_uri');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */