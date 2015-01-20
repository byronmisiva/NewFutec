<?php

class Site extends MY_Controller
{
    public $model = 'mdl_site';
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->home();
    }

    // para la final se comentan la llamada a las secciones.
    public function movil()
    {
        // para la final se comentan la llamada a las secciones.
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";
        $this->load->library('user_agent');

        $data['top1'] = "";
        $data['header1'] = "";

        $bannerMedio = $this->banners->fe_smart_bottom();
        $dataHeader2['FE_Bigboxbanner'] = "";
        $data['header2'] = $this->contenido->header2mobile($dataHeader2) . $bannerMedio;
        $data['top2'] = "";

        //Resultados tabla de posiciones
        $this->load->module('scoreboards');
        $tablaposiciones = $this->scoreboards->tablaposiciones(SERIE_A);

        $data['content'] = $this->noticias->viewNoticiasHome() . $tablaposiciones;
        $data['sidebar'] = "";

        $data['footer'] = '';
        $data['bottom'] = $this->contenido->bottom();

        $this->templates->_index($data);
    }

    // para la final se comentan la llamada a las secciones.
    public function home()
    {
        $this->load->library('user_agent');
        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }
        if ($isMobile) {
            redirect(base_url(). 'site/movil/');
        } else {
            // para la final se comentan la llamada a las secciones.
            $this->output->cache(CACHE_DEFAULT);
            $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";

            $this->load->module('noticias');
            $this->load->module('templates');
            $this->load->module('contenido');
            $this->load->module('banners');
            $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
            $data['header1'] = $this->contenido->menu();

            $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();
            $data['header2'] = $this->contenido->header2($dataHeader2);
            $data['top2'] = $this->banners->FE_Megabanner();

            $data['content'] = $this->noticias->viewNoticiasHome();
            $data['sidebar'] = $this->contenido->sidebar();


            $data['footer'] = $this->contenido->footer();
            $data['bottom'] = $this->contenido->bottom();

        }
        $this->templates->_index($data);
    }

    public function contacto()
    {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'utf8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = FALSE;

        $this->email->initialize($config);
        $this->email->from('info@misiva.com.ec','Contacto Futbolecuador.com');
        $this->email->to('ddelosreyes@futbolecuador.com');
        $this->email->cc('bherrera@misiva.com.ec');
        $data['informacion']=$_POST;
        $body=$this->load->view( 'email-contacto',$data,TRUE);
        $this->email->subject("Contacto Futbolecuador.com");
        $this->email->message($body);
        $this->email->send();
        echo "Mensaje Enviado";
    }

    public function publicidad()
    {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['charset'] = 'utf8';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = FALSE;

        $this->email->initialize($config);
        $this->email->from('info@misiva.com.ec','Publicidad Futbolecuador.com');
        $this->email->to('ddelosreyes@futbolecuador.com');
        $this->email->cc('bherrera@misiva.com.ec');
        $data['informacion']=$_POST;
        $body=$this->load->view( 'email-publicidad',$data,TRUE);
        $this->email->subject("Publicidad Futbolecuador.com");
        $this->email->message($body);
        $this->email->send();
        echo "Mensaje Enviado";
    }

    public function masnoticias()
    {
        //$this->output->cache(CACHE_DEFAULT);
        $this->load->module('noticias');

        $offset = $_POST["offset"];
        $idsection = $_POST["section"];
        $posSection = $_POST["pos"];

        if ($idsection == "") {
            echo $this->noticias->viewNoticiasHome(false, RESULT_PAGE - 1, $offset);
        } else {
            echo $this->noticias->viewSeccions("", $idsection, $posSection, "", RESULT_PAGE - 1, $offset, false);
        }
    }

    public function noticia()
    {
        // para la final se comentan la llamada a las secciones.
        $this->output->cache(CACHE_DEFAULT);


        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');
// carga la informacion de la noticia
        $idNoticia = $this->uri->segment(4);
        $storia = $this->story->get_complete($idNoticia);
        $aux = $this->mdl_story->get_story($idNoticia);
        $bodytag = str_replace('"', '', strip_tags($aux->title));

        $data['pageTitle'] = "Futbol Ecuador - " . $bodytag;

        // fin carga la informacion de la noticia


        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }

        /* if ($isMobile) {

             $data['cabecera'] = $this->contenido->menum();

             $data['content'] = $this->contenido->header_mobile();
             //$data['content'] .= $this->partidos->partidosFechaMovil();
             $data['content'] .= $this->partidos->partidosFinal();
             $data['content'] .= $this->contenido->view_banner_contenidotop();
             $data['content'] .= $this->contenido->view_noticia_home();
             $data['content'] .= $this->contenido->view_banner_contenido();
             $data['content'] .= $this->contenido->view_twitter();

             $data['footer'] = '';

             $data['sidebar'] = '';

         } else {*/

        $data['top1'] = $this->banners->top1();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        //   $data['header2'] = $this->contenido->header2($dataHeader2);
        //   $data['top2'] = $this->banners->FE_Megabanner();

        $data['content'] = $storia . $this->noticias->viewNoticiasHome(TOTALNEWSINOPENNEWS);
        $data['sidebar'] = $this->contenido->sidebarOpenNews();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();


        /*   }*/
        $this->templates->_index($data);
    }

    public function zonafe()
    {
        $this->seccion(ZONAFE, ZONAFEPOS, "Zona FE", "zonafe");
    }

    public function seriea()
    {
        $this->seccion(SECTION_SERIE_A, 2, "Serie A", "seriea");
    }

    public function serieb()
    {
        $this->seccion(SECTION_SERIE_B, 2, "Serie B", "serieb", "", SERIE_B);
    }

    public function seleccion()
    {
        $this->seccion(SECTION_SELECCION, 2, "Selección", "seleccion");
    }

    public function lavoz()
    {
        $this->seccion(LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "La voz de las tribunas", "lavoz");
    }

    public function masleido()
    {
        $this->seccion(LOMASLEIDO, LOMASLEIDOPOS, "Lo más leído", "masleido", "masleido");
    }

    public function nuestrosembajadores()
    {
        $this->seccion(ZONANUESTROSEMBAJADORES, ZONANUESTROSEMBAJADORESPOS, "Nuestros Embajadores", "nuestrosembajadores", "nuestrosembajadores");
    }

    public function copalibertadores()
    {
        $this->seccion(ZONACOPALIBERTADORES, ZONACOPALIBERTADORESPOS, "Copa Libertadores", "copalibertadores", "copalibertadores" );
       // $this->seccion(ZONACOPALIBERTADORES, ZONACOPALIBERTADORESPOS, "Copa Libertadores", "copalibertadores", "copalibertadores" , LIBERTADORES);
    }

    public function copaamerica()
    {
        $this->seccion(ZONACOPAAMERICA, ZONACOPAAMERICAPOS, "Copa América", "copaamerica", "copaamerica");
    }

    public function copasudamericana()
    {
        $this->seccion(ZONACOPASUDAMERICANA, ZONACOPASUDAMERICANAPOS, "Copa Sudamericana", "copasudamericana", "copasudamericana", SUDAMERICANA);
    }

    public function futbolinternacional()
    {
        $this->seccion(ZONAINTERNACIONAL, ZONAINTERNACIONALPOS, "Futbol Internacional", "futbolinternacional", "futbolinternacional");
    }


    public function seccion($seccion, $seccionpos, $nameSeccion, $urlSeccion, $tipoSeccion = "", $serie = SERIE_A)
    {
        // para la final se comentan la llamada a las secciones.
        $this->output->cache(CACHE_DEFAULT);

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }

        /* if ($isMobile) {

             $data['cabecera'] = $this->contenido->menum();
             $data['content'] = $this->contenido->header_mobile();
             //$data['content'] .= $this->partidos->partidosFechaMovil();
             $data['content'] .= $this->partidos->partidosFinal();
             $data['content'] .= $this->contenido->view_banner_contenidotop();
             $data['content'] .= $this->contenido->view_noticia_home();
             $data['content'] .= $this->contenido->view_banner_contenido();
             $data['content'] .= $this->contenido->view_twitter();

             $data['footer'] = '';
             $data['sidebar'] = '';

         } else {*/

        $data['top1'] = $this->banners->top1();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        if ($tipoSeccion == "masleido") {
            $noticiasCuerpo = $this->noticias->viewseccion_plus($nameSeccion, $seccion, $seccionpos, $urlSeccion);


        } else {
            $noticiasCuerpo = $this->noticias->viewSeccions($nameSeccion, $seccion, $seccionpos, $urlSeccion);
        }

        $storia = "";
        $bodytag = $nameSeccion;

        // carga la informacion de la noticia
        $idNoticia = $this->uri->segment(4);
        if ($idNoticia) {
            $storia = $this->story->get_complete($idNoticia);
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
        }

        $data['pageTitle'] = "Futbol Ecuador - " . $bodytag;
        // fin carga la informacion de la noticia

        $data['content'] = $storia . $noticiasCuerpo;
        $data['sidebar'] = $this->contenido->sidebarOpenNews(false, $serie);

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        /*   }*/
        $this->templates->_index($data);
    }

    public function femagazine()
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $femagazine = $this->contenido->femagazine();
        $this->singleConten("Fe Magazine", $femagazine);
    }

    public function search()
    {
        $this->load->module('contenido');
        $search = $this->contenido->search();
        $this->singleConten("Búsqueda", $search);
    }

    public function goleadores($serie = SERIE_A)
    {
        $this->output->cache(CACHE_DEFAULT);
        $id = $this->uri->segment(3);
        if ($id) {
            $serie = $id;
        }

        $this->load->module('strikes');
        $goleadores = $this->strikes->goleadoresFull($serie);
        $this->singleConten("Goleadores", $goleadores);
    }

    public function tabladeposiciones($serie = SERIE_A)
    {
        $this->output->cache(CACHE_DEFAULT);
        $id = $this->uri->segment(3);
        if ($id) {
            $serie = $id;
        }

        $this->load->module('scoreboards');
        $tablapocisiones = $this->scoreboards->scoreboardFull($serie);
        $this->singleConten("Tabla de posiciones", $tablapocisiones);
    }

    public function resultados()
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('matches');

        $id = $this->uri->segment(3);
        $name = $this->matches->getChampionship($id)->row();

        $title = $name->name;
        //$title = "Calendario - Campeonato Serie B 2014";
        $fechas = $this->matches->matches($id, $title);
        $this->singleConten($title, $fechas);
    }

    public function partido()
    {
        $this->output->cache(CACHE_DEFAULT);

        $this->load->module('matches');
        $id = $this->uri->segment(4);

        $match = $this->matches->getMatch($id);
        $title = $this->matches->getMatchName($id);


        $this->singleConten($title, $match);
    }


    public function fueradejuego()
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $fueradejuego = $this->contenido->view_fuera_de_juego();
        $this->singleConten("Fuera de Juego", $fueradejuego);
    }

    public function singleConten($nameSeccion, $contenSeccion)
    {
        // para la final se comentan la llamada a las secciones.
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }

        /* if ($isMobile) {

             $data['cabecera'] = $this->contenido->menum();
             $data['content'] = $this->contenido->header_mobile();
             //$data['content'] .= $this->partidos->partidosFechaMovil();
             $data['content'] .= $this->partidos->partidosFinal();
             $data['content'] .= $this->contenido->view_banner_contenidotop();
             $data['content'] .= $this->contenido->view_noticia_home();
             $data['content'] .= $this->contenido->view_banner_contenido();
             $data['content'] .= $this->contenido->view_twitter();

             $data['footer'] = '';
             $data['sidebar'] = '';

         } else {*/

        $data['top1'] = $this->banners->top1();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        $bodytag = $nameSeccion;

        $data['pageTitle'] = "Futbol Ecuador - " . $bodytag;

        // fin carga la informacion de la noticia
        $data['content'] = $contenSeccion;
        $data['sidebar'] = $this->contenido->sidebarOpenNews();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        /*   }*/
        $this->templates->_index($data);
    }


    public function equipo()
    {
        $idEquipo = $this->uri->segment(4);
        $shortEquipo = $this->uri->segment(3);
        $this->section_equipo($idEquipo, 2, $shortEquipo);
    }


    public function section_equipo($seccion, $seccionpos, $urlSeccion)
    {
        // para la final se comentan la llamada a las secciones.
        $this->output->cache(CACHE_DEFAULT);
        // Informacion de equipo
        $idNoticia = $this->uri->segment(6);

        $nombreNoticia = $this->uri->segment(5);
        if ($nombreNoticia === "0") {
            $idNoticia = "1";
        }


        $infoSeccionEquipo = $this->mdl_site->getNameSection($seccion);
        $nameSeccion = $infoSeccionEquipo[0]->name;


        if (!$idNoticia) {
            $this->load->module('team');
            $this->load->module('matches');

            $infoEquipo = $this->mdl_site->getNameTeam($nameSeccion);
            if (isset($infoEquipo[0]->stadia_id))
                $stadia_id = $infoEquipo[0]->stadia_id;
            else
                $stadia_id = "";
            $idEquipo = $infoEquipo[0]->id;
            $infoEquipo[0]->stadia = $this->mdl_site->getNameStadia($stadia_id);
            $infoEquipo[0]->histories = $this->mdl_site->getHistories($idEquipo);

            $dataTeam ['infoEquipo'] = $infoEquipo[0];
            $dataTeam ['infoJugadoresEquipo'] = $this->mdl_team->getJugadoresEquipo($idEquipo);
            $dataTeam ['fechas'] = $this->matches->matchesperteam($idEquipo, SERIE_A);
            $infoEquipo = $this->team->getFichaEquipo($dataTeam);

            $cabeceraEquipo = $this->team->getCabeceraEquipo($dataTeam);
            // fin informacion recupera
        } else {
            $infoEquipo = "";
            $cabeceraEquipo = "";
        }

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }

        /* if ($isMobile) {

             $data['cabecera'] = $this->contenido->menum();
             $data['content'] = $this->contenido->header_mobile();
             //$data['content'] .= $this->partidos->partidosFechaMovil();
             $data['content'] .= $this->partidos->partidosFinal();
             $data['content'] .= $this->contenido->view_banner_contenidotop();
             $data['content'] .= $this->contenido->view_noticia_home();
             $data['content'] .= $this->contenido->view_banner_contenido();
             $data['content'] .= $this->contenido->view_twitter();

             $data['footer'] = '';
             $data['sidebar'] = '';

         } else {*/

        $data['top1'] = $this->banners->top1();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();
        //en caso
        if ($infoEquipo != "") {
            $noticiasCuerpo = $this->noticias->viewSeccionsEquipo("", $seccion, $seccionpos, "equipo/" . $urlSeccion . "/" . $seccion, 4);
        } else {
            $noticiasCuerpo = $this->noticias->viewSeccions("Noticias de " . $nameSeccion, $seccion, $seccionpos, "equipo/" . $urlSeccion . "/" . $seccion);
        }

        $storia = "";
        $bodytag = $nameSeccion;

        // carga la informacion de la noticia


        if ($idNoticia) {
            if ($nombreNoticia == "0") {
                $storia = "";
            } else {
                $storia = $this->story->get_complete($idNoticia);
            }
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
        }

        $data['pageTitle'] = "Futbol Ecuador - " . $bodytag;
        // fin carga la informacion de la noticia

        // en caso de que sea la portada o el listado de noticias
        if ($infoEquipo != "") {
            $data['content'] = $cabeceraEquipo . $noticiasCuerpo . $infoEquipo;
        } else {
            $data['content'] = $storia . $noticiasCuerpo;
        }

        $data['sidebar'] = $this->contenido->sidebarOpenNews();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        /*   }*/
        $this->templates->_index($data);
    }


}