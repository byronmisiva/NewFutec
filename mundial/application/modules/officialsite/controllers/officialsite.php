<?php
class Officialsite extends MY_Controller{	
	
	public $model = FALSE;
	public $data = array();

	public function __construct(){
		parent::__construct();				
	}
	
	public function index(){	
		$this->equipos();
	}
	
	public function equipos(){			
		$this->load->module('equipos');		
		$this->load->module('templates');		
		$data['pageTitle'] = "Equipos";
		$data['body'] = $this->equipos->view();
		$this->templates->demoTemplate( $data );
	}
	
	public function estadios(){
		$this->load->module('estadios');
		$this->load->module('templates');
		$data['pageTitle'] = "Estadios";
		$data['body'] = $this->estadios->view();
		$this->templates->demoTemplate( $data );
	}
	
	public function historias(){
		$this->load->module('contenido');
		$this->load->module('templates');
		$data['pageTitle'] = "Historias";
		$data['body'] = $this->contenido->view_historia();
		$this->templates->demoTemplate( $data );
	}
}