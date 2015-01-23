<?php
class Championships_teams extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('team_id', 'Equipo', 'required');
		$this->form_validation->set_rules('bonus', 'Bonos', 'numeric');
		$this->load->library('Alert');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/championships_teams/index/'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM championships_teams where championship_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='20';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "EQUIPOS DEL CAMPEONATO ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT ct.id, c.name as cname, t.name as tname, ct.bonus, r.name as rname
										 FROM (championships_teams as ct) 
										 JOIN championships as c ON ct.championship_id = c.id and c.id=".$this->uri->segment(3)."
										 JOIN teams as t ON ct.team_id = t.id 
										 LEFT JOIN rounds as r ON ct.round_id = r.id
										 ORDER BY tname asc ".$pagina);
	    
	   $cn=$this->db->query("SELECT c.name
							  FROM championships as c
							  WHERE c.id=".$this->uri->segment(3))->result();
	    $data['from']=strtoupper($cn[0]->name);
	    
	    $this->view('championships_teams_view',$data);
	}	

	function insert()
	{
		$data['title'] = "EQUIPOS DEL CAMPEONATO ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($_POST['bonus']=='')
					$_POST['bonus']=0;
				if($_POST['round_id']=='')
					$_POST['round_id']=NULL;
				$this->db->insert('championships_teams', $_POST);
				redirect('championships_teams/index/'.$_POST['championship_id']);
			}	
		}
		$data['query2']=$this->db->query('SELECT *
										 FROM   (SELECT t.*, ct.id as ctid 
        										 FROM teams as t 
        										 LEFT JOIN championships_teams as ct 
        										 ON t.id=ct.team_id and ct.championship_id='.$this->uri->segment(3).') as tct
										 WHERE  ctid is null
										 ORDER BY tct.name ASC');
		$data['query3']=$this->db->query('SELECT id, name
										  FROM rounds as r
						 				  WHERE r.championship_id='.$this->uri->segment(3));
		$this->view('championships_teams_vinsert',$data);
	}
	
	function ajax_insert(){
		$this->load->model('team');
		
		unset($_POST['agregar']);
		$_POST['bonus']=0;
		$_POST['round_id']=NULL;
		$this->db->insert('championships_teams', $_POST);
		
		$team=current($this->team->get($_POST['team_id'])->result());
		$data['my_teams']=$this->team->get_teams_championship($_POST['championship_id'])->result();
        $data['championship']->id=$_POST['championship_id'];
        $data['anuncio']="El equipo '$team->name' ha sido agregado.";
		$this->load->view('championships_teams/ajax_view',$data);
	}
	
	function update(){
		$data['title']= "EQUIPOS DEL CAMPEONATO ";
		$data['heading']= "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($_POST['bonus']=='')
					$_POST['bonus']=0;
				if($_POST['round_id']=='')
					$_POST['round_id']=NULL;
				$this->db->where( 'id',$_POST['id']);
        		$this->db->update('championships_teams', $_POST); 
				redirect('championships_teams/index/'.$_POST['championship_id']);
			}	
		}
		$data['query']=$this->db->query('SELECT *
										 FROM championships_teams
										 WHERE id='.$this->uri->segment(3)); 	
		$ch=$data['query']->result();		
		$data['query2']=$this->db->query('SELECT *
										  FROM (SELECT *
										  		FROM   (SELECT t.*, ct.id as ctid 
        												FROM teams as t 
        										 		LEFT JOIN championships_teams as ct 
        										 		ON t.id=ct.team_id and ct.championship_id='.$this->uri->segment(4).') as tct
										  		WHERE  ctid is null
										  		UNION
										  		SELECT t.*, null as ctid
										  		FROM teams as t
										  		WHERE id='.$ch[0]->team_id.') as t
										  	ORDER BY t.name ASC');
		$data['query3']=$this->db->query('SELECT id, name
										  FROM rounds as r
						 				  WHERE r.championship_id='.$this->uri->segment(4));
		$this->view('championships_teams_vupdate',$data);
	}
	
	function delete(){
		$back=$this->session->flashdata('back');
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('championships_teams');

        if($back!=false)
        	redirect($back);
        else
			redirect('championships_teams/index/'.$this->uri->segment(4));
	}
	
	function ajax_delete(){
		$this->load->model('team');
		
		$item=$this->team->get_by_championship_teams($this->uri->segment(3));
		
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('championships_teams');
        
        $data['my_teams']=$this->team->get_teams_championship($this->uri->segment(4))->result();
        $data['championship']->id=$this->uri->segment(4);
        $data['anuncio']="El equipo '$item->name' ha sido borrado correctamente del Campeonato.";
		$this->load->view('championships_teams/ajax_view',$data);
	}
	
	
	
	function confirm_delete(){
		$this->load->view('championships_teams_confirm_delete');	
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
