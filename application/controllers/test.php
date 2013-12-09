<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
	
	public function metodo2() {
		$this->load->database();
		
		/* 
		echo '<pre>';
		>>>>Para obtener todas las filas
		print_r($this->db->get('test')->result());
		echo '</pre>';
		imprime
		Array
		(
		    [0] => stdClass Object
		        (
		            [id] => 1
		            [nombre] => nombre 1
		            [direccion] => direccion 1
		        )
		
		    [1] => stdClass Object
		        (
		            [id] => 2
		            [nombre] => nombre2
		            [direccion] => 
		        )
		
		)

		 */
		/*
		echo '<pre>';
		>>>>Para obtener solo un campo
		print_r($this->db->select('nombre')->get('test')->result());
		echo '</pre>';
		imprime
		Array
		(
				[0] => stdClass Object
				(
						[nombre] => nombre 1
				)
		
				[1] => stdClass Object
				(
						[nombre] => nombre2
				)
		
		)
		*/
		echo '<pre>';
		//para obtener varios campos los tengo que indicar en un array
		print_r($this->db->select(array('id','direccion'))->get('test')->result());
		echo '</pre>';
		return;
		$this->load->view('test/test');
		$this->load->view('test/test');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */