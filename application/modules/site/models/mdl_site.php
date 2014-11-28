<?php
class Mdl_site extends MY_Model{
	
	public $table_name = "sections";
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

    function getNameSection($id){
        $this->db->where( 'id',$id);
        $this->db->from( 'sections');
        return $this->db->get()->result();
    }

}