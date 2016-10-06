<?php

class Encuesta extends MY_Controller
{
    public $model = 'mdl_encuesta';
    public function __construct()
    {
        parent::__construct();
    }
   
    public function consulta()
    {   
    	echo json_encode($this->mdl_encuesta->getEncuesta());        
    }
    
    public function getFormulario()
    {   $data["formacion"] = "";
    	//return $this->load->view("index",$data, TRUE);
    	return $this->load->view("resultado",$data, TRUE);
    }
    
    public function getResultado()
    {   $data = "";
    //return $this->load->view("resultado",$data, TRUE);
       return $this->load->view("resultado",$data, TRUE);
    }
    
    public function listaNoticia($mes,$year)
    {    	
    	$this->load->module('contenido');
    	$this->load->module('noticias');
    	$data['lista'] = $this->noticias->viewLista($mes,$year);
    	$this->load->view("lista",$data);
    }
    
	public function pushVotos()
    {
    	$data = json_decode( $_POST["datos"] );
    	for ($x=0; $x<count($data);$x++){
    		$this->mdl_encuesta->sumVoto($data[$x]);
    	}
    	
    	$dato["registro"]=$this->mdl_encuesta->sumRegistro();
    	$dato["arquero"]=$this->mdl_encuesta->getLista("ARQ");
    	$dato["defensa"]=$this->mdl_encuesta->getLista("DEF");
    	$dato["volantes"]=$this->mdl_encuesta->getLista("VOL");
    	$dato["delantero"]=$this->mdl_encuesta->getLista("DEL");
    	echo "<pre>";
    	var_dump($dato);
    	echo json_encode($data);
    }
    
    public function resultados(){
    	$dato["registro"]=$this->mdl_encuesta->sumRegistro();
    	$dato["arquero"]=$this->mdl_encuesta->getLista("ARQ");
    	$dato["defensa"]=$this->mdl_encuesta->getLista("DEF");
    	$dato["volantes"]=$this->mdl_encuesta->getLista("VOL");
    	$dato["delantero"]=$this->mdl_encuesta->getLista("DEL");
    	echo json_encode($data);
    } 
    
    public function getResultado()
    {   $data = "";
    return $this->load->view("resultado",$data, TRUE);
    }
    
}
