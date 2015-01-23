<?php
class Flashes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('flash');
		$this->load->model('statistic');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', 'Texto', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->template->add_js('js/calendar.js');
		$this->template->add_css('css/calendar.css');
		
		//Validacion ACL
		//$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
			
	function index()
	{
		$data['title'] = "FLASH ";
		$data['heading'] = "LISTADO";
		$data['query']=$this->flash->get_all($this->uri->segment(3));
	    $this->view('flashes_view',$data);
	
	}	
	
	function insert()
	{
		$data['title'] = "FLASH ";
		$data['heading'] = "INGRESO";
		
		if(isset($_POST['submit'])){	
   			$_POST['date']=mdate('%Y-%m-%d  %h:%i:%s',time());
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->flash->insert($_POST);
				redirect('flashes');	
	    	}	
		}
		$this->view('flashes_vinsert',$data);
	}
	
	function update()
	{
		$data['title'] = "FLASH ";
		$data['heading'] = "ACTUALIZAR";
		$data['query']=$this->flash->get($this->uri->segment(3));
		
		
		if(isset($_POST['submit'])){		
   			$_POST['date']=mdate('%Y-%m-%d  %h:%i:%s',time());
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
   				$this->flash->update($_POST);
   				redirect('flashes');
		    }	
		}		
		$this->view('flashes_vupdate',$data);
	}	

	function delete(){
		if($this->flash->delete($this->uri->segment(3)))
        	redirect('flashes');
	}
	
	function confirm_delete(){
		$this->load->view('flashes_confirm_delete');	
	}
	
	function flashes_xml(){
		
		if($this->config->item("encryption_key")==$this->uri->segment(4)){
		$data['name']='XML Noticias Flash';
		$data['views']=1;
		$this->statistic->sum($data);	
		$request='<flashes>';
		$query=$this->flash->get_num($this->uri->segment(3));
		foreach($query->result() as $row):
			$request=$request.'<flash>
							   		<id>'.$row->id.'</id>
							   		<texto>'.strip_tags($row->text).'</texto>
							   		<fecha>'.$row->date.'</fecha>
							   </flash>';
		endforeach;
		$request=$request.'</flashes>';
		header('Content-type: text/xml');
		print $request;
		}
		
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
}
?>