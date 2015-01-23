<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cizendacl {
	
	var $CI;
	var $base;
	var $config;
	var $inicialize;
	var $public_functions;
	
	
    function Cizendacl()
    {
    	$this->CI =& get_instance();
    	$this->CI->load->helper('url');
		$this->base=$this->CI->config->config['base_url'];
		include(APPPATH.'config/cizendacl'.EXT);
		$this->public_functions=$public_functions;
        session_start();
		if(isset($data) and $this->inicialize!=1){
			$this->config=$data;
			$this->get_data($this->config);
			//$this->debug($this->config);
			if(is_array($this->config['roles']) and is_array($this->config['resources']) and is_array($this->config['rules'])){
				$this->_inicialize();
				$this->inicialize=1;
			}
			else
				show_error('The config file did not have roles, resources or rules' );
		}
		else
			show_error('The config file did not have configured');
		
		$data=$this->get_current_user();
		$this->CI->template->write_view('user', 'public/user_data', $data, TRUE);
    }
    
    function get_current_user(){
    	$data['user']=$this->CI->session->userdata('username');
    	$data['role']=$this->CI->session->userdata('role');
    	$data['id']=$this->CI->session->userdata('userid');
    	return $data;
    }
    
    function get_data($data){
    	
    	//Get Roles from Database
    	if($this->CI->db->count_all_results($this->config['db_roles'])>0){
    		$query=$this->CI->db->get($this->config['db_roles']);
    		foreach($query->result() as $row){
    			if($row->parent!="NULL")
    				$this->config['roles'][$row->name]=array('id'=>$row->id,'parent'=>$row->parent);
    			else
    				$this->config['roles'][$row->name]=$row->id;
    		}
    	}
    	
    	//Get Resources from Database
    	if($this->CI->db->count_all_results($this->config['db_resources'])>0){
    		$query=$this->CI->db->get($this->config['db_resources']);
    		foreach($query->result() as $row){
    			$this->config['resources'][$row->id]=$row->controller."_".$row->function;
    		}	
    	}
    	
    	//Get Rules from Database
    	if($this->CI->db->count_all_results($this->config['db_rules'])>0){
    		$this->CI->db->order_by('order','asc');
    		$query=$this->CI->db->get($this->config['db_rules']);
    		foreach($query->result() as $row){
    			$this->config['rules'][$this->config['resources'][$row->resource_id]]=array($row->permission,$row->role_id);
    		}	
    	}
    	
    }
    
    function _inicialize(){
    	//Create a new Acl object
        $this->acl = new Zend_Acl();

        /**
         * Add roles and resources. Check Zend's documentation for excellent
         * information on all these.
         * http://framework.zend.com/manual/en/zend.acl.html
         */
        foreach($this->config['roles'] as $key => $value){
        	if(is_array($value))
        		$this->acl->addRole(new Zend_Acl_Role($value['id']),$value['parent']);
        	else
        		$this->acl->addRole(new Zend_Acl_Role($value));
        }

        /**
         * Add some resources
         */
    	foreach($this->config['resources'] as $key => $value){
       		$this->acl->add(new Zend_Acl_Resource($value));
        }
        
        /**
         * Set rules for Acl
         */
        $this->acl->deny();
    	foreach($this->config['rules'] as $key => $value){
       		if(is_array($value)){
       			for($i=1; $i<count($value);$i++){
       				if($value[0]=='Allow')
       					$this->acl->allow($value[$i],$key);
       				else
       					$this->acl->deny($value[$i],$key);
       			}
 			
       		}
        }
    
    }

    function check_acl($controller,$function="index",$redir=TRUE){
    	
    	//Chequeo que la funcion no este dentro de las funciones publicas
    	if(array_search($function,$this->public_functions)===FALSE){
	    	if($function == "")
	    		$function="index";
	    		
	    	if ($this->CI->session->userdata('role')==""){
	            $rol['role'] = $this->config['roles']['Visitantes']['id'];
	            $this->CI->session->set_userdata($rol);
	        }
	        else
	        	$rol['role'] = $this->CI->session->userdata('role');
	        
	    		
	    	$resource= $controller."_".$function;
	      
	    	$mensaje="";
	    	$aproved=FALSE;
	    	
	    	
	    	if ($this->acl->has($resource)){
		    	$mensaje.="Si hay recurso.<br>";
		        if($this->acl->isAllowed($rol['role'],$resource)){
		        	$mensaje.="Si tienes permiso.<br>";
		        	$aproved=TRUE;
		        }
		        else{
		        	$mensaje.="No tienes permiso.<br>";
		        }
		    }
	        else{
	        	$mensaje.="No hay recurso.<br>";
	        }
	    	
	    	if($this->acl->has($controller."_all")){
	    		if($this->acl->isAllowed($rol['role'],$controller."_all")){
			        $mensaje.="Si tienes permiso a todo el controlador.<br>";
			        $aproved=TRUE;
	    		}
			    else{
			    	$mensaje.="No tienes permiso a todo el controlador.<br>";
			    }
	    	}
	
	        //Envio los mensajes de Error de Inicio de session
	        $this->CI->session->set_userdata(array('mensaje'=>$mensaje));
	        if($aproved)
	        	return true;
	        else{
	        	if($redir)
	        		redirect();
	        	return false;
	        }
    	}
    	else
    		return true;
        	
    }
    

    
    function login($user,$pass){
    	$query=$this->CI->db->get_where($this->config['db_users'],array('nick'=>$user,'password'=>$pass,'active'=>1));
    	if($query->num_rows()== 1){
    		$row=current($query->result());
    		$array_items = array('username' => '', 'role' => '','userid'=>'');
    		$this->CI->session->unset_userdata($array_items);
    		$data_to_session = array('userid'=>$row->id,'username'=> $row->nick,'role'=> $row->role_id);
    		$this->CI->session->set_userdata($data_to_session);
    		return TRUE;
    	}
    	return FALSE;
    }
    
    function logout(){
    	$array_items = array('username' => '', 'role' => '','userid'=>'');
    	$this->CI->session->unset_userdata($array_items);
    	$data_to_session = array('userid'=>'0','username'=> 'guest','role'=> $this->config['roles']['Visitantes']['id']);
    	$this->CI->session->set_userdata($data_to_session);
    	redirect();
    }
    
	function logout_movil(){
    	$array_items = array('username' => '', 'role' => '','userid'=>'');
    	$this->CI->session->unset_userdata($array_items);
    	$data_to_session = array('userid'=>'0','username'=> 'guest','role'=> $this->config['roles']['Visitantes']['id']);
    	$this->CI->session->set_userdata($data_to_session);
    	redirect(base_url().'welcome/movil/1');
    }
    
	function logout_blackberry(){
    	$array_items = array('username' => '', 'role' => '','userid'=>'');
    	$this->CI->session->unset_userdata($array_items);
    	$data_to_session = array('userid'=>'0','username'=> 'guest','role'=> $this->config['roles']['Visitantes']['id']);
    	$this->CI->session->set_userdata($data_to_session);
    	redirect(base_url().'welcome/blackberry');
    }
    
    
    function debug($data){
    	echo "<pre>";
    	echo var_dump($data);
    	echo "</pre>";    
    }
    

}
	

// END Cizendacl Class

/* End of file Cizendacl.php */
/* Location: ./system/application/libraries/Cizendacl.php */