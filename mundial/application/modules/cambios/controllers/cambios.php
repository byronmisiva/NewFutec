<?php
class Cambios extends MY_Controller{	
	
	public $model = 'mdl_cambios';

	public function __construct(){
		parent::__construct();
		$this->load->model( $this->model );
	}	
	
	function _insert( $data ){		
		$aux = $this->get( array( 'select' => '*',
				'where' => array(
						'sale_id' => $data['sale_id'],
						'partidos_id' => $data['partidos_id'],
						'entra_id' => $data['entra_id'],
						'minuto' => $data['minuto'] ) ), TRUE );
		if( !$aux ){
			$this->mdl_cambios->save( $data, NULL );
		}
		else{
			$this->mdl_cambios->save( $data, $aux->id );
		}
	}
	
	function getCambiosByPartidoAndEquipo( $partido, $equipo ){
		return $this->mdl_cambios->getAlineacionByPartidoAndEquipo( $partido, $equipo );
	}
	
	private function filter_item( $item ){
		if( strpos( $item, "FootballLiveMatchDetailBasic_Comp8" ) !== FALSE ){
			return $item;
		}
	}
	
	function syncCambios(){
		$this->load->module( 'partidos' );
		$this->load->module( 'jugadores' );
		$this->load->module( 'equipos_campeonato' );
		$files = array_filter( scandir( AFP_HARD_ROOT_FILE."WP2010" ), array( $this, 'filter_item' ) );
		foreach ( $files as $file ){
			$pathXml = implode( "/", explode( "/", $file, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
			$xml = AFP_XML ."WP2010/".$file; //Inicializo de que seccion y que xml voy a sacar los datos
			$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
			$partidos = $this->partidos->get( array( 'select' => '*' ) );
			$partidoID = $data->Match->Header->n_MatchID;
			foreach ( $data->Match->Detail as $detail ){
				$action=$this->_clearString( str_replace( "ó", "o",$detail->c_Action));
				if ($action=="Cambio de funcion") {
				        $equipo = $this->equipos_campeonato->get( array( 'select' => 'id', 'where' => array( 'afp_id' => ( string ) $detail->n_TeamID ) ), TRUE );
				        $jugadorSale = $this->jugadores->get( array( 'select' => 'id, apodo', 'where' => array( 'afp_id' => ( string ) $detail->n_PersonID ) ), TRUE );
				        $jugadorEntra = $this->jugadores->get( array( 'select' => 'id, apodo', 'where' => array( 'afp_id' => ( string ) $detail->n_SubPersonID ) ), TRUE );
						
						
						if( $equipo && $jugadorSale){
							$cambio = array(
									'partidos_id' => $this->partidos->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string)$partidoID ) ), TRUE )->id,
									'minuto' => str_replace( 'T', ' ', (string)$detail->d_Timestamp ),
									'entra_id' => $jugadorSale->id,
									//'entra_id' => $jugadorEntra->id,
									'sale_id' => $jugadorSale->id,
									'corto_sale' => $jugadorSale->apodo,
									//'corto_entra' => $jugadorEntra->apodo,
									'corto_entra' => '',
									'equipos_campeonato_id' => $equipo->id,
									'afp_id'=>( string ) $detail->n_ActionID,
							);
							
							
							if( !$this->_check_exist( array( 'afp_id' => $cambio['afp_id'] ), TRUE ) ){
								$this->_insert($cambio);
							}	
					
				}
			
				}
			 
			}
		  
		}
	}
	
	
}