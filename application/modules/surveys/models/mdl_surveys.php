<?php
class Mdl_surveys extends MY_Model{
	
	public $table_name = "surveys";
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

    public function get_last_survey(){
        $this->db->select('*', false);
        $this->db->from($this->table_name);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        return $this->db->get()->result();
    }

    public function get_survey_options($id){
        $this->db->select('*', false);
        $this->db->from('options');
        $this->db->where('survey_id', $id);
        return $this->db->get()->result();
    }



}