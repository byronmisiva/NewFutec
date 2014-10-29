<?php

class Partidos extends MY_Controller
{

    public $model = 'mdl_partidos';

    public function __construct()
    {
        parent::__construct();
    }

    // Lista todos los Partidos por fecha
    function partidosFecha(){
        //$this->output->cache( 5 );
        $data['fechas'] = $this->mdl_partidos->getAllByFecha();
        return $this->load->view('partidosFecha', $data, TRUE);
    }
    function partidosFechaMovil(){
        //$this->output->cache( 5 );
        $data['fechas'] = $this->mdl_partidos->getAllByFecha();
        return $this->load->view('partidosFechaMovil', $data, TRUE);
    }
    function partidosFinal(){
        //$this->output->cache( 5 );
        $data['fechas'] = $this->mdl_partidos->getAllByFecha();
        return $this->load->view('partidosFinal', $data, TRUE);
    }

      function viewProximoPartido($isAjax = false)
    {
        $data['ajax'] = $isAjax;
        //$data['partidos'] = $this->mdl_partidos->getProximoPartido();

        if( $isAjax ){
            //$data['name'] = print_r($_POST['data']['name']);
             $this->load->view('proximoPartido', $data, FALSE);
        }
        else{
            return $this->load->view( 'proximoPartido', $data, TRUE );
            return '';
        }


    }


    function getPartidosFechaTab($data = FALSE)
    {

        return $this->load->view('partidosFechaTab', $data, TRUE);
    }

    public function getGruposCalendarioTab($data = FALSE)
    {
        $this->load->module('grupos');
        $data['tabComponent2'] = $this->grupos->getTableByFase();
        return $this->load->view('gruposCalendarioTab', $data, TRUE);
    }




    function getMinutoAminutoMod($id = FALSE)
    {
        $this->load->module('partidos');
        $this->load->module('alineaciones');
        $this->load->module('goles');
        $this->load->module('cambios');
        $this->load->module('tarjetas');
        $this->load->module('equipos_campeonato');
        $partidos = $this->mdl_partidos->getAllByToday();
        $partidos = ($partidos) ? $partidos : $this->mdl_partidos->getLastGames(5);
        $data = array();
        foreach ($partidos as $partido) {
            $alineacion_local = $this->alineaciones->getAlineacionByPartidoAndEquipo($partido->id, $partido->local->id);
            $alineacion_visitante = $this->alineaciones->getAlineacionByPartidoAndEquipo($partido->id, $partido->visitante->id);
            $eventos = array();
            $cambios_local = $this->cambios->getCambiosByPartidoAndEquipo($partido->id, $partido->local->id);
            foreach ($cambios_local as $row) { // Agrego los eventos (Cambios) a la alineacion al equipo Local
                $ayuda = 1000 - $row->minuto;
                $alineacion_local[$row->entra_id]->eventos[$ayuda . 'a'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_sale, 'tipo' => 1);
                $alineacion_local[$row->sale_id]->eventos[$ayuda . 'a'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_entra, 'tipo' => 2);
            }
            $eventos = array_merge($eventos, $cambios_local);
            $cambios_visitante = $this->cambios->getCambiosByPartidoAndEquipo($partido->id, $partido->visitante->id);
            foreach ($cambios_visitante as $row) { // Agrego los eventos (Cambios) a la alineacion al equipo Visitante
                $alineacion_visitante[$row->entra_id]->eventos[$row->minuto . 'c'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_sale, 'tipo' => 1);
                $alineacion_visitante[$row->sale_id]->eventos[$row->minuto . 'c'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_entra, 'tipo' => 2);
            }
            $eventos = array_merge($eventos, $cambios_visitante);
            $goles_local = $this->goles->getGolesByPartidoAndEquipo($partido->id, $partido->local->id);
            foreach ($goles_local as $row) {
                if ($row->tipo == 0) {
                    $ayuda = 1000 - $row->minuto;
                    $alineacion_local[$row->jugadores_id]->eventos[$ayuda . 'c'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
                if ($row->tipo == 2) {
                    $alineacion_visitante[$row->jugadores_id]->eventos[$row->minuto . 'a'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
            }
            $eventos = array_merge($eventos, $goles_local);
            $goles_visitante = $this->goles->getGolesByPartidoAndEquipo($partido->id, $partido->visitante->id);
            foreach ($goles_visitante as $row) {
                if ($row->tipo == 0) {
                    $alineacion_visitante[$row->jugadores_id]->eventos[$row->minuto . 'a'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
                if ($row->tipo == 2) {
                    $ayuda = 1000 - $row->minuto;
                    $alineacion_local[$row->jugador_id]->eventos[$ayuda . 'c'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
            }
            $eventos = array_merge($eventos, $goles_visitante);
            $tarjetas_local = $this->tarjetas->getTarjetasByPartidoAndEquipo($partido->id, $partido->local->id);
            foreach ($tarjetas_local as $row) {
                $ayuda = 1000 - $row->minuto;
                $alineacion_local[$row->jugadores_id]->eventos[$ayuda . 'b'] = array('accion' => 3, 'minuto' => $row->minuto, 'tipo' => $row->tipo);
            }
            $eventos = array_merge($eventos, $tarjetas_local);
            $tarjetas_visitante = $this->tarjetas->getTarjetasByPartidoAndEquipo($partido->id, $partido->visitante->id);
            foreach ($tarjetas_visitante as $row) {
                $alineacion_visitante[$row->jugadores_id]->eventos[$row->minuto . 'b'] = array('accion' => 3, 'minuto' => $row->minuto, 'tipo' => $row->tipo);
            }
            $eventos = array_merge($eventos, $tarjetas_visitante);
            $minutos = array();
            foreach ($eventos as $evento) {
                array_push($minutos, $evento->minuto);
            }
            array_multisort($minutos, SORT_DESC, $eventos);
            $gameDetails = array('alineacion_local' => $alineacion_local, 'alineacion_visitante' => $alineacion_visitante, 'partidoResumen' => $partido, 'eventos' => $eventos);
            array_push($data, $gameDetails);
        }
        return $this->load->view('minutoAminutoMod', array('partidos' => $data, 'partidoOpen' => ($id) ? $id : FALSE), TRUE);
    }

    // Minuto a minuto: alinecion, goles, etc, etc de los partidos.
    function partidosEquipo($idEquipo)
    {
        $this->load->module('partidos');
        $this->load->module('equipos');

        $partidos = $this->mdl_partidos->getAllByEquipo($idEquipo);

        return $this->load->view('partidosequipo', array('partidos' => $partidos), TRUE);
    }

    // Minuto a minuto: alinecion, goles, etc, etc de los partidos.
    function minutoAMinuto($id = FALSE)
    {
        $this->load->module('partidos');
        $this->load->module('alineaciones');
        $this->load->module('goles');
        $this->load->module('cambios');
        $this->load->module('tarjetas');
        $this->load->module('equipos');
        $this->load->module('cambios');
        $partidos = $this->mdl_partidos->getAllByToday();
//        $partidos = ($partidos) ? $partidos : $this->mdl_partidos->getLastGames(5);
        $data = array();
        /*
        foreach ($partidos as $partido) {
            $alineacion_local = $this->alineaciones->getAlineacionByPartidoAndEquipo($partido->id, $partido->local->id);
            $alineacion_visitante = $this->alineaciones->getAlineacionByPartidoAndEquipo($partido->id, $partido->visitante->id);
            $eventos = array();
            $cambios_local = $this->cambios->getCambiosByPartidoAndEquipo($partido->id, $partido->local->id);
            foreach ($cambios_local as $row) { // Agrego los eventos (Cambios) a la alineacion al equipo Local
                $ayuda = 1000 - $row->minuto;
                $alineacion_local[$row->entra_id]->eventos[$ayuda . 'a'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_sale, 'tipo' => 1);
                $alineacion_local[$row->sale_id]->eventos[$ayuda . 'a'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_entra, 'tipo' => 2);
            }
            $eventos = array_merge($eventos, $cambios_local);
            $cambios_visitante = $this->cambios->getCambiosByPartidoAndEquipo($partido->id, $partido->visitante->id);
            foreach ($cambios_visitante as $row) { // Agrego los eventos (Cambios) a la alineacion al equipo Visitante
                $alineacion_visitante[$row->entra_id]->eventos[$row->minuto . 'c'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_sale, 'tipo' => 1);
                $alineacion_visitante[$row->sale_id]->eventos[$row->minuto . 'c'] = array('accion' => 1, 'minuto' => $row->minuto, 'corto' => $row->corto_entra, 'tipo' => 2);
            }
            $eventos = array_merge($eventos, $cambios_visitante);
            $goles_local = $this->goles->getGolesByPartidoAndEquipo($partido->id, $partido->local->id);
            foreach ($goles_local as $row) {
                if ($row->tipo == 0) {
                    $ayuda = 1000 - $row->minuto;
                    $alineacion_local[$row->jugadores_id]->eventos[$ayuda . 'c'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
                if ($row->tipo == 2) {
                    $alineacion_visitante[$row->jugadores_id]->eventos[$row->minuto . 'a'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
            }
            $eventos = array_merge($eventos, $goles_local);
            $goles_visitante = $this->goles->getGolesByPartidoAndEquipo($partido->id, $partido->visitante->id);
            foreach ($goles_visitante as $row) {
                if ($row->tipo == 0) {
                    $alineacion_visitante[$row->jugadores_id]->eventos[$row->minuto . 'a'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
                if ($row->tipo == 2) {
                    $ayuda = 1000 - $row->minuto;
                    $alineacion_local[$row->jugador_id]->eventos[$ayuda . 'c'] = array('accion' => 2, 'minuto' => $row->minuto, 'tipo' => $row->tipo, 'fallado' => $row->fallado);
                }
            }
            $eventos = array_merge($eventos, $goles_visitante);
            $tarjetas_local = $this->tarjetas->getTarjetasByPartidoAndEquipo($partido->id, $partido->local->id);
            foreach ($tarjetas_local as $row) {
                $ayuda = 1000 - $row->minuto;
                $alineacion_local[$row->jugadores_id]->eventos[$ayuda . 'b'] = array('accion' => 3, 'minuto' => $row->minuto, 'tipo' => $row->tipo);
            }
            $eventos = array_merge($eventos, $tarjetas_local);
            $tarjetas_visitante = $this->tarjetas->getTarjetasByPartidoAndEquipo($partido->id, $partido->visitante->id);
            foreach ($tarjetas_visitante as $row) {
                $alineacion_visitante[$row->jugadores_id]->eventos[$row->minuto . 'b'] = array('accion' => 3, 'minuto' => $row->minuto, 'tipo' => $row->tipo);
            }
            $eventos = array_merge($eventos, $tarjetas_visitante);
            $minutos = array();
            foreach ($eventos as $evento) {
                array_push($minutos, $evento->minuto);
            }
            array_multisort($minutos, SORT_DESC, $eventos);
            $gameDetails = array('alineacion_local' => $alineacion_local, 'alineacion_visitante' => $alineacion_visitante, 'partidoResumen' => $partido, 'eventos' => $eventos);
            array_push($data, $gameDetails);
        }
        */
        //return $this->load->view('minutoAminuto', array('partidos' => $data, 'partidoOpen' => ($id) ? $id : FALSE), TRUE);
        return $this->load->view('minutoAminuto', array('partidos' => $partidos, 'partidoOpen' => ($id) ? $id : FALSE), TRUE);
    }
   function segundafase($id = FALSE)
    {
        $this->load->module('partidos');
        $this->load->module('alineaciones');
        $this->load->module('goles');
        $this->load->module('cambios');
        $this->load->module('tarjetas');
        $this->load->module('equipos');
        $this->load->module('cambios');
        $partidos = $this->mdl_partidos->getAllByTodaySegundaFase();

        return $this->load->view('segundafase', array('partidos' => $partidos, 'partidoOpen' => ($id) ? $id : FALSE), TRUE);
    }

   /* function sync()
    {
        echo "<pre>";
        $this->data_model('espanol/periodico/res/');
        echo "</pre>";
    }

    private function data_model($path)
    {
        $this->load->module('equipos');
        $this->load->module('fases');
        $this->load->module('grupos');
        $this->load->module('estadios');
        $this->load->module('galerias');
        $this->load->module('jugadores');
        $this->load->module('goles');
        $this->load->module('cambios');
        $this->load->module('tarjetas');
        $this->load->module('alineaciones');
        $partidosQuery["select"] = "afp_id";
        $equipos = $this->equipos->get($partidosQuery); // extraigo todos los afp_id de los equipos
        $chequeados = array();
        foreach ($equipos as $row) {
            $xml = AFP_XML . $path . 's1534-' . sprintf("%007s", $row->afp_id) . '-460-es'; // formo los nombres de los archivos en base a los afp_id de los equipos
            $data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
            if ($data) {
                $data = $data->body->competition->discipline->evt->team->matches; // Extraigo los partidos
                //Itero entre las fases
                foreach ($data->phase as $phase) {
                    $fase = array();
                    $faseAfpId = (string)$phase->attributes()->id;
                    //Chequeo si existe una fase y sino la creo
                    $fase = array(
                        'nombre' => (string)$phase->attributes()->code,
                        'afp_id' => $faseAfpId
                    );
                    if (!$this->fases->_check_exist(array('afp_id' => $faseAfpId))) {
                        $fase['id'] = $this->fases->_insert($fase);
                    } else {
                        $faseQuery['select'] = "*";
                        $faseQuery['where'] = array('afp_id' => $faseAfpId);
                        $fase['id'] = $this->fases->get($faseQuery, TRUE)->id;
                    }
                    // Itero entre los grupos
                    foreach ($phase->group as $group) {
                        //Chequeo si existe un grupo y sino lo creo
                        $grupo = array();
                        $grupoAfp = (string)$group->attributes()->id;
                        $grupo = array(
                            'nombre' => (isset($group->attributes()->label)) ? (string)$group->attributes()->label : $grupoAfp,
                            'afp_id' => $grupoAfp,
                            'fases_id' => $fase['id']
                        );
                        if (!$this->grupos->_check_exist(array('afp_id' => $grupoAfp))) {
                            $grupo['id'] = $this->grupos->_insert($grupo);
                        } else {
                            $grupoQuery['select'] = "*";
                            $grupoQuery['where'] = array('afp_id' => $grupoAfp);
                            $grupo['id'] = $this->grupos->get($grupoQuery, TRUE)->id;
                        }
                        //echo$grupo['id']."<br>";
                        //Itero entre los partidos
                        foreach ($group->match as $match) {
                            $estadioAfpId = (string)$match->datas->stadium->attributes()->id;
                            $nombreEstadio = (string)$match->datas->stadium->attributes()->name;
                            $ciudadEstadio = (string)$match->datas->stadium->city->attributes()->name;
                            if (!$this->estadios->_check_exist("afp_id = '" . $estadioAfpId . "' OR nombre='" . $nombreEstadio . "'")) {
                                //Creo la galeria para el estadio
                                $galeria = array('nombre' => 'Estadio - ' . $nombreEstadio, 'publico' => 0);
                                $galeria['id'] = $this->galerias->_insert($galeria, NULL, FALSE);
                                //Creo el estadio
                                $estadio = array('nombre' => $nombreEstadio, 'galerias_id' => $galeria['id'], 'afp_id' => $estadioAfpId, 'ciudad' => $ciudadEstadio);
                                $idEstadio = $this->estadios->_insert($estadio, NULL, FALSE);
                            } else {
                                $estadioQuery['select'] = "*";
                                $estadioQuery['where'] = "afp_id = '" . $estadioAfpId . "' OR nombre='" . $nombreEstadio . "'";
                                $idEstadio = $this->estadios->get($estadioQuery, TRUE)->id;
                            }
                            $status = (string)$match->attributes()->status . (string)$match->attributes()->period;
                            $mkfecha = $this->_dateFormat((string)$match->attributes()->timestamp);
                            $partido_data = array(
                                'afp_id' => (string)$match->attributes()->id,
                                'estadios_id' => $idEstadio,
                                'grupos_id' => $grupo['id'],
                                'estado' => $this->mdl_partidos->estados_afp[$status],
                                'fecha' => gmdate("Y-m-d H:i:s", $mkfecha)
                            );
                            //if((string)$match->attributes()->res=="")
                            //$partido_data['resultado']="0-0";
                            //else
                            //$partido_data['resultado']=(string)$match->attributes()->res;

                            foreach ($match->res as $team) {
                                $posicion = ( string )$team->attributes()->pos;
                                $estadioQuery['select'] = "id";
                                $estadioQuery['where'] = array('afp_id' => (string)$team->team->attributes()->id);
                                $dataEquipo = $this->equipos->get($estadioQuery, TRUE);
                                if ($dataEquipo) {
                                    $partido_data[$this->mdl_partidos->local[$posicion]] = $dataEquipo->id;
                                }
                            }

                            //Chequeo si existe el partido para ingresarlo o actualizarlo
                            if (!$this->_check_exist(array('afp_id' => $partido_data['afp_id'])) && isset($partido_data['local']) && isset($partido_data['visitante'])) {
                                $partido_data['id'] = $this->_insert($partido_data);
                            } else {
                                $partidosQuery['select'] = 'id';
                                $partidosQuery['where'] = array('afp_id' => $partido_data['afp_id']);
                                $partido = $this->get($partidosQuery, TRUE);
                                if ($partido && isset($partido_data['local']) && isset($partido_data['visitante'])) {
                                    unset($partido_data['local']);
                                    unset($partido_data['visitante']);
                                    $this->_update($partido_data, $partido->id);
                                }
                            }
                            //Chequeo los partidos de ese dia para actualizar los datos o si la variable prueba esta en TRUE
                            $prueba = TRUE;
                            if ((date('j', $mkfecha) == date('j') && date('n', $mkfecha) == date('n')) or $prueba == TRUE) {
                                $xml = AFP_XML . $path . 's1534-' . sprintf("%007s", $partido_data['afp_id']) . '-201-es';
                                if (in_array($xml, $chequeados) == false) {
                                    if ($this->xmlimporter->load($xml)) {
                                        $chequeados[] = $xml;
                                        $data = $this->xmlimporter->parse();
                                        $data = $data->body->competition->discipline->evt->phase->group->match;
                                        $partido_data['resultado'] = ((string)$data->attributes()->res == "") ? "0-0" : (string)$data->attributes()->res;
                                        $status = (string)$data->attributes()->status . (string)$data->attributes()->period;
                                        $partido_data['estado'] = $this->mdl_partidos->estados_afp[$status];
                                        //Saco el arbitro principal del partido
                                        foreach ($data->referees->person as $arbitro) {
                                            if ($arbitro->attributes()->pos == 'PSARB')
                                                $partido_data['arbitro'] = (string)$arbitro->attributes()->long;
                                        }
                                        $grabar = true;
                                        // Saco los eventos del partido
                                        foreach ($data->events->event as $eventos) {
                                            $evento = array();
                                            switch ((string)$eventos->attributes()->code) {
                                                case "VTBUT": //gol
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento = array(
                                                            'partidos_id' => (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id,
                                                            'jugadores_id' => $jugador->id,
                                                            'minuto' => (string)$eventos->attributes()->time,
                                                            'corto' => (string)$eventos->person->attributes()->long,
                                                            'equipos_id' => $equipo->id,
                                                            'tipo' => '0'
                                                        );
                                                        if ($grabar)
                                                            $this->goles->_insert($evento, NULL);
                                                    }
                                                    break;
                                                case "VTCSC": //autogol
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento = array(
                                                            'partidos_id' => (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id,
                                                            'jugadores_id' => $jugador->id,
                                                            'minuto' => (string)$eventos->attributes()->time,
                                                            'corto' => (string)$eventos->person->attributes()->long,
                                                            'equipos_id' => $equipo->id,
                                                            'tipo' => '2'
                                                        );
                                                        if ($grabar)
                                                            $this->goles->_insert($evento, NULL);
                                                    }
                                                    break;
                                                case "VTRPL": //cambio
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        foreach ($eventos->person as $cambio) {
                                                            if ((string)$cambio->attributes()->pos == 'REOUT') {
                                                                $jugadorCambio = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$cambio->attributes()->id)), TRUE);
                                                                if ($jugadorCambio) {
                                                                    $evento['sale_id'] = $jugadorCambio->id;
                                                                    $evento['corto_sale'] = (string)$cambio->attributes()->long;
                                                                }

                                                            } else {
                                                                $jugadorCambio = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$cambio->attributes()->id)), TRUE);
                                                                if ($jugadorCambio) {
                                                                    $evento['entra_id'] = $jugadorCambio->id;
                                                                    $evento['corto_entra'] = (string)$cambio->attributes()->long;
                                                                }
                                                            }
                                                        }
                                                        $evento['partidos_id'] = (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id;
                                                        $evento['minuto'] = (string)$eventos->attributes()->time;
                                                        $evento['equipos_id'] = $equipo->id;
                                                        if ($grabar && isset($evento['sale_id']) && isset($evento['entra_id']))
                                                            $this->cambios->_insert($evento, NULL);
                                                    }
                                                    break;
                                                case "VTJAU": //amarilla
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento['partidos_id'] = (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id;
                                                        $evento['jugadores_id'] = $jugador->id;
                                                        $evento['minuto'] = (string)$eventos->attributes()->time;
                                                        $evento['corto'] = (string)$eventos->person->attributes()->long;
                                                        $evento['equipos_id'] = $equipo->id;
                                                        $evento['tipo'] = '0';
                                                        if ($grabar)
                                                            $this->tarjetas->_insert($evento, NULL);
                                                    }
                                                    break;

                                                case "VTROU": //rojaRSRES
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento['partidos_id'] = (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id;
                                                        $evento['jugadores_id'] = $jugador->id;
                                                        $evento['minuto'] = (string)$eventos->attributes()->time;
                                                        $evento['corto'] = (string)$eventos->person->attributes()->long;
                                                        $evento['equipos_id'] = $equipo->id;
                                                        $evento['tipo'] = '1';
                                                        if ($grabar)
                                                            $this->tarjetas->_insert($evento, NULL);
                                                    }
                                                    break;

                                                case "VT_RJ": //segunda amarilla y roja
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento['partidos_id'] = (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id;
                                                        $evento['jugadores_id'] = $jugador->id;
                                                        $evento['minuto'] = (string)$eventos->attributes()->time;
                                                        $evento['corto'] = (string)$eventos->person->attributes()->long;
                                                        $evento['equipos_id'] = $equipo->id;
                                                        $evento['tipo'] = '2';
                                                        if ($grabar)
                                                            $this->tarjetas->_insert($evento, NULL);
                                                    }
                                                    break;
                                                case "VTPEN": //penal en partido
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento = array(
                                                            'partidos_id' => (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id,
                                                            'jugadores_id' => $jugador->id,
                                                            'minuto' => (string)$eventos->attributes()->time,
                                                            'corto' => (string)$eventos->person->attributes()->long,
                                                            'equipos_id' => $equipo->id,
                                                            'tipo' => '0'
                                                        );
                                                        if ($grabar)
                                                            $this->goles->_insert($evento, NULL);
                                                    }
                                                    break;
                                                case "VTTAB": //penales (acertado)
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento = array(
                                                            'partidos_id' => (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id,
                                                            'jugadores_id' => $jugador->id,
                                                            'minuto' => (string)$eventos->attributes()->time,
                                                            'corto' => (string)$eventos->person->attributes()->long,
                                                            'equipos_id' => $equipo->id,
                                                            'tipo' => '1'
                                                        );
                                                        if ($grabar)
                                                            $this->goles->_insert($evento, NULL);
                                                    }
                                                    break;

                                                case "VTTAX": //penales (fallado)
                                                    $jugador = $this->jugadores->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->person->attributes()->id)), TRUE);
                                                    $equipo = $this->equipos->get(array('select' => 'id', 'where' => array('afp_id' => (string)$eventos->attributes()->teamid)), TRUE);
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $evento = array(
                                                            'partidos_id' => (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id,
                                                            'jugadores_id' => $jugador->id,
                                                            'minuto' => (string)$eventos->attributes()->time,
                                                            'corto' => (string)$eventos->person->attributes()->long,
                                                            'equipos_id' => $equipo->id,
                                                            'tipo' => '1',
                                                            'fallado' => 1
                                                        );
                                                        if ($grabar)
                                                            $this->goles->_insert($evento, NULL);
                                                    }
                                                    break;

                                                default:
                                                    $grabar = false;
                                            }

                                        }
                                        //Saco las alineaciones
                                        foreach ($data->res as $equipoAlineacion) {
                                            $equipo = $this->equipos->get(array('select' => '*', 'where' => array('afp_id' => (string)$equipoAlineacion->team->attributes()->id)), TRUE);
                                            if ($equipo) {
                                                foreach ($equipoAlineacion->team->person as $jugadorAlineacion) {
                                                    $jugador = $this->jugadores->get(array('select' => '*', 'where' => array('afp_id' => (string)$jugadorAlineacion->attributes()->id)), TRUE);
                                                    if (!$jugador) {
                                                        $jugadorData = array(
                                                            'equipos_id' => $equipo->id,
                                                            'nombre' => (string)$jugadorAlineacion->attributes()->first,
                                                            'apellido' => (string)$jugadorAlineacion->attributes()->last,
                                                            'apodo' => (string)$jugadorAlineacion->attributes()->display,
                                                            'posicion' => $this->mdl_partidos->posiciones[(string)$jugadorAlineacion->attributes()->pos],
                                                            'afp_id' => (string)$jugadorAlineacion->attributes()->id
                                                        );
                                                        $alineacion['jugadores_id'] = $this->jugadores->_insert($jugadorData);
                                                    } else {
                                                        $alineacion['jugadores_id'] = $jugador->id;
                                                    }
                                                    if ($jugador && $equipo && (isset($partido->id) || isset($partido_data['id']))) {
                                                        $alineacion['partidos_id'] = (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id;
                                                        $alineacion['equipos_id'] = $equipo->id;
                                                        $alineacion['posicion'] = $this->mdl_partidos->posiciones[(string)$jugadorAlineacion->attributes()->pos];
                                                        $alineacion['corto'] = (string)$jugadorAlineacion->attributes()->long;
                                                        $alineacion['numero'] = ((string)$jugadorAlineacion->attributes()->bib == "") ? 0 : (string)$jugadorAlineacion->attributes()->bib;
                                                        $this->alineaciones->_insert($alineacion);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            if ((isset($partido->id) || isset($partido_data['id']))) {
                                $this->_update($partido_data, (isset($partido_data['id'])) ? $partido_data['id'] : $partido->id);  
                            }
                        }
                    }
                }
            }
        }
    }*/

    // Esta funcion Transforma la fecha de este formato "2010-06-13T13:30:00+02:00" a fecha Unix
    private function _dateFormat($dateString)
    {
        $hora = substr($dateString, 11, 2);
        $minutos = substr($dateString, 14, 2);
        $segundos = substr($dateString, 17, 2);
        $mes = substr($dateString, 5, 2);
        $dia = substr($dateString, 8, 2);
        $anio = substr($dateString, 0, 4);
        $mkfecha = mktime($hora, $minutos, $segundos, $mes, $dia, $anio);
        $zonaHoraria = ((int)substr($dateString, 19, 3) + 5) * 3600;
        $mkfecha = $mkfecha - $zonaHoraria;
        return $mkfecha;
    }
    
	function getPartido($id){    	
    	$this->load->module('alineaciones');
    	$this->load->module('goles');
    	$this->load->module('tarjetas');
    	$this->load->module('comentarios');
    	$this->load->module('cambios');
    	$data['registro']=$this->get(array("select"=>"*","where"=>array("id"=>$id)),TRUE);
    	  	$data['alineacion_local']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local,"posicion !="=>"Reserva","posicion !="=>"Entrenador")));
    	$data['reserva_local']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local,"posicion "=>"Reserva")));
    	$data['entrenador_local']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local,"posicion "=>"Entrenador")));
    	
    	$data['alineacion_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion !="=>"Reserva","posicion !="=>"Entrenador")));
    	$data['reserva_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion "=>"Reserva")));
    	$data['entrenador_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion "=>"Entrenador")));
    	$data['goles_local']=$this->goles->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local)));
    	$data['goles_visitante']=$this->goles->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante)));
    	$data['cambios_local']=$this->cambios->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local)));
    	$data['cambios_visitante']=$this->cambios->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante)));
    	
    	$data['tarjetas_local']=$this->tarjetas->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local)));
    	$data['tarjetas_visitante']=$this->tarjetas->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante)));
    	$data['comentarios']=$this->comentarios->get(array("select"=>"DISTINCT orden, tiempo, comentario","where"=>array("partidos_id"=>$id,),'order_by'=>'orden DESC'));    	
    	return $this->load->view('resultados_partidos',$data, TRUE);    	
    }
    
	function ajxgetPartido($id){
    	$this->load->module('alineaciones');
    	$this->load->module('goles');
    	$this->load->module('tarjetas');
    	$this->load->module('cambios');
    	$data['registro']=$this->get(array("select"=>"*","where"=>array("id"=>$id)),TRUE);
    	  	$data['alineacion_local']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local,"posicion !="=>"Reserva","posicion !="=>"Entrenador")));
    	$data['reserva_local']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local,"posicion "=>"Reserva")));
    	$data['entrenador_local']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local,"posicion "=>"Entrenador")));
    	
    	$data['alineacion_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion !="=>"Reserva","posicion !="=>"Entrenador")));
    	$data['reserva_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion "=>"Reserva")));
    	$data['entrenador_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion "=>"Entrenador")));
    	$data['entrenador_visitante']=$this->alineaciones->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante,"posicion ","Entrenador")));
    	$data['goles_local']=$this->goles->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local)));
    	$data['goles_visitante']=$this->goles->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante)));
    	$data['cambios_local']=$this->cambios->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local)));
    	$data['cambios_visitante']=$this->cambios->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante)));
    	$data['tarjetas_local']=$this->tarjetas->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->local)));
    	$data['tarjetas_visitante']=$this->tarjetas->get(array("select"=>"*","where"=>array("partidos_id"=>$id,"equipos_campeonato_id"=>$data['registro']->visitante)));
    	
    	return $this->load->view('ajxresultados_partidos',$data, TRUE);
    }
    
    
    
    function sync(){
    	echo "<pre>";
    	//$this->importData('WP2014/FootballFixtures_Comp8_ID56661031_es.xml'); //Football Fixtures 2014 hasta que se correspondan los equipos
    	$this->importData('WP2010/FootballMatches_Comp8_ID56666052_es.xml' , 'matches');
    	$this->importData('WP2014/FootballFixtures_Comp8_ID56661031_es.xml', 'fixture'); //Football Fixtures 2014 hasta que se correspondan los equipos
    	echo "</pre>";
    }
    
    function importData( $xml, $type ){
    	$this->load->module( 'equipos_campeonato' );
    	$this->load->module( 'grupos' );
    	$xml = AFP_XML . $xml; // formo los nombres de los archivos en base a los afp_id de los equipos
    	$data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml    	
    	$partidos = ( $type == 'matches' ) ? $data->Matches->Match : $data->Fixtures->Match; //Football Matches 2010
    	
    	foreach ( $partidos as $partido ){
    		$local = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string) $partido->n_HomeTeamID ) ), TRUE );
    		$visitante = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string) $partido->n_AwayTeamID ) ), TRUE );
    		if ( $local && $visitante  ){
    			$partido_insert  = array(
    					'fecha' => str_replace( 'T', ' ', (string)$partido->d_Date ),
    					'afp_id' => (string)$partido->n_MatchID,
    					'local' => $local->id,
    					'visitante' => $visitante->id,
    					'nombre_local' => (string) $partido->c_HomeTeam ,
    					'nombre_visitante' => (string) $partido->c_AwayTeam,
    					'afp_id_estadio' => (isset($partido->n_StadiumGeoID))?(string) $partido->n_StadiumGeoID: '',
    					'nombre_estadio' => (isset($partido->c_Stadium))?(string) $partido->c_Stadium: '',
    					//'grupos_id' => $this->grupos->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string) $partido->n_PhaseID ) ), TRUE )->id,
    			);
    			if( !$this->_check_exist( array( 'afp_id' => $partido_insert['afp_id'] ) , TRUE ) ){
    				$this->_insert($partido_insert);
    			}
    			else {
    				$dataPartido = $this->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string) $partido_insert['afp_id'] ) ), TRUE );
    				if( $dataPartido ){
    					$this->_update($partido_insert, $dataPartido->id );
    				}
    				 
    			}    			
    		}    		
    	}
    }
    
    
  private function filter_item( $item ){
		if( strpos( $item, "FootballLiveMatchResult" ) !== FALSE ){
			return $item;
		}
	}

	function syncResultados(){
		$this->load->module( 'equipos_campeonato' );
		$files = array_filter( scandir( AFP_HARD_ROOT_FILE."WP2010" ), array( $this, 'filter_item' ) );
		foreach ( $files as $file ){
			$pathXml = implode( "/", explode( "/", $file, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
			$xml = AFP_XML ."WP2010/".$file; //Inicializo de que seccion y que xml voy a sacar los datos
			$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
			$detail=$data->Match->Header ;	
			$afpIDPartido=$detail->n_MatchID;
			$afpIDLocal=$detail->n_HomeTeamID;
			$afpIDVisitante=$detail->n_AwayTeamID;
			$n_golesLocal=$detail->n_HomeGoals;
			$n_golesVisitante=$detail->n_AwayGoals;
			$n_golesLocalMedioTiempo=$detail->n_HomeGoalsHalftime;
			$n_golesVisitanteMedioTiempo=$detail->n_AwayGoalsHalftime;
			$tacticaLocal=$detail->c_HomeTactics;
			$tacticaVisitante=$detail->c_HomeTactics;
			$refereeID=$detail->n_RefereeID;
			$refereeNombre=$detail->c_Referee;
			$idPartido=$this->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $afpIDPartido) ), TRUE );
			//echo $tacticaLocal.'<br>';
			$equipoLocalID = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $afpIDLocal) ), TRUE );
			$equipoVisitanteID = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $afpIDVisitante) ), TRUE );

			if( $idPartido->id!='' ){		
				if( $equipoLocalID && $equipoVisitanteID ){
						$resultados['id'] =$this->_update ( array('resultado'=>(string)($n_golesLocal.'-'.$n_golesVisitante), 'arbitro'=>(string)$refereeNombre,'tactica_local'=>(string)$tacticaLocal, 'tactica_visitante'=>(string)$tacticaVisitante), $idPartido->id);
				}
			}
	    
		}
	}
}
