<?php

class Ranking extends MY_Controller
{

    public $model = 'mdl_ranking';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function viewRankingFases($idgrupo)
    {

        $this->load->module('fases');
        $this->load->module('grupos');
        $fases = $this->fases->get(array('select' => '*', 'where' => array('active' => '1')), TRUE);


        $grupos = $this->grupos->get(array('select' => 'id,nombre', 'where' => array('fases_id' => $fases->id)));


        $tablas = array();
        foreach ($grupos as $grupo) {
            $grupo->tabla = $this->get(array(
                'select' => 'ranking.id,n_puntos,n_puntos_contra,n_partidos,n_partidos_ganados,
					n_partidos_empatados,n_partidos_perdidos,n_goles,n_goles_contra,name,short_name, equipos_campeonato_id',
                'joins' => array('equipos_campeonato' => 'ranking.equipos_campeonato_id=equipos_campeonato.id'),
                'where' => array('grupo_id' => $grupo->id),
                'order_by' => 'n_puntos desc, name'));
            array_push($tablas, $grupo);
        }


        $data['nombreFase'] = $fases->nombre;
        $data['ranking'] = $tablas;
        return $this->load->view('view_ranking_fases', $data, true);
    }

    public function viewRankingFasesEquipo($idEquipo)
    {
        $this->load->module('fases');
        $this->load->module('grupos');
        $this->load->module('ranking');
        $fases = $this->fases->get(array('select' => '*', 'where' => array('active' => '1')), TRUE);
        $grupoEquipo = $this->ranking->get(array('select' => 'grupo_id', 'where' => array('equipos_campeonato_id' => $idEquipo)));
        $grupo = $this->grupos->get(array('select' => '*', 'where' => array('id' => $grupoEquipo[0]->grupo_id)));
        $tablas = array();
        $grupo->tabla = $this->get(array(
            'select' => 'ranking.id,n_puntos,n_puntos_contra,n_partidos,n_partidos_ganados,
					n_partidos_empatados,n_partidos_perdidos,n_goles,n_goles_contra,name,short_name, equipos_campeonato_id',
            'joins' => array('equipos_campeonato' => 'ranking.equipos_campeonato_id=equipos_campeonato.id'),
            'where' => array('grupo_id' => $grupo->id),

            'order_by' => 'n_puntos desc, name'));
        array_push($tablas, $grupo);


        $data['nombreFase'] = $fases->nombre;
        $data['ranking'] = $tablas;
        return $this->load->view('view_ranking_fases', $data, true);
    }

    public function menuranking()
    {
        $this->load->module('fases');
        $this->load->module('grupos');
        $fases = $this->fases->get(array('select' => '*', 'where' => array('active' => '1')), TRUE);


        $grupos = $this->grupos->get(array('select' => 'id,nombre', 'where' => array('fases_id' => $fases->id)));


        $tablas = array();
        foreach ($grupos as $grupo) {
            $grupo->tabla = $this->get(array(
                'select' => 'ranking.id,n_puntos,n_puntos_contra,n_partidos,n_partidos_ganados,
					n_partidos_empatados,n_partidos_perdidos,n_goles,n_goles_contra,name,short_name, equipos_campeonato_id',
                'joins' => array('equipos_campeonato' => 'ranking.equipos_campeonato_id=equipos_campeonato.id'),
                'where' => array('grupo_id' => $grupo->id),
                'order_by' => 'n_puntos desc, name'));
            array_push($tablas, $grupo);
        }
        $data['nombreFase'] = $fases->nombre;
        $data['ranking'] = $tablas;
        return $this->load->view('menuranking', $data, true);
    }

    public function viewRankingGrupos()
    {
        $this->load->module('fases');
        $this->load->module('grupos');
        $fases = $this->fases->get(array('select' => '*', 'where' => array('active' => '1')), TRUE);
        $grupos = $this->grupos->get(array('select' => 'id,nombre', 'where' => array('fases_id' => $fases->id)));
        $tablas = array();
        foreach ($grupos as $grupo) {
            $grupo->tabla = $this->get(array(
                'select' => 'ranking.id,n_puntos,n_puntos_contra,n_partidos,n_partidos_ganados,
					n_partidos_empatados,n_partidos_perdidos,n_goles,n_goles_contra,name,short_name, equipos_campeonato_id',
                'joins' => array('equipos_campeonato' => 'ranking.equipos_campeonato_id=equipos_campeonato.id'),
                'where' => array('grupo_id' => $grupo->id),'order_by'=>"n_puntos desc"));
            array_push($tablas, $grupo);
        }
        $data['nombreFase'] = $fases->nombre;
        $data['ranking'] = $tablas;
        return $this->load->view('view_ranking_grupos', $data, true);
    }

    public function viewRankingLlaves()
    {
        $this->load->module('fases');
        $this->load->module('grupos');
        $this->load->module('partidos');
        $fases = $this->fases->get(array('select' => '*', 'where' => array('active' => '1')), TRUE);
        $grupos = $this->grupos->get(array('select' => 'id,nombre', 'where' => array('fases_id' => $fases->id)));
        $tablas = array();
        foreach ($grupos as $grupo) {
            $grupo->tabla = $this->get(array(
                'select' => 'ranking.id,n_puntos,n_puntos_contra,n_partidos,n_partidos_ganados,
					n_partidos_empatados,n_partidos_perdidos,n_goles,n_goles_contra,name,short_name, equipos_campeonato_id',
                'joins' => array('equipos_campeonato' => 'ranking.equipos_campeonato_id=equipos_campeonato.id'),
                'where' => array('grupo_id' => $grupo->id),'order_by'=>"ranking.afp_id"));
            array_push($tablas, $grupo);
        }
         $data['ranking'] = $tablas;

        $partidos = $this->mdl_partidos->getAllByTodaySegundaFase();

        $data['partidos'] = $partidos;

        return $this->load->view('view_ranking_llaves', $data, true);
    }


    function sync()
    {
        $xmlRankingDir = scandir(AFP_HARD_ROOT_FILE . "WP2010");
        $numXml = count($xmlRankingDir);
        for ($i = 0; $i < $numXml; $i++) {
            $mystring = $xmlRankingDir[$i];
            $findme = 'FootballRanking';
            $pos = strpos($mystring, $findme);
            // Nótese el uso de ===. Puesto que == simple no funcionará como se espera
            // porque la posición de 'a' está en el 1° (primer) caracter.
            if ($pos === false) {
                //echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
            } else {
                $xmlRanking[$i] = $xmlRankingDir[$i];
                $this->data_model('WP2010/' . $xmlRanking[$i]);
                // echo "La cadena '$findme' fue encontrada en la cadena '$mystring'";
                //echo " y existe en la posición $pos";
            }
        }
    }

    private function data_model($xml)
    {
        $this->load->module('equipos_campeonato');
        $this->load->module('fases');
        // Cargo los modulso que necesito
        $pathXml = implode("/", explode("/", $xml, -1)); //Extraigo el path para cuando envien el archivo sin path
        $xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
        $data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml

        //Extraigo el info de fases y grupos del xml de ranking
        $id_fase = $data->Ranking->Header->n_Phase1ID;
        $nombre_grupo = ( string )$data->Ranking->Header->c_Phase2;
        $id_grupo = ( string )$data->Ranking->Header->n_Phase2ID;
        //Extraigo los datos de cada equipo por grupo , goles, partidos, etc por fase
        foreach ($data->Ranking->Rank as $node) {

            $ranking = array(
                'fases_id' => $this->fases->get(array('select' => 'id, nombre', 'where' => array('afp_id' => (string)$id_fase)), TRUE)->id,
                'nombre_grupo' => $nombre_grupo,
                'equipos_campeonato_id' => $this->equipos_campeonato->get(array('select' => 'id, name', 'where' => array('afp_id' => (string)$node->n_TeamID)), TRUE)->id,
                'n_puntos' => $node->n_Points,
                'n_puntos_contra' => $node->n_PointsAgainst,
                'n_partidos' => $node->n_Matches,
                'n_partidos_ganados' => $node->n_MatchesWon,
                'n_partidos_empatados' => $node->n_MatchesDrawn,
                'n_partidos_perdidos' => $node->n_MatchesLost,
                'n_goles' => $node->n_GoalsFor,
                'n_goles_contra' => $node->n_GoalsAgainst,
                'n_puntos_local' => $node->n_HomePoints,
                'n_puntos_local_contra' => $node->n_HomePointsAgainst,
                'n_partidos_local' => $node->n_HomeMatches,
                'n_partidos_local_ganados' => $node->n_HomeMatchesWon,
                'n_partidos_local_empatados' => $node->n_HomeMatchesDrawn,
                'n_partidos_local_perdidos' => $node->n_HomeMatchesLost,
                'n_goles_local' => $node->n_HomeGoalsFor,
                'n_goles_local_contra' => $node->n_HomeGoalsAgainst,
                'n_puntos_visitante_contra' => $node->n_AwayPoints,
                'n_puntos_visitante' => $node->n_AwayPointsAgainst,
                'n_partidos_visitante' => $node->n_AwayMatches,
                'n_partidos_visitante_ganados' => $node->n_AwayMatchesWon,
                'n_partidos_visitante_empatados' => $node->n_AwayMatchesDrawn,
                'n_partidos_visitante_perdidos' => $node->n_AwayMatchesLost,
                'n_goles_visitante' => $node->n_AwayGoalsFor,
                'n_goles_visitante_contra' => $node->n_AwayGoalsAgainst,
                'n_tarjetas_amarillas' => $node->n_CardsYellow,
                'n_tarjetas_rojas' => $node->n_OppCardsYellow,
                'afp_id' => $node->c_Rank,
                'grupo_id' => $this->grupos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$id_grupo)), TRUE)->id
            );
            //Verifica si existe en la base o no
            if (!$this->mdl_ranking->get_by(array('fases_id' => $ranking['fases_id'], 'nombre_grupo' => $ranking['nombre_grupo'], 'equipos_campeonato_id' => $ranking['equipos_campeonato_id']))) {
                $ranking['id'] = $this->mdl_ranking->save($ranking, NULL, FALSE);
            } else {
                $ranking['id'] = $this->mdl_ranking->get_by(array('fases_id' => $ranking['fases_id'], 'nombre_grupo' => $ranking['nombre_grupo'], 'equipos_campeonato_id' => $ranking['equipos_campeonato_id']), TRUE)->id;
            }

        }

    }


}
