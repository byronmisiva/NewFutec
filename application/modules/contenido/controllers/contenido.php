<?php
class Contenido extends MY_Controller
{

    public $model = 'mdl_contenido';

    public function __construct()
    {
        parent::__construct();
    }

    public function cabecera($data = FALSE)
    {
        return $this->load->view('header', $data, TRUE);
        //todo se queda
    }

    public function menu($data = FALSE)
    {

      //  $this->load->model('teams_position');
      //  $this->load->model('team');

        $this->load->module('teams_position');
        $this->load->module('team');

        $positions=$this->mdl_teams_position->get_table_by_champ(CHAMP_DEFAULT);

      /*  $teams=array();
        foreach($positions as $key=>$pos){

            $teams[$key]=current($this->mdl_team->get($pos['id'])->result());
            $teams[$key]->seccion=$pos['section'];
        }*/

        $data['teams'] = $positions;


        return $this->load->view('menu', $data, TRUE);
        //todo se queda
    }

    public function header2($data = FALSE)
    {
        $this->load->module('story');
        $dataRotativas['query']=$this->mdl_story->get_banner(6,44);
            $excluded = array();
        foreach($dataRotativas['query'] as $key=>$row){
            $excluded[]=$row->id;
            $dataRotativas['query'][$key]->sponsored = false;
        }
        //ponemos en caso de existir la noticia ZONA FE

        //recupera  y cambia por la ultima noticia
        $sponsor = current($this->mdl_story->get_zonafe($excluded));
        if($sponsor !== FALSE){
            array_pop($dataRotativas['query']);
            array_push($dataRotativas['query'], $sponsor);
        }
        //fin poner en caso de existir la ZONE FE

        $dataRotativas['check']=0;
        $data['rotativas'] = $this->load->view('rotativas', $dataRotativas, TRUE);
        //cargamos partidos
        $this->load->module('scoreboards');
        //$datamarcador['title'] = "Partidos de Hoy";
        $datamarcador['scores'] = $this->mdl_scoreboards->today_matches();
        if ($datamarcador['scores'] == false) {
            $datamarcador['scores'] = $this->mdl_scoreboards->last_matches();
            //$data['title'] = "Ultima Fecha";
        }
        $data['marcadorvivo'] = $this->load->view('marcadorvivo', $datamarcador, TRUE);

        return $this->load->view('header2', $data, TRUE);
        //todo se queda
    }

   /* function verificaDispositivo(){
        $this->load->library('user_agent');
        $mobiles=array( 'Android','Windows CE','Symbian S60' );
        $movil="0";
        if ($this->agent->is_mobile()){
            $movil="1";
            $m=$this->agent->mobile();
            if($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i',$this->agent->agent) == 0)
                $m = "Android Tablet";
            switch($m){

                case 'Android Tablet':
                    $movil="0";
                    break;
                case in_array($m,$mobiles):
                    $movil="0";
                    break;
            }
        }
        return $movil;
    }*/



    public function footer($data = FALSE)
    {
        return $this->load->view('footer', $data, TRUE);
        //todo se queda
    }
    public function bottom($data = FALSE)
    {
        return $this->load->view('bottom', $data, TRUE);
        //todo se queda
    }
    public function view_twitter($data = FALSE)
    {
        return $this->load->view('twitter', $data, TRUE);
        // todo validar si se queda
    }

    public function sidebar($data = FALSE)
    {

        $listCampeonatos = $this->mdl_scoreboards->active_schedules (false, false);
        $campeonatos = array();
        foreach ($listCampeonatos as $listcampeonato) {
            $listcampeonato->partidos = $this->mdl_scoreboards->list_mwatch_week($listcampeonato->champ);
            $listcampeonato->shortname = strtolower ($this->_clearStringGion ($listcampeonato->name));

            $campeonatos[] = $listcampeonato ;
        }
        $data['campeonatos'] = $campeonatos;
        return $this->load->view('sidebar', $data, TRUE);
        // todo validar si se queda
    }


}