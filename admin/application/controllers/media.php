<?php
class Media extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('medias','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('type', 'Tipo', 'required');
		$this->form_validation->set_rules('description', 'Descripci&oacute;n', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='./archivos/media/';
   		$config['allowed_types']='mp3|mp4|avi|mov|flv';
   		$config['max_size']	= '100000';
		$config['encrypt_name'] = TRUE;
   		$this->load->library('upload',$config);
   		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index(){
		
		$data['title'] = "MEDIOS ";
		$data['heading'] = "ACCESO";
		$data['query']=$this->model->get_all($this->uri->segment(3));
		$this->view('media_view',$data);
	}	
	
	function publica(){
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		$this->template->write_view('content', 'media/public');
		
		//Cargo las noticias rotativas
		$this->load->model('story');
		$data['query']=$this->story->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
		
		$this->template->render();
	
	}

	function insert(){
		$tags='';
		$this->template->add_js('js/ajax.js');
		$data['title'] = "MEDIOS ";
		$data['heading'] = "INGRESO";
		$data['query']=$this->db->query('Select id, name
									     From  sections
								 		 Order by name asc');
		if(isset($_POST['submit'])){
			if($this->form_validation->run()==TRUE){
				$tag=$_POST['related'];
				unset($_POST['related']);
				unset($_POST['submit']);
				if(!$this->upload->do_upload('file')){
					echo $this->upload->display_errors();
		    		$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
		    		$this->db->insert('media', $_POST);
	   			}
	   			else{
					$upload=$this->upload->data();
					$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
					$_POST['file']='archivos/media/'.$upload['file_name'];
					$this->db->insert('media', $_POST);
					$id=$this->db->insert_id();
					$this->model->insert_tag($tag,$id);
   				}
   				$this->session->set_flashdata('image_errors',$this->upload->display_errors());
		    	redirect('media/index');
			}	
		}
		$this->view('media_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('media');
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('media');
	}

	function confirm_delete(){
		$this->load->view('media_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "MEDIOS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				if($this->upload->do_upload('file')){
					$upload=$this->upload->data();
					$_POST['file']='archivos/media/'.$upload['file_name'];
					$this->db->where( 'id',$_POST['id']);
	        		$this->db->update('media', $_POST); 
		    	}
		    	else{
		    		$this->db->where( 'id',$_POST['id']);
	        		$this->db->update('media', $_POST);
		    	}
		    	$this->session->set_flashdata('image_errors',$this->upload->display_errors());
		    	redirect('media/index');
			}
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('media');
		$this->view('media_vupdate',$data);
	}
		
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function xml(){//TODO: cambiar en flash
		//Recojo datos de la base
		$this->output->cache(5);
		if($this->config->item("encryption_key")==$this->uri->segment(3)){
			$this->load->model('statistic');
			$data['name']='XML Media';
			$data['views']=1;
			//$this->statistic->sum($data);
			$medias=$this->model->get_media($this->uri->segment(4),$this->uri->segment(5));
			
			$response= "<?xml version='1.0' encoding='utf-8'?>\n";
			
			$response.="<lista>\n";
			
			foreach($medias as $row){
				$response.="<cancion>\n";
				$response.="<nombre>".$row->name."</nombre>\n";//html_entity_decode($this->model->format(htmlentities($row->name)))
				if(strpos($row->file,'http')===FALSE){
					$response.="<url>".base_url().$row->file."</url>\n";
				}
				else{
					$response.="<url>".$row->file."</url>\n";
				}
				$response.="<texto>".mb_convert_encoding($row->description, 'UTF-8', 'HTML-ENTITIES')."</texto>\n"; //TODO: TEXT AREA PROBLEMA RESULETO UTF8
				$response.="</cancion>\n";
			}
			
			$response.="</lista>\n";
			header('Content-type: text/xml');
			$data['response']=$response;
			$this->load->view('xmls/game_all',$data); 
		}
	}
	
	function xml_section(){
		//Recojo datos de la base
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->segment(3)){
			$this->load->model('statistic');
			$data['name']='XML Media Por Seccion';
			$data['views']=1;
			$this->statistic->sum($data);
			$medias=$this->model->get_media_section($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6));
			
			$response="<lista>";
			
			foreach($medias as $row){
				$response.="<cancion>";
				$response.="<nombre>$row->name</nombre>";
				if(strpos($row->file,'http')===FALSE){
					$response.="<url>".base_url().$row->file."</url>";
				}
				else{
					$response.="<url>".$row->file."</url>";
				}
				$response.="<texto>".mb_convert_encoding(strip_tags($row->description), 'UTF-8', 'HTML-ENTITIES')."</texto>\n";
				$response.="</cancion>";
			}
			
			$response.="</lista>";
			header('Content-type: text/xml');
			$data['request']=$response;
			$this->load->view('xmls/podcast_sections',$data);
		}
	}
}