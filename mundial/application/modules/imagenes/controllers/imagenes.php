<?php
class Imagenes extends MY_Controller{	
	
	public $model = 'mdl_imagenes';

	public function __construct(){
		parent::__construct();	
		$this->load->library('image_lib');
	}
	
	public function index(){
		$data['pageTitle'] = "Mundial Brasil 2014";
		$data['pageTitle'] = "";
		$this->load->view( 'index', $data );		
	}
	
	function _syncFotos( $node = "", $imageDetails = array( 'origen' => '', 'destino' => '', 'galerias_id' => '', 'titulo' => '', 'modulo' => '', 'equipo_id' => '' ) ){		
		//Chequeo que la imagen no exista		
		//Recorro todos los componentes de la imagen	
		if( !$this->_check_exist( array( 'nombre' => $imageDetails['titulo'] ) ) ){
			$imagen = array( 'descripcion' => '', 'main' => '', 'ftp_main' => '', 'thumb250' => '', 'ftp_thumbnail' => '', 'visu' => '', 'ftp_visu' => '' );
			foreach($node->NewsComponent as $aux){				
				$value = (string) $aux->Role->attributes();				
				//De acuerdo al atributo del componente agrego los datos
				$imageUrl = (string) $aux->ContentItem->attributes(); // Url relativo de la imagen FTP
				$imagenName = substr(strrchr($imageUrl,'/'),1); // Nombre de la imagen sin path
				switch( $value ){					
					case "Caption":						
						$imagen['descripcion'] = utf8_encode(utf8_decode((string) $aux->ContentItem->DataContent->p));			
					break;							
					case "Main":					
						$this->_createFolder( $imageDetails['destino'] );			
						if( $this->_copyFileFromUrl( $imageDetails['origen'].$imageUrl, $imageDetails['destino'].$imagenName ) ){ //Extraigo la imagen del ftp y la copio en el server
							$imagen['main'] = base_url($this->_clearString( str_replace( " ", "-",$imageDetails['destino'].$imagenName ) ));
							$imagen['ftp_main'] = AFP_XML.$imageDetails['origen'].(string) $aux->ContentItem->attributes();
							$imagen['thumb250'] = base_url($this->_resize_image( $imagenName, $imageDetails['destino'].$imagenName, $imageDetails['destino']."thumb250/", '300' ));		
							$imagen['thumb85'] = base_url($this->_resize_image( $imagenName, $imageDetails['destino'].$imagenName, $imageDetails['destino']."thumb85/", '85' ));		
							$imagen['thumb660'] = base_url($this->_resize_image( $imagenName, $imageDetails['destino'].$imagenName, $imageDetails['destino']."thumb660/", '660' ));							
							/*$imagen['thumb2'] = $this->_crop( $imagenName, $imagen['thumb1'], $imageDetails['destino']."thumb2/", '150', '150', '50', '15' );*/							
						}
					break;
					case "Thumbnail":							
						$this->_createFolder( $imageDetails['destino']."thumbnail/" );
						if( $this->_copyFileFromUrl( $imageDetails['origen'].$imageUrl, $imageDetails['destino']."thumbnail/".$imagenName ) ){ //Extraigo la imagen del ftp y la copio en el server
							$imagen['thumbnail'] = base_url($this->_clearString( str_replace( " ", "-",$imageDetails['destino'].$imagenName ) ));
							$imagen['ftp_thumbnail'] = AFP_XML.$imageDetails['origen'].(string)$aux->ContentItem->attributes();
						}				
					break;
					case "Visu":					
						$this->_createFolder( $imageDetails['destino']."visu/" );
						if( $this->_copyFileFromUrl( $imageDetails['origen'].$imageUrl, $imageDetails['destino']."visu/".$imagenName ) ){ //Extraigo la imagen del ftp y la copio en el server
							$imagen['visu'] = base_url($this->_clearString( str_replace( " ", "-",$imageDetails['destino'].$imagenName )) );
							$imagen['ftp_visu'] = AFP_XML.$imageDetails['origen'].(string)$aux->ContentItem->attributes();
						}
					break;
				}				
			}
			//Inserto los datos de las imagenes
			$imagen['galerias_id'] = $imageDetails['galerias_id'];			
			$imagen['nombre'] = ( $imageDetails['titulo'] != "" ) ? $imageDetails['titulo'] : $imagenName;
			$this->mdl_imagenes->save( $imagen, NULL, FALSE );
			if( substr ( $imageDetails['titulo'] , -1 ) == 1 && isset($imageDetails['modulo']) && $imageDetails['modulo'] == 'equipos' ){
				$this->load->module('equipos');
				$this->equipos->_update( array( 'foto' => $imagen['main'] ), $imageDetails['equipo_id'] );
			}
		}
		else
			return false;	
	}	
	

	function _syncFotosJugador( $imageDetails = array( 'origen' => '', 'destino' => '', 'galerias_id' => '', 'titulo' => '' ) ){
		//Chequeo que la imagen no exista
		//Recorro todos los componentes de la imagen
		if( !$this->_check_exist( array( 'nombre' => $imageDetails['titulo'] ) ) ){
			foreach($node->NewsComponent as $aux){
				$value = (string) $aux->Role->attributes();
				//De acuerdo al atributo del componente agrego los datos
				switch( $value ){
					case "Caption":
						$imagen['descripcion'] = utf8_encode(utf8_decode((string) $aux->ContentItem->DataContent->p));
						break;
					case "Main":
						$imageUrl = (string) $aux->ContentItem->attributes(); // Url relativo de la imagen FTP
						$imagenName = substr(strrchr($imageUrl,'/'),1); // Nombre de la imagen sin path
						$this->_createFolder( $imageDetails['destino'] );
						if( $this->_copyFileFromUrl( $imageDetails['origen'].$imageUrl, $imageDetails['destino'].$imagenName ) ){ //Extraigo la imagen del ftp y la copio en el server
							$imagen['original'] = $imageDetails['destino'].$imagenName;
							/*$imagen['thumb1'] = $this->_resize_image( $imagenName, $imageDetails['destino'].$imagenName, $imageDetails['destino']."thumb1/", '250' );
							 $imagen['thumb2'] = $this->_crop( $imagenName, $imagen['thumb1'], $imageDetails['destino']."thumb2/", '150', '150', '50', '15' );
							$imagen['thumb3'] = $this->_resize_image( $imagenName, $imageDetails['destino'].$imagenName, $imageDetails['destino']."thumb3/", '85' );
							$imagen['thumb4'] = $this->_resize_image( $imagenName, $imageDetails['destino'].$imagenName, $imageDetails['destino']."thumb4/", '55' );*/
							//Inserto los datos de las imagenes
							$imagen['galerias_id'] = $imageDetails['galerias_id'];
							$imagen['cortada'] = '0';
							$imagen['nombre'] = ( $imageDetails['titulo'] != "" ) ? $imageDetails['titulo'] : $imagenName;
							$this->_insert( $imagen );
						}
						break;
				}
			}
		}
		else
			return false;
	}
	
	function _resize_image( $imagenName, $path, $new_path, $width){	
		$this->_createFolder( $new_path );
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image']	= $this->_clearString( str_replace( " ", "-", $path ) );
		$config['new_image']	= $this->_clearString ( str_replace( " ", "-", $new_path.$imagenName ) );
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = TRUE;
		$config['master_dim'] = 'width';
		$config['width'] = $width;
		$config['height'] = $width;
		$config['quality'] = '65%';
		$this->image_lib->initialize($config);
		if ( ! $this->image_lib->resize()){
			echo $this->image_lib->display_errors();
			echo $new_path.$imagenName;
		}
		else{
			//return $new_path.$config['new_image'];
			return $new_path.$imagenName;
		}
	}
	
	
	function _createFolder( $folderPath ){		
		$folderPath = $this->_clearString( str_replace( " ", "-", $folderPath ) );				
		if( !file_exists( SITE_HARD_ROOT_FILE.$folderPath) ){
			return mkdir( SITE_HARD_ROOT_FILE.$folderPath, 0777 );
		}

	}

	function _deleteFolder( $folderPath ){
		$folderPath = $this->_clearString( str_replace( " ", "-", $folderPath ) );
		$dir=SITE_HARD_ROOT_FILE.$folderPath;

		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
				}
			}
			reset($objects);
			return rmdir($dir);
		}

	}

	function _deleteFile( $folderPath ){
		$folderPath = $this->_clearString( str_replace( " ", "-", $folderPath ) );
		if( file_exists( SITE_HARD_ROOT_FILE.$folderPath) ){
			return unlink( SITE_HARD_ROOT_FILE.$folderPath);
		}

	}


	function _copyFileFromDisk( $sourcePath, $destPath ){		
		$sourcePath = str_replace( " ", "-", $this->_clearString( $sourcePath ) );
		$destPath = str_replace( " ", "-", $this->_clearString(  $destPath ) );	
		/*echo AFP_HARD_ROOT_FILE.$sourcePath." -> Imagen a Copiar<br>";
		echo SITE_HARD_ROOT_FILE.$destPath." -> Destino de la Imagen a Copiar<br>";*/
		if( file_exists( AFP_HARD_ROOT_FILE.$sourcePath) && !file_exists( SITE_HARD_ROOT_FILE.$destPath) ){		
			return copy( AFP_HARD_ROOT_FILE.$sourcePath, SITE_HARD_ROOT_FILE.$destPath );
		}
	}
	
	
	function _copyFileFromDiskGalery( $sourcePath, $destPath ){
		//$sourcePath = str_replace( " ", "-", $this->_clearString( $sourcePath ) );
		$destPath = str_replace( " ", "-", $this->_clearString(  $destPath ) );
		/*echo $sourcePath." -> Imagen a Copiar<br>";
		echo SITE_HARD_ROOT_FILE.$destPath." -> Destino de la Imagen a Copiar<br>";*/
		if (file_exists( SITE_HARD_ROOT_FILE.$destPath)){
				unlink(SITE_HARD_ROOT_FILE.$destPath);
		}
		if( file_exists( $sourcePath) && !file_exists( SITE_HARD_ROOT_FILE.$destPath) ){
			return copy( $sourcePath, SITE_HARD_ROOT_FILE.$destPath );
		}
	}
	
	function _copyFileFromUrl( $sourcePath, $destPath ){
		$sourcePath = str_replace( " ", "-", $this->_clearString( $sourcePath ) );
		$destPath = str_replace( " ", "-", $this->_clearString(  $destPath ) );
		$photo = @file_get_contents(AFP_XML.$sourcePath);
		if( $photo != false ){			
			return file_put_contents( $destPath, $photo );
		}	
	}
	
	function _crop( $imagenName, $path, $new_path, $width, $height, $x, $y ){
		$this->_createFolder( $new_path );
		$config['image_library']        = 'GD2';
		$config['source_image']         = $this->_clearString( str_replace( " ", "-",  $path ) );
		$config['new_image']			= $this->_clearString( str_replace( " ", "-", $new_path.$imagenName ) );
		$config['width']                = $width;
		$config['height']               = $height;
		$config['x_axis']               = $x;
		$config['y_axis']               = $y;
		$config['maintain_ratio']       = false;	
		$this->image_lib->clear();
		$this->image_lib->initialize($config);		
		if ( ! $this->image_lib->crop()){
			echo $this->image_lib->display_errors();
		}
		else{
			return $new_path.$imagenName;
		}
	}

}