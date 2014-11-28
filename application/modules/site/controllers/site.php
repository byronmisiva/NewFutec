<?php

class Site extends MY_Controller
{
    public $model = FALSE;
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
            $noticiasCuerpo = $this->noticias->viewseccion_plus ($nameSeccion, $seccion, $seccionpos, $urlSeccion);

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
}