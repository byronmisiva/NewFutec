<?php
Class Wcalendar extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}

	function calendar_all(){
		
		$this->config->set_item('compress_output', 'FALSE');
		$matches=$this->matches($this->uri->segment(3),$this->uri->segment(4));
		$teams=$this->all_team($this->uri->segment(3),$this->uri->segment(4));
		$tms='';
		$events='';
		foreach($teams->result() as $row):
			$tms[$row->id]=$row->name;
		endforeach;
		foreach($matches->result() as $row):
				$tst=date('Ymd',$row->dm+18000).'T'.date('His',$row->dm+18000).'Z';
				$tnd=date('Ymd',$row->dm+25200).'T'.date('His',$row->dm+25200).'Z';
				$sum=mb_convert_encoding($tms[$row->team_id_home].' vs '.$tms[$row->team_id_away], 'UTF-8','HTML-ENTITIES');
				$des=base_url().'matches/publica/'.$row->id;
				$id=$row->id;
				$stadia=$row->sname.' - '.$row->scity;
				$events .=<<<EVENT
				
BEGIN:VEVENT
DTSTART:$tst
DTEND:$tnd
DTSTAMP:$tst
UID:FEEVENT-$id
URL:$des
DESCRIPTION: $sum - futbolecuador.com
SUMMARY: $sum - futbolecuador.com
LOCATION:$stadia
CLASS:PUBLIC
END:VEVENT

EVENT;
		endforeach;
		$name=$this->names($this->uri->segment(3),$this->uri->segment(4))->name;
		$url=base_url();
		$now=date('Ymd',time()).'T'.date('His',time());
		$content = <<<CONTENT
BEGIN:VCALENDAR
PRODID:-//$name//NONSGML//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:{$name}
X-WR-TIMEZONE:America/Lima
X-WR-CALDESC: Calendario de {$name}
{$events}
END:VCALENDAR
CONTENT;
		$filename="test.ics";
		header("Mime-Version: 1.0");
		header("Content-type: text/calendar; charset=UTF-8");
		header("method=request;");
		header('Content-Disposition: attachment; filename="' . $filename .'"'); 							
		echo $content;
	}
	
	function matches($champ,$team){
		if($team===FALSE){
			return $this->db->query('Select m.id, UNIX_TIMESTAMP(m.date_match) as dm,mt.team_id_home, mt.team_id_away, s.name as sname, s.city as scity
						 		     From rounds as r, groups as g, matches as m, matches_teams as mt, stadia as s
						 		     Where '.$champ.'=r.championship_id
						   	   	       and r.id=g.round_id
								       and g.id=m.group_id
							   	       and m.id=mt.match_id
							   	       and s.id=m.stadia_id');	
		}
		else{
			return $this->db->query('Select m.id, UNIX_TIMESTAMP(m.date_match) as dm,mt.team_id_home, mt.team_id_away, s.name as sname, s.city as scity
				 		  			 From matches as m, matches_teams as mt, groups as g, rounds as r, championships as c,stadia as s
				 		  			 Where m.id=mt.match_id
				 		    		   and (mt.team_id_home='.$team.' or mt.team_id_away='.$team.')
				 		    		   and m.group_id=g.id
				 		    		   and g.round_id=r.id
				 		    		   and r.championship_id=c.id
				 		    		   and c.active_round!=0
				 		    		   and s.id=m.stadia_id');	
		}	
	}
	
	function all_team($champ,$team){
		if($team===FALSE){
			$whr=',championships_teams as ct Where '.$champ.'=ct.championship_id 
			        and ct.team_id=t.id';
		}
		else{
			$champ='Select championship_id as id 
	 				From championships_teams as ct
	 				Where team_id='.$team;
			$whr=',championships_teams as ct, ('.$champ.') as c2 Where ct.championship_id =c2.id 
			        and ct.team_id=t.id';
		}	
		return $this->db->query('Select distinct(t.id), t.name
								 From teams as t'.$whr);	
	
	}
	
	function names($champ,$team){
		if($team===FALSE){
			return $this->db->query('Select name
									 From championships 
									 Where id='.$champ)->row();
		}
		else{
			return $this->db->query('Select name
									 From teams 
									 Where id='.$team)->row();
		}
	}
} 
?>