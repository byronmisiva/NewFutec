<?php
class Alerts extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('date');
	}
	
	function index(){
		$this->output->cache(CACHE_DEFAULT);
		
		$data['today_match']=$this->today_match_num();
		$data['no_aprov']=$this->get_num_no_aprov();
		$data['no_striker_pic']=$this->get_no_striker_pic();
		$data['programed']=$this->get_programed();
		$data['no_image_pic']=$this->get_no_image_pic();
		$data['active_survey']=$this->get_num_active_survey();
		$data['late_games']=$this->get_late_games();
		$data['player_teams']=$this->get_player_teams();
		$data['old_images']=$this->get_images_not_used();
		
		$this->load->view('public/alerts', $data);
		
	}
	
	function today_match_num(){
		$this->db->select('count(id) as num');
		$this->db->where('date_match >=',mdate("%Y-%m-%d",time()));
		$this->db->where('date_match <=',mdate("%Y-%m-%d",time()).' 23:59:59"');
		$matches=$this->db->get('matches');
	
		$aux=current($matches->result());
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	
	function get_num_no_aprov(){
		$this->db->select('count(id) as num');
		$this->db->where('aproved',0);
		$comments=$this->db->get('comments');
	
		$aux=current($comments->result());
	
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_late_games(){
		$this->db->select('count(id) as num');
		$this->db->where('date_match <',mdate("%Y-%m-%d",time()));
		$this->db->where('state !=','8');
		$aux=current($this->db->get('matches')->result());
	
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_programed(){
		$this->db->select('count(id) as num');
		$this->db->where('programed !=','NULL',FALSE);
		$aux=current($this->db->get('stories')->result());
	
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_no_image_pic(){
		$this->db->select('count(id) as num');
		$this->db->where('thumbh50','');
		$aux=current($this->db->get('images')->result());
	
		if(isset($aux->num))
			return $aux->num;
		else
			return 0;
	}
	
	function get_no_striker_pic(){
	
		$this->db->select('id');
		$this->championships=$this->db->get('championships')->result();
	
		$i=0;
		foreach($this->championships as $row){
	
			$this->db->select('COUNT(g.id) as goals,p.thumb');
			$this->db->from('goals as o, players as p, matches as m, groups as g, rounds as r');
			$this->db->where('r.championship_id',$row->id);
			$this->db->where('r.id','g.round_id',FALSE);
			$this->db->where('g.id','m.group_id',FALSE);
			$this->db->where('m.id','o.match_id',FALSE);
			$this->db->where('o.player_id','p.id',FALSE);
			$this->db->where('o.type !=','3');
			$this->db->group_by('p.id');
			$this->db->order_by('goals','desc');
			$this->db->order_by('p.last_name','ASC');
			$this->db->order_by('p.first_name','ASC');
			$this->db->limit(1);
				
			$query=$this->db->get();
				
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
		$res=$this->db->query('SELECT COUNT( player ) as c
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
	
		return $this->db->query('SELECT ss.id, eid, uid, e.name, u.title, Datediff( NOW( ) , ss.date_start ) as days, u.votes, u.created
						  		 FROM ( SELECT MAX( id ) AS id, section_id AS eid, survey_id AS uid, date_start
										FROM (SELECT *
											  FROM sections_surveys
											  ORDER BY id DESC) AS eu
											  GROUP BY section_id ) AS ss
									    LEFT JOIN sections AS e ON e.id = ss.eid
									    LEFT JOIN surveys AS u ON u.id = ss.uid');
	}
	
	function get_images_not_used(){
		$res=$this->db->query('	SELECT count(*) as valor 
									FROM fe2008.images 
									WHERE created < (NOW() - INTERVAL 1 YEAR) and id not in (
    									SELECT distinct image_id 
										FROM fe2008.stories 
										WHERE stories.image_id = images.id   AND created > (NOW() - INTERVAL 1 YEAR) and image_id IS NOT NULL order by created desc)')->result();
		return $res[0]->valor;
		
	}
}