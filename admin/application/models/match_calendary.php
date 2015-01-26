<?php
class Match_calendary extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
	}    

	
	function matches_today($championship){   // Partidos q se juegan hoy
		if($championship!=FALSE)
			$this->db->where('championships.id',$championship);

		$this->db->select('rounds.*,championships.name as cname');
		$this->db->from('rounds');
		$this->db->join('championships','rounds.id=championships.active_round');
		$query=$this->db->get();
		$rounds=array();
		$championships=array();
		foreach($query->result() as $row){
			$rounds[$row->id]['name']=$row->name;
			$rounds[$row->id]['championship']['id']=$row->championship_id;
			$rounds[$row->id]['championship']['name']=$row->cname;
			$championships[$row->championship_id]=$row->cname;
		}
		$query->free_result();
		
		//Extraigo los equipos de los campeonatos
		$this->db->from('championships_teams');
		$this->db->join('teams','championships_teams.team_id=teams.id');
		$this->db->where_in('championships_teams.championship_id',array_keys($championships));
		$query=$this->db->get();
		foreach($query->result() as $row)
			$teams[$row->id]=$row->name;
		$query->free_result();
		
		//Extraigo los grupos de las rondas
		$this->db->where_in('round_id',array_keys($rounds));
		$query=$this->db->get('groups');
		foreach($query->result() as $row){
			$groups[$row->id]['name']=$row->name;
			$groups[$row->id]['round_id']=$row->round_id;
			$groups[$row->id]['round']=$rounds[$row->round_id];
		}
		$query->free_result();
		
		//Extraigo las fechas de las rondas
		$this->db->where_in('round_id',array_keys($rounds));
		$query=$this->db->get('schedules');
		foreach($query->result() as $row){
			$schedules[$row->id]['season']=$row->season;
			$schedules[$row->id]['position']=$row->position;
		}
		$query->free_result();
		
		//Extraigo los partidos de los grupos que se jueguen hoy dia
		$this->db->select('matches.*, UNIX_TIMESTAMP(matches.date_match) as dm, matches_teams.team_id_home, matches_teams.team_id_away');
		$this->db->from('matches');
		$this->db->join('matches_teams','matches_teams.match_id=matches.id');
		$this->db->where('DATE(matches.date_match)','CURDATE()',false);
		$this->db->where_in('group_id',array_keys($groups));
		$this->db->order_by('matches.group_id','asc');
		$this->db->order_by('matches.schedule_id','asc');
		$this->db->order_by('matches.date_match','desc');
		$query=$this->db->get();
		
		//echo $this->db->last_query();
		
		$matches=array();
		foreach($query->result() as $key=>$row){
			$matches[$key]=$row;
			$matches[$key]->cn=$groups[$row->group_id]['round']['championship']['name'];
			$matches[$key]->rn=$groups[$row->group_id]['round']['name'];
			$matches[$key]->rid=$groups[$row->group_id]['round_id'];
			$matches[$key]->gn=$groups[$row->group_id]['name'];
			$matches[$key]->sn=$schedules[$row->schedule_id]['season'];
			$matches[$key]->sp=$schedules[$row->schedule_id]['position'];
			$matches[$key]->hname=$teams[$row->team_id_home];
			$matches[$key]->aname=$teams[$row->team_id_away];
		}

		return $matches;
	}
	
	function matches_last_next($championship,$next){	// Partidos q se jugaron en la fecha anterior o la siguiente fecha
		$this->load->helper('string');
		
		if($championship!=FALSE){
			$donde='AND ch.id='.$championship;
		}
		else{
			$donde='';
		}
		if($next){
			$sig='MAX';
		}
		else{
		   	$sig='MIN';
		}	
		/*
		$query=$this->db->query('Select m.*, UNIX_TIMESTAMP(m.date_match) as dm, c.name as cn,c.id as cid, r.name as rn, g.name as gn, s.season as sn, s.position as sp, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname,t.mini_shield hshield, t1.name aname,t1.mini_shield ashield, r.id as rid 
								 From matches as m, groups as g, rounds as r, championships as c, schedules as s, matches_teams as mt, stadia as st, teams as t, teams as t1
								 Where mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.schedule_id IN (SELECT sch.id
																	    														 FROM   (SELECT round_id,'.$sig.'( s.position ) as p 
																																									FROM schedules AS s, championships AS ch
																																									WHERE s.round_id = ch.active_round '.$donde.'
																																									GROUP BY s.round_id) as s, schedules as sch
																																 WHERE s.p=sch.position AND s.round_id=sch.round_id) 
									   AND m.group_id=g.id AND g.round_id=r.id AND r.championship_id=c.id AND c.active_round=r.id AND st.id=m.stadia_id AND m.schedule_id = s.id
								 Order by cn asc, gn asc, sp desc, dm asc');
		*/
		//Selecciona el minimo del schedule fecha actual de la ronda activa del o los campeonatos
		//Selecciona  solo el id de la fecha
		//Seleciona todos los partidos con equipos grupo ronda campeonato de esa fecha de cada campeonaro
		//Selecciona los nombres de los equipos 
		
		$active_schedules=$this->db->query('SELECT sch.id,s.champ,s.name
    										 FROM   (SELECT round_id,'.$sig.'( s.position ) as p,ch.id as champ,ch.name
																				FROM schedules AS s, championships AS ch
																				WHERE s.round_id = ch.active_round '.$donde.'

																				GROUP BY s.round_id) as s, schedules as sch
											 WHERE s.p=sch.position AND s.round_id=sch.round_id')->result();
		
		$champs=array();
		$sch_ids="";
		foreach($active_schedules as $schedule){
			$champs[$schedule->id]=array('id'=>$schedule->champ,'name'=>$schedule->name);
			$sch_ids.=$schedule->id.',';
		}
		$sch_ids=reduce_multiples($sch_ids,",",TRUE);	
		
		$matches=$this->db->query('	SELECT m.*, UNIX_TIMESTAMP(m.date_match) as dm, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname,t.mini_shield hshield, t1.name aname,t1.mini_shield ashield 
								 	FROM matches as m,matches_teams as mt, stadia as st, teams as t, teams as t1
								 	WHERE mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.schedule_id IN ('.$sch_ids.') 
										AND st.id=m.stadia_id
								 	ORDER BY dm asc')->result();
		
		$data=array();
		$i=0;
		foreach($matches as $match){
			$data[$i]=$match;
			$data[$i]->cn=$champs[$match->schedule_id]['name'];
			$data[$i]->cid=$champs[$match->schedule_id]['id'];
			$champ[$i]=$champs[$match->schedule_id]['id'];
			$dates[$i]=$match->dm;
			$i++;
		}

		array_multisort($champ,SORT_ASC,$dates,SORT_ASC,$data);
		
		return $data;
		
	}
	
	
	
	function matches_all($championship){	// Todo el calendario
		$query=$this->db->query('Select m.*, UNIX_TIMESTAMP(m.date_match) as dm, c.name as cn, r.name as rn, g.name as gn, s.season as sn, s.position as sp, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname, t1.name aname, r.id as rid, g.id as gid
								 From matches as m, groups as g, rounds as r, championships as c, schedules as s, matches_teams as mt, stadia as st, teams as t, teams as t1
								 Where mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.schedule_id IN (SELECT sch.id
																	    														 FROM   (SELECT round_id, s.position as p 
																																									FROM schedules AS s, championships AS ch
																																									WHERE s.round_id = ch.active_round AND ch.id='.$championship.'
																																									ORDER BY p DESC) as s, schedules as sch
																																 WHERE s.p=sch.position AND s.round_id=sch.round_id) 
									   AND m.group_id=g.id AND g.round_id=r.id AND r.championship_id=c.id AND c.active_round=r.id AND st.id=m.stadia_id AND m.schedule_id = s.id
								 Order by cn asc, sp desc, dm asc, gn asc');
		return $query;
	} 
	
	function matches_by_team($team){
		return $this->db->query('Select c.name as cname, r.name as rname, g.name as gname, t1.name as hname, t2.name as aname, UNIX_TIMESTAMP(m.date_match) as mdate, m.state, m.result
								 From championships_teams as ct, championships as c, rounds as r, 
								      groups as g, matches as m, matches_teams as mt, teams as t1, teams as t2
								 Where ct.team_id='.$team.' and c.id=ct.championship_id and c.active_round>0 and 
								       r.championship_id=c.id and g.round_id=r.id and m.group_id=g.id and 
								       mt.match_id=m.id and (mt.team_id_home='.$team.' or mt.team_id_away='.$team.') and 
								       mt.team_id_home=t1.id and mt.team_id_away=t2.id
								 Order by mdate asc');
	
		
	}


	function today_matches($live='live'){   //Todo partido q se juega hoy

		$this->db->select('*, UNIX_TIMESTAMP(date_match) as hour',false);
		$this->db->from('matches');
		$this->db->where('DATE(date_match)','CURDATE()',false);
		if($live=='live')
			$this->db->where('live','1');
		$this->db->order_by('date_match','desc');
		$matches=$this->db->get();

		//Chequeo si existen partidos
		if($matches->num_rows()>0)
			$partidos=$this->data_matches($matches);
		else
			$partidos=false;

		return $partidos;
	}
	
	
	/*
	 * ULTIMOS PARTIDOS DE UNA FECHA DE UN CAMPEONATO */

	function last_matches($champ=0){

			$this->db->select('schedules.*,championships.name');
			$this->db->from('schedules');
			$this->db->join('championships','schedules.round_id=championships.active_round');
			if($champ>0)
				$this->db->where('championships.id',$champ);
			$this->db->order_by('schedules.round_id','asc');
			$this->db->order_by('schedules.position','asc');
			$schedules=$this->db->get();

			//Saco las ultimas fechas jugadas de el/los campeonatos
			$aux=0;
			$fechas=array();
			foreach($schedules->result() as $schedule){
				if($schedule->round_id != $aux){
					$fechas[]=$schedule->id;
					$aux=$schedule->round_id;
				}
			}

			//Saco todos los partidos en vivo de las fechas
			$this->db->select('*, UNIX_TIMESTAMP(date_match) as hour',false);
			$this->db->where('live','1');
			$this->db->where_in('state',array('0','8'));
			$this->db->where_in('schedule_id',$fechas);
			$this->db->order_by('date_match','desc');
			$matches=$this->db->get('matches');

			if($matches->num_rows()>0)
				$partidos=$this->data_matches($matches);
			else
				$partidos=false;

			return $partidos;
	}
	
	/* Extraigo los datos básicos del partido */
	
	function data_matches($matches){
		$partidos=array();
		foreach($matches->result() as $key=>$match){
			//Datos del Partido
			$partidos[$key]=$match;
			$this->db->where('match_id',$match->id);
			$teams=current($this->db->get('matches_teams')->result());
			$partidos[$key]->hid=$teams->team_id_home;
			$partidos[$key]->aid=$teams->team_id_away;
		
			//Campeonato
			$this->db->select('championships.*,groups.id as gid');
			$this->db->from('groups');
			$this->db->join('rounds','rounds.id=groups.round_id');
			$this->db->join('championships','championships.id=rounds.championship_id');
			$this->db->where('groups.id',$match->group_id);
			$championship=current($this->db->get()->result());
			$partidos[$key]->championship=$championship->name;
			$partidos[$key]->group_id=$championship->gid;
		
			//Equipo Local
			$this->db->where('id',$partidos[$key]->hid);
			$team_home=current($this->db->get('teams')->result());
			$partidos[$key]->hname=$team_home->name;
			$partidos[$key]->hsname=$team_home->short_name;
			$partidos[$key]->hshield='imagenes/teams/shield/default.png';
			$partidos[$key]->hthumb='imagenes/teams/thumb_shield/default.png';
			if($team_home->shield!='')
			$partidos[$key]->hshield=$team_home->shield;
			if($team_home->thumb_shield!='')
			$partidos[$key]->hthumb=$team_home->thumb_shield2;
		
			//Equipo Visitante
			$this->db->where('id',$partidos[$key]->aid);
			$team_away=current($this->db->get('teams')->result());
			$partidos[$key]->aname=$team_away->name;
			$partidos[$key]->asname=$team_away->short_name;
			$partidos[$key]->ashield='imagenes/teams/shield/default.png';
			$partidos[$key]->athumb='imagenes/teams/thumb_shield/default.png';
			if($team_away->shield2!='')
			$partidos[$key]->ashield=$team_away->shield2;
			if($team_away->thumb_shield2!='')
			$partidos[$key]->athumb=$team_away->thumb_shield2;
		}
		return $partidos;
	}
	
	
	function today_match_num(){
		$this->db->where('DATE(date_match)','CURDATE()',false);
		$res=$this->db->get('matches');
		return $res->num_rows;
	} 
	
	function week_matches() // Todo Partido q se jugara sta semana
	{
		$fecha=$this->weekStartEnd(mdate("%Y-%m-%d",time()));
		$query=$this->db->query('SELECT mh . * , ma.aid, ma.aname, c.id, c.name
						          FROM   (SELECT m . * , t.id hid, t.name AS hname
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_home = t.id) AS mh, 
						                 (SELECT m . * , t.id aid, t.name AS aname
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_away = t.id ) AS ma,
						                  championships as c, rounds as r, groups as g
						          WHERE mh.id = ma.id AND mh.date_match >"'.mdate("%Y-%m-%d %h:%i:%s",time()).'" AND mh.date_match < "'.$fecha['end'].' 23:59:59" AND mh.group_id = g.id AND g.round_id = r.id AND r.championship_id=c.id 
						          ORDER BY c.name, mh.date_match ASC');
		return $query;
	}
	
	function month_matches($month){
		
		//SACO LOS CAMPEONATOS ACTIVOS
		$this->db->select('name,active_round,id');
		$this->db->where('active_round >',0);
		$championships=$this->db->get('championships')->result();
		$active_rounds=array();
		$champs=array();
		$champs_complete=array();
		foreach($championships as $row){
			$active_rounds[]=$row->active_round;
			$champs[]=$row->id;
			$champs_complete[$row->active_round]=$row;
		}
		
		//SACO LOS GRUPOS ACTIVOS
		$this->db->select('id,round_id');
		$this->db->where_in('round_id',$active_rounds);
		$groups=$this->db->get('groups')->result();
		$active_groups=array();
		$groups_complete=array();
		foreach($groups as $row){
			$active_groups[]=$row->id;
			$groups_complete[$row->id]=$row->round_id;
		}
		
		//SACO LOS EQUIPOS POR CAMPEONATO ACTIVO
		$this->db->select('team_id');
		$this->db->where_in('championship_id',$champs);
		$championships_teams=$this->db->get('championships_teams')->result();
		$champs_teams=array();
		foreach($championships_teams as $row)
			$champs_teams[]=$row->team_id;
		
		//SACO EQUIPOS ACTIVOS POR CAMPEONATO ACTIVO
		$this->db->where_in('id',$champs_teams);
		$teams=$this->db->get('teams')->result();
		$champs_teams=array();
		foreach($teams as $row)
			$champs_teams[$row->id]=$row;
		
		//SACO PARTIDOS DE LOS GRUPOS ACTIVOS
		$this->db->where_in('group_id',$active_groups);
		$this->db->where('MONTH(date_match)',$month,FALSE);
		$this->db->where('YEAR(date_match)','YEAR(NOW())',FALSE);
		$this->db->order_by('date_match','asc');
		$this->db->join('matches_teams','matches.id = matches_teams.match_id');
		$mats=$this->db->get('matches')->result();
		
		$matches=array();
		foreach($mats as $key=>$match){
			$matches[$key]=$match;
			$matches[$key]->team_id_home=$champs_teams[$match->team_id_home];
			$matches[$key]->team_id_away=$champs_teams[$match->team_id_away];
			$matches[$key]->championship=$champs_complete[$groups_complete[$match->group_id]];
		}
		
		return $matches;
	}
	
	/* 
	* ULTIMOS PARTIDOS EN VIVO JUGADOS EN LOS ULTIMOS 7 DIAS */
	
	function played_matches() 
	{
		$fecha=$this->weekStartEnd(mdate("%Y-%m-%d",time()));
		$query=$this->db->query('SELECT mh . * , ma.aid, ma.aname, c.id, c.name
						          FROM   (SELECT m . * , t.id hid, t.name AS hname
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_home = t.id) AS mh, 
						                 (SELECT m . * , t.id aid, t.name AS aname
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_away = t.id ) AS ma,
						                  championships as c, rounds as r, groups as g
						          WHERE mh.id = ma.id AND mh.date_match <"'.mdate("%Y-%m-%d %h:%i:%s",time()).'" AND mh.date_match > "'.$fecha['start'].' 00:00:00" AND mh.group_id = g.id AND g.round_id = r.id AND r.championship_id=c.id 
						          ORDER BY c.name, mh.date_match ASC');
		return $query;
	}	
	
	function round_matches($round) // Todos los partidas de la ronda rondas
	{
		$query2=$this->db->query('SELECT UNIX_TIMESTAMP(MIN(date_match)) as date_match_first, UNIX_TIMESTAMP(MAX(date_match)) as date_match_last
								  FROM matches AS m, groups as g, rounds as r, championships as c
								  WHERE r.id='.$round.' AND g.round_id=r.id AND m.group_id=g.id');
		$row=$query2->result();
		$fecha_first=$this->weekStartEnd(mdate("%Y-%m-%d",$row[0]->date_match_first));
		$fecha_last=$this->weekStartEnd(mdate("%Y-%m-%d",$row[0]->date_match_last));
		$i=1;
		do{
			if($i!=1){
				$fecha_first=$this->weekStartEnd($this->calcularfecha($fecha_first['end'],+3));
			}
			$weeks[$i]=array(
	    					"start" => $fecha_first['start'],
							"end" => $fecha_first['end'],		
	    					      );
	    	$i+=1;
		}while ($fecha_first['end']!=$fecha_last['end']);
     	$data=$this->db->query('SELECT mh.id, mh.group_id, mh.date_match, mh.hid, mh.hname , ma.aid, ma.aname, r.id as rid, r.name as rname, g.id as gid, g.name as gname
						        FROM  (SELECT m . * , t.id hid, t.name AS hname
						 			   FROM matches AS m, matches_teams AS mt, teams AS t
									   WHERE mt.match_id = m.id AND mt.team_id_home = t.id) AS mh, 
									  (SELECT m . * , t.id aid, t.name AS aname
									   FROM matches AS m, matches_teams AS mt, teams AS t
									   WHERE mt.match_id = m.id AND mt.team_id_away = t.id ) AS ma,
									  championships as c, rounds as r, groups as g 
								WHERE r.id = '.$round.' AND g.round_id = r.id AND mh.group_id = g.id AND mh.id = ma.id  
								ORDER BY mh.date_match ASC, rid, gid');
     	foreach($data->result() as $tabla):
     		for($j=1 ; $j<$i; $j+=1){
	    		
	    		if($tabla->date_match>$weeks[$j]['start'].' 00:00:00' AND $tabla->date_match<$weeks[$j]['end'].' 23:59:59')
	    			$week=$j;
			}
			$matches[$tabla->id]=array(
	    							"id" => $tabla->id,
	    							"date_match"=>$tabla->date_match,
	    							"hid"=>$tabla->hid,
	    							"hname"=>$tabla->hname,
	    							"aid"=>$tabla->aid,
	    							"aname"=>$tabla->aname,
	    							"rid"=>$tabla->rid,
	    							"rname"=>$tabla->rname,
	    							"gid"=>$tabla->gid, 
     								"gname"=>$tabla->gname,
									"week"=>$week,
	    					      );
		endforeach;
		foreach ($matches as $key=>$arr) {
			$pun[$key] = $arr['gid'];
			$g1[$key] = $arr['date_match'];
		}
		array_multisort($g1,SORT_ASC,$pun,SORT_ASC,$matches);
		return $matches;		
	}	
	
	
	function last_games($championship,$num){    //ultimos partidos por campeonato
		$games=$this->db->query('Select m.*, t1.id as hid, t1.name as hname, t2.id as aid, t2.name as aname,UNIX_TIMESTAMP(date_match) as datem
								 From matches as m, groups as g, rounds as r, championships as c, matches_teams as mt, teams as t1, teams as t2 
								 Where mt.match_id=m.id and mt.team_id_home=t1.id and mt.team_id_away=t2.id and m.group_id=g.id and g.round_id=r.id and r.championship_id=c.id and c.id='.$championship.'
								 Order by date_match desc
								 Limit 0,'.$num);
		
		$query=$this->db->query('SELECT UNIX_TIMESTAMP(min( date_match )) as date_match_first, UNIX_TIMESTAMP(max( date_match ))as date_match_last
								 FROM championships AS c, rounds AS r, groups AS g, matches AS m
								 WHERE c.id =4
							 	 AND r.championship_id = c.id
							 	 AND g.round_id = r.id
								 AND m.group_id = g.id')->result();
		
		
		$fecha_first=$this->weekStartEnd(mdate("%Y-%m-%d",$query[0]->date_match_first));
		$fecha_last=$this->weekStartEnd(mdate("%Y-%m-%d",$query[0]->date_match_last));
		
		$i=1;
		do{
			if($i!=1){
				$fecha_first=$this->weekStartEnd($this->calcularfecha($fecha_first['end'],+3));
			}
			$weeks[$i]=array(
	    					"start" => $fecha_first['start'],
							"end" => $fecha_first['end'],		
		    		        );
		    $i+=1;
		}while ($fecha_first['end']!=$fecha_last['end']);
		
		$j=0;
		foreach($games->result() as $row):
			$partidos[$j]['id']=$row->id;
			$partidos[$j]['fecha']=mdate("%d %M %y",$row->datem);
			$partidos[$j]['hora']=mdate("%h:%i",$row->datem);
			$partidos[$j]['hequipo']=$row->hname;
			$partidos[$j]['aequipo']=$row->aname;
			if($row->result=='' || $row->result==NULL)
				$partidos[$j]['marcador']='Sin jugar';
			else
				$partidos[$j]['marcador']=$row->result;
			
			
			for($k=1 ; $k<$i; $k+=1){
	    		if($row->date_match>$weeks[$k]['start'].' 00:00:00' AND $row->date_match<$weeks[$k]['end'].' 23:59:59')
	    			$partidos[$j]['jornada']=$k;
			}
			
			$j+=1;
			
		endforeach;
		
		return $partidos;
		
	}
	
	function next_games($championship,$num){ // jugandose o por jugar
		$query=$this->db->query('Select m.*, t1.name as t1name,t2.name as t2name, UNIX_TIMESTAMP(m.date_match) as dm 
						  		 From matches as m, matches_teams as mt, teams as t1, teams as t2, groups as g, rounds as r, championships as c 
						  		 Where c.id='.$championship.' AND c.id=r.championship_id AND r.id=g.round_id AND g.id=m.group_id AND m.id=mt.match_id AND mt.team_id_home=t1.id AND mt.team_id_away=t2.id AND m.state=0 AND m.date_match > "'.mdate("%Y-%m-%d 00:00:00").'"
						  		 Order by date_match ASC
						  		 Limit 0,'.$num);
		
		$partido=array();
		$i=0;
		foreach($query->result() as $row):
			$partido[$i]['id']=$row->id;
			$partido[$i]['fecha']=mdate("%Y/%m/%d",$row->dm);
			$partido[$i]['hora']=mdate("%h:%i",$row->dm);
			$partido[$i]['hequipo']=$row->t1name;
			$partido[$i]['aequipo']=$row->t2name;
			$i+=1;
		endforeach;
		
		return $partido;
	}
	
	function championship_matches($championship){
		$query2=$this->db->query('SELECT UNIX_TIMESTAMP(MIN(date_match)) as date_match_first, UNIX_TIMESTAMP(MAX(date_match)) as date_match_last
								  FROM matches AS m, groups as g, rounds as r, championships as c
								  WHERE c.id='.$championship.' AND c.id=r.championship_id AND g.round_id=r.id AND m.group_id=g.id');
		$row=$query2->result();
		$fecha_first=$this->weekStartEnd(mdate("%Y-%m-%d",$row[0]->date_match_first));
		$fecha_last=$this->weekStartEnd(mdate("%Y-%m-%d",$row[0]->date_match_last));
		$i=1;
		do{
			if($i!=1){
				$fecha_first=$this->weekStartEnd($this->calcularfecha($fecha_first['end'],+3));
			}
			$weeks[$i]=array(
	    					"start" => $fecha_first['start'],
							"end" => $fecha_first['end'],		
	    					      );
	    	$i+=1;
		}while ($fecha_first['end']!=$fecha_last['end']);
     	$data=$this->db->query('SELECT mh.id, mh.group_id, mh.result, UNIX_TIMESTAMP(mh.date_match) as datem, mh.date_match, mh.hid, mh.hname , ma.aid, ma.aname, r.id as rid, r.name as rname, g.id as gid, g.name as gname
						        FROM  (SELECT m . * , t.id hid, t.name AS hname
						 			   FROM matches AS m, matches_teams AS mt, teams AS t
									   WHERE mt.match_id = m.id AND mt.team_id_home = t.id) AS mh, 
									  (SELECT m . * , t.id aid, t.name AS aname
									   FROM matches AS m, matches_teams AS mt, teams AS t
									   WHERE mt.match_id = m.id AND mt.team_id_away = t.id ) AS ma,
									  championships as c, rounds as r, groups as g 
								WHERE c.id='.$championship.' AND c.id = r.championship_id AND g.round_id = r.id AND mh.group_id = g.id AND mh.id = ma.id  
								ORDER BY mh.date_match ASC, rid, gid');
     	foreach($data->result() as $tabla):
     		for($j=1 ; $j<$i; $j+=1){
	    		
	    		if($tabla->date_match>$weeks[$j]['start'].' 00:00:00' AND $tabla->date_match<$weeks[$j]['end'].' 23:59:59')
	    			$week=$j;
			}
			$matches[$tabla->id]=array(
	    							"id" => $tabla->id,
	    							"fecha"=>mdate("%d %M %y",$tabla->datem),
	    							"hora"=>mdate("%h:%i",$tabla->datem),
	    							"hequipo"=>$tabla->hname,
	    							"aequipo"=>$tabla->aname,
	    							"marcador"=>$tabla->result,
	    							"jornada"=>$week,
									"date_match"=>$tabla->date_match
	    					      );
		endforeach;
		foreach ($matches as $key=>$arr) {
			$pun[$key] = $arr['date_match'];
		}
		array_multisort($pun,SORT_ASC,$matches);
		return $matches;
	}
	
	function weekStartEnd($date)
	{
		$dateArr=explode("-",$date);
		$dayInWeekNo=date("N", mktime(0, 0, 0, $dateArr[1],$dateArr[2],$dateArr[0]));   
		$weekStartEndPosition=array(
		1=>array("start"=>0,"end"=>6),
		2=>array("start"=>-1,"end"=>5),
		3=>array("start"=>-2,"end"=>4),
		4=>array("start"=>-3,"end"=>3),
		5=>array("start"=>-4,"end"=>2),
		6=>array("start"=>-5,"end"=>1),
		7=>array("start"=>-6,"end"=>0)
		);
		$weekStart=date("Y-m-d",
		mktime(0,0,0,$dateArr[1],
		$dateArr[2]+
		$weekStartEndPosition[$dayInWeekNo]["start"],
		$dateArr[0]));
		$weekEnd=date("Y-m-d",
		mktime(0,0,0,$dateArr[1],
		$dateArr[2]+
		$weekStartEndPosition[$dayInWeekNo]["end"],$dateArr[0]));          
		return array("start"=>$weekStart,"end"=>$weekEnd);
	}
	
    function calcularFecha($fecha,$dias){
      $fechaComparacion = strtotime($fecha);
      $calculo= strtotime($dias." days", $fechaComparacion);
      return(date("Y-m-d", $calculo));
    }
    
    function late_games(){
    	return $this->db->query('SELECT m.id, m.result, m.state, UNIX_TIMESTAMP(m.date_match) as dm, t1.id AS hid, t1.name AS hname, t2.id AS aid, t2.name AS aname, r.id as rid
								 FROM matches AS m, matches_teams AS mt, teams AS t1, teams AS t2, groups as g, rounds as r
								 WHERE date_match < NOW( )
								   AND state !=8
								   AND m.id = mt.match_id
								   AND mt.team_id_home = t1.id
								   AND mt.team_id_away = t2.id
								   AND m.group_id=g.id
								   AND g.round_id=r.id
								 ORDER BY dm desc');
    }

	function match_game($champ,$which){	
		
		$query=$this->db->query('SELECT s . *
							   	 FROM schedules AS s, championships as c, rounds AS r
							   	 WHERE s.round_id = r.id
								   AND r.id = c.active_round
								   AND c.id ='.$champ.'
							   	 ORDER BY s.position');
		
		
		$num=$query->num_rows();
		if($num>0){
		$check=0;
	
		if($which<0){
			$which=$which*-1;
			$check=1;
		}
		
		while($which>=$num){
			$which=$which-$num;
		}
		
		if($which==0){
			$which=$num;
			$check=1;
		}
	
		
		if($check==0){
			$which=$num-$which;
		}
		
		$i=1;
		
		$position='';
		$round='';
		foreach($query->result() as $row):
			if($i==$which){
				$position=$row->position;
				$round=$row->round_id;
			}
			$i+=1;
		endforeach;
		
		$query=$this->db->query('Select m.*, UNIX_TIMESTAMP(m.date_match) as dm, c.name as cn,c.id as cid, r.name as rn, g.name as gn, s.season as sn, s.position as sp, mt.team_id_home as hid, mt.team_id_away as aid, st.name, t.name hname,t.mini_shield hshield, t1.name aname,t1.mini_shield ashield, r.id as rid 
								 From matches as m, groups as g, rounds as r, championships as c, schedules as s, matches_teams as mt, stadia as st, teams as t, teams as t1
								 Where mt.match_id=m.id AND mt.team_id_home=t.id AND mt.team_id_away=t1.id AND m.schedule_id IN (SELECT sch.id
																	    														 FROM   schedules as sch
																																 WHERE sch.position='.$position.' AND '.$round.'=sch.round_id) 
									   AND m.group_id=g.id AND g.round_id=r.id AND r.championship_id=c.id AND c.active_round=r.id AND st.id=m.stadia_id AND m.schedule_id = s.id
								 Order by cn asc, gn asc, sp desc, dm asc');
		return $query;
		}
		else
			return false;
	}
    
}

?>