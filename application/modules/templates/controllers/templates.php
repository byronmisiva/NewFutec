<?php
class Templates extends MX_Controller{

	public function __construct(){
		parent::__construct();		
	}
	
	public function _index( $data = FALSE ){		
		$this->load->view( 'index', $data );
	}
	public function _indexcopa( $data = FALSE ){
		$this->load->view( 'indexcopa', $data );
	}

	public function _movil( $data = FALSE ){

		$this->load->view( 'indexmovil', $data );
	}


}