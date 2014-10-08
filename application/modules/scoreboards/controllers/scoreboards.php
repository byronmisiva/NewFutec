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

}
