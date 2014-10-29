<?php

class Movil extends MY_Controller
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
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('ranking');
        $this->load->module('jugadores');

        $data['pageTitle'] = "Home - Mundial Movistar";

        $data['sidebar'] = $this->contenido->view_twitter();
    //    $data['sidebar'] .= $this->contenido->banner_sidebar();
    //    $data['sidebar'] .= $this->partidos->partidosFecha();
    //    $data['sidebar'] .= $this->contenido->view_trivia();
    //    $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
    //    $data['sidebar'] .= $this->galerias->viewGaleriaHome();

        //$data['content'] = $this->videos->viewVideosHeader();
        $data['content'] = $this->partidos->partidosFecha();
        $data['content'] .= $this->contenido->view_banner_contenido();
        $data['content'] .= $this->contenido->view_noticia_home();
        $data['content'] .= $this->contenido->view_banner_contenido();


        $this->templates->_movil($data);
    }

    public function noticia()
    {
        $idNoticia = $this->uri->segment(4);

        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('ranking');
        $this->load->module('jugadores');


        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

        $data['content'] = $this->videos->viewVideosHeader();

        $data['content'] .= $this->contenido->view_noticia_open($idNoticia);


        $data['content'] .= $this->contenido->view_banner_contenido();
        $data['content'] .= $this->contenido->view_historias();
        $data['content'] .= $this->contenido->view_estadios();

        $data['pageTitle'] = "Noticias - Mundial Movistar";
        $this->templates->_index($data);
    }
    public function historias()
    {
        $idHistoria = $this->uri->segment(4);

        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('ranking');
        $this->load->module('jugadores');


        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();;



        $data['content']  = $this->contenido->view_historia_open($idHistoria);


        $data['pageTitle'] = "Historias - Mundial Movistar";
        $this->templates->_index($data);
    }

    public function galerias()
    {
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $data['pageTitle'] = "Home - Mundial Movistar";

        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();

        $data['content'] = $this->videos->viewVideosHeader();
        $data['content'] .= $this->galerias->viewGaleriasFull();
        $data['content'] .= $this->contenido->view_historias();
        $data['content'] .= $this->contenido->view_estadios();
        $this->templates->_index($data);
    }

    public function grupos()
    {
        $idGrupo = $this->uri->segment(3);

        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('ranking');
        $this->load->module('jugadores');

        $data['pageTitle'] = "Grupos - Mundial Movistar";

        $data['sidebar'] = $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

        $data['content'] = $this->ranking->menuranking();
        $data['content'] .= $this->ranking->viewRankingFases($idGrupo);
        $this->templates->_index($data);
    }

    public function calendario()
    {

        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $data['pageTitle'] = "Home - Mundial Movistar";

        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

        $data['content'] = $this->videos->viewVideosHeader();
        $data['content'] .= $this->partidos->minutoAminuto();
        $this->templates->_index($data);
    }

    public function goleadores()
    {
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $data['pageTitle'] = "Home - Mundial Movistar";

        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

        $data['content'] = $this->videos->viewVideosHeader();
        $data['content'] .= $this->jugadores->viewRankingGoleadoresFull();
        $data['content'] .= $this->contenido->view_historias();
        $data['content'] .= $this->contenido->view_estadios();
        $this->templates->_index($data);
    }

    public function equipo()
    {
        $idEquipo = $this->uri->segment(3);
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $this->load->module('equipos_campeonato');
        $this->load->module('fichas');
        $this->load->module('ranking');
        $data['pageTitle'] = "Home - Mundial Movistar";

        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->contenido->banner_sidebar();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $data['sidebar'] .= $this->contenido->view_trivia();
        $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
        $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

        $data['content'] = $this->equipos_campeonato->viewEquiposBanderas();
        $data['content'] .= $this->fichas->viewFichaEquipo($idEquipo);
        $data['content'] .= $this->partidos->partidosEquipo($idEquipo);
        $data['content'] .= $this->ranking->viewRankingFasesEquipo($idEquipo);
        $data['content'] .= $this->jugadores->viewJugadoresEquipo($idEquipo);
        $data['content'] .= $this->contenido->view_historias();
        $data['content'] .= $this->contenido->view_estadios();

        $this->templates->_index($data);
    }

    public function minutoAminuto()
    {
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('templates');
        $this->load->module('contenido');
        $data['pageTitle'] = "Minuto a minuto - Mundial Movistar";
        $data['content'] = $this->partidos->getGruposCalendarioTab();

        $partidoMinutoAMinuto = $this->uri->segment(4);
        if (isset ($partidoMinutoAMinuto)) {
            $data['content'] = $this->partidos->minutoAMinuto($partidoMinutoAMinuto);
        }

        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->partidos->getMinutoAminutoMod();
        $data['sidebar'] .= $this->partidos->partidosFecha();
        $this->templates->_index($data);
    }


    public function equipos()
    {
        $this->load->module('equipos');
        $this->load->module('templates');
        $data['pageTitle'] = "Equipos";
        $data['body'] = $this->equipos->view();
        $this->templates->demoTemplate($data);
    }

    public function estadios()
    {
        $this->load->module('estadios');
        $this->load->module('templates');
        $data['pageTitle'] = "Estadios";
        $data['body'] = $this->estadios->view();
        $this->templates->demoTemplate($data);
    }

    public function historiasd()
    {
        $this->load->module('contenido');
        $this->load->module('templates');
        $data['pageTitle'] = "Historias";
        $data['body'] = $this->contenido->view_historia();
        $this->templates->demoTemplate($data);
    }


}