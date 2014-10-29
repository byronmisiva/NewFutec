<?php
class Mdl_videos extends MY_Model
{

    public $table_name = "videos";
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

    public $estados_afp = array();
    public $estados_desc = array();
    public $local = array();
    public $posiciones = array();

    public function __construct()
    {
        parent::__construct();

    }

    public function getAllVideos()
    {
        $videos = $this->db->query('SELECT * FROM videos WHERE inicia <= NOW() ORDER BY inicia DESC   ');
        $result = $videos->result();
        return $result;
    }
}