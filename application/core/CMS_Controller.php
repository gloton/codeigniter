<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CMS_Controller extends CI_Controller {
	private $admin_panel;
	
	public function __construct()
	{
		parent::__construct();
		//carga el archivo de configuracion creado por mi, y que esta dentro de la carpta application/config
		$this->load->config('cms');
		
		if ( ! $this->config->item('cms_admin_panel_uri') ) {
			show_error('Configuration error');
		}
		
		//quita la barra de cms_admin_panel_uri para utilizarla en el metodo admin_panel
		$this->admin_panel = trim( substr( $this->config->item( 'cms_admin_panel_uri' ), 0, -1 ) );
	} 

	public function admin_panel() 
	{
		#el primer segmento de la uri seria admin, con lo cual me retornaria true. Con lo cual
		#se determina si estoy trabajando en el frontend o el backend
		echo strtolower( $this->uri->segment( 1 ) ) == $this->admin_panel;
	}

	#esta funcion va a devolver el elemento panel uri?
	public function admin_panel_uri() 
	{
		return $this->config->item('cms_admin_panel_uri');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */