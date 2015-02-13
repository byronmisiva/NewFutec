<?php

class Matches extends MY_Controller
{
    public $model = 'mdl_matches';

    public function __construct()
    {
        parent::__construct();
    }

    public function getChampionship($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('championships');
    }


    public function getMatchName($id)
    {
        //recuperamos id equipos del partido
        $this->db->where('match_id', $id);
        $query = $this->db->get('matches_teams');
        $match = $query->result();
        $team_id_home = $match[0]->team_id_home;
        $team_id_away = $match[0]->team_id_away;
        return $this->getTeamName($team_id_home) . "-" . $this->getTeamName($team_id_away);


    }

    public function getTeamName($id)
    {
        //recuperamos id equipos del partido
        $this->db->where('id', $id);
        $query = $this->db->get('teams');
        $match = $query->result();
        return $match[0]->name;

    }

    public function getMatch($id)
    {
        $this->output->cache(CACHE_PARTIDOS);

        $data['title'] = "Marcador en Vivo";
        $data['teamsFecha'] = $this->mdl_matches->matches_id($id);

        $equipos = $this->mdl_matches->get_match_teams($id);
        //todo  arreglar esta funcion
        $Serie = $this->getSerie($id);
        $idSerie = $Serie->id;
        $data['idEquipo']= $id;
        $data['teams_pics'] = $this->mdl_matches->get_pics_teams($idSerie);

        $data['infoLocal'] = $this->mdl_matches->get_info_team($equipos[0]->team_id_home);
        $data['infoVisitante'] = $this->mdl_matches->get_info_team($equipos[0]->team_id_away);

        $data['golesLocal'] = $this->mdl_matches->get_goals_team($id, $equipos[0]->team_id_home);
        $data['golesVisitante'] = $this->mdl_matches->get_goals_team($id, $equipos[0]->team_id_away);

        $data['estrategiaLocal'] = $this->mdl_matches->get_estrategia_team($id, $equipos[0]->team_id_home);
        $data['estrategiaVisitante'] = $this->mdl_matches->get_estrategia_team($id, $equipos[0]->team_id_away);

        $data['titularesLocal'] = $this->mdl_matches->get_titulares_team($id, $equipos[0]->team_id_home);
        $data['titularesVisitante'] = $this->mdl_matches->get_titulares_team($id, $equipos[0]->team_id_away);

        $data['actions'] = $this->mdl_matches->get_actions_team($id);


        $data['comentarios'] = $this->mdl_matches->get_info_team($id);

        $data ['cronometro'] = $this->mdl_matches->cal_time($id);

        //todo se debe poner con la fecha
//        $data['otrospartidos']= $this->mdl_matches->get_info_team($id);

        return $this->load->view('matchdetail', $data, true);
    }

    public function getSerie($id)
    {

        $query = $this->db->query('SELECT championships.id,
                                        championships.name
                                    FROM matches INNER JOIN schedules ON matches.schedule_id = schedules.id
                                         INNER JOIN championships ON schedules.round_id = championships.active_round
                                    WHERE matches.id = ' . $id);


        $match = $query->result();

        return $match[0];
    }

    public function matches($idSerie, $title)
    {
        $data['title'] = $title;
        $data['teamsFecha'] = $this->mdl_matches->matches_all($idSerie);
        $data['teams_pics'] = $this->mdl_matches->get_pics_teams($idSerie);
        return $this->load->view('matches', $data, true);
    }
    //listado con partidos en vivo
    public function matchesLive( $title)
    {
        $data['title'] = $title;

        $this->load->module('scoreboards');
        $data['fechas'] = $this->mdl_scoreboards->today_matches();
        if ($data['fechas'] == false) {
            $data['fechas'] = $this->mdl_scoreboards->last_matches();
        }

        return $this->load->view('matcheslive', $data, true);
    }

    public function matchesperteam($idEquipo, $idSerie)
    {
        $data['idEquipo'] = $idEquipo;
        $data['teamsFecha'] = $this->mdl_matches->matches_all_team($idSerie,$idEquipo);
        $data['teams_pics'] = $this->mdl_matches->get_pics_teams($idSerie);
        return $this->load->view('matchesperteam', $data, true);
    }


}

