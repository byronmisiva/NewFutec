<?php
class Modules extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('module','model');
		
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('title', 'Titulo', 'required');
   		$this->form_validation->set_rules('visible', 'Visible', 'required');
   		$this->form_validation->set_rules('active', 'Activo', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		$this->load->helper('modul');
		
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function index()
	{
		$data['title'] = "MODULOS ";
		$data['heading'] = "LISTADO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all($this->uri->segment(3));
		$this->view($this->model->name.'/view',$data);
	}	

	function insert(){
		
		$modul=new Modul();
		$data['title'] = "MODULOS ";
		$data['heading'] = "INGRESO";
		
		$data['functions']=$modul->get_module_methods();
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert('modules', $_POST);
				redirect('modules/index');
		    }	
		}
		$this->view($this->model->name.'/insert',$data);	
	}
		
	function delete(){
		if($this->model->delete($this->uri->segment(3)))
        	redirect($this->model->name);
	}
	
	function confirm_delete(){
		$this->load->view($this->model->name.'/confirm_delete');	
	}
			
	function update($id)
	{
		$modul=new Modul();
		$data['title'] = "MODULOS ";
		$data['heading'] = "ACTUALIZAR";	
		$data['functions']=$modul->get_module_methods();
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
        		$this->db->update('modules', $_POST); 
        		redirect($this->model->name);
		    }	
		}
		$this->db->where( 'id',$id);
		$data['row']=current($this->db->get('modules')->result());
		$this->view($this->model->name.'/update',$data);
	}
	
	function view($ver,$data)
	{
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
}
?>