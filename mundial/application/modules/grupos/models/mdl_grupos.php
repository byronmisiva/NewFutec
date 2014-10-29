<?php
class Mdl_grupos extends MY_Model{
	
	public $table_name = "grupos";	
	public $primary_key = "id";	
	public $joins;	
	public $select_fields;	
	public $total_rows;	
	public $page_links;	
	public $current_page;	
	public $num_pages;	
	public $optional_params;	
	public $order_by;	
	public $form_values = array();
	public $page_config = array();

	public function __construct(){
		parent::__construct();		
	}
	
	function getTableByFase(){		
		$grupos = $this->mdl_grupos->getGruposByFaseActive();		
		$data = array();
		foreach( $grupos as $grupo ){
			$grupo->tabla = $this->mdl_grupos->getTableByGrupo( $grupo->id );
			array_push( $data, $grupo );
		}
		return $data;
	}
	
	function getGruposByFaseActive(){
		$query = array(
				'select' => 'grupos.*',
				'joins' => array( 'fases' => 'grupos.fases_id = fases.id' ),
				'where' => array( 'fases.active' => 1 ),
				'order_by' => 'grupos.nombre asc'
		);
		return $this->get( $query );
	}
	
	function getTableByGrupo( $grupoId ){
		$this->load->module('partidos');
		$this->load->module('equipos');
		$query = array(
				'select' => '*',
				'where' => array( 'grupos_id' => $grupoId )
		);		
		$partidosByGrupo = $this->partidos->get( $query );			
		$equipos=array();
		if( $partidosByGrupo ){
			//forma equipos
			foreach( $partidosByGrupo as $row){	
				$equipos[$row->local] = new stdClass();
				$equipos[$row->local]->id=$row->local;
				$equipos[$row->local]->pj=0;
				$equipos[$row->local]->pg=0;
				$equipos[$row->local]->pe=0;
				$equipos[$row->local]->pp=0;
				$equipos[$row->local]->gf=0;
				$equipos[$row->local]->gc=0;
				$equipos[$row->local]->gd=0;
				$equipos[$row->local]->p=0;
					
				$equipos[$row->visitante] = new stdClass();
				$equipos[$row->visitante]->id=$row->visitante;
				$equipos[$row->visitante]->pj=0;
				$equipos[$row->visitante]->pg=0;
				$equipos[$row->visitante]->pe=0;
				$equipos[$row->visitante]->pp=0;
				$equipos[$row->visitante]->gf=0;
				$equipos[$row->visitante]->gc=0;
				$equipos[$row->visitante]->gd=0;
				$equipos[$row->visitante]->p=0;
			}
			// chequea ganador
			foreach( $partidosByGrupo as $row){
				$resultado=explode("-", $row->resultado);
				if( $resultado[0] > $resultado[1] && $row->estado != 0 ){
					$equipos[$row->local]->pg += 1;
					$equipos[$row->local]->gf += $resultado[0];
					$equipos[$row->local]->gc += $resultado[1];
					$equipos[$row->local]->p += 3;
	
					$equipos[$row->visitante]->pp+=1;
					$equipos[$row->visitante]->gf+=$resultado[1];
					$equipos[$row->visitante]->gc+=$resultado[0];
				}else{	
					if( $resultado[0] == $resultado[1] && $row->estado != 0 ){
						$equipos[$row->local]->pe += 1;
						$equipos[$row->local]->gf += $resultado[0];
						$equipos[$row->local]->gc += $resultado[1];
						$equipos[$row->local]->p += 1;
	
						$equipos[$row->visitante]->pe += 1;
						$equipos[$row->visitante]->gf += $resultado[1];
						$equipos[$row->visitante]->gc += $resultado[0];
						$equipos[$row->visitante]->p += 1;
					}
					else{
						if( $resultado[0] < $resultado[1] && $row->estado != 0 ){
							$equipos[$row->local]->pp += 1;
							$equipos[$row->local]->gf += $resultado[0];
							$equipos[$row->local]->gc += $resultado[1];
	
							$equipos[$row->visitante]->pg += 1;
							$equipos[$row->visitante]->gf += $resultado[1];
							$equipos[$row->visitante]->gc += $resultado[0];
							$equipos[$row->visitante]->p += 3;
						}
					}
				}
			}			
			// datos del equipo y calculos pj y gd
			foreach( $equipos as $row ){				
				$equipos[$row->id]->informacion=$this->equipos->get( array( 'select' => 'id, nombre, continente, corto, bandera, uniforme, alterno', 'where' => array( 'id' => $row->id ) ) );
				$equipos[$row->id]->pj=$equipos[$row->id]->pg+$equipos[$row->id]->pe+$equipos[$row->id]->pp;
				$equipos[$row->id]->gd=$equipos[$row->id]->gf-$equipos[$row->id]->gc;
			}
	
			// ordenar
			foreach ( $equipos as $key=>$arr ) {
				$pun[$key] = $arr->p;
				$g1[$key] = $arr->gd;
				$g2[$key] = $arr->gf;
				$g3[$key] = $arr->gc;
			}
			array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$equipos);
			return $equipos;
		}
	}
}