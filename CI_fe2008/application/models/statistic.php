<?php
class Statistic extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
	}  
	
	function sum($data){
		
		$query=$this->db->query('Select * From statistics Where name="'.$data['name'].'"');
		
		if($query->num_rows()==0){
			$this->db->insert('statistics',$data);
			$last=$this->db->insert_id();
		}
		else{
			$q=$query->result();
			$data['views']=$q[0]->views+1;
			$this->db->where('name',$q[0]->name);
			$this->db->update('statistics',$data);
			$last=$q[0]->id;
		}
		
		$query=$this->db->query('Select * From statistics_days Where statistic_id='.$last.' AND date="'.mdate('%Y-%m-%d',time()).'"');
		
		unset($data['name']);
		$data['statistic_id']=$last;
		$data['views']=1;
		if($query->num_rows()==0){
			$data['date']=mdate('%Y-%m-%d',time());
			$this->db->insert('statistics_days',$data);
		}
		else{
			$q=$query->result();
			$data['views']=$q[0]->views+1;
			$this->db->where('id',$q[0]->id);
			$this->db->update('statistics_days',$data);
		}	
	}
	
	function get_statistic(){	
		return $this->db->query('Select * 
						  		 From statistics
						  		 Order by name'); 		
	}
	
	function get_statistic_days($id,$fechah,$fechaa){
		return $this->db->query('Select *
								 From statistics_days
								 Where date<="'.$fechah.'" AND date>="'.$fechaa.'" AND statistic_id='.$id.'
								 Order by date asc');
	}
	
	function calcularFecha($fecha,$dias){
	    $fechaComparacion = strtotime($fecha);
	    $calculo= strtotime($dias." days", $fechaComparacion);
	    return(date("Y-m-d", $calculo));
    }
}
?>