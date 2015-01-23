<?php 

class Matches_Calendary extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('match_calendary');
		$this->load->model('championship');
	}
	
	function publica(){
		$id=$this->uri->rsegment(3);
		if($id!=""){
			$this->load->model('section');
			//Defino primero el template publico para poder escribir ahi los modulos
			$this->template->set_template('public');
			$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
			$this->template->write('path',base_url(),TRUE);
			
			//centro
			
			$this->load->model('match_calendary');
			$this->load->model('team');
			$this->load->model('championship');
			$name=$this->championship->get($this->uri->rsegment(3))->row();
			$data['name']=$name->name;
			$data['query']=$this->match_calendary->matches_all($this->uri->rsegment(3));
			$data['teams']=$this->team->get_pics($this->uri->rsegment(3));
			$this->template->write_view('content', 'public/calendary_all', $data, FALSE);
			$this->template->write('metas','');
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			$modulos->set_modulos(0,'laterals');
			
			$this->template->render();
		}
		else
			redirect();	
	}
	
	function index(){
		
	}
	
	function matches_today(){
		
		$data['title'] = "PARTIDOS";
		$data['heading'] = " DE HOY";
		$data['query']=$this->match_calendary->matches_today($this->uri->rsegment(3));
		$this->view('matches_calendary_today_view',$data);
	}
	function matches_last(){
		$data['title'] = "PARTIDOS";
		$data['heading'] = " DE LA FECHA ANTERIOR";
		$data['query']=$this->match_calendary->matches_last_next($this->uri->rsegment(3),FALSE);
		$this->view('matches_calendary_today_view',$data);
	}
	function matches_next(){
		$data['title'] = "PARTIDOS";
		$data['heading'] = " DE LA SIGIUENTE FECHA";
		$data['query']=$this->match_calendary->matches_last_next($this->uri->rsegment(3),TRUE);
		$this->view('matches_calendary_today_view',$data);
	}
	function matches_all(){
		$name=$this->championship->get($this->uri->rsegment(3))->result();
		$name2=$name[0]->name;
		$data['id']=$this->uri->rsegment(3);
		$data['round']=$name[0]->active_round;
		$data['title'] = "PARTIDOS";
		$data['heading'] = " - ".$name2;
		$data['query']=$this->match_calendary->matches_all($this->uri->rsegment(3));
		$this->view('matches_calendary_today_view',$data);
	}
	
	function xml_matches_last(){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->rsegment(4)){
			$query=$this->match_calendary->matches_last_next($this->uri->rsegment(3),FALSE);
			$row=$query->first_row();
			header('Content-type: text/xml');
			$xml="<?xml version='1.0' standalone='yes'?>";
			$xml=$xml.'<siguiente>';
			$xml=$xml.'<campeonato>'.$row->cn.'</campeonato>';
			$xml=$xml.'<ronda>'.$row->rn.'</ronda>';
			$xml=$xml.'<nfecha>'.$row->sn.'</nfecha>';
			$xml=$xml.'<partidos>';
			foreach($query->result() as $row):
				$xml=$xml.'<partido>';
				$xml=$xml.'<grupo>'.$row->gn.'</grupo>';
				$xml=$xml.'<local>'.$row->hname.'</local>';
				$xml=$xml.'<visitante>'.$row->aname.'</visitante>';
				$goles=explode('-',$row->result);
				$xml=$xml.'<lgoles>'.trim($goles[0]).'</lgoles>';
				$xml=$xml.'<vgoles>'.trim($goles[1]).'</vgoles>';
				$xml=$xml.'<fecha>'.$row->date_match.'</fecha>';
				$xml=$xml.'<fecha2>'.$row->dm.'</fecha2>';
				$xml=$xml.'</partido>';
			endforeach;
			$xml=$xml.'</partidos>';
			$xml=$xml.'</siguiente>';
			
			echo $xml;
		}
	}
	
	function xml_matches_next(){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->rsegment(4)){
			$query=$this->match_calendary->matches_last_next($this->uri->rsegment(3),TRUE);
			$row=$query->first_row();
			header('Content-type: text/xml');
			$xml="<?xml version='1.0' standalone='yes'?>";
			$xml=$xml.'<siguiente>';
			$xml=$xml.'<campeonato>'.$row->cn.'</campeonato>';
			$xml=$xml.'<ronda>'.$row->rn.'</ronda>';
			$xml=$xml.'<nfecha>'.$row->sn.'</nfecha>';
			$xml=$xml.'<partidos>';
			foreach($query->result() as $row):
				$xml=$xml.'<partido>';
				$xml=$xml.'<grupo>'.$row->gn.'</grupo>';
				$xml=$xml.'<local>'.$row->hname.'</local>';
				$xml=$xml.'<visitante>'.$row->aname.'</visitante>';
				$goles=explode('-',$row->result);
				$xml=$xml.'<lgoles>'.trim($goles[0]).'</lgoles>';
				$xml=$xml.'<vgoles>'.trim($goles[1]).'</vgoles>';
				//$xml=$xml.'<fecha>'.$row->date_match.'</fecha>';
				$xml=$xml.'<fecha>'.$row->dm.'</fecha>';
				$xml=$xml.'</partido>';
			endforeach;
			$xml=$xml.'</partidos>';
			$xml=$xml.'</siguiente>';
			echo $xml;
		}
	}
	
	function xml_matches_by_team(){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->rsegment(4)){
			$matches=$this->match_calendary->matches_by_team($this->uri->rsegment(3));
			header('Content-type: text/xml');
			$xml="<?xml version='1.0' standalone='yes'?>";
			$xml=$xml.'<partidos>';
			foreach($matches->result() as $row):
				if($row->state==8){
					$xml=$xml.'<partido>';
					$xml=$xml.'<campeonato>'.$row->cname.'</campeonato>';
					$xml=$xml.'<ronda>'.$row->rname.'</ronda>';
					$xml=$xml.'<grupo>'.$row->gname.'</grupo>';
					$xml=$xml.'<local>'.$row->hname.'</local>';
					$xml=$xml.'<visitante>'.$row->aname.'</visitante>';
					$xml=$xml.'<fecha>'.$row->mdate.'</fecha>';
					$xml=$xml.'<estado>'.$row->state.'</estado>';
					$gol=explode('-',$row->result);
					$xml=$xml.'<lgoles>'.trim($gol[0]).'</lgoles>';
					$xml=$xml.'<vgoles>'.trim($gol[1]).'</vgoles>';
					$xml=$xml.'</partido>';
				}
			endforeach;
			$xml=$xml.'</partidos>';
			echo $xml;
		}
	}
	
	function xml_calendary_by_team(){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->rsegment(4)){
			$matches=$this->match_calendary->matches_by_team($this->uri->rsegment(3));
			header('Content-type: text/xml');
			$xml="<?xml version='1.0' standalone='yes'?>";
			$xml=$xml.'<partidos>';
			foreach($matches->result() as $row):
				$xml=$xml.'<partido>';
				$xml=$xml.'<campeonato>'.$row->cname.'</campeonato>';
				$xml=$xml.'<ronda>'.$row->rname.'</ronda>';
				$xml=$xml.'<grupo>'.$row->gname.'</grupo>';
				$xml=$xml.'<local>'.$row->hname.'</local>';
				$xml=$xml.'<visitante>'.$row->aname.'</visitante>';
				$xml=$xml.'<fecha>'.$row->mdate.'</fecha>';
				$xml=$xml.'<estado>'.$row->state.'</estado>';
				$gol=explode('-',$row->result);
				$xml=$xml.'<lgoles>'.trim($gol[0]).'</lgoles>';
				$xml=$xml.'<vgoles>'.trim($gol[1]).'</vgoles>';
				$xml=$xml.'</partido>';
			endforeach;
			$xml=$xml.'</partidos>';
			echo $xml;
		}
	}
	
	function xml_matches_by_month($month){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->rsegment(4)){
			$matches=$this->match_calendary->month_matches($month);
			
			header('Content-type: text/xml');
			$xml="<?xml version='1.0' standalone='yes'?>";
			$xml=$xml.'<partidos>';
			foreach($matches as $row):
				$xml=$xml.'<partido>';
				$xml=$xml.'<id>'.$row->id.'</id>';
				$xml=$xml.'<campeonato>'.$row->championship->name.'</campeonato>';
				$xml=$xml.'<local>'.$row->team_id_home->name.'</local>';
				$xml=$xml.'<visitante>'.$row->team_id_away->name.'</visitante>';
				$xml=$xml.'<fecha>'.$row->date_match.'</fecha>';
				$xml=$xml.'<estado>'.$row->state.'</estado>';
				$gol=explode('-',$row->result);
				$xml=$xml.'<lgoles>'.trim($gol[0]).'</lgoles>';
				$xml=$xml.'<vgoles>'.trim($gol[1]).'</vgoles>';
				$xml=$xml.'</partido>';
			endforeach;
			$xml=$xml.'</partidos>';
			echo $xml;
			
		}
		
	}
	

	function view($ver,$data)
	{
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
}
?>