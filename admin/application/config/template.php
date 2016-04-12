<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'default';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land. 
|   You may also include default markup, wrappers and attributes here 
|   (though not recommended). Region keys must be translatable into variables 
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We 
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the 
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['default']['template'] = 'templates/admin';
$template['default']['regions'] = array(
    'title',
    'header',
    'menu',
    'content',
    'footer',
    'path',
    'user',
    'alertas'
);
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;

$template['public']['template'] = 'templates/public';
$template['public']['regions'] = array(
    'metatags',
    'title',
    'header',
    'metas',
    'descripcion',
    'menu',
    'content',
    'block_left',
    'block_right',
    'footer',
    'path',
    'rotativas',
    'onload',
    'section'
);
$template['public']['parser'] = 'parser';
$template['public']['parser_method'] = 'parse';
$template['public']['parse_template'] = FALSE;

$template['acceso_admin']['template'] = 'templates/acceso_admin';
$template['acceso_admin']['regions'] = array(
		'metatags',
		'title',
		'header',
		'metas',
		'descripcion',
		'menu',
		'content',
		'block_left',
		'block_right',
		'footer',
		'path',
		'rotativas',
		'onload',
		'section'
);
$template['acceso_admin']['parser'] = 'parser';
$template['acceso_admin']['parser_method'] = 'parse';
$template['acceso_admin']['parse_template'] = FALSE;

$template['public2']['template'] = 'templates/public2';
$template['public2']['regions'] = array(
    'metatags',
    'title',
    'header',
    'metas',
    'descripcion',
    'menu',
    'content',
    'block_left',
    'block_right',
    'footer',
    'path',
    'rotativas',
    'onload',
    'section'
);
$template['public2']['parser'] = 'parser';
$template['public2']['parser_method'] = 'parse';
$template['public2']['parse_template'] = FALSE;


$template['movil']['template'] = 'templates/movil';
$template['movil']['regions'] = array(
    'logo',
    'title',
    'button1',
    'info1',
    'button2',
    'banner1',
    'title1',
    'info2',
    'info3',
    'title2',
    'title3',
    'button3'
);
$template['movil']['parser'] = 'parser';
$template['movil']['parser_method'] = 'parse';
$template['movil']['parse_template'] = FALSE;


$template['blackberry']['template'] = 'templates/blackberry';
$template['blackberry']['regions'] = array(
    'logo',
    'title',
    'info1',
    'title2',
    'info2',
    'banner1',
    'title3',
    'info3',
    'section'
);
$template['blackberry']['parser'] = 'parser';
$template['blackberry']['parser_method'] = 'parse';
$template['blackberry']['parse_template'] = FALSE;

/* End of file template.php */
/* Location: ./system/application/config/template.php */