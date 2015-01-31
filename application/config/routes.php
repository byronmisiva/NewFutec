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
|	example.com/class/method/id/
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "site/index";
$route['404_override'] = 'site/index';



//seciones de modulos a manos
$route['home'] = "site/home";
$route['zona-fe'] = "site/zonafe";
$route['la-voz-de-las-tribunas'] = "site/lavoz";
$route['lo-mas-leido'] = "site/masleido";
$route['en-el-exterior'] = "site/nuestrosembajadores";

$route['copa-libertadores'] = "site/copalibertadores";
$route['copa-sudamericana'] = "site/copasudamericana";
$route['copa-america'] = "site/copaamerica";

$route['futbol-internacional'] = "site/futbolinternacional";

$route['fe-magazine'] = "site/femagazine";
$route['goleadores'] = "site/goleadores";
$route['tabla-de-posiciones'] = "site/tabladeposiciones";
$route['tabla-de-posicionesb'] = "site/tabladeposiciones/30";
$route['resultados'] = "site/resultados";
$route['fuera-de-juego'] = "site/fueradejuego";

$route['serie-a'] = "site/seriea";
$route['serie-b'] = "site/serieb";
$route['seleccion'] = "site/seleccion";

/*
$route['contactos'] =  "sections/publica/67";
$route['staff'] =  "sections/publica/68";
$route['fuera-de-juego'] =  "sections/publica/64";

$route['equipo/olmedo'] = "sections/publica/21/Olmedo";
$route['equipo/el-nacional'] = "sections/publica/15/El_Nacional";
$route['equipo/universidad-catolica-de-quito'] = "sections/publica/45/Universidad_Católica_de_Quito";
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
$route['femagazine'] = "sections/publica/58";
$route['revista-fe-magazine'] = "sections/publica/58";
$route['en-el-exterior'] = "sections/publica/28";

$route['marcador-en-vivo'] = "scoreboards/matches_today_open/ExMpLKey123";
$route['calendario-campeonato-ecuatoriano'] = "matches_calendary/publica/49/calendario";

$route['goleadores-campeonato-ecuatoriano-serie-a-2014'] = "goals_positions/publica/49/goleadores";
$route['ultimas-encuestas'] = "surveys/last";

/* End of file routes.php */
/* Location: ./application/config/routes.php */

