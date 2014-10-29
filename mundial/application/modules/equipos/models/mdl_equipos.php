<?php
class Mdl_equipos extends MY_Model{
	
	public $table_name = "equipos";	
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
	public $sNameEquipos =array();

	public function __construct(){
		parent::__construct();	
		$this->sNameEquipos = array(
				'Alemania' => 'GER',
				'Argelia' => 'ALG',
				'Argentina' => 'ARG',
				'Australia' => 'AUS',
				'Bélgica' => 'BEL',
				'Bosnia' => 'BIH',
				'Brasil' => 'BRA',
				'Camerún' => 'CMR',
				'Chile' => 'CHI',				
				'Corea del Sur' => 'KOR',
				'Costa de Marfil' => 'CIV',
				'Costa Rica' => 'CRC',
				'Croacia' => 'CRO',
				'Ecuador' => 'ECU',
				'España' => 'ESP',
				'EEUU' => 'USA',
				'Francia' => 'FRA',
				'Ghana' => 'GHA',
				'Grecia' => 'GRE',
				'Holanda' => 'NED',
				'Honduras' => 'HON',
				'Inglaterra' => 'ENG',
				'Irán' => 'IRN',
				'Italia' => 'ITA',
				'Japón' => 'JPN',
				'México' => 'MEX',
				'Nigeria' => 'NGA',
				'Portugal' => 'POR',
				'Rusia' => 'RUS',
				'Suiza' => 'SUI',
				'Uruguay' => 'URU',
				'Colombia'=>'COL'
			);
	}
}