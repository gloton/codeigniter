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
?>
		<p>Just an example to ensure that we get into the function</p>
		<h1>Welcome to the world of Codeigniter</h1>
		<a href="<?php echo base_url() .'index.php/main/employees/'; ?>">Ejemplo echo por mi: employees</a>
<?php     	
        die();
    }
    
    public function employees()
    {
    	$crud = new grocery_CRUD();
    	
    	//carga los datos de la tabla
    	$crud->set_table('employees');
    	
    	//se agregara empleado cuando muestre, edite o modifique
    	$crud->set_subject('Empleado');
    	
    	$crud->unset_delete();
    	
    	$crud->set_language('spanish');
    	
    	//nombre de las columnas que quiero que se muestren al mostrar todos los registros
    	$crud->columns('lastName','firstName','email','jobTitle');
    	
    	//nombre de las columnas que aparece al mostrar la pantalla para editar un registro individual
    	$crud->fields('lastName','firstName','email','jobTitle');
    	
    	//crea el codigo saliente
    	$output = $crud->render();
    	
    	//funcion que llama a la vista
    	$this->_example_output($output);
    }
    
    public function employees2()
    {
    	$crud = new grocery_CRUD();
    	
    	//carga los datos de la tabla
    	$crud->set_table('employees');
    	
    	//se agregara empleado cuando muestre, edite o modifique
    	$crud->set_subject('Empleado');
    	
    	$crud->set_language('spanish');
    	
    	//nombre de las columnas que quiero que se muestren al mostrar todos los registros
    	$crud->columns('lastName','firstName','email','jobTitle');
    	
    	$crud->display_as('lastName','Apellido');
    	
    	//nombre de las columnas que aparece al mostrar la pantalla para editar un registro individual
    	$crud->fields('lastName','firstName','email','jobTitle');
    	
    	//crea el codigo saliente
    	$output = $crud->render();
    	
    	//funcion que llama a la vista
    	$this->_example_output($output);
    }

    public function employees3()
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
    	
    	$crud->add_action('Agregar', '', 'main/action1','ui-icon-plus');
    	
    	//nombre de las columnas que aparece al mostrar la pantalla para editar un registro individual
    	$crud->fields('lastName','firstName','email','jobTitle');
    	
    	//crea el codigo saliente
    	$output = $crud->render();
    	
    	//funcion que llama a la vista
    	$this->_example_output($output);
    }
    
    public function action1($parametro)
    {
    	//echo 'test ';
    	echo $parametro;	
    }
    function _example_output($output = null)
    {
    	$this->load->view('our_template.php',$output);
    }    
         
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */