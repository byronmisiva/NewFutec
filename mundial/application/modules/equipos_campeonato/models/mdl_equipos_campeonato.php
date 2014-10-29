<?php

class Mdl_equipos_campeonato extends MY_Model
{
    public $table_name = "equipos_campeonato";
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

    public function __construct()
    {
        parent::__construct();
    }

    public function list_equipos()
    {
        $equipos = $this->get(array('select' => "*"));
        return $equipos;
    }
}