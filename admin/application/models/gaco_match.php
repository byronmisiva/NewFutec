<?php
class Gaco_match extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
	}
	
	function delete($id){
		//var_dump($id);
		$row=$this->db->query('Select *
							   From gaco_matches
							   Where id='.$id)->row();
		$this->r_delete($id);
		$this->db->where( 'id',$id);
       	$this->db->delete('gaco_matches');
		if(!is_null($row->match_id)){
			$this->db->where( 'id',$row->match_id);
        	$this->db->delete('matches');
		}
	}
	
	function r_delete($id){
		$gaco=$this->db->query('Select gm.*
								From gaco_matches as gm
								Where team_id_home="g_'.$id.'" or team_id_home="l_'.$id.'" or team_id_away="g_'.$id.'" or team_id_away="l_'.$id.'"');

		foreach($gaco->result() as $row):
			//var_dump($row->id);
			$this->r_delete($row->id);
			$this->db->where( 'id',$row->id);
        	$this->db->delete('gaco_matches');
			if(!is_null($row->match_id)){
				$this->db->where( 'id',$row->match_id);
        		$this->db->delete('matches');
			}
		endforeach;
	}
	
	function get_matches($group){
		
		$gacos='';
		
		$row=$this->db->query('Select r.last, r.championship_id , r.id
							   From	groups as g, rounds as r
						 	   Where g.id='.$group.' and g.round_id=r.id')->row();
	
		if(!is_null($row->last)){
			$query=$this->db->query('Select g.id, g.name
							 	     From groups as g, rounds as r
								     Where r.id='.$row->last.' and g.round_id=r.id');
			
			$query2=$this->db->query('Select t.id, t.name
									  From championships_teams as ct, teams as t
									  Where ct.championship_id='.$row->championship_id.' and ct.team_id=t.id');
			
			$query3=$this->db->query('Select mt.*
									  From groups as g, matches as m, matches_teams as mt
									  Where (g.round_id='.$row->last.' or g.round_id='.$row->id.') and g.id=m.group_id and m.id=mt.match_id');
			
		
			
			$query4=$this->db->query('Select gm.id, gm.team_id_home, gm.team_id_away, gm.sdt1, gm.sdt2 , gm.gaco_id
									  From gaco_matches as gm
									  Where gm.group_id='.$group.'
									  Order by gm.id');
			
			
			foreach($query->result() as $row):
				$groups[$row->id]=$row->name;
			endforeach;
			
			foreach($query2->result() as $row):
				$teams[$row->id]=$row->name;
			endforeach;
			
			foreach($query3->result() as $row):
				$matches[$row->match_id]['th']=$row->team_id_home;
				$matches[$row->match_id]['ta']=$row->team_id_away;
			endforeach;
			
			
			
			foreach($query4->result() as $row):
				$gacos[$row->id]['id']=$row->id;
				$gacos[$row->id]['gaco']=$row->gaco_id;
				if($row->sdt1==2)
					$gacos[$row->id]['th']=$teams[$row->team_id_home];
				if($row->sdt2==2)
					$gacos[$row->id]['ta']=$teams[$row->team_id_away];
				if($row->sdt1==1){
					$aux=explode('_',$row->team_id_home);
					if(isset($matches[$aux[1]]))
						$gacos[$row->id]['th']=$teams[$matches[$aux[1]]['th']].' vs '.$teams[$matches[$aux[1]]['ta']];	
						
					else
						$gacos[$row->id]['th']=$aux[1];	
				}	
				if($row->sdt2==1){
					$aux=explode('_',$row->team_id_away);
					if(isset($matches[$aux[1]]))
						$gacos[$row->id]['ta']=$teams[$matches[$aux[1]]['th']].' vs '.$teams[$matches[$aux[1]]['ta']];
					else
						$gacos[$row->id]['ta']=$aux[1];
				}
				if($row->sdt1==3){
					if(is_numeric($row->team_id_home))
						$gacos[$row->id]['th']=$row->team_id_home;
					else{
						$aux=explode('_',$row->team_id_home);
						$gacos[$row->id]['th']=$aux[0].' '.$groups[$aux[1]];
					}
				}
				if($row->sdt2==3){
					if(is_numeric($row->team_id_away))
						$gacos[$row->id]['ta']=$row->team_id_away;
					else{
						$aux=explode('_',$row->team_id_away);
						$gacos[$row->id]['ta']=$aux[0].' '.$groups[$aux[1]];
					}
				}
			endforeach;
		}
		return $gacos;
	}
	
function generate_matches($group){
		$this->load->model('teams_position');
		
		$rnd=$this->db->query('Select r.last, r.id, r.championship_id
							   From groups as g, rounds as r
							   Where g.id='.$group.' and g.round_id=r.last')->row();
		
		$grp=$this->db->query('Select g.*
							   From groups as g
							   Where g.round_id='.$rnd->last);
		
		$rls=$this->gaco_rules($rnd->championship_id,$rnd->id);
		
		$mtc=$this->db->query('Select	 m.*, if(gm.id IS NULL, m.id, gm.id) as gm_id
							   From	    (Select m.id, m.result, mt.team_id_home, mt.team_id_away
			 	  					     From matches as m, matches_teams as mt, groups as g
			 	  					     Where g.round_id='.$rnd->last.' and g.id=m.group_id and m.id=mt.match_id and m.state!=0) as m
		 					   Left Join gaco_matches as gm on gm.match_id=m.id');
		
		$ts='';
		
		if($rls->type==1){	
			$match='';
			foreach($mtc->result() as $row):
				$res=explode('-',$row->result);
				$ts[$row->id]['id']=$row->id;
				$ts[$row->id]['gm_id']=$row->gm_id; 
				$ts[$row->id]['ph']=0;
				$ts[$row->id]['pa']=0;
				$ts[$row->id]['gdh']=trim($res[0])-trim($res[1]);
				$ts[$row->id]['gda']=trim($res[1])-trim($res[0]);
				$ts[$row->id]['gva']=trim($res[1]);
				$ts[$row->id]['th']=$row->team_id_home;
				$ts[$row->id]['ta']=$row->team_id_away;
				$ts[$row->id]['rel']='';	
				$match[$row->team_id_home.'_'.$row->team_id_away]=$row->id;
				if(trim($res[0])>trim($res[1])){
					$ts[$row->id]['ph']+=3;
				}
				if(trim($res[0])<trim($res[1])){
					$ts[$row->id]['pa']+=3;	
				}
				if(trim($res[0])==trim($res[1])){
					$ts[$row->id]['ph']+=1;
					$ts[$row->id]['pa']+=1;
				}
				if(isset($match[$row->team_id_away.'_'.$row->team_id_home])){
					$ts[$row->id]['rel']=$match[$row->team_id_away.'_'.$row->team_id_home];
					$ts[$match[$row->team_id_away.'_'.$row->team_id_home]]['rel']=$row->id;	
				}
			endforeach;
			
			
			if($rls->home_away==1 && $ts!=''){
				
				foreach($ts as $row):
					if($row['rel']=='')
						unset($ts[$row['id']]['rel']);
				endforeach;
				foreach($ts as $row):
					if(($row['ph']+$ts[$row['rel']]['pa'])>($row['pa']+$ts[$row['rel']]['ph'])){
						$tms['g_'.$row['gm_id']]['id']=$row['id'];
						$tms['g_'.$row['gm_id']]['t']=$row['th'];
						$tms['l_'.$row['gm_id']]['id']=$row['id'];
						$tms['l_'.$row['gm_id']]['t']=$row['ta'];
					}
						
					if(($row['ph']+$ts[$row['rel']]['pa'])<($row['pa']+$ts[$row['rel']]['ph'])){
						$tms['g_'.$row['gm_id']]['id']=$row['id'];
						$tms['g_'.$row['gm_id']]['t']=$row['ta'];
						$tms['l_'.$row['gm_id']]['id']=$row['id'];
						$tms['l_'.$row['gm_id']]['t']=$row['th'];	
					}	
					if(($row['ph']+$ts[$row['rel']]['pa'])==($row['pa']+$ts[$row['rel']]['ph'])){
						if(($row['gdh']+$ts[$row['rel']]['gda'])>($row['gda']+$ts[$row['rel']]['gdh'])){
							$tms['g_'.$row['gm_id']]['id']=$row['id'];
							$tms['g_'.$row['gm_id']]['t']=$row['th'];
							$tms['l_'.$row['gm_id']]['id']=$row['id'];
							$tms['l_'.$row['gm_id']]['t']=$row['ta'];	
						}
						if(($row['gdh']+$ts[$row['rel']]['gda'])<($row['gda']+$ts[$row['rel']]['gdh'])){
							$tms['g_'.$row['gm_id']]['id']=$row['id'];
							$tms['g_'.$row['gm_id']]['t']=$row['ta'];
							$tms['l_'.$row['gm_id']]['id']=$row['id'];
							$tms['l_'.$row['gm_id']]['t']=$row['th'];	
						}
						if(($row['gdh']+$ts[$row['rel']]['gda'])==($row['gda']+$ts[$row['rel']]['gdh'])){
							if($row['gva']>$ts[$row['rel']]['gva']){
								$tms['g_'.$row['gm_id']]['id']=$row['id'];
								$tms['g_'.$row['gm_id']]['t']=$row['ta'];
								$tms['l_'.$row['gm_id']]['id']=$row['id'];
								$tms['l_'.$row['gm_id']]['t']=$row['th'];
							}
							if($row['gva']<$ts[$row['rel']]['gva']){
								$tms['g_'.$row['gm_id']]['id']=$row['id'];
								$tms['g_'.$row['gm_id']]['t']=$row['th'];
								$tms['l_'.$row['gm_id']]['id']=$row['id'];
								$tms['l_'.$row['gm_id']]['t']=$row['ta'];		
							}
						}		
					}
				endforeach;
			}
			
			if($rls->home_away==0 && $ts!=''){
				foreach($ts as $row):
					if($row['ph']>$row['pa']){
						$tms['g_'.$row['gm_id']]['id']=$row['id'];
						$tms['g_'.$row['gm_id']]['t']=$row['th'];
						
						$tms['l_'.$row['gm_id']]['id']=$row['id'];
						$tms['l_'.$row['gm_id']]['t']=$row['ta'];
					}
					if($row['ph']<$row['pa']){
						$tms['g_'.$row['gm_id']]['id']=$row['id'];
						$tms['g_'.$row['gm_id']]['t']=$row['ta'];
						
						$tms['l_'.$row['gm_id']]['id']=$row['id'];
						$tms['l_'.$row['gm_id']]['t']=$row['th'];		
					}
				endforeach;
				
			}
			$gm=$this->db->query('Select * 
									  From gaco_matches
									  Where gaco_id='.$rls->id);
			foreach($gm->result() as $row):
				$aux=0;
				if($row->sdt1==1)
					if(isset($tms[$row->team_id_home]['t'])){
						$data2['team_id_home']=$tms[$row->team_id_home]['t'];
					}
					else
						$aux=1;
				else
					$data2['team_id_home']=$row->team_id_home;
				if($row->sdt2==1)
					if(isset($tms[$row->team_id_away]['t'])){	
						$data2['team_id_away']=$tms[$row->team_id_away]['t'];
					}
					else
						$aux=1;
				else
					$data2['team_id_away']=$row->team_id_away;
				
				if($aux==0){	
					$data['id']=$row->match_id;
					$data['group_id']=$row->group_id;
					$data['date_match']=$row->date_match;
					$data['state']=$row->state;
					$data['minute_match']=$row->minute_match;
					$data['result']='0 - 0';
					$data['stadia_id']=$row->stadia_id;
					$data['story_id']='0';
					$data['schedule_id']=$row->schedule_id;
					$data['live']=$row->live;
					$data['special']=$row->special;
					$data3['referee_id_central']=$row->referee_id_central;
		   			$data3['referee_id_line1']=$row->referee_id_line1;
		   			$data3['referee_id_line2']=$row->referee_id_line2;
		   			$data3['referee_id_sub']=$row->referee_id_sub;
					if(is_null($data['id'])){
		   				$data['id']=0;
		   				$this->insert_matches($data,$data2,$data3,$row->id);
		   			}
		   			else{
		   				$this->update_matches($data,$data2);
		   			}
				}
			endforeach;			
		}
		
		if($rls->type==2){
			$pass=$rls->num_pass;
			$best=$rls->num_best;
			$pas=$pass;
			if($best==0)
				$pas=$pass+1;
			if($rls->list==1){
				$arr='';
				$j=1;				
				foreach($grp->result() as $row):
					$tbl=$this->teams_position->get_table($row->id);
					for($i=1;$i<$pas;$i++){
						$teams[$i][$j]=$tbl[$i-1];
					}
					$teams[$pas][$j]=$tbl[$pas-1];
					$j++;
				endforeach;
				
				for($i=1;$i<=$pas;$i++){
					foreach ($teams[$i] as $key=>$arr):
						$pun[$i][$key] = $arr['points'];
						$g1[$i][$key] = $arr['gd'];
						$g2[$i][$key] = $arr['gf'];
						$g3[$i][$key] = $arr['gc'];	
					endforeach;
					array_multisort($pun[$i],SORT_DESC,$g1[$i],SORT_DESC,$g2[$i],SORT_DESC,$g3[$i],SORT_ASC,$teams[$i]);
				}     
				$tms='';
				$j=1;
				$i=1;
				for($i=1;$i<$pas;$i++){	
					foreach($teams[$i] as $row):
						$tms[$j]=$row;
						$j++;
					endforeach;
				}
				$i=0;
				foreach($teams[$pas] as $row):
					if($i<$best){		
						$tms[$j]=$row;
						$j++;
						$i++;
					}			
				endforeach;
				$aux=count($tms);
				$j=$aux/2;
			}
			else{
				$j=1;
				$pas=$pass;
				if($best==0)
					$pas=$pass+1;
				foreach($grp->result() as $row):
					$tbl=$this->teams_position->get_table($row->id);
					for($i=1;$i<$pas;$i++){
						$tms[$i.'_'.$row->id]=$tbl[$i-1];
					}
					$teams_b[$j]=$tbl[$pas-1];
					$j++;
				endforeach;
				foreach ($teams_b as $key=>$arr):
					$pun[$key] = $arr['points'];
					$g1[$key] = $arr['gd'];
					$g2[$key] = $arr['gf'];
					$g3[$key] = $arr['gc'];	
				endforeach;
				array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$teams_b);
				for($i=0;$i<$best;$i++){
					$j=$i+1;
					$tms[$j.'_b_'.$pass]=$teams_b[$i];
				}
			}
			$gm=$this->db->query('Select * 
									  From gaco_matches
									  Where gaco_id='.$rls->id);
			foreach($gm->result() as $row):
				if($row->sdt1==3)
					$data2['team_id_home']=$tms[$row->team_id_home]['id'];
				else
					$data2['team_id_home']=$row->team_id_home;
				if($row->sdt2==3)
					$data2['team_id_away']=$tms[$row->team_id_away]['id'];
				else
					$data2['team_id_away']=$row->team_id_away;
				$data['id']=$row->match_id;
				$data['group_id']=$row->group_id;
				$data['date_match']=$row->date_match;
				$data['state']=$row->state;
				$data['minute_match']=$row->minute_match;
				$data['result']='0 - 0';
				$data['stadia_id']=$row->stadia_id;
				$data['story_id']='0';
				$data['schedule_id']=$row->schedule_id;
				$data['live']=$row->live;
				$data['special']=$row->special;			
				$data3['referee_id_central']=$row->referee_id_central;
	   			$data3['referee_id_line1']=$row->referee_id_line1;
	   			$data3['referee_id_line2']=$row->referee_id_line2;
	   			$data3['referee_id_sub']=$row->referee_id_sub;
	   			if(is_null($data['id'])){
	   				$data['id']=0;
	   				$this->insert_matches($data,$data2,$data3,$row->id);
	   			}
	   			else{
	   				$this->update_matches($data,$data2);
	   			}
			endforeach;
		}
	}
	
	function gaco_rules($champ,$round){
		$query=$this->db->query('Select *
						  		 From gaco
						  		 Where championship_id='.$champ);
		foreach($query->result() as $row):
			if($this->gaco_inside($row->start_round, $row->end_round,$round)){
				return $row;
			}
		endforeach;
	}
	
	function gaco_inside($start,$end,$round){
		$i=0;
		if($start==$end)
			$i=-1;
		else{
			if($end==$round)
				$i=1;
			if($start==$round)
				$i=-1;
		}
		while($i==0){
			$row=$this->db->query('Select last
								   From rounds
							  	   Where id='.$end)->row();
			if($row->last==$start)
				$i=-1;
			else{
				if($row->last==$round)
					$i=1;
				if($row->last==0)
					$i=-1;
			}		
			$end=$row->last;
		}
		if($i==1)
			return true;
		else
			return false;
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