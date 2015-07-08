<?php
class Actions extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', 'Acci&oacute;n', 'required');
		$this->form_validation->set_rules('type', 'Tipo', 'required');
		$this->form_validation->set_rules('match_time', 'Minuto', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/actions/index/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/';
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM actions where match_id = '.$this->uri->segment(3).' and team_id = '.$this->uri->segment(4))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='2';
		$config['uri_segment'] = '5';
		$this->pagination->initialize($config);
		$data['title'] = "ACCIONES ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		if(!$this->uri->segment(5)=='')
	    	$pagina="LIMIT ".$this->uri->segment(5)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT a.id, a.text, a.created, a.team_id, a.type, a.match_time, m.id as match_id, t.name tname, UNIX_TIMESTAMP(created) ucreated
										 FROM actions AS a, matches AS m, teams AS t
										 WHERE a.match_id = m.id AND m.id =".$this->uri->segment(3)." AND t.id = a.team_id AND t.id = ".$this->uri->segment(4).' 
										 ORDER BY match_time asc '.$pagina);
		$data['query2']=$this->db->query('SELECT m.id, mt.team_id_home, mt.team_id_away
						  				  FROM matches as m, matches_teams as mt
						                  WHERE m.id=match_id and match_id='.$this->uri->segment(3));
		$this->view('actions_view',$data);
	}	

	function insert()
	{
		$data['title'] = "ACCIONES ";
		$data['heading'] = "INGRESO";
		
		if(isset($_POST['submit'])){	
			$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert('actions', $_POST);
                //llamada para notificaciones
                notificacionMarcadorEnVivo ($_POST);
				redirect('actions/index/'.$_POST['match_id'].'/'.$_POST['team_id']);
		    }	
		}
		$this->view('actions_vinsert',$data);


	}

    function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('actions'); 
		redirect('actions/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
	}

	function confirm_delete(){
		$this->load->view('actions_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "ACCIONES ";
		$data['heading'] = "ACTUALIZAR";
		
		if(isset($_POST['submit'])){	
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
        		$this->db->update('actions', $_POST); 
        		redirect('actions/index/'.$_POST['match_id'].'/'.$_POST['team_id']);
		    }	
		}
		
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('actions');
		$this->view('actions_vupdate',$data);
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
