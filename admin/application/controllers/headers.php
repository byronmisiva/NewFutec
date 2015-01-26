<?php
class Headers extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$config['upload_path']='./imagenes/header/';
   		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name'] = TRUE;
   		$this->load->library('upload',$config);
   		$this->form_validation->set_rules('name', 'Nombre', 'required');
   		$this->form_validation->set_rules('width', 'Ancho', 'is_natural_no_zero');
   		$this->form_validation->set_rules('height', 'Altura', 'is_natural_no_zero');
   		$this->form_validation->set_rules('description', 'Descripci&oacute;n', '');
   		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index()
	{
		$config['base_url']=base_url().'/headers/index';
		$config['total_rows']=$this->db->count_all_results('headers');
		$config['per_page']='10';
		$this->pagination->initialize($config);
		$data['title'] = "ENCABEZADO ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $this->db->orderby('name','asc');
		$data['query']=$this->db->get('headers', $config['per_page'], $this->uri->segment(3));
		$this->view('headers_view',$data);
	}	

	function insert()
	{
		$data['title'] = "ENCABEZADO ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	
			if($_POST['width']=='')
   				$_POST['width']=NULL;
   			if($_POST['height']=='')
   				$_POST['height']=NULL;    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if(!$this->upload->do_upload('file')){
   					$this->session->set_flashdata('errors_upload_file', $this->upload->display_errors());
	    			$this->db->insert('headers', $_POST);
					redirect('headers/index');
   				}
   				else{
					$data=$_POST;
					$upload=$this->upload->data();
					$data['file']='/imagenes/header/'.$upload['file_name'];
					$this->db->insert('headers', $data);
					redirect('headers/index');
   				}
		    }	
		}	
		$this->view('headers_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('headers'); 
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('headers/index');
	}
	
	function confirm_delete(){
		$this->load->view('headers_confirm_delete');	
	}
	
	function update()
	{
		$data2['title'] = "ENCABEZADO ";
		$data2['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){
			if($_POST['width']=='')
   				$_POST['width']=NULL;
   			if($_POST['height']=='')
   				$_POST['height']=NULL;
   			if($this->form_validation->run()==TRUE){
   				unset($_POST['submit']);
   				if($this->upload->do_upload('file')){
					$data=$_POST;
					$upload=$this->upload->data();
					$data['file']='/imagenes/header/'.$upload['file_name'];
					$this->db->where( 'id',$_POST['id']);
        			$this->db->update('headers', $data); 
	    		}
	    		else{
	    			$this->session->set_flashdata('errors_upload_file', $this->upload->display_errors());
	    			$data = array('name' => $_POST['name'], 'width' => $_POST['width'], 'height' => $_POST['height'], 'description' => $_POST['description']);
	    			$this->db->where( 'id',$_POST['id']);
        			$this->db->update('headers', $data);
	    		}
        		redirect('headers/index');
   			}
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data2['query']=$this->db->get('headers');
		$this->view('headers_vupdate',$data2);
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