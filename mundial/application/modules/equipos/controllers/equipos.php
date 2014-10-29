<?php
class Equipos extends MY_Controller{	
	
	public $model = 'mdl_equipos';

	public function __construct(){
		parent::__construct();				
	}
	
	public function index(){
						
	}
	
	public function view(){			
		$this->load->module('imagenes');		
		$equipoQuery['select'] = '*';
		$equipoQuery['paginate'] = TRUE;		
		$equipoQuery['limit'] = $this->uri->segment(3);
		$equipoQuery['offset'] = 1;
		$this->mdl_equipos->page_config = array(
				'base_url'			=>	base_url('site/equipos/'),
				'per_page'			=>	1,			
				'num_links'			=>	1
		);		
		$data['equipo'] = $this->get( $equipoQuery, TRUE );
		$imagenesQuery['select'] = '*';		
		$imagenesQuery['where'] = array( 'galerias_id' => $data['equipo']->galerias_id );	
		$imagenes = $this->imagenes->get($imagenesQuery);		
		$data['equipo']->imagenes = $imagenes;
		$data['links'] = $this->mdl_equipos->page_links;		
		return $this->load->view( 'view', $data, TRUE );
	}
	
	function sync(){
		echo "<pre>";		
		$this->data_model('WC/xml/es/team/index');
		echo "</pre>";
	}
	
	private function data_model($xml){
		// Cargo los modulso que necesito
		$this->load->module('galerias');
		$this->load->module('imagenes');
		$this->load->module('fichas');
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path		
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos		
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml		
		$data = $data->NewsItem->NewsComponent; //Limito mi objeto a los datos necesarios	
		
		foreach( $data->NewsComponent as $node ){			
			$type = ( string ) $node->NewsLines->HeadLine; // Distingo entre el tipo de dato (Perfil ó Ficha)	
			// Cargo y parseo los Xml con los detalles, fotos y fichas de cada equipo			
			switch($type){
				case "Perfil":
					
					//Creo la galeria para el equipo y la biografia					
					$galleryData = $this->galerias->_check_exist( array( 'nombre' => 'Equipo - '.( string ) $node->DescriptiveMetadata->OfInterestTo->attributes() ), TRUE );					
					if( !$galleryData ){
						$galeria = array(
								'nombre' => 'Equipo - '.( string ) $node->DescriptiveMetadata->OfInterestTo->attributes(),
								'publico' => 0
								);						
						$galeria_id = $this->galerias->_insert( $galeria );
					}										
					//Grabo o saco el id del equipo
					$equipo = array(
							'nombre' => ( string ) $node->DescriptiveMetadata->OfInterestTo->attributes(),
							'afp_id' => array_pop( array_slice( explode( "-", ( string ) $node->NewsItemRef->attributes() ), 2, 1 ) ),
							'galerias_id' => ( $galleryData ) ? $galleryData->id : $galeria_id,
							'file_details' => AFP_XML.$pathXml.'/'.str_replace('.xml','',(string)$node->NewsItemRef->attributes()),
							'ident_pais' => $this->mdl_equipos->sNameEquipos[( string ) $node->DescriptiveMetadata->OfInterestTo->attributes()]
					);								
					if( !$this->mdl_equipos->get_by( array( 'nombre' => $equipo['nombre'] ) ) ){
						$equipo['id'] = $this->mdl_equipos->save( $equipo, $id = NULL, $set_flashdata = FALSE );					
					}	
					else{						
						$equipo['id'] = $this->mdl_equipos->get_by( array( 'nombre' => $equipo['nombre'] ) ,TRUE )->id;						
					}				
					if( $this->xmlimporter->load( $equipo['file_details'] ) ){
						$ficha = $this->xmlimporter->parse();
						
						if( isset( $ficha->NewsItem->NewsComponent ) ){
							$ficha = $ficha->NewsItem->NewsComponent;							
							$fotos = 0;
							foreach( $ficha->NewsComponent as $component ){	
								
								$aux = (string) $component->attributes();								
								switch( $aux ){
									case "":
										$equipo['detalles']="";
										foreach( $component->ContentItem->DataContent->children() as $name => $children ){
											switch( $name ){
												case "hl2":
													$equipo['detalles'].="<h3>".(string)$children."</h3>";
													break;
														
												case "p":
													$equipo['detalles'].="<p>".(string)$children."</p>";
													break;
														
											}												
										}																			
										$this->mdl_equipos->save( $equipo, $equipo['id'], $set_flashdata = FALSE );	
									break;
	
									case (substr_compare($aux,'photo',0,5)==0):										
										$fotos++;									
										$this->imagenes->_syncFotos( $component, array(
												'origen' => $pathXml.'/', //origen
												'destino' => strtolower( 'imagenes/equipos/'.$equipo['nombre'] ).'/', //destino
												'galerias_id' => $equipo['galerias_id'], // id galeria
												'titulo' => "Equipo - ".$equipo['nombre'].' - '.$fotos, // nombre de la foto
												'modulo' => "equipos",
												'equipo_id' => $equipo['id']
												)
										); // nombre de la foto
									break;	
								}
							}
						}
					}
					break;						
				case "Ficha":
					$xml = AFP_XML.$pathXml.'/'.str_replace('.xml','',(string)$node->NewsItemRef->attributes());
					$this->fichas->_sync( $xml, $equipo['id'] );	
					
					break;				
			}
		}
	}
}