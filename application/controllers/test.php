<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CMS_Controller {
	/*
	CMS_Controller
	En el constuctor de esta clase se esta cargando la libreria template
	por lo que  
	*/
	public function index()
	{
		echo 'Index test...';
	}
	
	public function metodo2( $var1 , $var2 ) 
	{
		$this->cemplate->set('titulo' , 'Mi titulo');
		$this->cemplate->render('test');
	}

	public function metodo3() 
	{
		
		echo "test1047";
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */