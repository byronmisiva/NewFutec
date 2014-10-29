<?php
class Fichas extends MY_Controller{

	public $model = 'mdl_fichas';

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['pageTitle'] = "Mundial Brasil 2014";
		$data['pageTitle'] = "";
		$this->load->module('templates');
		$this->templates->mainTemplate( $data );
	}

	public function viewFichaEquipodesc($idEquipo){

		$this->load->module( 'equipos' );
		$this->load->module( 'equipos_campeonato' );
		$this->load->module( 'partidos' );
		$this->load->module( 'galerias' );
		$this->load->module( 'imagenes' );
		$this->load->module( 'contenido' );

		$equipos_campeonato = $this->equipos_campeonato->get( array('select'=>'*', 'where'=>array('id'=>$idEquipo)));
		$equipos = $this->equipos->get( array('select'=>'*', 'where'=>array('ident_pais'=>(string)$equipos_campeonato->short_name)));

		
		foreach($equipos as $equipo)
		{
			$idGaleria=$this->galerias->get( array('select'=>'*', 'where'=>array('id'=>$equipo->galerias_id)),TRUE )->id;
			$imagenes=$this->imagenes->get( array('select'=>'*', 'where'=>array('galerias_id'=>$idGaleria)));
			$detalle=$equipo->detalles;
			$foto=$equipo->foto;
			$ficha = $this->get( array('select'=>'*', 'where'=>array('equipos_id'=>(string)$equipo->id)));	
		}
		$tabla = array(
					'id_equipo'=>$equipos_campeonato->id,
				    'short_name'=>$equipos_campeonato->short_name,
				    'nombre_equipo'=>$equipos_campeonato->name,
				    'foto'=>$foto,
				    'imagenes'=>array($imagenes),
				    'detalles'=>$detalle,
					'ficha'=>array($ficha)
					);
		$data['fichaEquipo'] = $tabla;
		$data['idEquipo'] =$idEquipo;
		return $this->load->view( 'view_info_equipo_desc', $data, true );
	}
	public function viewFichaEquipo($idEquipo){

		$this->load->module( 'equipos' );
		$this->load->module( 'equipos_campeonato' );
		$this->load->module( 'partidos' );
		$this->load->module( 'galerias' );
		$this->load->module( 'imagenes' );
		$this->load->module( 'contenido' );

		$equipos_campeonato = $this->equipos_campeonato->get( array('select'=>'*', 'where'=>array('id'=>$idEquipo)));
		$equipos = $this->equipos->get( array('select'=>'*', 'where'=>array('ident_pais'=>(string)$equipos_campeonato->short_name)));


		foreach($equipos as $equipo)
		{
			$idGaleria=$this->galerias->get( array('select'=>'*', 'where'=>array('id'=>$equipo->galerias_id)),TRUE )->id;
			$imagenes=$this->imagenes->get( array('select'=>'*', 'where'=>array('galerias_id'=>$idGaleria)));
			$detalle=$equipo->detalles;
			$foto=$equipo->foto;
			$ficha = $this->get( array('select'=>'*', 'where'=>array('equipos_id'=>(string)$equipo->id)));
		}
		$tabla = array(
					'id_equipo'=>$equipos_campeonato->id,
				    'short_name'=>$equipos_campeonato->short_name,
				    'nombre_equipo'=>$equipos_campeonato->name,
				    'foto'=>$foto,
				    'imagenes'=>array($imagenes),
				    'detalles'=>$detalle,
					'ficha'=>array($ficha)
					);


		$data['fichaEquipo'] = $tabla;
		$data['idEquipo'] =$idEquipo;
		return $this->load->view( 'view_info_equipo_ficha', $data, true );
	}

	function _sync( $xml, $equipos_id ){		
		if( $this->xmlimporter->load( $xml ) ){
			$fichas = $this->xmlimporter->parse();
			$fichas = $fichas->NewsItem->NewsComponent->NewsComponent->ContentItem->DataContent;			
			foreach( $fichas->dl as $component ){
								
				if( !$this->fichas->_check_exist(array( 'titulo' => (string) $component->dt, 'equipos_id' => $equipos_id )) ){
					$ficha = array(
							'equipos_id' => $equipos_id,
							'titulo' => (string)$component->dt,
							'detalles' => (string)$component->dd->block->p
							);
					$this->mdl_fichas->save( $ficha, NULL, FALSE );
				}
			}
			
		}
	}	
}