<?php

class Moviles extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('profile');
        $this->load->model('story');
        $this->load->model('comment');
    }

    function read()
    {
        $this->load->model('user');

        $this->output->cache(CACHE_MOVIL);
        $this->load->helper('date');
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);

        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(4);
        if ($this->uri->segment(4) == false)
            $champ = 1;
        else
            $champ = $this->uri->segment(4);

        if ($champ == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {

            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        //$data='';
        //$data['user']=$this->acl->getCurrentUser();
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(4) == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';

        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$champ] . '/' . $champ . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $champ;
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';
        if ($champ == 2)
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        else
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        $data['buttons']['5']['link'] = 'moviles/more/5/' . $champ;
        $data['buttons']['5']['pic'] = 'imagenes/template/movil/masnoticias.png';

        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);

        $data = '';
        $data['title'] = 'Noticia';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);

        $data = '';
        $data['stories'] = $this->story->get_complete($this->uri->segment(3));
        $data['author'] = $this->user->get($data['stories']->author_id);
        $this->template->write_view('info1', 'movil/read', $data, TRUE);

        $data = '';
        $data['buttons']['1']['name'] = 'Volver';
        $data['buttons']['1']['link'] = 'moviles/more/5/' . $champ;
        $data['buttons']['1']['type'] = 2;
        $this->template->write_view('info1', 'movil/button2', $data, FALSE);

        //$data='';
        //$data['comments']=$this->comment->get_all_by_story($this->uri->segment(3));
        $data['user'] = $this->acl->getCurrentUser();
        //$this->template->write_view('info1', 'movil/comments', $data, FALSE);

        $this->template->render();
        $this->story->set_read($this->uri->segment(3));
    }

    function readProfile()
    {
        $this->output->cache(CACHE_MOVIL);
        $this->load->helper('date');
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);

        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(4);
        if ($this->uri->segment(4) == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {

            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        //$data='';
        //$data['user']=$this->acl->getCurrentUser();
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(4) == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';

        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$this->uri->segment(4)] . '/' . $this->uri->segment(4) . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $this->uri->segment(4);
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';
        if ($this->uri->segment(4) == 2)
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        else
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        $data['buttons']['5']['link'] = 'moviles/more/5/' . $this->uri->segment(4);
        $data['buttons']['5']['pic'] = 'imagenes/template/movil/masnoticias.png';

        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);

        $data = '';
        $data['title'] = 'Noticia';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);

        $data = '';
        $data['stories'] = $this->profile->get2($this->uri->segment(3));
        $this->template->write_view('info1', 'movil/profile', $data, TRUE);

        $data = '';
        $data['buttons']['1']['name'] = 'Volver';
        $data['buttons']['1']['link'] = 'moviles/more/5/' . $this->uri->segment(4);
        $data['buttons']['1']['type'] = 2;
        $this->template->write_view('info1', 'movil/button2', $data, FALSE);

        //$data='';
        //$data['comments']=$this->comment->get_all_by_story($this->uri->segment(3));
        $data['user'] = $this->acl->getCurrentUser();
        //$this->template->write_view('info1', 'movil/comments', $data, FALSE);

        $this->template->render();
        $this->story->set_read($this->uri->segment(3));
    }

    function more()
    {
        $this->output->cache(CACHE_MOVIL);
        $this->load->helper('date');
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $section['2'] = 33; //dinamico
        $this->load->model('story');
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(4);
        if ($this->uri->segment(4) == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {
            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        //$data='';
        //$data['user']=$this->acl->getCurrentUser();
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);


        $f = $this->uri->segment(3);
        $fo = $f - 10;
        $ff = $f + 10;
        $data = '';

        if ($this->uri->segment(4) == 1) {
            $data['stories'] = $this->story->get_by_position('0', '', '10,' . $f);
        } else {
            $data['stories'] = $this->story->get_by_position('0', '', '10,' . $f, $section[$this->uri->segment(4)]);
        }
        $data['section'] = $this->uri->segment(4);
        $this->template->write_view('info1', 'movil/more', $data, TRUE);

        if ($f > 5) {
            $data['buttons']['1']['name'] = 'Anterior';
            $data['buttons']['1']['link'] = 'moviles/more/' . $fo . '/' . $this->uri->segment(4);
            $data['buttons']['1']['type'] = 1;
        }
        if (count($data['stories']) >= 10) {
            $data['buttons']['2']['name'] = 'Siguiente';
            $data['buttons']['2']['link'] = 'moviles/more/' . $ff . '/' . $this->uri->segment(4);
            $data['buttons']['2']['type'] = 2;
        }
        $this->template->write_view('button2', 'movil/button2', $data, TRUE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(4) == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';
        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$this->uri->segment(4)] . '/' . $this->uri->segment(4) . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $this->uri->segment(4);
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';
        /*if($this->uri->segment(4)==1){
            $data['buttons']['5']['name']='Sud&aacute;frica 2010';
            $data['buttons']['5']['link']='moviles/more/5/2';
            $data['buttons']['5']['pic']='imagenes/template/movil/sudafrica.png';
        }*/
        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);
        $data = '';
        $data['title'] = 'M&aacute;s Noticias';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);

        $this->template->render();
    }


    function scoreboard()
    {
        $this->output->cache(REFRESH_VIVO / 60);
        $this->load->helper('date');
        $championship[1] = CHAMP_DEFAULT;
        $championship[2] = MUNDIAL;
        $champ = 1;
        if ($this->uri->segment(3) != false)
            $champ = $this->uri->segment(3);

        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $data = '';
        $data['link'] = 'welcome/movil/' . $champ;
        if ($champ == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {
            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        //$data='';
        //$data['user']=$this->acl->getCurrentUser();
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);


        $data = '';
        $data['type'] = 2;
        $data['check'] = $champ;
        $this->template->write_view('button1', 'movil/tabs', $data, TRUE);

        /*
        $data='';
        $data['link']='';
           $data['logo']='';
        $this->template->write_view('button3', 'movil/logo', $data, FALSE);
        */

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($champ == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';
        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$champ] . '/' . $champ . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $this->template->write_view('button3', 'movil/button_black', $data, FALSE);

        $data = '';
        $data['matches'] = $this->matches_today_movil();
        $data['section'] = $champ;
        $this->config->load('config');
        $data['refresh'] = REFRESH_VIVO * 300; //milisegundos
        $this->template->write_view('info1', 'movil/scoreboard', $data, TRUE);
        $this->template->render();
    }

    function single()
    {
        $this->output->cache(REFRESH_VIVO / 60);
        $this->load->helper('date');
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $champ = 1;
        if ($this->uri->segment(4) != false)
            $champ = $this->uri->segment(4);
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $data = '';
        $data['link'] = 'welcome/movil/' . $champ;
        if ($champ == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {
            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        //$data='';
        //$data['user']=$this->acl->getCurrentUser();
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);

        $data = '';
        $data['title'] = 'Marcador en Vivo';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);
        $data = '';
        $data['type'] = 2;
        $data['check'] = $champ;
        $this->template->write_view('button1', 'movil/tabs', $data, TRUE);
        $data = '';
        $data['buttons']['1']['name'] = 'Recargar P&aacute;gina';
        $data['buttons']['1']['link'] = 'moviles/single/' . $this->uri->segment(3) . '/' . $champ;
        $data['buttons']['1']['pic'] = '';
        $this->template->write_view('button1', 'movil/button', $data, FALSE);

        $data = '';
        $data['link'] = '';
        $data['logo'] = 'imagenes/moviles/credife_movil.jpg';
        $this->template->write_view('button3', 'movil/logo', $data, FALSE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';

        if ($champ == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';
        }

        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$champ] . '/' . $champ . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'En Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $champ;
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';
        $this->template->write_view('button3', 'movil/button_black', $data, FALSE);
        $data = '';
        $data['matches'] = $this->game_all_movile($this->uri->segment(3));
        $this->config->load('config');
        $data['refresh'] = REFRESH_VIVO * 1000;
        $this->template->write_view('info1', 'movil/single', $data, TRUE);
        $this->template->render();
    }

    function send()
    {
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(4);
        if ($this->uri->segment(4) == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {
            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);
        $data = '';
        $data['title'] = 'Env&iacute;o de Noticia';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);

        $data = '';

        $data['buttons']['1']['name'] = 'Principal';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(4) == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';
        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$this->uri->segment(4)] . '/' . $this->uri->segment(4) . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $this->uri->segment(4);
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';
        $data['buttons']['5']['name'] = 'Noticia Anterior';
        $data['buttons']['5']['link'] = 'moviles/read/' . $this->uri->segment(3) . '/' . $this->uri->segment(4);
        $data['buttons']['5']['pic'] = 'imagenes/template/movil/flecha_regresar.png';
        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);

        $data = '';
        $this->load->library('email');
        $this->load->model('story');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('to', 'Para', 'required|valid_email');
        $this->form_validation->set_rules('from', 'De', 'required|valid_email');
        $this->form_validation->set_rules('name', 'Nombre', '');
        $this->form_validation->set_rules('comment', 'Comentario', '');

        if (isset($_POST['submit'])) {
            if ($this->form_validation->run() == TRUE) {
                $story = current($this->story->get($_POST['id']));
                $this->email->from($_POST['from']);
                $this->email->to($_POST['to']);
                $this->email->subject('Te han enviado una noticia desde futbolecuador.com');
                $data['datos'] = 'Hola, ' . $_POST['name'] . " pensó que te podia interesar esta noticia:<br><br><br>";
                $data['datos'] .= anchor('stories/publica/' . $story->id, $story->title);
                $data['datos'] .= "<br><br>Visita " . anchor('', 'futbolecuador.com') . " donde podrás encontrar las ultimas noticias del futbol ecuatoriano.";
                $data['disclaimer'] = "Este es un mail autogenerado, por favor no hacer reply del mismo.";
                $body = $this->load->view('popups/mail_template', $data, true);
                $this->email->message($body);
                $this->email->send();
                $mensaje = "<div id='mensaje'>La noticia ha sido enviada correctamente. <br><br>";
                redirect('moviles/read/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/1');
            } else {
                $id = $this->uri->segment(3);
                $data['noticia'] = $this->story->get_complete($id);
                $this->template->write_view('info1', 'movil/send', $data, TRUE);
                $this->template->render();
            }
        } else {
            $id = $this->uri->segment(3);
            $data['noticia'] = $this->story->get_complete($id);
            $this->template->write_view('info1', 'movil/send', $data, TRUE);
            $this->template->render();
        }

    }

    function matches_today_movil()
    {
        $this->load->helper('date');
        $this->load->model('timer');
        $this->load->model('match_calendary');
        $mttd = $this->match_calendary->today_matches('live');
        $i = 1;
        if (!is_array($mttd))
            return 0;
        else {
            foreach ($mttd as $row):
                $aux = strpos(trim($row->result), '-');
                $match[$i]['home']['name'] = $row->hname;
                $match[$i]['home']['sname'] = $row->hsname;
                $match[$i]['home']['result'] = trim(substr(trim($row->result), 0, $aux));
                $match[$i]['away']['name'] = $row->aname;
                $match[$i]['away']['sname'] = $row->asname;
                $match[$i]['away']['result'] = trim(mb_substr(trim($row->result), $aux + 1));
                $time = $this->timer->cal_time_movil($row->id);
                $match[$i]['minuto'] = $time['minuto'];
                $match[$i]['tiempo'] = $time['tiempo'];
                $match[$i]['id'] = $row->id;
                $match[$i]['fecha'] = ucfirst(strftime('%B %d / %y - %H:%M', $row->hour));
                $i += 1;
            endforeach;
            return $match;
        }
    }

    function games()
    {
        $this->output->cache(CACHE_MOVIL);
        $this->load->helper('date');
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $this->load->model('match_calendary');
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);

        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(4);
        if ($this->uri->segment(4) == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {
            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }

        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        $data = '';
        $data['user'] = $this->acl->getCurrentUser();
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);

        $data = '';
        $data['buttons']['1']['name'] = 'Principal';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(4) == 2) {
            $data['title'] = 'Resultados Eliminatorias Sud&aacute;frica 2010';
            $this->template->write_view('title1', 'movil/title', $data, TRUE);
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/sudafrica.png';
        }
        $data['buttons']['3']['name'] = 'Marcador en Vivo';
        $data['buttons']['3']['link'] = 'moviles/scoreboard/' . $this->uri->segment(4);
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/marcador.png';
        if ($this->uri->segment(4) == 1) {
            $data['title'] = 'Resultados Serie A';
            $this->template->write_view('title1', 'movil/title', $data, TRUE);
            /*$data['buttons']['4']['name']='Sud&aacute;frica 2010';
            $data['buttons']['4']['link']='moviles/games/'.$championship['2'].'/2/0';
            $data['buttons']['4']['pic']='imagenes/template/movil/sudafrica.png';*/
        }
        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);
        $data = '';
        $data['buttons']['1']['name'] = 'Anterior';
        $data['buttons']['1']['link'] = 'moviles/games/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . ($this->uri->segment(5) - 1);
        $data['buttons']['1']['type'] = 1;
        $data['buttons']['2']['name'] = 'Siguiente';
        $data['buttons']['2']['link'] = 'moviles/games/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . ($this->uri->segment(5) + 1);
        $data['buttons']['2']['type'] = 2;
        $this->template->write_view('button2', 'movil/button2', $data, TRUE);
        $data = '';
        $data['query'] = $this->match_calendary->match_game($this->uri->segment(3), $this->uri->segment(5));
        $this->template->write_view('info1', 'movil/calendary', $data, TRUE);
        $this->template->render();
    }

    function game_all_movile($id)
    {
        $this->load->helper('date');
        $this->load->model('timer');

        $partido = $this->db->query('SELECT m.id, m.group_id, UNIX_TIMESTAMP(m.date_match) as date, m.result, m.stadia_id, mt.team_id_home as hid, mt.team_id_away as aid
									   FROM matches as m, matches_teams as mt
									   WHERE m.id =' . $this->uri->segment(3) . ' AND mt.match_id=m.id')->result();

        $home = $this->db->query('Select *
									From teams
									Where id=' . $partido[0]->hid)->result();
        $away = $this->db->query('Select *
									From teams
									Where id=' . $partido[0]->aid)->result();

        $aux = strpos(trim($partido[0]->result), '-');
        $match['home']['name'] = $home[0]->name;
        $match['home']['result'] = trim(substr(trim($partido[0]->result), 0, $aux - 1));
        $match['away']['name'] = $away[0]->name;
        $match['away']['result'] = trim(mb_substr(trim($partido[0]->result), $aux + 1));
        $time = $this->timer->cal_time_movil($id);
        $match['minuto'] = $time['minuto'];
        $match['tiempo'] = $time['tiempo'];
        $match['id'] = $id;
        $match['fecha'] = mdate('%Y-%m-%d %h:%i', $partido[0]->date);

        $accion = $this->db->query('Select match_time, type, text
									  From actions
									  Where match_id=' . $this->uri->segment(3));

        $goles = $this->db->query('Select g.minute, p.first_name, p.last_name
								     From goals as g, players as p
									 Where g.match_id=' . $this->uri->segment(3) . ' and p.id=g.player_id');

        $tarjetas = $this->db->query('Select c.minute, c.type, p.first_name, p.last_name
										From cards as c, players as p
										Where c.match_id=' . $this->uri->segment(3) . ' and p.id=c.player_id');

        $cambios = $this->db->query('Select c.minute, p.first_name as fin, p.last_name as lin, l.first_name as fou, l.last_name as lou
									   From changes as c, players as p, players as l
									   Where c.match_id=' . $this->uri->segment(3) . ' and p.id=c.in and l.id=c.out');

        $match['actions'] = '';

        $i = 0;
        foreach ($goles->result() as $row):
            $match['actions'][$i]['action'] = 'Gol de ' . $row->first_name . ' ' . $row->last_name;
            $match['actions'][$i]['type'] = 100;
            $match['actions'][$i]['match_time'] = $row->minute;
            $i++;
        endforeach;
        $type[1] = 'Tarjeta Amarilla';
        $type[2] = 'Tarjeta Roja';
        foreach ($tarjetas->result() as $row):
            $match['actions'][$i]['action'] = $type[$row->type] . ' para ' . $row->first_name . ' ' . $row->last_name;
            $match['actions'][$i]['type'] = 100;
            $match['actions'][$i]['match_time'] = $row->minute;
            $i++;
        endforeach;
        foreach ($cambios->result() as $row):
            $match['actions'][$i]['action'] = 'Cambio ' . $row->fin . ' ' . $row->lin . ' por ' . $row->fou . ' ' . $row->lou;
            $match['actions'][$i]['type'] = 100;
            $match['actions'][$i]['match_time'] = $row->minute;
            $i++;
        endforeach;
        $types['pitazo'] = 1;
        $types['falta'] = 2;
        $types['tarjeta'] = 3;
        $types['penal'] = 4;
        $types['gol'] = 5;
        $types['cambio'] = 6;
        $types['tipo'] = 7;
        foreach ($accion->result() as $row):
            if (is_numeric($row->type))
                $match['actions'][$i]['type'] = $row->type;
            else
                $match['actions'][$i]['type'] = $types[$row->type];

            $match['actions'][$i]['action'] = $row->text;
            $match['actions'][$i]['match_time'] = $row->match_time;
            $i++;
        endforeach;
        if ($i > 0) {
            foreach ($match['actions'] as $key => $arr) {
                $pun[$key] = $arr['match_time'];
                $g1[$key] = $arr['type'];
            }
            array_multisort($pun, SORT_DESC, $g1, SORT_DESC, $match['actions']);
        }

        return $match;

    }

    function user_login()
    {
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $this->template->set_template('movil');
        $this->load->library('form_validation');
        $this->config->set_item('compress_output', 'FALSE');
        $this->form_validation->set_rules('nick', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Clave', 'trim|required|md5');
        $data['error'] = "";
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run() == TRUE) {
                $aux = $this->acl->login($_POST['nick'], $_POST['password']);

                if ($aux) {
                    $mensaje = "<div id='mensaje'>Ha ingresado correctamente.<br><br>";
                    redirect(base_url() . 'welcome/movil/1');
                } else {
                    $data['error'] = "<li>Usuario o Clave incorrectos.</li>";
                    $this->template->write_view('info1', 'movil/visit_login', $data, FALSE);
                }
            } else {
                $this->template->write_view('info1', 'movil/visit_login', $data, FALSE);
            }
        } else {
            $this->template->write_view('info1', 'movil/visit_login', $data, FALSE);
        }

        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(3);
        if ($this->uri->segment(3) == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {
            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(3) == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';
        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$this->uri->segment(3)];
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $this->uri->segment(3);
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';

        if ($this->uri->segment(3) == 2)
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        else
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';

        $data['buttons']['5']['link'] = 'moviles/more/5/' . $this->uri->segment(3);
        $data['buttons']['5']['pic'] = 'imagenes/template/movil/masnoticias.png';
        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);

        $data = '';
        $data['title'] = 'Ingreso';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);

        $this->template->render();
    }


    function logout()
    {
        $this->acl->logout('welcome/movil/1');
    }

    function fblogin()
    {
        $this->config->set_item('compress_output', 'FALSE');
        $this->load->model('user');
        $this->load->library('facebook_connect');
        $fb = $this->facebook_connect->user;


        $data = array(
            'role_id' => 2,
            'first_name' => $fb['first_name'],
            'last_name' => $fb['last_name'],
            'nick' => $fb['name'],
            'mail' => '',
            'team_id' => 0,
            'suscription' => 0,
            'description' => 'fb:' . $fb['uid'],
            'created' => time(),
            'modified' => time(),
            'password' => $fb['uid'],
            'counter' => 0,
            'active' => 1,
            'last_login' => time(),
            'activation_key' => '',
            'points' => 0,
            'country_id' => 0,
            'city_id' => 0,
            'birth' => time(),
            'sex' => 0
        );

        $check = $this->user->check_username($fb['name']);

        if ($check == TRUE)
            $this->db->insert('users', $data);

        $this->acl->login($fb['name'], $fb['uid']);

        redirect(base_url() . 'welcome/movil/1');
    }

    function add_comment()
    {
        $this->config->set_item('compress_output', 'FALSE');

        $this->load->model('user');
        $this->load->model('story');

        $user = $this->user->get($_POST['user_id']);
        $story = current($this->story->get($this->uri->segment(3)));

        $this->load->helper('date');
        unset($_POST['submit']);
        $_POST['created'] = mdate("%Y-%m-%d  %h:%i:%s ", time());
        $_POST['aproved'] = 0;
        $_POST['text'];
        $_POST['story_id'] = $this->uri->segment(3);
        $this->db->insert('comments', $_POST);
        if (substr($user->description, 0, 3) == "fb:") {
            $this->load->library('facebook_connect');
            $action_links = array(array('text' => 'Ir a la noticia', 'href' => base_url() . $story->id));
            $caption = $user->first_name . ' ' . $user->last->name . ' hizo un comentario en esta noticia de futbolecuador.com ';
            $link = base_url() . 'moviles/read/' . $this->uri->segment(3) . '/' . $this->uri->segment(4);
            $attachment = array('name' => $story->title . ' - futbolecuador.com', 'caption' => $caption, 'href' => base_url() . $story->id, 'description' => strip_tags(mb_convert_encoding($story->lead, 'UTF-8', 'HTML-ENTITIES')));
            $this->facebook_connect->facebook_client()->render_prompt_feed_url($action_links, $target_id = null, $_POST['text'], $user_message_prompt = 'Has escuchar tu voz', $caption, $link, $link, $attachment);
        } else {
            redirect(base_url() . 'moviles/read/' . $this->uri->segment(3) . '/' . $this->uri->segment(4));
        }
    }

    function fbpost()
    {
        $this->load->library('facebook_connect');
        $user = $this->session->userdata('facebook_user');
        $err = $this->facebook_connect->client->stream_publish($mensaje);
        echo "Errores:<br>";
        var_dump($err);
    }

    function sms_info()
    {
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);

        $data = '';
        $data['link'] = 'welcome/movil/' . $this->uri->segment(3);
        if ($this->uri->segment(3) == 1) {
            $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';
        } else {

            $data['logo'] = 'imagenes/template/movil/eliminatorias.jpg';
        }
        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        $data = '';
        $data['user'] = $this->acl->getCurrentUser();
        // cambio Byron Herrera
        //$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';
        if ($this->uri->segment(3) == 2) {
            $data['buttons']['2']['name'] = 'Noticias Sud&aacute;frica 2010';
            $data['buttons']['2']['link'] = 'welcome/movil/2';
            $data['buttons']['2']['pic'] = 'imagenes/template/movil/mas_not_elim.png';

        }
        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[$this->uri->segment(3)] . '/' . $this->uri->segment(3) . '/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/' . $this->uri->segment(3);
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';
        if ($this->uri->segment(3) == 2)
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        else
            $data['buttons']['5']['name'] = 'M&aacute;s Noticias';
        $data['buttons']['5']['link'] = 'moviles/more/5/' . $this->uri->segment(3);
        $data['buttons']['5']['pic'] = 'imagenes/template/movil/masnoticias.png';

        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);

        $data = '';
        $data['img']['1'] = base_url() . 'imagenes/moviles/1.jpg';
        $data['img']['2'] = base_url() . 'imagenes/moviles/2.jpg';
        $data['img']['3'] = base_url() . 'imagenes/moviles/3.jpg';
        $data['img']['4'] = base_url() . 'imagenes/moviles/4.jpg';
        $data['img']['5'] = base_url() . 'imagenes/moviles/5.jpg';
        $data['img']['6'] = base_url() . 'imagenes/moviles/6.jpg';
        $data['img']['7'] = base_url() . 'imagenes/moviles/7.jpg';
        $data['img']['8'] = base_url() . 'imagenes/moviles/8.jpg';
        $data['img']['9'] = base_url() . 'imagenes/moviles/9.jpg';
        $data['img']['10'] = base_url() . 'imagenes/moviles/10.jpg';
        $data['img']['11'] = base_url() . 'imagenes/moviles/11.jpg';
        $data['img']['12'] = base_url() . 'imagenes/moviles/12.jpg';
        $data['img']['13'] = base_url() . 'imagenes/moviles/13.jpg';
        $this->template->write_view('info1', 'movil/sms_info', $data, TRUE);

        $this->template->render();
    }

    function whois()
    {
        $this->load->library('user_agent');
        if ($this->agent->is_mobile())
            $m = $this->agent->mobile();
        var_dump($m);
        var_dump($this->agent->platform());
        echo $this->agent->agent_string();
    }

    function femagazine()
    {
        $this->load->library('user_agent');
        $this->output->cache(CACHE_MOVIL);
        $this->load->helper('date');
        $championship['1'] = CHAMP_DEFAULT;
        $championship['2'] = MUNDIAL;
        $section['2'] = 33; //dinamico
        $this->load->model('story');
        $this->template->set_template('movil');
        $this->template->write('title', 'futbolecuador.com - Lo mejor del fútbol ecuatoriano', TRUE);
        $data = '';
        $data['link'] = 'welcome/femagazine';

        $data['logo'] = 'imagenes/template/movil/titulo_logo.jpg';

        $this->template->write_view('logo', 'movil/logo', $data, FALSE);

        $data = "";

        $m = $this->agent->mobile();
        $url = "";
        if ($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i', $this->agent->agent) == 0)
            $m = "Android Tablet";
        switch ($m) {
            case 'Android Tablet':
                $url = "http://goo.gl/zpY8cq";
                break;
            case 'Android':
                $url = "http://goo.gl/zpY8cq";
                break;
            case 'Apple iPad':
                $url = "";
                header('Location: http://goo.gl/76UWV');
                exit();
                break;
            case 'Apple iPhone':
                $url = "";
                header('Location: http://goo.gl/76UWV');
                exit();
                break;

        }
        //solo para el caso de
        $data['url'] = $url;
        $data['m'] = $m;

        $this->template->write_view('button2', 'movil/femagazine', $data, TRUE);

        $data = '';
        $data['buttons']['1']['name'] = 'Inicio';
        $data['buttons']['1']['link'] = 'welcome/movil/1';
        $data['buttons']['1']['pic'] = 'imagenes/template/movil/futec.png';

        $data['buttons']['3']['name'] = 'Resultados & Calendario';
        $data['buttons']['3']['link'] = 'moviles/games/' . $championship[1] . '/1/0';
        $data['buttons']['3']['pic'] = 'imagenes/template/movil/calendario.png';
        $data['buttons']['4']['name'] = 'Marcador en Vivo';
        $data['buttons']['4']['link'] = 'moviles/scoreboard/1';
        $data['buttons']['4']['pic'] = 'imagenes/template/movil/marcador.png';

        $this->template->write_view('button3', 'movil/button_black', $data, TRUE);
        $data = '';
        $data['title'] = 'FEMAGAZINE';
        $this->template->write_view('title1', 'movil/title', $data, TRUE);

        $this->template->render();

    }

}