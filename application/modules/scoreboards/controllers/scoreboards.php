<?php

class Scoreboards extends MY_Controller
{

    public $model = 'mdl_scoreboards';

    public function __construct()
    {
        parent::__construct();
    }

    public function tablaposiciones($temporada, $tipoChamp = 'acumulada')
    {  	
    	
    	if ($temporada == "56")
    		$temporada = 63;    	
    	
        $data['tipoCampeonato'] = $tipoChamp;
        if ($tipoChamp == 'acumulada') {
            $data['scroreBoardAcumulative'] = $this->leaderboard_cumulative($temporada);
            $data['scroreBoardSingle'] = $this->leaderboard($temporada);
            $data['champ'] = $temporada;
            $data['tipoCampeonato'] = $tipoChamp;
            $conten = strip_tags(trim($data['scroreBoardSingle']));
            if ($conten == "Tabla vacía") {
                $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
            }
            return $this->load->view('tablaposiciones', $data, TRUE);
        } else {
            $data['scroreBoardSingle'] = $this->leaderboard($temporada, 'leaderboard', $tipoChamp);
            $data['champ'] = $temporada;
            $data['tipoCampeonato'] = $tipoChamp;
            return $this->load->view('tablaposicionessimple', $data, TRUE);
        }
    }


    // Listado de equipos por campeonato
    public function leaderboard_only($champ)
    {
        $round = $this->mdl_teams_position->get_active_round($champ);
        if ($round != false) {
            //$active_group = current($this->mdl_teams_position->get_by_round($round));
            $datatabla = $this->mdl_teams_position->get_table_only($champ);
            $seleccionNacional = '{
                                    "id": "5",
                                    "checked": "false",
                                    "name": "Selección Nacional",
                                    "mini_shield": "imagenes\/teams\/shield\/Ecuador.png",
                                    "sid": "26"
                                   }';


            $seleccionNacional = json_decode($seleccionNacional);

            array_unshift($datatabla,$seleccionNacional) ;
            return $datatabla;
        } else {
            return false;
        }
    }

//Fin Tabla de Posiciones
// Tabla de Posiciones
    public function leaderboard($champ, $leaderboard = 'leaderboard', $tipoCampeonato = 'acumulada')
    {
        $data['tipoCampeonato'] = $tipoCampeonato;
        $round = $this->mdl_teams_position->get_active_round($champ);
        if ($tipoCampeonato == 'acumulada') {
            $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
                base_url() . 'imagenes/icons/igual.png',
                base_url() . 'imagenes/icons/flecha_abajo.png');

            if ($round != false) {
                $active_group = current($this->mdl_teams_position->get_by_round($round));
                $data['teams'] = $this->mdl_teams_position->get_teams($champ);
                $data['tabla'] = $this->mdl_teams_position->get_table($active_group->id, $round);
                return $this->load->view($leaderboard, $data, true);
            } else {
                return false;
            }
        } else {
            // para el caso que son simples, el icono no se usa el sprite sino la imagen del equipo
            $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
                base_url() . 'imagenes/icons/igual.png',
                base_url() . 'imagenes/icons/flecha_abajo.png');
 		//todo caso copa america
                /**En la condicion de ($champ == AMERICA) se tiene q asignar a la variable $round el id de la competencia 
                 * En el caso de copa america o alguna competicios en la que constenn grupos se requiere comentar la linea 113 la cual retorna solo un grupo
                 * al momebto de comentar nos devolvera todas las tablas de la competencia. 
                 * **/
            if ($round != false) {

                //todo caso copa america
                if ($champ == AMERICA) $round = 225;

                $grupoActivo = $this->mdl_teams_position->get_by_round($round);
                $data['tabla'] = array();
                $tablas = "";
                $data['teams'] = $this->mdl_teams_position->get_teams($champ);
                //recuperamos los resultados de cada grupo
                foreach ($grupoActivo as $grupo) {
                    //$data['tabla'] = array_merge($data['tabla'], $this->mdl_teams_position->get_table($grupo->id));
                    $data['tabla'] = $this->mdl_teams_position->get_table($grupo->id);

                    //return $this->load->view($leaderboard, $data, true);

                    $tablas = $tablas . $this->load->view($leaderboard, $data, true);
                }
                return $tablas;
            } else {
                return false;
            }
        }
    }

//Fin Tabla de Posiciones

    public
    function matches_today()
    {

        $data['title'] = "Partidos de Hoy";
        $data['scores'] = $this->mdl_scoreboards->today_matches();
        if ($data['scores'] == false) {
            $data['scores'] = $this->match_calendary->last_matches();
            $data['title'] = "Ultima Fecha";
        }

        $this->load->view('scoreboards/scoreboards_live', $data);

    }


    function list_played_matches()
    {

        $champ = $this->uri->segment(3);
        $data['champ'] = $champ;
        $data['partidos'] = $this->match_calendary->matches_last_next(FALSE, FALSE);
        $this->load->view($this->folder_views . '/list_results', $data);
    }

    public
    function scoreboardFull($champ, $tipoCampeonato = 'acumulada')
    {
        $this->load->module('teams_position');
        $this->load->module('contenido');
        $data['champ'] = $champ;
        $data['tipoCampeonato'] = $tipoCampeonato;
        if ($tipoCampeonato == 'acumulada') {
            $data['scroreBoardAcumulative'] = $this->scoreboards->leaderboard_cumulative($champ, "leaderboarddetail");
            $data['scroreBoardSingle'] = $this->scoreboards->leaderboard($champ, "leaderboarddetail");
            $conten = strip_tags(trim($data['scroreBoardSingle']));
            if ($conten == "Tabla vacía") {
                $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
            }

        } else {
            $data['scroreBoardAcumulative'] = "";
            $data['scroreBoardSingle'] = $this->scoreboards->leaderboard($champ, "leaderboarddetail", $tipoCampeonato);
            $conten = strip_tags(trim($data['scroreBoardSingle']));
            if ($conten == "Tabla vacía") {
                $data['scroreBoardSingle'] = $data['scroreBoardAcumulative'];
            }
        }
        return $this->load->view('leaderboardFull', $data, true);

    }

// Tabla de Posiciones  acumulada
    public
    function leaderboard_cumulative($champ, $leaderboard = 'leaderboard')
    {

        $data['change'] = array(base_url() . 'imagenes/icons/flecha_arriba.png',
            base_url() . 'imagenes/icons/igual.png',
            base_url() . 'imagenes/icons/flecha_abajo.png');

        $data['tabla'] = $this->mdl_teams_position->get_table_by_champ($champ);


        return $this->load->view($leaderboard, $data, true);
    }

    public function getMatchOggImageTablaPos()
    {
        //recuperamos id equipos del partido

        $sql = 'SELECT imagen FROM imagenesmarcador WHERE link LIKE "%tabla-de-posiciones%" or link LIKE "%tabladeposiciones%" ORDER BY creado DESC LIMIT 1';

        $query = $this->db->query( $sql);

        $match = $query->result();
        if (isset($match[0]->imagen))
            return 'http://new.futbolecuador.com/getmarcador/' . $match[0]->imagen;
        else
            return '';
    }
//Fin Tabla de Posiciones acumulada
}
