<?php
class Teams_position extends MY_Controller
{

    public $model = 'mdl_teams_position';

    public function __construct()
    {
        parent::__construct();
    }

    public function cabecera($data = FALSE)
    {
        return $this->load->view('header2', $data, TRUE);

    }



}