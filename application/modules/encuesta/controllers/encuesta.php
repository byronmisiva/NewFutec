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
    
}
