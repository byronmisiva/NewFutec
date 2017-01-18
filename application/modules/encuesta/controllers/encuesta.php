<?php
/*id de prueba 42665*/
if (isset($_SERVER['HTTP_ORIGIN'])) {
	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 86400');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
	header('Content-type: text/html; charset=utf-8');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}

class Encuesta extends MY_Controller
{
    public $model = 'mdl_encuesta';
    public function __construct(){
        parent::__construct();
    }
   
    public function consulta($id=FALSE){   
    	echo json_encode($this->mdl_encuesta->getEncuesta($id));        
    }
    
    function registroUserVotos(){
        echo "<pre>";
    	var_dump($_POST);
    	$posiciones = array(
    			"pos1" =>$_POST["pos1"],
    			"pos2" =>$_POST["pos2"],
    			"pos3" =>$_POST["pos3"],    			
    			"pos4" =>$_POST["pos4"],
    			"pos5" =>$_POST["pos5"],
    			"pos6" =>$_POST["pos6"],
    			"pos7" =>$_POST["pos7"],
    			"pos8" =>$_POST["pos8"],
    			"pos9" =>$_POST["pos9"],
    			"pos10" =>$_POST["pos10"],
    			"pos11" =>$_POST["pos11"]);
    	var_dump($posiciones);
    	die;
    	$this->mdl_encuesta->updateUserVotos($_POST["id"],$posiciones);    	
    }
    
    public function getSistema($sistema){
    	$data = "";
    	IF ($sistema == "0"){
    		return $this->load->view("administrador/sistema1",$data, FALSE);
    	}else if($sistema == "1"){
    		return $this->load->view("administrador/sistema2",$data, FALSE);
    	}else{
    		return $this->load->view("administrador/sistema3",$data, FALSE);
    	}
    }

   public function getEncuestaFlash($equipo){
   	echo $this->mdl_encuesta->getSumaEncuesta($equipo,"encuesta_fb");	
   }
   
   public function getEncuestaFlashTotal($equipo){
   	echo $this->mdl_encuesta->getEncuestaTotal($equipo,"encuesta_fb");
   }

    
    public function getSistemaFormacion($sistema){
    	$data = "";
    	IF ($sistema == "0"){
    		return $this->load->view("sistema1",$data, FALSE);
    	}else if($sistema == "1"){
    		return $this->load->view("sistema2",$data, FALSE);
    	}else{
    		return $this->load->view("sistema3",$data, FALSE);
    	}
    }
    
   public function getSistemaFormacionResultado($sistema){
    	$data = "";
    	IF ($sistema == "0"){
    		return $this->load->view("sistema1fin",$data, FALSE);
    	}else if($sistema == "1"){
    		return $this->load->view("sistema2fin",$data, FALSE);
    	}else{
    		return $this->load->view("sistema3fin",$data, FALSE);
    	}
    }

	public function consultaxEquipo($id)
    {   
    	echo json_encode($this->mdl_encuesta->getListaEquipo($id));        
    }
    
    function verificar(){        	    	
    	echo json_encode($this->mdl_encuesta->validarUsuario($_POST["mail"]));
    }
    
    function registro(){
    	$datos = array("nombre"=>$_POST["nombre"],
    			"mail"=>$_POST["mail"],
    			"telefono"=>$_POST["telefono"],
    			"encuesta_id"=>$_POST["encuesta"],
    	);
    	echo json_encode($this->mdl_encuesta->registrarUsuario($datos));
    }
    
    
    public function admin(){    	
    	$this->load->module('templates');
    	$this->load->view("administrador/index");
    }

    public function getFormulario(){
	$data["configuracion"]=$this->mdl_encuesta->getEncuestaActiva();  
	if ($data["configuracion"]->finaliza =="0"){
		return $this->load->view("index",$data, TRUE);
	//$this->load->view("index",$data);
	}else if ($data["configuracion"]->finaliza =="1"){
		$this->finalizarEncuesta();
	}


    }

    public function finalizarEncuesta(){
		$data["configuracion"]=$this->mdl_encuesta->getEncuestaActiva();
		return $this->load->view("resultado",$data);
	}
	

    public function creacioEncuesta(){    	
    	$id = $this->mdl_encuesta->insertEncuesta($_POST["encuesta"],$_POST["id_team"],$_POST["formacion"]);
    	foreach ($_POST["jugadores"] as $row){
    		$jugador = array(
    				"player_id"=>$row["player_id"],
    				"encuesta_id"=>$id,
    				"posicion"=>$row["posicion"]);  
    		$this->db->insert("lista_formacion",$jugador);
    	}   
    }

   public function listaNoticia($mes)
    {
	$this->load->module('contenido');
    	$this->load->module('noticias');
    	$data['lista'] = $this->noticias->viewLista($mes);
    	$this->load->view("lista",$data);
    }

    function insertEncuesta($nombre,$team,$formacion){
	  $data = array("nombre"=>$nombre,
	     	  "id_team"=>$team,
	          "formacion"=>$formacion);
   	$this->db->insert("encuesta_formacion",$data);	   	
   }

    public function pushVotos(){
    	$posiciones = array(
    			"pos1" =>$_POST["pos1"],
    			"pos2" =>$_POST["pos2"],
    			"pos3" =>$_POST["pos3"],
    			"pos4" =>$_POST["pos4"],
    			"pos5" =>$_POST["pos5"],
    			"pos6" =>$_POST["pos6"],
    			"pos7" =>$_POST["pos7"],
    			"pos8" =>$_POST["pos8"],
    			"pos9" =>$_POST["pos9"],
    			"pos10" =>$_POST["pos10"],
    			"pos11" =>$_POST["pos11"]);
/*    	$this->db->query("UPDATE registro_encuesta 
    			          SET posicion='".json_encode($posiciones).", encuesta_id=".$_POST["encuesta"]."' 
    					  WHERE id = ".$_POST["id"]);*/
        	
    	for ($x=1; $x<=count($posiciones);$x++){    		
    		$this->mdl_encuesta->sumVoto($posiciones["pos".$x], $x);
    	}
    	
    	$this->mdl_encuesta->sumRegistro($_POST["encuesta"]);
    	$dato["lista"][0]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos1");
    	$dato["lista"][1]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos2");
    	$dato["lista"][2]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos3");
    	$dato["lista"][3]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos4");
    	$dato["lista"][4]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos5");
    	$dato["lista"][5]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos6");
    	$dato["lista"][6]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos7");
    	$dato["lista"][7]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos8");
    	$dato["lista"][8]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos9");
    	$dato["lista"][9]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos10");
    	$dato["lista"][10]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos11");
    	echo json_encode($dato["lista"]);
    }
    
    
    function estadisticaEncuesta(){
    	$dato["lista"][0]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos1");
    	$dato["lista"][1]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos2");
    	$dato["lista"][2]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos3");
    	$dato["lista"][3]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos4");
    	$dato["lista"][4]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos5");
    	$dato["lista"][5]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos6");
    	$dato["lista"][6]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos7");
    	$dato["lista"][7]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos8");
    	$dato["lista"][8]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos9");
    	$dato["lista"][9]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos10");
    	$dato["lista"][10]=$this->mdl_encuesta->getLista($_POST["encuesta"],"pos11");
    	echo json_encode($dato["lista"]);
    }

   public function resultados(){
    	$dato["arquero"]=$this->mdl_encuesta->getLista("ARQ");
    	$dato["defensa"]=$this->mdl_encuesta->getLista("DEF");
    	$dato["volante"]=$this->mdl_encuesta->getLista("VOL");
    	$dato["delantero"]=$this->mdl_encuesta->getLista("DEL");
    	echo json_encode($dato);
    } 
    
    public function getResultado()
    {   $data = "";
    return $this->load->view("resultado",$data);
    }
    
}
