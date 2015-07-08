<?php
class Vivo extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('match');
	}
	
	function today(){
		$this->output->cache(3);
		
		$partidos=$this->match->getAllbyToday();
		$championships=array('28','30');
		
		$sxe = new SimpleXMLElement('<enVivo></enVivo>');
		$sxe->addAttribute('fecha', ucfirst(strftime('%A %d de %B')));
		
		$limite=2;
		$i=0;
		/*
		echo "<pre>";
		var_dump($partidos);
		echo "</pre>";
		*/
		if(is_array($partidos)){
			foreach($partidos as $key=>$partido){
				if(array_search($partido->championship_id,$championships)>0){
				
					if($limite==$i)
						break;
						
					$local=$partido->nlocal;
					$goles_local=$this->match->get_goals($partido->id,$partido->local);
					$visitante=$partido->nvisitante;
					$goles_visitante=$this->match->get_goals($partido->id,$partido->visitante);
					$penales_local="-";
					$penales_visitante="-";
					if($partido->resultado=="")
						$resultado="0 - 0";
					else
						$resultado=$partido->resultado;
						
					$aux=explode(' - ',$resultado);
					$resultado_local=$aux[0];
					$resultado_visitante=$aux[1];
					
					//Genero el XML
					$par = $sxe->addChild('partido');
					$fecha_par=explode(' ',$partido->fecha);
					$par ->addChild('fecha', $fecha_par[1]);
					
					$loc=$par->addChild('equipo');
					$loc->addAttribute('res',$resultado_local);
					$loc->addAttribute('pen',$penales_local);
					$loc->addAttribute('nombre',$local);
					
					if(is_array($goles_local)){
						foreach($goles_local as $gol){
							$g=$loc->addChild('gol');
							$g->addAttribute('jug',$gol->corto);
							$g->addAttribute('min',$gol->minuto);
							$g->addAttribute('tipo',$gol->tipo);
							$g->addAttribute('fallado',$gol->fallado);
						}
					}
					
					$vis=$par->addChild('equipo');
					$vis->addAttribute('res',$resultado_visitante);
					$vis->addAttribute('pen',$penales_visitante);
					$vis->addAttribute('nombre',$visitante);
					
					if(is_array($goles_visitante)){
						foreach($goles_visitante as $gol){
							$g=$vis->addChild('gol');
							$g->addAttribute('jug',$gol->corto);
							$g->addAttribute('min',$gol->minuto);
							$g->addAttribute('tipo',$gol->tipo);
							$g->addAttribute('fallado',$gol->fallado);
						}
					}
					$i++;
				}
			}
		}
		header('Content-type: text/xml');
		$data['xml']=$sxe->asXML();
		$this->load->view('vivo/today',$data);
		
	}
	
	function marcador(){
		$this->load->view('vivo/marcador');
	}
	
}