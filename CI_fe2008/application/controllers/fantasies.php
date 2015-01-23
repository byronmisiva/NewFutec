<?php
class Fantasies extends CI_Controller {

	function __construct(){
		parent::__construct();
		/*$this->load->model('comment','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', 'Texto', 'required');
		$this->form_validation->set_rules('aproved', 'Estado', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		*/
		//Validacion ACL
		//$this->cizendacl->check_acl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function all(){}
	
}
?>