<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CMS_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo 'Index test...';
	}
	
	public function metodo2( $var1 , $var2 ) 
	{
		$this->load->database();
		/*
		$this->db->insert( 
						'templates' , 
						array( 
							'name'			=>	'default',
							'description'	=>	'Template front-end',
							'panel'			=>	'f',
							'default'		=>	1
						)
		);
		*/
		/*
		$this->db->where( 'id' , 2 )->update( 
						'templates', 
						array( 
							'name'			=>	'default',
							'description'	=>	'Template back-end modificado',
							'panel'			=>	'b',
							'default'		=>	1
						)
		);
		*/
		$this->db->where( array( 'id'=>2 ) )->delete( 'templates' );
		echo '<pre>';
		print_r($this->db->get( 'templates' )->result() );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */