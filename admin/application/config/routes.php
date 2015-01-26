<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "welcome";
$route['scaffolding_trigger'] = "scaff";
$route['(:num)'] = 'r/$1';
$route['sitemap\.xml'] = "seos/sitemap";
$route['sitemap_news\.xml'] = "seos/sitemap_news";


//seciones de modulos a manos
$route['contactos'] =  "sections/publica/67";
$route['staff'] =  "sections/publica/68";
$route['marcador-en-vivo'] = "scoreboards/matches_today_open/ExMpLKey123";
$route['calendario-campeonato-ecuatoriano'] = "matches_calendary/publica/49/calendario";

$route['goleadores-campeonato-ecuatoriano-serie-a-2014'] = "goals_positions/publica/49/goleadores";
$route['ultimas-encuestas'] = "surveys/last";
$route['fuera-de-juego'] =  "sections/publica/64";


$route['equipo/aucas'] = "sections/publica/69/Aucas";
$route['equipo/river-ecuador'] = "sections/publica/70/river-ecuador";
$route['equipo/olmedo'] = "sections/publica/21/Olmedo";
$route['equipo/el-nacional'] = "sections/publica/15/El_Nacional";
$route['equipo/universidad-catolica-de-quito'] = "sections/publica/45/Universidad_Católica_de_Quito";
$route['equipo/emelec'] = "sections/publica/18/Emelec";
$route['equipo/liga-de-loja'] = "sections/publica/47/Liga_de_Loja";
$route['equipo/independiente-del-valle'] = "sections/publica/44/Independiente_del_Valle";
$route['equipo/barcelona'] = "sections/publica/23/Barcelona";
$route['equipo/liga-de-quito'] = "sections/publica/14/Liga_de_Quito";
$route['equipo/manta-fc'] = "sections/publica/25/Manta_F.C.";
$route['equipo/deportivo-cuenca'] = "sections/publica/17/Deportivo_Cuenca";
$route['equipo/mushuc-runa'] = "sections/publica/65/Mushuc_Runa";
$route['equipo/deportivo-quito'] = "sections/publica/22/Deportivo_Quito";

$route['eliminatorias'] = "sections/publica/53";
$route['serie-a'] = "sections/publica/29";
$route['serie-b'] = "sections/publica/30";
$route['seleccion-nacional'] = "sections/publica/26";

$route['copa-libertadores'] = "sections/publica/31";
$route['copa-sudamericana'] = "sections/publica/32";
$route['zona-fe'] = "sections/publica/63";
$route['femagazine'] = "sections/publica/58";
$route['revista-fe-magazine'] = "sections/publica/58";
$route['nuestros-embajadores'] = "sections/publica/28";
$route['yo-amo-el-futbol'] = "sections/publica/66";

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */