<?php

class Stories extends CI_Controller
{

    var $positions;

    function __construct()
    {
        parent::__construct();
        $this->load->model('story', 'model');
        $this->load->model('category');
        $this->load->model('image');
        $this->load->model('tag');
        $this->load->model('statistic');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('inflector');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('category_id', 'Categor&iacute;a', 'required');
        $this->form_validation->set_rules('position', 'Posicion', 'required');
        $this->form_validation->set_rules('title', 'Titulo', 'trim|required');
        $this->form_validation->set_rules('subtitle', 'Subtitulo', 'trim|required');
        $this->form_validation->set_rules('twitter', 'Twitter', 'trim|required');
        $this->form_validation->set_rules('lead', 'Introducci&oacute;n', 'required');
        $this->form_validation->set_rules('body', 'Cuerpo', 'required');
        $this->form_validation->set_rules('image_id', 'Imagen', 'required');
        $this->form_validation->set_rules('related', 'Relacionado', 'trim|required');
        $this->form_validation->set_rules('origen', 'Origen', 'trim|required');
        $this->form_validation->set_rules('programed', 'Programar', '');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->positions = array('1' => 'Rotativas', '2' => 'Principales', '3' => 'Noticia del Dia');

        //Validacion ACL
        //$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
    }


    function publica()
    {
        $id = $this->uri->segment(3);
        if ($id != "") {
            $this->load->library('user_agent');
            $mobiles = array('Apple iPhone', 'Apple iPod Touch', 'Android', 'Windows CE', 'Symbian S60', 'Apple iPad', "LG", "Nokia");
            if ($this->agent->is_mobile()) {
                $m = $this->agent->mobile();
                if ($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i', $this->agent->agent) == 0)
                    $m = "Android Tablet";
                switch ($m) {
                    case 'Apple iPad':
                        break;
                    case 'Android Tablet':
                        break;
                    case in_array($m, $mobiles):
                        redirect('moviles/read/' . $id . '/1');
                        exit;
                        break;
                }
            }


            $this->load->model('section');
            //Defino primero el template publico para poder escribir ahi los modulos
            $this->template->set_template('public');
            $this->template->write('path', base_url(), TRUE);

            //Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
            $this->load->helper('modul');
            $modulos = new Modul();
            if ($this->model->is_position(3, $id))
                $modulos->set_modulos(51);
            else
                $modulos->set_modulos(8);

            //Cargo las noticias rotativas
            /*$data['query']=$this->model->get_banner(5);
            $data['check']=0;

            $this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);*/

            $this->template->render();

        } else
            redirect();

    }


    function tags()
    {
        $tag = humanize($this->uri->segment(3));
        $query = $this->model->story_by_tags($tag, '');
        $config['base_url'] = base_url() . '/stories/tags/' . $this->uri->segment(3);
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = '6';
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);
        if (!$this->uri->segment(4) == '')
            $pagina = "LIMIT " . $this->uri->segment(4) . " , " . $config['per_page'];
        else
            $pagina = "LIMIT " . $config['per_page'];

        $this->load->model('section');
        //Defino primero el template publico para poder escribir ahi los modulos
        $this->template->set_template('public');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $this->template->write('path', base_url(), TRUE);
        $data['name'] = 'Noticias: <i>' . $tag . '</i>';
        $data['query'] = $this->model->story_by_tags($tag, $pagina);
        $this->template->write_view('content', $this->model->name . '/tags', $data, TRUE);

        //Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
        $this->load->helper('modul');
        $modulos = new Modul();
        $modulos->set_modulos(8, 'laterals');

        $this->template->render();


    }


    function index()
    {
        $data['title'] = "NOTICIAS ";
        $data['heading'] = "LISTADO";
        $data['datestring'] = "%Y-%m-%d  %h:%i %a ";
        $data['time'] = time();
        $data['query'] = $this->model->get_all($this->uri->segment(3));
        $data['categories'] = $this->category->get_list();
        $data['positions'] = $this->positions;

        $this->view($this->model->name . '/view', $data);

    }

    /*********** Start Pushwoosh Notifications *******/
    function  pushNotificationBrowser($id, $title, $subtitle)
    {
        $urlFriend = $this->_urlFriendly($subtitle);
        // Send Push Notification
        $this->pwCall('createMessage', array(
                'application' => PW_APPLICATION,
                'auth' => PW_AUTH,
                'notifications' => array(
                    array(
                        'send_date' => 'now',
                        'content' => $subtitle,
                        'link' => "http://www.futbolecuador.com/site/noticia/" . $urlFriend . "/" . $id . "/push",
                        "chrome_icon" => "icon/icon128.png",
                        "chrome_title" => $title,
                        "safari_title" => $title,
                        "safari_url_args" => array("site/noticia/" . $urlFriend . "/" . $id)
                    )
                )
            )
        );
    }

    function verificarHora()
    {
        /***metodo para verificar hora de mensaje app rango (8am - 10pm)***********/
        $hora = (int)date("G");
        if ($hora >= 8 && $hora < 22)
            return true;
        else
            return false;
    }

    function  pushNotificationMobile($id, $post, $destacado = 0)
    {
        /******validacion de hora con el mètodo verificarHora*************/
        if ($this->verificarHora() != true)
            return;
        $urlFriend = $this->_urlFriendly($post);

        $seccionesLista = array();

        $consulta = $this->db->query("SELECT id
                                        FROM sections
                                        WHERE category_id = (select category_id from stories   WHERE  id =  '$id')");
        // if ($consulta->num_rows() > 0) {
        if ($consulta->num_rows() > 0) {
            $consulta = $consulta->result();
            foreach ($consulta as $row) {
                //caso copa america
                //if ($row->id == 71) $row->id = 26;
                $seccionesLista[] = $row->id . "-IN1";
            }
        }
        /***ENVIO NOTIFICACIONES SELECCION NACIONAL******************/
        $consulta2 = $this->db->query("select section_id as id  from sections_tags where tag_id IN  (select tag_id  from stories_tags   WHERE  story_id =  '$id');");
        if ($consulta2->num_rows() > 0) {
            $consulta2 = $consulta2->result();
            foreach ($consulta2 as $row) {
                //caso copa america
               // if ($row->id == 71) $row->id = 26;
                $seccionesLista[] = $row->id . "-IN1";
            }
        }

        if ($destacado == "3") {
            $emoticono = "⭐ ";
        } else {
            $emoticono = "";
        }

        /***ENVIO NOTIFICACIONES DESTACADOS******************/
        if ($destacado == 3) {
            $consulta3 = $this->db->query("select * from stories WHERE id =  '$id';");
            if ($consulta3->num_rows() > 0) {
                $consulta3 = $consulta3->result();
                foreach ($consulta3 as $row) {
                    $seccionesLista[] = "3-IN1";
                }

            }
        }
        /***ENVIO NOTIFICACIONES TEST******************/
       /* if ($destacado == "test") {
            $seccionesLista = array();
            $consulta3 = $this->db->query("select * from stories WHERE id =  '$id';");
            if ($consulta3->num_rows() > 0) {
                $consulta3 = $consulta3->result();
                foreach ($consulta3 as $row) {
                    $seccionesListaTest[] = "test";
                }

            }
        }*/


        $condiciones = array();
        if (count($seccionesLista) > 0) {
            $condiciones[] = array("informacion", "IN", $seccionesLista);
        }

        if (isset ($seccionesListaTest)) {
            $condiciones[] = array("equipo", "IN", $seccionesListaTest);
        }

//        $test = $this->db->last_query();
        if (count($condiciones) > 0) {
            $this->pwCall('createMessage', array(
                    'application' => PW_APP_MOBILE,
                    'auth' => PW_AUTH,
                    'notifications' => array(
                        array(
                            'send_date' => 'now',
                            'content' => $emoticono . $post,
                            'link' => 'http://www.futbolecuador.com/site/noticia/' . $urlFriend . '/' . $id . '/push',
                            "android_icon" => "icon",
                            "android_vibration" => 0,
                            'conditions' => $condiciones,
                            // 'conditions' => array(array("informacion", "IN", $seccionesLista), array())
                        )
                    )
                )
            );
        }


    }

    function pwCall($action, $data = array())
    {
        $url = 'https://cp.pushwoosh.com/json/1.3/' . $action;
        $json = json_encode(array('request' => $data));
        $this->doPostRequest($url, $json, 'Content-Type: application/json');

        $this->logNotificaciones($json);
    }

    function logNotificaciones($json)
    {
        $file = 'lognotificaciones.txt';
        $json = $json . "\n";
        file_put_contents($file, $json, FILE_APPEND | LOCK_EX);
    }

    function logtwiter($json)
    {
        $file = 'logtwitter.txt';
        $json = json_encode($json) . "\n";
        file_put_contents($file, $json, FILE_APPEND | LOCK_EX);
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
            throw new Exception("Problem with $url ");

        $response = @stream_get_contents($fp);
        if ($response === false)
            return false;
        return $response;
    }

    /*********** End Pushwoosh Notifications *******/

    function insert()
    {
        $this->load->model('story_stat');
        $this->template->add_js('js/calendar.js');
        $this->template->add_js('js/ajax.js');
        $this->template->add_css('css/calendar.css');

        $data['title'] = "Noticias / ";
        $data['heading'] = "Ingresar";
        $data['categories'] = $this->category->get_list();
        $data['images'] = $this->image->get_list();
        $data['positions'] = $this->positions;

        if (isset($_POST['submit'])) {
            //Verificacion si escogieron opcion destacado
            if (isset($_POST["destacado"])) {
                $destacado = $_POST["destacado"];
            } else
                $destacado = 0;

            if ($_POST['image_id'] == '')
                $_POST['image_id'] = NULL;
            if ($_POST['programed'] == '') {
                $_POST['programed'] = NULL;
                $_POST['invisible'] = 0;
            } else
                $_POST['invisible'] = 1;

            $_POST['rate'] = 0;
            $_POST['reads'] = 0;
            $_POST['sends'] = 0;
            $_POST['votes'] = 0;
            $_POST['created'] = mdate('%Y-%m-%d  %H:%i:%s', time());
            $_POST['modified'] = $_POST['created'];

            if ($this->form_validation->run() == TRUE) {
                $tags = $this->tag->insert_tag($_POST['related']);
                unset($_POST['related']);
                unset($_POST['submit']);
                unset($_POST['submit']);

                if (!isset($_POST['sponsored']))
                    $_POST['sponsored'] = 0;
                $previous_url = $_POST['previous_url'];
                unset($_POST['previous_url']);

                $params = $_POST;
                $tabla = $this->model->name;

                // no se por que se envia estos datos ... los filtramos previo a enviar a la insercion
                if (isset($params['embed'])) {
                    $params['body'] .= "<span>" . $params['embed'] . "</span>";
                    unset($params['embed']);
                }

                unset($params['nick']);
                unset($params['password']);

                $this->db->insert($tabla, $params);
                $id = $this->db->insert_id();
                $this->tag->insert_story_tag($tags, $id);
                $this->story_stat->insert_story_stat($id);


                // SEND TWEET, send push notification, chrome & safari, push alertas futbolecuador
                if ($_POST['invisible'] == 0) {
                    $this->send_tweet_image($_POST['twitter'], $id, $_POST['image_id']);
                    // pushNotificacion Safari
                    $this->pushNotificationBrowser($id, $_POST['title'], $_POST['subtitle']);

                    // pushNotificacion MOBILE AlertasFutbolecuador
                    //
                    if ($this->validaTags ($tags, 'AlertasFutbolecuador')) {
                        $this->pushNotificationMobile($id, $_POST['subtitle'], $destacado);
                    }
                }
                redirect($previous_url);
            }
        }
        if (isset ($_SERVER['HTTP_REFERER'])) {
            $data['previous_url'] = $_SERVER['HTTP_REFERER'];
        } else {
            $data['previous_url'] = '';
        }
        $this->view($this->model->name . '/insert', $data);
    }

    function validaTags ($tags, $tagEvitar ) {
        foreach ($tags as $tag) {
            if ($tag['name'] == $tagEvitar) {
                return false;
            }
        }
        return true;
    }

    function pruebaNotificacion()
    {
        $id = "58192";
        $mensaje = "Ángel Mena estará 21 días de baja en el Club Sport Emelec";
        //$mensajecontenido = $this->uri->segment(5);
        //$this->pushNotificationMobile ($id, $mensaje, $mensajecontenido);
        $this->pushNotificationMobile($id, $mensaje, "test");
    }

    function pruebaNotificacionBrowser()
    {
        $id = $this->uri->segment(3);
        $mensaje = $this->uri->segment(4);
        $mensajecontenido = $this->uri->segment(5);
        $this->pushNotificationBrowser($id, $mensaje, $mensajecontenido);
        //$this->pushNotificationMobile($id, $mensaje);
    }

    function update()
    {
        $this->load->model('tag');
        $this->template->add_js('js/calendar.js');
        $this->template->add_js('js/ajax.js');
        $this->template->add_css('css/calendar.css');

        $data['title'] = "Noticias / ";
        $data['heading'] = "Actualizar";
        $data['row'] = $this->model->get($this->uri->segment(3));
        $data['categories'] = $this->category->get_list();
        $data['images'] = $this->image->get_list();
        $data['images_url'] = $this->image->get_list_url('thumb100');
        $data['positions'] = $this->positions;

        $data['tags'] = $this->tag->get_story_tags($this->uri->segment(3));

        if (isset($_POST['submit'])) {
            if ($_POST['image_id'] == '')
                unset($_POST['image_id']);

            $_POST['modified'] = mdate('%Y-%m-%d  %H:%i:%s', time());

            //Si pasa la validacion
            if ($this->form_validation->run() == TRUE) {
                if ($_POST['programed'] == '') {
                    unset($_POST['programed']);
                    $_POST['invisible'] = 0;
                } else
                    $_POST['invisible'] = 1;

                if (!isset($_POST['sponsored']))
                    $_POST['sponsored'] = 0;

                unset($_POST['submit']);
                $tag = $this->tag->insert_tag($_POST['related']);
                unset($_POST['related']);
                $previous_url = $_POST['previous_url'];
                unset($_POST['previous_url']);

                $this->db->where('id', $_POST['id']);
                $this->db->update('stories', $_POST);
                $this->tag->update_story_tag($tag, $_POST['id']);
                redirect($previous_url);

            }
        }
        if (isset ($_SERVER['HTTP_REFERER'])) {
            $data['previous_url'] = $_SERVER['HTTP_REFERER'];
        } else {
            $data['previous_url'] = '';
        }
        $this->view($this->model->name . '/update', $data);
    }

    function delete()
    {
        if ($this->model->delete($_POST['id']))
            redirect($this->model->name);
    }


    function confirm_delete()
    {
        $data['id'] = $this->uri->segment(3);
        $this->load->view($this->model->name . '/confirm_delete', $data);
    }


    function view($ver, $data)
    {
        $this->load->library('Alert');
        $this->template->write('title', 'futbolecuador.com - Administrador', TRUE);
        $this->template->write('path', base_url(), TRUE);
        $this->template->write('menu', $this->menu->build_menu(), TRUE);
        $this->template->write_view('content', $ver, $data, TRUE);
        $this->template->render();
    }


    function visited()
    {
        $data['title'] = "NOTICIAS MAS VISITADAS ";
        $data['heading'] = "";
        $data['datestring'] = "%Y-%m-%d  %H:%i %a ";
        $data['time'] = time();
        $data['query'] = $this->model->get_all_by($this->uri->segment(3), 'reads');
        $data['categories'] = $this->category->get_list();
        $data['positions'] = $this->positions;

        $this->view($this->model->name . '/view_visited', $data);
    }


    function commented()
    {
        $data['title'] = "NOTICIAS MAS COMENTADAS ";
        $data['heading'] = "";
        $data['datestring'] = "%Y-%m-%d  %H:%i %a ";
        $data['time'] = time();
        $data['query'] = $this->model->get_commented($this->uri->segment(3));
        $data['categories'] = $this->category->get_list();
        $data['positions'] = $this->positions;

        $this->view($this->model->name . '/view_commented', $data);
    }


    function list_plus()
    {
        $this->output->cache(CACHE_MENU);
        $option = $this->uri->segment(3);
        $data['noticias'] = $this->model->get_plus($option);

        switch ($option) {
            case 'visitadas':
                $this->load->view($this->model->name . '/plus_visited', $data);
                break;

            case 'comentadas':
                $this->load->view($this->model->name . '/plus_comented', $data);
                break;

            case 'enviadas':
                $this->load->view($this->model->name . '/plus_send', $data);
                break;
        }

    }


    function programed_view()
    {
        $data['title'] = "NOTICIAS ";
        $data['heading'] = "PROGRAMADAS";
        $data['query'] = $this->model->get_programed();
        $data['categories'] = $this->category->get_list();
        $data['positions'] = $this->positions;

        $this->view('stories_programed_view', $data);
    }


    function programed_update()
    {
        $data['title'] = "NOTICIAS PROGRAMADAS ";
        $data['heading'] = "ACTUALIZAR";
        $data['row'] = $this->model->get($this->uri->segment(3));
        $this->template->add_js('js/calendar.js');
        $this->template->add_js('js/ajax.js');
        $this->template->add_css('css/calendar.css');
        if (isset($_POST['submit'])) {
            $_POST['modified'] = mdate('%Y-%m-%d  %h:%i:%s', time());
            unset($_POST['submit']);
            $this->db->where('id', $_POST['id']);
            $this->db->update('stories', $_POST);
            redirect('stories/programed_view');
        }
        $this->view('stories_programed_vupdate', $data);
    }


    function story_category()
    {
        if ($this->config->item("encryption_key") == $this->uri->segment(5)) {
            $data['name'] = 'XML NOTICIAS POR CATEGORIA';
            $data['views'] = 1;
            $this->statistic->sum($data);
            header('Content-type: text/xml');
            print $this->model->story_category($this->uri->segment(3), $this->uri->segment(4));
        }
    }


    function story_section()
    {
        if ($this->config->item("encryption_key") == $this->uri->segment(5)) {
            $data['name'] = 'XML NOTICIAS POR SECCION';
            $data['views'] = 1;
            $this->statistic->sum($data);
            header('Content-type: text/xml');
            print $this->model->story_section($this->uri->segment(3), $this->uri->segment(4));
        }
    }


    function xml_story()
    {
        $this->config->set_item('compress_output', 'FALSE');

        $story = $this->model->get_complete($this->uri->segment(3));
        $request = "<?xml version='1.0'  encoding='utf-8'?>\n";
        $request .= "<noticias><noticia>
								<id>" . $story->id . "</id>
								<titulo>" . $story->title . "</titulo>
								<subtitulo>" . $story->subtitle . "</subtitulo>
								<lead><![CDATA[" . mb_convert_encoding($story->lead, 'UTF-8', 'HTML-ENTITIES') . "]]></lead>
								<cuerpo><![CDATA[" . mb_convert_encoding($story->body, 'UTF-8', 'HTML-ENTITIES') . "]]></cuerpo>
								<modificado>" . $story->modified . "</modificado>
								<imagen>" . $story->thumb400 . "</imagen>
								<thumb300>" . $story->thumb300 . "</thumb300>
								<thumb150>" . $story->thumb150 . "</thumb150>
								<thumb>" . $story->thumbh120 . "</thumb>
					  	   </noticia></noticias>";
        header('Content-type: text/xml; charset=utf-8');
        print $request;
    }


    function marcador()
    {
        $this->load->view('vivo/marcador');
    }


    function rss()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->statistic->sum($data);
        header('Content-type: text/xml; charset=utf-8');
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen" href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" 
					     xmlns:atom="http://www.w3.org/2005/Atom" 
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"								   
					     xmlns:georss="http://www.georss.org/georss">  
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />					
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/images/logo_rss.png</url>
					</image>
					<language>es-ec</language>
					<pubDate>' . date('r', time()) . '</pubDate>
				 ';
        if ($this->uri->segment(3) != 3)
            $news = $this->model->rss($this->uri->segment(3));
        else
            $news = $this->model->rss(FALSE);

        foreach ($news->result() as $row):
            $posicionInicio = 0;
            $texto = strip_tags($row->body);
            $texto = (string)$texto;
            $total = strlen($texto);
            $posicionInicio = strpos($texto, "iframe");
            if ($posicionInicio > 0) {
                $video = substr($texto, $posicionInicio, $total);
                $posicionInicio = (int)$posicionInicio - 4;
                $texto2 = substr($texto, 0, $posicionInicio);
                $video = "<figure><" . $video . "</figure>";
            } else {
                $texto2 = $row->body;
                $video = "";
            }

            /*list($width, $height)=getimagesize($row->thumb400);*/
            $request = $request . '
				<item>
				  <title>' . $row->title . '</title>
 	      			  <link>http://www.futbolecuador.com/stories/publica/' . $row->id . '</link>
	      			  <guid>http://www.futbolecuador.com/stories/publica/' . $row->id . '</guid>
	      			  <pubDate>' . date('r', $row->ntime) . '</pubDate>
				  	  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://www.futbolecuador.com/' . $row->thumb640 . '"/><br>' . $row->lead . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <figure>
				          <img src="http://www.futbolecuador.com/' . $row->thumb640 . '"  />
				          <figcaption>
				           <strong>' . $row->title . '</strong>
				          </figcaption>
				        </figure>
				        <p>' . $texto2 . '</p>
					  ' . $video . '
					]]>
				  </content:encoded>
				</item>';
        endforeach;
        $request = $request . '
			</channel></rss>';

        print $request;
    }


    function rss2()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $this->output->cache(CACHE_DEFAULT);
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->statistic->sum($data);
        header('Content-type: text/xml; charset=utf-8');
        $request = '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" media="screen" 
			  href="/~d/styles/rss2full.xsl"?><?xml-stylesheet type="text/css" media="screen" 
			  href="http://feeds.feedburner.com/~d/styles/itemcontent.css"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" 
			                     xmlns:wfw="http://wellformedweb.org/CommentAPI/" 
					     xmlns:atom="http://www.w3.org/2005/Atom" 
					     xmlns:media="http://search.yahoo.com/mrss/"
					     xmlns:dc="http://purl.org/dc/elements/1.1/"								   
					     xmlns:georss="http://www.georss.org/georss">  
					<channel>
					<atom:link rel="hub" href="http://www.futbolecuador.com" />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/images/logo_rss.png</url>
					</image>
					<language>es-ec</language>';

        if ($this->uri->segment(3) != 3)
            $news = $this->model->rss($this->uri->segment(3));
        else
            $news = $this->model->rss(FALSE);

        foreach ($news->result() as $row):
            /*list($width, $height)=getimagesize($row->thumb400);*/
            $request = $request . '
				<item>
				  <title>' . $row->title . '</title>
 	      			  <link>http://www.futbolecuador.com/stories/publica/' . $row->id . '</link>
	      			  <guid>http://www.futbolecuador.com/stories/publica/' . $row->id . '</guid>
	      			  <pubDate>' . date('r', $row->ntime) . '</pubDate>
				  <author>info@futbolecuador.com</author>
	      			  <description><![CDATA[<img src="http://www.futbolecuador.com/' . $row->thumb640 . '"/><br>' . $row->lead . '<span>&nbsp;</span>]]></description>
	      			  <content:encoded><![CDATA[
				        <p class="fl-title">' . $row->title . '</p>
				        <figure>
				          <img src="http://www.futbolecuador.com/' . $row->thumb640 . '"  />
				          <figcaption>
				           <strong>' . $row->title . '</strong>
				          </figcaption>
				        </figure>
				         ' . $row->body . ']]>
				  </content:encoded>
				</item>';
        endforeach;
        $request = $request . '
		</channel></rss>';
        print $request;
    }

    function news_section()
    {
        $data['name'] = 'XML RSS';
        $data['views'] = 1;
        $this->statistic->sum($data);
        $request = '<?xml version="1.0" encoding="UTF-8"?>
				  <rotativa>';
        if ($this->uri->segment(3) != 3)
            $news = $this->model->rss($this->uri->segment(3));
        else
            $news = $this->model->rss(FALSE);
        foreach ($news->result() as $row):
            $request = $request . '<noticia>
								<link>' . base_url() . 'stories/publica/' . $row->id . '</link>
								<titulo>' . $row->title . '</titulo>
								<subtitulo>' . $row->subtitle . '</subtitulo>
								<imagen>' . $row->thumb300 . '</imagen>
								<thumb>' . $row->thumbh50 . '</thumb>
								<noticia><![CDATA[' . mb_convert_encoding($row->lead, 'UTF-8', 'HTML-ENTITIES') . ']]></noticia>
								<id>' . $row->id . '</id>
							   </noticia>';
        endforeach;
        $request = $request . '</rotativa>';
        header('Content-type: text/xml; charset=utf-8');
        print $request;
    }

//Cambio Ver Mas noticias ( Cambio considerable basicamente reescribi el metodo)
    function more()
    {
        $section = $this->uri->segment(3);
        $indice_paginacion = $this->uri->segment(4);
        $numero_noticias = 15;

        //Defino primero el template publico para poder escribir ahi los modulos
        $this->template->set_template('public');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $this->template->write('path', base_url(), TRUE);

        //Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
        $this->load->helper('modul');
        $modulos = new Modul();
        $modulos->set_modulos(8, 'laterals');

        $data['title'] = 'Más Noticias';
        $data['noticias'] = $this->model->get_more_news($section, $indice_paginacion, $numero_noticias);
        $this->template->write_view('content', $this->model->name . '/more', $data, TRUE);


        //Cargo las noticias rotativas
        $data['query'] = $this->model->get_banner(5);
        $data['check'] = 0;
        $this->template->write_view('rotativas', 'stories/rotativa', $data, TRUE);

        $this->template->render();

    }

    function more_ec()
    {

        $max = $this->uri->segment(3);
        $num = 15;

        //Defino primero el template publico para poder escribir ahi los modulos
        $this->template->set_template('public');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $this->template->write('path', base_url(), TRUE);

        //Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
        $this->load->helper('modul');
        $modulos = new Modul();
        $modulos->set_modulos(8, 'laterals');

        $data['title'] = 'Ecuatorianos en el exterior';
        $data['noticias'] = $this->model->get_more_news($this->uri->segment(4), $max, $num, 18);
        $this->template->write_view('content', $this->model->name . '/more', $data, TRUE);


        //Cargo las noticias rotativas
        $data['query'] = $this->model->get_banner(5);
        $data['check'] = 0;
        $this->template->write_view('rotativas', 'stories/rotativa', $data, TRUE);

        $this->template->render();

    }

    function send()
    {
        $this->load->model('user');
        $this->load->library('email');
        if ($this->session->userdata('userid') != false) {
            if (isset($_POST['submit'])) {
                $user = $this->user->get($this->session->userdata('userid'));
                $story = current($this->model->get($_POST['id']));
                $this->email->from($user->mail);
                $this->email->to($_POST['to']);
                $this->email->subject('Te han enviado una noticia desde futbolecuador.com');
                $data['datos'] = 'Hola, ' . $user->first_name . ' ' . $user->last_name . " pensó que te podia interesar esta noticia:<br><br><br>";
                $data['datos'] .= anchor('stories/publica/' . $story->id, $story->title);
                $data['datos'] .= "<br><br>Visita " . anchor('', 'futbolecuador.com') . " donde podrás encontrar las ultimas noticias del futbol ecuatoriano.";
                $data['disclaimer'] = "Este es un mail autogenerado, por favor no hacer reply del mismo.";
                $body = $this->load->view('popups/mail_template', $data, true);
                $this->email->message($body);
                $this->email->send();
                $mensaje = "<div id='mensaje'>La noticia ha sido enviada correctamente. <br><br>";
                $mensaje .= "<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
                echo $mensaje;
            } else {
                $id = $this->uri->segment(3);
                $data['noticia'] = $this->model->get_complete($id);
                $this->load->view('stories/send', $data);
            }
        } else {
            //Presento la confirmacion del mensaje enviado
            $mensaje = "<div id='mensaje'>Debes ser un usuario registrado para poder enviar noticias a un amigo. <br><br><ul>";
            $mensaje .= "<li><a href='' onClick='Modalbox.show(\"" . base_url() . "users/log_in\", {title: \" \", width: 400,overlayClose: true }); return false;' >Ingresa</a></li>";
            $mensaje .= "<li><a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></li></ul></div>";
            echo $mensaje;
        }
    }

    function imprimir()
    {
        $this->load->helper('html');
        $id = $this->uri->segment(3);
        $data['noticia'] = $this->model->get_complete($id);
        $this->load->view('stories/print', $data);
    }

    /*
     * XML_ROTATIVA
     *
     * URI_PARAMETERS:
     * (3) => encryption_key
     * (4) => section_id
     * (5) => max_number
     *
     *
     */

    function xml_rotativa()
    {
        $this->config->set_item('compress_output', 'TRUE');
        if ($this->config->item("encryption_key") == $this->uri->segment(3)) {

            $this->load->model('statistic');
            $data['name'] = 'XML Rotativa';
            $data['views'] = 1;
            $this->statistic->sum($data);
            if ($this->uri->segment(5) == "")
                $num = 5;
            else
                $num = $this->uri->segment(5);

            $query = $this->model->rotativa($this->uri->segment(4), $num);
            $request = "<?xml version='1.0'  encoding='utf-8'?>\n";
            $request = $request . '<rotativa>';
            foreach ($query as $row):
                if ($row->subtitle == "")
                    $row->subtitle = $row->title;
                $request = $request . '<noticia>
									<link>' . base_url() . 'stories/publica/' . $row->id . '</link>
									<titulo>' . $row->title . '</titulo>
									<subtitulo>' . $row->subtitle . '</subtitulo>
									<imagen>' . $row->thumb400 . '</imagen>
									<thumb>' . $row->thumbh50 . '</thumb>
									<lead><![CDATA[' . mb_convert_encoding($row->lead, 'UTF-8', 'HTML-ENTITIES') . ']]></lead>
									<cuerpo><![CDATA[' . mb_convert_encoding($row->body, 'UTF-8', 'HTML-ENTITIES') . ']]></cuerpo>
									<id>' . $row->id . '</id>
								   </noticia>';
            endforeach;
            $request = $request . '</rotativa>';
            header('Content-type: text/xml; charset=utf-8');
            print $request;
        }
    }

    function xml_more()
    {
        $this->config->set_item('compress_output', 'TRUE');
        if ($this->config->item("encryption_key") == $this->uri->segment(5)) {
            $this->load->model('statistic');
            $data['name'] = 'XML More';
            $data['views'] = 1;
            $this->statistic->sum($data);
            $query = $this->model->rotativa($this->uri->segment(3), $this->uri->segment(4), 1);
            $request = "<?xml version='1.0'  encoding='utf-8'?>\n";
            $request = $request . '<rotativa>';
            foreach ($query as $row):
                $request = $request . '<noticia>
									<link>' . base_url() . 'stories/publica/' . $row->id . '</link>
									<titulo>' . $row->title . '</titulo>
									<subtitulo>' . $row->subtitle . '</subtitulo>
									<thumb>' . $row->thumbh50 . '</thumb>
									<noticia><![CDATA[' . mb_convert_encoding($row->body, 'UTF-8', 'HTML-ENTITIES') . ']]></noticia>
									<id>' . $row->id . '</id>
								   </noticia>';
            endforeach;
            $request = $request . '</rotativa>';
            header('Content-type: text/xml; charset=utf-8');
            print $request;
        }
    }

    function xml_category($id, $num)
    {
        $this->config->set_item('compress_output', 'TRUE');
        if ($this->config->item("encryption_key") == $this->uri->segment(5)) {
            $this->load->model('statistic');
            $data['name'] = 'XML By Team';
            $data['views'] = 1;
            $this->statistic->sum($data);
            $query = $this->model->get_by_category($id, $num);
            $request = "<?xml version='1.0'  encoding='utf-8'?>\n";
            $request = $request . '<noticias>';
            foreach ($query->result() as $row) {
                $imagenes = $this->image->get($row->image_id);
                $request = $request . '<noticia>
				<link>' . base_url() . 'stories/publica/' . $row->id . '</link>
				<titulo>' . $row->title . '</titulo>
				<subtitulo>' . $row->subtitle . '</subtitulo>
				<thumb>' . $imagenes->thumbh50 . '</thumb>
				<cuerpo><![CDATA[' . mb_convert_encoding($row->body, 'UTF-8', 'HTML-ENTITIES') . ']]></cuerpo>
				<id>' . $row->id . '</id>
				</noticia>';
            }
            $request = $request . '</noticias>';
            header('Content-type: text/xml; charset=utf-8');
            print $request;
        }


    }

    function set_read()
    {
        if ($this->config->item("encryption_key") == $this->uri->segment(4)) {
            $this->model->set_read($this->uri->segment(3));
        }
    }


    function send_tweet($titular, $id)
    {
        $this->load->library('Twitter');

        $this->twitter->update($titular . ' http://en.fut.ec/?l=' . $id);
    }

    /*function test_twiter (){
        $this->send_tweet_image("“Necesito jugadores que estén al cien por ciento”. Herrera confirma que #RafaMárquez está descartado contra #ECU", 55997, 9213);

    }*/

    function send_tweet_image($titular, $id, $image_id)
    {
        //recupero la imagen de la noticia
        //recupero las secciones relacionadas con la noticia ingresada
        $this->db->select('*');
        $this->db->from("images");
        $this->db->where("id", $image_id);

        $consultaSeccion = $this->db->get();
        $consultaSeccion = $consultaSeccion->result();

        $this->load->library('Twitter');
        //para el caso que titular inicia con @
        $carpetaRoot = $_SERVER['DOCUMENT_ROOT'] ;
        if (substr($titular, 0) == "@")
            $titular = " " . $titular;
        $urlImagen = $carpetaRoot .  "/" .$consultaSeccion[0]->thumb640;

        if ( file_exists ( $urlImagen )) {
            $result = $this->twitter->update_image($titular . ' http://en.fut.ec/?l=' . $id, "http://www.futbolecuador.com/" . $consultaSeccion[0]->thumb640);
        } else {
            $result = $this->twitter->update($titular . ' http://en.fut.ec/?l=' . $id);
        }
        $this->logtwiter($result);

    }

    function programadas()
    {
        $this->load->model('story');

        $pendientes = $this->db->query('Select *
						  			  From stories
						  			  Where programed<=DATE_ADD( NOW() , INTERVAL 120 MINUTE )');
        if ($pendientes->num_rows() > 0) {
            $pendientes = $pendientes->result();
            foreach ($pendientes as $row) {
                echo "ID: " . $row->id . '<br/>';
                $this->db->query('Update stories
								  Set invisible=0 , modified=DATE_ADD( NOW() , INTERVAL 120 MINUTE ),created=DATE_ADD( NOW() , INTERVAL 120 MINUTE ), programed=NULL
								  Where id=' . $row->id);

                $this->send_tweet_image($row->twitter, $row->id, $row->image_id);

                // pushNotificacion Safari
                $this->pushNotificationBrowser($row->id, $row->title, $row->subtitle);

                // pushNotificacion MOBILE
                $this->pushNotificationMobile($row->id, $row->subtitle);
            }
        }
    }

    function _clearStringGion($string)
    {
        $tempSting = str_replace(' ', '-', $this->_clearString($string));

        $tempSting = str_replace(
            array("\\", "¨", "º", "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "`", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                ".", '"', '“', '”',"‘", "’", "–" ),
            '',
            $tempSting
        );

        $tempSting = str_replace('---', '-', $tempSting);
        $tempSting = str_replace('--', '-', $tempSting);

        return $tempSting;
    }

    function _clearString($string)
    {

        $string = trim($string);
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño

        return $string;
    }

    function _urlFriendly($string)
    {
        return strtolower($this->_clearStringGion($string));
    }
}

?>
