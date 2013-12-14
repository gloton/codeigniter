<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//define el uri del admin
$config['templates']['front']['default'] =	array(	
													'regions'	=>	array(	
																			'header' , 'main_menu' , 'sidebar' , 'footer'
																	),
													'scripts'	=>	array(	
																			array('type' => 'base', 'value' => 'template_script1', 'options' => array('charset' => 'utf-8', 'defer' => TRUE, 'async' => TRUE))
																	),
													'styles'	=>	array(	
																			'header' , 'main_menu' , 'sidebar' , 'footer'
																	)
											);

											

$config['templates']['admin']['default'] =	array(	
													'regions'	=>	array(	
																			'header' , 'main_menu' , 'sidebar' , 'footer'
																	)
											);

/* End of file templates.php */
/* Location: ./application/config/templates.php */