<?php

class Matches extends MY_Controller
{

    public $model = 'mdl_matches';

    public function __construct()
    {
        parent::__construct();
    }

    public function matches()
    {

        $data['title'] = "Listado de partidos";
        $this->load->view('matches', $data);

    }


}
