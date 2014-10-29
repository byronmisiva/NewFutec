<?php
class Tarjetas extends MY_Controller{	
	
	public $model = 'mdl_tarjetas';

	public function __construct(){
		parent::__construct();
		$this->load->model( $this->model );
	}	
	
	function _insert( $data ){		
		$modelString = $this->model;
		$aux = $this->get( array( 'select' => '*',
				'where' => array(
						'partidos_id' => $data['partidos_id'],
						'equipos_campeonato_id' => $data['equipos_campeonato_id'],
						'minuto' => $data['minuto'],		
						'jugadores_id' => $data['jugadores_id'] ) ), TRUE );		
		if( !$aux ){
			$this->$modelString->save( $data, NULL );
		}
		else{
			$this->$modelString->save( $data, $aux->id );
		}
	}
	
	function getTarjetasByPartidoAndEquipo( $partido, $estadio ){
		return $this->mdl_tarjetas->getTarjetasByPartidoAndEquipo( $partido, $estadio );
	}
	
	function sync(){
		//echo "<pre>";
		//$this->importData('WP2010/FootballMatchDetailBasic_Comp8_MatchID1496771_ID56662506_es.xml');
		//echo "</pre>";
		
		$xmlRankingDir=scandir(AFP_HARD_ROOT_FILE."WP2010");
		$numXml=count($xmlRankingDir);
		for($i=0;$i<$numXml;$i++){
			$mystring = $xmlRankingDir[$i];
			$findme   = 'FootballLiveMatchDetailBasic_Comp8';
			$pos = strpos($mystring, $findme);
			// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
			// porque la posición de 'a' está en el 1° (primer) caracter.
			if ($pos === false) {
				//echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
			} else {
				$xmlRanking[$i]=$xmlRankingDir[$i];
				$this->importData('WP2010/'.$xmlRanking[$i]);
				// echo "La cadena '$findme' fue encontrada en la cadena '$mystring'";
				//echo " y existe en la posición $pos";
			}
		}
		
		
	}
	
	function importData( $xml ){
		// Cargo los modulso que necesito
		$this->load->module( 'partidos' );
		$this->load->module( 'jugadores' );
		$this->load->module( 'equipos_campeonato' );
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
		
		$partidos = $this->partidos->get( array( 'select' => '*' ) );
		$partidoID = $data->Match->Header->n_MatchID;
	
		
		foreach ( $partidos as $partido ){
			
			if( $partido->afp_id == $partidoID ){
				foreach( $data->Match->Detail as $tarjetas ){
					$action=$this->_clearString( str_replace( "ó", "o",$tarjetas->c_Action));
					if ($action!="Alineacion" && $action!="Comienzo" && $action!="Final de tiempo" && $action!="Gol" && $action!="Cambio de funcion"  && $action!="Gol en propia puerta") {	
						echo "<pre>";
						//echo $detail->c_Action;
						echo "</pre>";
						
						$equipo = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $tarjetas->n_TeamID ) ), TRUE );
						$jugador = $this->jugadores->get( array( 'select' => 'id, apodo', 'where' => array( 'afp_id' => ( string ) $tarjetas->n_PersonID ) ), TRUE );
						if( $equipo && $jugador ){
							$tarjeta = array(
									'minuto' => str_replace( 'T', ' ', (string)$tarjetas->d_Timestamp ),
									'jugadores_id' => $jugador->id,
									'partidos_id' => $this->partidos->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string)$partidoID ) ), TRUE )->id,
									'equipos_campeonato_id' => $equipo->id,
									'jugadores_id' => $jugador->id,
									'corto' => $jugador->apodo,
									'tipo'=>( string ) $tarjetas->n_ActionCode,
									'afp_id'=>( string ) $tarjetas->n_ActionID,
									'tipo_tarjeta'=>( string ) $tarjetas->c_ActionReason
							);
						
							if( !$this->_check_exist( array( 'afp_id' => $tarjeta['afp_id'] ), TRUE ) ){
								$this->_insert( $tarjeta );
							}
						}
					}
				}
			}
		}
	}
}