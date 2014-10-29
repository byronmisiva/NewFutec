<?php
class Goles extends MY_Controller{

	public $model = 'mdl_goles';

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

	function getGolesByPartidoAndEquipo( $partido, $equipo ){
		return $this->mdl_goles->getGolesByPartidoAndEquipo( $partido, $equipo );
	}

	function sync(){
		echo "<pre>";
		//$this->importData('WP2010/FootballMatchDetailBasic_Comp8_MatchID1496763_ID56662466_es.xml');
		echo "</pre>";

		$xmlRankingDir=scandir(AFP_HARD_ROOT_FILE."WP2010");
		$numXml=count($xmlRankingDir);
		for($i=0;$i<$numXml;$i++){
			$mystring = $xmlRankingDir[$i];
			//$findme   = 'FootballLiveMatchDetailBasic';
			$findme   = 'FootballMatchDetailBasic';
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

		echo "<pre>";
		//print_r ($data);
		echo "</pre>";
		foreach ( $partidos as $partido ){
			if( $partido->afp_id == $partidoID ){
				foreach( $data->Match->Detail as $goles ){
						
					if( ( string ) $goles->c_Action == 'Gol' || ( string ) $goles->c_Action == 'Gol en propia puerta' ){
						echo "<pre>";
						//print_r ($data);
						//echo $goles->c_ActionReason;
						echo "</pre>";
						$equipo = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $goles->n_TeamID ) ), TRUE );
						$jugador = $this->jugadores->get( array( 'select' => 'id, apodo', 'where' => array( 'afp_id' => ( string ) $goles->n_PersonID ) ), TRUE );
						if( $equipo && $jugador ){
							$gol = array(
									'partidos_id' =>$this->partidos->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string)$partidoID ) ), TRUE )->id,
									'tipo' => ( string ) $goles->n_ActionCode,
									'minuto' => str_replace( 'T', ' ', (string)$goles->d_Timestamp ),
									'jugadores_id' => $jugador->id,
									'corto' => $jugador->apodo,
									'fallado' => '0',
									'afp_id' => ( string ) $goles->n_ActionID,
									'equipos_campeonato_id' => $equipo->id,
									'tipo_gol'=>( string )$goles->c_ActionReason
							);
							if( !$this->_check_exist( array( 'afp_id' => $gol['afp_id'] ), TRUE ) ){
								$this->_insert( $gol );
							}
						}
					}
				}
			}
		}
	}

	private function filter_item( $item ){
		if( strpos( $item, "FootballLiveMatchDetailAll" ) !== FALSE ){
			return $item;
		}
	}

	function prueba(){
		$opciones = array(
				"Cambio de función",
				"Alineación",
				"Gol",
				"Amarilla",
				"Comienzo",
				"Final de tiempo",
				"",
				"Penalti parado Fallado",
				"Roja directa",
				"Gol en propia puerta",
				"Roja (2Âª amarilla)",
				"Tiro fuera",
				"Falta cometida",
				"Golpe franco",
				"Tiro al poste",
				"Tiro de gol",
				"Tiro a gol",
				"Para del portero",
				"Saque tras gol",
				"Saque de esquina",
				"Fuera de juego",
				"Tiempo añadido",
				"Tiro al larguero",
				"Falta cometida (penalti)",
				"Saque neutro",
				"Temporalmente fuera",
				"Oportunidad de gol",
				"Gol anulado",
				"No sale por línea de fuera gracias al jugador" );
		$files = array_filter( scandir( AFP_HARD_ROOT_FILE."WP2010" ), array( $this, 'filter_item' ) );
		foreach ( $files as $file ){
			$pathXml = implode( "/", explode( "/", $file, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
			$xml = AFP_XML ."WP2010/".$file; //Inicializo de que seccion y que xml voy a sacar los datos
			$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
			foreach( $data->Match->Detail as $detail ){	
				if( ( string ) $detail->c_Action == 'Gol' ){			
				echo "<pre>";
				var_dump($detail);
				echo "</pre>";		
				}		
			}
		}
	}
}