<?php
class Candidatas extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
		parent::Controller();
		$this->load->model('puntuacion','modelo');	
		$this->name='puntuaciones';
	}
	
	function insert(){
		$_POST['id']=0;
		$_POST['puntuacion']=$puntuacion;
		$_POST['usuario_id']=$usuario;
		$_POST['candidata_id']=$usuario;
		$this->modelo->asignar($_POST);
		
	}

}