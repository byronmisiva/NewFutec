<?php
class User extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->name='users';
    }  

    function get($id){
    	
		$aux=$this->db->query('Select *, UNIX_TIMESTAMP(birth) as daten
						  	   From users
						 	   Where id='.$id)->result();
		return current($aux);
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/users/index';
		$config['total_rows']=$this->db->count_all_results('users');
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->select('u.*, t.name as team, r.name as rol');
		$this->db->from('users as u');
		$this->db->join('teams as t', 'u.team_id = t.id','left');
		$this->db->join('roles as r', 'u.role_id = r.id','left');
		$this->db->order_by("u.first_name", "asc");
		$this->db->order_by("u.last_name", "asc");
	    $this->db->limit($config['per_page'], $page);
		return $this->db->get();
    }
    
    function delete($id){
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return true;
    }
    
    function change_pass($id,$new_pass){
        $this->db->update($this->name,array('password' => $new_pass),array('id' => $id)); 
    }
    
    function check_username($username){
    	if($username!=""){
	    	$this->db->where('nick',$username);
	    	$query=$this->db->get($this->name);
	    	if($query->num_rows()>0)
	    		return FALSE;
	    	else
	    		return TRUE;
    	}
    	else
    		return FALSE;
    }
    
    function activate_user($nick,$key){
    	$this->db->where('nick',$nick);
    	$user=current($this->db->get($this->name)->result());
    	
    	if($user->activation_key==$key){
    		$this->db->where('id',$user->id);
    		$this->db->update($this->name, array('active'=>'1'));
    		return TRUE;
    	}
    	return FALSE;
    }
    
    function get_user($str,$type='id'){
    	$this->db->where($type,$str);
    	return current($this->db->get($this->name)->result());
    }
    
    function set_forgot_pass($user,$pass){
    	$this->db->where('id',$user);
    	$this->db->update($this->name,array('description'=>md5($pass))); 
    }
    
    function activate_pass($nick,$key){
    	$this->db->where('nick',$nick);
    	$user=current($this->db->get($this->name)->result());
    	if($user->activation_key==$key){
    		$this->db->where('id',$user->id);
    		$this->db->update($this->name, array('password'=>$user->description,'description'=>'Cambio de clave exitoso.','activation_key'=>sha1(time())));
    		return TRUE;
    	}
    	return FALSE;
    }
    
    function statistics($fechah,$fechaa){
    	return $this->db->query('SELECT count( id ) AS num, UNIX_TIMESTAMP( DATE_FORMAT( created, "%Y-%m-%d" ) ) AS created2
						  		 FROM users
						  		 WHERE DATE_FORMAT( created, "%Y-%m-%d" ) <= "'.$fechah.'"
								   AND DATE_FORMAT( created, "%Y-%m-%d" ) >= "'.$fechaa.'"
								 GROUP BY created2');
    }
    
    function statistics_all(){
    	return $this->db->query('SELECT sum(if( active =1, 1, 0 )) AS s, sum(if( active =0, 1, 0 )) AS n
								 FROM users');
    }
    
	function calcularFecha($fecha,$dias){
	    $fechaComparacion = strtotime($fecha);
	    $calculo= strtotime($dias." days", $fechaComparacion);
	    return(date("Y-m-d", $calculo));
    }
    
    function rate($id,$type){
    	if($type=='+' or $type=='plus' or $type=='add')
    		$this->db->set('points', 'points+1',FALSE);
    	else
    		$this->db->set('points', 'points-1',FALSE);
    	$this->db->where('id',$id);
    	$this->db->update($this->name);
    }
}
?>