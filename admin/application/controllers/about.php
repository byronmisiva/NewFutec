<?php
class About extends CI_Controller {
	
	var $folder_views;

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		
		$this->folder_views='about';
	}
	
	function index(){
		
	}
	
	function privacy(){
		$this->load->view($this->folder_views.'/privacy');
	}
}
?>