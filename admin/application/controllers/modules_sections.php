<?php 
class Modules_sections extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('module_section','model');
		$this->load->model('module');
		$this->load->model('section');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('module_id', 'Modulo', 'required');
		$this->blocks=array('1' => 'Central','2' => 'Izquierdo','3'=>'Derecho');
		
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function index(){
		$data['title'] = "M&Oacute;DULOS DE SECCI&Oacute;N ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['section']=$this->section->get($this->uri->segment(3));
	    $data['blocks']=$this->blocks;
		$data['query']=$this->model->get_all($this->uri->segment(3));
		$this->view($this->model->name.'/view',$data);
	}
	
	function insert(){
		$this->load->model('module');
		
		$data['title'] = "M&Oacute;DULOS DE SECCI&Oacute;N ";
		$data['heading'] = "INGRESO";
		$data['modules']=$this->module->get_list();
		$data['blocks']=$this->blocks;
		$data['section']=$this->section->get($this->uri->segment(3));
		
		if(isset($_POST['submit'])){
			unset($_POST['submit']);	    
			$_POST['position']=$this->model->get_max_priority($_POST['section_id'],$_POST['block'])+1;
   			$this->db->insert('modules_sections', $_POST);
   			redirect('modules_sections/index/'.$_POST['section_id']);
		}
		$this->view('modules_sections_vinsert',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
		$res=current($this->db->get('modules_sections')->result());
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('modules_sections'); 
        $query=$this->db->query("SELECT id, position
		   				         FROM modules_sections
		   				         WHERE section_id=".$this->uri->segment(4)." and block='".$res->block."'
		   				         ORDER BY position DESC");
   		foreach($query->result() as $row):
			if($row->position < $this->uri->segment(5)){
				$position['position']=$row->position+1;
				$this->db->where( 'id',$row->id);
   				$this->db->update('modules_sections', $position);
			}
		endforeach;
		redirect('modules_sections/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('modules_sections_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "M&Oacute;DULOS DE SECCI&Oacute;N ";
		$data['heading'] = "ACTUALIZAR";
		$data['blocks']=$this->blocks;
		$data['section']=$this->section->get($this->uri->segment(4));
		
		if(isset($_POST['submit'])){
			unset($_POST['submit']);	    
			$this->db->where('id',$_POST['id']);
   			$this->db->update('modules_sections', $_POST);
	    	redirect('modules_sections/index/'.$_POST['section_id']);	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']= $this->db->get('modules_sections');
		$data['query2']=$this->db->get('modules');
		$this->view('modules_sections_vupdate',$data);
	}
	
	
	function position_down(){
		$id=$this->uri->segment(3);
		$this->model->position_down($id);
		
		redirect($this->model->name.'/index/'.$this->uri->segment(4));
	}
	
	function position_up(){
		$id=$this->uri->segment(3);
		$this->model->position_up($id);
		
		redirect($this->model->name.'/index/'.$this->uri->segment(4));
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