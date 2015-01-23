<?php 

class Goals_Positions extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('goals_position');
	}
	
   function publica(){
		$id=$this->uri->rsegment(3);
		if($id!=""){
			$this->load->model('section');
			$this->load->model('championship');
			//Defino primero el template publico para poder escribir ahi los modulos
			$this->template->set_template('public');
			$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
			$this->template->write('path',base_url(),TRUE);
			
			//centro
			$data['query']=$this->goals_position->get_strikers($this->uri->rsegment(3),0);
			$dts=$this->championship->get($this->uri->rsegment(3))->row();
			$data['name']=$dts->name;
			$this->template->write_view('content', 'public/striker_all', $data, FALSE);
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			$modulos->set_modulos(0,'laterals');
			
			//Cargo las noticias rotativas
			$this->load->model('story');
			$data['query']=$this->story->get_banner(5);
			$data['check']=0;
			$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
			
			$this->template->render();
		}
		else
			redirect();	
	}
	
	function index()
	{
		$data['title'] = "TABLA DE ";
		$data['heading'] = " GOLEADORES";
	    $data['query']=$this->goals_position->get_strikers($this->uri->rsegment(3));
	    $this->view('goals_positions_view',$data);
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