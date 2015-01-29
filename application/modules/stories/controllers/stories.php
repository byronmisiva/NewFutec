<?php

class Stories extends MY_Controller
{
    public $model = 'mdl_stories';
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo "hola";
    }
    public function publica(){
        redirect(base_url() . 'site/noticia/desde-facebook/' . $offset = $this->uri->segment(3));
    }
}