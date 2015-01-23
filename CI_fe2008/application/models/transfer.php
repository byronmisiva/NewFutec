<?php
class Transfer extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->model('championship');
	}    

    function get($id){
		return $this->db->query('Select *
		     					 From transfers
		     					 Where id='.$id);
    }
    
    function get_transfers($id,$active){
    	return $this->db->query('Select tr.*, t1.name as tfname, t1.thumb_shield2 as tfms, t2.name as ttname, t2.thumb_shield2 as ttms, p.first_name, p.last_name
    							 From (Select *, if(team_id_to='.$id.',1,2) as ft
    	                  		 	   From transfers
    	                  		 	   Where (team_id_from='.$id.' or team_id_to='.$id.') and round_id='.$active.'
    	                  		 	   Order by ft asc ) as tr
    	                  		 Left Join teams as t1 ON tr.team_id_from=t1.id 
    	                  		 Left Join teams as t2 ON tr.team_id_to=t2.id
    	                  		 Left Join players as p ON tr.player_id=p.id');
    }

    function get_all($champ){
    	$query=$this->championship->get($champ)->row();
    	$active=$query->active_round;
    	return $this->db->query('Select r.*, t1.id as tfid, t1.name as tfname, t2.id as ttid, t2.name as ttname, p.id as pid, p.first_name, p.last_name
    							 From (Select r.*
    	                  		 	   From transfers as r
    	                  		 	   Where r.championship_id='.$champ.' AND r.round_id='.$active.') as r
    	                  		 Left Join teams as t1 ON r.team_id_from=t1.id 
    	                  		 Left Join teams as t2 ON r.team_id_to=t2.id
    	                  		 Left Join players as p ON r.player_id=p.id
    	                  		 Order by ttname, tfname, p.last_name, p.first_name');
    }
    
    function num($champ){
    	$query=$this->championship->get($champ)->row();
    	$active=$query->active_round;
    	$query=$this->db->query('Select count(*) as num
    							 From transfers
    							 where championship_id='.$champ.' AND round_id='.$active)->row();
    	
    	return $query->num;
    }
}
?>