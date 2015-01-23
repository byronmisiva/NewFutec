<?php
class Statistics_Matches extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('statistic_match','model');
	}

	function publica(){
		$this->load->helper('html');
		$this->load->model('section');
		$this->load->library('table');
		
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('path',base_url(),TRUE);

		
		//centro
		$galleries=$this->model->get_all()->result();
		$tabla="";
		$i=0;
		foreach($galleries as $row){
			$data=$this->get_gallery($row->flickr);
			$photos = $this->flickr->get_photos();
			$table_data=array();
			foreach($photos as $photo){
				$link=str_replace("_s.jpg", ".jpg",$photo['image_url']);
				$table_data[]="<a href='$link' rel=\"lightbox[galery_$i]\" ><img src='".$photo['image_url']."' border='1'></a>";
			}
			$new_list = $this->table->make_columns($table_data, 5);
			$tmpl = array('table_open'=>'<table border="0" width="100%" cellpadding="5" cellspacing="0" align="center">');

			$this->table->set_template($tmpl);
			$tabla.="<div id='gallery'><div id='title'>".$row->name."</div>\n";
			$tabla.=$this->table->generate($new_list);
			$this->table->clear();
			$tabla.="\n</div>";
			$i++;
		}
		$data['tabla']=$tabla;
		$this->template->write_view('content', 'galleries/publica', $data, FALSE);
		
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		//Cargo las noticias rotativas
		$this->load->model('story');
		$data['query']=$this->story->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
		
		$this->template->render();
		
	}
	
	function index(){
		if(isset($_POST['submit'])){
			$this->validate_rules();
			if($this->form_validation->run()==TRUE)
				$this->insert();
		}
		
		if($this->uri->segment(3)>0){
			
			$data['match']=$this->uri->segment(3);
			$data['title']="ESTADISTICAS DE: <i>''</i>";
		    $data['query']=$this->model->get_all($this->uri->segment(3));
			$this->view($this->model->name.'/view',$data);
		}
		else
			redirect('matches');
	}	

	function insert(){
		unset($_POST['submit']);
		$this->model->insert($_POST);
		redirect($this->model->name.'/index/'.$_POST['match_id']);
	}
	
	function delete(){
		$row=$this->model->delete($this->uri->segment(3));
        redirect($this->model->name.'/index/'.$row->match_id);
	}
	
	function update()
	{
		$data['title'] = "ESTADISTICAS DE PARTIDO ";
		$data['heading'] = "ACTUALIZAR";
		
		if(isset($_POST['submit'])){
			$this->validate_rules();
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
        		$this->model->update($_POST,$_POST['id']); 
        		redirect($this->model->name.'/index/'.$_POST['match_id']);
		    }	
		}
		
		$data['query']=$this->model->get($this->uri->segment(3));
		$this->view($this->model->name.'/update',$data);
	}
	
	function view($ver,$data)
	{
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	private function validate_rules(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', 'Texto', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	private function get_gallery($set){
		$this->load->library('flickr');
 		
		$config = array(
			'type'				=> 'set',
			'user'				=> '42894014@N03',
			'set'				=> $set,
			'num_items'			=> 30,
			'rss_cache_path'	=> APPPATH.'cache/flickr-rss-cache',
			'cache_time'		=> 3600,
			'img_cache_path'	=> APPPATH.'cache/flickr-image-cache',
			'img_cache_url'		=> base_url().'application/cache/flickr-image-cache',
			'use_cache'			=> false,
			'image_size'		=> 'square',
			'tags'				=> ''
		);
		
		$this->flickr->init($config);
		
	}
}
?>
