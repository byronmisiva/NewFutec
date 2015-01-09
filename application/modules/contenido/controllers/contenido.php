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
    }


    public function menu($data = FALSE)
    {

        //  $this->load->model('teams_position');
        //  $this->load->model('team');

        $this->load->module('teams_position');
        $positions = $this->mdl_teams_position->get_table_by_champ(CHAMP_DEFAULT);

//

        $data['seriea'] = $this->mdl_noticias->get_by_position(1, SECTION_SERIE_A, 2);
        $data['serieb'] = $this->mdl_noticias->get_by_position(1, SECTION_SERIE_B, 2);
        $data['seleccion'] = $this->mdl_noticias->get_by_position(1, SECTION_SELECCION, 2);

        /*  $teams=array();
          foreach($positions as $key=>$pos){

              $teams[$key]=current($this->mdl_team->get($pos['id'])->result());
              $teams[$key]->seccion=$pos['section'];
          }*/
        $data['teams'] = $positions;
        return $this->load->view('menu', $data, TRUE);
    }

    public function header2($data = FALSE)
    {
        $this->load->module('story');
        $dataRotativas['rotativasData'] = $this->mdl_story->get_banner(6, 44);
        $excluded = array();
        foreach ($dataRotativas['rotativasData'] as $key => $row) {
            $excluded[] = $row->id;
            $dataRotativas['rotativasData'][$key]->sponsored = false;
        }
        //ponemos en caso de existir la noticia ZONA FE

        //recupera  y cambia por la ultima noticia
        $sponsor = current($this->mdl_story->get_zonafe($excluded));
        if ($sponsor !== FALSE) {
            array_pop($dataRotativas['rotativasData']);
            array_push($dataRotativas['rotativasData'], $sponsor);
        }
        //fin poner en caso de existir la ZONE FE

        $dataRotativas['check'] = 0;
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

    }
    public function header2mobile ($data = FALSE)
    {
        $this->load->module('story');
        $dataRotativas['rotativasData'] = $this->mdl_story->get_banner(6, 44);
        $excluded = array();
        foreach ($dataRotativas['rotativasData'] as $key => $row) {
            $excluded[] = $row->id;
            $dataRotativas['rotativasData'][$key]->sponsored = false;
        }
        //ponemos en caso de existir la noticia ZONA FE

        //recupera  y cambia por la ultima noticia
        $sponsor = current($this->mdl_story->get_zonafe($excluded));
        if ($sponsor !== FALSE) {
            array_pop($dataRotativas['rotativasData']);
            array_push($dataRotativas['rotativasData'], $sponsor);
        }
        //fin poner en caso de existir la ZONE FE

        $dataRotativas['check'] = 0;
        $data['rotativas'] = $this->load->view('rotativasmobil', $dataRotativas, TRUE);

        $bannerMedio = $this->banners->fe_smart_bottom ();
        //cargamos partidos
        $this->load->module('scoreboards');

        //$datamarcador['title'] = "Partidos de Hoy";
        //$datamarcador['scores'] = $this->mdl_scoreboards->today_matches();
        $datamarcador['scores'] = "";
        if ($datamarcador['scores'] == false) {
            $datamarcador['scores'] = $this->mdl_scoreboards->last_matches();
            //$data['title'] = "Ultima Fecha";
        }
        $data['marcadorvivo'] = "";

        return $this->load->view('header2', $data, TRUE);

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

    }

    public function bottom($data = FALSE)
    {
        return $this->load->view('bottom', $data, TRUE);

    }

    public function view_twitter($data = FALSE)
    {
        return $this->load->view('twitter', $data, TRUE);
        // todo validar si se queda
    }

    public function view_la_entrevista($data = FALSE)
    {
        return $this->load->view('laentrevista', $data, TRUE);

    }

    public function view_mod_fuera_de_juego($data = FALSE)
    {
        return $this->load->view('fueradejuegomod', $data, TRUE);

    }
         public function view_fuera_de_juego($data = FALSE)
    {
        return $this->load->view('fueradejuego', $data, TRUE);

    }
    public function femagazine($data = FALSE)
    {
        return $this->load->view('femagazine', $data, TRUE);

    }
    public function search($data = FALSE)
    {
        return $this->load->view('search', $data, TRUE);
    }


    public function sidebar($data = FALSE)
    {

        //carga Banners
        $this->load->module('banners');
        $this->load->module('scoreboards');
        $bannersSidebar = array();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar1();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar2();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar3();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar4();
        $data['bannersSidebar'] = $bannersSidebar;
        //fin carga banners

        //Proxima Fecha
        $listCampeonatos = $this->mdl_scoreboards->active_schedules(false, false);
        $campeonatos = array();
        foreach ($listCampeonatos as $listcampeonato) {
            $listcampeonato->partidos = $this->mdl_scoreboards->list_mwatch_week($listcampeonato->champ);
            $listcampeonato->shortname = strtolower($this->_clearStringGion($listcampeonato->name));

            $campeonatos[] = $listcampeonato;
        }
        $data['campeonatos'] = $campeonatos;
        //Fin Proxima Fecha

        //Resultados fecha ultima
        $listCampeonatosResultados = $this->mdl_scoreboards->active_schedules(false, false);
        $campeonatosResultados = array();
        foreach ($listCampeonatosResultados as $listcampeonato) {
            $listcampeonato->partidos = $this->mdl_scoreboards->list_mwatch_results($listcampeonato->champ);
            $listcampeonato->shortname = strtolower($this->_clearStringGion($listcampeonato->name));

            $campeonatosResultados[] = $listcampeonato;
        }
        $data['campeonatosResultados'] = $campeonatosResultados;

        //Resultados tabla de posiciones
        $this->load->module('scoreboards');

      //  $data['scroreBoardAcumulative'] = $this->scoreboards->leaderboard_cumulative(SERIE_A);
      //  $data['scroreBoardSingle'] = $this->scoreboards->leaderboard(SERIE_A);
        $data['tablaposiciones'] = $this->scoreboards->tablaposiciones(SERIE_A);

        //Resultados goleadores
        $this->load->module('strikes');
        $data['strikes'] = $this->strikes->goleadores(SERIE_A);

        //La entrevista
        $data['laentrevista'] = $this->view_la_entrevista();

        //La entrevista
        $data['fueradejuego'] = $this->view_mod_fuera_de_juego();

        //Lo más leído

        $this->load->module('story');
        $data['loMasLeido'] = $this->story->viewget_plus ("Lo más leído", LOMASLEIDO, "masleido");

        //La voz de las tribunas
        $this->load->module('noticias');
        $data['laVozDeLasTribunas'] = $this->noticias->viewmininewssidebar ("La voz de las tribunas", LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "lavoz");

        //Zona Fe
        $data['zonaFe'] = $this->noticias->viewmininewssidebar ("Zona FE", ZONAFE, ZONAFEPOS, "zonafe");


        return $this->load->view('sidebar', $data, TRUE);
        // todo validar si se queda
    }

    public function sidebarOpenNews($data = FALSE)
    {

        //carga Banners
        $this->load->module('banners');
        $this->load->module('scoreboards');
        $bannersSidebar = array();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar1();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar2();
       // $bannersSidebar[] = $this->banners->FE_BigboxSidebar3();
       // $bannersSidebar[] = $this->banners->FE_BigboxSidebar4();
        $data['bannersSidebar'] = $bannersSidebar;
        //fin carga banners

        //Proxima Fecha
        /*$listCampeonatos = $this->mdl_scoreboards->active_schedules(false, false);
        $campeonatos = array();
        foreach ($listCampeonatos as $listcampeonato) {
            $listcampeonato->partidos = $this->mdl_scoreboards->list_mwatch_week($listcampeonato->champ);
            $listcampeonato->shortname = strtolower($this->_clearStringGion($listcampeonato->name));

            $campeonatos[] = $listcampeonato;
        }
        $data['campeonatos'] = $campeonatos;*/
        //Fin Proxima Fecha

        //Resultados fecha ultima
        /*$listCampeonatosResultados = $this->mdl_scoreboards->active_schedules(false, false);
        $campeonatosResultados = array();
        foreach ($listCampeonatosResultados as $listcampeonato) {
            $listcampeonato->partidos = $this->mdl_scoreboards->list_mwatch_results($listcampeonato->champ);
            $listcampeonato->shortname = strtolower($this->_clearStringGion($listcampeonato->name));

            $campeonatosResultados[] = $listcampeonato;
        }
        $data['campeonatosResultados'] = $campeonatosResultados;*/

        //Resultados tabla de posiciones
        /*$this->load->module('scoreboards');

        $data['scroreBoardAcumulative'] = $this->scoreboards->leaderboard_cumulative(SERIE_A);
        $data['scroreBoardSingle'] = $this->scoreboards->leaderboard(SERIE_A);*/

        //Resultados goleadores
        /*$this->load->module('strikes');
        $data['strikes'] = $this->strikes->goleadores(SERIE_A);*/

        //La entrevista
     //   $data['laentrevista'] = $this->view_la_entrevista();

        //La entrevista
     //   $data['fueradejuego'] = $this->view_mod_fuera_de_juego();

        //Lo más leído

        $this->load->module('story');
        $data['loMasLeido'] = $this->story->viewget_plus ("Lo más leído", LOMASLEIDO, "masleido");

        //La voz de las tribunas
        $this->load->module('noticias');
        $data['laVozDeLasTribunas'] = $this->noticias->viewmininewssidebar ("La voz de las tribunas", LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "lavoz");

        //Zona Fe
        $data['zonaFe'] = $this->noticias->viewmininewssidebar ("Zona FE", ZONAFE, ZONAFEPOS, "zonafe");


        return $this->load->view('sidebaropennews', $data, TRUE);

    }
}