<?php
class Players_teams extends CI_Controller {
	
	var $folder_views;
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('player_id', 'Jugador', 'required');
		$this->form_validation->set_rules('date_in', 'Fecha Ingreso', '');
		$this->form_validation->set_rules('date_out', 'Fecha Salida', '');
		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
		
		$this->folder_views='players_teams';
		
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index()
	{
		$config['base_url']=base_url().'/players_teams/index/'.$this->uri->segment(3);
		$row=current($this->db->query('SELECT COUNT(*) AS numrows FROM players_teams where team_id = '.$this->uri->segment(3))->result());
		$config['total_rows']=$row->numrows;
		$config['per_page']=RESULT_PAGE;
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "JUGADORES DE EQUIPO ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query('SELECT pt.id, pt.player_id, p.first_name as pfname, p.last_name as plname, t.name as tname, pt.date_in, pt.date_out, UNIX_TIMESTAMP(date_in) Udate_in, UNIX_TIMESTAMP(date_out) Udate_out
						  				 FROM (players_teams as pt) 
						  				 JOIN players as p ON pt.player_id = p.id 
						  				 JOIN teams as t ON pt.team_id = t.id and t.id='.$this->uri->segment(3).' 
						  				 ORDER BY plname '.$pagina);
	    $cn=$this->db->query("SELECT t.name
							  FROM teams as t
							  WHERE t.id=".$this->uri->segment(3))->result();
	    $data['from']=strtoupper($cn[0]->name);
	    $this->view($this->folder_views.'/players_teams_view',$data);
	}	

	function insert()
	{
		$data['title'] = "JUGADORES DE EQUIPO ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			if($_POST['date_in']=='')
   				$_POST['date_in']=NULL;
   			if($_POST['date_out']=='')
   				$_POST['date_out']=NULL;
			$this->db->insert('players_teams', $_POST);
			redirect('players_teams/index/'.$_POST['team_id']);	
		}
		$data['query']=$this->db->query('SELECT *
										 FROM   (SELECT p.*, pt.id as ptid 
        										 FROM players as p 
        										 LEFT JOIN players_teams as pt 
        										 ON p.id=pt.player_id and pt.team_id='.$this->uri->segment(3).') as tct
										 WHERE  ptid is null
										 ORDER BY tct.last_name asc, tct.first_name asc');
		$this->view($this->folder_views.'/players_teams_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('players_teams'); 
		redirect('players_teams/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view($this->folder_views.'/players_teams_confirm_delete');	
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
}
?>