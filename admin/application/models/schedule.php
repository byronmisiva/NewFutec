<?php
class Schedule extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='schedules';
	}    
	
	function get($id){
		$this->db->where('id',$id);	
		$aux=$this->db->get($this->name);
		return current($aux->result());
	}
	
	function get_by_round($round){
		$this->db->where('round_id',$round);
		$this->db->order_by('position','asc');
		
		$aux=$this->db->get($this->name);
		return $aux->result();
	}
	
	function get_last_position($round){
		$this->db->where('round_id',$round);
		$this->db->order_by('position','desc');
		$this->db->limit(1);
		
		$aux=$this->db->get($this->name)->result();
		
		if($aux==false)
			return 0;
		else
			return current($aux)->position;	
	}
	
	function delete($id){
    	$item=$this->get($id);
    	$this->reorder_positions($item->position,$item->round_id);
    	$this->db->delete($this->name,array('id'=>$id));
    	return $item;
    }
    
    function reorder_positions($position,$round){
    	$this->db->where('position >',$position);
    	$this->db->where('round_id',$round);
    	$this->db->set('position', 'position-1', FALSE);
    	$this->db->update($this->name);
    }
    
}
?>