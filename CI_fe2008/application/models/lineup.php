<?php
class Lineup extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='lineups';
	}  
	
 	function get($id){
    	$this->db->where( 'id',$id);
		return current($this->db->get($this->name)->result());
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->order_by("created", "desc"); 
		$this->db->order_by("title", "asc");
		return $this->db->get($this->name,$config['per_page'], $page);
    }
    
    function get_lineup($match,$team){
    	
    	$this->db->select('*,l.id as lid,l.position as lposition, l.points as lpoints');
    	$this->db->from('lineups l,players p');
    	$this->db->where('l.player_id','p.id',FALSE);
    	$this->db->where('l.match_id',$match);
    	$this->db->where('l.team_id',$team);
    	$this->db->order_by('l.status','desc');
    	$this->db->order_by('l.position','asc');
    	$this->db->order_by('p.last_name','asc');
    	
    	$aux=$this->db->get();
    	
    	return $aux->result();
    }
    
    function no_exist($data){

    	$this->db->where('match_id',$data['match_id']);
    	$this->db->where('team_id',$data['team_id']);
    	$this->db->where('player_id',$data['player_id']);
    	
    	$aux=$this->db->get($this->name);
    	
    	if($aux->num_rows()==0)
    		return TRUE;
    	else
    		return FALSE;
    }
	
}
?>