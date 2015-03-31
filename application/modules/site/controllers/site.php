<?php

class Site extends MY_Controller
{
    public $model = 'mdl_site';
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    function verificarDispositivo()
    {
        $this->load->library('user_agent');
        $mobiles = array('Sony Ericsson', 'Apple iPhone', 'Ipad', 'Android', 'Windows CE', 'Symbian S60', 'Apple iPad', "LG", "Nokia", "BlackBerry");
        $isMobile = "0";
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if ($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i', $this->agent->agent) == 0)
                $m = "Android Tablet";
            switch ($m) {
                case 'Apple iPad':
                    $isMobile = "0";
                    break;
                case 'Android Tablet':
                    $isMobile = "0";
                    break;
                case in_array($m, $mobiles):
                    $isMobile = "1";
                    break;
            }
        }

        return $isMobile;
        /*
        $this->load->library('user_agent');
        $mobiles=array('iPad','Android','Windows CE','Symbian S60','Apple iPad');
        $movil="0";
        if ($this->agent->is_mobile()){
            $movil="1";
            $m=$this->agent->mobile();
            if($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i',$this->agent->agent) == 0)
                $m = "Android Tablet";
            switch($m){
                case 'Apple iPad':
                    $movil="0";
                    break;
                case 'Android Tablet':
                    $movil="0";
                    break;
                case in_array($m,$mobiles):
                    $movil="0";
                    break;
            }
        }
        return $movil;*/

    }

    public function index()
    {
        if ($this->verificarDispositivo() == "1")
            redirect('site/movil/');
        else

            redirect('home');

        //$this->home();
    }


    // para la final se comentan la llamada a las secciones.
    public function movil()
    {
        // para la final se comentan la llamada a las secciones.

        //$this->output->cache(CACHE_DEFAULT);
        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $data['verMobile'] = $this->verificarDispositivo();
        $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";
        $this->load->library('user_agent');

        $data['top1'] = "";
        $data['header1'] = "";

        $bannerBottom = $this->banners->fe_smart_bottom();
        $bannerTop = $this->banners->fe_smart_top();
        $dataHeader2['FE_Bigboxbanner'] = "";
        $data['header2'] = $this->contenido->header2mobile($dataHeader2) . $bannerTop;

        $marcadorenvivo = $this->contenido->marcadorVivo() ;

        $data['top2'] = "";

        //Resultados tabla de posiciones
        $this->load->module('scoreboards');
        $tablaposiciones = $this->scoreboards->tablaposiciones(SERIE_A);

        $fe_loading_movil = $this->banners->fe_loading_movil();
      // $outbrain  = '<!--Inicio ejemplo -->
      //                  <div data-src="www.futbolecuador.com" class="OUTBRAIN" ></div>
      //                  <script type="text/javascript">(function(){window.OB_platformType=8;window.OB_langJS="http://widgets.outbrain.com/lang_es.js";window.OBITm="1426714580680";window.OB_recMode="brn_strip";var ob=document.createElement("script");ob.type="text/javascript";ob.async=true;ob.src="http"+("https:"===document.location.protocol?"s":"")+"://widgets.outbrain.com/outbrainLT.js";var h=document.getElementsByTagName("script")[0];h.parentNode.insertBefore(ob,h);})();</script>
      //                  <!--Fin ejemplo -->';

        $outbrain =  '<script type="text/javascript" src="https://www.imusicaradios.com.br/go_ccfm/ccfm_embed.js"
onload="CocaColaEmbed(\'ec\',\'true\',10)"></script>
<div class="col-md-12 col-xs-12  margen0 " style="background-color: #f40009; height: 150px">
<div style="width: 300px; margin: 0 auto; "><iframe id="ccfmPlayer" style="width: 300px; height: 15%;"></iframe></div></div>';
        $data['content'] = $marcadorenvivo . $this->noticias->viewNoticiasHome(true, RESULT_PAGE_LITE) . "</div>" . $fe_loading_movil . $bannerBottom . $tablaposiciones .$outbrain;
        $data['sidebar'] = "";

        $data['footer'] = '';
        $data['bottom'] = $this->contenido->bottom();
        $data['fe_splash'] = "";

        $this->templates->_index($data);
    }

    // para la fial se comentan la llamada a las secciones.
    public function home()
    {
        // para la final se comentan la llamada a las secciones.
        if ($this->verificarDispositivo() == "1")
            redirect('site/movil/');

        $this->output->cache(CACHE_DEFAULT);
        $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $data['verMobile'] = $this->verificarDispositivo();
        $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();
        $data['header2'] = $this->contenido->header2($dataHeader2);
        $data['top2'] = $this->banners->FE_Megabanner();

        $data['content'] = $this->noticias->viewNoticiasHome(true);
        $data['sidebar'] = $this->contenido->sidebar();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();

        $data['fe_splash'] = $this->banners->fe_splash();
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
        $this->email->from('info@misiva.com.ec', 'Contacto Futbolecuador.com');
        $this->email->to('ddelosreyes@futbolecuador.com');
        $this->email->cc('jfchiriboga@misiva.com.ec');
        $data['informacion'] = $_POST;
        $body = $this->load->view('email-contacto', $data, TRUE);
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
        $this->email->from('info@misiva.com.ec', 'Publicidad Futbolecuador.com');
        $this->email->to('ddelosreyes@futbolecuador.com');
        $this->email->cc('jfchiriboga@misiva.com.ec');
        $data['informacion'] = $_POST;
        $body = $this->load->view('email-publicidad', $data, TRUE);
        $this->email->subject("Publicidad Futbolecuador.com");
        $this->email->message($body);
        $this->email->send();
        echo "Mensaje Enviado";
    }

    public function masnoticias()
    {
        $this->load->module('noticias');
        $offset = $this->uri->segment(3);
        $porciones = explode("-", $offset);
        $offset = $porciones[1] ;

        $idsection = $this->uri->segment(4);
        $posSection = $this->uri->segment(5);
        $urlSeccion = $this->uri->segment(6);

        if ("equipo" == $urlSeccion  ) {
            $urlSeccion .= "/". $this->uri->segment(7) ."/". $this->uri->segment(8);
        }

        if (!$idsection) {
            $masnoticias = $this->noticias->viewNoticiasHome(false, RESULT_PAGE - 1, $offset);
            if (count($masnoticias) > 0) {
                echo $masnoticias;
            } else {
                echo "error";
            }
        } else {
            echo $this->noticias->viewSeccions("", $idsection, $posSection, $urlSeccion, RESULT_PAGE - 1 , $offset, false);
        }
    }

    public function masMarcadorVivo()
    {
        $this->load->module('contenido');
        echo $this->contenido->marcadorVivo();
    }

    public function MarcadorVivoDetail()
    {
        $idEquipo = $this->uri->segment(3);
        $this->load->module('matches');
        echo $this->matches->getMatch($idEquipo);
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
        if (!$idNoticia){
            $idNoticia = $this->uri->segment(3);
        }
        if (is_numeric($idNoticia))
            if ($idNoticia< 39898)
                redirect('home');
        if ( $idNoticia == 'ref.outcontrol'  )
            redirect('home');

        $storia = $this->story->get_complete($idNoticia);

        $aux = $this->mdl_story->get_story($idNoticia);
        $image = $aux->thumb150;
        $description = $aux->lead;
        $bodytag = str_replace('"', '', strip_tags($aux->title));
        $data['verMobile'] = $this->verificarDispositivo();
        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;
        $data['image'] = $image;
        $data['description'] = $description;
        $data['idnoticia'] = $idNoticia;
        $data['ulrfriend'] = $this->_urlFriendly($aux->title);


        // fin carga la informacion de la noticia
        $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        //   $data['header2'] = $this->contenido->header2($dataHeader2);
        //   $data['top2'] = $this->banners->FE_Megabanner();

        $data['content'] = $storia . $this->noticias->viewNoticiasHome(true, TOTALNEWSINOPENNEWS);
        $data['sidebar'] = $this->contenido->sidebarOpenNews();

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        $this->templates->_index($data);
    }
   public function getnewsjson()
    {
        header ('Content-type: text/html; charset=utf-8');

        //json de consumo de don balon.
        $this->load->module('story');
        // recuperar codigo de don balos
        $data =  $this->db->query("SELECT valor FROM parametros WHERE nombre = 'Don Balón Json'")->result() ;
        $tag = $data[0]->valor;$this->load->module('story');
        // recuperar codigo de don balos
        $data =  $this->db->query("SELECT valor FROM parametros WHERE nombre = 'Don Balón Json'")->result() ;
        $tag = $data[0]->valor;
        $rotativasData = $this->mdl_story->get_banner_tag(4, 44, $tag);
        echo "[";
        $rotativasListado = array();
        foreach($rotativasData as $index=>$noticia){
            $rotativasListado [] = $noticia->id;
            echo "{";
            echo '"id": "'. $noticia->id.'",';
            echo '"titulo": "'.str_replace('"','\"',strip_tags (trim($noticia->subtitle))).'",';
            echo '"resumen": "'.str_replace('"','\"',strip_tags (trim($noticia->lead))).'",';
            echo '"foto": "'."http://www.futbolecuador.com/".$noticia->thumb300.'",';
            echo '"foto_carrusel": "'."http://www.futbolecuador.com/".$noticia->thumb500.'",';
            echo '"link": "'."http://www.futbolecuador.com/site/noticia/".$this->story->_urlFriendly($noticia->subtitle)."/".$noticia->id.'",';
            echo '"mostrar_carrusel": "s",';
            echo '"fecha_creacion": "'.$noticia->created.'"';
            echo "},";

        }



        $data = $this->mdl_story->news_by_tags($tag, TOTALNEWSINDONBALON , 0);

        foreach($data as $index=>$noticia){
            if (!in_array($noticia->id, $rotativasListado)) {
                echo "{";
                echo '"id": "'. $noticia->id.'",';
                echo '"titulo": "'.str_replace('"','\"',strip_tags (trim($noticia->subtitle))).'",';
                echo '"resumen": "'.str_replace('"','\"',strip_tags (trim($noticia->lead))).'",';
                echo '"foto": "'."http://www.futbolecuador.com/".$noticia->thumb300.'",';
                echo '"link": "'."http://www.futbolecuador.com/site/noticia/".$this->story->_urlFriendly($noticia->subtitle)."/".$noticia->id.'",';
                echo '"fecha_creacion": "'.$noticia->created.'"';
                echo "}";
                echo  ($index < count($data) - 1) ? ",":"";
            }
        }
        echo "]";
    }

    public function sidebardonbalon()
    {
        $this->load->module('contenido');
        $this->load->module('templates');

        $data['sidebar'] = $this->contenido->sidebarDonBalon(false, SERIE_A);
       // $this->templates->_index($data);

        echo $this->contenido->sidebarDonBalon(false, SERIE_A);
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
        $this->seccion(LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS, "La Voz de las Tribunas", "lavoz");
    }

    public function masleido()
    {
        $this->seccion(LOMASLEIDO, LOMASLEIDOPOS, "Lo más Leído", "masleido", "masleido");
    }

    public function nuestrosembajadores()
    {
        $this->seccion(ZONANUESTROSEMBAJADORES, ZONANUESTROSEMBAJADORESPOS, "En el Exterior", "nuestrosembajadores", "nuestrosembajadores");
    }
    public function donbalon()
    {
        // recuperar codigo de don balos
        $this->seccion(ZONAINTERNACIONAL, ZONAINTERNACIONALPOS, "Don Balón", "futbolinternacional", "futbolinternacional");

//        $data =  $this->db->query("SELECT valor FROM parametros WHERE nombre = 'Don Balón Json'")->result() ;
//        $tag = $data[0]->valor;

//        $this->tag(ZONANUESTROSEMBAJADORES, ZONANUESTROSEMBAJADORESPOS, "Don Balón", "donbalon", "donbalon");
    }

    public function copalibertadores()
    {
        $this->seccion(ZONACOPALIBERTADORES, ZONACOPALIBERTADORESPOS, "Copa Libertadores", "copalibertadores", "copalibertadores");
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
        $this->seccion(ZONAINTERNACIONAL, ZONAINTERNACIONALPOS, "Fútbol Internacional", "futbolinternacional", "futbolinternacional");
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
        $data['verMobile'] = $this->verificarDispositivo();
        $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
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
        //validamos las noticias
        /*if ($idNoticia < 39898)
            redirect('home');*/
        if ( $idNoticia == 'ref.outcontrol'  )
            redirect('home');

        if ($idNoticia) {
            $storia = $this->story->get_complete($idNoticia);
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
        }

        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;
        // fin carga la informacion de la noticia

        $data['content'] = $storia . $noticiasCuerpo;
        $data['sidebar'] = $this->contenido->sidebarOpenNews(false, $serie);

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        $this->templates->_index($data);
    }
    public function tag($tag, $seccionpos,  $nameSeccion, $urlSeccion, $tipoSeccion = "", $serie = SERIE_A)
    {
        // para la final se comentan la llamada a las secciones.
        $this->output->cache(CACHE_DEFAULT);

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');
        $data['verMobile'] = $this->verificarDispositivo();
        $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        $noticiasCuerpo = $this->noticias->viewTags($nameSeccion, $tag, $seccionpos, $urlSeccion);

        $storia = "";
        $bodytag = $nameSeccion;

        // carga la informacion de la noticia
        $idNoticia = $this->uri->segment(4);
        //validamos las noticias
        /*if ($idNoticia < 39898)
            redirect('home');*/
        if ( $idNoticia == 'ref.outcontrol'  )
            redirect('home');

        if ($idNoticia) {
            $storia = $this->story->get_complete($idNoticia);
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
        }

        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;
        // fin carga la informacion de la noticia

        $data['content'] = $storia . $noticiasCuerpo;
        $data['sidebar'] = $this->contenido->sidebarOpenNews(false, $serie);

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        $this->templates->_index($data);
    }

    public function femagazine()
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $femagazine = $this->contenido->femagazine();
        $this->singleConten("Magazine", $femagazine);
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
            //validate
            if (!is_numeric ( $serie )) $serie = SERIE_A;
        }

        $this->load->module('strikes');
        $goleadores = $this->strikes->goleadoresFull($serie);
        $this->singleConten("Goleadores", $goleadores);
    }

    public function tabladeposiciones($serie = SERIE_A)
    {
        //$this->output->cache(CACHE_DEFAULT);
        $id = $this->uri->segment(3);
        if ($id) {
            $serie = $id;
        }

        $this->load->module('scoreboards');
        $tablapocisiones = $this->scoreboards->scoreboardFull($serie);
        $descriptio = "Tabla de posiciones, campeonato nacional de fútbol, campeonato nacional de fútbol serie b, actualizado minuto a minuto con los resultados del futbol ecuatoriano";
        $this->singleConten("Tabla de Posiciones", $tablapocisiones, $descriptio);
    }

    public function resultados()
    {
        //$this->output->cache(CACHE_DEFAULT);
        $this->load->module('matches');

        $id = $this->uri->segment(3);
        $name = $this->matches->getChampionship($id)->row();

        $title = $name->name;
        //$title = "Calendario - Campeonato Serie B 2014";
        $fechas = $this->matches->matches($id, $title);
        $this->singleConten($title, $fechas);
    }

    public function marcadorenvivo()
    {
        $this->load->module('matches');
        $title = "Marcador En Vivo";
        $fechas = $this->matches->matchesLive($title);
        $this->singleConten($title, $fechas);
    }

    public function partido()
    {
        //$this->output->cache(CACHE_PARTIDOS);

        $this->load->module('matches');
        $id = $this->uri->segment(4);

        if ( $id == "ref.outcontrol"  )
            redirect('home');


        $match = $this->matches->getMatch($id);
        $title = $this->matches->getMatchName($id);
        $description = "Sigue el partido en vivo, " .  $this->matches->getMatchNameLong($id);
        $this->singleConten($title, $match, $description);
    }


    public function fueradejuego()
    {
        //$this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $fueradejuego = $this->contenido->view_fuera_de_juego();
        $this->singleConten("Fuera de Juego", $fueradejuego);
    }

    public function singleConten($nameSeccion, $contenSeccion, $description = "")
    {
        // para la final se comentan la llamada a las secciones.

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');
        $data['verMobile'] = $this->verificarDispositivo();
        $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        $bodytag = $nameSeccion;

        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;

        // fin carga la informacion de la noticia
        $data['content'] = $contenSeccion;

        if (($nameSeccion != "Magazine") && ($nameSeccion != "Fuera de Juego")) {
            $data['sidebar'] = $this->contenido->sidebarOpenNews();
        } else {
            $data['sidebar'] = $this->contenido->sidebarOpenNews(FALSE, SERIE_A, "short");
        }
        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        $data['description'] = $description;

        $this->templates->_index($data);
    }

    public function pruebas()
    {
        // para la final se comentan la llamada a las secciones.

        $this->load->module('templates');
        $this->load->module('banners');
        $data['top1'] = "";
        $data['header1'] = "";
        $data['verMobile'] = $this->verificarDispositivo();
        $dataHeader2['FE_Bigboxbanner'] = "caja1";

        $bodytag = "";

        $data['pageTitle'] = "";

        // fin carga la informacion de la noticia
        $data['content'] = $this->banners->FE_Bigboxbanner();

        $data['sidebar'] = "";
        $data['footer'] = "";
        $data['bottom'] = "";

        $this->templates->_index($data);
    }


    public function equipo()
    {
        $idEquipo = $this->uri->segment(4);
        $shortEquipo = $this->uri->segment(3);
        $this->section_equipo($idEquipo, 2, $shortEquipo);
    }

    public function setloc()
    {
        $id = $this->uri->segment(3);
        $this->load->module('story');

        $this->mdl_story->cuentaVisita($id);
    }

    public function section_equipo($seccion, $seccionpos, $urlSeccion)
    {
        // para la final se comentan la llamada a las secciones.
        //$this->output->cache(CACHE_DEFAULT);
        // Informacion de equipo
        $idNoticia = $this->uri->segment(6);
        // para validacion

        if ( $idNoticia == "ref.outcontrol"  )
              redirect('home');

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

        $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
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
            if ($idNoticia != 1)
                $aux = $this->mdl_story->get_story($idNoticia);

            if (!isset($aux->title)) $tituloPagina = $nameSeccion;
            else $tituloPagina = $aux->title;
            $bodytag = str_replace('"', '', strip_tags($tituloPagina));
        }
        $data['verMobile'] = $this->verificarDispositivo();
        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;
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


        $this->templates->_index($data);
    }


}