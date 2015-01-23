<?php
class Team extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('group');
    	$this->name='teams';
	}    

    function get($id){
    	$this->db->where( 'id',$id);
		return $this->db->get($this->name);
    }
    
    function get_by_championship_teams($id){
    	$this->db->select('t.*');
    	$this->db->from('teams t,championships_teams ct');
    	$this->db->where('t.id','ct.team_id',FALSE);
    	$this->db->where('ct.id',$id);
    	
    	$aux=current($this->db->get()->result());
    	return $aux;
    }
    
    function get_by_match($match){
    	$teams=current($this->db->get_where('matches_teams', array('match_id' => $match))->result());
		
    	$data['home']=current($this->get($teams->team_id_home)->result());
		$data['away']=current($this->get($teams->team_id_away)->result());

		return $data;
    }
    
    function get_teams(){
    	return $this->db->query('Select * from teams');
    }
    
	function get_teams_championship($id){
		$this->db->select('t.*,ct.id as ctid');
		$this->db->from('teams as t, championships_teams as ct');
		$this->db->where('ct.team_id','t.id',FALSE);
		$this->db->where('ct.championship_id',$id);
		$this->db->order_by('t.name','asc');
		
		$aux=$this->db->get();
		return $aux;
    }
    
    function get_shirt($id){
    	$team=$this->db->query('Select mini_shirt, team_pic, shirt, shirt2
    					 	 	From teams
    					  		Where id='.$id);
    	return $team;
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->select('u.*, t.name as team, r.name as rol');
		$this->db->from('users as u');
		$this->db->join('teams as t', 'u.team_id = t.id','left');
		$this->db->join('roles as r', 'u.role_id = r.id','left');
	    $this->db->limit($config['per_page'], $page);
		return $this->db->get();
    }
    
	function get_all_letter($letter,$page=0){
		$config['base_url']=base_url().'/teams/index/'.$letter.'/';
		$this->db->like('name', $letter, 'after');
		$config['total_rows']=$this->db->count_all_results('teams');
		$config['per_page']=RESULT_PAGE;
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);

		$this->db->select('t.*,s.name as sname');
		$this->db->join('stadia as s','s.id=t.stadia_id','LEFT');
		$this->db->like('t.name', $letter, 'after'); 
		$this->db->order_by("t.name", "asc");
		$this->db->limit($config['per_page'], $page);
		return $this->db->get('teams as t')->result();
    }
    
    
    function get_pics($id){
    	$query=$this->db->query('Select t.id,t.shield, t.shield2
    					  		 From championships as c, teams  as t, championships_teams as ct, images as i
    					  		 Where c.id='.$id.'
    					  		   And c.id=ct.championship_id
    					  		   And t.id=ct.team_id');
    	
    	if($query->num_rows()==0)
    		return NULL;
    	
    	$teams='';
    	
    	foreach($query->result() as $row):
    		$teams['shield'][$row->id]=$row->shield;
    		$teams['shield2'][$row->id]=$row->shield2;
    	endforeach;
    	
    	return $teams;
    }
    
    function insert($data){
    	
    }
    
    function update($data){
    	
    }
    
    function delete($id){
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return true;
    }
    
    function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc");
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Equipo...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
	function get_list_ec(){
    	$this->db->select('id, name');
    	$this->db->where('country','Ecuador');
    	$this->db->order_by("name", "asc");
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Equipo...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_list_championship($champ){
    	$data=$this->get_teams_championship($champ);
    	$aux['']="Seleccione un Equipo...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;	
    }
    
    function get_details($id){
    	$this->db->select("t.*,h.*,s.name as stadia");
    	$this->db->join("histories as h",'h.team_id = t.id','left');
    	$this->db->join("stadia as s",'s.id = t.stadia_id','left');
    	$this->db->where("t.id",$id);
    	$aux=$this->db->get($this->name." as t");
    	return current($aux->result());
    }
    
    function get_results($id,$type,$days=90){
    	//Extraigo los grupos activos
    	$aux=$this->group->get_active_groups();
    	foreach($aux as $row){
    		$list[]=$row->id;
    		$champ[$row->id]=$row->name;
    	}
    	//Saco los partidos jugados de los campeonatos activos
    	$this->db->select('m.*,LEFT(m.result,2) as home_result,RIGHT(m.result,2) as away_result,t1.id as home_id,t1.name as home_name,t1.mini_shield as home_shield,t2.id as away_id,t2.name as away_name,t2.mini_shield as away_shield',FALSE);
    	$this->db->from('teams t1,teams t2,matches m,matches_teams mt');
    	$this->db->where('t1.id','mt.team_id_home',FALSE);
    	$this->db->where('t2.id','mt.team_id_away',FALSE);
    	$this->db->where('m.id','mt.match_id',FALSE);
    	$this->db->where("(mt.team_id_home=$id or mt.team_id_away=$id)");
    	$this->db->where_in('m.group_id',$list);
    	$this->db->where('m.state',$type);
    	if($type==0)
    		$this->db->where('m.date_match >',mdate("%Y-%m-%d %h:%i:%s",time() + ($days*24*60*60)));
    	else
    		$this->db->where('m.date_match >',mdate("%Y-%m-%d %h:%i:%s",time() - ($days*24*60*60)));
    	$this->db->order_by('m.group_id','asc');
    	$this->db->order_by('m.group_id','desc');
  		$aux['partidos']=$this->db->get()->result();
  		$aux['champs']=$champ;
  		//echo $this->db->last_query();	
    	return $aux;
    }
    
	function striker_championship($champ,$team){
		$query=$this->db->query('SELECT p.id, p.first_name, p.last_name, p.thumb, IF(st.gol IS NULL,0,st.gol) as gol, if(c.y IS NULL,0,c.y) as y, if(c.r IS NULL,0,c.r) as r
								 FROM (SELECT p.id, p.first_name, p.last_name, p.thumb
								       FROM players AS p, players_teams AS pt 
								       WHERE pt.team_id ='.$team.'
								         AND pt.player_id = p.id
								       ORDER BY p.last_name) AS p
								 LEFT JOIN(SELECT o.player_id, COUNT( o.id ) AS gol
								           FROM championships AS c, rounds AS r, groups AS g, matches AS m, goals AS o
								           WHERE c.id ='.$champ.'
										     AND c.id = r.championship_id
										   	 AND r.id = g.round_id
										     AND g.id = m.group_id
										   	 AND m.id = o.match_id
										     AND o.team_id ='.$team.'
										   GROUP BY o.player_id) AS st ON p.id = st.player_id
								 LEFT JOIN(SELECT a.player_id, SUM( IF( a.type =1, 1, 0 ) ) AS y, SUM( IF( a.type =2, 1, 0 ) ) AS r
								           FROM championships AS c, rounds AS r, groups AS g, matches AS m, cards AS a
								           WHERE c.id ='.$champ.'
										     AND c.id = r.championship_id
										     AND r.id = g.round_id
										     AND g.id = m.group_id
										     AND m.id = a.match_id
								             AND a.team_id ='.$team.'
										   GROUP BY a.player_id) AS c ON p.id = c.player_id');
										
		$statistics=FALSE;
		$ttotal=0;
		$matches=$this->team_played($champ,$team);
		$total=$matches['h']+$matches['a'];
		
		foreach($query->result() as $row):
			$ttotal=$ttotal+$row->gol;
		endforeach;
		
		$i=1;
		foreach($query->result() as $row):
		
			$statistics[$i]['name']=$row->last_name.' '.$row->first_name;
			$statistics[$i]['image']=$row->thumb;
			$statistics[$i]['gol']=$row->gol;
			$statistics[$i]['y']=$row->y;
			$statistics[$i]['r']=$row->r;
			if($total!=0)
				$statistics[$i]['gol_match']=round($row->gol/$total,2);
			else
				$statistics[$i]['gol_match']='0';
			if($ttotal!=0)
				$statistics[$i]['gol_team']=round(($row->gol/$ttotal)*100,2) .' %';
			else
				$statistics[$i]['gol_team']='0 %';
			$i+=1;
		
		endforeach;
		
		return $statistics;
	}
	
	function team_cards($champ,$team){
		
		$query=$this->db->query('SELECT DISTINCT (a.id), a.type, mt.team_id_home, mt.team_id_away
								 FROM championships AS c, rounds AS r, groups AS g, matches AS m, cards as a, matches_teams as mt
								 WHERE c.id ='.$champ.'
				  				   AND c.id = r.championship_id
								   AND r.id = g.round_id
				 				   AND g.id = m.group_id
								   AND m.id = a.match_id
								   AND m.id = mt.match_id
								   AND (mt.team_id_home = '.$team.' OR mt.team_id_away = '.$team.')
								   AND m.state =8
								   AND a.team_id ='.$team);
		
		$statistics['y']=0;
		$statistics['r']=0;
		$statistics['yh']=0;
		$statistics['rh']=0;
		$statistics['ya']=0;
		$statistics['ra']=0;
		$matches=$this->team_played($champ,$team);
		
		$total=$matches['h']+$matches['a'];
		$home=$matches['h'];
		$away=$matches['a'];
		
		foreach($query->result() as $row):
			
			if($row->type==1){
				$statistics['y']+=1;
				if($row->team_id_home == $team)
					$statistics['yh']+=1;
				else
					$statistics['ya']+=1;
			}
			else{
				$statistics['r']+=1;
				if($row->team_id_home == $team)
					$statistics['rh']+=1;
				else
					$statistics['ra']+=1;
			}
			
		endforeach;
		
		if($total!=0){
			$statistics['ypp']=round(($statistics['y']/$total),2);
			$statistics['rpp']=round(($statistics['r']/$total),2);
		}
		else{
			$statistics['ypp']='0';
			$statistics['rpp']='0';	
		}
		
		if($home!=0){
			$statistics['yhpp']=round(($statistics['yh']/$home),2);
			$statistics['rhpp']=round(($statistics['rh']/$home),2);
		}
		else{
			$statistics['yhpp']='0';
			$statistics['rhpp']='0';
		}
		
		if($away!=0){
			$statistics['yapp']=round(($statistics['ya']/$away),2);
			$statistics['rapp']=round(($statistics['ra']/$away),2);
		}
		else{
			$statistics['ypp']='0';
			$statistics['rpp']='0';	
			$statistics['yhpp']='0';
			$statistics['rhpp']='0';
			$statistics['yapp']='0';
			$statistics['rapp']='0';
		}
		
		if($statistics['y']!=0){
			$statistics['yhp']=round(($statistics['yh']/$statistics['y'])*100,2).' %';
			$statistics['yap']=round(($statistics['ya']/$statistics['y'])*100,2).' %';
		}
		else{
			$statistics['yhp']='0 %';
			$statistics['yap']='0 %';
		}
		
		if($statistics['r']!=0){
			$statistics['rhp']=round(($statistics['rh']/$statistics['r'])*100,2).' %';
			$statistics['rap']=round(($statistics['ra']/$statistics['r'])*100,2).' %';
		}
		else{
			$statistics['rhp']='0 %';
			$statistics['rap']='0 %';
		}
		
		return $statistics;
	}
	
	function team_played($champ,$team){
		$query=$this->db->query('SELECT mt.team_id_home, mt.team_id_away
								 FROM championships AS c, rounds AS r, groups AS g, matches AS m, matches_teams AS mt
								 WHERE c.id ='.$champ.'
				  				   AND c.id = r.championship_id
								   AND r.id = g.round_id
				 				   AND g.id = m.group_id
								   AND m.id = mt.match_id
								   AND (mt.team_id_home ='.$team.' OR mt.team_id_away ='.$team.')
								   AND m.state =8');
		
		$row['h']=0;
		$row['a']=0;
		
		foreach($query->result() as $raw):
			if($raw->team_id_home==$team)
				$row['h']+=1;		
			else
				$row['a']+=1;
		endforeach;
		
		return $row;
	}
	
	function team_all($champ,$team){
		
		$query=$this->db->query('SELECT m.result, mt.team_id_home, mt.team_id_away
								 FROM championships AS c, rounds AS r, groups AS g, matches AS m, matches_teams AS mt
								 WHERE c.id ='.$champ.'
				  				   AND c.id = r.championship_id
								   AND r.id = g.round_id
				 				   AND g.id = m.group_id
								   AND m.id = mt.match_id
								   AND (mt.team_id_home ='.$team.' OR mt.team_id_away ='.$team.')
								   AND m.state =8');
		
		$result['ghe']=0;
		$result['ghr']=0;
		$result['gae']=0;
		$result['gar']=0;
		$result['wh']=0;
		$result['dh']=0;
		$result['lh']=0;
		$result['wa']=0;
		$result['da']=0;
		$result['la']=0;
		
		foreach($query->result() as $row):
			$match['home']=substr($row->result,0,1);
			$match['away']=substr($row->result,4,1);
			if($row->team_id_home==$team){
				$result['ghe']=$result['ghe']+$match['home'];
				$result['ghr']=$result['ghr']+$match['away'];
				if($match['home']>$match['away'])
					$result['wh']+=1;
				if($match['home']==$match['away'])
					$result['dh']+=1;
				if($match['home']<$match['away'])
					$result['lh']+=1;
			}
			else{
				$result['gae']=$result['gae']+$match['away'];
				$result['gar']=$result['gar']+$match['home'];
				if($match['home']<$match['away'])
					$result['wa']+=1;
				if($match['home']==$match['away'])
					$result['da']+=1;
				if($match['home']>$match['away'])
					$result['la']+=1;
			}
		endforeach;
		
		$statistics['n']=$result['wh']+$result['dh']+$result['lh']+$result['wa']+$result['da']+$result['la'];
		$statistics['h']=$result['wh']+$result['dh']+$result['lh'];
		$statistics['wh']=$result['wh'];
		$statistics['dh']=$result['dh'];
		$statistics['lh']=$result['lh'];
		if($statistics['h']!=0){
			$statistics['whp']=round(($result['wh']/$statistics['h'])*100,2) .' %';
			$statistics['dhp']=round(($result['dh']/$statistics['h'])*100,2) .' %';
			$statistics['lhp']=round(($result['lh']/$statistics['h'])*100,2) .' %';
		}
		else{
			$statistics['whp']='0 %';
			$statistics['dhp']='0 %';
			$statistics['lhp']='0 %';
		}
		$statistics['a']=$result['wa']+$result['da']+$result['la'];
		$statistics['wa']=$result['wa'];
		$statistics['da']=$result['da'];
		$statistics['la']=$result['la'];
		if($statistics['a']!=0){
			$statistics['wap']=round(($result['wa']/$statistics['a'])*100,2) .' %';
			$statistics['dap']=round(($result['da']/$statistics['a'])*100,2) .' %';
			$statistics['lap']=round(($result['la']/$statistics['a'])*100,2) .' %';
		}
		else{
			$statistics['wap']='0 %';
			$statistics['dap']='0 %';
			$statistics['lap']='0 %';	
		}
		$statistics['w']=$result['wh']+$result['wa'];
		$statistics['d']=$result['dh']+$result['da'];
		$statistics['l']=$result['lh']+$result['la'];
		if($statistics['n']!=0){
			$statistics['wp']=round(($statistics['w']/$statistics['n'])*100,2) .' %';
			$statistics['dp']=round(($statistics['d']/$statistics['n'])*100,2) .' %';
			$statistics['lp']=round(($statistics['l']/$statistics['n'])*100,2) .' %';
		}
		else{
			$statistics['wp']='0 %';
			$statistics['dp']='0 %';
			$statistics['lp']='0 %';	
		}
		$statistics['ge']=$result['ghe']+$result['gae'];
		$statistics['gr']=$result['ghr']+$result['gar'];
		$statistics['ghe']=$result['ghe'];
		$statistics['ghr']=$result['ghr'];
		$statistics['gae']=$result['gae'];
		$statistics['gar']=$result['gar'];
		if($statistics['ge']!=0){
			$statistics['ghep']=round(($result['ghe']/$statistics['ge'])*100,2) .' %';
			$statistics['gaep']=round(($result['gae']/$statistics['ge'])*100,2) .' %';
		}
		else{
			$statistics['ghep']='0 %';
			$statistics['gaep']='0 %';	
		}
		if($statistics['gr']!=0){
			$statistics['ghrp']=round(($result['ghr']/$statistics['gr'])*100,2) .' %';
			$statistics['garp']=round(($result['gar']/$statistics['gr'])*100,2) .' %';
		}
		else{
			$statistics['ghrp']='0 %';
			$statistics['garp']='0 %';
		}
		
		if($statistics['n']!=0){
			$statistics['gepp']=round(($statistics['ge']/$statistics['n']),2);
			$statistics['grpp']=round(($statistics['gr']/$statistics['n']),2);
		}
		else{
			$statistics['gepp']='0 %';
			$statistics['grpp']='0 %';
		}
		
		if($statistics['h']!=0){
			$statistics['ghepp']=round(($statistics['ghe']/$statistics['h']),2);
			$statistics['ghrpp']=round(($statistics['ghr']/$statistics['h']),2);
		}
		else{
			$statistics['ghepp']='0 %';
			$statistics['ghrpp']='0 %';
		}
		
		if($statistics['a']!=0){
			$statistics['gaepp']=round(($statistics['gae']/$statistics['a']),2);
			$statistics['garpp']=round(($statistics['gar']/$statistics['a']),2);
		}
		else{
			$statistics['gaepp']='0 %';
			$statistics['garpp']='0 %';
		}
		return $statistics;
	}
	
	function last_match($champ,$team){
		$query=$this->db->query('SELECT m.id
								 FROM championships AS c, rounds AS r, groups AS g, matches AS m, matches_teams AS mt
								 WHERE c.id = '.$champ.'
								 AND c.id = r.championship_id
								 AND r.id = g.round_id
								 AND g.id = m.group_id
								 AND m.id = mt.match_id
								 AND (mt.team_id_home = '.$team.' OR mt.team_id_away = '.$team.')
								 AND m.state = 8
								 ORDER BY m.date_match DESC LIMIT 1');
		
		if($query->num_rows()==0)
			return NULL;
		else 
			$query2=$query->row();
		
		return $this->last_lineup($query2->id,$team);
	}
	
	
	function last_lineup($match,$team){
		$query=$this->db->query('SELECT l.position , l.status, p.last_name, p.first_name,p.nick
								 FROM lineups AS l, players AS p
								 WHERE l.match_id ='.$match.'
								 AND l.team_id = '.$team.'
								 AND l.player_id = p.id
								 ORDER BY last_name');
		
		$players['arq']='';
		$players['def']='';
		$players['vol']='';
		$players['del']='';
		$players['sup']='';
		
		$def=1;
		$vol=1;
		$del=1;
		$sup=1;
		$name='';
		foreach($query->result() as $row):
			if($row->nick!='NULL' and $row->nick!= "")
				$name=$row->nick;
			else{
				if($row->last_name==''){
					$name=$row->first_name;
				}
				else{
					$name=$row->last_name;
					if($row->first_name!=''){
						$name=substr(trim($row->first_name),0,1).'. '.$name;
					}
				}
			}
				
			if($row->position=='Arquero' && ($row->status==1 || $row->status==3)){
				$players['arq']['name']=$name;
			}
		
			elseif($row->position=='Defensa' && ($row->status==1 || $row->status==3)){
				$players['def'][$def]['name']=$name;
				$def+=1;
			}
			
			elseif($row->position=='Volante' && ($row->status==1 || $row->status==3)){
				$players['vol'][$vol]['name']=$name;
				$vol+=1;
			}
			
			elseif($row->position=='Delantero' && ($row->status==1 || $row->status==3)){
				$players['del'][$del]['name']=$name;
				$del+=1;
			}
			
			else{
				if($sup<11){
				$players['sup'][$sup]['name']=$name;
				$sup+=1;}
			}
		endforeach;
	
		return $players;
	} 
	
	function get_strikes($id){
		$this->load->model('championship');

		$championships=$this->championship->get_active();
		$list=array();
		foreach($championships as $row)
			$list[]=$row->active_round;	
			
		$this->db->select('g.player_id,p.first_name,p.last_name,p.nick,p.thumb,count(*) as goals');
		$this->db->from('goals g,matches m,players p,groups gr,rounds r');
		$this->db->where('g.match_id','m.id',FALSE);
		$this->db->where('g.player_id','p.id',FALSE);
		$this->db->where('m.group_id','gr.id',FALSE);
		$this->db->where('gr.round_id','r.id',FALSE);
		$this->db->where_in('r.id', $list);
		$this->db->where('g.team_id',$id);
		$this->db->group_by('g.player_id');
		$this->db->order_by('goals','desc');
		$this->db->limit(10);

		$aux=$this->db->get();
		
		return $aux->result();
	}
	
	function get_players_list($team){
		
		$this->db->from('players_teams pt,players p');
		$this->db->where('pt.player_id','p.id',FALSE);
		$this->db->where('pt.team_id',$team);
		$this->db->order_by('p.last_name','asc');
		$this->db->order_by('p.first_name','asc');
		
		$aux=$this->db->get();
		$res=array();
		foreach($aux->result() as $row){
    		$res[$row->id]=$row->last_name.' '.$row->first_name;
    	}
		return $res;
	}
}
?>