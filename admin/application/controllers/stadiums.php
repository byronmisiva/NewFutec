<?php
class Stadiums extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('capacity', 'Capacidad', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('city', 'Ciudad', 'required');
		$this->form_validation->set_rules('height', 'Altura', 'required|is_natural_no_zero');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='./imagenes/stadiums/';
   		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name'] = TRUE;
   		$this->load->library('upload',$config);
   		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index()
	{
		$config['base_url']=base_url().'/stadiums/index';
		$config['total_rows']=$this->db->count_all_results('stadia');
		$config['per_page']='10';
		$this->pagination->initialize($config);
		$data['title'] = "ESTADIOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $this->db->order_by('name','asc');
		$data['query']=$this->db->get('stadia', $config['per_page'], $this->uri->segment(3));
		$this->view('stadiums_view',$data);
	}	


	function insert()
	{
		$data['title'] = "ESTADIOS ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
					$upload=$this->upload->data();
					$_POST['image']='/imagenes/stadiums/'.$upload['file_name'];
	   			}
	   			$this->session->set_flashdata('upload_image',$this->upload->display_errors());
	   			$this->db->insert('stadia', $_POST);
	   			//redirect('stadiums/index');
		    }
		}
		$this->view('stadiums_vinsert',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('stadia'); 
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('stadiums');
	}
	
	function confirm_delete(){
		$this->load->view('stadiums_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "ESTADIOS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
				$upload=$this->upload->data();
				$_POST['image']='/imagenes/stadiums/'.$upload['file_name'];
	    	}
	   		$this->session->set_flashdata('upload_image',$this->upload->display_errors());
	    	$this->db->where( 'id',$_POST['id']);
        	$this->db->update('stadia', $_POST);
        	//redirect('stadiums');
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('stadia');
		$this->view('stadiums_vupdate',$data);
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