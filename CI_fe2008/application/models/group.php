<?php
class Group extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->model('championship');
        $this->load->library('pagination');
    	$this->name='groups';
	}    

    function get($id){
    	$this->db->where( 'id',$id);
		return $this->db->get($this->name);
    }
    
    function get_full($id){
    	$aux=current($this->get($id)->result());
    	$this->db->select('c.id as cid,r.id as rid');
    	$this->db->from('groups g,rounds r,championships c');
    	$this->db->where('g.round_id','r.id',FALSE);
    	$this->db->where('r.championship_id','c.id',FALSE);
    	$this->db->where('g.id',$aux->id);
    	$result=current($this->db->get()->result());
    	$aux->championship_id=$result->cid;
    	$aux->round_id=$result->rid;
    	return $aux;
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
	    $this->db->limit($config['per_page'], $page);
		return $this->db->get();
    }
    
    function insert($data){
    	
    }
    
    function update($data){
    	
    }
    
    function delete($id){
    	$this->db->where('id', $id);
    	$item=current($this->db->get($this->name)->result());
    	
    	$this->db->where('id', $id);
        $this->db->delete($this->name); 
		return $item;
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
    
    function get_champ($group_id){
    	
    	$this->db->select('rounds.championship_id');
    	$this->db->from('groups');
		$this->db->join('rounds', 'groups.round_id = rounds.id');
		$this->db->where('groups.id',$group_id);
		$result = current($this->db->get()->result());
		
    	if($result != FALSE)
			return $result->championship_id;
    	else
    		return FALSE;
    }
    
    function get_by_round($round){
    	$this->db->select("g.*,r.name as rname");
    	$this->db->from('groups g');
    	$this->db->join('rounds r', 'g.round_id = r.id');
    	$this->db->where('g.round_id',$round);
    	$this->db->order_by("g.name",'asc');
    	return $this->db->get()->result();
    }
    
    function get_by_champ($champ){
    	$championship=current($this->championship->get($champ)->result());
    	return $this->get_by_round($championship->active_round);
    }
    
    function get_active_groups(){
    	$this->db->select("g.id,c.name");
    	$this->db->from("groups g,rounds r,championships c");
    	$this->db->where("g.round_id","r.id",FALSE);
    	$this->db->where("r.id","c.active_round",FALSE);
		$this->db->where("c.active_round !=",0);
		$aux=$this->db->get();
		return $aux->result();
    }
}
?>