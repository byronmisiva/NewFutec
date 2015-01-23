<?php
class Banners extends CI_Controller {
	
	var $folder_views;

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
		$this->form_validation->set_rules('start', 'Inicio', 'required');
		$this->form_validation->set_rules('end', 'F&iacute;n', 'required');
		$this->form_validation->set_rules('link', 'Enlace', '');
		$this->form_validation->set_rules('code', 'C&oacutedigo', '');
		$this->form_validation->set_rules('width', 'Ancho', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('height', 'Altura', 'required|is_natural_no_zero');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='./imagenes/banner/';
   		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name'] = TRUE;
   		$this->load->library('upload',$config);
   		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
		$this->folder_views='banners';
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function index()
	{
		$config['base_url']=base_url().'banner/index/'.$this->uri->segment(3);
		$row=current($this->db->query('SELECT COUNT(*) AS numrows FROM banners where module_id = '.$this->uri->segment(3))->result());
		$config['total_rows']=$row->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "BANNERS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT b.id,name,m.title,file,image,link,start,end,prints,clicks,total,b.position,code,width,height 
						  				 FROM (banners as b, modules as m)
						  				 WHERE b.module_id = m.id and m.id=".$this->uri->segment(3).' 
						  				 ORDER BY b.position DESC '.$pagina);
	    
		$this->view($this->folder_views.'/banner_view',$data);
	}	

	function insert()
	{
		$data['title'] = "BANNERS ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				if($_POST['width']=='')
   					$_POST['width']=NULL;
   				if($_POST['height']=='')
   					$_POST['height']=NULL;
				unset($_POST['submit']);
				if($this->upload->do_upload('image')){
   					$upload=$this->upload->data();
					$_POST['image']='/imagenes/banner/'.$upload['file_name'];
	   			}	
	   			$this->session->set_flashdata('errors_image', $this->upload->display_errors());
	   			$this->change_config();
	   			if($this->upload->do_upload('file')){	
	   				$upload=$this->upload->data();
					$_POST['file']='archivos/banner/'.$upload['file_name'];
	   			}
				$this->session->set_flashdata('errors_file', $this->upload->display_errors());
	   			$_POST['position']=$this->position($_POST['module_id'])+1;
	   			$code=$_POST['code'];
				$this->db->insert('banners', $_POST);
				$this->db->query('UPDATE banners set code="'.htmlentities($code).'" where id='.$_POST['id']);
		    	redirect('banners/index/'.$_POST['module_id']);
			    }	
		}
		$this->view($this->folder_views.'/banner_vinsert',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('banners'); 
        $query=$this->db->query("SELECT id, position
		   				         FROM banners
		   				         WHERE module_id=".$this->uri->segment(4)."
		   				         ORDER BY position DESC");
   		foreach($query->result() as $row):
			if($row->position < $this->uri->segment(5)){
				$position['position']=$row->position+1;
				$this->db->where( 'id',$row->id);
   				$this->db->update('banners', $position);
			}
		endforeach;
		redirect($this->folder_views.'/banners/index/'.$this->uri->segment(4));
	}	
	
	function confirm_delete(){
		$this->load->view($this->folder_views.'/banner_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "BANNERS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	
			$code=$_POST['code'];
			if($this->form_validation->run()==TRUE){
				if($_POST['width']=='')
   					$_POST['width']=NULL;
   				if($_POST['height']=='')
   					$_POST['height']=NULL;
				unset($_POST['submit']);
				if(isset($_FILES)){
					if(isset($_FILES)){
						if($this->upload->do_upload('image')){
							$upload=$this->upload->data();
							$_POST['image']='imagenes/banner/'.$upload['file_name'];	
			   			}	
					}
		   			$this->session->set_flashdata('errors_image', $this->upload->display_errors());
		   			$this->change_config();
		   			if($this->upload->do_upload('file')){
						$upload=$this->upload->data();
						$_POST['file']='archivos/banner/'.$upload['file_name'];
		   			}
				}
	   			$this->session->set_flashdata('errors_file', $this->upload->display_errors());
	   			
	   			$this->db->where( 'id',$_POST['id']);
	   			$this->db->update('banners', $_POST);
	   			$this->db->query('UPDATE banners set code="'.htmlentities($code).'" where id='.$_POST['id']);
	   			//redirect('banners/index/'.$_POST['module_id']);
	   			
			    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=current($this->db->get('banners')->result());
		$this->view($this->folder_views.'/banner_vupdate',$data);
	}	
	
	function change_config()
	{
		$config['upload_path']='./archivos/banner/';
   		$config['allowed_types']='mp3|mp4|avi|mov|flv|swf';
   		$config['max_size']	= '100000';
		$config['encrypt_name'] = TRUE;
   		$this->upload->initialize($config);
	}	
	
	function position($module)
	{
		$row=$this->db->query("SELECT MAX(position) as position
		   				       FROM banners
		   				       WHERE module_id=".$module)->result(0);
		return $row[0]->position;
	}
	
	function position_up()
	{
		$row=$this->db->query("SELECT MAX(position) as position
		   				       FROM banners
		   				       WHERE module_id=".$this->uri->segment(4))->result(0);
		$row2=$this->db->query("SELECT position
								FROM banners
								WHERE id=".$this->uri->segment(3))->result(0);
		$row3=$this->db->query("SELECT MIN(position) as position
		   				        FROM banners
		   				        WHERE module_id=".$this->uri->segment(4))->result(0);
		if($row2[0]->position==$row[0]->position)
		{
			$position['position']=$row3[0]->position-1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('banners', $position);
		}
		else
		{
			$query=$this->db->query("SELECT id, position
		   				       		 FROM banners
		   				       		 WHERE module_id=".$this->uri->segment(4)."
		   				       		 ORDER BY position DESC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->position==$row2[0]->position+1)
					$aux=1;
				if($row->position!=$row2[0]->position+1)
				{
					$position['position']=$row->position+1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('banners', $position);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('banners/index/'.$this->uri->segment(4));
	}
	
	function position_down()
	{
		$row=$this->db->query("SELECT MAX(position) as position
		   				       FROM banners
		   				       WHERE module_id=".$this->uri->segment(4))->result(0);
		$row2=$this->db->query("SELECT position
								FROM banners
								WHERE id=".$this->uri->segment(3))->result(0);
		$row3=$this->db->query("SELECT MIN(position) as position
		   				        FROM banners
		   				        WHERE module_id=".$this->uri->segment(4))->result(0);
		if($row2[0]->position==$row3[0]->position)
		{
			$position['position']=$row[0]->position+1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('banners', $position);
		}
		else
		{
			$query=$this->db->query("SELECT id, position
		   				       		 FROM banners
		   				       		 WHERE module_id=".$this->uri->segment(4)."
		   				       		 ORDER BY position ASC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->position==$row2[0]->position-1)
					$aux=-1;
				if($row->position!=$row2[0]->position-1)
				{
					$position['position']=$row->position-1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('banners', $position);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('banners/index/'.$this->uri->segment(4));
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
	
	
	function test(){
		$this->load->view('banners/test');
	}
}
?>