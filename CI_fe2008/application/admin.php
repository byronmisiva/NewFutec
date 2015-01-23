<?php
class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('story');
		$this->load->model('comment');
		$this->load->model('match_calendary');
		$this->load->model('flash');
		//$this->load->model('match');
		//$this->load->model('instant');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		//Validacion ACL
		
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('users/login');
		}
	}
	
	function index(){
		
		$this->db->close();
    	$this->load->database('admin');
		$data['title'] = "Administrador ";
		$data['heading'] = "";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['stories']=$this->story->get_limit(8);
	    $data['sponsored']=$this->story->get_sponsored(array(),'6');
		$data['matches']=$this->match_calendary->matches_today('');
		//$data['flash']=$this->flash->get_today(10);
	    $this->view('admin/view',$data);
	    
	}	

	function view($ver,$data){
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
}
?>