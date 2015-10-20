<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Content-type: text/html; charset=utf-8');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
}


class Site extends MY_Controller
{
    public $model = 'mdl_site';
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        //Futbolecuador
        $consulta = $this->db->query("select id from championships where  active_championship = 1 limit 1")->result();

        if (count($consulta) > 0) {


            define('CHAMP_DEFAULT', $consulta[0]->id);
            $consulta = $this->db->query("select COUNT(*) as total from  rounds   where championship_id= " . CHAMP_DEFAULT)->result();
            if ($consulta[0]->total == "1") {
                define('CHAMP_DEFAULT_TIPOTABLA', "simple");
            } else {
                define('CHAMP_DEFAULT_TIPOTABLA', "acumulada");
            }

        } else {
            define('CHAMP_DEFAULT', 53);
            define('CHAMP_DEFAULT_TIPOTABLA', "acumulada");

        }
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
                    $isMobile = "2";
                    break;
                case 'Android Tablet':
                    $isMobile = "2";
                    break;
                case in_array($m, $mobiles):
                    $isMobile = "1";
                    break;
            }
        }
        return $isMobile;
    }

    public function index()
    {

        if ($this->campeonatoCopa() == true) {
            if ($this->verificarDispositivo() == "1")
                redirect('site/movil/');
            else
                redirect('home');
        } else {
            if ($this->verificarDispositivo() == "1")
                redirect('copa-america-movil');
            else
                redirect('copaamerica');
        }
    }

    // funcion que permite programar en caso que se muestre copa america
    public function campeonatoCopa()
    {
        // recupera parametro para mostrar o no el splash
        $data = $this->db->query("SELECT *, NOW() FROM parametros WHERE id = '4' AND valor = 1 AND NOW() BETWEEN inicio AND fin")->result();
        if (count($data) > 0) {
            // es copa america
            return false;
        } else {
            //campeonato nacional
            return true;
        }
    }

    // para la final se comentan la llamada a las secciones.
    public function movil()
    {
        // para la final se comentan la llamada a las secciones.

        $this->output->cache(CACHE_DEFAULT);
        // recupera parametro para mostrar o no el splash
        $data = $this->db->query("SELECT valor FROM parametros WHERE id = '2'")->result();
        $data['mostrarSplash'] = $data[0]->valor;

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->module('teams_position');
        $data['verMobile'] = $this->verificarDispositivo();
        $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";
        $this->load->library('user_agent');

        $data['top1'] = "";
        $data['header1'] = "";

        $bannerBottom = $this->banners->fe_smart_bottom();
        $bannerTop = $this->banners->fe_smart_top();
        $dataHeader2['FE_Bigboxbanner'] = "";
        $data['header2'] = $this->contenido->header2mobile($dataHeader2) . $bannerTop;


        // recuperar codigo dpa-sportslive
        $query = $this->db->query("SELECT valor FROM parametros WHERE nombre = 'dpa-sportslive'");

        if ($query->num_rows() > 0) {
            $query = $query->result();
            $dpasportslive = $query[0]->valor;
            if ($dpasportslive == 1)
                $marcadorenvivo = $this->banners->dpasportslivemovil();
            else
                $marcadorenvivo = $this->contenido->marcadorVivo();
        } else {
            $marcadorenvivo = $this->contenido->marcadorVivo();
        }

        // $marcadorenvivo = $this->contenido->marcadorVivo();

        $data['top2'] = "";

        //Resultados tabla de posiciones
        $this->load->module('scoreboards');
        $tablaposiciones = $this->scoreboards->tablaposiciones(CHAMP_DEFAULT, CHAMP_DEFAULT_TIPOTABLA);

        $fe_loading_movil = $this->banners->fe_loading_movil();
        // $outbrain  = '<!--Inicio ejemplo -->
        //                  <div data-src="www.futbolecuador.com" class="OUTBRAIN" ></div>
        //                  <script type="text/javascript">(function(){window.OB_platformType=8;window.OB_langJS="http://widgets.outbrain.com/lang_es.js";window.OBITm="1426714580680";window.OB_recMode="brn_strip";var ob=document.createElement("script");ob.type="text/javascript";ob.async=true;ob.src="http"+("https:"===document.location.protocol?"s":"")+"://widgets.outbrain.com/outbrainLT.js";var h=document.getElementsByTagName("script")[0];h.parentNode.insertBefore(ob,h);})();</script>
        //                  <!--Fin ejemplo -->';

        $outbrain = '<script type="text/javascript" src="https://www.imusicaradios.com.br/go_ccfm/ccfm_embed.js"
onload="CocaColaEmbed(\'ec\',\'true\',10)"></script>
<div class="col-md-12 col-xs-12  margen0 " style="background-color: #f40009; height: 150px">
<div style="width: 300px; margin: 0 auto; "><iframe id="ccfmPlayer" style="width: 300px; height: 15%;"></iframe></div></div>';


        //     $publicidadFlotante =  $this->banners->fe_desplegable_movil();

        $publicidadFlotante = "";


        $data['content'] = $marcadorenvivo . $publicidadFlotante . $this->noticias->viewNoticiasHome(true, RESULT_PAGE_LITE) . $bannerBottom . $tablaposiciones . $outbrain . $fe_loading_movil . "</div>";
        $data['sidebar'] = "";

        $data['footer'] = '';
        $data['bottom'] = $this->contenido->bottom();
        $data['fe_splash'] = "";

        $data['fe_header'] = $this->banners->fe_header();
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


        // recupera parametro para mostrar o no el splash
        $consulta = $this->db->query("SELECT valor FROM parametros WHERE id = '2'")->result();
        $data['mostrarSplash'] = $consulta[0]->valor;

        $data['fe_scritp_footer'] = $this->banners->fe_netsonic_home();
        //$data['fe_scritp_footer'] = "";

        $data['header1'] = $this->contenido->menu();

        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();
        $data['header2'] = $this->contenido->header2($dataHeader2);
        $data['top2'] = $this->banners->FE_Megabanner();

        $ip = $_SERVER ['REMOTE_ADDR'];
        $country = file_get_contents('http://api.hostip.info/country.php?ip=' . $ip);

        if ($country == "US") {
            $amazonAssociates =  '<script type="text/javascript">
amzn_assoc_placement = "adunit0";
amzn_assoc_tracking_id = "theultappmedc-20";
amzn_assoc_ad_mode = "manual";
amzn_assoc_ad_type = "smart";
amzn_assoc_marketplace = "amazon";
amzn_assoc_region = "US";
amzn_assoc_linkid = "c3680e81a595d2cfdd9ea6e1afceb7b2";
amzn_assoc_asins = "B00U60IB28,B00U60JXJ8,B00L6GP3C2,B00PFZJ1B4";
amzn_assoc_title = "";
</script>
<script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>';
        } else {
            $amazonAssociates =  '';
        }


        $data['content'] = $this->noticias->viewNoticiasHome(true, RESULT_PAGE, 0, FALSE, $amazonAssociates);
        $test = CHAMP_DEFAULT_TIPOTABLA;
        $data['sidebar'] = $this->contenido->sidebar(FALSE, CHAMP_DEFAULT, CHAMP_DEFAULT_TIPOTABLA);

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();

        $data['fe_splash'] = $this->banners->fe_splash();
        $data['fe_header'] = $this->banners->fe_header();
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
        $this->email->from('boletin@futbolecuador.com', 'futbolecuador.com');
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
        $offset = $porciones[1];

        $idsection = $this->uri->segment(4);
        $posSection = $this->uri->segment(5);
        $urlSeccion = $this->uri->segment(6);

        if ("equipo" == $urlSeccion) {
            $urlSeccion .= "/" . $this->uri->segment(7) . "/" . $this->uri->segment(8);
        }

        if (!$idsection) {
            $masnoticias = $this->noticias->viewNoticiasHome(false, RESULT_PAGE - 1, $offset);
            if (count($masnoticias) > 0) {
                echo $masnoticias;
            } else {
                echo "error";
            }
        } else {
            echo $this->noticias->viewSeccions("", $idsection, $posSection, $urlSeccion, RESULT_PAGE - 1, $offset, false);
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
        if ($this->verificarDispositivo() == "1") {
            $bannerBottom = $this->banners->fe_smart_bottom_internas();
        } else {
            $bannerBottom = "";
        }
        echo $this->matches->getMatch($idEquipo, $bannerBottom);
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
        if (!$idNoticia) {
            $idNoticia = $this->uri->segment(3);
        }
        if (is_numeric($idNoticia))
            if ($idNoticia < 39898)
                redirect('home');
        if ($idNoticia == 'ref.outcontrol')
            redirect('home');

        if ($this->verificarDispositivo() == "1")
            $storia = $this->story->get_complete($idNoticia, $this->banners->anuncio_alertas());
        else
            $storia = $this->story->get_complete($idNoticia, $this->banners->anuncio_alertas() . $this->banners->fe_netsonic_tv());

        //$storia = $this->story->get_complete($idNoticia, $this->banners->anuncio_alertas(). $this->banners->fe_netsonic_tv() );

        //para el caso de don balon se cambia el texto donbalon por el logo de don balon
        //  if (ZONAINTERNACIONAL == $seccion) {
        $storia = str_replace("en www.donbalon.com", "", $storia);
        $storia = str_replace(" donbalon", " <span class='donbalonlogo'></span>", $storia);
        $storia = str_replace("Mira la noticia completa", "Lee la noticia completa en ", $storia);
        $storia = str_replace("Mira la nota completa", "Lee la noticia completa en ", $storia);
        $storia = str_replace("La nota completa", "Lee la noticia completa en", $storia);
        $storia = str_replace("(AQUÍ).", " <span class='donbalonlogo'></span>", $storia);
        $storia = str_replace("(AQUÍ)", " <span class='donbalonlogo'></span>", $storia);
        $storia = str_replace("AQUÍ:", " <span class='donbalonlogo'></span>", $storia);
        $storia = str_replace("AQUÍ", " <span class='donbalonlogo'></span>", $storia);

        $aux = $this->mdl_story->get_story($idNoticia);
        $image = $aux->thumb150;
        $description = strip_tags($aux->lead);
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
        $data['fe_header'] = $this->banners->fe_header();
        $this->templates->_index($data);
    }

    public function recordatorioApp()
    {
        // generamos recordatorios de los partidos dentro de las siguientes dos horas
        $this->load->module('scoreboards');
        $partidos = $this->mdl_scoreboards->today_matches_app();

        if ($partidos) {
            foreach ($partidos as $partido) {
                $this->notificacionRecordatorio($partido, "Hoy ");
            }
            echo count($partidos);
        } else {
            echo "no existen partidos";
        }
    }

    public function recordatorioAppDiaAntes()
    {
        // generamos recordatorios de los partidos dentro de las siguientes dos horas
        $this->load->module('scoreboards');
        $partidos = $this->mdl_scoreboards->today_matches_app_9pm();

        if ($partidos) {
            foreach ($partidos as $partido) {
                $this->notificacionRecordatorio($partido, "Mañana ");
            }
            echo count($partidos);
        } else {
            echo "no existen partidos";
        }
    }

    public function getnewsjsonapp()
    {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Content-type: text/html; charset=utf-8');
        //informacion para app y para don balon

        //json de consumo de don balon.
        $this->load->module('story');
        $this->load->module('noticias');
        // recuperar codigo de don balos
        if (isset($_GET["secciones"])) {
            $secciones = $_GET["secciones"];
            if ($secciones == "") {
                echo "[]";
                return;
            }

            $totalsecciones = explode(",", $secciones);

            /// Recupera y ordena datos de cada seccion
            $noticiasOrden = array();

            if (count($totalsecciones) == 0)
                ;

            foreach ($totalsecciones as $index1 => $seccion) {
                // ARREGLO PARA JA
                if ($seccion != "/646544654646") {
                    if ($seccion != '') {
                        if ($seccion != 3) {
                            if ($seccion != 28) {
                                $data = $this->mdl_story->get_banner_seccion(FEAPPMAXSECCION, '', $seccion);
                                foreach ($data as $index => $noticia) {
                                    if (!in_array($noticia->id, $data)) {
                                        $noticia->seccion = $seccion;
                                        $noticiasOrden[] = $noticia;
                                    }
                                }
                            } else {
                                // para el caso de en jugadores en el exterior
                                $data = $this->mdl_story->get_banner_seccion2(FEAPPMAXSECCION, '', $seccion);
                                foreach ($data as $index => $noticia) {
                                    if (!in_array($noticia->id, $data)) {
                                        $noticia->seccion = $seccion;
                                        $noticiasOrden[] = $noticia;
                                    }
                                }
                            }
                        } else {
                            //para el caso de rotativas
                            //$data = $this->mdl_story->get_banner(3, 44);
                            $data = $this->mdl_story->get_destacados();
                            foreach ($data as $noticia) {
                                $noticia->seccion = $seccion;
                                $noticiasOrden[] = $noticia;
                            }
                        }
                    }
                }
            }

            $dateTime = array();

            foreach ($noticiasOrden as $key) {
                $dateTime[] = $key->created;
            }

            array_multisort($dateTime, SORT_DESC, SORT_STRING, $noticiasOrden);

            //// genera json

            echo "[";
            $idOld = "";
            foreach ($noticiasOrden as $index => $noticia) {
                $today = date("m/d");
                $date = new DateTime($noticia->created);

                if ($today == $date->format('m/d'))
                    $date = $date->format('H:i');
                else
                    $date = $date->format('m/d H:i');

                if ($idOld != $noticia->id) {
                    echo "{";
                    echo '"id": "' . $noticia->id . '",';
                    echo '"titulo": "' . str_replace('"', '\"', strip_tags(trim($noticia->title))) . '",';
                    echo '"resumen": "' . str_replace('"', '\"', strip_tags(trim($noticia->subtitle))) . '",';
                    echo '"foto": "' . "http://www.futbolecuador.com/" . $noticia->thumbh50 . '",';
                    echo '"foto_table": "' . "http://www.futbolecuador.com/" . $noticia->thumbh120 . '",';
                    echo '"link": "' . "http://www.futbolecuador.com/site/noticia/" . $this->story->_urlFriendly($noticia->subtitle) . "/" . $noticia->id . '",';
                    echo '"seccion": "' . $noticia->seccion . '",';
                    echo '"fecha_creacion": "' . $date . '"';
                    //echo '"seccion": "' . $noticia->seccion . '"';
                    echo "}";
                    echo ($index < count($noticiasOrden) - 1) ? "," : "";
                }
                $idOld = $noticia->id;
            }

            echo "]";
        } else {
            echo "[]";
        }
    }


    public function getnewsjson()
    {
        header('Content-type: text/html; charset=utf-8');

        //json de consumo de don balon.
        $this->load->module('story');
        // recuperar codigo de don balos
        $data = $this->db->query("SELECT valor FROM parametros WHERE nombre = 'Don Balón Json'")->result();
        $tag = $data[0]->valor;
        $rotativasData = $this->mdl_story->get_banner_tag(4, 44, $tag);
        echo "[";
        $rotativasListado = array();
        foreach ($rotativasData as $index => $noticia) {
            $rotativasListado [] = $noticia->id;
            echo "{";
            echo '"id": "' . $noticia->id . '",';
            echo '"titulo": "' . str_replace('"', '\"', strip_tags(trim($noticia->subtitle))) . '",';
            echo '"resumen": "' . str_replace('"', '\"', strip_tags(trim($noticia->lead))) . '",';
            echo '"foto": "' . "http://www.futbolecuador.com/" . $noticia->thumb300 . '",';
            echo '"foto_carrusel": "' . "http://www.futbolecuador.com/" . $noticia->thumb990 . '",';
            echo '"link": "' . "http://www.futbolecuador.com/site/noticia/" . $this->story->_urlFriendly($noticia->subtitle) . "/" . $noticia->id . '",';
            echo '"mostrar_carrusel": "s",';
            echo '"fecha_creacion": "' . $noticia->created . '"';
            echo "},";

        }
        $data = $this->mdl_story->news_by_tags($tag, TOTALNEWSINDONBALON);

        foreach ($data as $index => $noticia) {
            if (!in_array($noticia->id, $rotativasListado)) {
                echo "{";
                echo '"id": "' . $noticia->id . '",';
                echo '"titulo": "' . str_replace('"', '\"', strip_tags(trim($noticia->subtitle))) . '",';
                echo '"resumen": "' . str_replace('"', '\"', strip_tags(trim($noticia->lead))) . '",';
                echo '"foto": "' . "http://www.futbolecuador.com/" . $noticia->thumb300 . '",';
                echo '"link": "' . "http://www.futbolecuador.com/site/noticia/" . $this->story->_urlFriendly($noticia->subtitle) . "/" . $noticia->id . '",';
                echo '"fecha_creacion": "' . $noticia->created . '"';
                echo "}";
                echo ($index < count($data) - 1) ? "," : "";
            }
        }
        echo "]";
    }

    public function sidebardonbalon()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        $this->load->module('contenido');
        $this->load->module('teams_position');

        $parte = $this->uri->segment(3);

        if (!$parte) {
            echo $this->contenido->sidebarDonBalon(false, CHAMP_DEFAULT, 0);
        } else {
            echo $this->contenido->sidebarDonBalon(false, CHAMP_DEFAULT, $parte);
        }
    }

    public function tablaposicionesalone()
    {
        $data['verMobile'] = $this->verificarDispositivo();
        $serie = $this->uri->segment(3);
        $tipotabla = $this->uri->segment(4);
        $this->load->module('contenido');
        $this->load->module('teams_position');
        $this->load->module('scoreboards');
        $this->load->module('matches');

        $title = "Marcador En Vivo";
        $data['partidos'] = $this->matches->matchesrevista($title);


        if (!$serie)
            echo $this->contenido->tabladeposiciones();
        else
            echo $this->contenido->tabladeposiciones($data, $serie, $tipotabla);
    }

    public function noticiasalone()
    {
        $data['verMobile'] = $this->verificarDispositivo();

        $seccion = $this->uri->segment(3);
        $this->load->module('contenido');
        $this->load->module('noticias');

        $data['contenido'] = $this->noticias->viewSeccionsSingle("", ZONACOPAAMERICA, ZONACOPAAMERICAPOS, URLAMERICA, 6, 0, true, $data);
        echo $this->contenido->noticiasonly($data);
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
        $this->seccion(ZONAINTERNACIONAL, ZONAINTERNACIONALPOS, "Don Balon", "futbolinternacional", "futbolinternacional");

    }

    public function copalibertadores()
    {
        $this->seccion(ZONACOPALIBERTADORES, ZONACOPALIBERTADORESPOS, "Copa Libertadores", "copalibertadores", "copalibertadores", LIBERTADORES);
        // $this->seccion(ZONACOPALIBERTADORES, ZONACOPALIBERTADORESPOS, "Copa Libertadores", "copalibertadores", "copalibertadores" , LIBERTADORES);
    }


    public function copasudamericana()
    {
        $this->seccion(ZONACOPASUDAMERICANA, ZONACOPASUDAMERICANAPOS, "Copa Sudamericana", "copasudamericana", "copasudamericana", SUDAMERICANA, SUDAMERICANA_TIPOTABLA);
    }

    public function eliminatorias()
    {
        $this->seccion(ZONAELIMINATORIAS, ZONAELIMINATORIASPOS, "Eliminatorias 2018", "eliminatorias", "eliminatorias", ELIMINATORIAS, ELIMINATORIAS_TIPOTABLA);
    }

    public function futbolinternacional()
    {
        $this->seccion(ZONAINTERNACIONAL, ZONAINTERNACIONALPOS, "Fútbol Internacional", "futbolinternacional", "futbolinternacional");
    }

    public function seccion($seccion, $seccionpos, $nameSeccion, $urlSeccion, $tipoSeccion = "", $serie = CHAMP_DEFAULT, $tipotabla = CHAMP_DEFAULT_TIPOTABLA)
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
        if ($idNoticia == 'ref.outcontrol')
            redirect('home');

        if ($idNoticia) {

//            $storia = $this->story->get_complete($idNoticia);

            if ($this->verificarDispositivo() == "1")
                $storia = $this->story->get_complete($idNoticia, $this->banners->anuncio_alertas());
            else
                $storia = $this->story->get_complete($idNoticia, $this->banners->anuncio_alertas() . $this->banners->fe_netsonic_tv());

            //para el caso de don balon se cambia el texto donbalon por el logo de don balon
            //  if (ZONAINTERNACIONAL == $seccion) {
            $storia = str_replace("en www.donbalon.com", "", $storia);
            $storia = str_replace(" donbalon", " <span class='donbalonlogo'></span>", $storia);
            $storia = str_replace("Mira la noticia completa", "Lee la noticia completa en ", $storia);
            $storia = str_replace("Mira la nota completa", "Lee la noticia completa en ", $storia);
            $storia = str_replace("La nota completa", "Lee la noticia completa en", $storia);
            $storia = str_replace("(AQUÍ).", " <span class='donbalonlogo'></span>", $storia);
            $storia = str_replace("(AQUÍ)", " <span class='donbalonlogo'></span>", $storia);
            $storia = str_replace("AQUÍ:", " <span class='donbalonlogo'></span>", $storia);
            $storia = str_replace("AQUÍ", " <span class='donbalonlogo'></span>", $storia);

            //  }
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
        }

        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;
        // fin carga la informacion de la noticia

        $data['content'] = $storia . $noticiasCuerpo;
        $data['sidebar'] = $this->contenido->sidebarOpenNews(false, $serie, "large", $tipotabla);

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        $data['fe_header'] = $this->banners->fe_header();
        $this->templates->_index($data);
    }

    public function tag($tag, $seccionpos, $nameSeccion, $urlSeccion, $tipoSeccion = "", $serie = CHAMP_DEFAULT)
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
        if ($idNoticia == 'ref.outcontrol')
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
        $data['fe_header'] = $this->banners->fe_header();
        $this->templates->_index($data);
    }

    public function femagazine()
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $femagazine = $this->contenido->femagazine();
        $this->singleConten("Magazine", $femagazine);
    }

    public function dpasportslive()
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');

        $dpaSportsLive = $this->contenido->dpaSportsLiveFrame($this->verificarDispositivo());
        $this->singleConten("dpa-SportsLive", $dpaSportsLive);
    }

    public function search()
    {
        $this->load->module('contenido');
        $search = $this->contenido->search();
        $this->singleConten("Búsqueda", $search);
    }

    public function goleadores($serie = CHAMP_DEFAULT)
    {
        $this->output->cache(CACHE_DEFAULT);

        $id = $this->uri->segment(3);
        if ($id) {
            $serie = $id;
            //validate
            if (!is_numeric($serie)) $serie = SERIE_A;
        }

        $this->load->module('strikes');
        $goleadores = $this->strikes->goleadoresFull($serie);
        $this->singleConten("Goleadores", $goleadores, "", $serie);
    }

    public function tabladeposiciones($serie = CHAMP_DEFAULT)
    {

        $id = $this->uri->segment(3);
        $tipotabla = $this->uri->segment(4);

        if ($id) {
            $serie = $id;
        }
        if (!$tipotabla) {
            $tipotabla = "acumulada";
        }


        $this->load->module('scoreboards');
        $tablapocisiones = $this->scoreboards->scoreboardFull($serie, $tipotabla);
        $descriptio = "Tabla de posiciones, campeonato nacional de fútbol, campeonato nacional de fútbol serie b, actualizado minuto a minuto con los resultados del futbol ecuatoriano";
        $this->singleConten("Tabla de Posiciones", $tablapocisiones, $descriptio, $serie, $tipotabla);
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


        $this->singleConten($title, $fechas, "Resultados", $id);
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
        $this->load->module('banners');
        $id = $this->uri->segment(4);

        if ($id == "ref.outcontrol")
            redirect('home');

        if ($this->verificarDispositivo() == "1") {

            $bannerBottom = $this->banners->fe_smart_bottom_internas();
            $bannerTop = $this->banners->fe_smart_top_internas();
        } else {

            $bannerBottom = "";
            $bannerTop = "";
        }

        $match = $bannerTop . $this->matches->getMatch($id, $bannerBottom);

        $title = $this->matches->getMatchName($id);
        $description = "Sigue el partido en vivo, " . $this->matches->getMatchNameLong($id);
        $champ = $this->uri->segment(5);
        if (!$champ)
            $this->singleConten($title, $match, $description);
        else
            $this->singleConten($title, $match, $description, $champ);
    }

    public function partidodata()
    {
        $this->load->module('matches');
        $id = $this->uri->segment(4);

        echo $this->matches->getMatchRevista($id);
    }

    public function fueradejuego()
    {
        //$this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $fueradejuego = $this->contenido->view_fuera_de_juego();
        $this->singleConten("Fuera de Juego", $fueradejuego);
    }

    public function juventus()
    {
        //$this->output->cache(CACHE_DEFAULT);
        $this->load->module('contenido');
        $juventus = $this->contenido->view_juventus();
        $this->singleConten("Juventus", $juventus);
    }

    public function singleConten($nameSeccion, $contenSeccion, $description = "", $serie = CHAMP_DEFAULT, $tipotabla = CHAMP_DEFAULT_TIPOTABLA)
    {
        // para la final se comentan la llamada a las secciones.

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');
        $this->load->module('teams_position');
        $data['verMobile'] = $this->verificarDispositivo();
        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();

        $bodytag = $nameSeccion;

        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;

        // fin carga la informacion de la noticia
        $data['content'] = $contenSeccion;

        if (($nameSeccion != "Magazine") && ($nameSeccion != "Fuera de Juego")) {
            if ($serie != 56) {
                $data['sidebar'] = $this->contenido->sidebarOpenNews(FALSE, $serie, "large", $tipotabla);
            } else {
                $data['sidebar'] = $this->contenido->copaamericasidebar(false, $serie);
            }
        } else {
            $data['sidebar'] = $this->contenido->sidebarOpenNews(FALSE, $serie, "short", $tipotabla);
        }
        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();
        $data['description'] = $description;
        $data['fe_header'] = $this->banners->fe_header();


        if ($serie == 56) {
            $data['top1'] = $this->banners->top1() . $this->banners->fe_skin_copaamerica();
            $data['header1'] = $this->contenido->menucopaamerica();
            $this->templates->_indexcopa($data);
        } else {
            $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
            $data['header1'] = $this->contenido->menu();
            $this->templates->_index($data);

        }

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
        $data['fe_header'] = $this->banners->fe_header();
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

        if ($idNoticia == "ref.outcontrol")
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

            $campeonatoEquipo = $this->uri->segment(5);

            if ($campeonatoEquipo == 56) {
                $dataTeam ['fechas'] = $this->matches->matchesperteam($idEquipo, $campeonatoEquipo);
                $dataTeam ['modeloficha'] = "simple";
            } else {
                $dataTeam ['fechas'] = $this->matches->matchesperteam($idEquipo, CHAMP_DEFAULT);
                $dataTeam ['modeloficha'] = "completa";
            }

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
        $this->load->module('teams_position');

        //   $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
        //   $data['header1'] = $this->contenido->menu();

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

        $campeonatoEquipo = $this->uri->segment(5);
        // todo es caso copa america pero se puede generalizar
        if ($campeonatoEquipo == "56") {
            $data['sidebar'] = $this->contenido->copaamericasidebar(false, $campeonatoEquipo);

        } else {
            $data['sidebar'] = $this->contenido->sidebarOpenNews();
        }


        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();

        $data['fe_header'] = $this->banners->fe_header();

        if ($campeonatoEquipo == 56) {
            $data['top1'] = $this->banners->top1() . $this->banners->fe_skin_copaamerica();
            $data['header1'] = $this->contenido->menucopaamerica();
            $this->templates->_indexcopa($data);
        } else {
            $data['top1'] = $this->banners->top1() . $this->banners->fe_skin();
            $data['header1'] = $this->contenido->menu();
            $this->templates->_index($data);

        }
    }

    function notificacionRecordatorio($data, $dia)
    {

        $date = date_create($data->date_match);
        $fecha = $dia . date_format($date, 'H:i');

        $contenido = $fecha . " - " . $data->name_home . " vs " . $data->name_away;

        // pruebas de notificacion se generan eventos para todos los partidos
        $equiposCopaAmerica = array(26, 34, 35, 36, 37, 38, 39, 40, 41, 42, 72, 73);
        $home = $data->seccion_home;
        $visita = $data->seccion_away;


        //  if (in_array($home, $equiposCopaAmerica))
        //       $data->seccion_home = 26;
        //   if (in_array($visita, $equiposCopaAmerica))
        //       $data->seccion_away = 26;
        //fin pruebas

        $envios = array();
        $envios[] = $data->seccion_home . "-IN3";
        $envios[] = $data->seccion_away . "-IN3";

        $this->pwCallMobile('createMessage', array(
                'application' => PW_APP_MOBILE,
                'auth' => PW_AUTH,
                'notifications' => array(
                    array(
                        'send_date' => 'now',
                        'content' => $contenido,
                        'link' => 'http://www.futbolecuador.com/site/partido/pushapp/' . $data->id,
                        "android_icon" => "icon",
                        "android_vibration" => 0,
                        "android_sound" => "res/sound/inicio.wav",
                        "ios_sound" => "res/sound/inicio.wav",
                        'conditions' => array(array("informacion", "IN", $envios))
                    )
                )
            )
        );
    }

    function pwCallMobile($action, $data = array())
    {
        $url = 'https://cp.pushwoosh.com/json/1.3/' . $action;
        $json = json_encode(array('request' => $data));
        $this->doPostRequest($url, $json, 'Content-Type: application/json');
    }

    function doPostRequest($url, $data, $optional_headers = null)
    {
        $params = array(
            'http' => array(
                'method' => 'POST',
                'content' => $data
            ));
        if ($optional_headers !== null)
            $params['http']['header'] = $optional_headers;

        $ctx = stream_context_create($params);
        $fp = fopen($url, 'rb', false, $ctx);
        if (!$fp)
            echo "Problem with $url";

        $response = @stream_get_contents($fp);
        if ($response === false)
            return false;
        return $response;
    }


    public function indexcopaamerica()
    {
        if ($this->verificarDispositivo() == "1")
            redirect('copa-america-movil');
        else
            redirect('copaamerica');
    }

    public function copaamerica($seccion = ZONACOPAAMERICA, $seccionpos = ZONACOPAAMERICAPOS, $nameSeccion = "Copa América", $urlSeccion = URLAMERICA, $tipoSeccion = URLAMERICA, $serie = AMERICA)
    {
        $seccionpos = ZONACOPAAMERICAPOS;
        $seccion = ZONACOPAAMERICA;
        // para la final se comentan la llamada a las secciones.
        // $this->output->cache(CACHE_DEFAULT);

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->library('user_agent');
        $this->load->module('story');

        $data['verMobile'] = $this->verificarDispositivo();
        $data['top1'] = $this->banners->top_copaamerica() . $this->banners->fe_skin_copaamerica();
        $data['header1'] = $this->contenido->menucopaamerica();


        $dataHeader2['FE_Bigboxbanner'] = $this->banners->FE_Bigboxbanner();


        $listadoRotativas = $this->mdl_story->get_banner_seccion(6, "", SECTION_AMERICA);
        $excluded = array();
        foreach ($listadoRotativas as $row) {
            $excluded[] = $row->id;
        }

        $noticiasCuerpo = $this->noticias->copaamericaviewSeccions($nameSeccion, $seccion, $seccionpos, $urlSeccion, RESULT_PAGE, 0, true, FALSE, $excluded);


        $storia = "";
        $bodytag = $nameSeccion;

        // carga la informacion de la noticia
        $idNoticia = $this->uri->segment(4);
        //validamos las noticias


        if ($idNoticia) {
            $storia = $this->story->get_complete($idNoticia);
            $aux = $this->mdl_story->get_story($idNoticia);
            $bodytag = str_replace('"', '', strip_tags($aux->title));
            $data['fe_splash'] = "";
        } else {
            //en caso que es la pagina principal nos muestra la rotativa de imagenes
            $dataHeader2['FE_Bigboxbanner'] = $this->banners->fe_hp_brand();
            $data['header2'] = $this->contenido->copaamericaheader($dataHeader2);
            $data['top2'] = $this->banners->fe_brand_header();
            $data['fe_splash'] = $this->banners->fe_splash();
        }

        $data['pageTitle'] = "futbolecuador.com - " . $bodytag;
        // fin carga la informacion de la noticia

        $data['content'] = $storia . $noticiasCuerpo;
        $data['sidebar'] = $this->contenido->copaamericasidebar(false, $serie);

        $data['footer'] = $this->contenido->footer();
        $data['bottom'] = $this->contenido->bottom();


        $data['fe_header'] = $this->banners->fe_header();
        $this->templates->_indexcopa($data);

    }

    // para la final se comentan la llamada a las secciones.
    public function copaamericamovil($seccion = ZONACOPAAMERICA, $seccionpos = ZONACOPAAMERICAPOS, $nameSeccion = "Copa América", $urlSeccion = URLAMERICA, $tipoSeccion = URLAMERICA, $serie = AMERICA)
    {
        // para la final se comentan la llamada a las secciones.

        $this->output->cache(CACHE_DEFAULT);
        // recupera parametro para mostrar o no el splash
        $data = $this->db->query("SELECT valor FROM parametros WHERE id = '2'")->result();
        $data['mostrarSplash'] = $data[0]->valor;

        $this->load->module('noticias');
        $this->load->module('templates');
        $this->load->module('contenido');
        $this->load->module('banners');
        $this->load->module('teams_position');
        $this->load->module('matches');


        $fechas = '<div class="col-md-12 col-xs-12 separador10-xs-bot margen0r home ">' . $this->matches->matches($serie, "Copa América 2015") . '</div>';

        $data['verMobile'] = $this->verificarDispositivo();
        $data['pageTitle'] = "futbolecuador.com - Lo mejor del fútbol ecuatoriano";
        $this->load->library('user_agent');

        $data['top1'] = "";
        $data['header1'] = "";

        //$bannerBottom = $this->banners->fe_smart_bottom_copa_america();
        $bannerBottom = $this->banners->fe_smart_bottom();
        //$bannerTop = $this->banners->fe_smart_top_copa_america();
        $bannerTop = $this->banners->fe_smart_top();
        $dataHeader2['FE_Bigboxbanner'] = "";
        $data['header2'] = $this->contenido->header2mobile($dataHeader2, ZONACOPAAMERICA) . $bannerTop;
        $campeonato = AMERICA;
        $marcadorenvivo = $this->contenido->marcadorVivo($campeonato, "todos");

        $data['top2'] = "";

        //Resultados tabla de posiciones
        $this->load->module('scoreboards');
        $tablaposiciones = $this->scoreboards->tablaposiciones(AMERICA, AMERICA_TIPOTABLA);

        //$fe_loading_movil = $this->banners->fe_loading_movil_copa_america();
        $fe_loading_movil = $this->banners->fe_loading_movil();
        $data['fe_header'] = $this->banners->fe_header();
        $outbrain = ' ';
        $publicidadFlotante = "";

        $data["extraheader"] = "no";

        $listadoRotativas = $this->mdl_story->get_banner_seccion(6, "", SECTION_AMERICA);
        $excluded = array();
        foreach ($listadoRotativas as $row) {
            $excluded[] = $row->id;
        }

        $noticiasCuerpo = $this->noticias->viewSeccions($nameSeccion, $seccion, $seccionpos, $urlSeccion, RESULT_PAGE_LITE, 0, true, $data, $excluded);

        $data['content'] = $marcadorenvivo . $publicidadFlotante . $noticiasCuerpo . $bannerBottom . $tablaposiciones . $fechas . $outbrain . $fe_loading_movil . "</div>";
        $data['bottom'] = $this->contenido->bottom();

        $data['sidebar'] = '';
        $data['footer'] = '';
        $data['fe_splash'] = '';

        //$data['fe_header'] = $this->banners->fe_header_copa_america();
        $data['fe_header'] = $this->banners->fe_header();
        $this->templates->_index($data);
    }


}
