<?php
class Twitt extends CI_Model {
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->model('team');
        $this->load->model('player');
        $this->name='twitter_lists';
	}    
	
	function get_lists($element=""){
		if($element != "")
			$this->db->where('element',$element);
		
		$this->db->order_by('element','desc');
		$results=$this->db->get($this->name)->result();
		$data=array();
		foreach($results as $key=>$row){
			$data[$key]=$row;
			$this->db->where('id',$row->element_id);
			$element_name=current($this->db->get($row->element)->result());
			switch($row->element){
				case 'players':
					$data[$key]->element_name=$element_name->first_name.' '.$element_name->last_name;
					break;
						
				case 'teams':
					$data[$key]->element_name=$element_name->name;
					break;
			}
		}
		return $data;
	}
	
	function get_elements($element=""){
		if($element != ""){
			switch($element){
				case 'players':
					$this->db->select("id,CONCAT(first_name, ' ',last_name) as name", FALSE);
					break;
					
				case 'teams':
					$this->db->select("id,name");
					break;
			}
			
			$this->db->where('twitter !=','');
			$this->db->order_by('name','desc');
			$results=$this->db->get($element)->result();
			return $results;
		}
		else
			return FALSE;
	}
	
	function insert($data){
		return $this->db->insert($this->name,$data);
	}
}
?>