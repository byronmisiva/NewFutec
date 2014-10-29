<?php
class Mdl_goles extends MY_Model{
	
	public $table_name = "goles";	
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

	public function __construct(){
		parent::__construct();		
	}
	
	function getGolesByPartidoAndEquipo( $partido, $equipo ){		
		$query = array(
				'select' => '*',
				'where' => array( 'partidos_id' => $partido, 'equipos_id' => $equipo ),
				'order_by' => 'tipo asc, minuto asc'
				);	
		return $this->get( $query );	
	}
}