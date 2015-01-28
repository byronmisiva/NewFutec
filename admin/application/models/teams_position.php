<?php
class Teams_position extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='teams_positions';
        $this->load->model('match');
        $this->load->model('championship');
	}    
	
    function get_positions($group){
		return $this->db->query('SELECT mg.id, mg.hname, mg.aname, mg.hid, mg.aid, mg.hgid, agid+IFNULL( COUNT(g.id), 0 ) AS agid            
								 FROM  (SELECT mg.id, mg.hname, mg.aname, mg.hid, mg.aid, mg.hgid+IFNULL( COUNT(o.id), 0 ) AS hgid, mg.agid
								        FROM  (SELECT mha . *, IFNULL( COUNT(o.id), 0 ) agid
								               FROM  (SELECT mha . * , IFNULL( COUNT(g.id), 0 ) AS hgid
								                      FROM  (SELECT mh.id, mh.hname, ma.aname, mh.hid, ma.aid
								                             FROM  (SELECT m.id, t.name AS hname, t.id AS hid
								                                    FROM matches AS m, matches_teams AS mt, teams AS t
								                                    WHERE m.group_id ='.$group.' AND m.id = mt.match_id AND mt.team_id_home = t.id AND m.state!=0) AS mh, 
								                                   (SELECT m.id, t.name AS aname, t.id AS aid
								                                    FROM matches AS m, matches_teams AS mt, teams AS t
								                                    WHERE m.group_id ='.$group.' AND m.id = mt.match_id AND mt.team_id_away = t.id AND m.state!=0) AS ma
								                             WHERE mh.id = ma.id)mha
								                      LEFT JOIN goals AS g ON g.match_id = mha.id AND g.team_id = mha.hid AND g.type!=3
								                      GROUP BY mha.id) as mha
								               LEFT JOIN goals AS o ON o.match_id = mha.id AND o.team_id = mha.aid AND o.type!=3
								               GROUP BY mha.id) as mg
					 			        LEFT JOIN goals AS o ON o.match_id = mg.id AND o.team_id = mg.aid AND o.type=3
								        GROUP BY mg.id) as mg
								 LEFT JOIN goals AS g ON g.match_id = mg.id AND g.team_id = mg.hid AND g.type=3
								 GROUP BY mg.id');
    }
    
    function get_positions_total($championship){
    	return $this->db->query('SELECT mg.id, mg.hname, mg.aname, mg.hid, mg.aid, mg.hgid, agid+IFNULL( COUNT(g.id), 0 ) AS agid            
								 FROM  (SELECT mg.id, mg.hname, mg.aname, mg.hid, mg.aid, mg.hgid+IFNULL( COUNT(o.id), 0 ) AS hgid, mg.agid
								        FROM  (SELECT mha . *, IFNULL( COUNT(o.id), 0 ) agid
								               FROM  (SELECT mha . * , IFNULL( COUNT(g.id), 0 ) AS hgid
								                      FROM  (SELECT mh.id, mh.hname, ma.aname, mh.hid, ma.aid
								                             FROM  (SELECT m.id, t.name AS hname, t.id AS hid
								                                    FROM matches AS m, matches_teams AS mt, teams AS t, rounds as r, groups as g
								                                    WHERE r.championship_id='.$championship.' AND r.id=g.round_id AND m.group_id =g.id AND m.id = mt.match_id AND mt.team_id_home = t.id AND m.state!=0) AS mh, 
								                                   (SELECT m.id, t.name AS aname, t.id AS aid
								                                    FROM matches AS m, matches_teams AS mt, teams AS t, rounds as r, groups as g
								                                    WHERE r.championship_id='.$championship.' AND r.id=g.round_id AND m.group_id =g.id AND m.id = mt.match_id AND mt.team_id_away = t.id AND m.state!=0) AS ma
								                             WHERE mh.id = ma.id)mha
								                      LEFT JOIN goals AS g ON g.match_id = mha.id AND g.team_id = mha.hid AND g.type!=3
								                      GROUP BY mha.id) as mha
								               LEFT JOIN goals AS o ON o.match_id = mha.id AND o.team_id = mha.aid AND o.type!=3
								               GROUP BY mha.id) as mg
					 			        LEFT JOIN goals AS o ON o.match_id = mg.id AND o.team_id = mg.aid AND o.type=3
								        GROUP BY mg.id) as mg
								 LEFT JOIN goals AS g ON g.match_id = mg.id AND g.team_id = mg.hid AND g.type=3
								 GROUP BY mg.id');
    }
    
    function get_teams($group){
    	$query=$this->db->query('SELECT DISTINCT t.id, t.name
    							 FROM  (SELECT t.name, t.id
								        FROM matches AS m, matches_teams AS mt, teams AS t
								        WHERE m.group_id ='.$group.' AND m.id = mt.match_id AND mt.team_id_home = t.id
								        UNION
								        SELECT t.name, t.id
								        FROM matches AS m, matches_teams AS mt, teams AS t
								        WHERE m.group_id ='.$group.' AND m.id = mt.match_id AND mt.team_id_away = t.id) AS t ');
    	
    	if($query->num_rows()>0)
    		return $query;
		else{
			$champion=$this->db->query('SELECT c.id
								   	    FROM championships as c, rounds as r, groups as g
							  			WHERE g.id='.$group.' AND g.round_id=r.id AND r.championship_id=c.id')->result();
			return $this->get_teams_total($champion[0]->id);
		}
		
    }
    
	function get_teams_total($championship){
		$this->db->select('t.id,t.name,s.id as section');
		$this->db->from('championships as c, championships_teams as ct, teams as t');
		$this->db->join('sections s', 't.id = s.team_id', 'left');
		$this->db->where('c.id','ct.championship_id',FALSE);
		$this->db->where('ct.team_id','t.id',FALSE);
		$this->db->where('c.id',$championship);
		$this->db->order_by('name','asc');
		
		$aux=$this->db->get();
		
		return $aux;
    }
    
	function get_bonus($group){
    	$row=$this->db->query('Select c.active_round as ar, r.id
    						   From championships as c, rounds as r, groups as g 
    						   Where g.id='.$group.' and g.round_id= r.id and r.championship_id = c.id ')->result();
    	
    	$query=false;
    	
    	if($row[0]->ar==$row[0]->id){
    		$query=$this->db->query('Select ct.team_id, ct.bonus
    								 From championships_teams as ct
    								 where ct.round_id='.$row[0]->ar);
    	}
    	return $query;				
    }
    
    
    function get_tabla($query,$query2, $query3){
    	$tabla='';
    	foreach($query2->result() as $row): 
	    	$tabla[$row->id]=array(
	    							"id" => $row->id,
	    							"name" => $row->name,
	    							"PJ"=>0,//
	    							"PG"=>0,//
	    							"PE"=>0,//
	    							"PP"=>0,//
	    							"GF"=>0,//
	    							"GC"=>0,//
	    							"P"=>0,
	    							"GD"=>0, 
	    					      );
	   	endforeach;
	   	if(is_array($tabla)){
	   	
		   	if($query3!=NULL){
		   		if($query3->num_rows()!=0){
		   		foreach($query3->result() as $row):
		   			if(isset($tabla[$row->team_id]))
		   				$tabla[$row->team_id]["P"]+=$row->bonus;
		   		endforeach;
		   		}
		   	}
		   	
		   	
		   	foreach($query->result() as $row): 
			   	$tabla[$row->hid]["PJ"]+=1;
			   	$tabla[$row->aid]["PJ"]+=1;
			   	$tabla[$row->hid]["GF"]+=$row->hgid;
			   	$tabla[$row->aid]["GF"]+=$row->agid;
			   	$tabla[$row->hid]["GC"]+=$row->agid;
			   	$tabla[$row->aid]["GC"]+=$row->hgid;
			   	if($row->hgid > $row->agid){
			   		$tabla[$row->hid]["PG"] +=1;
			   		$tabla[$row->hid]["P"] +=3;
			   		$tabla[$row->aid]["PP"] +=1;
			   	}
			   	else{
			   		
				   	if($row->hgid < $row->agid){
				   		$tabla[$row->aid]["PG"] +=1;
				   		$tabla[$row->aid]["P"] +=3;
				   		$tabla[$row->hid]["PP"] +=1;
				   	}
				   	else{
				   		$tabla[$row->aid]["PE"] +=1;
				   		$tabla[$row->hid]["PE"] +=1;
				   		$tabla[$row->aid]["P"] +=1;
				   		$tabla[$row->hid]["P"] +=1;
				   	}
				} 
		   	endforeach;
		   	foreach($query2->result() as $row): 
		   		$tabla[$row->id]["GD"]=$tabla[$row->id]["GF"]-$tabla[$row->id]["GC"];
		   	endforeach;
		   	foreach ($tabla as $key=>$arr) {
				$pun[$key] = $arr['P'];
				$g1[$key] = $arr['GD'];
				$g2[$key] = $arr['GF'];
				$g3[$key] = $arr['GC'];	
			}
			array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$tabla);
	   	}
		return $tabla;
    }
    
    
	function get_table($group,$championship=false)
	{
		/*
		if($championship==false){
			$championship=current($this->db->query('SELECT * FROM championship c,round r,group g WHERE r.championship=c.id and r.id=g.round_id and g.id='.$group)->result());
			$championship=$championship->id;
		}
			
		//Saco todos los equipos del campeonato
		$this->db->select('t.*');
		$this->db->from('championships_teams c');
		$this->db->join('teams t', 't.id = c.team_id', 'left');
		$this->db->where('championship_id',$championship);
		$teams=$this->db->get();
		*/
		
    	$query=$this->db->query('Select t.*, if( s.id IS NULL , 0, s.id ) AS sid
                                 From (Select DISTINCT(t.id), t.name
                                         From groups as g, matches as m, matches_teams as mt, teams as t
                                         Where g.id='.$group.' AND g.id=m.group_id AND m.id=mt.match_id AND m.special=0 AND (mt.team_id_home=t.id or mt.team_id_away=t.id) ) as t
                                  Left Join sections as s ON t.id=s.team_id');
    	
    	$query2=$this->db->query('Select m.result, mt.team_id_home, mt.team_id_away, s.position
    							  From groups as g, matches as m, matches_teams as mt, schedules as s 
    							  Where g.id='.$group.' AND g.id=m.group_id AND m.id=mt.match_id AND state!=0 AND m.special=0 AND m.schedule_id=s.id
    							  Order by s.position asc');
    	
    	$teams='';
    	
    	foreach($query->result() as $row):
    		$teams[$row->id]['id']=$row->id;
    		$teams[$row->id]['name']=$row->name;
    		$teams[$row->id]['section']=$row->sid;
    		$teams[$row->id]['points']=0;
    		$teams[$row->id]['pj']=0;
    		$teams[$row->id]['pg']=0;
    		$teams[$row->id]['pe']=0;
    		$teams[$row->id]['pp']=0;
    		$teams[$row->id]['gf']=0;
    		$teams[$row->id]['gc']=0;
    		$teams[$row->id]['gd']=0;
    		$teams[$row->id]['change']=1;
    		$teams[$row->id]['updown']=0;
    		$teams2[$row->id]['id']=$row->id;
    		$teams2[$row->id]['points']=0;
    		$teams2[$row->id]['gf']=0;
    		$teams2[$row->id]['gc']=0;
    		$teams2[$row->id]['gd']=0;
    	endforeach;
    	
    	$last=$query2->row();
    	if($last!=FALSE){
	    	$i=$last->position;
	    	$t=$this->special($group,$teams,$teams2,$i);
	    	$teams=$t;
	    	$teams2=$t;
	    	/*$tpp=$teams;
	    	$tpp2=$teams2;
	    	var_dump($tpp);
	    	var_dump('<br/><br/><br/><br/><br/><br/><br/>');
	    	var_dump($tpp2);*/
    	}

    	foreach($query2->result() as $row):
    		if($i!=$row->position){
    			$i='';
    		}
    		if($row->result=="")
    			$row->result="0 - 0";
    		$result=explode('-',trim($row->result));
    		
    		$h=trim($result[0]);
    		$a=trim($result[1]);
    		
    		if($h>$a){
    			$teams[$row->team_id_home]['points']+=3;
    			$teams[$row->team_id_home]['gf']+=$h;
    			$teams[$row->team_id_home]['gc']+=$a;
    			$teams[$row->team_id_home]['pg']+=1;
    			
    			$teams[$row->team_id_away]['gf']+=$a;
    			$teams[$row->team_id_away]['gc']+=$h;
    			$teams[$row->team_id_away]['pp']+=1;
    			
    			if($i==''){
    				$teams2[$row->team_id_home]['points']+=3;
	    			$teams2[$row->team_id_home]['gf']+=$h;
	    			$teams2[$row->team_id_home]['gc']+=$a;
	    			
	    			$teams2[$row->team_id_away]['gf']+=$a;
	    			$teams2[$row->team_id_away]['gc']+=$h;
    			}
    			
    		}
    		else{
	    		if($h==$a){
	    			$teams[$row->team_id_home]['points']+=1;
	    			$teams[$row->team_id_home]['gf']+=$h;
	    			$teams[$row->team_id_home]['gc']+=$a;
	    			$teams[$row->team_id_home]['pe']+=1;
	    			
	    			$teams[$row->team_id_away]['points']+=1;
	    			$teams[$row->team_id_away]['gf']+=$a;
	    			$teams[$row->team_id_away]['gc']+=$h;
	    			$teams[$row->team_id_away]['pe']+=1;
	    			
	    			if($i==''){
	    				$teams2[$row->team_id_home]['points']+=1;
		    			$teams2[$row->team_id_home]['gf']+=$h;
		    			$teams2[$row->team_id_home]['gc']+=$a;
		    			
		    			$teams2[$row->team_id_away]['points']+=1;
		    			$teams2[$row->team_id_away]['gf']+=$a;
		    			$teams2[$row->team_id_away]['gc']+=$h;
	    			}
	    		}
	    		else{
	    			$teams[$row->team_id_away]['points']+=3;
	    			$teams[$row->team_id_away]['gf']+=$a;
	    			$teams[$row->team_id_away]['gc']+=$h;
	    			$teams[$row->team_id_away]['pg']+=1;
	    			
	    			$teams[$row->team_id_home]['gf']+=$h;
	    			$teams[$row->team_id_home]['gc']+=$a;
	    			$teams[$row->team_id_home]['pp']+=1;
	    			
	    			if($i==''){
	    				$teams2[$row->team_id_away]['points']+=3;
		    			$teams2[$row->team_id_away]['gf']+=$a;
		    			$teams2[$row->team_id_away]['gc']+=$h;
		    			
		    			$teams2[$row->team_id_home]['gf']+=$h;
		    			$teams2[$row->team_id_home]['gc']+=$a;	
	    			}
	    		}
    		}
    		
    		$teams[$row->team_id_home]['pj']+=1;
    		$teams[$row->team_id_away]['pj']+=1;
    		
    		$teams[$row->team_id_home]['gd']=$teams[$row->team_id_home]['gd']+$h-$a;
    		$teams[$row->team_id_away]['gd']=$teams[$row->team_id_away]['gd']+$a-$h;
    		if($i==''){
    			$teams2[$row->team_id_home]['gd']=$teams2[$row->team_id_home]['gd']+$h-$a;
    			$teams2[$row->team_id_away]['gd']=$teams2[$row->team_id_away]['gd']+$a-$h;
    		}
    		
    	endforeach;

    	$bonus=$this->get_bonus($group);
    	
    	if($bonus!=false){
	    	if($bonus->num_rows()>0){
		    	foreach($bonus->result() as $row):
		    		if(isset($teams[$row->team_id]))
		    			$teams[$row->team_id]['points']+=$row->bonus;
		    	endforeach;
	    	}
    	}
    	if(is_array($teams)){
	    	foreach ($teams as $key=>$arr):
				$pun[$key] = $arr['points'];
				$g1[$key] = $arr['gd'];
				$g2[$key] = $arr['gf'];
				$g3[$key] = $arr['gc'];	
			endforeach;
			array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$teams);
	    	
	    	foreach ($teams2 as $key2=>$arr2):
				$pun2[$key2] = $arr2['points'];
				$g21[$key2] = $arr2['gd'];
				$g22[$key2] = $arr2['gf'];
				$g23[$key2] = $arr2['gc'];	
			endforeach;
			array_multisort($pun2,SORT_DESC,$g21,SORT_DESC,$g22,SORT_DESC,$g23,SORT_ASC,$teams2);
			
			$i=1;
			foreach($teams as $t):
				$j=1;
	
				foreach($teams2 as $t2):
					if($t['id']==$t2['id']){
						if($i>$j){
							$teams[$i-1]['change']=2;
							$teams[$i-1]['updown']=abs($i-$j);
						}
						if($i<$j){
							$teams[$i-1]['change']=0;
							$teams[$i-1]['updown']=abs($i-$j);
						}
					}
					$j+=1;
				endforeach;
			
				$i+=1;
			endforeach;
    	}
		return $teams;
    }
    
    function special($group,$tabla,$tabla2,$i){
    	$row=$this->db->query('Select g.round_id
    						   From groups as g
    						   Where g.id='.$group)->row();
  
    	$row=$this->db->query('Select m.result, mt.team_id_home as th, mt.team_id_away as ta, s.position
    						   From groups as g, matches as m, matches_teams as mt, schedules as s
    						   Where g.round_id='.$row->round_id.' and g.id=m.group_id and m.special=1 and m.id=mt.match_id and m.schedule_id=s.id and m.state!=0');
  	
    	foreach($row->result() as $r):
    		$result=explode('-',trim($r->result));
    		$h=trim($result[0]);
    		$a=trim($result[1]);
    		if($h>$a){
    			if(isset($tabla[$r->th])){
    				$tabla[$r->th]['points']+=3;
	    			$tabla[$r->th]['gf']+=$h;
	    			$tabla[$r->th]['gc']+=$a;
	    			$tabla[$r->th]['pg']+=1;
	    			$tabla[$r->th]['pj']+=1;
	    			$tabla[$r->th]['gd']=$tabla[$r->th]['gd']+$h-$a;

	    			if($i!=$r->position){
	    				$tabla2[$r->th]['points']+=3;
	    				$tabla2[$r->th]['gf']+=$h;
	    				$tabla2[$r->th]['gc']+=$a;
	    				$tabla2[$r->th]['gd']=$tabla2[$r->th]['gd']+$h-$a;
	    			}
    			}
    			if(isset($tabla[$r->ta])){
    				$tabla[$r->ta]['gf']+=$a;
	    			$tabla[$r->ta]['gc']+=$h;
	    			$tabla[$r->ta]['pp']+=1;
	    			$tabla[$r->ta]['pj']+=1;
	    			$tabla[$r->ta]['gd']=$tabla[$r->ta]['gd']+$a-$h;
    				
	    			if($i!=$r->position){
	    				$tabla2[$r->ta]['gf']+=$a;
	    				$tabla2[$r->ta]['gc']+=$h;
	    				$tabla2[$r->ta]['gd']=$tabla2[$r->ta]['gd']+$a-$h;
	    			}
    			}
    		}
    		
    		if($h==$a){
	    		if(isset($tabla[$r->th])){
	    			$tabla[$r->th]['points']+=1;
		    		$tabla[$r->th]['gf']+=$h;
		    		$tabla[$r->th]['gc']+=$a;
		   			$tabla[$r->th]['pe']+=1;
		   			$tabla[$r->th]['pj']+=1;
	    			$tabla[$r->th]['gd']=$tabla[$r->th]['gd']+$h-$a;
		    			
	    			if($i!=$r->position){
		    			$tabla2[$r->th]['points']+=1;
		    			$tabla2[$r->th]['gf']+=$h;
		   				$tabla2[$r->th]['gc']+=$a;
	    				$tabla2[$r->th]['gd']=$tabla2[$r->th]['gd']+$h-$a;
		    		}
	    		}
	    		if(isset($tabla[$r->ta])){
	    			$tabla[$r->ta]['points']+=1;
		   			$tabla[$r->ta]['gf']+=$a;
		   			$tabla[$r->ta]['gc']+=$h;
		   			$tabla[$r->ta]['pe']+=1;
	   				$tabla[$r->ta]['pj']+=1;
	   				$tabla[$r->ta]['gd']=$tabla[$r->ta]['gd']+$a-$h;
	    			if($i!=$r->position){
	    				$tabla2[$r->ta]['points']+=1;
		    			$tabla2[$r->ta]['gf']+=$a;
		    			$tabla2[$r->ta]['gc']+=$h;	
	    				$tabla2[$r->ta]['gd']=$tabla2[$r->ta]['gd']+$a-$h;
		    		}
	    		}
    				
    		}
    		if($h<$a){
	    		if(isset($tabla[$r->ta])){
	    			$tabla[$r->ta]['points']+=3;
		   			$tabla[$r->ta]['gf']+=$a;
		   			$tabla[$r->ta]['gc']+=$h;
		   			$tabla[$r->ta]['pg']+=1;
		   			$tabla[$r->ta]['pj']+=1;
	   				$tabla[$r->ta]['gd']=$tabla[$r->ta]['gd']+$a-$h;
	    				
	    			if($i!=$r->position){
	    				$tabla2[$r->ta]['points']+=3;
			   			$tabla2[$r->ta]['gf']+=$a;
			   			$tabla2[$r->ta]['gc']+=$h;	
	    				$tabla2[$r->ta]['gd']=$tabla2[$r->ta]['gd']+$a-$h;
	    			}
	   			}
	    		if(isset($tabla[$r->th])){
	    			$tabla[$r->th]['gf']+=$h;
		   			$tabla[$r->th]['gc']+=$a;
		   			$tabla[$r->th]['pp']+=1;	
		   			$tabla[$r->th]['pj']+=1;
	   				$tabla[$r->th]['gd']=$tabla[$r->th]['gd']+$h-$a;
	    			if($i!=$r->position){		    			
			    		$tabla2[$r->th]['gf']+=$h;
			    		$tabla2[$r->th]['gc']+=$a;
			    		$tabla2[$r->th]['gd']=$tabla2[$r->th]['gd']+$h-$a;
		    		}
	    		} 			
   			}
    		
    	endforeach;
    	
    	//var_dump($tabla);
    	
    	return $tabla;
    }
    
    
	function get_table_by_champ($championship){
		
		$teams=$this->get_teams_total($championship)->result();
		$matches=$this->match->get_matches_by_champ($championship);
		$last_schedule=$this->championship->get_last_schedule($championship);

		return $this->make_table($matches,$teams,$last_schedule);
	}
	
	function make_table($matches,$teams,$last_schedule){
		
		//TODO: Bonificacion en Tabla Acumulada
		
		$table=array();

		foreach($teams as $row){
			$table[$row->id]=array('id'=>$row->id,'name'=>$row->name,'section'=>$row->section);
			$table[$row->id]['points']=0;
    		$table[$row->id]['pj']=0;
    		$table[$row->id]['pg']=0;
    		$table[$row->id]['pe']=0;
    		$table[$row->id]['pp']=0;
    		$table[$row->id]['gf']=0;
    		$table[$row->id]['gc']=0;
    		$table[$row->id]['gd']=0;
    		$table[$row->id]['change']=1;
    		$table[$row->id]['updown']=0;
		}
		$table_ant=$table;
	
		foreach($matches as $row){
			$home=false;
			$away=false;
			$result=trim($row->result);
    		$h=(int)trim(substr($result,0,1));
    		$a=(int)trim(substr($result,3));
			
    		if(isset($table[$row->home])){
    			$table[$row->home]['pj']+=1;
				$home=true;
				if($row->schedule_id!=$last_schedule)
					$table_ant[$row->home]['pj']+=1;
			}
    		if(isset($table[$row->away])){
    			$table[$row->away]['pj']+=1;
    			$away=true;
    			if($row->schedule_id!=$last_schedule)
					$table_ant[$row->away]['pj']+=1;
    		}
    		
    		//Si el equipo local gana
    		if($h>$a){
    			if($home){
					$table[$row->home]['points']+=3;
					$table[$row->home]['pg']+=1;
					$table[$row->home]['gf']+=$h;
					$table[$row->home]['gc']+=$a;
					$table[$row->home]['gd']+=$h-$a;
					if($row->schedule_id!=$last_schedule){
						$table_ant[$row->home]['points']+=3;
						$table_ant[$row->home]['pg']+=1;
						$table_ant[$row->home]['gf']+=$h;
						$table_ant[$row->home]['gc']+=$a;
						$table_ant[$row->home]['gd']+=$h-$a;
					}
    			}
    			if($away){
					$table[$row->away]['pp']+=1;
					$table[$row->away]['gf']+=$a;
					$table[$row->away]['gc']+=$h;
					$table[$row->away]['gd']+=$a-$h;
    				if($row->schedule_id!=$last_schedule){
						$table_ant[$row->away]['pp']+=1;
						$table_ant[$row->away]['gf']+=$a;
						$table_ant[$row->away]['gc']+=$h;
						$table_ant[$row->away]['gd']+=$a-$h;
					}
    			}
			}
			else{
				//Si Empatan
				if($h==$a){
					if($home){
						$table[$row->home]['points']+=1;
						$table[$row->home]['pe']+=1;
						$table[$row->home]['gf']+=$h;
						$table[$row->home]['gc']+=$a;
						if($row->schedule_id!=$last_schedule){
							$table_ant[$row->home]['points']+=1;
							$table_ant[$row->home]['pe']+=1;
							$table_ant[$row->home]['gf']+=$h;
							$table_ant[$row->home]['gc']+=$a;
						}
	    			}
	    			if($away){
	    				$table[$row->away]['points']+=1;
						$table[$row->away]['pe']+=1;
						$table[$row->away]['gf']+=$a;
						$table[$row->away]['gc']+=$h;
	    				if($row->schedule_id!=$last_schedule){
	    					$table_ant[$row->away]['points']+=1;
							$table_ant[$row->away]['pe']+=1;
							$table_ant[$row->away]['gf']+=$a;
							$table_ant[$row->away]['gc']+=$h;
						}
	    			}
				}
				//Si el Equipo visitante gana
				else{
					if($home){
						$table[$row->home]['pp']+=1;
						$table[$row->home]['gf']+=$h;
						$table[$row->home]['gc']+=$a;
						$table[$row->home]['gd']+=$h-$a;
						if($row->schedule_id!=$last_schedule){
							$table_ant[$row->home]['pp']+=1;
							$table_ant[$row->home]['gf']+=$h;
							$table_ant[$row->home]['gc']+=$a;
							$table_ant[$row->home]['gd']+=$h-$a;
						}
	    			}
	    			if($away){
	    				$table[$row->away]['points']+=3;
						$table[$row->away]['pg']+=1;
						$table[$row->away]['gf']+=$a;
						$table[$row->away]['gc']+=$h;
						$table[$row->away]['gd']+=$a-$h;
	    				if($row->schedule_id!=$last_schedule){
	    					$table_ant[$row->away]['points']+=3;
							$table_ant[$row->away]['pg']+=1;
							$table_ant[$row->away]['gf']+=$a;
							$table_ant[$row->away]['gc']+=$h;
							$table_ant[$row->away]['gd']+=$a-$h;
						}
	    			}
				}
			}
		}
		
		//Ordeno las dos tablas generadas
		foreach ($table as $key=>$arr):
			$pun[$key] = $arr['points'];
			$g1[$key] = $arr['gd'];
			$g2[$key] = $arr['gf'];
			$g3[$key] = $arr['gc'];	
		endforeach;
			
		array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$table);
		
		$pun=$g1=$g2=$g3=array();
		foreach ($table_ant as $key=>$arr):
			$pun[$key] = $arr['points'];
			$g1[$key] = $arr['gd'];
			$g2[$key] = $arr['gf'];
			$g3[$key] = $arr['gc'];	
		endforeach;
				
		array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$table_ant);
		
		//Reviso posiciones con la ultima fecha y cuanto se han movido
		foreach($table as $key=>$row){
			foreach($table_ant as $key2=>$row2){
				if($row['id']==$row2['id']){
					if($key>$key2){
						$table[$key]['change']=2;
						$table[$key]['updown']=abs($key-$key2);
					}
					if($key<$key2){
						$table[$key]['change']=0;
						$table[$key]['updown']=abs($key-$key2);
					}
				}	
			}
		}
		
		return $table;
	}

}
?>