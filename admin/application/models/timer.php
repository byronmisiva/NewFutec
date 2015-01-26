<?php 
class Timer extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
		$this->states=array(0=>'No Iniciado',1=>'Primer Tiempo',2=>'Fin del Primer Tiempo',3=>'Segundo Tiempo',4=>'Fin del Segundo Tiempo',
							5=>'Primer Extra',6=>'Segundo Extra',7=>'Penales',8=>'Final del Partido');
	}  

	function cal_time($match_id){
		$sts2=$this->db->query('SELECT state
							   FROM matches
							   WHERE id='.$match_id);
		if($sts2->num_rows()>0){
			$sts=$sts2->result();
			$ts=$sts[0]->state;
			$tbl=$this->db->query('SELECT id, match_id, UNIX_TIMESTAMP(time) as time, action, play_time
								   FROM timers
								   WHERE match_id='.$match_id.' AND play_time='.$sts[0]->state);
			$i=0;
			$rm=0;
			$rs=0;
			foreach($tbl->result() as $row):
				$i+=1;
				$tabla[$i]['m']=mdate('%i',$row->time);
				$tabla[$i]['s']=mdate('%s',$row->time);
			endforeach;
			if($i%2!=0){
				$i+=1;
				$tabla[$i]['m']=mdate('%i',time());
				$tabla[$i]['s']=mdate('%s',time());
			}									
			for($j=1; $j<$i; $j+=2){
				if($tabla[$j]['s']>$tabla[$j+1]['s']){
					$tabla[$j+1]['s']+=60;
					$tabla[$j+1]['m']-=1;
				}
				if($tabla[$j]['m']>$tabla[$j+1]['m']){
					$tabla[$j+1]['m']+=60;
				}
				$rm=$rm+$tabla[$j+1]['m']-$tabla[$j]['m'];
				$rs=$rs+$tabla[$j+1]['s']-$tabla[$j]['s'];
			}
			while($rs>59){
				$rs-=60;
				$rm+=1;
			}
			$t=2;
			$ts=0;
			if($tbl->num_rows()>0){
				$st=end($tbl->result());
				$t=$st->action;
			}
			if($sts2->num_rows()>0){
				$sts=$sts2->result();
				$ts=$sts[0]->state;
			}
			$ts2=$this->states[$ts];
			$response="	<minuto>$rm</minuto>
						<segundo>$rs</segundo>
	  					<estado>".$t."</estado> 
	  					<tiempo>".$ts2."</tiempo>"; //estado = estado de timer
			return $response;
		}	
	}	
	
	function cal_time_movil($match_id){
		$sts2=$this->db->query('SELECT state
							   FROM matches
							   WHERE id='.$match_id);
		if($sts2->num_rows()>0){
			$sts=$sts2->result();
			$ts=$sts[0]->state;
			$tbl=$this->db->query('SELECT id, match_id, UNIX_TIMESTAMP(time) as time, action, play_time
								   FROM timers
								   WHERE match_id='.$match_id.' AND play_time='.$sts[0]->state);
			$i=0;
			$rm=0;
			$rs=0;
			foreach($tbl->result() as $row):
				$i+=1;
				$tabla[$i]['m']=mdate('%i',$row->time);
				$tabla[$i]['s']=mdate('%s',$row->time);
			endforeach;
			if($i%2!=0){
				$i+=1;
				$tabla[$i]['m']=mdate('%i',time());
				$tabla[$i]['s']=mdate('%s',time());
			}									
			for($j=1; $j<$i; $j+=2){
				if($tabla[$j]['s']>$tabla[$j+1]['s']){
					$tabla[$j+1]['s']+=60;
					$tabla[$j+1]['m']-=1;
				}
				if($tabla[$j]['m']>$tabla[$j+1]['m']){
					$tabla[$j+1]['m']+=60;
				}
				$rm=$rm+$tabla[$j+1]['m']-$tabla[$j]['m'];
				$rs=$rs+$tabla[$j+1]['s']-$tabla[$j]['s'];
			}
			while($rs>59){
				$rs-=60;
				$rm+=1;
			}
			$t=2;
			$ts=0;
			if($tbl->num_rows()>0){
				$st=end($tbl->result());
				$t=$st->action;
			}
			if($sts2->num_rows()>0){
				$sts=$sts2->result();
				$ts=$sts[0]->state;
			}
			$ts2=$this->states[$ts];
			$time['minuto']=$rm;
			$time['segundo']=$rs;
			$time['estado']=$t;
			$time['tiempo']=$ts2;
			return $time;
		}	
	}	

}
?>