<?php
class Equipos_campeonato extends MY_Controller{	
	
	public $model = 'mdl_equipos_campeonato';

	public function __construct(){
		parent::__construct();				
	}
	
	public function index(){
						
	}

    public function viewEquiposBanderas(){
        $data['equipos'] = $this->mdl_equipos_campeonato->list_equipos ();
        return $this->load->view( 'view_banderas_equipo', $data, true );
    }
	
	function sync(){
		echo "<pre>";
		$this->importData('WP2010/FootballTeams_Comp8_ID56666059_es.xml');
		echo "</pre>";
	}
	
	function importData( $xml ){
		// Cargo los modulso que necesito		
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml		
		$teams = $data->Teams->Team; //Limito mi objeto a los datos necesarios
		foreach( $teams as $team ){
			$teamData = $this->_check_exist( array( 'afp_id' => $team->n_TeamID ), TRUE );
			//echo (string)$team->c_PublicName."  ". (string)$team->c_PublicNameShort."<br>";
			if( !$teamData ){
				$team_insert = array( 'afp_id' => $team->n_TeamID, 'name' => (string)$team->c_PublicName, 'short_name' => (string)$team->c_PublicNameShort );				
				$this->_insert( $team_insert );
			}
		}
	}
}