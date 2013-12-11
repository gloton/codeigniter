<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CMS_Controller {

	public function index()
	{
		echo 'Index test...';
	}
	
	public function metodo2( $var1 , $var2 ) 
	{
		
		/*
		echo '<pre>';
		print_r($this->db->get( 'templates' )->result() );
		*/ 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */