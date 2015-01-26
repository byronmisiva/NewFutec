<?php
class Gacos_Matches extends CI_Controller {

	function __construct(){
		parent::__construct();	
	}
	
	function insert_matches($matches,$teams,$referees,$gaco_id){
			
		if($this->db->insert('matches', $matches)){
		   	$teams['match_id']=$this->db->insert_id();
		   	$referees['match_id']=$this->db->insert_id();
		   	
		   	$gaco['match_id']=$this->db->insert_id();
		   	$this->db->where( 'id',$gaco_id);
	   		$this->db->update('gaco_matches', $gaco);
	   		
		   	$this->db->insert('matches_teams', $teams);
		   	$this->db->insert('matches_referee', $referees);			
		}
		   	
	}
	
	function update_matches($matches,$teams){
	   	$this->db->where('match_id',$matches['id']);
	   	$this->db->update('matches_teams', $teams);
	}
}
?>