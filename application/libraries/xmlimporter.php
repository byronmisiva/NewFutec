<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class XmlImporter {
	
	private $document;
	private $filename;
	
	/*** Load a XML file for parsing ***/
	
	public function load ($file) {		
		if( substr( $file, 0, 4 ) == 'http' ){			
			$file = ( substr( $file, strlen($file) - 4, strlen($file) ) == '.xml' ) ? $file : $file.'.xml';
			$headers = get_headers( $file );			
			$is_xml = false;
			foreach($headers as $header){
				if( strstr( $header, '/xml' )!=false)
					$is_xml=true;
			}			
			if($is_xml==false){
				log_message('error','El archivo: '.$file.' no es xml o no existe');
				return false;
			}			 
			$this->document = file_get_contents($file);
		}
		else{
			$bad  = array('|//+|', '|\.\./|');
			$good = array('/', '');			
			$file = APPPATH.preg_replace ($bad, $good, $file).'.xml';
			if (! file_exists ($file))
				return false;
			 
			$this->document = utf8_encode (file_get_contents($file));
		}

		$this->filename = $file;

		return true;

	}  /* END load */
	
	/*** Parse a XML document into an object ***/

	public function parse () {
		try {
			$xml = $this->document;			
			$this->document = ( $xml == '' ) ? false : simplexml_load_string($xml);
			return $this->document;
		}		
		catch ( Exception $e ){
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		}
	} /* END parse */

	public function convert_to_array () {
		$arr = $this->process_xml($this->document);
		var_dump($arr);
		return $arr;
	}

	public function node_to_string($node){		
		$aux="";
		foreach($node->children() as $name=>$value){
			if(count($value)>0){
				$aux.=$this->node_to_string($value);
			}
			else
				$aux.="<$name>".(string)$value."</$name>";
		}
		return $aux;
	}

	private function process_xml($nodes){
		$array = array();
		foreach($nodes as $name=>$node){
			if(count($node)>0)
				$array[$name][]=$this->process_xml($node);
			else{
				if(count($node->attributes())>0){
					$attributes=array();
					foreach($node->attributes() as $name_att => $value_att){
						$attribVal = trim((string)$value_att);
						$attributes[$name_att]=$attribVal ;
					}
					$array[$name]['attributes']=$attributes;
				}
				if(trim((string)$node)!="")
					$array[$name]['value']=trim((string)$node);
			}
		}
		return $array;
	}

}