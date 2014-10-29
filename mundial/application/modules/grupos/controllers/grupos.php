<?php
class Grupos extends MY_Controller{	
	
	public $model = 'mdl_grupos';

	public function __construct(){
		parent::__construct();				
	}
	function getTableByFase(){
		$tableByFase = $this->mdl_grupos->getTableByFase();
		
		return $this->load->view ("tableByFase", array ("grupos" =>$tableByFase), TRUE );
	}
	function getTableGroupOpen(){
		$tableByFase = $this->mdl_grupos->getTableByFase();		
		return $this->load->view ("tableGroupOpen", array ("grupos" =>$tableByFase), TRUE );
	}
	
	
	function sync(){
		echo "<pre>";
		$this->importData('WP2010/FootballCompetitions_ID56849371_en.xml');
		echo "</pre>";
	}
	
	function importData( $xml ){
		$this->load->module('fases');	
		$xml = AFP_XML . $xml; // formo los nombres de los archivos en base a los afp_id de los equipos
		$data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml		
		$fases = $this->fases->get( array( 'select' => 'afp_id, id' ) ); // cosulto las fases
		foreach ( $fases as $fase ){ // Itero en las fases
			foreach ( $data as $node  ){ // Itero en los grupos
				$grupoAfpId = (string) $node->n_PhaseID;
				$grupoName = (string)$node->c_Phase;
				if( $fase->afp_id == (string) $node->n_ParentPhaseID ){
					if( !$this->_check_exist( array('afp_id' => $grupoAfpId ) ) ) {
						$grupo = array( 'nombre' => $grupoName, 'afp_id' => $grupoAfpId, 'fases_id' => $fase->id);
						$this->_insert( $grupo );
					}
				}
			}
		}		
	}
}