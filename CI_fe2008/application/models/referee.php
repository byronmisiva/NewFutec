<?php
class Referee extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='referee';
	}
	
	function get($id){
		if($id>0){
			$this->db->where('id',$id);
			$result=current($this->db->get($this->name)->result());
		}
		else
			return false;
	}
	
	function get_by_match($match){
		$this->db->where('match_id',$match);
		$referees=current($this->db->get('matches_referee')->result());
		$arbitros=array(0 => (object)array('id'=>''), 1 => (object)array('id'=>''), 2 => (object)array('id'=>''), 3 => (object)array('id'=>''));
		
		if($referees != false){
			if($referees->referee_id_central)
				$arbitros[0]=$this->get($referees->referee_id_central);
			if($referees->referee_id_line1)
				$arbitros[1]=$this->get($referees->referee_id_line1);
			if($referees->referee_id_line2)
				$arbitros[2]=$this->get($referees->referee_id_line2);
			if($referees->referee_id_sub)
				$arbitros[3]=$this->get($referees->referee_id_sub);
		}
		
		return $arbitros;
	}
    
    function get_list(){

    	$this->db->select('id, first_name,last_name');
    	$this->db->order_by("last_name", "asc");
    	$this->db->order_by("first_name", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Arbitro...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->last_name.' '.$row->first_name;
    	}
    	return $aux;
    }
	
}
?>