<?php

class Scoreboards extends MY_Controller
{

    public $model = 'mdl_scoreboards';

    public function __construct()
    {
        parent::__construct();
    }

    function tablaposiciones($temporada)
    {
        $data['scroreBoardAcumulative'] = $this->leaderboard_cumulative($temporada);
        $data['scroreBoardSingle'] = $this->leaderboard($temporada);
        $data['champ'] = $temporada;
        $conten = strip_tags(trim (  $data['scroreBoardSingle']));
        if ($conten == "Tabla vacía"){
            $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
        }
        return $this->load->view('tablaposiciones', $data, TRUE);
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


    function list_played_matches()
    {
        $this->output->cache(CACHE_MOVIL);
        $champ = $this->uri->segment(3);
        $data['champ'] = $champ;
        $data['partidos'] = $this->match_calendary->matches_last_next(FALSE, FALSE);
        $this->load->view($this->folder_views . '/list_results', $data);
    }

    public function scoreboardFull($champ)
    {
        $this->load->module('contenido');
        $data['champ'] = $champ;
        $data['scroreBoardAcumulative'] = $this->scoreboards->leaderboard_cumulative($champ, "leaderboarddetail");
        $data['scroreBoardSingle'] = $this->scoreboards->leaderboard($champ, "leaderboarddetail");
        $conten = strip_tags(trim (  $data['scroreBoardSingle']));
        if ($conten == "Tabla vacía"){
            $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
        }

        return $this->load->view('leaderboardFull', $data, true);
    }

    // Tabla de Posiciones
    public function leaderboard($champ, $leaderboard = 'leaderboard')
    {
        $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
            base_url() . 'imagenes/icons/igual.png',
            base_url() . 'imagenes/icons/flecha_abajo.png');
        $round = $this->mdl_teams_position->get_active_round($champ);
        if ($round != false) {
            $active_group = current($this->mdl_teams_position->get_by_round($round));
            $data['teams'] = $this->mdl_teams_position->get_teams($champ);
            $data['tabla'] = $this->mdl_teams_position->get_table($active_group->id);
            return $this->load->view($leaderboard, $data, true);
        } else {
            return false;
        }
    }
    //Fin Tabla de Posiciones

    // Tabla de Posiciones  acumulada
    public function leaderboard_cumulative($champ, $leaderboard = 'leaderboard')
    {
        $this->load->module('teams_position');
        $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
            base_url() . 'imagenes/icons/igual.png',
            base_url() . 'imagenes/icons/flecha_abajo.png');

        $data['tabla'] = $this->mdl_teams_position->get_table_by_champ($champ);
        $data['groups'] = 0;

        return $this->load->view($leaderboard, $data, true);
    }
    //Fin Tabla de Posiciones acumulada


}
