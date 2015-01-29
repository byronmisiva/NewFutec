<?php 

class Teams_Positions extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('teams_position','model');
		$this->load->model('statistic');
		$this->load->model('section');
		
	}
	
	function index()
	{
		$data['title'] = "TABLA DE ";
		$data['heading'] = " POSICIONES"; 
	   	$data['tabla']=$this->model->get_tabla($this->model->get_positions($this->uri->segment(3)),$this->model->get_teams($this->uri->segment(3)),$this->model->get_bonus($this->uri->segment(3)));	    
	    //$data['tabla']=$this->teams_position->get_tabla($this->teams_position->get_positions_total($this->uri->segment(3)),$this->teams_position->get_teams_total($this->uri->segment(3)));	    
	    $this->view('teams_positions_view',$data);
	}

	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function table_positions(){
		$this->load->model('group');
		
		$group=current($this->group->get($this->uri->segment(3))->result());
		
		$data['teams']=$this->section->get_teams();
		$data['tabla']=$this->model->get_table($this->uri->segment(3));
		$data['groups']=$this->group->get_by_round($group->round_id);
		$data['active']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/tabla_posiciones',$data); 
	}
	
	function get_table(){
		var_dump($this->model->get_table(87));
		
		var_dump('<br/><br/><br/><br/>');
		
		var_dump($this->model->get_table(88));
	}
	
	function xml_table(){
		if($this->config->item("encryption_key")==$this->uri->segment(4)){
			$this->load->model('group');
			$i=1;
			header('Content-type: text/xml');
			$xml="<?xml version='1.0' standalone='yes'?>";
			$xml=$xml.'<tablas>';
			$groups=$this->group->get_by_champ($this->uri->segment(3)); 
			$xml=$xml.'<grupos>';
			foreach($groups as $row):
				$xml=$xml.'<grupo>';
				$xml=$xml.'<nombre>'.$row->name.'</nombre>';
				$xml=$xml.'<tabla>';
				$gtable=$this->model->get_table($row->id);
				foreach($gtable as $row):
					$xml=$xml.'<posiciones>';
					$xml=$xml.'<posicion>'.$i.'</posicion>';
					$xml=$xml.'<equipo>'.$row['name'].'</equipo>';
					$xml=$xml.'<puntos>'.$row['points'].'</puntos>';
					$xml=$xml.'<pj>'.$row['pj'].'</pj>';
					$xml=$xml.'<pg>'.$row['pg'].'</pg>';
					$xml=$xml.'<pe>'.$row['pe'].'</pe>';
					$xml=$xml.'<pp>'.$row['pp'].'</pp>';
					$xml=$xml.'<gf>'.$row['gf'].'</gf>';
					$xml=$xml.'<gc>'.$row['gc'].'</gc>';
					$xml=$xml.'<gd>'.$row['gd'].'</gd>';
					$xml=$xml.'</posiciones>';
					$i++;
				endforeach;
				$xml=$xml.'</tabla>';
				$xml=$xml.'</grupo>';
			endforeach;
			$xml=$xml.'</grupos>';
			$xml=$xml.'<acumulativa>';
			$acumulativa=$this->model->get_table_by_champ($this->uri->segment(3));
			$i=1;
			$xml=$xml.'<tabla>';
			foreach($acumulativa as $row):
				$xml=$xml.'<posiciones>';
					$xml=$xml.'<posicion>'.$i.'</posicion>';
					$xml=$xml.'<equipo>'.$row['name'].'</equipo>';
					$xml=$xml.'<puntos>'.$row['points'].'</puntos>';
					$xml=$xml.'<pj>'.$row['pj'].'</pj>';
					$xml=$xml.'<pg>'.$row['pg'].'</pg>';
					$xml=$xml.'<pe>'.$row['pe'].'</pe>';
					$xml=$xml.'<pp>'.$row['pp'].'</pp>';
					$xml=$xml.'<gf>'.$row['gf'].'</gf>';
					$xml=$xml.'<gc>'.$row['gc'].'</gc>';
					$xml=$xml.'<gd>'.$row['gd'].'</gd>';
					$xml=$xml.'</posiciones>';
					$i++;
				endforeach;
			$xml=$xml.'</tabla>';	
			$xml=$xml.'</acumulativa>';
			$xml=$xml.'</tablas>';
			echo $xml;
		}	
	}
	
	function table_xml(){
		
		//$this->output->cache(CACHE_PARTIDOS);
		if($this->config->item("encryption_key")==$this->uri->segment(4)){
		
		$data['name']='XML Tabla de Posiciones';
		$data['views']=1;
		//$this->statistic->sum($data);		
			
		$group=$this->uri->segment(3);
		$data['tabla']=$this->model->get_tabla($this->model->get_positions($group),$this->model->get_teams($group),$this->model->get_bonus($group));
		
		header('Content-type: text/xml');
		//print $request;
		$this->load->view('xmls/teams_positions',$data); 
		}
	}
	
	function table_xml2(){
		//$this->output->cache(CACHE_PARTIDOS);
		if($this->config->item("encryption_key")==$this->uri->segment(4)){
		
		if($this->uri->segment(3)==='33')
			$championship=SERIE_A;
		else
			$championship=$this->uri->segment(3);
		
		$data['name']='XML Tabla de Posiciones';
		$data['views']=1;
		$data['tabla']=$this->model->get_table_by_champ($championship);
		header('Content-type: text/xml');
		$this->load->view('xmls/teams_positions2',$data); 		
		}
	}
}
?>