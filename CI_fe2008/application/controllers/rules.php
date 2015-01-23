<?php
class Rules extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('rule','model');
		$this->load->model('rol');
		$this->load->model('resource');
		
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('date');
		
		$this->load->library('pagination');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		$this->permissions=array('Allow' => 'Permitido', 'Deny' => 'Denegado' );
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));	
	}
	
	
	function index(){
		
		$data['title'] = "REGLAS ";
		$data['heading'] = "LISTADO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all($this->uri->segment(3));
	    $data['rol']=$this->rol->get_list();
	    $data['resource']=$this->resource->get_list();
	    $data['permissions'] = $this->permissions;
		$data['js'] = 'id="roles" onChange="get_update(\'roles\',\'result\',\''.base_url()."rules/ajax_by_role/".'\');"';
	    $data['roles']=$this->rol->get_list();
	    $this->template->add_js('js/ajax.js');
		$this->view($this->model->name.'/view',$data);
	}	

	function insert(){
		$data['title'] = "REGLAS ";
		$data['heading'] = "INGRESO";
		$data['roles']=$this->rol->get_list();
		$data['resources']=$this->resource->get_list();
		$data['permissions'] = array('Allow' => 'Permitido', 'Deny' => 'Denegado' );
		
		$this->form_validation->set_rules('resource_id', 'Recurso', 'required');
		$this->form_validation->set_rules('role_id', 'Rol', 'required');
		$this->form_validation->set_rules('permission', 'Permiso', 'required');
		$this->form_validation->set_rules('forward', 'Reenvio', 'trim|required');
		$this->form_validation->set_rules('message', 'Mensaje', 'trim|required');
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['name']=$data['roles'][$_POST['role_id']].' / '.$data['resources'][$_POST['resource_id']];
				$this->model->insert($_POST);
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
		
	
	function update(){
		$data['title'] = "REGLAS ";
		$data['heading'] = "ACTUALIZAR";
		$data['row']=$this->model->get($this->uri->segment(3));
		$data['roles']=$this->rol->get_list();
		$data['resources']=$this->resource->get_list();
		$data['permissions'] = array('Allow' => 'Permitido', 'Deny' => 'Denegado' );
		
		$this->form_validation->set_rules('resource_id', 'Recurso', 'required');
		$this->form_validation->set_rules('role_id', 'Rol', 'required');
		$this->form_validation->set_rules('permission', 'Permiso', 'required');
		$this->form_validation->set_rules('forward', 'Reenvio', 'trim|required');
		$this->form_validation->set_rules('message', 'Mensaje', 'trim|required');
   		
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['name']=$data['roles'][$_POST['role_id']].' / '.$data['resources'][$_POST['resource_id']];
        		$this->model->update($_POST); 
				redirect($this->model->name);
		    }
		    else
				$data['row']=$this->model->get($_POST['id']);
		}
		else
			$data['row']=$this->model->get($this->uri->segment(3));
		
		
		$this->view($this->model->name.'/update',$data);
		
	}
	
	
	function priority_up(){
		$this->model->change_priority($this->uri->segment(3),'up');
		redirect($this->model->name);
	}
	
	function priority_down(){
		$this->model->change_priority($this->uri->segment(3),'down');
		redirect($this->model->name);
	} 
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function ajax_by_role(){
		$role=$this->uri->segment(3);
		$data['query']=$this->model->get_by_role($role);
		$data['permissions'] = $this->permissions;
		$this->load->view($this->model->name.'/ajax_view',$data);
	}
}
?>
