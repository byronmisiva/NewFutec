<?php
class Mdl_encuesta extends MY_Model{
	
	public $table_name = "lista_formacion";	
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

	public function __construct(){
		parent::__construct();		
	}
			
	function getEncuesta()
	{					 
		$query = $this->db->query('SELECT frm.id,eq.first_name,eq.last_name,frm.imagen , frm.posicion,voto, frm.checked
								   FROM lista_formacion AS frm, players as eq 
                                   where eq.id=frm.player_id
                                   order by frm.posicion;');
		if ($query->num_rows() == 0){
			return NULL;
		}else{
			return $query->result();
		}				 			
	   }
	
}