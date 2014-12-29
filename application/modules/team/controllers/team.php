<?php
class Team extends MY_Controller
{

    public $model = 'mdl_team';

    public function __construct()
    {
        parent::__construct();
    }

    public function getFichaEquipo($data = FALSE)
    {
        return $this->load->view('ficha', $data, TRUE);
    }
    public function getCabeceraEquipo($data = FALSE)
    {
        return $this->load->view('fichacabecera', $data, TRUE);
    }
}