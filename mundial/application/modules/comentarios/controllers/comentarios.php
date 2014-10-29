<?php
class Comentarios extends MY_Controller{	
	
	public $model = 'mdl_comentarios';

	public function __construct(){
		parent::__construct();				
	}
	
	public function index(){
						
	}
	
   function sync(){
		echo "<pre>";
		$this->importData('WC/xml/es/comments/commentslive-fr-91322.xml');
		echo "</pre>";
	}
	
	public function viewComentarios($idPartido){
		$this->load->module( 'partidos' );
		$partido= $this->partidos->get( array('select'=>'*', 'where'=>array('id'=>$idPartido)),TRUE);
		$comentarios = $this->get( array('select'=>'*', 'where'=>array('afp_id_partido'=>$partido->afp_id) , 'limit'=>'5', 'order_by'=>'orden DESC'));
		$data['comentarios'] = $comentarios;
		return $this->load->view( 'view_comentarios_vivo', $data, true);
	}
	
	public function ajxComentarios($id){
		$this->load->module('comentarios');
		$data['comentarios']=$this->comentarios->get(array("select"=>"DISTINCT orden, tiempo, comentario","where"=>array("partidos_id"=>$id),'order_by'=>'orden DESC'));
		return $this->load->view('ajxcomentarios',$data, TRUE);
	}
	
	function statusPeriod ($status, $period){
		
		$tiempo_comentario="";
		
		if($status=='EMENC' && $period=='PMTAB'){
			$tiempo_comentario="Numero de Penalties";
			$tipo='1'; 
		}elseif($status=='EMENC' && $period=='PMTP1'){
			$tiempo_comentario="Primer tiempo en proceso";
			$tipo='2';
		}elseif($status=='EMPAU' && $period=='PMTP1'){
			$tiempo_comentario="Medio Tiempo";
			$tipo='3';
		}elseif($status=='EMENC' && $period=='PMTP2'){
			$tiempo_comentario="Segundo tiempo en proceso";
			$tipo='4';
		}elseif($status=='EMENC' && $period=='PMTP2'){
			$tiempo_comentario="Segundo tiempo en proceso";
			$tipo='5';
		}elseif($status=='EMFIN' && $period=='PMTP2'){
			$tiempo_comentario="Fin Partido";
			$tipo='6';
		}elseif($status=='EMENC' && $period=='PMPR1'){
			$tiempo_comentario="Primer tiempos extras en proceso";
			$tipo='7';
		}elseif($status=='EMPAU' && $period=='PMPR1'){
			$tiempo_comentario="Medio tiempo en tiempos extras";
			$tipo='8';
		}elseif($status=='EMENC' && $period=='PMPR2'){
			$tiempo_comentario="Segundo tiempos extras en proceso";
			$tipo='9';
		}elseif($status=='EMFIN' && $period=='PMPGO'){
			$tiempo_comentario="Fin del partido por gol de oro";
			$tipo='10';
		}elseif($status=='EMFIN' && $period=='PMPSI'){
			$tiempo_comentario="Fin del partido por gol de plata";
			$tipo='11';
		}elseif($status=='EMFIN' && $period=='PMPR2'){
			$tiempo_comentario="Fin del partido de tiempos extras";
			$tipo='12';
		}elseif($status=='EMPAU' && $period=='PMPR2'){
			$tiempo_comentario="Fin del partido de tiempos extras";
			$tipo='13';
		}elseif($status=='EMENC' && $period=='PMTAB'){
			$tiempo_comentario="Penalti en proceso";
			$tipo='14';
		}elseif($status=='EMFIN' && $period=='PMTAB'){
			$tiempo_comentario="Fin del partido despues de penalties";
			$tipo='15';
		}elseif(($status=='EMNCO' || $status='EMFIN' || $status='EMPAU') && $period==''){
			$tiempo_comentario="Texto Libre";
			$tipo='16';
		}elseif($status=='EMNCO' && $period='XXXXX'){
			$tiempo_comentario="Texto Libre";
			$tipo='16';
		}
		return array('tiempo'=>$tiempo_comentario, 'tipo'=>$tipo);
	}
	
	function importData( $xml ){
		// Cargo los modulso que necesito		
		$pathXml = implode( "/", explode( "/", $xml, -1 ) ); //Extraigo el path para cuando envien el archivo sin path
		$xml = AFP_XML . $xml; //Inicializo de que seccion y que xml voy a sacar los datos
		$data = ( $this->xmlimporter->load($xml) ) ? $this->xmlimporter->parse() : FALSE; //Realizo el parseo del xml
		$i=0;
		$afp_id_partido=(string) $data->attributes();
			foreach ($data->comment as $row){
				foreach ((array)$row as $node){
			   $respuestaTiempo=$this->statusPeriod((string)$node['status'],(string)$node['period']);
				$comentario= array(
						'afp_id_partido'=>$afp_id_partido,
						'tiempo'=>(string)$node['time'],
						'orden'=>(string)$node['order'],
						'estado'=>(string)$node['status'],
						'periodo'=>(string)$node['period'],
						'evento'=>(isset($node['event'])) ? (string)$node['event'] : '',
						'tiempo_comentario'=>(string)$respuestaTiempo['tiempo'],
						'tipo'=>$respuestaTiempo['tipo'],
						'comentario'=>(string)$row,
						//'partidos_id'=>$this->partidos->get( array( 'select' => 'id', 'where' => array( 'afp_id' => (string)$afp_id_partido ) ), TRUE )->id
						'partidos_id'=>'65'
						);
				
					if( !$this->_check_exist( array( 'afp_id_partido' => $comentario['afp_id_partido'], 'orden'=> (string)$node['order'] )) ){
						$this->_insert($comentario);
					}
					
				}
				
				
			}
					
		}	
		
		
}