<?php
class Match extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->model('team');
        $this->load->model('group'); 
        /*
       
        $this->load->model('goals');
        $this->load->model('cards');
        $this->load->model('changes');
        $this->load->model('lineups');
        $this->load->model('timers');
        $this->load->model('match_referee');
		*/
        $this->name='matches';
	}    
	
	function get($id){
		$this->db->where('id',$id);
		return current($this->db->get($this->name)->result());
	}

	function get_full($id){
		$data=$this->team->get_by_match($id);
		$data['partido']=$this->get($id);
		$data['partido']->result_home=trim(substr($data['partido']->result,0,2));
		$data['partido']->result_away=trim(substr($data['partido']->result,-2));
		$group=$this->group->get_full($data['partido']->group_id);
		$data['partido']->championship_id=$group->championship_id;
		$data['partido']->round_id=$group->round_id;

		$data['referee']=current($this->db->query('SELECT r.first_name as rf, r.last_name as rl, r1.first_name as r1f, r1.last_name as r1l, r2.first_name as r2f, r2.last_name as r2l, rs.first_name as rsf, rs.last_name as rsl
								   FROM  (SELECT *
       									  FROM matches_referee 
       									  WHERE match_id='.$id.') as mr
								   LEFT JOIN referee AS r  ON mr.referee_id_central = r.id 
								   LEFT JOIN referee AS r1 ON mr.referee_id_line1 = r1.id  
								   LEFT JOIN referee AS r2 ON mr.referee_id_line2 = r2.id  
								   LEFT JOIN referee AS rs ON mr.referee_id_sub = rs.id ')->result());
		
		$this->db->where('id',$data['partido']->stadia_id);
		$data['stadia']=current($this->db->get('stadia')->result());
		
		$this->db->select('l.*,p.first_name,p.last_name, if(l.position="Arquero",1,if(l.position="Defensa",2,if(l.position="Volante",3,if(l.position="Delantero",4,0)))) as ptype,
							if(l.status=0,1,if(l.status=1,0,if(l.status=2,1,if(l.status=3,0,1)))) as pstatus', FALSE);
		$this->db->from('lineups l,players p');
		$this->db->where('l.player_id','p.id',FALSE);
		$this->db->where('match_id',$id);
		$this->db->order_by('team_id','asc');
		$this->db->order_by('pstatus','asc');
		$this->db->order_by('ptype','asc');
		$this->db->order_by('last_name','asc');
		$this->db->order_by('first_name','asc');
		$lineup=$this->db->get()->result();
		
		$data['lineup_home']=array();
		$data['lineup_away']=array();
		foreach($lineup as $row){			
				switch($row->team_id){
					case $data['home']->id:
						$data['lineup_home'][$row->player_id]->id=$row->player_id;
						$data['lineup_home'][$row->player_id]->position=$row->position;
						$data['lineup_home'][$row->player_id]->name=$row->first_name." ".$row->last_name;
						$data['lineup_home'][$row->player_id]->position=$row->ptype;
						$data['lineup_home'][$row->player_id]->status=$row->pstatus;
						$data['lineup_home'][$row->player_id]->points=$row->points;
						break;
						
					case $data['away']->id:
						$data['lineup_away'][$row->player_id]->id=$row->player_id;
						$data['lineup_away'][$row->player_id]->position=$row->position;
						$data['lineup_away'][$row->player_id]->name=$row->first_name." ".$row->last_name;
						$data['lineup_away'][$row->player_id]->position=$row->ptype;
						$data['lineup_away'][$row->player_id]->status=$row->pstatus;
						$data['lineup_away'][$row->player_id]->points=$row->points;
						break;
				}	
				
			}
		
		$data['goals_home']=array();
		$data['goals_away']=array();
		$this->db->order_by('minute','asc');
		$goals=$this->db->get_where('goals',array('match_id'=>$id))->result();
		foreach($goals as $row){
			switch($row->team_id){
				case $data['home']->id:
					$data['goals_home'][$row->id]->minute=$row->minute;
					$data['goals_home'][$row->id]->name=$data['lineup_home'][$row->player_id]->name;
					break;
					
				case $data['away']->id:
					$data['goals_away'][$row->id]->minute=$row->minute;
					$data['goals_away'][$row->id]->name=$data['lineup_away'][$row->player_id]->name;
					break;
				
			}
		}
		
		$data['cards_home']=array();
		$data['cards_away']=array();
		$this->db->order_by('minute','asc');
		$cards=$this->db->get_where('cards',array('match_id'=>$id))->result();
		foreach($cards as $row){
			switch($row->team_id){
				case $data['home']->id:
					$data['cards_home'][$row->id]->minute=$row->minute;
					$data['cards_home'][$row->id]->name=$data['lineup_home'][$row->player_id]->name;
					$data['cards_home'][$row->id]->type=$row->type;
					break;
					
				case $data['away']->id:
					$data['cards_away'][$row->id]->minute=$row->minute;
					$data['cards_away'][$row->id]->name=$data['lineup_away'][$row->player_id]->name;
					$data['cards_away'][$row->id]->type=$row->type;
					break;
				
			}
		}
		
		$data['changes_home']=array();
		$data['changes_away']=array();
		$this->db->order_by('minute','asc');
		$changes=$this->db->get_where('changes',array('match_id'=>$id))->result();
		foreach($changes as $row){
			switch($row->team_id){
				case $data['home']->id:
					$data['changes_home'][$row->id]->minute=$row->minute;
					$data['changes_home'][$row->id]->in=$data['lineup_home'][$row->in]->name;
					$data['changes_home'][$row->id]->out=$data['lineup_home'][$row->out]->name;
					break;
					
				case $data['away']->id:
					$data['changes_away'][$row->id]->minute=$row->minute;
					$data['changes_away'][$row->id]->in=$data['lineup_away'][$row->in]->name;
					$data['changes_away'][$row->id]->out=$data['lineup_away'][$row->out]->name;
					break;	
			}
		}
		
		$this->db->order_by('match_time','desc');
		$data['actions']=$this->db->get_where('actions',array('match_id'=>$id))->result();
		return $data;
	}
	
	
	function get_all(){
		$this->db->select('m.*,mt.team_id_home as e1,mt.team_id_away as e2');
		$this->db->from("matches m,matches_teams mt");
		$this->db->where("m.id","mt.match_id",FALSE);
		
		$matches=$this->db->get();
		return $matches->result();
	}
	
	
	function get_goals($match,$team){
		
		$this->db->select('count(*) as num');
		$where = "(match_id = $match AND team_id=$team and type!=3) OR (team_id!=$team and type=3 and match_id=$match)";
		$this->db->where($where);
		
		$data=current($this->db->get('goals')->result());

		if($data===FALSE){
			return 0;
		}
		else
			return $data->num;
	}
	
	function get_teams($match){
		$this->db->where('match_id',$match);
		$match=$this->db->get('matches_teams');
		
		return current($match->result());
	}
	
	function get_teams_name($match){
		$teams=$this->get_teams($match);
		$home=current($this->team->get($teams->team_id_home)->result());
		$away=current($this->team->get($teams->team_id_away)->result());
		$aux['home']=$home->name;
		$aux['away']=$away->name;
		return $aux;
	}
	
	function get_champ($match){
		
		$this->db->select('c.id,c.name');
		$this->db->from('matches m,groups g,rounds r,championships c');
		$this->db->where('m.group_id','g.id',FALSE);
		$this->db->where('g.round_id','r.id',FALSE);
		$this->db->where('r.championship_id','c.id',FALSE);
		$this->db->where('m.id',$match);
		
		$aux=current($this->db->get()->result());
		return $aux->id;
	}
	
	function get_matches_by_champ($champ){		
		$this->db->select('m.*,mt.team_id_home as home,mt.team_id_away as away');
		$this->db->from('matches m,groups g, rounds r,matches_teams mt');
		$this->db->where('m.group_id','g.id',FALSE);
		$this->db->where('g.round_id','r.id',FALSE);
		$this->db->where('m.id','mt.match_id',FALSE);
		$this->db->where('r.championship_id',$champ);
		$this->db->where('m.state >','0');

		$aux=$this->db->get()->result();
		
		return $aux;
	}
	
	
	function getAllByToday($fecha=''){
    	
    	if($fecha=="")
    		$fecha=time();
    	else{
    		$partes=explode(' ',$fecha);
    		$fecha1=explode('-',$partes[0]);
    		$fecha2=explode(':',$partes[1]);
    		$fecha=mktime($fecha2[0],$fecha2[1], $fecha2[2],$fecha1[1], $fecha1[2],$fecha1[0]);
    	}
    		
    	$dia=date('j',$fecha);
    	$mes=date('n',$fecha);
    	$anio=date('Y',$fecha);
    	
    	$this->db->select('*,UNIX_TIMESTAMP(date_match) as fechas');
    	$this->db->where('DAY(date_match)',$dia,false);
    	$this->db->where('MONTH(date_match)',$mes,false);
    	$this->db->where('YEAR(date_match)',$anio,false);
    	$this->db->where('YEAR(date_match)',$anio,false);
    	$this->db->order_by('date_match','asc');
    	$query=$this->db->get($this->name);
    	$cont=0;
    	
    	if($query->num_rows()>0){
			foreach($query->result() as $row){
					$teams=$this->team->get_by_match($row->id);
					$datos[$cont]->id=$row->id;
					$datos[$cont]->grupo_id=$row->group_id;
					$datos[$cont]->championship_id=$this->get_champ($row->id);
					$datos[$cont]->fecha=$row->date_match;
					$datos[$cont]->estado=$row->state;
					$datos[$cont]->resultado=$row->result;
					$datos[$cont]->estadio_id=$row->stadia_id;
					$datos[$cont]->local=$teams['home']->id;
					$datos[$cont]->visitante=$teams['away']->id;
					$datos[$cont]->nlocal=$teams['home']->short_name;
					$datos[$cont]->nvisitante=$teams['away']->short_name;
					$cont++;
			}
			return $datos;
		}
		else
			return NULL;
    
    }
    
    function getTeams($match_id){
    	$this->db->where('match_id',$match_id);
    	$query=$this->db->get('matches_teams')->result();
    	
    	return current($query);
    }
	
}

?>