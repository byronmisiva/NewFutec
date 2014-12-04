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


    public function home()
    {

        // para la final se comentan la llamada a las secciones.
        //$this->output->cache(30);
        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $data['pageTitle'] = "futbolecuador.com - Noticia abierta Lo mejor del fútbol ecuatoriano";
        $this->load->library('user_agent');

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
        $data['header2'] = $this->contenido->header2($dataHeader2);
        $data['top2'] = $this->banners->FE_Megabanner();

        $data['content'] = $this->noticias->viewNoticiasHome();
        $data['sidebar'] = $this->contenido->sidebar();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();


        /*   }*/
        $this->templates->_index($data);
    }

    public function noticia()
    {
        // para la final se comentan la llamada a las secciones.
        //$this->output->cache(30);


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
        $this->seccion(ZONAFE, ZONAFEPOS, "Zona Fe", "zonafe");
    }

    public function seriea()
    {
        $this->seccion(SECTION_SERIE_A, 1, "Serie A", "seriea");
    }

    public function serieb()
    {
        $this->seccion(SECTION_SERIE_B, 1, "Serie B", "serieb");
    }

    public function seleccion()
    {
        $this->seccion(SECTION_SELECCION, 1, "Selección", "seleccion");
    }

    public function lavoz()
    {
        $this->seccion(LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "La voz de las tribunas", "lavoz");
    }

    public function masleido()
    {
        $this->seccion(LOMASLEIDO, LOMASLEIDOPOS, "Lo más leido", "masleido", "masleido");
    }

    public function nuestrosembajadores()
    {
        $this->seccion(ZONANUESTROSEMBAJADORES, ZONANUESTROSEMBAJADORESPOS, "Nuestros embajadores", "nuestrosembajadores", "nuestrosembajadores");
    }

    public function copalibertadores()
    {
        $this->seccion(ZONACOPALIBERTADORES, ZONACOPALIBERTADORESPOS, "Copa Libertadores", "copalibertadores", "copalibertadores");
    }

    public function copaamerica()
    {
        $this->seccion(ZONACOPAAMERICA, ZONACOPAAMERICAPOS, "Copa América", "copaamerica", "copaamerica");
    }

    public function copasudamericana()
    {
        $this->seccion(ZONACOPASUDAMERICANA, ZONACOPASUDAMERICANAPOS, "Copa Sudamericana", "copasudamericana", "copasudamericana");
    }

    public function futbolinternacional()
    {
        $this->seccion(ZONAINTERNACIONAL, ZONAINTERNACIONALPOS, "Futbol Internacional", "futbolinternacional", "futbolinternacional");
    }


    public function seccion($seccion, $seccionpos, $nameSeccion, $urlSeccion, $tipoSeccion = "")
    {
        // para la final se comentan la llamada a las secciones.
        //$this->output->cache(30);

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

            // $noticiasCuerpo = $this->noticias->viewSeccions($nameSeccion, $seccion, $seccionpos, $urlSeccion);
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
        $data['sidebar'] = $this->contenido->sidebarOpenNews();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        /*   }*/
        $this->templates->_index($data);
    }

    public function femagazine()
    {
        $this->singleConten("Fe Magazine", "Contenido de muestra FEMAGAZINE");
    }

    public function goleadores()
    {
        $this->singleConten("Goleadores", "Contenido de muestra Goleadores");
    }

    public function tabladeposiciones()
    {
        $this->singleConten("Tabla de posiciones", "Contenido de muestra TABLA DE POSICIONES");
    }

    public function resultados()
    {

        $this->singleConten("Calendario", "Contenido de muestra RESULTADOS");
    }

    public function fueradejuego()
    {
        $this->singleConten("Fuera de Juego", "Contenido de muestra FUERA DE JUEGO");
    }

    public function singleConten($nameSeccion, $contenSeccion)
    {
        // para la final se comentan la llamada a las secciones.
        //$this->output->cache(30);
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
        $this->section_equipo($idEquipo, 1, $shortEquipo);
    }


    public function section_equipo($seccion, $seccionpos, $urlSeccion)
    {
        // para la final se comentan la llamada a las secciones.
        //$this->output->cache(30);
        // Informacion de equipo
        $this->load->module('team');
//
        $infoSeccionEquipo = $this->mdl_site->getNameSection($seccion);
        $nameSeccion = $infoSeccionEquipo[0]->name;
//
        $infoEquipo = $this->mdl_site->getNameTeam($nameSeccion);
        if (isset($infoEquipo[0]->stadia_id))
            $stadia_id = $infoEquipo[0]->stadia_id;
        else
            $stadia_id = "";

        $idEquipo = $infoEquipo[0]->id;
        $infoEquipo[0]->stadia = $this->mdl_site->getNameStadia($stadia_id);
        $infoEquipo[0]->histories = $this->mdl_site->getHistories($idEquipo);
//        $dataTeam =  [];
//        $dataTeam ['infoEquipo'] = $infoEquipo[0];
//        $infoEquipo = $this->team->getFicha($dataTeam);

        $infoEquipo = "xx";
//        $nameSeccion = "ss";

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
        $noticiasCuerpo = $this->noticias->viewSeccions($nameSeccion, $seccion, $seccionpos, "equipo/" . $urlSeccion . "/" . $seccion);


        $storia = "";
        $bodytag = $nameSeccion;

        // carga la informacion de la noticia
        $idNoticia = $this->uri->segment(6);
        if ($idNoticia) {
            $storia = $this->story->get_complete($idNoticia);
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
        }

        $data['pageTitle'] = "Futbol Ecuador - " . $bodytag;
        // fin carga la informacion de la noticia


        $data['content'] = $infoEquipo . $storia . $noticiasCuerpo;
        $data['sidebar'] = $this->contenido->sidebarOpenNews();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        /*   }*/
        $this->templates->_index($data);
    }


}