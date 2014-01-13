<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Add_art extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	
		$this->load->database();
		$this->load->library('grocery_CRUD');
	
	}

	public function lst_articulos()
	{
		$crud = new grocery_CRUD();
		 
		$crud->set_theme('datatables');
		//$crud->set_theme('flexigrid');
		 
		//carga los datos de la tabla
		$crud->set_table('employees');
		 
		//se agregara empleado cuando muestre, edite o modifique
		$crud->set_subject('Empleado');
		 
		$crud->set_language('spanish');
		 
		//nombre de las columnas que quiero que se muestren al mostrar todos los registros
		$crud->columns('lastName','firstName','email','jobTitle');
		 
		//quita la columna delete
		$crud->unset_delete();
		 
		//quita la columna edit
		$crud->unset_edit();
	
		//quita la columna view
		$crud->unset_read();
		 
		//quitar agregar registro
		$crud->unset_add();
	
		//quitar boton exportar
		$crud->unset_export();
		 
		//quitar boton imprimir
		$crud->unset_print();
		 
		$crud->add_action('Agregar', '', 'main/action1','ui-icon-plus');
		 
		//nombre de las columnas que aparece al mostrar la pantalla para editar un registro individual
		$crud->fields('lastName','firstName','email','jobTitle');
		 
		//crea el codigo saliente
		$output = $crud->render();
		 
		//funcion que llama a la vista
		$this->_example_output($output);
	}

	function _example_output($output = null)
	{
		$this->load->view('show_art.php',$output);
	}	
}