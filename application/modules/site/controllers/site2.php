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
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('ranking');
        $this->load->module('jugadores');

        $data['pageTitle'] = "Movistar Mundialista";

        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }

        if ($isMobile) {

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

        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();

            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();

            $data['content'] = $this->videos->viewVideosHeader();
            $data['content'] .= $this->contenido->view_banner_contenidotop();
            $data['content'] .= $this->ranking->viewRankingLlaves();
            $data['content'] .= $this->ranking->viewRankingGrupos();
            $data['content'] .= $this->contenido->view_noticia_home();
            $data['content'] .= $this->contenido->view_banner_contenido();
            $data['content'] .= $this->contenido->view_historias();
            $data['content'] .= $this->contenido->view_estadios();

        }


        $this->templates->_index($data);
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

        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {

            $data['cabecera'] = $this->contenido->menum();

            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->contenido->view_noticia_open($idNoticia);
            $data['footer'] = '';
            $data['sidebar'] = '';

        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();

            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->videos->viewVideosHeader();
            $data['content'] .= $this->contenido->view_noticia_open($idNoticia);
            $data['content'] .= $this->contenido->view_banner_contenido();
            $data['content'] .= $this->contenido->view_historias();
            $data['content'] .= $this->contenido->view_estadios();

        }


        $data['pageTitle'] = "Noticias - Movistar FIFAWorldCup";
        $this->templates->_index($data);
    }

    public function historias()
    {
        //$this->output->cache(300);
        $idHistoria = $this->uri->segment(4);

        if (!is_numeric ( $idHistoria )) {
            $idHistoria = 1;
        } else {
            if ($idHistoria) {
                if (is_null($idHistoria)) {
                    $idHistoria = 1; // por default asigna el primero alemania
                }
            } else {
                $idHistoria = 182;
            }
        }


        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('ranking');
        $this->load->module('jugadores');


        $data['pageTitle'] = "Historias - Movistar FIFAWorldCup";


        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {

            $data['cabecera'] = $this->contenido->menum();
            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->ranking->menuranking();
            $data['content'] .= $this->contenido->view_historia_open($idHistoria);
            $data['footer'] = '';
            $data['sidebar'] = '';

        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();
            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->contenido->view_historia_open($idHistoria);
        }
        $this->templates->_index($data);
    }

    public function galerias()
    {
        //$this->output->cache(30);
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $data['pageTitle'] = "Galerias - Movistar FIFAWorldCup";


        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {

            $data['cabecera'] = $this->contenido->menum();
            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->galerias->viewGaleriasFull();
            $data['footer'] = '';

            $data['sidebar'] = '';

        } else {

            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();


            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();

            $data['content'] = $this->videos->viewVideosHeader();
            $data['content'] .= $this->galerias->viewGaleriasFull();
            $data['content'] .= $this->contenido->view_historias();
            $data['content'] .= $this->contenido->view_estadios();

        }


        $this->templates->_index($data);
    }

    public function videos()
    {

        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $data['pageTitle'] = "Galerias - Movistar FIFAWorldCup";


        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {

            $data['cabecera'] = $this->contenido->menum();
            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->videos->viewVideosFull();
            $data['footer'] = '';

            $data['sidebar'] = '';

        } else {

            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();


            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();

            $data['content'] = $this->videos->viewVideosHeader();
            $data['content'] .= $this->videos->viewVideosFull();
            $data['content'] .= $this->contenido->view_historias();
            $data['content'] .= $this->contenido->view_estadios();

        }


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

        $data['pageTitle'] = "Grupos - Movistar FIFAWorldCup";


        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {

            $data['cabecera'] = $this->contenido->menum();
            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->ranking->menuranking();
            $data['content'] .= $this->ranking->viewRankingFases($idGrupo);
            $data['footer'] = '';
            $data['sidebar'] = '';

        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();


            $data['sidebar'] = $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->ranking->menuranking();

            $data['content'] .= $this->partidos->segundafase();
            $data['content'] .= $this->ranking->viewRankingFases($idGrupo);
        }

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

        $data['pageTitle'] = "Calendario - Movistar FIFAWorldCup";


        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {

            $data['cabecera'] = $this->contenido->menum();
            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->partidos->minutoAminuto();

            $data['footer'] = '';
            $data['sidebar'] = '';

        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();


            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
             $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->videos->viewVideosHeader();
            $data['content'] .= $this->partidos->minutoAminuto();

        }


        $this->templates->_index($data);
    }

    public function goleadores()
    {
        //$this->output->cache(30);
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('videos');
        $this->load->module('templates');
        $this->load->module('galerias');
        $this->load->module('contenido');
        $this->load->module('jugadores');
        $data['pageTitle'] = "Goleadores - Movistar FIFAWorldCup";

        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {
            $data['cabecera'] = $this->contenido->menum();
            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->contenido->header_mobile(); //doble espacio
            $data['content'] .= $this->jugadores->viewRankingGoleadoresFull();
            $data['footer'] = '';
            $data['sidebar'] = '';
        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();

            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
             $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->videos->viewVideosHeader();
            $data['content'] .= $this->jugadores->viewRankingGoleadoresFull();
            $data['content'] .= $this->contenido->view_historias();
            $data['content'] .= $this->contenido->view_estadios();
        }

        $this->templates->_index($data);
    }

    public function equipo()
    {
        //validamos en caso de no eistir el parametro
        $idEquipo = $this->uri->segment(3);

        if (!is_numeric ( $idEquipo )) {
            $idEquipo = 1;
        } else {
        if ($idEquipo) {
            if (is_null($idEquipo)) {
                $idEquipo = 1; // por default asigna el primero alemania
            }
        } else {
            $idEquipo = 1;
        }
        }

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

        $data['pageTitle'] = "Equipos - Movistar FIFAWorldCup";

        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;

        }

        if ($isMobile) {
            $data['cabecera'] = $this->contenido->menum();

            $data['content'] = $this->contenido->header_mobile();
            $data['content'] .= $this->contenido->header_mobile();
            $data['content'] .= $this->fichas->viewFichaEquipo($idEquipo);
            $data['content'] .= $this->partidos->partidosEquipo($idEquipo);
            $data['content'] .= $this->ranking->viewRankingFasesEquipo($idEquipo);

            $data['content'] .= $this->fichas->viewFichaEquipodesc($idEquipo);
            $data['content'] .= $this->contenido->view_noticias_equipo($idEquipo);
            $data['content'] .= $this->jugadores->viewJugadoresEquipo($idEquipo);
            $data['content'] .= $this->equipos_campeonato->viewEquiposBanderas();
            $data['footer'] = '';

            $data['sidebar'] = '';

        } else {
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();

            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->equipos_campeonato->viewEquiposBanderas();
            $data['content'] .= $this->fichas->viewFichaEquipo($idEquipo);
            $data['content'] .= $this->partidos->partidosEquipo($idEquipo);
            $data['content'] .= $this->ranking->viewRankingFasesEquipo($idEquipo);

            $data['content'] .= $this->fichas->viewFichaEquipodesc($idEquipo);
            $data['content'] .= $this->contenido->view_noticias_equipo($idEquipo);
            // $data['content'] .= $this->jugadores->viewJugadoresEquipo($idEquipo);

            $data['content'] .= $this->contenido->view_historias();
            $data['content'] .= $this->contenido->view_estadios();

        }

        $this->templates->_index($data);
    }
    public function minutoAminuto(){
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
        //$data['sidebar'] .= $this->partidos->partidosFecha();
        $this->templates->_index($data);
    }

    public function minutoAminutoPartido(){
        if ($this->uri->segment(3)!="" )
            $id = $this->uri->segment(3);
        else
            $id = "1";
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('estadios');
        $this->load->module('galerias');
        $this->load->module('jugadores');
        $this->load->module('ranking');
        $this->load->module('videos');
        $this->load->module('contenido');
        $data['pageTitle'] = "Minuto a minuto - Mundial Movistar";

        $this->load->library('user_agent');
        $mobiles=array('Apple iPhone','Android');
        if ($this->agent->is_mobile()){

            $data['cabecera']  = $this->contenido->menum();
            //$data['content'] = $this->partidos->minutoAminuto();
            $data['content'] = $this->partidos->getPartido($id);
            $data['footer'] = '';
            $data['sidebar'] = '';
        }else{
            $data['cabecera'] = $this->contenido->cabecera();
            $data['cabecera'] .= $this->contenido->menu();
            $data['footer'] = $this->contenido->footer();
            $data['sidebar'] = $this->contenido->view_twitter();
            $data['sidebar'] .= $this->contenido->banner_sidebar();
            //$data['sidebar'] .= $this->partidos->partidosFecha();
            //$data['sidebar'] .= $this->contenido->view_trivia();
            $data['sidebar'] .= $this->jugadores->viewRankingGoleadores();
            $data['sidebar'] .= $this->galerias->viewGaleriaHome();;

            $data['content'] = $this->videos->viewVideosHeader();
            //$data['content'] .= $this->partidos->minutoAminuto();
            $data['content'] .= $this->partidos->getPartido($id);
        }
        $this->templates->_index($data);
    }
    public function minutoAminuto2()
    {
        $this->load->module('grupos');
        $this->load->module('partidos');
        $this->load->module('templates');
        $this->load->module('contenido');
        $data['pageTitle'] = "Minuto a minuto - Movistar FIFAWorldCup";
        $data['content'] = $this->partidos->getGruposCalendarioTab();

        $partidoMinutoAMinuto = $this->uri->segment(4);
        if (isset ($partidoMinutoAMinuto)) {
            $data['content'] = $this->partidos->minutoAMinuto($partidoMinutoAMinuto);
        }

        $data['sidebar'] = $this->contenido->view_twitter();
        $data['sidebar'] .= $this->partidos->getMinutoAminutoMod();
        //$data['sidebar'] .= $this->partidos->partidosFecha();
        $this->templates->_index($data);
    }


    public function ajxminutoaminuto($id){
    	$this->load->module('partidos');
    	echo $this->partidos->ajxgetPartido($id);
    }

    public function ajxcomentario($id){
    	$this->load->module('comentarios');
    	echo $this->comentarios->ajxComentarios($id);
    }

    public function equipos(){
        $this->load->module('equipos');
        $this->load->module('templates');
        $data['pageTitle'] = "Equipos";
        $data['body'] = $this->equipos->view();
        $this->templates->demoTemplate($data);
    }

    public function estadios()
    {
        //$this->output->cache(300);
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

    function syncXmlCadaMinuto()
    {
        //Syncronización de archivos que tienen informacion dinámica

        $url = base_url("jugadores/syncGoledores");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("tarjetas/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("goles/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);


        $url = base_url("cambios/syncCambios");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);


        $url = base_url("comentarios/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("partidos/syncResultados");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);


    }


    function syncXmlCadaHora()
    {

        $url = base_url("jugadores/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        //Syncronización de archivos que tienen informacion dinámica
        $url = base_url("contenido/sync_noticias");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);


        $url = base_url("fases/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("grupos/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("partidos/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("ranking/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        /*$url = base_url("alineaciones/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);*/

    }


    function syncXmlContenidoStatico()
    {

        //Ejecuta este metodo solo una vez para sincronizar contenido estático

        //En el server se quita el bse y se pone url
        //$url='http://64.150.191.240/contenido/sync_noticias';

        $url = base_url("contenido/sync_historias");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("contenido/sync_anecdotas");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("equipos/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("equipos_campeonato/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

        $url = base_url("estadios/sync");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        echo curl_exec($ch);
        curl_close($ch);

    }

    public function resultado_trivia()
    {
        $cont = 0;

        if ($_POST['resp1'] == 3) {
            $cont = $cont + 1;
        }
        if ($_POST['resp2'] == 2) {
            $cont = $cont + 1;
        }
        if ($_POST['resp3'] == 1) {
            $cont = $cont + 1;
        }
        if ($_POST['resp4'] == 2) {
            $cont = $cont + 1;
        }
        if ($_POST['resp5'] == 1) {
            $cont = $cont + 1;
        }
        if ($_POST['resp6'] == 2) {
            $cont = $cont + 1;
        }
        if ($_POST['resp7'] == 1) {
            $cont = $cont + 1;
        }
        if ($_POST['resp8'] == 3) {
            $cont = $cont + 1;
        }

        echo $cont;
    }

}