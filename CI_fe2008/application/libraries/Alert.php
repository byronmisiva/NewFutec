<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class CI_Alert {

	var $CI;
	var $championships;
	
	function CI_Alert(){
		
		$this->CI =& get_instance();
		
		$this->CI->load->helper('html');
		$this->CI->load->helper('url');
		$this->CI->load->helper('date');
		
		
		$data['today_match']=$this->today_match_num();
		$data['no_aprov']=$this->get_num_no_aprov();
		$data['no_striker_pic']=$this->get_no_striker_pic();
		$data['programed']=$this->get_programed();
		$data['no_image_pic']=$this->get_no_image_pic();
		$data['active_survey']=$this->get_num_active_survey();
		$data['late_games']=$this->get_late_games();
		$data['player_teams']=$this->get_player_teams();
		
		$this->CI->template->write_view('alertas', 'public/alerts', $data, TRUE);
		
		
	}
	
	function today_match_num(){	
		$this->CI->db->select('count(id) as num');
		$this->CI->db->where('date_match >=',mdate("%Y-%m-%d",time()));
		$this->CI->db->where('date_match <=',mdate("%Y-%m-%d",time()).' 23:59:59"');
		$matches=$this->CI->db->get('matches');
		
		$aux=current($matches->result());
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	
	function get_num_no_aprov(){
		$this->CI->db->select('count(id) as num');
		$this->CI->db->where('aproved',0);
		$comments=$this->CI->db->get('comments');
		
		$aux=current($comments->result());
		
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_late_games(){
		$this->CI->db->select('count(id) as num');
		$this->CI->db->where('date_match <',mdate("%Y-%m-%d",time()));
		$this->CI->db->where('state !=','8');
		$aux=current($this->CI->db->get('matches')->result());
		
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
    }
    
	function get_programed(){
		$this->CI->db->select('count(id) as num');
		$this->CI->db->where('programed !=','NULL',FALSE);
		$aux=current($this->CI->db->get('stories')->result());

		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_no_image_pic(){
		$this->CI->db->select('count(id) as num');
		$this->CI->db->where('thumbh50','');
		$aux=current($this->CI->db->get('images')->result());

		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_no_striker_pic(){
		
		$this->CI->db->select('id');
		$this->championships=$this->CI->db->get('championships')->result();
		
		$i=0;
		foreach($this->championships as $row){
		
			$this->CI->db->select('COUNT(g.id) as goals,p.thumb');
			$this->CI->db->from('goals as o, players as p, matches as m, groups as g, rounds as r');
			$this->CI->db->where('r.championship_id',$row->id);
			$this->CI->db->where('r.id','g.round_id',FALSE);
			$this->CI->db->where('g.id','m.group_id',FALSE);
			$this->CI->db->where('m.id','o.match_id',FALSE);
			$this->CI->db->where('o.player_id','p.id',FALSE);
			$this->CI->db->where('o.type !=','3');
			$this->CI->db->group_by('p.id');
			$this->CI->db->order_by('goals','desc');
			$this->CI->db->order_by('p.last_name','ASC');
			$this->CI->db->order_by('p.first_name','ASC');
			$this->CI->db->limit(1);
			
			$query=$this->CI->db->get();
			
			if($query->num_rows()>0){
				$res=$query->result();
				if($res[0]->thumb=='NULL')
					$i+=1;	
			}
		}
		
		return $i;	
	}
	
	function get_num_active_survey(){
		return $this->get_active_survey()->num_rows();
	}
	

    
    function get_player_teams(){
    	$res=$this->CI->db->query('SELECT COUNT( player ) as c
								   FROM (SELECT p.id, COUNT( pt.id ) AS player
										 FROM players AS p, players_teams AS pt
										 WHERE p.id = pt.player_id
										 GROUP BY p.id) AS p
								   WHERE player >2 ')->result();
    	if(isset($res[0]->c))
    		return $res[0]->c;
    	else
    		return 0; 
    }
	
	
	function get_active_survey(){
		
    	return $this->CI->db->query('SELECT ss.id, eid, uid, e.name, u.title, Datediff( NOW( ) , ss.date_start ) as days, u.votes, u.created
						  		 FROM ( SELECT MAX( id ) AS id, section_id AS eid, survey_id AS uid, date_start
										FROM (SELECT *
											  FROM sections_surveys
											  ORDER BY id DESC) AS eu
											  GROUP BY section_id ) AS ss
									    LEFT JOIN sections AS e ON e.id = ss.eid
									    LEFT JOIN surveys AS u ON u.id = ss.uid');
    }
	
}
?>
