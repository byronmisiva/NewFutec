<?php
class Player extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='players';
	}  
	
	function get_players(){
		$query=$this->db->query('Select p.*
								 From players as p
								 Order By p.last_name asc, p.first_name asc');
		return $query;
	}
	
	function get_player($like){
    	$query=$this->db->query('Select *
    							 From players
    							 WHERE last_name LIKE "%'.$like.'%" or first_name LIKE "%'.$like.'%" or nick LIKE "%'.$like.'%"
    							 ORDER BY last_name asc, first_name asc');
    	$output='<ul><li>No Existen Resultados</li></ul>';
    	if($query->num_rows()>0){
    		$output='<ul>';
    		foreach($query->result() as $row){
    			$output.='<li id='.$row->id.'><strong>'.$row->last_name.' '.$row->first_name.'</strong></li>';
    		}
    		$output.='</ul>';
    	}
    	return $output;
    }
	
	function fusion_players($data){
		
		$new['player_id']=$data['id'];
		$this->db->where('player_id',$data['id2']);
		$this->db->update('players_teams',$new);
		
		$new['player_id']=$data['id'];
		$this->db->where('player_id',$data['id2']);
		$this->db->update('profiles',$new);
		
		$new['player_id']=$data['id'];
		$this->db->where('player_id',$data['id2']);
		$this->db->update('lineups',$new);
		
		unset($new['player_id']);
		
		$new['in']=$data['id'];
		$this->db->where('in',$data['id2']);
		$this->db->update('changes',$new);
		
		unset($new['in']);
		
		$new['out']=$data['id'];
		$this->db->where('out',$data['id2']);
		$this->db->update('changes',$new);
		
		unset($new['out']);
		
		$new['player_id']=$data['id'];
		$this->db->where('player_id',$data['id2']);
		$this->db->update('cards',$new);
		
		$new['player_id']=$data['id'];
		$this->db->where('player_id',$data['id2']);
		$this->db->update('goals',$new);
		
		$this->db->where('id',$data['id2']);
		$this->db->delete('players');
		
		$this->check_player_team($data['id']);
	}
	
	
	function check_player_team($id){
		$query=$this->db->query('Select *
						  		 From players_teams
						  		 Where player_id='.$id);
		
		$num=$query->num_rows;
			
		if($num>1){
			$row=$query->result();
			for($i=0;i<$num-1;$i+=1):
				for($j=1;j<$num;$j+=1):
					if($row[$i]->team_id==$row[$j]->team_id){
						$this->db->where('id',$row[$j]->id);
						$this->db->delete('players_teams');
					}
				endfor;
			endfor;
		}
	}
	
	
	function get_player_teams(){
    	return $this->db->query('SELECT p.id, p.first_name as fn, p.last_name as ln,p.nick
							     FROM (SELECT p.id, COUNT( pt.id ) AS player, p.first_name, p.last_name,p.nick
								       FROM players AS p, players_teams AS pt
								       WHERE p.id = pt.player_id
								 GROUP BY p.id) AS p
								 WHERE player >1 
								 ORDER BY p.last_name');
    }
    
    function get_teams_player($id){
    	return $this->db->query('SELECT pt.id,t.name
    							 FROM teams as t, players_teams as pt, players as p
    							 WHERE p.id='.$id.' and p.id=pt.player_id and pt.team_id=t.id
    							 ORDER BY t.name');	
    }
	
}
?>