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
        return $this->getTeamName($team_id_home) . "-". $this->getTeamName($team_id_away);
        //update `fe2008`.`matches_teams` set `team_id_home`='121', `team_id_away`='31' where `id`='1'

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
        $data['title'] = "Marcador en Vivo";
        $data['teamsFecha'] = $this->mdl_matches->matches_id($id);
        // arreglar esta funcion
        $idSerie  = $this->getSerie($id);
        $data['teams_pics'] = $this->mdl_matches->get_pics_teams($idSerie);



        return $this->load->view('matchdetail', $data, true);
    }
    public function getSerie($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('teams');
        $match = $query->result();
        //return $match[0]->name;
        return 49;
    }
    public function matches($idSerie, $title)
    {
        $data['title'] = $title;
        $data['teamsFecha'] = $this->mdl_matches->matches_all($idSerie);
        $data['teams_pics'] = $this->mdl_matches->get_pics_teams($idSerie);
        return $this->load->view('matches', $data, true);
    }

    public function matchesperteam($idEquipo, $idSerie)
    {
        $data['idEquipo'] = $idEquipo;
        $data['teamsFecha'] = $this->mdl_matches->matches_all($idSerie);
        $data['teams_pics'] = $this->mdl_matches->get_pics_teams($idSerie);
        return $this->load->view('matchesperteam', $data, true);
    }


}

