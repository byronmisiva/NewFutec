<?php
class Scoreboards extends CI_Controller {
	
	var $states;
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('timer');
		$this->load->model('match_calendary');
		$this->load->model('referee');
		$this->states=array(0=>'No Iniciado',1=>'Primer Tiempo',2=>'Fin del Primer Tiempo',3=>'Segundo Tiempo',4=>'Fin del Segundo Tiempo',
				5=>'Primer Extra',6=>'Segundo Extra',7=>'Penales',8=>'Final del Partido');
	}
	
	function matches_today(){				
		$imagenes = array();
		//$this->output->cache(CACHE_PARTIDOS);
		if( $this->config->item("encryption_key") == $this->uri->rsegment(3) ){
			$data['title']="Partidos de Hoy";
			$data['scores']=$this->match_calendary->today_matches();
			if( $data['scores'] == false ){
				$data['scores'] = $this->match_calendary->last_matches();
				$data['title'] = "Ultima Fecha";
			}			
			foreach ( $data['scores'] as $score ){
				array_push( $imagenes, $score->hshield );				
			}			 	
			$data['imagenes'] =  json_encode( $imagenes );			
			$this->load->view( 'scoreboards/scoreboards_live', $data );			
		}
	}
	
	function matches_today_open(){		
		//$this->output->cache(CACHE_PARTIDOS);
		if( $this->config->item("encryption_key") == $this->uri->rsegment(3) ){
			$this->load->view( 'scoreboards/scoreboards_open');
		}
	}
	
	function matches_today_magazine(){
		//$this->output->cache(CACHE_PARTIDOS);
		if( $this->config->item("encryption_key") == $this->uri->rsegment(3) ){
			$this->load->view( 'scoreboards/scoreboards_magazine');
		}
	}
	
	function list_matches(){
		$imagenes = array();
		//$this->output->cache(CACHE_PARTIDOS);
		if( $this->config->item("encryption_key") == $this->uri->rsegment(3) ){
			
			$data['fondo_partido']="imagenes/match_center/barra_azul.png";
			if($this->uri->rsegment(4) == 'magazine')
				$data['fondo_partido']="imagenes/match_center/barra_negra.png";
			
			$data['title']="Partidos de Hoy";
			$data['scores']=$this->match_calendary->today_matches();
			if( $data['scores'] == false ){
				$data['scores'] = $this->match_calendary->last_matches();
				$data['title'] = "Ultima Fecha";
			}
			foreach ( $data['scores'] as $score ){
				array_push( $imagenes, $score->hshield );
			}						
			$data['hora_cache'] = time();		
			$data['states'] = $this->states;	 
			$data['imagenes'] =  json_encode( $imagenes );
			$this->load->view( 'scoreboards/scoreboards_list', $data );
		}
	}
	
	function game_all(){
		//$this->output->cache(CACHE_PARTIDOS);
		$this->load->model('timer');
		$id = $this->uri->rsegment(3);
		
		if($this->config->item("encryption_key")==$this->uri->rsegment(4)){
		
			$partido=$this->db->query('SELECT m.state, m.id, m.group_id,m.schedule_id, UNIX_TIMESTAMP(m.date_match) as date, m.result, m.stadia_id, mt.team_id_home as hid, mt.team_id_away as aid 
									   FROM matches as m, matches_teams as mt
									   WHERE m.id ='.$id.' AND mt.match_id=m.id')->result();
			
			$cup=$this->db->query('Select c.name
									   From championships as c, rounds as r, groups as g
									   Where g.id='.$partido[0]->group_id.' AND g.round_id=r.id AND r.championship_id=c.id' )->result();
			
			$accion=$this->db->query('Select match_time, type, text
									  From actions
									  Where match_id='.$id.'
									  Order by match_time DESC');
			
			$arbitros=$this->referee->get_by_match($id);
			
			$jor=$this->db->query('Select s.season From schedules as s Where id='.$partido[0]->schedule_id);
			
			$jornada='';
			if($jor->num_rows()>0){
				$jorna=$jor->result();
				$jornada=$jorna[0]->season;
			}
			
			$home=$this->db->query('Select *
									From teams
									Where id='.$partido[0]->hid)->result();
			$away=$this->db->query('Select *
									From teams
									Where id='.$partido[0]->aid)->result();

			$sth=$this->db->query("SELECT SUM(IF(position='Defensa',1,0)) as d, SUM(IF(position='Volante',1,0)) as v, SUM(IF(position='Delantero',1,0)) as e
								   FROM lineups 
								   WHERE match_id=".$partido[0]->id." and team_id=".$partido[0]->hid." and (status=1 OR status=2)")->result();
			
			$sta=$this->db->query("SELECT SUM(IF(position='Defensa',1,0)) as d, SUM(IF(position='Volante',1,0)) as v, SUM(IF(position='Delantero',1,0)) as e
								   FROM lineups 
								   WHERE match_id=".$partido[0]->id." and team_id=".$partido[0]->aid." and (status=1 OR status=2)")->result();
			
			$tmhm=$this->db->query("SELECT p.first_name, p.last_name, p.nick, l.position, l.status, l.match_id, p.id, l.status %2 AS s,
										   if(l.position='Arquero',1,if(l.position='Defensa',2,if(l.position='Volante',3,4))) as pos
								    FROM players AS p, lineups AS l
								    WHERE p.id = l.player_id AND l.match_id =".$partido[0]->id." AND l.team_id=".$partido[0]->hid."
								    ORDER BY s DESC , pos ASC, p.last_name ASC, p.first_name ASC");
			
			$tmaw=$this->db->query("SELECT p.first_name, p.last_name, p.nick, l.position, l.status, l.match_id, p.id, l.status %2 AS s,
										   if(l.position='Arquero',1,if(l.position='Defensa',2,if(l.position='Volante',3,4))) as pos
								    FROM players AS p, lineups AS l
								    WHERE p.id = l.player_id AND l.match_id =".$partido[0]->id." AND l.team_id=".$partido[0]->aid."
								    ORDER BY s DESC , pos ASC, p.last_name ASC, p.first_name ASC");
			
			$ban=$this->db->query("Select file, image, width, height, link
								   From banners
								   Where module_id=38")->result(); //TODO: id de modulo quemado
			
			$tipo['cambio']=base_url().'imagenes/icons/mccambio.png';
			$tipo['falta']=base_url().'imagenes/icons/mcfalta.png';
			$tipo['gol']=base_url().'imagenes/icons/mcgol.png';
			$tipo['penal']=base_url().'imagenes/icons/mcpenal.png';
			$tipo['pitazo']=base_url().'imagenes/icons/mcpitazo.png';
			$tipo['tarjeta']=base_url().'imagenes/icons/mctarjeta.png';
			
			if($ban[0]->file==NULL)
				$banner="<imagen>".$ban[0]->image."</imagen>";
			else
				$banner="<archivo>".$ban[0]->file."</archivo>";	
			
			$this->config->load('config');
			if($partido[0]->result=="")
				$partido[0]->result="0 - 0";
			
			$aux=strpos(trim($partido[0]->result),'-');//TODO: -3600 delete
			$data['jornada'] = $jornada;
			$data['fecha'] = ucfirst(strftime('%B %d',$partido[0]->date));
			$data['hora'] = strftime('%H:%M',$partido[0]->date);
			$data['copa'] = $cup[0]->name;
			$data['arbitros'] = $arbitros;			
			$data['state'] = $partido[0]->state;
			$data['states'] = $this->states;			
			$data['Equipo1']['nombre'] = $home[0]->name;
			$data['Equipo1']['posicion'] = "Local";
			$data['Equipo1']['corto'] = $home[0]->short_name;
			$data['Equipo1']['escudo'] = base_url().$home[0]->shield;
			$data['Equipo1']['resultado'] = trim(substr(trim($partido[0]->result), 0, $aux-1));
			$data['Equipo1']['estrategia'] = $sth[0]->d."-".$sth[0]->v."-".$sth[0]->e;
			$data['Equipo1']['dt'] = $home[0]->couch;
			$data['Equipo1']['uniforme'] = base_url().$home[0]->shirt;
			$data['Equipo1']['Alineacion'] = array();
			foreach ( $tmhm->result() as  $key => $player ){
				$goles=$this->db->query('Select minute
						From goals
						Where match_id='.$partido[0]->id.' AND player_id='.$player->id);			
							
				$tarjetas=$this->db->query('Select minute, type
						From cards
						Where match_id='.$partido[0]->id.' AND player_id='.$player->id);
				$cambioe=$this->db->query('Select minute
						From changes
						Where match_id='.$partido[0]->id.' AND `in`='.$player->id);
				$cambios=$this->db->query('Select minute
						From changes
						Where match_id='.$partido[0]->id.' AND `out`='.$player->id);
				array_push( $data['Equipo1']['Alineacion'], array( 'jugador' => array(
						'nombre' => $player->last_name." ".$player->first_name,
						'corto' => $player->nick,
						'posicion' => $player->position,
						'titular' => ($player->status==1 || $player->status==3) ? TRUE : FALSE,
						'acciones' => array()										
						) ) );				
				
				foreach($goles->result() as $gol){
					$data['Equipo1']['Alineacion'][$key]['jugador']['acciones'][$gol->minute."_A"] = array(
						'tipo' => 'gol',
						'minuto' => $gol->minute,
						'imagen' => base_url().'imagenes/match_center/gol.png',
						'img_title' => 'Gol - '.$gol->minute."'" );					
				}
				
				foreach($tarjetas->result() as $card){
					if($card->type==1){
						$data['Equipo1']['Alineacion'][$key]['jugador']['acciones'][$card->minute."_B"] = array(
							'tipo' => 'tarjeta',
							'minuto' => $card->minute,
							'imagen' => base_url().'imagenes/match_center/amarilla.png',
							'img_title' => 'Tarjeta Amarilla - '.$card->minute."'" );
					}						
					else{
						$data['Equipo1']['Alineacion'][$key]['jugador']['acciones'][$card->minute."_B"] = array(
							'tipo' => 'tarjeta',
							'minuto' => $card->minute,
							'imagen' => base_url().'imagenes/match_center/roja.png',
							'img_title' => 'Tarjeta - Roja'.$card->minute."'" );						
					}						
				}				
				
				foreach($cambioe->result() as $che){
					$data['Equipo1']['Alineacion'][$key]['jugador']['acciones'][$che->minute."_C"] = array(
						'tipo' => 'entra',
						'minuto' => $che->minute,
						'imagen' => base_url().'imagenes/match_center/entra.png',
						'img_title' => 'Entra - '.$che->minute."'" );				
				}
								
				foreach($cambios->result() as $chs){					
					$data['Equipo1']['Alineacion'][$key]['jugador']['acciones'][$chs->minute."_D"] = array(
						'tipo' => 'sale',
						'minuto' => $chs->minute,
						'imagen' => base_url().'imagenes/match_center/sale.png',
						'img_title' => 'Sale - '.$chs->minute."'" );					
				}
				krsort( $data['Equipo1']['Alineacion'][$key]['jugador']['acciones'] );				
			}
			$data['Equipo2']['nombre'] = $away[0]->name;
			$data['Equipo2']['posicion'] = 'Visitante';
			$data['Equipo2']['corto'] = $away[0]->short_name;
			$data['Equipo2']['escudo'] = base_url().$away[0]->shield2;
			$data['Equipo2']['resultado'] = trim(mb_substr(trim($partido[0]->result), $aux+1));
			$data['Equipo2']['estrategia'] = $sta[0]->d."-".$sta[0]->v."-".$sta[0]->e;
			$data['Equipo2']['dt'] = $away[0]->couch;
			$data['Equipo2']['uniforme'] = base_url().$away[0]->shirt;
			$data['Equipo2']['Alineacion'] = array();
			foreach($tmaw->result() as $key => $player){
				$goles=$this->db->query('Select minute
						From goals
						Where match_id='.$partido[0]->id.' AND player_id='.$player->id);
				$tarjetas=$this->db->query('Select minute, type
						From cards
						Where match_id='.$partido[0]->id.' AND player_id='.$player->id);
				$cambioe=$this->db->query('Select minute
						From changes
						Where match_id='.$partido[0]->id.' AND `in`='.$player->id);
				$cambios=$this->db->query('Select minute
						From changes
						Where match_id='.$partido[0]->id.' AND `out`='.$player->id);
				
				array_push( $data['Equipo2']['Alineacion'], array( 'jugador' => array(
						'nombre' => $player->last_name." ".$player->first_name,
						'corto' => $player->nick,
						'posicion' => $player->position,
						'titular' => ($player->status==1 || $player->status==3) ? TRUE : FALSE,
						'acciones' => array()
				) ) );
				
				foreach($goles->result() as $gol){
					$data['Equipo2']['Alineacion'][$key]['jugador']['acciones'][$gol->minute] =  array(
						'tipo' => 'gol',
						'minuto' => $gol->minute,
						'imagen' => base_url().'imagenes/match_center/gol.png' );
				}
				
				foreach($tarjetas->result() as $card){
					if($card->type==1){
						$data['Equipo2']['Alineacion'][$key]['jugador']['acciones'][$card->minute] = array(
							'tipo' => 'tarjeta',
							'minuto' => $card->minute,
							'imagen' => base_url().'imagenes/match_center/amarilla.png',
							'img_title' => 'Tarjeta Amarilla - '.$card->minute."'" );
					}
					else{
						$data['Equipo2']['Alineacion'][$key]['jugador']['acciones'][$card->minute] = array(
							'tipo' => 'tarjeta',
							'minuto' => $card->minute,
							'imagen' => base_url().'imagenes/match_center/roja.png',
							'img_title' => 'Tarjeta roja - '.$card->minute."'" );
					}
				}
				
				foreach($cambioe->result() as $che){
					$data['Equipo2']['Alineacion'][$key]['jugador']['acciones'][$che->minute] = array(
							'tipo' => 'entra',
							'minuto' => $che->minute,
							'imagen' => base_url().'imagenes/match_center/entra.png',
							'img_title' => 'Entra - '.$che->minute."'" );
				}
				
				foreach($cambios->result() as $chs){
					$data['Equipo2']['Alineacion'][$key]['jugador']['acciones'][$chs->minute] = array(
						'tipo' => 'sale',
						'minuto' => $chs->minute,
						'imagen' => base_url().'imagenes/match_center/sale.png',
						'img_title' => 'Sale - '.$chs->minute."'" );
				}
				krsort( $data['Equipo2']['Alineacion'][$key]['jugador']['acciones'] );
			}
			
				
			$data['AccionesPtd'] = array();
			
			foreach( $accion->result() as $row ){
				if($row->type=='cambio' || $row->type=='falta' || $row->type=='gol' || $row->type=='penal' || $row->type=='pitazo' || $row->type=='tarjeta')
					$type=$tipo[$row->type];
				else
					$type=base_url().'imagenes/icons/arbitro.png';
				if($row->match_time!=200)
					$min=$row->match_time;
				else
					$min="--";
				
				array_push( $data['AccionesPtd'], array( 'accion' => array(
						'minuto' => $min,
						'tipo' => $type,
						'texto' => $row->text ) ) );				
			}
			$data['id'] = $id;	
			$aux = $this->timer->cal_time_movil($id);
			$data['minute_match'] = $aux['minuto'];  
			$data['hora_cache'] = time();		
			$data['fondo_partido']="imagenes/match_center/barra_azul.png";
			if($this->uri->rsegment(5) == 'magazine')
				$data['fondo_partido']="imagenes/match_center/barra_negra.png";
			$this->load->view('scoreboards/game_all',$data); 
		}
	}
}
?>