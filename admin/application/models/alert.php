<?php
class Alert extends CI_Model {
	
	function __construct() {
        parent::__construct();
        $this->load->model('goals_position');
	}    
	
	function get_no_striker_pic(){
		$query=$this->db->query('Select id
								 From championships');
		$i=0;
		foreach($query->result() as $row):
		
			$query=$this->goals_position->get_strikers($row->id);
			if($query->num_rows()>0){
				$res=$query->result();
				if($res[0]->thumb==NULL)
					$i+=1;	
			}
			
		endforeach;	
		
		return $i;
	}
}
?>