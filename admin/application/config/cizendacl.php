<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//Append Zend's folder in PHP's include path
set_include_path(get_include_path() . PATH_SEPARATOR .  "./application/custom/");

//show_error(get_include_path());
//Load the Acl class

require_once 'Zend/Acl.php';
require_once 'Zend/Acl/Role.php';
require_once 'Zend/Acl/Resource.php';

$data['db_users'] = 'users';
$data['db_roles'] = 'roles';
$data['db_resources'] = 'resources';
$data['db_rules'] = 'rules';


// Funciones publicas que no seran chequeadas por el ACL
$public_functions=array('publica','movil','wap');

/*
$data['roles'] = array('1','2','3','4');

$data['resources'] = array('users_profile','users_login');

$data['rules'] = array('users_login'=>array('allow','1'));
*/
/* End of file cizendacl.php */
/* Location: ./system/application/config/cizendacl.php */