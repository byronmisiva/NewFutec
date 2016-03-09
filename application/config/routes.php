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
$route['don-balon'] = "site/donbalon";
$route['marcador-en-vivo'] = "site/marcadorenvivo";

$route['copa-libertadores'] = "site/copalibertadores";
$route['copa-sudamericana'] = "site/copasudamericana";

$route['eliminatorias'] = "site/eliminatorias";

$route['copa-america'] = "site/copaamericacentenario";
//$route['copa-america'] = "site/indexcopaamerica";
$route['copaamerica'] = "site/copaamerica";
$route['copa-america-movil'] = "site/copaamericamovil";

$route['futbol-internacional'] = "site/futbolinternacional";

$route['fe-magazine'] = "site/femagazine";
$route['goleadores'] = "site/goleadores";
$route['tabla-de-posiciones'] = "site/tabladeposiciones";
$route['tabladeposiciones/(:num)'] = "site/tabladeposiciones";
$route['tabla-de-posiciones/(:num)'] = "site/tabladeposiciones";
$route['tabla-de-posiciones/(:num)/(:num)'] = "site/tabladeposiciones/$1/$2";
$route['tabla-de-posiciones'] = "site/tabladeposiciones";
$route['tabla-de-posicionesb'] = "site/tabladeposiciones/" . SERIE_B;
$route['resultados'] = "site/resultados";
$route['fuera-de-juego'] = "site/fueradejuego";
$route['juventus'] = "site/juventus";

$route['serie-a'] = "site/seriea";
$route['serie-b'] = "site/serieb";
$route['seleccion'] = "site/seleccion";
$route['fifa-gate'] = "site/fifagate";

$route['sitemap\.xml'] = "seo/sitemap";
$route['sitemap_news\.xml'] = "seo/sitemap_news";

//arreglo pagina anterior
$route['welcome/movil'] = "site/movil";


//revista copa america
$route['tablaposicionescopaamerica'] = "site/tablaposicionesalone/56/simple";
$route['noticiascopaamerica'] = "site/noticiasalone/71";

$route['tablacopaamerica/(:num)/{:any}'] = 'site/tablaposicionesalone/$1/$2';
$route['noticiascopaamerica/(:num)/{:any}'] = 'site/noticiasalone/$1';



//$route['contactos'] =  "sections/publica/67";
//$route['staff'] =  "sections/publica/68";
//$route['fuera-de-juego'] =  "sections/publica/64";
//
//$route['equipo/olmedo'] = "sections/publica/21/Olmedo";
//$route['equipo/universidad-catolica-de-quito'] = "sections/publica/45/Universidad_Católica_de_Quito";
//$route['equipo/liga-de-loja'] = "sections/publica/47/Liga_de_Loja";

$route['equipo/el-nacional'] = "site/equipo/el-nacional/15";
$route['equipo/independiente-del-valle'] = "site/equipo/independiente-del-valle/44";
$route['equipo/barcelona'] = "site/equipo/barcelona-sporting-club/23";
$route['equipo/liga-de-quito'] = "site/equipo/liga-de-quito/14";
$route['equipo/emelec'] = "site/equipo/emelec/18";
$route['equipo/universidad-catolica-de-quito'] = "site/equipo/universidad-catolica-de-quito/45";
$route['equipo/river-ecuador'] = "site/equipo/river-ecuador/70";
$route['equipo/deportivo-cuenca'] = "site/equipo/deportivo-cuenca/17";
$route['equipo/delfin'] = "site/equipo/delfin/74";
$route['equipo/aucas'] = "site/equipo/aucas/69";
$route['equipo/fuerza-amarilla'] = "site/equipo/fuerza-amarilla/75";
$route['equipo/mushuc-runa'] = "site/equipo/mushuc-runa/65";
$route['equipo/manta-fc'] = "site/equipo/manta-fc/79";

$route['equipo/deportivo-quito'] = "site/equipo/deportivo-quito/36";
$route['equipo/seleccion-nacional'] = "site/equipo/seleccion-nacional/5";
$route['seleccion-nacional'] = "site/equipo/seleccion-nacional/5";
$route['calendario-campeonato-ecuatoriano'] = "http://www.futbolecuador.com/site/resultados/";
$route['goleadores-campeonato-ecuatoriano-serie-a-2014'] = "http://www.futbolecuador.com/site/goleadores";


//
//$route['eliminatorias'] = "sections/publica/53";
//$route['serie-a'] = "sections/publica/29";
//$route['serie-b'] = "sections/publica/30";
//$route['seleccion-nacional'] = "sections/publica/26";
//
//$route['copa-libertadores'] = "sections/publica/31";
//$route['copa-sudamericana'] = "sections/publica/32";
//$route['femagazine'] = "sections/publica/58";
//$route['revista-fe-magazine'] = "sections/publica/58";
//$route['en-el-exterior'] = "sections/publica/28";
//
//$route['marcador-en-vivo'] = "scoreboards/matches_today_open/ExMpLKey123";
//$route['calendario-campeonato-ecuatoriano'] = "matches_calendary/publica/49/calendario";
//
//$route['goleadores-campeonato-ecuatoriano-serie-a-2014'] = "goals_positions/publica/49/goleadores";
//$route['ultimas-encuestas'] = "surveys/last";

/* End of file routes.php */
/* Location: ./application/config/routes.php */

