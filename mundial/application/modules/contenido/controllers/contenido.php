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
        //todo crear banner slideBar
    }

    public function menu($data = FALSE)
    {
        return $this->load->view('menu', $data, TRUE);
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
    public function menum($data = FALSE)
    {
       // $data['moviles'] = verificaDispositivo();
        return $this->load->view('menum', $data, TRUE);
    }


    public function footer($data = FALSE)
    {
        return $this->load->view('footer', $data, TRUE);
    }

    public function banner_sidebar($data = FALSE)
    {
        return $this->load->view('bannersidebar', $data, TRUE);

    }

    public function view_banner_contenido($data = FALSE)
    {
        return $this->load->view('bannercontenido', $data, TRUE);

    }
    public function view_banner_contenidotop($data = FALSE)
    {
        return $this->load->view('bannercontenidotop', $data, TRUE);
    }

    public function view_twitter($data = FALSE)
    {
        return $this->load->view('twitter', $data, TRUE);
    }

    public function view_historias($data = FALSE)
    {
        $this->load->module('contenido');
        $this->load->module('galerias');
        $this->load->module('imagenes');

        $historias = $this->contenido->get(array('select' => 'contenido.id, contenido.titulo, contenido.creado, contenido.lecturas, contenido.extras, contenido.cuerpo, contenido.galerias_id, contenido.type, contenido.ident_pais',
            'joins' => array('galerias' => 'contenido.galerias_id = galerias.id'),
            'where' => array('publico' => 0, 'type' => 'historia')));

        $cont = 0;
        $datosEstadio = array();

        foreach ($historias as $historia) {
            $idGaleria = $this->galerias->get(array('select' => '*', 'where' => array('id' => $historia->galerias_id)), TRUE)->id;
            $imagenes = $this->imagenes->get(array('select' => '*', 'where' => array('galerias_id' => $idGaleria)));

            $datosHistoria[$cont] = array(

                "id" => $historia->id,
                "titulo" => $historia->titulo,
                "cuerpo" => $historia->cuerpo,
                'imagenes' => array($imagenes)
            );
            $cont++;
        }
        $data['datosHistoria'] = $datosHistoria;

        return $this->load->view('historias', $data, TRUE);

    }

    public function view_anecdotas()
    {
        $this->load->module('contenido');
        $this->load->module('galerias');
        $this->load->module('imagenes');
        $idHistoria=2;

       $historias = $this->get(array('select' => '*', "where" => array("id" => $idHistoria)));
       $idenHisto=explode("-", $historias->titulo);
       $anioMundial = rtrim($idenHisto[0]);
       $galeria = $this->galerias->get(array('select' => 'id', 'where' => array('nombre' => 'Anecdotas - Mundial - ' . $anioMundial)));
       $imagenes= $this->imagenes->get(array('select' => '*', "where" =>array('galerias_id'=>$galeria[0]->id)));
    

      $data['anecdotas']=$historias->anecdotas;
      $data['ima_anecdotas']=$imagenes;
    
       return $this->load->view('anecdotas_mundiales', $data,   TRUE);

    }


    public function view_estadios($data = FALSE)
    {

        $this->load->module('estadios');
        $this->load->module('galerias');
        $this->load->module('imagenes');

        $estadios = $this->estadios->get(array('select' => 'estadios.id, estadios.nombre, estadios.ciudad, estadios.capacidad, estadios.club, estadios.programa, estadios.afp_id, estadios.galerias_id',
            'joins' => array('galerias' => 'estadios.galerias_id = galerias.id'),
            'where' => array('publico' => 0)));

        $cont = 0;
        $datosEstadio = array();

        foreach ($estadios as $estadio) {
            $idGaleria = $this->galerias->get(array('select' => '*', 'where' => array('id' => $estadio->galerias_id)), TRUE)->id;
            $imagenes = $this->imagenes->get(array('select' => '*', 'where' => array('galerias_id' => $idGaleria)));

            $datosEstadio[$cont] = array(
                "id_estadio" => $estadio->id,
                "nombre" => $estadio->nombre,
                "ciudad" => $estadio->ciudad,
                "capacidad" => $estadio->capacidad,
                "club" => $estadio->club,
                "programa" => $estadio->programa,
                'imagenes' => array($imagenes)
            );
            $cont++;
        }
        $data['datosEstadio'] = $datosEstadio;
        return $this->load->view('estadios', $data, TRUE);
        //todo crear banner viewEstadios
    }

    public function view_trivia($data = FALSE)
    {
        return $this->load->view('trivia', $data, TRUE);
        //todo crear banner viewTrivia
    }

    public function header_mobile($data = FALSE)
    {
        return $this->load->view('header_mobile', $data, TRUE);
        //todo crear banner viewGoleadores
    }


    public function view_noticia_home()
    {
        $limite_noticias = 10;
        $this->load->module('imagenes');
        $noticias_home = $this->get(array("select" => "id,titulo,cuerpo,galerias_id, creado", "where" => array("type" => "noticia", "activo"=>'0'), "order_by" => "creado desc", "limit" => $limite_noticias));

        $datos = array();
        foreach ($noticias_home as $noticia) {
            $noticia->imagenes = $this->imagenes->get(array('select' => '*', 'where' => array('galerias_id' => $noticia->galerias_id), "limit" => 1), true);
            array_push($datos, $noticia);
        }
        $data['noticias'] = $datos;
        $data['totCabecera'] = 2;
        return $this->load->view('noticiashome', $data, TRUE);
    }


    public function view_noticia_open($idNotica)
    {

        $limite_noticias =25;
        $this->load->module('imagenes');

        $datos = array();
        if ($idNotica != '') {
            $noticia = $this->get(array("select" => "id,titulo,cuerpo,galerias_id, creado", "where" => array("type" => "noticia", "id" => $idNotica  )), true);
            $noticia->imagenes = $this->imagenes->get(array('select' => '*', 'where' => array('galerias_id' => $noticia->galerias_id), "limit" => 1), true);

            array_push($datos, $noticia);
        }
        $noticias_home = $this->get(array("select" => "id,titulo,cuerpo,galerias_id, creado", "where" => array("type" => "noticia","activo"=>'0'), "order_by" => "creado desc", "limit" => $limite_noticias));


        foreach ($noticias_home as $noticia) {
            $noticia->imagenes = $this->imagenes->get(array('select' => 'id,ftp_visu,ftp_thumbnail,galerias_id', 'where' => array('galerias_id' => $noticia->galerias_id), "limit" => 1), true);
            array_push($datos, $noticia);
        }

        $data['noticias'] = $datos;
        $data['totCabecera'] = 1;
        //$data['url'] = base_url()."site/noticia/contenido". $datos[0]->titulo. "/". $idNotica;
        $data['url'] = base_url()."site/noticia/contenido/". $idNotica;

        return $this->load->view('noticiasabierta', $data, TRUE);
    }

    public function view_historia_open($idNotica)
    {
        $this->load->module('imagenes');

        $datos = array();
        if ($idNotica != '') {
            $noticia = $this->get(array("select" => "id,titulo,cuerpo, anecdotas, galerias_id, creado", "where" => array("type" => "historia" , "id" => $idNotica)), true);
            $noticia->imagenes = $this->imagenes->get(array('select' => 'id,ftp_visu,ftp_thumbnail,galerias_id', 'where' => array('galerias_id' => $noticia->galerias_id)), false);

            array_push($datos, $noticia);
        }
        $noticias_home = $this->get(array("select" => "id,titulo,cuerpo,galerias_id, creado", "where" => array("type" => "historia"), "order_by" => "creado asc"));


        foreach ($noticias_home as $noticia) {
            $noticia->imagenes = $this->imagenes->get(array('select' => 'id,ftp_visu,ftp_thumbnail,galerias_id', 'where' => array('galerias_id' => $noticia->galerias_id)), false);
            array_push($datos, $noticia);
        }
        $data['noticias'] = $datos;;


        return $this->load->view('historiaabierta', $data, TRUE);
    }


    public function view_noticias_equipo($idequipo )
    {

        $limite_noticias = 10;
        $this->load->module('equipos_campeonato');
        $datosEquipo = $this->equipos_campeonato->get(array("select" => "*",   "from"=>"equipos_campeonato", "where" => array("id" => $idequipo )), false);
        $data = array("nombre_equipo" => $datosEquipo->name);
        $this->load->module('imagenes');
        $noticias_home = $this->get(array("select" => "id,titulo,cuerpo,galerias_id, creado", "where" => array("type" => "noticia" ,"activo"=>'0', 'ident_pais'=>$datosEquipo->short_name), "order_by" => "creado desc", "limit" => $limite_noticias));
        //$last = $this->db->last_query();
        $datos = array();
        foreach ($noticias_home as $noticia) {
            $noticia->imagenes = $this->imagenes->get(array('select' => 'id,ftp_visu,ftp_thumbnail, galerias_id', 'where' => array('galerias_id' => $noticia->galerias_id), "limit" => 1), true);
            array_push($datos, $noticia);
        }
        $data['noticias'] = $datos;;
        $data['totCabecera'] = 0;
        return $this->load->view('noticiasequipo', $data, TRUE);
    }


    public function view_historia()
    {
        $this->load->module('imagenes');
        $equipoQuery['select'] = '*';
        $equipoQuery['where'] = array('type' => 'historia');
        $equipoQuery['paginate'] = TRUE;
        $equipoQuery['limit'] = $this->uri->segment(3);
        $equipoQuery['offset'] = 1;
        $this->mdl_contenido->page_config = array(
            'base_url' => base_url('site/historias/'),
            'per_page' => 1,
            'num_links' => 1
        );
        $data['historia'] = $this->get($equipoQuery, TRUE);
        $imagenesQuery['select'] = '*';
        $imagenesQuery['where'] = array('galerias_id' => $data['historia']->galerias_id);
        $imagenes = $this->imagenes->get($imagenesQuery);
        $data['historia']->imagenes = $imagenes;
        $data['links'] = $this->mdl_contenido->page_links;
        return $this->load->view('view_historia', $data, TRUE);
    }


    function sync_historias()
    {
        echo "<pre>";
        $this->data_model('WC/xml/es/histo/index');
        echo "</pre>";
    }

    private function data_model($xml)
    {
        // Cargo los modulso que necesito
        $this->load->module('galerias');
        $this->load->module('imagenes');
        $pathXml = implode("/", explode("/", $xml, -1)); //Extraigo el path para cuando envien el archivo sin path
        $xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
        $data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
        $data = $data->NewsItem->NewsComponent; //Limito mi objeto a los datos necesarios

        foreach ($data->NewsComponent as $node) {
       
            $type = (string)$node->DescriptiveMetadata->OfInterestTo->attributes();
            $titulocontenido = trim((string)$node->NewsLines->HeadLine);
            //if( $type ==='Historia' ){
            //Creo la galeria para la historia
            if (!$this->galerias->_check_exist(array('nombre' => 'Historia - ' . $titulocontenido))) {
                $galeria = array('nombre' => 'Historia - ' . $titulocontenido, 'publico' => 0);
                $galeria['id'] = $this->galerias->_insert($galeria, NULL, FALSE);
            } else {
                $galeria['id'] = $this->galerias->_check_exist(array('nombre' => 'Historia - ' . $titulocontenido), TRUE)->id;
            }
            //Creo el contenido tipo historia
            if (!$this->mdl_contenido->get_by(array('titulo' => $titulocontenido))) {
                $contenido = array('titulo' => $titulocontenido, 'galerias_id' => $galeria['id'], 'type' => 'historia');
                $idContenido = $this->mdl_contenido->save($contenido, NULL, FALSE);
                $contenidoData = $this->_check_exist(array('titulo' => $titulocontenido), TRUE);
            } else {
                $contenidoData = $this->_check_exist(array('titulo' => $titulocontenido), TRUE);
            }

            $contenidoDetails = (string)$node->NewsItemRef->attributes();
            $xml = AFP_XML . $pathXml . '/' . str_replace('.xml', '', $contenidoDetails);
            if ($this->xmlimporter->load($xml)) {
                $data = $this->xmlimporter->parse();
                $data = $data->NewsItem->NewsComponent;
                $fotos = 0;
                foreach ($data->NewsComponent as $component) {
                    if (isset($component->ContentItem->DataContent)) {
                        $this->mdl_contenido->save(array('cuerpo' => implode(" ", (array)$component->ContentItem->DataContent->p)), $contenidoData->id, FALSE);
                    } else {
                        $fotos++;
                        $this->imagenes->_syncFotos($component, array(
                                'origen' => $pathXml . '/', //origen
                                'destino' => strtolower('imagenes/contenido/'), //destino
                                'galerias_id' => $contenidoData->galerias_id, // id galeria
                                'titulo' => "Historia - " . $titulocontenido . " - " . $fotos // nombre de la foto
                            )
                        );
                    }
                }
            }
            //}
        }
    }


    function sync_noticias()
    {
        echo "<pre>";
        $this->data_model_noticias('WC/xml/es/direct/news/FULLP/index');
        //$this->data_model_noticias('WC/xml/es/direct/news/BRA/index');
        //$this->data_model_noticias('WC/xml/es/direct/news/DEU/index');
        //$this->data_model_noticias('WC/xml/es/direct/news/XNG/index');
        echo "</pre>";
    }

    private function data_model_noticias($xml)
    {
        // Cargo los modulso que necesito
        $this->load->module('galerias');
        $this->load->module('imagenes');
        $pathXml = implode("/", explode("/", $xml, -1)); //Extraigo el path para cuando envien el archivo sin path
        $xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
        $data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
       
        $data = $data->NewsItem->NewsComponent; //Limito mi objeto a los datos necesarios
        foreach ($data->NewsComponent as $node) {
            $tituloNoticia = trim((string)$node->NewsLines->HeadLine);

            //Creo la galeria para la noticia
            if (!$this->galerias->_check_exist(array('nombre' => 'Noticia - ' . $tituloNoticia))) {
                $galeria = array('nombre' => 'Noticia - ' . $tituloNoticia, 'publico' => 0);
                $galeria['id'] = $this->galerias->_insert($galeria, NULL, FALSE);
            } else {
                $galeria['id'] = $this->galerias->_check_exist(array('nombre' => 'Noticia - ' . $tituloNoticia), TRUE)->id;
            }
            //Creo el contenido tipo noticia
            if (isset($node->DescriptiveMetadata)) {
                $shortName = $node->DescriptiveMetadata->Property;

                foreach ($shortName as $row) {
                    if ((string)$row->attributes()->FormalName == "Sport") {
                        echo "<pre>";
                        //var_dump((string)$row->attributes()->Value);
                        $shortNameTeam = (string)$row->attributes()->Value;
                        echo "</pre>";
                    }
                }
            }


            if (!$this->mdl_contenido->get_by(array('titulo' => $tituloNoticia))) {
                $contenido = array('titulo' => $tituloNoticia, 'galerias_id' => $galeria['id'], 'type' => 'noticia', 'ident_pais' => $shortNameTeam);
                $idContenido = $this->mdl_contenido->save($contenido, NULL, FALSE);
                $contenidoData = $this->_check_exist(array('titulo' => $tituloNoticia), TRUE);
            } else {
                $contenidoData = $this->_check_exist(array('titulo' => $tituloNoticia), TRUE);
            }
            $contenidoDetails = (string)$node->NewsItemRef->attributes();

            $xml = AFP_XML . $pathXml . '/' . str_replace('.xml', '', $contenidoDetails);

            if ($this->xmlimporter->load($xml)) {
                $data = $this->xmlimporter->parse();
                $data = $data->NewsItem->NewsComponent;

                $fotos = 0;
                foreach ($data->NewsComponent as $component) {

                    if (isset($component->ContentItem->DataContent)) {
                        $this->mdl_contenido->save(array('cuerpo' => implode(" ", (array)$component->ContentItem->DataContent->p)), $contenidoData->id, FALSE);
                    } else {
                        $fotos++;
                        $this->imagenes->_syncFotos($component, array(
                                'origen' => $pathXml . '/', //origen
                                'destino' => strtolower('imagenes/contenido/'), //destino
                                'galerias_id' => $contenidoData->galerias_id, // id galeria
                                'titulo' => "Noticia - " . $tituloNoticia . " - " . $fotos // nombre de la foto
                            )
                        );
                    }
                }
            }
        }
    }



    function sync_anecdotas()
    {
        $historias = $this->get(array('select' => 'id, titulo', "where" => array("type" => "historia")));
        foreach ($historias as $histo ) {
            if ($histo->id!=1){
                $idenHisto=explode("-", $histo->titulo);
                $trimmed = rtrim($idenHisto[0]);
                $idenHisto=explode("-", $histo->titulo);
                $this->data_model_anecdotas('WC/xml/es/histo/wc2014-histo-'.$trimmed.'-reperes-es.xml', $histo->id,  $trimmed);
            }
        }
      
    }

    private function data_model_anecdotas($xml, $idHistoria, $anioMundial)
    {
        $this->load->module('galerias');
        $this->load->module('imagenes');

        $pathXml = implode("/", explode("/", $xml, -1)); //Extraigo el path para cuando envien el archivo sin path
        $xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
        $data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
        $nodoAnecdotas=$data->NewsItem->NewsComponent->NewsComponent->ContentItem->DataContent;
        $info="";
        foreach ($nodoAnecdotas->dl as $anec) {
            $tituloAnecdota=(string)$anec->dt;
            $detalleAnecdotas=(string)$anec->dd->block->p;
            $infoAnecdota= "<h1>$tituloAnecdota</h1><p>$detalleAnecdotas<p>"; 
            $info=$info.$infoAnecdota;
         }
         $this->_update ( array('anecdotas'=>$info,), $idHistoria);

        /*//Creo la galeria para la historia
            if (!$this->galerias->_check_exist(array('nombre' => 'Anecdotas - Mundial - ' . $anioMundial))) {
                $galeria = array('nombre' => 'Anecdotas - Mundial - ' . $anioMundial, 'publico' => 0);
                $galeria['id'] = $this->galerias->_insert($galeria, NULL, FALSE);
            } else {
                $galeria['id'] = $this->galerias->_check_exist(array('nombre' => 'Anecdotas - Mundial - ' . $anioMundial), TRUE)->id;
            }
 
      //Ingreso las imagenes a la base de datos
           if ($this->xmlimporter->load($xml)) {
                $data = $this->xmlimporter->parse();
                $data = $data->NewsItem->NewsComponent;
                $fotos = 0;
                foreach ($data->NewsComponent as $component) {
                        $fotos++;
                       $this->imagenes->_syncFotos($component, array(
                                'origen' => $pathXml . '/', //origen
                                'destino' => strtolower('imagenes/contenido/'), //destino
                                'galerias_id' =>  $galeria['id'], // id galeria
                                'titulo' => "Anecdotas - Mundial - " . $anioMundial . " - " . $fotos // nombre de la foto
                            )
                        );
                
                }
            } */ 
    }

}