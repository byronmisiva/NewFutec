<?php
class Scoreboards extends MY_Controller
{

    public $model = 'mdl_scoreboards';

    public function __construct()
    {
        parent::__construct();
    }

    public function matches_today()
    {

        $data['title'] = "Partidos de Hoy";
        $data['scores'] = $this->mdl_scoreboards->today_matches();
        if ($data['scores'] == false) {
            $data['scores'] = $this->match_calendary->last_matches();
            $data['title'] = "Ultima Fecha";
        }

        $this->load->view('scoreboards/scoreboards_live', $data);

    }

}
