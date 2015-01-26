<?php
class Referee extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('first_name', 'Nombre', 'required');
		$this->form_validation->set_rules('last_name', 'Apelido', 'required');
		$this->form_validation->set_rules('birth', 'Fecha de Nacimiento', 'required');
		$this->form_validation->set_rules('born_place', 'Lugar de Nacimineto', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='./imagenes/referee/referee/';
   		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100000';
		$config['max_width']  = '2600';
		$config['max_height']  = '2600';
		$config['encrypt_name'] = TRUE;
   		$this->load->library('upload',$config);		
   		$this->load->library('image_lib');
   		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
	}
	
	function index()
	{	
		$config['base_url']=base_url().'/referee/index';
		$config['total_rows']=$this->db->count_all_results('referee');
		$config['per_page']='10';
		$this->pagination->initialize($config);
		$data['title'] = "&Aacute;RBITRO ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $this->db->order_by('last_name','asc');
	    $this->db->select('*,UNIX_TIMESTAMP(birth) as Ubirth');
		$data['query']=$this->db->get('referee', $config['per_page'], $this->uri->segment(3));
		$this->view('referee_view',$data);
	}	

	function insert()
	{
		$data['title'] = "&Aacute;RBITRO ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
					$upload=$this->upload->data();
					$_POST['image']='/imagenes/referee/referee/'.$upload['file_name'];
					$_POST['thumb']="/imagenes/referee/thumb/".$upload['file_name'];
					$dimension['file_name']=$upload['full_path'];
					$dimension['width']=150;
					$this->images_thumb($dimension);
	   			}		
	   			$this->session->set_flashdata('image_error',$this->upload->display_errors());	
				$this->db->insert('referee', $_POST);
   				redirect('referee/index');
		    }	
		}
		$this->view('referee_vinsert',$data);
	}


	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('referee'); 
        if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
        redirect('referee');
	}
	
	function confirm_delete(){
		$this->load->view('referee_confirm_delete');	
	}

	function update()
	{
		$data['title'] = "&Aacute;RBITRO ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
					$upload=$this->upload->data();
					$_POST['image']='/imagenes/referee/referee/'.$upload['file_name'];
					$_POST['thumb']="/imagenes/referee/thumb/".$upload['file_name'];
					$dimension['file_name']=$upload['full_path'];
					$dimension['width']=150;
					$this->images_thumb($dimension);
	    		}		
	   			$this->session->set_flashdata('image_error',$this->upload->display_errors());
	    		$this->db->where( 'id',$_POST['id']);
        		$this->db->update('referee', $_POST);
        		redirect('referee');
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('referee');
		$this->view('referee_vupdate',$data);
	}
	
	function images_thumb($dimension)
	{
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $dimension['file_name'];
		$config['new_image']='/imagenes/referee/thumb/';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = $dimension['width'];
		$config['height'] = $dimension['width'];
		$config['master_dim']='width';
		$this->image_lib->initialize($config); 
		$this->image_lib->resize();
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
