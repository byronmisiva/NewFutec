<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active menu
|--------------------------------------------------------------------------
|
| The $menu['active_menu'] setting lets you choose which menu 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$menu['active_menu'] = 'default';

/*
|--------------------------------------------------------------------------
| Explaination of menu group variables
|--------------------------------------------------------------------------
|
| ['source'] The source of your menu, There are three diferent types of sources to a 
|	menu (list,database,xml). If the source is database the variable "table" was filled   
|   with the tablename that whe use to generate the menu.
| ['table']  
|   
|   
| ['xml_file'] 
|   
|   
| ['javascript'] FALSE (default) 
|   
| ['css'] 
|   
|
| Example:
| $menu['default']['source'] = 'list';
| $menu['default']['items'] = array(
|    'option1' => array(
|       'submenu1' => array(
|			'submenu1_1' => 'link11',
|			'submenu1_2' => 'link12'
|			),
|       'submenu2' => 'link2',
|       'submenu3' => 'link3',
|    ),
|	 'option2' => 'masterlink2'
| );
|
*/

/*
|--------------------------------------------------------------------------
| Default Menu Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$menu['default']['source'] = 'list';
$menu['default']['items'] = array(
	'Inicio Administrador' => 'admin',
	'Agregar Noticia' => 'stories/insert',
    'Mas Visitadas' => 'stories/visited',
	  
	'Noticias' => array(
	       'Listado' => 'stories',
	       'Agregar' => 'stories/insert',
	       'Categorias' => 'categories',
		   'Blogs'		=> 'blogs',
		   'Boletines' => 'newsletters',
		   'Listas de Twitter' => 'twitts/get_lists'
	    ),
	'Encuestas' => array(
	       'Listado' => 'surveys',
	       'Agregar' => 'surveys/insert'
	    ),
	'Imagenes' => array(
	       'Listado' => 'images',
	       'Agregar' => 'images/insert',
	       'Galerias' => 'galleries'
	    ),
	'Secciones' => array(
	       'Listado' => 'sections',
	       'Agregar' => 'sections/insert',
	       'Headers' => 'headers',
	       'Modulos' => 'modules',
	    ),
    'Equipos' => array(
	       'Listado' => 'teams',
	       'Agregar' => 'teams/insert',
	       'Jugadores' => 'players',
	       'Estadios' => 'stadiums',
	    	'Arbitros' => 'referee'
	    ),
	'Campeonatos' => array(
	       	'Listado' => 'championships',
	       	'Agregar' => 'championships/insert'
	    ),
	'Usuarios' => array(
	       	'Listado' => 'users',
	       	'Agregar' => 'users/add',
	       	'Roles' => 'roles',
	    	'Recursos' => 'resources',
	    	'Reglas' => 'rules',
	    )
	);
$menu['default']['css'] = 'menu_admin';

/* End of file menu.php */
/* Location: ./system/application/config/menu.php */