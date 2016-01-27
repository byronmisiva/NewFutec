<?php
class Gaco extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
	}    
	
	function matches_view($championship,$round){
		$data['gmatch']='';
		$data['lmatch']='';
				
		$query=$this->db->query('Select id
							     From rounds
						  		 Where championship_id='.$championship.' and last is NULL ')->row();			
		$i=0;         
		$start=$query->id;                                                                        
		$rounds[0]=$query->id;
		$aux=0;
		$match='';
		while($aux==0){
			$query=$this->db->query('Select id
									 From rounds
									 Where last='.$rounds[$i]);
			if($query->num_rows()!=0){
				$i+=-1;
				$r=$query->row();
				$rounds[$i]=$r->id;
			}
			else
				$aux=1;
		}
		$j=0; //round
		$z=0;
		$last=$rounds[$i];
		while($i!=0){
		
			$query=$this->db->query('Select gm.*
							     	 From gaco_matches as gm, groups as g
						  		 	 Where g.round_id='.$rounds[$i].' and g.id=gm.group_id');	
			
			if($query->num_rows()!=0 && $z==0){
				$z++;
				$last=$rounds[$i];
			}
			
			foreach($query->result() as $row):
				$hlp[$row->id]=$row->team_id_home.$row->team_id_away;
				$match[$row->team_id_home.$row->team_id_away]['id']=$row->id;
				$match[$row->team_id_home.$row->team_id_away]['th']=$row->team_id_home;
				$match[$row->team_id_home.$row->team_id_away]['ta']=$row->team_id_away;
				$match[$row->team_id_home.$row->team_id_away]['sth']=$row->sdt1;
				$match[$row->team_id_home.$row->team_id_away]['sta']=$row->sdt2;
				$match[$row->team_id_home.$row->team_id_away]['match']=$row->match_id;
				$match[$row->team_id_home.$row->team_id_away]['group']=$row->group_id;
				$match[$row->team_id_home.$row->team_id_away]['round']=$rounds[$i];	
				$match[$row->team_id_home.$row->team_id_away]['home_h']='';
				$match[$row->team_id_home.$row->team_id_away]['away_h']='';
				$match[$row->team_id_home.$row->team_id_away]['home_a']='';
				$match[$row->team_id_home.$row->team_id_away]['away_a']='';
				$match[$row->team_id_home.$row->team_id_away]['home']='';
				$match[$row->team_id_home.$row->team_id_away]['away']='';
				$match[$row->team_id_home.$row->team_id_away]['result']='';
				$match[$row->team_id_home.$row->team_id_away]['result2']='';
				$match[$row->team_id_home.$row->team_id_away]['result_h']='';
				$match[$row->team_id_home.$row->team_id_away]['result_a']='';
				$match[$row->team_id_home.$row->team_id_away]['result_h2']='';
				$match[$row->team_id_home.$row->team_id_away]['result_a2']='';
				
				if($row->sdt1==2){
					$tm=$this->db->query('Select name
									  	  From teams
									  	  Where id='.$row->team_id_home)->row();
					$match[$row->team_id_home.$row->team_id_away]['home_h']=$tm->name;
				}
				if($row->sdt2==2){
					$tm=$this->db->query('Select name
									  	  From teams
									  	  Where id='.$row->team_id_away)->row();
					$match[$row->team_id_home.$row->team_id_away]['away_a']=$tm->name;
				}
				if($row->match_id!=NULL){
					$tm=$this->db->query('Select t1.name as th, t2.name as ta, m.result 
									  	  From matches_teams as mt, teams as t1, teams as t2, matches as m
									  	  Where m.id=mt.match_id and mt.match_id='.$row->match_id.' and mt.team_id_home=t1.id and mt.team_id_away=t2.id')->row();
					$match[$row->team_id_home.$row->team_id_away]['home']=$tm->th;
					$match[$row->team_id_home.$row->team_id_away]['away']=$tm->ta;
					$match[$row->team_id_home.$row->team_id_away]['result']=$tm->result;
				}
				if($row->sdt1==1){
					$m=explode('_',$row->team_id_home);
					$tm=$this->db->query('Select t1.name as th, t2.name as ta, m.result, t1.id as thid, t2.id as taid, m.group_id
									  	  From matches_teams as mt, teams as t1, teams as t2, matches as m
									  	  Where mt.match_id='.$m[1].' and mt.team_id_home=t1.id and mt.team_id_away=t2.id and m.id=mt.match_id');
					if($tm->num_rows()>0){
						$tm=$tm->row();
						$match[$row->team_id_home.$row->team_id_away]['home_h']=$tm->th;
						$match[$row->team_id_home.$row->team_id_away]['away_h']=$tm->ta;
						$match[$row->team_id_home.$row->team_id_away]['result_h']=$tm->result;
						$tm=$this->db->query('Select m.result
										  	  From matches_teams as mt, matches as m
										  	  Where mt.team_id_away='.$tm->thid.' and mt.team_id_home='.$tm->taid.' and mt.match_id=m.id and m.group_id='.$tm->group_id);
						if($tm->num_rows()>0){
							$tm=$tm->row();
							$match[$row->team_id_home.$row->team_id_away]['result_h2']=$tm->result;
						}
					}					
				}
				if($row->sdt2==1){
					$m=explode('_',$row->team_id_away);
					$tm=$this->db->query('Select t1.name as th, t2.name as ta, m.result, t1.id as thid, t2.id as taid, m.group_id
									  	  From matches_teams as mt, teams as t1, teams as t2, matches as m
									  	  Where mt.match_id='.$m[1].' and mt.team_id_home=t1.id and mt.team_id_away=t2.id and m.id=mt.match_id');
					if($tm->num_rows()>0){
						$tm=$tm->row();
						$match[$row->team_id_home.$row->team_id_away]['home_a']=$tm->th;
						$match[$row->team_id_home.$row->team_id_away]['away_a']=$tm->ta;
						$match[$row->team_id_home.$row->team_id_away]['result_a']=$tm->result;
						$tm=$this->db->query('Select m.result
										  	  From matches_teams as mt, matches as m
										  	  Where mt.team_id_away='.$tm->thid.' and mt.team_id_home='.$tm->taid.' and mt.match_id=m.id and m.group_id='.$tm->group_id);
						if($tm->num_rows()>0){
							$tm=$tm->row();
							$match[$row->team_id_home.$row->team_id_away]['result_a2']=$tm->result;
						}
					}
					
				}
			endforeach;
			
			$i++;
		}
		
		if($match!=''){
			$matches=$match;
			$i=0;
			$j=0;
			$gmatch='';
			$lmatch='';
			$check=0;
			if($round!=FALSE)
				$last=$round;  //last_round
		
			foreach($matches as $row):
				if($row['round']==$last){
					$aux=explode('_',$row['th']);
					$aux2=explode('_',$row['ta']);
					if($aux[0]=='l' || $aux2[0]=='l'){
						if(isset($matches[$row['th'].$row['ta']]) && $matches[$row['th'].$row['ta']]['round']==$last){
							$lmatch[0][$j][0]=$matches[$row['th'].$row['ta']];
							unset($matches[$row['th'].$row['ta']]);
							$check++;
						}
						if(isset($matches[$row['ta'].$row['th']]) && $matches[$row['ta'].$row['th']]['round']==$last){
							$lmatch[0][$j][1]=$matches[$row['ta'].$row['th']];
							unset($matches[$row['ta'].$row['th']]);
							$check++;
						}
						if($check!=0){
							$j++;
							$check=0;
						}
					}
					else{
						if(isset($matches[$row['th'].$row['ta']]) && $matches[$row['th'].$row['ta']]['round']==$last){
							$gmatch[0][$i][0]=$matches[$row['th'].$row['ta']];
							unset($matches[$row['th'].$row['ta']]);
							$check++;
						}
						if(isset($matches[$row['ta'].$row['th']]) && $matches[$row['ta'].$row['th']]['round']==$last){
							$gmatch[0][$i][1]=$matches[$row['ta'].$row['th']];
							unset($matches[$row['ta'].$row['th']]);
							$check++;
						}
						if($check!=0){
							$i++;
							$check=0;
						}
					}	
				}
			endforeach;
			
			if($gmatch!=''){
				$gmatch=$this->codes($gmatch,$start);
				$k=0;
				foreach($gmatch[0] as $row):
					//$this->construir($row[0],1,$k,&$gmatch,&$matches,&$hlp);
					$this->construir($row[0],1,$k,$gmatch,$matches,$hlp);
					$k++;
				endforeach;
				if($lmatch!=''){
					$k=0;
					foreach($lmatch[0] as $row):
						//$this->construir($row[0],1,$k,&$lmatch,&$matches,&$hlp);
						$this->construir($row[0],1,$k,$lmatch,$matches,$hlp);
						$k++;
					endforeach;
					$lmatch=$this->matrix($lmatch);
				}
				$i=0;
				$col=count($gmatch);
				
				foreach($gmatch[$col-1] as $row):
					if($row[0]['home_h']!='' || $row[0]['away_h']!=''){ //$row[0]['home_h']!='' && $row[0]['away_h']!='' && $row[0]['result_h']!=''
						$gmatch[$col][$i][0]["id"]='';
			        	$gmatch[$col][$i][0]["th"]='';
			        	$gmatch[$col][$i][0]["ta"]='';
			        	$gmatch[$col][$i][0]["sth"]='';
			        	$gmatch[$col][$i][0]["sta"]='';
			        	$gmatch[$col][$i][0]["match"]='';
			        	$gmatch[$col][$i][0]["group"]='';
			        	$gmatch[$col][$i][0]["home_h"]='';
			        	$gmatch[$col][$i][0]["away_h"]='';
			        	$gmatch[$col][$i][0]["home_a"]='';
			        	$gmatch[$col][$i][0]["away_a"]='';
			        	$gmatch[$col][$i][0]["home"]=$row[0]['home_h'];
			        	$gmatch[$col][$i][0]["away"]=$row[0]['away_h'];
			        	$gmatch[$col][$i][0]["result"]=$row[0]['result_h'];
			        	if($row[0]['result_h2']!='')
			        		$gmatch[$col][$i][1]["result"]=$row[0]['result_h2'];
			        	$i++;
					}
					if($row[0]['home_a']!='' || $row[0]['away_a']!=''){
			        	$gmatch[$col][$i][0]["id"]='';
			        	$gmatch[$col][$i][0]["th"]='';
			        	$gmatch[$col][$i][0]["ta"]='';
			        	$gmatch[$col][$i][0]["sth"]='';
			        	$gmatch[$col][$i][0]["sta"]='';
			        	$gmatch[$col][$i][0]["match"]='';
			        	$gmatch[$col][$i][0]["group"]='';
			        	$gmatch[$col][$i][0]["home_h"]='';
			        	$gmatch[$col][$i][0]["away_h"]='';
			        	$gmatch[$col][$i][0]["home_a"]='';
			        	$gmatch[$col][$i][0]["away_a"]='';
			        	$gmatch[$col][$i][0]["home"]=$row[0]['home_a'];
			        	$gmatch[$col][$i][0]["away"]=$row[0]['away_a'];
			        	$gmatch[$col][$i][0]["result"]=$row[0]['result_a'];
			        	if($row[0]['result_a2']!='')
			        		$gmatch[$col][$i][1]["result"]=$row[0]['result_a2'];
						$i++;
					}
				endforeach;
				
				/*echo '<pre>';
				var_dump($gmatch);
				echo '</pre>';
				*/
				$gmatch=$this->matrix($gmatch);
				$data['gmatch']=$gmatch;
				$data['lmatch']=$lmatch;
				
			}
		}
		return $data;
	}
	
	function construir($match,$i,$j,$glmatch,$matches,$hlp){
		//home
		if(is_numeric($match['th']))
			$aux[1]=$match['th'];
		else
			$aux=explode('_',$match['th']);
		if(isset($hlp[$aux[1]]) && $match['sth']!=3){
			$glmatch[$i][(($j+1)*2)-2][0]=$matches[$hlp[$aux[1]]];
			if(isset($matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']])){
				$glmatch[$i][(($j+1)*2)-2][1]=$matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']];
				unset($hlp[$matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']]['id']]);
				unset($matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']]);
			}

			//$this->construir($matches[$hlp[$aux[1]]],$i+1,(($j+1)*2)-2,&$glmatch,&$matches,&$hlp);
			$this->construir($matches[$hlp[$aux[1]]],$i+1,(($j+1)*2)-2,	$glmatch,$matches,$hlp);
			unset($matches[$hlp[$aux[1]]]);
			unset($hlp[$aux[1]]);
		}
		
		//away
		if(is_numeric($match['ta']))
			$aux[1]=$match['ta'];
		else
			$aux=explode('_',$match['ta']);
		if(isset($hlp[$aux[1]]) && $match['sta']!=3){ 
			$glmatch[$i][(($j+1)*2)-1][0]=$matches[$hlp[$aux[1]]];
			if(isset($matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']])){
				$glmatch[$i][(($j+1)*2)-1][1]=$matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']];
				unset($hlp[$matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']]['id']]);
				unset($matches[$matches[$hlp[$aux[1]]]['ta'].$matches[$hlp[$aux[1]]]['th']]);
			}
			//$this->construir($matches[$hlp[$aux[1]]],$i+1,(($j+1)*2)-1,&$glmatch,&$matches,&$hlp);
			$this->construir($matches[$hlp[$aux[1]]],$i+1,(($j+1)*2)-1,$glmatch,$matches,$hlp);
			unset($matches[$hlp[$aux[1]]]);
			unset($hlp[$aux[1]]);
		}
	}
	
	function matrix($matches){
		$col=count($matches);
		$row=count($matches[$col-1]);
		$x=0;
		$last=0;
		for($i=0;$i<$col-1;$i++){
			for($j=$row-1;$j>0;$j--){
				if(isset($matches[$i][$j])){
					$matches[$i][pow(2,($col-1)-$i-$x)*$j]=$matches[$i][$j];
					unset($matches[$i][$j]);
				}
			}
		}
		return $matches;
	} 
	
	function codes($matches, $round){
		$query=$this->db->query('Select g.*
					 		     From groups as g
							     Where g.round_id='.$round);
		
		foreach($query->result() as $row):
			$groups[$row->id]=$row->name;
		endforeach;
		$i=0;
		foreach($matches[0] as $row):
			if($row[0]['sth']==3 && $row[0]['match']==''){
				if(is_numeric($row[0]['th']))
					$matches[0][$i][0]['home']=$row[0]['th'];
				else{
					$aux=explode('_',$row[0]['th']);
					$matches[0][$i][0]['home']=$aux[0].' '.$groups[$aux[1]];
				}
			}
			if($row[0]['sta']==3 && $row[0]['match']==''){
				if(is_numeric($row[0]['ta']))
					$matches[0][$i][0]['away']=$row[0]['ta'];
				else{
					$aux=explode('_',$row[0]['ta']);
					$matches[0][$i][0]['away']=$aux[0].' '.$groups[$aux[1]];
				}
			}
			$i++;
		endforeach;
		return $matches;
	}
}
?>