<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package CodeIgniter
 * @author  ExpressionEngine Dev Team
 * @copyright  Copyright (c) 2006, EllisLab, Inc.
 * @license http://codeigniter.com/user_guide/license.html
 * @link http://codeigniter.com
 * @since   Version 1.0
 * @filesource
 */

// --------------------------------------------------------------------

/**
 * CodeIgniter Menu Class
 *
 * This class is and interface to CI's View class. It aims to improve the
 * create and use of interactive menues. 
 *
 * @package		CodeIgniter
 * @author		Christian Andrade
 * @subpackage	Libraries
 * @category	Libraries
 * @link		
 * @copyright  	Copyright (c) 2008, Christian Andrade.
 * @version 	0.1
 * 
 * Librerias Necesarias:
 * Javascript: Scriptaculous, effects.js
 * Css: menu.css
 */
class CI_Menu {

	var $CI;
	var $base;
	var $config;
   	var $menu;
   	var $master;
   	var $css;
	
	/**
	 * Constructor
	 *
	 * Loads menu configuration, menu items, and validates existence of 
	 * default menu
	 *
	 * @access	public
	 */
	
	function CI_Menu(){
		$this->CI =& get_instance();
		$this->base=$this->CI->config->config['base_url'];
		include(APPPATH.'config/menu'.EXT);
        if (isset($menu)){
			$this->config = $menu;
			$this->set_menu($menu['active_menu']);
		}
		$this->CI->template->write('menu', $this->build_menu(), TRUE);
	}

// --------------------------------------------------------------------
   
   /**
    * Use given menu settings
    *
    * @access  public
    * @param   string   array key to access template settings
    * @return  void
    */
   
	function set_menu($group){
      if (isset($this->config[$group])){
         $this->menu = $this->config[$group];
      }
      else{
         show_error('The "'. $group .'" menu group does not exist. Provide a valid group name or add the group first.');
      }
      $this->initialize($this->menu);
   }
	
   
// --------------------------------------------------------------------
   
   /**
    * Dynamically add a template and optionally switch to it
    *
    * @access  public
    * @param   string   array key to access template settings
    * @param   array properly formed
    * @return  void
    */
   
	function add_menu ($group, $menu, $activate = FALSE)
   	{
      if ( ! isset($this->config[$group]))
      {
         $this->config[$group] = $menu;
         if ($activate === TRUE)
         {
            $this->initialize($menu);
         }
      }
      else
      {
         show_error('The "'. $group .'" menu group already exists. Use a different group name.');
      }
   }
   
 // --------------------------------------------------------------------
   
   /**
    * Initialize class settings using config settings
    *
    * @access  public
    * @param   array   configuration array
    * @return  void
    */
   
	function initialize($props)
	{

      // Set master template
      if (isset($props['source'])){
         $this->master = $props;
         // Get the info to generate de menu
         switch($props['source']){
	    	//Get items from database
	        case "database":
		        echo "Get menu from database";
		        break;
	    	
		    //Get items from xml file
	        case "xml":
		        echo "Get menu from xml file";
		        break;
         
         }
      }
      else 
      {
         // Master template must exist. Throw error.
         show_error('Either you have not provided a master menu ');
      }
   }
	
	function add_css($file){
		$this->master['css']=$file;
	}
   
   
	function build_menu(){
		$menu_final="<div id='menu' class='".$this->master['css']."'>\n";
		$menu_final.="<ol id='level0'>\n";
		$class="";
		if(!is_array($this->master['items'])){
			return FALSE;
		}
		else{
			foreach($this->master['items'] as $key => $value){		
				if(is_array($value)){
					$menu_final.="<li id='level0'><div id=\"nivel1\" class='nivel1' onclick=\"menu_open2('$key'); return false;\">$key</div>\n";
					$menu_final.="<div id=\"$key\" style=\"display:none; margin-top: 10px; padding-left:15px;\">";
					$menu_final.="<ol id='level1'>";
					foreach($value as $key2 => $value2){
						if(is_array($value2)){
							$menu_final.="<li id='level1'><div id='nivel2' onclick=\"new Effect.BlindDown('$key2'); return false;\" >$key2</div>\n";
							$menu_final.="<div id='$key2' style='display:none; padding-left: 15px;'>";
							foreach($value2 as $key3 => $value3){
								$menu_final .= "\t\t<div id='nivel3'>\n";
								$menu_final .= "\t\t<a $class href='".$this->base."$value3'>$key3</a>\n";
								$menu_final .= "\t\t</div>\n";
							}
							$menu_final.="</div></li>\n";
						}
						else{
							$menu_final.= "\t<li id='level1'><a $class href='".$this->base."$value2'>$key2</a></li>\n";
						}
					}
					$menu_final.="</div></li>\n";
				}
				else{
					$menu_final.= "<li id='level0'><a $class href='".$this->base."$value'>$key</a></li>\n";
				}
			}
			$menu_final.="</div>";
		}
		$menu_final.="</ol>\n</div>";
		return $menu_final;
	}
} 
// END Menu Class

/* End of file Menu.php */
/* Location: ./system/application/libraries/Menu.php */