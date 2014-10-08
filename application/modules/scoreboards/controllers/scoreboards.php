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

    function list_played_matches(){
        $this->output->cache(CACHE_MOVIL);
        $champ=$this->uri->segment(3);
        $data['champ']=$champ;
        $data['partidos']=$this->match_calendary->matches_last_next(FALSE,FALSE);
        $this->load->view($this->folder_views.'/list_results', $data);
    }

    // Tabla de posiciones
    function leaderboard($champ){
        $this->output->cache(CACHE_MOVIL);
        $this->load->model('group');
        $this->load->model('teams_position');
        $this->load->model('section');
        $data['change']=array(	base_url().'imagenes/icons/flecha_arriba.png',
            base_url().'imagenes/icons/igual.png',
            base_url().'imagenes/icons/flecha_abajo.png');
        $round=$this->model->get_active_round($champ);
        if($round!=false){
            $active_group = current($this->group->get_by_round($round));
            $data['teams']=$this->section->get_teams($champ);
            $data['tabla']=$this->teams_position->get_table( $active_group->id );
            return  $this->load->view($this->folder_views.'/leaderboard', $data, true);
        } else {
            return false;
        }
    }
    //Fin Tabla de posiciones

    // Tabla de posiciones  acumulada
    function leaderboard_cumulative($champ){
        $this->output->cache(CACHE_MOVIL);

        $this->load->model('teams_position');
        $data['change']=array(	base_url().'imagenes/icons/flecha_arriba.png',
            base_url().'imagenes/icons/igual.png',
            base_url().'imagenes/icons/flecha_abajo.png');

        $data['tabla']=$this->teams_position->get_table_by_champ($champ);
        $data['groups']=0;

        return $this->load->view($this->folder_views.'/leaderboard', $data, true);
    }
    //Fin Tabla de posiciones acumulada


}
