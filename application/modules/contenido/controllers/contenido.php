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
        //$this->output->cache(CACHE_DEFAULT);

        $this->load->module('teams_position');
        $positions = $this->mdl_teams_position->get_table_by_champ(CHAMP_DEFAULT);
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

    public function menucopaamerica($data = FALSE)
    {

        //  $this->load->model('teams_position');
        //  $this->load->model('team');
        //$this->output->cache(CACHE_DEFAULT);

        $this->load->module('teams_position');
        $positions = $this->mdl_teams_position->get_table_by_champ(AMERICA);
        $data['seriea'] = $this->mdl_noticias->get_by_position(1, SECTION_SERIE_A, 2);
        $data['serieb'] = $this->mdl_noticias->get_by_position(1, SECTION_SERIE_B, 2);
        $data['seleccion'] = $this->mdl_noticias->get_by_position(1, SECTION_SELECCION, 2);

        /*  $teams=array();
          foreach($positions as $key=>$pos){

              $teams[$key]=current($this->mdl_team->get($pos['id'])->result());
              $teams[$key]->seccion=$pos['section'];
          }*/
        $data['teams'] = $positions;
        $data['teams'] = $positions;
        $data['tipoCampeonato'] = "simple";
        $data['campeonato'] = AMERICA;

        return $this->load->view('menucopaamerica', $data, TRUE);
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
        $sponsor->id = $sponsor->sid;

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


        // recuperar codigo de don balos
        $query = $this->db->query("SELECT valor FROM parametros WHERE nombre = 'dpa-sportslive'");

        if ($query->num_rows() > 0)
        {
            $query = $query->result();
            $dpasportslive = $query[0]->valor;
            if ($dpasportslive == 1)
                $data['marcadorvivo'] = $this->banners->dpasportslive();
            else
                $data['marcadorvivo'] = $this->marcadorVivo();
        } else {
            $data['marcadorvivo'] = $this->marcadorVivo();
        }

        //todo pruebas
        //$data['marcadorvivo'] = $this->marcadorVivo();

        return $this->load->view('header2', $data, TRUE);
    }

    public function marcadorVivo($campeonato = CHAMP_DEFAULT  )
    {
        $this->load->module('scoreboards');
        if ($campeonato != AMERICA)
            $datamarcador['scores'] = $this->mdl_scoreboards->today_matches();
        else
            $datamarcador['scores'] = $this->mdl_scoreboards->today_matches("todos");

        if ($datamarcador['scores'] == false) {
            $datamarcador['scores'] = $this->mdl_scoreboards->last_matches();
        }

        $datamarcador['campeonato'] = $campeonato;
        return $this->load->view('marcadorvivo', $datamarcador, TRUE);
    }

    public function dpasportslive()
    {
        $this->load->module('banners');
        return $this->banners->dpaSportsLive() ;
    }

    public function dpaSportsLiveFrame($dispositivo)
    {
        $this->load->module('banners');
        $data['dispositivo'] = $dispositivo;
        return $this->banners->dpaSportsLiveFrame($data) ;
    }

    public function header2mobile($data = FALSE, $seccion = "")
    {
        $this->load->module('story');
        if ($seccion == "") {
            $dataRotativas['rotativasData'] = $this->mdl_story->get_banner(6, 44);
        } else {
            $dataRotativas['rotativasData'] = $this->mdl_story->get_banner_seccion(6, "", $seccion);
        }

        $excluded = array();
        foreach ($dataRotativas['rotativasData'] as $key => $row) {
            $excluded[] = $row->id;
            $dataRotativas['rotativasData'][$key]->sponsored = false;
        }
        //ponemos en caso de existir la noticia ZONA FE

        //recupera  y cambia por la ultima noticia
        $sponsor = current($this->mdl_story->get_zonafe($excluded));
        // todo por que se genera esto mal
        $sponsor->id = $sponsor->sid;
        if ($sponsor !== FALSE) {
            array_pop($dataRotativas['rotativasData']);
            array_push($dataRotativas['rotativasData'], $sponsor);
        }
        //fin poner en caso de existir la ZONE FE

        $dataRotativas['check'] = 0;
        $data['rotativas'] = $this->load->view('rotativasmobil', $dataRotativas, TRUE);

        $bannerMedio = $this->banners->fe_smart_bottom();
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

    public function view_juventus($data = FALSE)
    {
        return $this->load->view('juventus', $data, TRUE);

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


    public function sidebar($data = FALSE, $serie = SERIE_A)
    {

        //carga Banners
        $this->load->module('banners');
        $this->load->module('scoreboards');
        $this->load->module('surveys');
        $bannersSidebar = array();
        $bannersSidebar[] = $this->banners->fe_new_filmstrip_banner();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar1();
        //$bannersSidebar[] = $this->banners->FE_BigboxSidebar2();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar3();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar4();
        $bannersSidebar[] = $this->banners->fe_cocafm();
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


        $data['tablaposiciones'] = $this->scoreboards->tablaposiciones($serie);

        //Resultados goleadores
        $this->load->module('strikes');
        $data['strikes'] = $this->strikes->goleadores($serie);

        //La entrevista
        $data['laentrevista'] = $this->view_la_entrevista();

        //La entrevista
        $data['fueradejuego'] = $this->view_mod_fuera_de_juego();

        //Lo más leído

        $this->load->module('story');
        $data['loMasLeido'] = $this->story->viewget_plus("Lo más Leído", LOMASLEIDO, "masleido");

        //La Voz de las Tribunas
        $this->load->module('noticias');
        $data['laVozDeLasTribunas'] = $this->noticias->viewmininewssidebar("La Voz de las Tribunas", LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "lavoz");

        //Zona Fe
        $data['zonaFe'] = $this->noticias->viewmininewssidebar("Zona FE", ZONAFE, ZONAFEPOS, "zonafe");

        //Encuestas
        $data['encuesta'] = $this->surveys->encuesta_formulario();


        return $this->load->view('sidebar', $data, TRUE);
        // todo validar si se queda
    }

    public function sidebarOpenNews($data = FALSE, $serie = SERIE_A, $tipo = "large", $tipotabla = "acumulada")
    {

        //carga Banners
        $this->load->module('banners');
        $this->load->module('scoreboards');
        $bannersSidebar = array();

        $bannersSidebar[] = $this->banners->FE_Bigboxbanner();
        $bannersSidebar[] = $this->banners->fe_new_filmstrip_banner();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar1();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar3();
        //$bannersSidebar[] = $this->banners->FE_BigboxSidebar2();

        // $bannersSidebar[] = $this->banners->FE_BigboxSidebar4();
        //$bannersSidebar[] = $this->banners->fe_cocafm();
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


        //para que se renderice la tabla de contenidos de acuerdo a la seccion abienrta
        $data['serie'] = $serie;

        if ($tipo == "large") {
            //Resultados tabla de posiciones
            $this->load->module('scoreboards');
            $data['tablaposiciones'] = $this->scoreboards->tablaposiciones($serie, $tipotabla);

            //Resultados goleadores
            $this->load->module('strikes');
            $data['strikes'] = $this->strikes->goleadores($serie);


            //Lo más leído
            $this->load->module('story');
            $data['loMasLeido'] = $this->story->viewget_plus("Lo más Leído", LOMASLEIDO, "masleido");

            //La Voz de las Tribunas
            $this->load->module('noticias');
            $data['laVozDeLasTribunas'] = $this->noticias->viewmininewssidebar("La Voz de las Tribunas", LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "lavoz");

            //Zona Fe
            $data['zonaFe'] = $this->noticias->viewmininewssidebar("Zona FE", ZONAFE, ZONAFEPOS, "zonafe");
            return $this->load->view('sidebaropennews', $data, TRUE);
        } else {
            //Resultados tabla de posiciones
            $data['tablaposiciones'] = "";

            //Resultados goleadores
            $data['strikes'] = "";

            //Lo más leído
            $data['loMasLeido'] = "";

            //La Voz de las Tribunas
            $data['laVozDeLasTribunas'] = "";

            //Zona Fe
            $data['zonaFe'] = "";

            return $this->load->view('sidebaropenshort', $data, TRUE);
        }
    }

    public function sidebarDonBalon($data = FALSE, $serie = SERIE_A, $tipo = "large")
    {

//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Origin: www.tudeloo.com');
//        header( 'Access-Control-Allow-Origin: www.donbalon.com/');

        header("access-control-allow-origin: *");
        //carga Banners
        $this->load->module('banners');
        $this->load->module('scoreboards');

        $bannersSidebar = array();

        //$bannersSidebar[] = $this->banners->FE_Bigboxbanner();
        //$bannersSidebar[] = $this->banners->FE_BigboxSidebar1();
        //$bannersSidebar[] = $this->banners->FE_BigboxSidebar3();
        // $bannersSidebar[] = $this->banners->FE_BigboxSidebar4();
        //$bannersSidebar[] = $this->banners->fe_cocafm();
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


        //para que se renderice la tabla de contenidos de acuerdo a la seccion abienrta
        $data['serie'] = $serie;

        if ($tipo == "large") {
            //Resultados tabla de posiciones
            $this->load->module('scoreboards');
            $data['tablaposiciones'] = $this->scoreboards->tablaposiciones($serie);

            //Resultados goleadores
            $this->load->module('strikes');
            $data['strikes'] = $this->strikes->goleadores($serie);


            //Lo más leído
            $this->load->module('story');
            $data['loMasLeido'] = $this->story->viewget_plus("Lo más Leído", LOMASLEIDO, "masleido");

            //La Voz de las Tribunas
            $this->load->module('noticias');
            $data['laVozDeLasTribunas'] = $this->noticias->viewmininewssidebar("La Voz de las Tribunas", LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "lavoz");

            //Zona Fe
            $data['zonaFe'] = $this->noticias->viewmininewssidebar("Zona FE", ZONAFE, ZONAFEPOS, "zonafe");
            return $this->load->view('sidebardonbalon', $data, TRUE);
        } else {
            //Resultados tabla de posiciones
            $data['tablaposiciones'] = "";

            //Resultados goleadores
            $data['strikes'] = "";

            //Lo más leído
            $data['loMasLeido'] = "";

            //La Voz de las Tribunas
            $data['laVozDeLasTribunas'] = "";

            //Zona Fe
            $data['zonaFe'] = "";

            return $this->load->view('sidebardonbalon', $data, TRUE);
        }
    }


    public function tabladeposiciones($data = FALSE, $serie = SERIE_A, $tipotabla = "acumulada")
    {
        //para que se renderice la tabla de contenidos de acuerdo a la seccion abienrta
        $data['serie'] = $serie;
        $data['tablaposiciones'] =  $this->scoreboards->leaderboard($serie,'leaderboard', $tipotabla  );;
     //   $data['tablaposiciones'] = $this->scoreboards->tablaposiciones($serie, $tipotabla);
        return $this->load->view('tabladeposiciones', $data, TRUE);

    }
    public function noticiasonly($data = FALSE)
    {
        return $this->load->view('noticiasonly', $data, TRUE);

    }


    public function copaamericasidebar($data = FALSE, $serie = SERIE_A, $tipoCampeonato = AMERICA_TIPOTABLA)
    {

        //carga Banners
        $this->load->module('banners');
        $this->load->module('scoreboards');
        $this->load->module('surveys');
        $bannersSidebar = array();
        if ($serie == 56)
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar1_copaamerica();
        else
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar1();

        $bannersSidebar[] = $this->banners->FE_BigboxSidebar2();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar3();
        $bannersSidebar[] = $this->banners->FE_BigboxSidebar4();
        $bannersSidebar[] = $this->banners->fe_cocafm();
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


        //para que se renderice la tabla de contenidos de acuerdo a la seccion abienrta
        $data['serie'] = $serie;


        //Resultados tabla de posiciones
        $this->load->module('scoreboards');


        $data['tablaposiciones'] = $this->scoreboards->tablaposiciones($serie, $tipoCampeonato);

        //Resultados goleadores
        $this->load->module('strikes');
        $data['strikes'] = $this->strikes->goleadores($serie);

        //La entrevista
        $data['laentrevista'] = $this->view_la_entrevista();

        //La entrevista
        $data['fueradejuego'] = $this->view_mod_fuera_de_juego();

        //Lo más leído

        $this->load->module('story');
        $data['loMasLeido'] = $this->story->viewget_plus("Lo más Leído", LOMASLEIDO, "masleido");

        //La Voz de las Tribunas
        $this->load->module('noticias');
        $data['laVozDeLasTribunas'] = $this->noticias->viewmininewssidebar("La Voz de las Tribunas", LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "lavoz");

        //Zona Fe
        $data['zonaFe'] = $this->noticias->viewmininewssidebar("Zona FE", ZONAFE, ZONAFEPOS, "zonafe");

        //Encuestas
        $data['encuesta'] = $this->surveys->encuesta_formulario();

        if ( $this->uri->segment(1) != "copaamerica" ) {

            $data['FE_Bigboxbanner'] = $this->banners->fe_hp_brand();
        }  else {

            $data['FE_Bigboxbanner'] = "";
        }



        return $this->load->view('sidebaramerica', $data, TRUE);
        // todo validar si se queda
    }

    public function copaamericaheader($data = FALSE)
    {
        $this->load->module('story');
        $dataRotativas['rotativasData'] = $this->mdl_story->get_banner_seccion(6, "", SECTION_AMERICA  );
        $excluded = array();
        foreach ($dataRotativas['rotativasData'] as $key => $row) {
            $excluded[] = $row->id;
            $dataRotativas['rotativasData'][$key]->sponsored = false;
        }
        //ponemos en caso de existir la noticia ZONA FE


        //fin poner en caso de existir la ZONE FE

        $dataRotativas['check'] = 0;
        $dataRotativas['linkseccion'] = "copaamerica";
        $data['rotativas'] = $this->load->view('rotativas', $dataRotativas, TRUE);
        //cargamos partidos
        $this->load->module('scoreboards');

        //$datamarcador['title'] = "Partidos de Hoy";
        $datamarcador['scores'] = $this->mdl_scoreboards->today_matches();
        if ($datamarcador['scores'] == false) {
            $datamarcador['scores'] = $this->mdl_scoreboards->last_matches();

        }
        $data['marcadorvivo'] = $this->marcadorVivo();

        return $this->load->view('header2', $data, TRUE);

    }


}