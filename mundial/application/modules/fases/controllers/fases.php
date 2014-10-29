<?php
class Fases extends MY_Controller{	
	
	public $model = 'mdl_fases';

	public function __construct(){
		parent::__construct();				
	}
	
	function getFasebyGrupo( $id, $single = TRUE ){
		$query = array(
				'select' => 'fases.*',
				'where' => array( 'grupos.id' => $id ),
				'joins'	=> array( 'grupos' => array( 'grupos.fases_id = fases.id' ) )
				);
		return $this->get( $query, $single );		
	}
	
	
	function sync(){
		echo "<pre>";
		$this->importData('WP2010/FootballCompetitions_ID56849371_en.xml');
		echo "</pre>";
	}
	
	function importData( $xml ){		
		$xml = AFP_XML . $xml; // formo los nombres de los archivos en base a los afp_id de los equipos
		$data = ($this->xmlimporter->load($xml)) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
		
		
		foreach ( $data as $node ){ //Itero en las Fases y guardo
			$isFase = (string)$node->attributes()->IsMatrix;
			$faseAfpId = (string) $node->n_PhaseID;
			$fasesName = (string)$node->c_Phase;
			if( $isFase === 'false' ){
				$fase = array( 'afp_id' => $faseAfpId, 'nombre' => $fasesName );
				if( !$this->_check_exist( array('afp_id' => $faseAfpId ) ) ) {
					$this->_insert( $fase );
				}
			}
		}
	}
}