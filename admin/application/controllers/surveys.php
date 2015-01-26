<?php
class Surveys extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('survey','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->load->model('survey','model');
		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->rsegment(1),$this->uri->rsegment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index(){	
	    $data['title'] = "ENCUESTAS ";
		$data['heading'] = "ACCESO";
		$data['query']=$this->model->get_all($this->uri->segment(3));
		
		$this->view('surveys_view',$data);
	}	

	function insert()
	{
		$data['title'] = "ENCUESTAS ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
				$this->db->insert('surveys', $_POST);
				redirect('surveys/index');
		    }	
		}
		$this->view('surveys_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('surveys');
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('surveys');
	}

	function confirm_delete(){
		$this->load->view('surveys_confirm_delete');	
	}
	
	function update(){
		$data['title'] = "ENCUESTAS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
				$this->db->where( 'id',$_POST['id']);
        		$this->db->update('surveys', $_POST); 
				redirect('surveys/index');
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('surveys');
		$this->view('surveys_vupdate',$data);
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function vote(){
		$this->model->vote($this->uri->segment(3),$this->uri->segment(4));
		$data=$this->model->get_results($this->uri->segment(3));
		$this->load->view($this->model->name."/result",$data);
	}
	
	function active_survey(){
		$data['title'] = "ENCUESTAS ";
		$data['heading'] = "ACTIVAS";
		$data['query']=$this->model->active_survey();
		$this->view('surveys_active',$data);
	}
	
		
	function results(){
		$id=$this->uri->segment(3);
		$data=$this->model->get_results($id);
		$data['last']=$this->model->get_last(5);
		
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		$this->template->write_view('content', 'surveys/results',$data, TRUE);
		
		//Renderizo el template
		$this->template->render();
		
	}
	
	function last(){
		$data['num']=30;
		$data['last']=$this->model->get_last($data['num']);
		
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		$this->template->write_view('content', 'surveys/lasts',$data, TRUE);
		
		//Renderizo el template
		$this->template->render();
		
	}
}
?>