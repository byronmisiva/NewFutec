<?php
class Jugadores extends MY_Controller{

	public $model = 'mdl_jugadores';

	public function __construct(){
		parent::__construct();
	}
	
	public function viewRankingGoleadores( $isAjax = false ){
	//	$this->output->cache( 1000 );
		$data['ajax'] = $isAjax;
		//$data['goleadores'] = $this->get( array('select'=>'*', 'where'=> array( 'n_goles' => 0 ), 'order_by'=>'apellido ASC, nombre ASC', 'joins'	=> array( 'equipos_campeonato' => array( 'jugadores.equipos_campeonato_id = equipos_campeonato.id' )) ));
	    $data['goleadores'] = $this->get( array('select'=>'*', 'where'=> array( 'n_goles != ' => 0 ), 'order_by'=>'n_goles DESC', 'joins'	=> array( 'equipos_campeonato' => array( 'jugadores.equipos_campeonato_id = equipos_campeonato.id' )) ));

	    if( $isAjax ){
	    	//$data['name'] = print_r($_POST['data']['name']);
	    	$this->load->view( 'view_ranking_goleadores', $data );
	    }
	    else{
	    	return $this->load->view( 'view_ranking_goleadores', $data, TRUE );
	    }
	}
	
	public function viewRankingGoleadoresFull( $isAjax = false ){
		$data['ajax'] = $isAjax;
		//$data['goleadores'] = $this->get( array('select'=>'*', 'where'=> array( 'n_goles' => 0 ), 'order_by'=>' apellido ASC, nombre ASC', 'joins'	=> array( 'equipos_campeonato' => array( 'jugadores.equipos_campeonato_id = equipos_campeonato.id' )) ));

		$data['goleadores'] = $this->get( array('select'=>'*', 'where'=> array( 'n_goles != ' => 0 ), 'order_by'=>'n_goles DESC', 'joins'	=> array( 'equipos_campeonato' => array( 'jugadores.equipos_campeonato_id = equipos_campeonato.id' )),"limit"=>10 ));

		if( $isAjax ){
			//$data['name'] = print_r($_POST['data']['name']);
			$this->load->view( 'view_ranking_goleadores', $data );
		}
		else{
			return $this->load->view( 'view_ranking_goleadores_full', $data, TRUE );
		}
	}
	
	
	public function viewJugadoresEquipo( $idEquipo ){
		$this->load->module( 'equipos_campeonato' );
		$this->load->module( 'jugadores' );
		$equipos_campeonato = $this->equipos_campeonato->get( array('select'=>'*', 'where'=>array('id'=>$idEquipo)));
		$jugadores=$this->jugadores->get( array('select'=>'*', 'where'=>array('equipos_campeonato_id'=>$equipos_campeonato->id)));
		$data['jugadores'] = $jugadores;
		return $this->load->view( 'view_jugadores_equipo', $data, TRUE);
	}
	
	function sync(){
	    $xmlRankingDir=scandir(AFP_HARD_ROOT_FILE."httpdocs/afp");
		$numXml=count($xmlRankingDir);
		for($i=0;$i<$numXml;$i++){
		    $mystring = $xmlRankingDir[$i];
			$findme   = 'FootballSquad';
			$pos = strpos($mystring, $findme);
			// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
			// porque la posición de 'a' está en el 1° (primer) caracter.
			if ($pos === false) {
			    //echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
			} else {
				$xmlRanking[$i]=$xmlRankingDir[$i];
				$this->data_model('httpdocs/afp/'.$xmlRanking[$i]);
			   // echo "La cadena '$findme' fue encontrada en la cadena '$mystring'";
			    //echo " y existe en la posición $pos";
			}	
		}	
		
	}
	
	private function data_model( $xml ){
		$this->load->module( 'equipos_campeonato' );
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
		
		//Extraigo el id del equipo del archivo de los convocados
		$equipo=$this->equipos_campeonato->get( array( 'select' => 'id, name', 'where' => array( 'afp_id' => (string)$data->Header->n_TeamID ) ), TRUE );
		$nombreEquipo=$equipo->name;
		$idEquipo=$equipo->id;
		//Extraigo los datos de cada convocado
		foreach( $data->Squad->Person as $node){
			
			$nomCompletoReemplazo1=str_replace(" ", "-", (string)$node->c_PersonSort);
			$nomCompletoReemplazo2=str_replace(",-", "-", $nomCompletoReemplazo1);
			$nomCompleto=explode("-",$nomCompletoReemplazo2);
		
			$nombre=$node->c_PersonFirstName;
			$apellido=$node->c_PersonLastName;
			
			//Verifica si el nombre y el apellido del jugador tienen dado sino reemplaza los datos que vienen en el campo de podo
			
			//print_r($nomCompleto);
			//echo "<br>";
			
		  
		   	
		 
			if(!$nombre==''){
				   $nombreJugador = ( isset($nomCompleto[1])) ? $nomCompleto[1] : '' ;
			
			}else{
				$nombreJugador=(string)$node->c_PersonFirstName;
			}
			
			if(!$apellido==''){
				$apellidoJugador = ( isset($nomCompleto[0])) ? $nomCompleto[0] : '';
			}else{
				$apellidoJugador=(string)$node->c_PersonLastName;
			}


			$detalle=$this->syncDatosJugador((string)$node->n_PersonID);
			
			$jugadores = array(
					'nombre' => $nombreJugador,
					'apellido' => $apellidoJugador,
					'apodo' => (string)$node->c_PersonSort,
					'nacimiento' => (string)$node->d_BirthDate,
					'posicion' => (string)$node->c_Function,
					'mini_foto' => "http://afp.infostradasports.com/images/lib/basic/Person/PP_NationalTeam/medium/".(string)$node->n_PersonID.".jpg",
					'foto'=>"http://afp.infostradasports.com/images/lib/basic/Person/PP_NationalTeam/large/".(string)$node->n_PersonID.".jpg",
					'detalles'=>$detalle,
					'lugar_nacimiento' => (string)$node->c_PersonNatio,
					'altura' => (string)$node->n_Height,
					'peso' => (string)$node->n_Weight,
					'afp_id' =>(string)$node->n_PersonID,
					'equipos_campeonato_id' => $idEquipo,
					'n_goles' => '0',
					'n_camiseta' => (string)$node->n_ShirtNumber,
					'n_asistencias' => '0'
			);
            //echo "<pre>";
			//print_r($jugadores);
			//echo "</pre>";
			
			
			//Verifica si existe en la base o no
			if( !$this->mdl_jugadores->get_by( array( 'afp_id' => $jugadores['afp_id']) ) ){
				$jugadores['id'] = $this->mdl_jugadores->save( $jugadores, NULL, FALSE );
			}
			else{
				$jugadores['id'] = $this->mdl_jugadores->get_by( array( 'afp_id' => $jugadores['afp_id'] ) ,TRUE )->id;
			}
		}
		
		
		
	}



	function syncDatosJugador($afpIdJugador){

		//$afpIdJugador='738579';
	    $xmlRankingDir=scandir(AFP_HARD_ROOT_FILE."httpdocs/afp");
		$numXml=count($xmlRankingDir);
		$cont=0;
		for($i=0;$i<$numXml;$i++){
		    $mystring = $xmlRankingDir[$i];
			$findme   = 'FootballPersonPassport_Person'.$afpIdJugador;
			$pos = strpos($mystring, $findme);
			// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
			// porque la posición de 'a' está en el 1° (primer) caracter.
			if ($pos === false) {
			    //echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
			} else {
				if($cont==0)
                {
				$xmlRanking[$i]=$xmlRankingDir[$i];
				$xml='httpdocs/afp/'.$xmlRanking[$i];
					 
				$pathXml = implode( "/", explode( "/",$xml , -1 ) ); //Extraigo el path para cuando envien el archivo sin path
				$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
				$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml

				$nombreOficial=(string)$data->PersonPassport->Header->c_OfficialName;
				$nacionalidad=(string)$data->PersonPassport->Header->c_Natio;
				$fechaNac=substr(str_replace('T', '', (string)$data->PersonPassport->Header->d_BirthDate),0,10);
				$ciudadNac=(string)$data->PersonPassport->Header->c_BirthCity;
				$altura=(string)$data->PersonPassport->Header->n_Height;
				$peso=(string)$data->PersonPassport->Header->n_Weight;
				$club=(string)$data->PersonPassport->Header->c_ClubTeam;
				$ciudClub=(string)$data->PersonPassport->Header->c_ClubTeamNatio;
				$posicion=(string)$data->PersonPassport->Header->c_ClubTeamFunction;

				  $detalle='<h3>'.$posicion.'</h3>';
			      $detalle.='<p> Su nombre oficial '.$nombreOficial.' de nacionalidad '.$nacionalidad.',  nació en '.$ciudadNac.', '.$fechaNac.'.</p>';
			      $detalle.='<p>Juega en el club '.$club.' de la ciudad de '.$ciudClub.'.</p>';

				  return $detalle;	
			      //echo  $detalle;
			   }
			   $cont++;
			      
			}	
		}	
		
	}
	
	
	function syncGoledores(){

        $xmlRankingDir=scandir(AFP_HARD_ROOT_FILE."httpdocs/afp");
		$numXml=count($xmlRankingDir);
		for($i=0;$i<$numXml;$i++){
		    $mystring = $xmlRankingDir[$i];
			$findme   = 'FootballTopscorers_Comp';
			$pos = strpos($mystring, $findme);
			// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
			// porque la posición de 'a' está en el 1° (primer) caracter.
			if ($pos === false) {
			    //echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
			} else {
				$xmlRanking[$i]=$xmlRankingDir[$i];
				$this->data_model_goleadores('httpdocs/afp/'.$xmlRanking[$i]);
			   // echo "La cadena '$findme' fue encontrada en la cadena '$mystring'";
			    //echo " y existe en la posición $pos";
			}	
		}	


		//$this->data_model_goleadores('WP2010/FootballTopscorers_Comp8_Season478_ID56661147_es.xml');
	}
	
	
	
	private function data_model_goleadores( $xml ){
		$this->load->module( 'equipos_campeonato' );
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
	
		
		//Extraigo los datos para actualizacion en la tabla jugadores de los goles
		foreach( $data->Topscorers->Person as $node){
			
			//Extraigo el id del equipo del archivo de los convocados
			$equipo=$this->equipos_campeonato->get( array( 'select' => 'id, name', 'where' => array( 'afp_id' => (string)$node->n_TeamID ) ), TRUE );
			$nombreEquipo=$equipo->name;
			$idEquipo=$equipo->id;
			
			if(!$this->equipos_campeonato->get( array( 'select' => 'id, name', 'where' => array( 'afp_id' => (string)$node->n_TeamID)))){
				echo "El jugador ".(string)$node->Name()." no tiene equipo correcto";
			}else{
				$nomCompleto=explode(" ",(string)$node->c_Person);
				$nombreJugador =$nomCompleto[0];
				$apellidoJugador = ( isset($nomCompleto[1])) ? $nomCompleto[1] : '';
				
				$goleadores = array(
						'nombre' => $nombreJugador,
						'apellido' => $apellidoJugador,
						'apodo' => (string)$node->c_PersonSort,
						'nacimiento' => (string)$node->d_BirthDate,
						'posicion' => (string)$node->c_Function,
						'lugar_nacimiento' => (string)$node->c_PersonNatio,
						'altura' => (string)$node->n_Height,
						'peso' => (string)$node->n_Weight,
						'afp_id' =>(string)$node->n_PersonID,
						'equipos_campeonato_id' => $idEquipo,
						'n_goles' => (string)$node->n_Goals,
						'n_camiseta' => (string)$node->n_ShirtNr,
						'n_asistencias' => (string)$node->n_Assists
				);
			   
				
				//echo (string)$node->ID;
			  //Verifica si existe el jugador en la base o no
				$idJugador=$this->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string)$node->n_PersonID)),true)->id;
				if(!$idJugador){
				$goleadores['id'] = $this->_insert( $goleadores );
				}else{

                    $idgoles=$this->get( array( 'select' => 'n_goles', 'where' => array( 'afp_id' => (string)$node->n_PersonID)),true)->n_goles;
                    if ($idgoles < $goleadores['n_goles']){
			            $goleadores['id'] =$this->_update ( array('n_goles'=>$goleadores['n_goles'], 'n_asistencias'=>$goleadores['n_asistencias']), $idJugador);
                    }
				}
			}
			
		}
	
	}

	/*function sync(){		
		echo "<pre>";
		$this->data_model( 'espanol/periodico/res/s1534-0000000-403-es', 'espanol/periodico/team/' );
		echo "</pre>";
	}

	private function data_model( $xml, $xmlPathEquipo ){		
		$this->load->module('imagenes');
		$this->load->module('equipos');
		$xml = AFP_XML.$xml;
		$files = array();
		if( $this->xmlimporter->load( $xml ) ){
			$data = $this->xmlimporter->parse();			
			$data = $data->body->competition->discipline->evt;
			foreach( $data->person as $player ){
				$files[]=array(
						'name' => 'wc2010-bio-'.$player->attributes()->id.'-es',
						'id' => (string) $player->attributes()->id);
					
			}
		}		
		$filter = array(
				'Apellido' => 'apellido',
				'Nombre' => 'nombre',
				'Lugar de nacimiento' => 'lugar_nacimiento',
				'Altura' => 'altura',
				'Peso' => 'peso',
				'Puesto' => 'posicion',
				'Clubes' => 'clubes',
				'Conocido como' => 'apodo');
		//Itero en los archivos
		foreach( $files as $file ){
			$xml = AFP_XML.$xmlPathEquipo.str_replace('.xml','',$file['name']);			
			$foto_name = $file['id'].'.jpg';
			$foto = $xmlPathEquipo.'images/bio/'.$foto_name;		
			if($this->xmlimporter->load($xml)){
				$bio = $this->xmlimporter->parse();				
				//Extraigo los datos del XML
				if( isset($bio->NewsItem) ){
					$bio = $bio->NewsItem->NewsComponent->NewsComponent->ContentItem->DataContent;
					$jugador['detalles']="";
					$jugador['apodo']="";
					$jugador['afp_id'] = $file['id'];
					foreach( $bio->children() as $children ){				
						foreach( $children->children() as $name=>$component ){							
							if( $name == 'dl' ){
								$type=(string)$component->dt;
								switch ($type){
									case array_key_exists($type, $filter):
										$jugador[$filter[$type]]=utf8_encode(utf8_decode((string)$component->dd->block->p));
										break;
	
									case "País representado":
										$equipo = $this->equipos->_check_exist( array( 'nombre' => (string)$component->dd->block->p ), TRUE ); 
										$jugador['equipos_id'] = ( $equipo ) ? $equipo->id : FALSE;	 									
										break;
	
									case "Nacido el":
										$fecha=explode('-',(string)$component->dd->block->p);
										$this->load->helper('date');
										$mkfecha=mktime(5,0,0,$fecha[1],$fecha[0],$fecha[2]);
										$this->db->set('nacimiento',"FROM_UNIXTIME($mkfecha)",FALSE);
										break;
	
									default:
										$jugador['detalles'].="<label><b>".$type.":</b></label>\n";
										$jugador['detalles'].="<span>".(string)$component->dd->block->p."</span><br/>\n";
	
								}
							}
							else{	
								if($name=='hl2')
									$jugador['detalles'].="<h3>".(string)$component."</h3>";
								else{
									$jugador['detalles'].='<'.$name.'>'.$this->xmlimporter->node_to_string($component).'</'.$name.'>';
								}	
							}	
						}
					}					
					if( !$this->_check_exist( array( 'nombre' => $jugador['nombre'], 'apellido' => $jugador['apellido'] ))){
						//Subo la foto	
						$new_path = 'imagenes/jugadores/'.$foto_name;
						if( $this->imagenes->_copyFile( $foto, $new_path ) ){					
							// chmod($new_path, 0777);
							$jugador['foto']=$new_path;
							//TODO: Mascara a la foto
						}
						if( $jugador['equipos_id'] ){
							$this->mdl_jugadores->save( $jugador , NULL, FALSE );						
						}	
					}
				}
			}
		}
	}*/
}