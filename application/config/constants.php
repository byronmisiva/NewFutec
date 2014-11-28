<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



//Pagination
define('RESULT_PAGE', 24);

//Secciones
define('SECTION_PRIN',3);
define('SECTION_SERIE_A',29);
define('SECTION_SERIE_B',30);
define('SECTION_SELECCION',26); //Section
define('SECTION_LIBERTADORES',31);
define('SECTION_SUDAMERICANA',32);

//Campeonatos
define('SERIE_A',49);
define('SERIE_B',51);
define('MUNDIAL',43);
define('LIBERTADORES',41);
define('SUDAMERICANA',39);

//Futbolecuador
define('CHAMP_DEFAULT',49);
define('REFRESH_VIVO',300); //segundos
define('CACHE_PARTIDOS',3); //minutos
define('CACHE_MENU',60);	//minutos
define('CACHE_MOVIL',5);	//minutos
define('CACHE_DEFAULT',4);	//minutos



//blogs
define('ZONAFE',63); //ZonaFe
define('ZONAFEPOS',1); //ZonaFe

define('LAVOZDELASTRIBUNAS',''); //La voz de las tribunas
define('LAVOZDELASTRIBUNASPOS',14); //La voz de las tribunas

define('LOMASLEIDO',63); //
define('LOMASLEIDOPOS',1); //

define('NUMNEWSSIDE',5); //

define('TOTALNEWSINOPENNEWS',8); //





/* End of file constants.php */
/* Location: ./application/config/constants.php */
