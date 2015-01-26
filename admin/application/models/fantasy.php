<?php
class Fantasy extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='flashes';
        
        //Por jugar
		$fantasy['play']=1;
		//Jugar m�s de 60 minutos
		$fantasy['play_more']=1;
		//Gol de Arquero o Defensa
		$fantasy['gol_1']=6;
		//Gol de Volante
		$fantasy['gol_2']=5;
		//Gol de Delantero
		$fantasy['gol_3']=4;
		//0 Goles recividos
		$fantasy['gol_no']=4;
		//Penal a Favor
		$fantasy['penal_s']=1;
		//Penal en Contra
		$fantasy['penal_n']=-2;
		//Por cada Gol Recibido
		$fantasy['receive']=0.5;
		//Por cada tarjeta Amarilla 
		$fantasy['card_1']=-1;
		//Por cada Tarjeta Roja
		$fantasy['card_2']=-3;
		//Por cada Cambio Extra
		$fantasy['change_extra']=-2;
	}    
	
	function calculate_match(){
		$match=$this->uri->segment(3);
		
		/*$this->load->model('timer');
		$time=$this->timer->cal_time_movil*/
		
		$lineup=$this->db->query('Select l.*, p.position as tpos
						  		   From lineups as l, players as p
						  		   Where l.id='.$match.' and l.player_id=p.id');
		$goal=$this->db->query('Select *
						  		 From goals as g
						  		 Where g.id='.$match);
		$change=$this->db->query('Select * 
						  		   From changes as h
						  		   Where h.id='.$match);
		$card=$this->db->query('Select *
						  		 From cards as a
						  		 Where a.id='.$match);
		
		$goals='';
		$in='';
		$out='';
		$cards='';
		$lineups='';
		$pos['Arquero']='1';
		$pos['Defensa']='1';
		$pos['Volante']='2';
		$pos['Delantero']='3';
		$teams='';
		
		
		foreach($goal->result() as $row):
			if(isset($goals[$row->player_id]))
				$goals[$row->player_id]++;
			else
				$goals[$row->player_id]=1;
			if(isset($teams[$row->team_id]))
				$teams[$row->team_id]++;
			else
				$teams[$row->team_id]=1;
			$goals[$row->team_id]++;
		endforeach;
		
		foreach($change->result() as $row):
			$in[$row->player_id]=$row->minute;
			$out[$row->player_id]=$row->minute;
		endforeach;
		
		foreach($card->result() as $row):
			if($row->type==1)
				$cards[$row->player_id][1]=$row->type;
			else
				$cards[$row->player_id][2]=$row->type;
				if(!isset($out[$row->player_id]))
					$out[$row->player_id]=$row->minute;
		endforeach;
		
		foreach($lineup->result() as $row):
			$lineups[$row->player_id]['id']=$row->player_id;
			$lineups[$row->player_id]['tpos']=$pos[$row->tpos];
			$lineups[$row->player_id]['points']=0;
			if(isset($goals[$row->player_id]))
				$lineups[$row->player_id]['points']+=($fantasy['gol_'.$pos[$row->tpos]]*$goals[$row->player_id]);
			if($row->status!=0)
				$lineups[$row->player_id]['points']+=$fantasy['play'];
			if($row->status==1)
				$lineups[$row->player_id]['points']+=$fantasy['play_more'];
			if($row->status>1)
				if(isset($change[$row->player_id]))
					if($row->status==2)
						if((90-$in[$row->player_id])>60)
							$lineups[$row->player_id]['points']+=$fantasy['play_more'];
					else{
						if($row->status==3)
							if(($out[$row->player_id])>60)
								$lineups[$row->player_id]['points']+=$fantasy['play_more'];
						else
							if(($out[$row->player_id]-$in[$row->player_id])>60)
								$lineups[$row->player_id]['points']+=$fantasy['play_more'];
					}
			if(isset($cards[$row->player_id][1]))
				$lineups[$row->player_id]['points']+=($fantasy['card_1']*$cards[$row->player_id][1]);
			if(isset($cards[$row->player_id][2]))
				$lineups[$row->player_id]['points']+=($fantasy['card_2']*$cards[$row->player_id][2]);
			if($teams[$row->team_id]==0)
				$lineups[$row->player_id]['points']+=$fantasy['gol_no'];
			else
				$lineups[$row->player_id]['points']+=$teams[$row->team_id]*$fantasy['receive'];
		endforeach;
	}
	
	
	
	
}
?>