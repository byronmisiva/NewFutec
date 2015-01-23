<?php
class Options extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/options/index/'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM options where survey_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='12';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "OPCIONES ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT o.id,o.title,s.title as title2,o.votes 
						  				 FROM (options as o, surveys as s)
						 				 WHERE o.survey_id=s.id and s.id=".$this->uri->segment(3).' 
						 				 ORDER BY title '.$pagina);
		$this->view('options_view',$data);
	}	

	function insert()
	{
		$data['title'] = "OPCIONES ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	
			if($this->form_validation->run()==TRUE){    
				unset($_POST['submit']);
				$this->db->insert('options', $_POST);
	    		redirect('options/index/'.$_POST['survey_id']);
			}
		}
		$this->view('options_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('options'); 
		redirect('options/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('options_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "OPCIONES ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){	    
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
   				$this->db->update('options', $_POST);
   				redirect('options/index/'.$_POST['survey_id']);
			}
		}
		
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('options');
		$this->view('options_vupdate',$data);
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