<?php

class Strikes extends MY_Controller
{

    public $model = 'mdl_strikes';

    public function __construct()
    {
        parent::__construct();
    }


    //Fin Tabla de posiciones

    public function goleadores($campeonato)
    {
        $data['jugadores'] = $this->mdl_strikes->get_strikers($campeonato);
        return $this->load->view('strikesside', $data, true);
    }
    public function goleadoresFull($campeonato)
    {
        $data['jugadores'] = $this->mdl_strikes->get_strikers($campeonato, 0);
        return $this->load->view('strikes', $data, true);
    }

}
