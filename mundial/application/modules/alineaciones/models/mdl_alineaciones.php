<?php
class Mdl_alineaciones extends MY_Model{
	
	public $table_name = "alineaciones";	
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
	public $page_config = array();
	//
	public function __construct(){
		parent::__construct();		
	}
	
	function getAlineacionByPartidoAndEquipo( $partido, $equipo ){		
		$query = array(
				'select' => '*',
				'where' => array( 'partidos_id' => $partido, 'equipos_id' => $equipo, 'posicion > ' => 0  ),
				'where_in' => array( 'posicion' => array( 0, 1, 2, 3, 4, 5) ),
				'order_by' => 'posicion asc' );
		$alineacion = $this->get( $query );	
		$datos = array();
		foreach( $alineacion as $row ){
			$datos[$row->jugadores_id] = new stdClass();
			$datos[$row->jugadores_id]->id = $row->id;
			$datos[$row->jugadores_id]->corto = $row->corto;
			$datos[$row->jugadores_id]->posicion = $row->posicion;
			$datos[$row->jugadores_id]->numero = $row->numero;
			$datos[$row->jugadores_id]->partido_id = $row->partidos_id;
			$datos[$row->jugadores_id]->jugador_id = $row->jugadores_id;
			$datos[$row->jugadores_id]->equipo_id = $row->equipos_id;
			$datos[$row->jugadores_id]->eventos = array();
		}
		return $datos;		
	}
}