<?php
class Resources extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('resource','model');
		
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('date');
		
		$this->load->library('pagination');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function index(){
		$data['title'] = "RECURSOS ";
		$data['heading'] = "LISTADO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all($this->uri->segment(3));
	
		$this->view($this->model->name.'/view',$data);
	}	

	function insert(){
		$data['title'] = "RECURSOS ";
		$data['heading'] = "INGRESO";
		
		$this->form_validation->set_rules('controller', 'Controlador', 'required');
		$this->form_validation->set_rules('function', 'Funcion', 'required');
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['name']=ucfirst(str_replace("_", " ",$_POST['controller'])).' - '.ucfirst(str_replace("_", " ",$_POST['function']));
				if($this->model->check_resource($_POST['name'])){
					$this->db->insert($this->model->name, $_POST);
				}
				redirect($this->model->name);
		    }	
		}
		
		$this->view($this->model->name.'/insert',$data);
	}
		
	function delete(){
		if($this->model->delete($_POST['id']))
        	redirect($this->model->name);
	}
	
	function confirm_delete(){
		$data['id']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/confirm_delete',$data);	
	}
		
	function update()
	{
		$data['title'] = "ROLES ";
		$data['heading'] = "ACTUALIZAR";
		$data['row']=$this->model->get($this->uri->segment(3));
		
		$this->form_validation->set_rules('controller', 'Controlador', 'required');
		$this->form_validation->set_rules('function', 'Funcion', 'required');
   		
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['name']=ucfirst(str_replace("_", " ",$_POST['controller'])).' - '.ucfirst(str_replace("_", " ",$_POST['function']));
				if($this->model->check_resource($_POST['name'])){
					$this->db->where( 'id',$_POST['id']);
        			$this->db->update($this->model->name, $_POST); 
				}
					redirect($this->model->name);
			}
		    else
				$data['row']=$this->model->get($_POST['id']);
		}
		else
			$data['row']=$this->model->get($this->uri->segment(3));
		
		$this->view($this->model->name.'/update',$data);
		
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
}
?>
