<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = "127.0.0.1";
$db['default']['username'] = "root";
$db['default']['password'] = "";
$db['default']['database'] = "fe2008";

//$db['default']['database'] = "fifaworldcup";
$db['default']['dbdriver'] = "mysql";
$db['default']['dbprefix'] = "";
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = "";
$db['default']['char_set'] = "utf8";
$db['default']['dbcollat'] = "utf8_general_ci";



/* End of file database.php */
/* Location: ./application/config/database.php */