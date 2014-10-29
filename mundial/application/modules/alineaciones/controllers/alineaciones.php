<?php
class Alineaciones extends MY_Controller{

	public $model = 'mdl_alineaciones';   

	public function __construct(){
		parent::__construct();
	}
	
	/*function _insert( $data ){		
		$aux = $this->get( array( 'select' => '*',
				'where' => array(
						'partidos_id' => $data['partidos_id'],
						'equipos_id' => $data['equipos_id'],						
						'jugadores_id' => $data['jugadores_id'] ) ), TRUE );
		if( !$aux ){
			$this->mdl_alineaciones->save( $data, NULL );
		}
		else{
			$this->mdl_alineaciones->save( $data, $aux->id );
		}
	}
	
	function getAlineacionByPartidoAndEquipo( $partido, $equipo ){		
		return $this->mdl_alineaciones->getAlineacionByPartidoAndEquipo( $partido, $equipo );	
	}*/
	
	function sync(){
		//echo "<pre>";
		//$this->importData('WP2010/FootballMatchDetailBasic_Comp8_MatchID1496762_ID56662461_es.xml');
		//echo "</pre>";
		
		$xmlRankingDir=scandir(AFP_HARD_ROOT_FILE."WP2010");
		$numXml=count($xmlRankingDir);
		for($i=0;$i<$numXml;$i++){
			$mystring = $xmlRankingDir[$i];
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
		$this->load->module( 'equipos_campeonato' );
		$this->load->module( 'partidos' );
		$this->load->module( 'jugadores' );
		// Cargo los modulso que necesito
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
	  $partidos = $this->partidos->get( array( 'select' => '*' ) );
	   $partidoID = $data->Match->Header->n_MatchID; //Limito mi objeto a los datos necesarios
	   foreach ( $partidos as $partido ){
	   if( $partido->afp_id == $partidoID ){
	    		foreach( $data->Match->Detail as $jugAlineacion ){
	    			if((string)$jugAlineacion->n_TeamID!=0){
	    				$equipo = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $jugAlineacion->n_TeamID ) ), TRUE );
	    				$jugadores = $this->jugadores->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $jugAlineacion->n_PersonID ) ), TRUE );
	    				if( $equipo && $jugadores ){
	    					if(!$jugAlineacion->n_Position){
	    						$equipoTutular = array(
	    								'posicion' => (string)$jugAlineacion->c_Function,
	    								'jugadores_id' => (string)$jugadores->id,
	    								'partidos_id' => $partido->id,
	    								'equipos_campeonato_id' => $equipo->id,
	    								'corto' => (string)$jugAlineacion->c_PersonShort,
	    								'numero' => (string)$jugAlineacion->n_ShirtNr,
	    								'orden' => '0'
	    						);
	    					}
	    					else {
	    						$equipoTutular = array(
	    								'posicion' => (string)$jugAlineacion->c_Function,
	    								'jugadores_id' => (string)$jugadores->id,
	    								'partidos_id' => $partido->id,
	    								'equipos_campeonato_id' => $equipo->id,
	    								'corto' => (string)$jugAlineacion->c_PersonShort,
	    								'numero' => (string)$jugAlineacion->n_ShirtNr,
	    								'orden' => (string)$jugAlineacion->n_Position
	    						);
	    					}
	    					
	    				//Verifica si existe en la base o no de alineacion
						if( !$this->mdl_alineaciones->get_by( array( 'jugadores_id' => $jugadores->id, 'partidos_id'=> $partido->id, 'equipos_campeonato_id'=> $equipo->id ) ) ){
							$equipoTutular['id'] = $this->mdl_alineaciones->save( $equipoTutular, NULL, FALSE );
						}
						else{
							$equipoTutular['id'] = $this->mdl_alineaciones->get_by( array( 'jugadores_id' => $jugadores->id, 'partidos_id'=> $partido->id, 'equipos_campeonato_id'=> $equipo->id ) ,TRUE )->id;
						}
	    			  }
	    			}
	    		}
	          }
	      }
	}
	
	
}