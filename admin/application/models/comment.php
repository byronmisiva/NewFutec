<?php
class Comment extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='comments';
	}    

    function get($id){
    	$this->db->where('id',$id);
		return current($this->db->get($this->name)->result());
    }
    
    function get_all_by_story($story,$num=30){
    	if($num>0)
    		$this->db->limit($num);
    	
    	$this->db->select('c.*,u.nick as username,u.description');
    	$this->db->from($this->name." c,users u");
    	$this->db->where('c.user_id','u.id',FALSE);
    	$this->db->where('c.story_id',$story);
    	$this->db->where('c.aproved',1);
    	$this->db->order_by('c.id','desc');
    	return $this->db->get()->result();
    }
    
    function count_all($story){
    	$this->db->select('id');
    	$this->db->from($this->name);
    	$this->db->where('story_id',$story,FALSE);
    	$this->db->where('aproved',1);
    	$query=$this->db->get();
    	return $query->num_rows();
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->select("c.*,UNIX_TIMESTAMP(c.created) as timestamp,u.nick");
		$this->db->from("users u");
		$this->db->where('c.user_id','u.id',FALSE);
		$this->db->order_by("c.created", "desc"); 
		$aux=$this->db->get($this->name.' c',$config['per_page'], $page);
		
		//echo $this->db->last_query();
		return $aux;
    }
    
	function get_limit($limit){
		$this->db->select('s.title,c.*');
		$this->db->from('comments c,stories s');
		$this->db->where('c.story_id','s.id',FALSE);
    	$this->db->order_by("c.created", "desc");
    	$this->db->where('c.aproved',0);
    	$this->db->limit($limit);
    	
    	$aux=$this->db->get();
    	
    	//echo $this->db->last_query();
    	return $aux;
    }
    
	function get_aproved($page=0,$aproved=TRUE){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
   
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->select("c.*,UNIX_TIMESTAMP(c.created) as timestamp,u.nick,s.title");
		$this->db->from('stories s,users u');
		$this->db->where('c.story_id','s.id',FALSE);
		$this->db->where('c.user_id','u.id',FALSE);
		$this->db->order_by("c.created", "desc"); 
		if($aproved)
			$this->db->where('c.aproved',1);
		else
			$this->db->where('c.aproved',0);
			
		$aux=$this->db->get($this->name.' c',$config['per_page'], $page);
		
		//echo $this->db->last_query();
		
		return $aux;
    }
    
    function insert($data){
    	
    }
    
    function update($data){
    	
    }
    
    function delete($id){
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return true;
    }
    
    function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc");
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Equipo...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_num_no_aprov(){
    	$res=$this->db->query('Select count(id) as c
    					 	  from comments
    					      where aproved=0')->result();
    	return $res[0]->c;
    }

	function get_by_user($user){
		$this->db->select("c.*,s.title,s.id as sid");
		$this->db->from("comments c,stories s");
		$this->db->where('s.id','c.story_id',FALSE);
		$this->db->where("c.user_id",$user);
		$this->db->order_by("c.created",'desc');
		$this->db->limit(10);
		$aux=$this->db->get();
		return $aux->result();
	}
	
	function set_aprove($id,$value){
		$this->db->where( 'id',$id);
		$this->db->set('aproved',$value);
		$this->db->update($this->name);
	}
}
?>