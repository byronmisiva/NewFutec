<?php
class Cities extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('city','model');

	}
	
	function get_cities(){
		$this->config->set_item('compress_output', 'FALSE');
		$country=$this->uri->segment(3);
		$cities=$this->model->get_by_country($country);
		$html="<select name='city_id' id='city_id'>\n";
		foreach($cities as $city){
			$html.="<option value='$city->id'>$city->name</option>";
		}
		$html.="</select>\n";
		echo $html;
	}
}
?>
