<?php 
class Sections_surveys extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('survey_id', 'Encuesta', 'required');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/sections_surveys/index/'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM sections_surveys where section_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "ENCUESTAS DE SECCI&Oacute;N ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query('SELECT s.name, sss.*
										 FROM sections as s , 
											  (SELECT ss.id as ssid, ss.survey_id as sssurvey_id, ss.section_id sssection_id, s.title as stitle 
											   FROM sections_surveys as ss, surveys as s
											   WHERE ss.survey_id= s.id) as sss
										 WHERE s.id = sss.sssection_id and s.id= '.$this->uri->segment(3).' 
										 ORDER BY stitle ASC '.$pagina);
		
		$this->view('sections_surveys_view',$data);
	}
	
	function insert()
	{
		$data['title'] = "ENCUESTAS DE SECCI&Oacute;N ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			$this->db->insert('sections_surveys', $_POST);
	    	redirect('sections_surveys/index/'.$_POST['section_id']);
		}
		$data['query']=$this->db->get('surveys');
		$this->view('sections_surveys_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('sections_surveys'); 
		redirect('sections_surveys/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('sections_surveys_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "ENCUESTAS DE SECCI&Oacute;N ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			$this->db->where('id',$_POST['id']);
   			$this->db->update('sections_surveys', $_POST);
	    	redirect('sections_surveys/index/'.$_POST['section_id']);	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']= $this->db->get('sections_surveys');
		$data['query2']=$this->db->get('surveys');
		$this->view('sections_surveys_vupdate',$data);
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