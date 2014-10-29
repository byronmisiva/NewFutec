<?php
class Estadios extends MY_Controller{	
	
	public $model = 'mdl_estadios';

	public function __construct(){
		parent::__construct();				
	}
	
	public function view(){
		$this->load->module('imagenes');		
		$estadios = $this->get( array( 'select' => '*' )  );
		$data['estadios'] = array();
		foreach ( $estadios as $estadio ){
			$estadio->galeria = $this->imagenes->get( array( 'select' => '*', 'where' => array( 'galerias_id' => $estadio->galerias_id ) ) );
			array_push($data['estadios'], $estadio);			
		}

		
	}
	
	function sync(){
		echo "<pre>";
		$this->data_model('WC/xml/es/sites/index');
		echo "</pre>";
	}
	
	private function data_model($xml){
		$this->load->module('galerias');
		$this->load->module('imagenes');		
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path ( es la ruta de los archivos sin el arichos index.xml )		
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos		
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml		
		$data = $data->NewsItem->NewsComponent; //Limito mi objeto a los datos necesarios		
		foreach ( $data->NewsComponent as $node ){			
			$nombreEstadio = trim( (string) $node->NewsLines->HeadLine );
			$afpIdEstadio = array_pop( array_slice( explode( "-", (string) $node->NewsItemRef->attributes() ), 3, 1) );	
			//Creo la galeria para el estadio
			if( !$this->galerias->_check_exist( array( 'nombre' => 'Estadio - '.$nombreEstadio ) ) ){
				$galeria = array( 'nombre' => 'Estadio - '.$nombreEstadio, 'publico' => 0 );
				$galeria['id'] = $this->galerias->_insert( $galeria, NULL, FALSE );
			}
			else{
				$galeria['id'] = $this->galerias->_check_exist( array( 'nombre' => 'Estadio - '.$nombreEstadio ), TRUE )->id;
			}			
			//Creo el estadio
			if( !$this->mdl_estadios->get_by( array( 'nombre' => $nombreEstadio ) ) ){
				$estadio = array( 'nombre' => $nombreEstadio, 'galerias_id' => $galeria['id'], 'afp_id' => $afpIdEstadio );
				$idEstadio = $this->mdl_estadios->save( $estadio, NULL, FALSE );
				$estadioData = $this->_check_exist( array( 'nombre' => $nombreEstadio ), TRUE );
			}
			else{
				$estadioData = $this->_check_exist( array( 'nombre' => $nombreEstadio ), TRUE );
			}
			$estadioDetails = (string) $node->NewsItemRef->attributes();
			$xml = AFP_XML.$pathXml.'/'.str_replace('.xml','',$estadioDetails);
			
			if ( $this->xmlimporter->load( $xml ) ){
				$data = $this->xmlimporter->parse();				
				if( $this->xmlimporter->load( $xml ) ){					
					$data = $this->xmlimporter->parse();					
					$data = $data->NewsItem->NewsComponent;
					$fotos = 0;
					foreach ( $data->NewsComponent as $component ){						
						if( isset($component->ContentItem->DataContent) ){
							foreach ( $component->ContentItem->DataContent->dl as $estadioNode ){
								$estadioNodeType = trim( (string) $estadioNode->dt );
								switch ($estadioNodeType ){
									case 'Ciudad':										
										$ciudadEstadio = trim( (string) $estadioNode->dd->block->p );										
										break;
									case 'Capacidad':
										$capacidadEstadio = substr( str_replace( " ", "", trim( (string)$estadioNode->dd->block->p ) ) , 0, 5 );										
										break;
									case 'Club que lo utiliza':
										$clubEstadio = trim( (string)$estadioNode->dd->block->p );										
										break;
									case 'Programa':
										$programaEstadio = trim( (string)$estadioNode->dd->block->p );										
										break;
								}								
							}							
							$this->mdl_estadios->save( 
									array( 'ciudad' => $ciudadEstadio,
											'capacidad' => $capacidadEstadio,
											'club' => $clubEstadio,
											'programa' => $programaEstadio ), $estadioData->id, FALSE );												
						}
						else{
							$fotos++;
							$this->imagenes->_syncFotos( $component, array(
									'origen' => $pathXml.'/', //origen
									'destino' => strtolower( 'imagenes/estadios/' ), //destino
									'galerias_id' => $estadioData->galerias_id, // id galeria
									'titulo' => $nombreEstadio." - ".$fotos // nombre de la foto
								)
							);							
						}					
					}
				}
			}			
		}
	
	}
	
	
}