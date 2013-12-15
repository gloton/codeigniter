<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CMS_Controller {
	/*
	CMS_Controller
	En el constuctor de esta clase se esta cargando la libreria template.
	La clase Test, al heredar de CMS_Controller, puede inteactuar con esta labreria.
	Y como en este caso la libreria se llama template, dentro de test puedo hacer referencia a ella
	escribiento $this->template, si en CMS_Controller se ubiera cargado una libreria llamada milibreria,
	la forma de interactuar con ella seria escribiendo $this->milibreria, en resumen, para interactuar
	con la libreria se escribe $this->nombredelibreria
	*/
	public function index()
	{
		echo 'Index test...';
	}
	
	public function metodo2() 
	{
		//$this->template->add_js('template', 'script1', 'utf-8', TRUE, TRUE);
		/*
		1ra forma : llamaria a un solo archivo
		$this->template->add_css('tipo', 'css1', 'print');
		2da forma: llamaria a traves de un array a mas de un archivo
		$this->template->add_css('tipo', array('css1', 'css2') , 'print');
		3ra forma:
		llamaria a mas de un archivo pero repitiendo las llamadas a la misma funcion
		$this->template->add_css('tipo', 'css1', 'print');
		$this->template->add_css('tipo', 'css2', 'print');
		$this->template->add_css('tipo', 'css3');
		*/
		//$this->template->add_css('view', 'css1', 'print');
		//$this->template->add_css('url', 'http://css1.css', 'print');
		#$this->template->set
		# crara una variable titulo en la libreria que permanecera en memoria, ya cuando se ejecute la funcion render, al final de esa funcion llamara a la vista
		# y enviara los datos(variables)
		$this->template->add_message('Testing...');
		$this->template->set('titulo' , 'Mi titulo');
		$this->template->render('test');
	}

	public function metodo3() 
	{
		
		echo "test1047";
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */