<?php

class Strikes extends MY_Controller
{

    public $model = 'mdl_strikes';

    public function __construct()
    {
        parent::__construct();
    }




    // Tabla de posiciones
    public function leaderboard($champ)
    {
        $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
            base_url() . 'imagenes/icons/igual.png',
            base_url() . 'imagenes/icons/flecha_abajo.png');
        $round = $this->mdl_teams_position->get_active_round($champ);
        if ($round != false) {
            $active_group = current($this->mdl_teams_position->get_by_round($round));
            $data['teams'] = $this->mdl_teams_position->get_teams($champ);
            $data['tabla'] = $this->mdl_teams_position->get_table($active_group->id);
            return $this->load->view('leaderboard', $data, true);
        } else {
            return false;
        }
    }
    //Fin Tabla de posiciones

    public function mod_Goleadores($block)
    {

        $this->CI->load->model('goals_position');
        $this->CI->load->model('championship');

        $data['championship'] = $this->CI->championship->get($this->section->championship_id)->row();
        $data['jugadores'] = $this->CI->goals_position->get_strikers($this->section->championship_id)->result();
        $data['champ'] = $this->section->championship_id;

        if (count($data['jugadores']) > 0)
            $data['goleador'] = $data['jugadores'][0];
        else {
            $data['goleador'] = new stdClass();
            $data['goleador']->first_name = "";
            $data['goleador']->last_name = "";
            $data['goleador']->name = "";
            $data['goleador']->thumb = "imagenes/players/striker.jpg";
        }
        $this->CI->template->write_view($block, 'public/strikes', $data, FALSE);
    }


}
