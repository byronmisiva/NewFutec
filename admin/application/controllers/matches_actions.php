<?php

class Matches_actions extends CI_Controller
{

    var $actions_types;

    function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->template->add_js('js/ajax.js');

        $path = "imagenes/icons/";
        $this->actions_type = array('gol' => $path . "gol.png", 'falta' => $path . "tarjeta.png", 'tarjeta' => $path . "tarjeta.png", 'pitazo' => $path . "arbitro.png",
            '92' => $path . "arbitro.png", '93' => $path . "arbitro.png", '94' => $path . "arbitro.png",
            '95' => $path . "arbitro.png", '96' => $path . "arbitro.png", '97' => $path . "arbitro.png",
            '98' => $path . "arbitro.png", '99' => $path . "arbitro.png", '2' => $path . "tarjeta_roja.png",
            '1' => $path . "tarjeta_amarilla.png", 'in' => $path . "entra.png", 'out' => $path . "sale.png", 'tipo' => $path . 'player.png', 'cambio' => $path . 'cambio.png');

        //Validacion ACL
       /* if (!$this->acl->checkAcl($this->uri->segment(1), $this->uri->segment(2), FALSE)) {
            redirect('admin');
        }*/

    }

    function index()
    {
        $data['title'] = 'ACCIONES DEL ';
        $data['heading'] = 'PARTIDO';
        $query6 = $this->db->query('SELECT id, name
								  FROM teams
								  WHERE id=' . $this->uri->segment(4) . ' OR id=' . $this->uri->segment(5) . '
								  ORDER BY name ASC');
        $data['query6'] = $query6;
        $data['mt'] = $this->db->query('SELECT group_id
									  FROM matches
									  WHERE id=' . $this->uri->segment(3))->result();
        $cn = $this->db->query("SELECT c.name as cname, r.name as rname, g.name as gname
							  FROM championships as c, rounds as r, groups as g, matches as m
							  WHERE m.id=" . $this->uri->segment(3) . " AND m.group_id=g.id AND g.round_id=r.id AND r.championship_id =c.id")->result();

        $ts = $this->db->query("SELECT mt.team_id_home, mt.team_id_away, t1.name as hname, t2.name as aname
	    					  FROM matches_teams as mt, teams as t1, teams as t2
	    					  WHERE mt.match_id=" . $this->uri->segment(3) . " AND t1.id=mt.team_id_home AND t2.id=mt.team_id_away")->result();

        $ar = $this->db->query("SELECT rc.id as rc, r1.id as r1, r2.id as r2, rs.id as rs
							  FROM ( SELECT mr. *
									 FROM matches_referee AS mr
									 WHERE mr.match_id =" . $this->uri->segment(3) . " ) AS mr
							LEFT JOIN referee AS rc ON mr.referee_id_central = rc.id
							LEFT JOIN referee AS r1 ON mr.referee_id_line1 = r1.id
							LEFT JOIN referee AS r2 ON mr.referee_id_line2 = r2.id
							LEFT JOIN referee AS rs ON mr.referee_id_sub = rs.id");

        $this->load->model('referee');
        $data['ref'] = $this->referee->get_list();

        if ($this->uri->segment(4) == $ts[0]->team_id_home) {
            $data['t2'] = ' Visitante';
            $data['t2id'] = $ts[0]->team_id_away;
        } else {
            $data['t2'] = ' Local';
            $data['t2id'] = $ts[0]->team_id_home;
        }

        $data['from'] = strtoupper('<h3>' . $cn[0]->cname . ' / ' . $cn[0]->rname . ' / ' . $cn[0]->gname . '</h3><h2 align="center"><i>' . $ts[0]->hname . ' VS ' . $ts[0]->aname . '</i></h2>');


        if ($ar->num_rows() == 0) {
            $ar = '';
            $ar[0]->rc = '';
            $ar[0]->r1 = '';
            $ar[0]->r2 = '';
            $ar[0]->rs = '';
            $data['ar'] = $ar;
        } else {
            $data['ar'] = $ar->result();
        }
        $this->view('matches_actions_view', $data);
    }

    function actions_insert()
    {
        if (isset($_POST['submit'])) {
            $_POST['created'] = mdate("%Y-%m-%d  %h:%i:%s ", time());
            unset($_POST['submit']);
            unset($_POST['_']);
            $this->db->insert('actions', $_POST);
            //llamada para notificaciones
            $this->notificacionMarcadorEnVivo($_POST, $_POST['type']);
            redirect('actions/index/' . $_POST['match_id'] . '/' . $_POST['team_id']);
        }
        $this->load->view('actions_vinsert');
    }

    function changes_insert()
    {
        $datos['match_id'] = $this->uri->segment(3);
        $datos['team_id'] = $this->uri->segment(4);
        $datos['in'] = $this->uri->segment(5);
        $datos['out'] = $this->uri->segment(6);
        $datos['minute'] = $this->uri->segment(7);
        if ($this->uri->segment(8) == "ingreso") {
            $this->db->insert('changes', $datos);
            $player_in = current($this->db->query("SELECT id, status FROM lineups WHERE match_id = " . $datos['match_id'] . " AND player_id=" . $datos['in'])->result());
            echo $this->db->last_query();
            $player_out = current($this->db->query("SELECT id, status FROM lineups WHERE match_id = " . $datos['match_id'] . " AND player_id=" . $datos['out'])->result());
            echo $this->db->last_query();
            $data['status'] = 2;
            if ($player_out->status == 1)
                $data2['status'] = 3;
            else
                $data2['status'] = 4;
            $this->db->where('id', $player_in->id);
            $this->db->update('lineups', $data);
            $this->db->where('id', $player_out->id);
            $this->db->update('lineups', $data2);
            exit;
        }
        $data3['query2'] = $this->db->query("SELECT p.id, p.first_name, p.last_name
										 FROM (SELECT * 
										 	   FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid 
										 	        FROM lineups AS l 
										 	        WHERE (l.status=1 OR l.status=2) and l.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . ") as l
										 	   LEFT JOIN (SELECT id as cid, player_id as cpid FROM cards AS c 
										 	   WHERE c.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . " AND type=2) AS c ON lpid=cpid) as lc, players as p
									     WHERE cpid is null and lpid=p.id");

        $data3['query'] = $this->db->query("SELECT p.id, p.first_name, p.last_name
										 FROM (SELECT * 
										 	   FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid 
										 	        FROM lineups AS l 
										 	        WHERE l.status=0 and l.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . ") as l
										 	   LEFT JOIN (SELECT id as cid, player_id as cpid FROM cards AS c 
										 	   WHERE c.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . " AND type=2) AS c ON lpid=cpid) as lc, players as p
									     WHERE cpid is null and lpid=p.id");

        $this->load->view('changes_vinsert', $data3);
    }

    function goals_insert()
    {
        $datos['match_id'] = $this->uri->segment(3);
        $datos['team_id'] = $this->uri->segment(4);
        $datos['player_id'] = $this->uri->segment(5);
        $datos['minute'] = $this->uri->segment(6);
        $datos['type'] = $this->uri->segment(7);
        if ($this->uri->segment(8) == "ingreso") {
            $this->db->insert('goals', $datos);

            //Actualizo el valor de resultado el momento que se hace un gol
            $this->load->model('match');

            $match = $this->match->get_teams($this->uri->segment(3));
            $home = $this->match->get_goals($this->uri->segment(3), $match->team_id_home);
            $away = $this->match->get_goals($this->uri->segment(3), $match->team_id_away);
            $result = $home . " - " . $away;
            $this->db->where('id', $this->uri->segment(3));
            $this->db->update('matches', array('result' => $result));
            exit;
        }
        $data['query'] = $this->db->query("SELECT p.id, p.first_name, p.last_name
										 FROM (SELECT * 
										 	   FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid 
										 	        FROM lineups AS l 
										 	        WHERE (l.status=1 OR l.status=2) and l.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . ") as l
										 	   LEFT JOIN (SELECT id as cid, player_id as cpid FROM cards AS c 
										 	   WHERE c.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . " AND type=2) AS c ON lpid=cpid) as lc, players as p
									     WHERE cpid is null and lpid=p.id");
        $this->load->view('goals_vinsert', $data);

    }

    function cards_insert()
    {
        $datos['match_id'] = $this->uri->segment(3);
        $datos['team_id'] = $this->uri->segment(4);
        $datos['player_id'] = $this->uri->segment(5);
        $datos['minute'] = $this->uri->segment(6);
        $datos['type'] = $this->uri->segment(7);
        if ($this->uri->segment(8) == "ingreso") {

            $this->db->insert('cards', $datos);
            exit;
        }
        $data['query'] = $this->db->query("SELECT p.id, p.first_name, p.last_name
									     FROM  (SELECT *
      										    FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid
                   								     FROM lineups AS l
                   							    	 WHERE l.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . ") as l
								         		LEFT JOIN (SELECT id as cid, player_id as cpid
                  								   		   FROM cards AS c
                  										   WHERE c.match_id =" . $this->uri->segment(3) . " AND team_id =" . $this->uri->segment(4) . " AND type=2) AS c ON lpid=cpid) as lc, players as p
										 WHERE cpid is null and lpid=p.id");
        $this->load->view('cards_vinsert', $data);
    }

    function matches_table_view()
    {
        $query = $this->db->query('SELECT a.id, a.text, a.match_time as minute, a.type
								 FROM actions as a
								 WHERE a.match_id=' . $this->uri->segment(3));

        $query2 = $this->db->query('SELECT g.id, p.first_name as fname, p.last_name as lname, g.type, g.team_id as team, t.name as tname, g.minute
					              FROM goals as g, players as p, teams as t
					              WHERE g.match_id=' . $this->uri->segment(3) . ' AND g.player_id=p.id AND g.team_id=t.id');

        $query3 = $this->db->query('SELECT c.id, p.first_name as fname, p.last_name as lname, c.type, c.team_id as team, t.name as tname, c.minute
					              FROM cards as c, players as p, teams as t
					              WHERE c.match_id=' . $this->uri->segment(3) . ' AND c.player_id=p.id AND c.team_id=t.id');

        $query4 = $this->db->query('SELECT entra.*, sale.fnameout, sale.lnameout
		                          FROM  (SELECT c.id, p.first_name as fnamein, p.last_name as lnamein, c.team_id as team, t.name as tname, c.minute
					                     FROM changes as c, players as p, teams as t
					                     WHERE c.match_id=' . $this->uri->segment(3) . ' AND c.in=p.id AND c.team_id=t.id) as entra,
					                    (SELECT c.id, p.first_name as fnameout, p.last_name as lnameout
					                     FROM changes as c, players as p
					                     WHERE c.match_id=' . $this->uri->segment(3) . ' AND c.out=p.id) as sale
					              WHERE entra.id=sale.id');

        $query5 = $this->db->query('SELECT id, thumb_shield
								  FROM teams 
								  WHERE id=' . $this->uri->segment(4) . ' OR id=' . $this->uri->segment(5));


        $g = current($this->db->query('SELECT group_id
							 FROM matches
							 WHERE id=' . $this->uri->segment(3))->result());

        $data['group_id'] = $g->group_id;

        foreach ($query5->result() as $row):
            $pics[$row->id] = $row->thumb_shield;
        endforeach;

        $i = 0;
        $tabla = array();
        foreach ($query->result() as $row):
            $i += 1;
            $tabla[$i]["id"] = $row->id;
            $tabla[$i]["text"] = strip_tags($row->text);
            $tabla[$i]["team"] = $this->actions_type[$row->type];
            $tabla[$i]["tname"] = "";
            $tabla[$i]["minute"] = $row->minute;
            if (is_numeric($row->type))
                $tabla[$i]["type"] = $row->type;
            else
                $tabla[$i]["type"] = 4;
        endforeach;
        foreach ($query2->result() as $row):
            $i += 1;
            if ($row->type == 1)
                $au = 'Normal';
            if ($row->type == 2)
                $au = 'Penal';
            if ($row->type == 3)
                $au = 'Autogol';
            $tabla[$i]["id"] = $row->id;
            $tabla[$i]["text"] = 'Gol ' . $au . ' de ' . $row->fname . ' ' . $row->lname;
            $tabla[$i]["team"] = $pics[$row->team];
            $tabla[$i]["tname"] = $row->tname;
            $tabla[$i]["minute"] = $row->minute;
            $tabla[$i]["type"] = 1;
        endforeach;
        foreach ($query3->result() as $row):
            $i += 1;
            if ($row->type == 1)
                $au = 'Amarilla';
            else
                $au = 'Roja';
            $tabla[$i]["id"] = $row->id;
            $tabla[$i]["text"] = 'Tarjeta ' . $au . ' a ' . $row->fname . ' ' . $row->lname;
            $tabla[$i]["team"] = $pics[$row->team];
            $tabla[$i]["tname"] = $row->tname;
            $tabla[$i]["minute"] = $row->minute;
            $tabla[$i]["type"] = 2;
        endforeach;
        foreach ($query4->result() as $row):
            $i += 1;
            $tabla[$i]["id"] = $row->id;
            $tabla[$i]["text"] = 'Entra ' . $row->fnamein . ' ' . $row->lnamein . ' por ' . $row->fnameout . ' ' . $row->lnameout;
            $tabla[$i]["team"] = $pics[$row->team];
            $tabla[$i]["tname"] = $row->tname;
            $tabla[$i]["minute"] = $row->minute;
            $tabla[$i]["type"] = 3;
        endforeach;
        if (count($tabla) != 0) {
            foreach ($tabla as $key => $arr):
                $pun[$key] = $arr['minute'];
                $g1[$key] = $arr['type'];
            endforeach;

            array_multisort($pun, SORT_DESC, $g1, SORT_DESC, $tabla);
        }

        $data['tabla'] = $tabla;
        $this->load->view('table_view', $data);
    }

    function delete_actions()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('actions');
    }

    function delete_goals()
    {
        $this->db->where('id', $this->uri->segment(3));
        $goal = current($this->db->get('goals')->result());

        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('goals');

        //Actualizo el valor de resultado el momento que se borra un gol
        $this->load->model('match');

        $match = $this->match->get_teams($goal->match_id);
        $home = $this->match->get_goals($goal->match_id, $match->team_id_home);
        $away = $this->match->get_goals($goal->match_id, $match->team_id_away);
        $result = $home . " - " . $away;
        $this->db->where('id', $goal->match_id);
        $this->db->update('matches', array('result' => $result));
    }

    function delete_cards()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('cards');
    }

    function delete_changes()
    {
        $row = current($this->db->query("SELECT c.in, c.out FROM changes as c WHERE id = " . $this->uri->segment(3))->result());
        $row2 = current($this->db->query("SELECT id, status FROM lineups WHERE match_id = " . $this->uri->segment(4) . " AND player_id=" . $row->in)->result());
        $row3 = current($this->db->query("SELECT id, status FROM lineups WHERE match_id = " . $this->uri->segment(4) . " AND player_id=" . $row->out)->result());
        $data['status'] = 0;
        if ($row3->status == 4)
            $data2['status'] = 2;
        else
            $data2['status'] = 1;
        $this->db->where('id', $row2->id);
        $this->db->update('lineups', $data);
        $this->db->where('id', $row3->id);
        $this->db->update('lineups', $data2);
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('changes');
    }

    function matches_state_view()
    {

        $this->load->view('matches_state_view');
    }

    function timer_view()
    {
        $this->config->set_item('compress_output', 'FALSE');
        echo "<script type=\"text/javascript\">\n" . "AC_FL_RunContent2('nombre','cronometro','codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','300','height','70','src','" . base_url() . "archivos/varios/cronometro','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','window','movie','" . base_url() . "archivos/varios/cronometro','FlashVars','partido=" . $this->uri->segment(3) . "&base=" . base_url() . "');\n" . "</script>\n";
    }

    function state_insert()
    {
        unset ($_POST['_']);
        $_POST['state'] = $this->uri->segment(3);
        $_POST['id'] = $this->uri->segment(4);
        $this->db->where('id', $_POST['id']);
        $this->db->update('matches', $_POST);


        $estado['1']['n'] = 'Primer Tiempo';
        $estado['2']['n'] = 'Fin del Primer Tiempo';
        $estado['3']['n'] = 'Segundo Tiempo';
        $estado['4']['n'] = 'Fin del Segundo Tiempo';
        $estado['5']['n'] = 'Primer Extra';
        $estado['6']['n'] = 'Segundo Extra';
        $estado['7']['n'] = 'Penales';
        $estado['8']['n'] = 'Fin del Partido';
        $estado['1']['t'] = 0;
        $estado['2']['t'] = 45;
        $estado['3']['t'] = 45;
        $estado['4']['t'] = 90;
        $estado['5']['t'] = 90;
        $estado['6']['t'] = 105;
        $estado['7']['t'] = 130;
        $estado['8']['t'] = 200;
        $estado['1']['y'] = 92;
        $estado['2']['y'] = 93;
        $estado['3']['y'] = 94;
        $estado['4']['y'] = 95;
        $estado['5']['y'] = 96;
        $estado['6']['y'] = 97;
        $estado['7']['y'] = 98;
        $estado['8']['y'] = 99;

        unset ($_POST['state']);

        $_POST['id'] = '0';
        $_POST['match_id'] = $this->uri->segment(4);
        $_POST['text'] = $estado[$this->uri->segment(3)]['n'];
        $_POST['type'] = $estado[$this->uri->segment(3)]['y'];
        $_POST['match_time'] = $estado[$this->uri->segment(3)]['t'];
        $_POST['created'] = mdate("%Y-%m-%d  %h:%i:%s ", time());
        $this->db->insert('actions', $_POST);
        //llamada para notificaciones
        $this->notificacionMarcadorEnVivo($_POST, $estado[$this->uri->segment(3)]['y']);
    }

    function notificacionMarcadorEnVivo($data, $estado)
    {


        // recuperar equipos
        $sql = "SELECT
                    matches_teams.team_id_home,  (select teams.name from teams where teams.id = matches_teams.team_id_home ) AS home_name,
                    (select sections.id from sections WHERE  team_id =  matches_teams.team_id_home) as seccion_home,
                    matches_teams.team_id_away, (select teams.name from teams where teams.id = matches_teams.team_id_away ) AS away_name,
                    (select sections.id from sections WHERE  team_id =  matches_teams.team_id_away) as seccion_away,
                    matches_teams.id
                FROM matches_teams where
                matches_teams.match_id =" . $data['match_id'];
        $query = $this->db->query($sql);
        $query = $query->result();


        $marcadorHome = "";
        $marcadorAway = "";
        $vs = " - ";
        $tiposPartido = array(93, 95, 99, 98);


        if ((in_array($estado, $tiposPartido)) or ($estado == "gol")) {
            //consultamos el marcador del partido
            $sql2 = "SELECT result FROM matches WHERE id = " . $data['match_id'];
            $query2 = $this->db->query($sql2);
            $query2 = $query2->result();
            if ($query2[0]->result != "") {
                $marcador = explode("-", $query2[0]->result);
                $vs = " - ";
                $marcadorHome = " " . $marcador[0];
                $marcadorAway =   $marcador[1] . " ";

            }
        }

        if ($estado == "gol") {
            // en caso de que sea gol del equipo
            $contenido = $data['text'] . ". " . $query[0]->home_name . $marcadorHome . $vs . $marcadorAway . $query[0]->away_name;
        } else {
            //caso evento
            if (in_array($estado, array (92,93,94,95,96,97,98, 99)))
                $contenido = $query[0]->home_name . $marcadorHome . $vs . $marcadorAway . $query[0]->away_name . " | " . $data['text'];
            else
                return;
        }


        // pruebas de notificacion se generan eventos para todos los partidos
        $equiposCopaAmerica = array (26, 34, 35, 36, 37, 38, 39, 40, 41, 42, 72, 73);
        $home = $query[0]->seccion_home;
        $visita = $query[0]->seccion_away;

        //    if (in_array($home, $equiposCopaAmerica)){
        // $query[0]->seccion_home = 26;
        //   }
        //   if (in_array($visita, $equiposCopaAmerica)){
        //  $query[0]->seccion_away = 26;
        //   }
        //fin pruebas

        $envios = array();
        $envios[] = $query[0]->seccion_home . "-IN3";
        $envios[] = $query[0]->seccion_away . "-IN3";

        $this->pwCallMobile('createMessage', array(

                'application' => PW_APP_MOBILE,
                'auth' => PW_AUTH,
                'notifications' => array(
                    array(
                        'send_date' => 'now',
                        'content' => $contenido,
                        'link' => 'http://www.futbolecuador.com/site/partido/pushapp/' . $data['match_id'],
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
        $res = $this->doPostRequest($url, $json, 'Content-Type: application/json');
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
            throw new Exception("Problem with $url");

        $response = @stream_get_contents($fp);
        if ($response === false)
            return false;
        return $response;
    }


    function score_view()
    {
        $partido[$this->uri->segment(4)]['id'] = $this->uri->segment(4);
        $partido[$this->uri->segment(5)]['id'] = $this->uri->segment(5);

        $query = $this->db->query('Select *
						  		 From goals
						  		 Where match_id=' . $this->uri->segment(3));

        $partido[$this->uri->segment(4)]['goals'] = 0;
        $partido[$this->uri->segment(5)]['goals'] = 0;

        foreach ($query->result() as $row):
            if ($row->team_id == $this->uri->segment(4) AND $row->type != 3)
                $partido[$this->uri->segment(4)]['goals'] += 1;
            if ($row->team_id == $this->uri->segment(4) AND $row->type == 3)
                $partido[$this->uri->segment(5)]['goals'] += 1;
            if ($row->team_id == $this->uri->segment(5) AND $row->type != 3)
                $partido[$this->uri->segment(5)]['goals'] += 1;
            if ($row->team_id == $this->uri->segment(5) AND $row->type == 3)
                $partido[$this->uri->segment(4)]['goals'] += 1;
        endforeach;

        $query = $this->db->query('Select t.id, t.name
								 From teams as t
								 Where id=' . $this->uri->segment(4) . ' OR id=' . $this->uri->segment(5));

        foreach ($query->result() as $row):
            $partido[$row->id]['name'] = $row->name;
        endforeach;
        $data['h'] = $this->uri->segment(4);
        $data['a'] = $this->uri->segment(5);
        $data['partido'] = $partido;
        $this->load->view('score_view', $data);
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

}

?>