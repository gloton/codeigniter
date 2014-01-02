<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        $this->load->database();
        $this->load->library('grocery_CRUD');
 
    }
 
    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }
    
    public function employees()
    {
    	$crud = new grocery_CRUD();
    	
    	//se agregara empleado cuando muestre, edite o modifique
    	$crud->set_subject('Empleado');
    	
    	//carga los datos de la tabla
    	$crud->set_table('employees');
    	
    	//crea el codigo saliente
    	$output = $crud->render();
    	
    	//funcion que llama a la vista
    	$this->_example_output($output);
    }
    
    function _example_output($output = null)
    
    {
    	$this->load->view('our_template.php',$output);
    }    
         
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */