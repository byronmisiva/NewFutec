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
define('RESULT_PAGE', 25);
define('RESULT_PAGE_LITE', 10);
define('TOTALNEWSINOPENNEWS',7); //
define('TOTALNEWSINDONBALON',30); //


//Secciones
define('SECTION_PRIN',3);
define('SECTION_SERIE_A',29);
define('SECTION_SERIE_B',30);

define('SECTION_SELECCION',26); //Section
define('SECTION_LIBERTADORES',31);

define('SECTION_SUDAMERICANA',32);

define('SECTION_AMERICA',71);

define('SECTION_ELIMINATORIAS',71);

//Campeonatos
//define('SERIE_A',59);
define('SERIE_A',65);
define('SERIE_A_TIPOTABLA',"acumulada");

//define('SERIE_B',61);
define('SERIE_B',66);
define('SERIE_B_TIPOTABLA',"acumulada");

define('MUNDIAL',43);
define('MUNDIAL_TIPOTABLA',"simple");

define('LIBERTADORES',67);
define('LIBERTADORES_TIPOTABLA',"simple");

define('SUDAMERICANA',57);
define('SUDAMERICANA_TIPOTABLA',"simple");

define('ELIMINATORIAS',58);
define('ELIMINATORIAS_TIPOTABLA',"simple");

define('AMERICA',56);
define('AMERICA_TIPOTABLA',"simple");


define('URLAMERICA',"copaamerica");



//Futbolecuador
//define('CHAMP_DEFAULT',53);

//define('REFRESH_VIVO',300); //segundos
define('REFRESH_VIVO',60); //segundos
define('CACHE_PARTIDOS',2); //minutos
define('CACHE_MENU',60);	//minutos
define('CACHE_MOVIL',3);	//minutos
define('CACHE_DEFAULT',3);	//minutos

//blogs
define('ZONAFE',63); //ZonaFe
define('ZONAFEPOS',1); //ZonaFe
//blogs


//blogs
define('ZONANUESTROSEMBAJADORES'   ,28); //En el Exterior
define('ZONANUESTROSEMBAJADORESPOS',2); //En el Exterior

//blogs
define('ZONACOPALIBERTADORES'   ,31);
define('ZONACOPALIBERTADORESPOS', null);

define('ZONACOPASUDAMERICANA',32);
define('ZONACOPASUDAMERICANAPOS',null);

define('ZONAELIMINATORIAS',71);
define('ZONAELIMINATORIASPOS',null);

//todo actualizar copa america
define('ZONACOPAAMERICA'   ,71);
define('ZONACOPAAMERICAPOS',null);

//todo actualizar seccion futbol internacion
define('ZONAINTERNACIONAL'   ,66);
define('ZONAINTERNACIONALPOS',2);

define('LAVOZDELASTRIBUNAS',''); //La Voz de las Tribunas
define('LAVOZDELASTRIBUNASPOS',14); //La Voz de las Tribunas

define('LOMASLEIDO',63); //
define('LOMASLEIDOPOS',1); //

define('NUMNEWSSIDE',5); //

/* End of file constants.php */
/* Location: ./application/config/constants.php */

define('FEAPPMAXSECCION',3); //

/* Push Notificactions */
define('PW_AUTH', 'eNYzs32HAKRtn4vatf4ylwEiYItTmp9s/Q+7ppCEoQha1bzYXLx8yVsIpBAG16cH+QiSTKMyuaBCdUbS+efa');
define('PW_APPLICATION', '0E44F-5F59B');
define('PW_APP_MOBILE', '8D581-9CE88');
/* End of file constants.php */
