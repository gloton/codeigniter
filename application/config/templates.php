<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//define el uri del admin
$config['templates']['front']['default'] =	array(	
													'regions'	=>	array(	
																			'header' , 'main_menu' , 'sidebar' , 'footer'
																	),
													'scripts'	=>	array(	
																			array('type' => 'base', 'value' => 'libraries/jquery/jquery-1.10.2.min'),
																			array('type' => 'base', 'value' => 'bootstrap/v3/bootstrap.min')
																	),
													'styles'	=>	array(
																			array('type' => 'base', 'value' => 'bootstrap/v3/css/bootstrap.min'),
																			array('type' => 'template', 'value' => 'custom')
																	)
											);

											

$config['templates']['admin']['default'] =	array(	
													'regions'	=>	array(	
																			'header' , 'main_menu' , 'sidebar' , 'footer'
																	)
											);

/* End of file templates.php */
/* Location: ./application/config/templates.php */