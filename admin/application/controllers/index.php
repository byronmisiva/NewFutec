<?php
class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
	}
	
	function index_v()
	{
		$data['title'] = "INDEX ";
		$data['heading'] = "FE2009";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		$this->load->view('index_view',$data);
	}
}
?>