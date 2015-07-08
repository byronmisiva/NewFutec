<?php
class Histories extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('palmares', 'Palmares', 'required');
        $this->form_validation->set_rules('best_players', 'Mejores Jugadores', 'required');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
    }

    function index()
    {
        $config['base_url'] = base_url() . '/histories/index/' . $this->uri->segment(3);
        $team_id = $this->uri->segment(3);
        $row = $this->db->query("SELECT COUNT(*) AS numrows FROM histories where team_id = $team_id")->result(0);
        $config['total_rows'] = $row[0]->numrows;
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $this->pagination->initialize($config);
        $data['title'] = "HISTORIAS ";
        $data['heading'] = "ACCESO";
        $data['datestring'] = "%Y-%m-%d  %h:%i %a ";
        $data['time'] = time();
        if (!$this->uri->segment(4) == '')
            $pagina = "LIMIT " . $this->uri->segment(4) . " , " . $config['per_page'];
        else
            $pagina = "LIMIT " . $config['per_page'];
        $data['query'] = $this->db->query('SELECT h.id, t.name, h.palmares, h.best_players
						  				 FROM (histories as h, teams as t) 
						  				 WHERE h.team_id = t.id and t.id=' . $this->uri->segment(3) . ' ' . $pagina);
        $cn = $this->db->query("SELECT t.name
							  FROM teams as t
							  WHERE t.id=" . $this->uri->segment(3))->result();
        $data['from'] = strtoupper($cn[0]->name);
        $this->view('histories_view', $data);
    }

    function insert()
    {
        $data['title'] = "HISTORIES ";
        $data['heading'] = "INGRESO";
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run() == TRUE) {
                unset($_POST['submit']);
                $this->db->insert('histories', $_POST);
                redirect('histories/index/' . $_POST['team_id']);
            }
        }

        $this->view('histories_vinsert', $data);
    }

    function delete()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('histories');
        redirect('histories/index/' . $this->uri->segment(4));
    }

    function confirm_delete()
    {
        $this->load->view('histories_confirm_delete');
    }

    function update()
    {
        $data['title'] = "HISTORIAS ";
        $data['heading'] = "ACTUALIZAR";
        if (isset($_POST['submit'])) {
            if ($this->form_validation->run() == TRUE) {
                unset($_POST['submit']);
                $this->db->where('id', $_POST['id']);
                $this->db->update('histories', $_POST);
                redirect('histories/index/' . $_POST['team_id']);
            }
        }
        $this->db->where('id', $this->uri->segment(3));
        $data['query'] = $this->db->get('histories');
        $this->view('histories_vupdate', $data);
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

    /////////FUNCIONES NOTICIAS SECCION MAGAZINE///// author: LUIS NAVARRETE

    function getNewsBySecction($id_seccion = '', $limit = '')
    {
        $this->output->cache(CACHE_MOVIL);
        $this->load->model('story');
        $this->load->model('image');

        $secciones = array('' => 'Últimas Noticias', '11' => 'Selección', '16' => 'Serie A');

        $data['seccion'] = $secciones[$id_seccion];

        if ($id_seccion != '' && $limit != '') {
            $news = $this->story->get_by_category($id_seccion, $limit)->result();
        } else {
            $news = $this->story->rotativa();
        }
        foreach ($news as $new) {
            $new->image_id = $this->image->get($new->image_id)->thumbh120;
        }
        $data['news'] = $news;
        $this->load->view('magazine/section_news', $data);
    }
    /////////FUNCIONES NOTICIAS SECCION MAGAZINE///// author: LUIS NAVARRETE

    function getNewsBySecction2($id_seccion = '', $limit = 8)
    {
        $this->output->cache(CACHE_MOVIL);
        $this->load->model('story');
        $this->load->model('image');

        $secciones = array('' => 'Últimas Noticias', '11' => 'Selección', '16' => 'Serie A');

        $data['seccion'] = $secciones[$id_seccion];

//        if ($id_seccion != '' && $limit != '') {
//            $news = $this->story->get_by_category($id_seccion, $limit)->result();
//        } else {
//            $news = $this->story->rotativa(0, $limit,0);
//        }

        $news = $this->story->rotativa(0, $limit,0);
        $newsSel = $this->story->get_by_category('16', $limit)->result();
        $newsA = $this->story->get_by_category('11', $limit)->result();

        foreach ($news as $new) {
            $new->image_id = $this->image->get($new->image_id)->thumbh120;
        }
        foreach ($newsSel as $newSel) {
            $newSel->image_id = $this->image->get($newSel->image_id)->thumbh120;
        }
        foreach ($newsA as $newA) {
            $newA->image_id = $this->image->get($newA->image_id)->thumbh120;
        }
        $data['news'] = $news;
        $data['newsSel'] = $newsSel;
        $data['newsA'] = $newsA;
        $this->load->view('magazine/section_news2', $data);
    }

    function getNewsBySecctionId($id = '')
    {
        if ($id != '') {
            $this->output->cache(CACHE_MOVIL);
            $this->load->model('story');
            $this->load->model('image');
            $news  = $this->story->get($id) ;
            $news  = $news[0];
            $news->image_id = $this->image->get($news->image_id)->thumbh120;
            $data['news'] = $news;
            $this->load->view('magazine/section_news_id', $data);
        }
    }

    function leaderboard_magazine($champ)
    {
	//if($champ=="45")	
	$champ="53";

        $this->output->cache(CACHE_MOVIL);

        $this->load->model('group');
        $this->load->model('teams_position');
        $this->load->model('section');
        $this->load->model('championship');

        $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
            base_url() . 'imagenes/icons/igual.png',
            base_url() . 'imagenes/icons/flecha_abajo.png');

        $round = $this->championship->get_active_round($champ);
        if ($round != false) {
            $data['groups'] = $this->group->get_by_round($round);
            $data['teams'] = $this->section->get_teams($champ);
            $data['active'] = current($data['groups'])->id;
            if (count($data['groups']) > 1)
                $data['script'] = "document.observe('dom:loaded',function(){ new Control.Tabs('groups_tabs');});";
            $group = current($data['groups'])->id;

            if ($group != "")
                $data['tabla'] = $this->teams_position->get_table($group);

            $this->load->view('magazine/leaderboard', $data);
        }

    }

    function list_played_matches_magazine()
    {
        //$this->output->cache(CACHE_MOVIL);
        $this->load->model('match_calendary');
        $champ = $this->uri->segment(3);
        $data['champ'] = $champ;
        $data['partidos'] = $this->match_calendary->matches_last_next($champ, FALSE);
        $this->load->view('magazine/list_results', $data);
    }

    function prueba()
    {
        $this->load->library('user_agent');

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        var_dump($agent);
        var_dump($this->agent->mobile());
        echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>";

    }

}

?>
