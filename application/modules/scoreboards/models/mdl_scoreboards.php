<?php

class Mdl_scoreboards extends MY_Model
{


    public $table_name = "stories";
    public $primary_key = "id";
    public $joins;
    public $select_fields;
    public $total_rows;
    public $page_links;
    public $current_page;
    public $num_pages;
    public $optional_params;
    public $order_by;
    public $form_values = array();

    public function __construct()
    {
        parent::__construct();
    }


    function today_matches($live='live'){   //Todo partido q se juega hoy

        $this->db->select('*, UNIX_TIMESTAMP(date_match) as hour',false);
        $this->db->from('matches');
        $this->db->where('DATE(date_match)','CURDATE()',false);
        if($live=='live')
            $this->db->where('live','1');
        $this->db->order_by('date_match','desc');
        $matches=$this->db->get();

        //Chequeo si existen partidos
        if($matches->num_rows()>0)
            $partidos=$this->data_matches($matches);
        else
            $partidos=false;

        return $partidos;
    }

    /*
     * ULTIMOS PARTIDOS DE UNA FECHA DE UN CAMPEONATO */

    function last_matches($champ=0){

        $this->db->select('schedules.*,championships.name');
        $this->db->from('schedules');
        $this->db->join('championships','schedules.round_id=championships.active_round');
        if($champ>0)
            $this->db->where('championships.id',$champ);
        $this->db->order_by('schedules.round_id','asc');
        $this->db->order_by('schedules.position','asc');
        $schedules=$this->db->get();

        //Saco las ultimas fechas jugadas de el/los campeonatos
        $aux=0;
        $fechas=array();
        foreach($schedules->result() as $schedule){
            if($schedule->round_id != $aux){
                $fechas[]=$schedule->id;
                $aux=$schedule->round_id;
            }
        }

        //Saco todos los partidos en vivo de las fechas
        $this->db->select('*, UNIX_TIMESTAMP(date_match) as hour',false);
        $this->db->where('live','1');
        $this->db->where_in('state',array('0','8'));
        $this->db->where_in('schedule_id',$fechas);
        $this->db->order_by('date_match','desc');
        $matches=$this->db->get('matches');

        if($matches->num_rows()>0)
            $partidos=$this->data_matches($matches);
        else
            $partidos=false;

        return $partidos;
    }


    /* Extraigo los datos básicos del partido */

    function data_matches($matches){
        $partidos=array();
        foreach($matches->result() as $key=>$match){
            //Datos del Partido
            $partidos[$key]=$match;
            $this->db->where('match_id',$match->id);
            $teams=current($this->db->get('matches_teams')->result());
            $partidos[$key]->hid=$teams->team_id_home;
            $partidos[$key]->aid=$teams->team_id_away;

            //Campeonato
            $this->db->select('championships.*,groups.id as gid');
            $this->db->from('groups');
            $this->db->join('rounds','rounds.id=groups.round_id');
            $this->db->join('championships','championships.id=rounds.championship_id');
            $this->db->where('groups.id',$match->group_id);
            $championship=current($this->db->get()->result());
            $partidos[$key]->championship=$championship->name;
            $partidos[$key]->group_id=$championship->gid;

            //Equipo Local
            $this->db->where('id',$partidos[$key]->hid);
            $team_home=current($this->db->get('teams')->result());
            $partidos[$key]->hname=$team_home->name;
            $partidos[$key]->hsname=$team_home->short_name;
            $partidos[$key]->hshield='imagenes/teams/shield/default.png';
            $partidos[$key]->hthumb='imagenes/teams/thumb_shield/default.png';
            if($team_home->shield!='')
                $partidos[$key]->hshield=$team_home->shield;
            if($team_home->thumb_shield!='')
                $partidos[$key]->hthumb=$team_home->thumb_shield2;

            //Equipo Visitante
            $this->db->where('id',$partidos[$key]->aid);
            $team_away=current($this->db->get('teams')->result());
            $partidos[$key]->aname=$team_away->name;
            $partidos[$key]->asname=$team_away->short_name;
            $partidos[$key]->ashield='imagenes/teams/shield/default.png';
            $partidos[$key]->athumb='imagenes/teams/thumb_shield/default.png';
            if($team_away->shield2!='')
                $partidos[$key]->ashield=$team_away->shield2;
            if($team_away->thumb_shield2!='')
                $partidos[$key]->athumb=$team_away->thumb_shield2;
        }
        return $partidos;
    }


}