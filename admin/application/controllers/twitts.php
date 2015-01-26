<?php

class Twitts extends CI_Controller {
	
	var $folder_views;
	var $types;
	
	function __construct(){
		parent::__construct();	
		$this->load->model('twitt','model');
		$this->folder_views='twitts';
		$this->load->helper('html');
		$this->types=array(''=> 'Selecciona una elemento', 'teams'=>'Equipos','players'=>'Jugadores');
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	public function index(){
		
	}
	
	public function test(){
		$this->load->library('Twitter');
		
		echo "<pre>";
		var_dump($this->twitter->get());
		echo "</pre>";
	}
	
	public function get_lists($element=""){

		$data=array();
		$data['results']=$this->model->get_lists($element);
		$data['title']='Listas de Twitter';
		$data['types']=$this->types;
		
		$this->view($this->folder_views.'/view',$data);
	}
	
	function view($ver,$data){
		$this->load->library('parser');
		
		$data = array(
				'title' => 'futbolecuador.com - Administrador',
				'menu' => $this->menu->build_menu(),
				'content' => $this->load->view($ver,$data,TRUE)
		);
		
		$this->parser->parse('templates/admin2', $data);
	}
	
	function get_elements($element=""){
		$results=$this->model->get_elements($element);
		$html="<select id='element_id' name='element_id' onchange='$(\"submit\").enable();'>\n";
		$html.="<option value=''>Selecciona una opción...</option>\n";
		if($results != FALSE){
			foreach ($results as $row){
				$html.="<option value='".$row->id."'>".$row->name."</option>\n";
				
			}
		}
		$html.="</select>";
		
		echo $html;
	}
	
	function insert(){
		if(isset($_POST['submit'])){
			$data=array('element'=>$_POST['element'],'name'=>$this->types[$_POST['element']],'element_id'=>$_POST['element_id']);

			$this->model->insert($data);
		}
		$data['results']=$this->model->get_lists();
		$this->load->view($this->folder_views.'/list',$data);
	}
	
	function delete($id=""){
		if($id != ""){
			$this->db->where('id',$id);
			$this->db->delete('twitter_lists');
		}
		$data['results']=$this->model->get_lists();
		$this->load->view($this->folder_views.'/list',$data);
	}
}