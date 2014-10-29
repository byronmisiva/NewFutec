<?php

class Mdl_partidos extends MY_Model
{

    public $table_name = "partidos";
    public $primary_key = "id";
    public $joins;
    public $select_fields;
    public $total_rows;
    public $page_links;
    public $current_page;
    public $num_pages;
    public $optional_params;
    public $order_by;
    public $form_values = array();

    public $estados_afp = array();
    public $estados_desc = array();
    public $local = array();
    public $posiciones = array();

    public function __construct()
    {
        parent::__construct();
        $this->local = array(1 => 'local', 2 => 'visitante');
        $this->estados_afp = array(
            'EMNCOXXXXX' => 0,
            'EMENCPMTP1' => 1,
            'EMPAUPMTP1' => 2,
            'EMENCPMTP2' => 3,
            'EMFINPMTP2' => 4,
            'EMPAUPMTP2' => 5,
            'EMENCPMPR1' => 6,
            'EMPAUPMPR1' => 7,
            'EMFNCPMPR2' => 8,
            'EMFINPMPGO' => 9,
            'EMFINPMPSI' => 10,
            'EMFINPMPR2' => 11,
            'EMPAUPMPR2' => 12,
            'EMENCPMTAB' => 13,
            'EMFINPMTAB' => 14
        );
        $this->estados_desc = array(
            0 => 'No iniciado',
            1 => 'Primer tiempo',
            2 => 'Medio tiempo',
            3 => 'Segundo tiempo',
            4 => 'Tiempo cumplido',
            5 => 'Receso tiempos extras',
            6 => 'Primer tiempo extra',
            7 => 'Receso',
            8 => 'Segundo tiempo extra',
            9 => 'Terminado gol de oro',
            10 => 'Terminado gol de plata',
            11 => 'Terminado en extras',
            12 => 'Espera antes de los penales',
            13 => 'Penales en progreso',
            14 => 'Terminado en penales'
        );
        $this->posiciones = array(
            'PSENT' => 0, //Entrenador
            'PSGOL' => 1, //Arquero
            'PSDEF' => 2, //Defensa
            'PSMIL' => 3, //Volante
            'PSAVA' => 4, //Delantero
            'PSRPJ' => 5, //Suplente que jugo
            'PSRPL' => 6 //Suplente sin jugar
        );
    }

    // Devuelve los partidos que se jugaran en el dia actual o el proximo dia
    //todo ver caso cuando mundial acabe
    function getAllByFecha()
    {
        $this->load->module('equipos');
        $this->load->module('estadios');
        $partidos = $this->get(array(
            'select' => "(select url from videos where partidos.id = videos.idpartido) as url,partidos.fecha AS fechaComplete, partidos.id, DATE_FORMAT(partidos.fecha, '%Y-%c-%e') AS fecha, DATE_FORMAT(partidos.fecha, '%k:%i') AS hora, partidos.estado, nombre_estadio AS estadio_nombre, partidos.resultado, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos. LOCAL ) AS local_corto, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos.visitante ) AS visitante_corto, partidos.nombre_local,
            partidos.nombre_visitante, partidos.local, partidos.visitante,
             CONCAT(ELT(WEEKDAY(partidos.fecha) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo') , ', ',DAY(partidos.fecha), ' de ', ELT(MONTH(partidos.fecha) ,    'enero', 'febrero','marzo', 'abril', 'mayo', 'junio',  'julio',  'agosto',  'septiembre',  'octubre', 'noviembre',  'diciembre'  )) AS fechatexto ",
            'order_by' => 'partidos.fecha ASC',
            'where' => "(SELECT  DATE_FORMAT(b.fecha, '%Y-%c-%e') from partidos b   WHERE DATE_FORMAT(b.fecha, '%Y-%c-%e')  > SUBDATE( NOW(), 1) GROUP BY DATE_FORMAT(b.fecha, '%Y-%c-%e') ORDER BY fecha LIMIT 1) =  DATE_FORMAT(partidos.fecha, '%Y-%c-%e')"
            ));

        $datos = array();
        foreach ($partidos as $partido) {
            if (isset($partido->resultado)) {
                $goles = explode('-', $partido->resultado);
                $partido->golesLocal = $goles[0];
                $partido->golesVisitante = $goles[1];
            } else {
                $partido->golesLocal = 0;
                $partido->golesVisitante = 0;
            }
            array_push($datos, $partido);
        }
        return $datos;
    }

    // Devuelve los partidos ordenamos por fecha
    function getAllByEquipo($idEquipo)
    {
        $this->load->module('equipos');
        $this->load->module('estadios');

        //query recupera el listado de todos los partidos ordenados por fecha
        $partidos = $this->get(array('select' => "partidos.id, DATE_FORMAT(partidos.fecha, '%Y-%c-%e') AS fecha, DATE_FORMAT(partidos.fecha, '%k:%i') AS hora, partidos.estado, nombre_estadio AS estadio_nombre, partidos.resultado, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos. LOCAL ) AS local_corto, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos.visitante ) AS visitante_corto, partidos.nombre_local, partidos.nombre_visitante",
            'where' => array("local = ". $idEquipo." or visitante ="=>$idEquipo),
            'order_by' => 'partidos.fecha ASC'
        ));


        $datos = array();
        foreach ($partidos as $partido) {
            if (isset($partido->resultado)) {
                $goles = explode('-', $partido->resultado);
                $partido->golesLocal = $goles[0];
                $partido->golesVisitante = $goles[1];
            } else {
                $partido->golesLocal = 0;
                $partido->golesVisitante = 0;
            }
            array_push($datos, $partido);
        }

        return $datos;
    }

    // Devuelve los partidos ordenamos por fecha
    function getAllByToday()
    {
        $this->load->module('equipos');
        $this->load->module('estadios');

        //query recupera el listado de todos los partidos ordenados por fecha
        $partidos = $this->get(array('select' => "(select url from videos where partidos.id = videos.idpartido) as url,partidos.local, partidos.visitante, partidos.id, DATE_FORMAT(partidos.fecha, '%Y-%c-%e') AS fecha, DATE_FORMAT(partidos.fecha, '%k:%i') AS hora, partidos.estado, nombre_estadio AS estadio_nombre, partidos.resultado, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos. LOCAL ) AS local_corto, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos.visitante ) AS visitante_corto, partidos.nombre_local, partidos.nombre_visitante",
            'order_by' => 'partidos.fecha ASC'
            ));

        $datos = array();
        foreach ($partidos as $partido) {
            if (isset($partido->resultado)) {
                $goles = explode('-', $partido->resultado);
                $partido->golesLocal = $goles[0];
                $partido->golesVisitante = $goles[1];
            } else {
                $partido->golesLocal = 0;
                $partido->golesVisitante = 0;
            }
            array_push($datos, $partido);
        }
        return $datos;
    }
   function getAllByTodaySegundaFase()
    {
        $this->load->module('equipos');
        $this->load->module('estadios');

        //query recupera el listado de todos los partidos ordenados por fecha
        $partidos = $this->get(array('select' => "(select url from videos where partidos.id = videos.idpartido) as url,partidos.local, partidos.visitante, partidos.id, DATE_FORMAT(partidos.fecha, '%Y-%c-%e') AS fecha, DATE_FORMAT(partidos.fecha, '%k:%i') AS hora, partidos.estado, nombre_estadio AS estadio_nombre, partidos.resultado, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos. LOCAL ) AS local_corto, ( SELECT equipos_campeonato.short_name FROM equipos_campeonato WHERE equipos_campeonato.id = partidos.visitante ) AS visitante_corto, partidos.nombre_local, partidos.nombre_visitante",
            'order_by' => 'partidos.fecha ASC', 'where'=> array('grupos_id >' => 8)
            ));

        $datos = array();
        foreach ($partidos as $partido) {
            if (isset($partido->resultado)) {
                $goles = explode('-', $partido->resultado);
                $partido->golesLocal = $goles[0];
                $partido->golesVisitante = $goles[1];
            } else {
                $partido->golesLocal = 0;
                $partido->golesVisitante = 0;
            }
            array_push($datos, $partido);
        }
        return $datos;
    }



function getProximoPartido()
    {
        date_default_timezone_set('America/Bogota');
        
        //query recupera el listado de todos los partidos ordenados por fecha
       // $partidos = $this->get(array('select' => "*",'where' => "DATE_FORMAT(partidos.fecha, '%Y-%c-%e %k:%i')  >=  NOW() LIMIT 1"));

        $partidos = $this->get(array('select' => "*",'where' => "UNIX_TIMESTAMP(fecha)  > UNIX_TIMESTAMP(now()) ORDER BY fecha LIMIT 1"));


         //echo $this->db->last_query();
        $datos['idPartido']=$partidos[0]->id;
        $datos['fecha'] =$partidos[0]->fecha;
        $datos['estado'] =$partidos[0]->estado;
        $datos['resultado'] = $partidos[0]->resultado;
        $datos['resumen'] = $partidos[0]->resumen;
        $datos['afp_id'] = $partidos[0]->afp_id;
        $datos['afp_id_estadio'] = $partidos[0]->afp_id_estadio;
        $datos['nombre_estadio'] = $partidos[0]->nombre_estadio;
        $datos['grupos_id'] = $partidos[0]->grupos_id;
        $datos['arbitro'] = $partidos[0]->arbitro;
        $datos['local'] = $partidos[0]->local;
        $datos['visitante'] = $partidos[0]->visitante;
        $datos['nombre_local'] = $partidos[0]->nombre_local;
        $datos['nombre_visitante'] = $partidos[0]->nombre_visitante;
        $datos['tactica_local'] =$partidos[0]->tactica_local;
        $datos['tactica_visitante'] = $partidos[0]->tactica_visitante;
        $datos['short_name_local'] =$partidos[0]->short_name_local;
        $datos['short_name_visitante'] = $partidos[0]->short_name_visitante;
        return $datos;
    }



    // partido mas cercano que no este en estado 'No Iniciado'
    function getLastGames($limit)
    {
        $this->load->module('equipos');
        $query = array(
            'select' => '*, UNIX_TIMESTAMP(fecha) as fechas',
            'where' => array('estado != ' => 0),
            'order_by' => 'fecha desc',
            'limit' => $limit
        );
        $datos = array();
        $partidos = $this->get($query);
        foreach ($partidos as $partido) {
            $equipoLocal = $this->equipos->get(array('select' => 'id, nombre, bandera', 'where' => array('id' => $partido->local)), TRUE);
            $equipoVisitante = $this->equipos->get(array('select' => 'id, nombre, bandera', 'where' => array('id' => $partido->visitante)), TRUE);
            if ($equipoLocal && $equipoVisitante) {
                $partido->estadoDescripcion = $this->estados_desc[$partido->estado];
                $partido->local = $this->equipos->get(array('select' => 'id, nombre, bandera, continente, corto, bandera, uniforme, alterno', 'where' => array('id' => $partido->local)), TRUE);
                $partido->visitante = $this->equipos->get(array('select' => 'id, nombre, bandera, continente, corto, bandera, uniforme, alterno', 'where' => array('id' => $partido->visitante)), TRUE);
                $goles = explode('-', $partido->resultado);
                $partido->glocal = $goles[0];
                $partido->gvisitante = $goles[1];
                array_push($datos, $partido);
            }
        }
        return $datos;
    }

}