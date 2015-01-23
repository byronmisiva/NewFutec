<?php
class Minisite extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
		$this->load->model('survey');
		$this->load->model('teams_position');
		$this->load->model('match_calendary');
	}  
	
	function get_survey($sec){
		$query=$this->db->query('Select u.id,u.title, u.votes
								 From sections_surveys as ss, sections as e, surveys as u
								 Where e.id='.$sec.' and e.id=ss.section_id and ss.survey_id=u.id
								 Order by created desc')->result();
		$sur['id']=$query[0]->id;
		$sur['title']=$query[0]->title;
		$sur['votes']=$query[0]->votes;
		
		$query=$this->db->query('Select o.id, o.title
								 From surveys as s, options as o
								 Where o.survey_id=s.id and s.id='.$sur['id']);
		
		$response="<id>".$sur['id']."</id>
  				   <title>".$sur['title']."</title>
  				   <tot>".$sur['votes']."</tot>
				</encuesta>";
		

		
		$i=1;
		foreach($query->result() as $row):
			$response="<opcion>
   					 	<id>".$row->id."</id>
   						<texto>".$row->title."</texto>
  					  </opcion>".$response;
		endforeach;
		
		$response="<?xml version='1.0' standalone='yes'?>
				   <encuesta>".$response;
		
		return $response;
	}
	
	function insert_option($survey,$option){
		$this->survey->vote($survey,$option);
		$sur=$this->db->query("Select *
			  				   From surveys
			  				   Where id=".$survey)->result();
		
		$response="<?xml version='1.0' standalone='yes'?>
				   <encuesta>
				   		<total>".$sur[0]->votes."</total>";
		
		$query=$this->db->query('Select o.votes, o.title
								 From surveys as s, options as o
								 Where o.survey_id=s.id and s.id='.$sur[0]->id);
		
		foreach($query->result() as $row):
			$response=$response."<opcion>
   						<nombre>".$row->title."</nombre>
  						<porcentaje>".number_format(($row->votes*100)/$sur[0]->votes,2,'.',',')."</porcentaje>  
   					</opcion>";
		endforeach;
		$response=$response."</encuesta>";
		
		return $response;	
	}
	
	function position_teams($group){
		$tabla=$this->teams_position->get_tabla($this->teams_position->get_positions($group),$this->teams_position->get_teams($group),$this->teams_position->get_bonus($group));	
	
		$response="<?xml version='1.0' standalone='yes'?>
				   <posiciones>";
		
		$i=1;
		
		foreach($tabla as $row):
			 $response=$response.'<posicion posicion="'.$i.'" 
			 					   equipo="'.$row['name'].'" 
			 					   jugados="'.$row['PJ'].'" 
			 					   ganados="'.$row['PG'].'" 
			 					   empatados="'.$row['PE'].'" 
			 					   perdidos="'.$row['PP'].'" 
			 					   puntos="'.$row['P'].'" 
			 					   gol_diferencia="'.$row['GD'].'" 
			 					   id="'.$row['id'].'" />';
			 $i+=1;
	 	endforeach;
	 	$response=$response."</posiciones>";
	 	return $response;
	}
	
	function played_matches($championship,$num){
		$pm=$this->match_calendary->last_games($championship,$num);
		
		$response="<?xml version='1.0' standalone='yes'?>
				   <calendario>";
		
		foreach($pm as $row): 
	 		$response=$response.'<partido>
	 							 	<id value="'.$row['id'].'" />
	 							 	<fecha>'.$row['fecha'].'</fecha>
	 							 	<hora>'.$row['hora'].'</hora>
	 							 	<equipo estado="local">'.$row['hequipo'].'</equipo>
	 							 	<equipo estado="visitante">'.$row['aequipo'].'</equipo>
	 							 	<marcador>'.$row['marcador'].'</marcador>
	 							 	<jornada>'.$row['jornada'].'</jornada>
	 							 </partido>';
	 	endforeach;
	 	
	 	$response=$response.'</calendario>';
	 	
	 	return $response;
	}
	
	function next_matches($championship, $num){
		$nm=$this->match_calendary->next_games($championship, $num);
		
		$response="<?xml version='1.0' standalone='yes'?>
				   <proxima>";
		
		foreach($nm as $row):
			$response=$response.'<partido>
									<id value="'.$row['id'].'" />
									<fecha>'.$row['fecha'].'</fecha>
									<hora>'.$row['hora'].'</hora>
									<equipo estado="local">'.$row['hequipo'].'</equipo>
									<equipo estado="visitante">'.$row['aequipo'].'</equipo>
									<marcador>Sin jugar</marcador>
								</partido>';				
		endforeach;
		
		$response=$response.'</proxima>';
		return $response;
	}
	
	function all_matches($championship){
		$am=$this->match_calendary->championship_matches($championship);
		$response="<?xml version='1.0' standalone='yes'?>
				   <calendario>";
		$aux=0;
		$i=1;
		foreach($am as $row):
			$jor=$row['jornada'];
			if($row['marcador']=="" || $row['marcador']==NULL)
				$mar='Sin jugar';
			else
				$mar=$row['marcador'];
			
			if($aux==0)
				$aux=$jor;
			if($aux!=$jor){
				$i+=1;
				$aux=$jor;
			}
			
			$response=$response.'<partido>
									<id value="'.$row['id'].'" />
									<fecha>'.$row['fecha'].'</fecha>
									<hora>'.$row['hora'].'</hora>
									<equipo estado="local">'.$row['hequipo'].'</equipo>
									<equipo estado="visitante">'.$row['aequipo'].'</equipo>
									<marcador>'.$mar.'</marcador>
									<jornada>'.$i.'</jornada>
								</partido>';							
		endforeach;
		$response=$response.'</calendario>';
		return $response;
	}
	
  	function team_players_news($champ,$team,$num){
    	
    	$teams=$this->db->query('Select *
    							 From teams
    							 Where id='.$team)->result();
    	
    	$players=$this->db->query('Select p.first_name, p.last_name
    					 		   From teams as t, players as p, players_teams as pt
    					 		   Where t.id='.$team.' AND t.id=pt.team_id AND pt.player_id=p.id');
  		
    	$story=$this->db->query('Select o.*,i.*
	    					     From	(Select o.id, o.title,o.subtitle, o.lead, o.image_id, o.created
	    					  	 	     From teams as t, sections as s, categories as c, stories as o
	    					  	 	 	 Where t.id='.$team.' AND t.id=s.team_id AND s.category_id=c.id AND c.id=o.category_id
	    					  	 	 	 Order by o.created DESC
	    					  	 	 	 LIMIT 0,'.$num.') as o
	    					     LEFT JOIN images as i ON  o.image_id=i.id');
    	
    	$histories=$this->db->query('Select h.*
    								 From teams as t, histories as h
    								 Where t.id='.$team.' AND t.id=h.team_id')->result();
    	
    	$stadia=$this->db->query('Select s.*
    							  From teams as t, stadia as s
    							  Where t.id='.$team.' AND t.stadia_id=s.id')->result();
    	
    	$lstgame=$this->db->query('Select m.*,t1.name as t1name, t2.name as t2name, UNIX_TIMESTAMP(date_match) as dm
    							   From championships as c, rounds as r, groups as g, matches as m, matches_teams as mt, teams as t1, teams as t2
    							   Where c.id='.$champ.' AND c.id=r.championship_id AND
    							   		 r.id=g.round_id AND g.id=m.group_id AND
    							   		 m.id=mt.match_id AND mt.team_id_home=t1.id AND mt.team_id_away=t2.id AND (t1.id='.$team.' OR t2.id='.$team.')
    							   Order by m.date_match DESC');
    	
    	$request='<equipo>
    							<datos>
    								<nombre>'.$teams[0]->name.'</nombre>
    								<informacion>'.$histories[0]->palmares.'</informacion>
    								<escudo>'.$teams[0]->shield.'</escudo>
    								<miniescudo>'.$teams[0]->mini_shield.'</miniescudo>
    								<uniforme>'.$teams[0]->shirt.'</uniforme>
    								<entrenador>'.$teams[0]->couch.'</entrenador>
    								<simbolicos>'.$histories[0]->best_players.'</simbolicos>
    								<continente>'.$teams[0]->continent.'</continente>
    								<estadio>'.$stadia[0]->name.'</estadio>
    								<capacidad>'.$stadia[0]->capacity.'</capacidad>
    								<pais>'.$teams[0]->country.'</pais>
    							</datos>
    							<jugadores>';
    	
    	foreach($players->result() as $row):
    				$request=$request.'<nombre>'.$row->last_name.' '.$row->first_name.'</nombre>';
    	endforeach;
    	
    	$request=$request.'</jugadores><noticias>';
    	
    	foreach($story->result() as $row):
    				$request=$request.'<noticia>
    										<id>'.$row->id.'</id>
    										<title>'.$row->title.'</title>
    										<subtitle>'.$row->subtitle.'</subtitle>
    										<lead>'.$row->lead.'</lead>
    										<thumb640>'.$row->thumb640.'</thumb640>
    										<thumb400>'.$row->thumb400.'</thumb400>
    										<thumb300>'.$row->thumb300.'</thumb300>
    										<thumb150>'.$row->thumb150.'</thumb150>
    										<thumb100>'.$row->thumb100.'</thumb100>
    										<thumbh160>'.$row->thumbh160.'</thumbh160>
    										<thumbh120>'.$row->thumbh120.'</thumbh120>
    										<thumbh80>'.$row->thumbh80.'</thumbh80>
    										<thumbh50>'.$row->thumbh50.'</thumbh50>
    									</noticia>';
    	endforeach;
    	
    	$request=$request.'</noticias>
    					   <resultados>';
    	
    	foreach($lstgame->result() as $row):
	    	$request=$request.'<partido>
		    					   <local>'.$row->t1name.'</local>
		    					   <visitante>'.$row->t2name.'</visitante>
		    					   <marcador>'.$row->result.'</marcador>
		    					   <fecha>'.mdate("%d %M %Y",$row->dm).'</fecha>
		    					   <hora>'.mdate("%h:%i",$row->dm).'</hora>
	    					   </partido>';
    	endforeach;
    	
    	$request=$request.'</resultados></equipo>';
    	
        return $request;
    }
}
?>