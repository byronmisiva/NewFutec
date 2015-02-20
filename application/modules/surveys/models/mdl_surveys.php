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
        $resultado = $this->db->get()->result();
        return $resultado;
    }

    public function get_survey_options($id){
        $this->db->select('*', false);
        $this->db->from('options');
        $this->db->where('survey_id', $id);
        $this->db->order_by('votes', 'desc');

        return $this->db->get()->result();
    }
    public function set_data($id){
        $this->db->select('votes', false);
        $this->db->from('options');
        $this->db->where('id', $id);
        $votos =  $this->db->get()->result();

        $data = array(
            'votes' => $votos[0]->votes + 1
        );
        $this->db->where('id', $id);
        $this->db->update('options', $data);
        $sql = $this->db->last_query();
        return 1;
    }



}