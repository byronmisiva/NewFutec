<?php
class Blogs extends CI_Controller {
	
	var $positions;

	function __construct(){
		parent::__construct();
		$this->load->model('blog','model');
		$this->load->model('category');
		$this->load->model('image');
		$this->load->model('tag');
		$this->load->model('statistic');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('inflector');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('category_id', 'Categor&iacute;a', 'required');
		$this->form_validation->set_rules('title', 'Titulo', 'trim|required');
		$this->form_validation->set_rules('body', 'Cuerpo', 'required');
		$this->form_validation->set_rules('image_id', 'Imagen', 'required');
		$this->form_validation->set_rules('related', 'Relacionado', 'trim|required');
		$this->form_validation->set_rules('origen', 'Origen', 'trim|required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function publica(){
		$id=$this->uri->segment(3);
		if($id!=""){
			
			$this->load->model('section');
			//Defino primero el template publico para poder escribir ahi los modulos
			$this->template->set_template('public');
			$this->template->write('path',base_url(),TRUE);
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			$modulos->set_modulos(8);
			
			//Cargo las noticias rotativas
			$data['query']=$this->model->get_banner(5);
			$data['check']=0;
			$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
			
			$this->template->render();
			
		}
		else
			redirect();	
		
	}
	
	function index(){
		$data['title'] = "BLOGS ";
		$data['heading'] = "LISTADO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all($this->uri->segment(3),$this->session->userdata('userid'));
	    $data['categories']=$this->category->get_list();
	    $data['positions'] = $this->positions;
	    $this->view('blogs/view',$data);
	}	
	
	function insert(){
		$this->load->model('story_stat');
		
		$data['title'] = "BLOGS ";
		$data['heading'] = "INGRESO";
		$data['categories']=$this->category->get_list();
		$data['images']=$this->image->get_list();
		
		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
		$data['query']=$this->db->query('Select s.*
									     From  (Select id, name, sum
								 		 		From tags
								 		 		Order by sum desc
								 		 		Limit 0, 40) as s
								 		 Order by s.name asc');

		if(isset($_POST['submit'])){	
			if($_POST['image_id']=='')
   				$_POST['image_id']=NULL;
   				
   				$_POST['programed']=NULL;   			
   				$_POST['invisible']=0;

   				
   				
   				
   			$_POST['rate']=0;
   			$_POST['reads']=0;
   			$_POST['sends']=0;
   			$_POST['votes']=0;
   			$_POST['created']=mdate('%Y-%m-%d  %H:%i:%s',time());
   			$_POST['modified']=$_POST['created'];
   			
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$tag=$this->tag->insert_tag($_POST['related']);
				unset($_POST['related']);
				//$_POST['position']=10;
				$this->db->insert('stories', $_POST);
				$id=$this->db->insert_id();
				$this->tag->insert_story_tag($tag,$id);
				$this->story_stat->insert_story_stat($id);
				$this->send_tweet($_POST['title'],$id);
				redirect($this->model->name);	
	    	}	
		}
		$this->view($this->model->name.'/insert',$data);
	}
	
	
	function update(){
		$data['title'] = "BLOGS ";
		$data['heading'] = "ACTUALIZAR";
		$data['row']=$this->model->get($this->uri->segment(3));
		$data['categories']=$this->category->get_list();
		$data['images']=$this->image->get_list();
		$data['images_url']=$this->image->get_list_url('thumb100');
		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
		$data['query']=$this->db->query('Select s.*
									     From  (Select id, name, sum
								 		 		From tags
								 		 		Order by sum desc
								 		 		Limit 0, 40) as s
								 		 Order by s.name asc');
		$qtags=$this->db->query('Select distinct(t.id),t.name
										From tags as t, stories_tags as st, stories as s
										Where s.id='.$this->uri->segment(3).' and s.id=st.story_id and st.tag_id=t.id
										Order by t.name asc');
		$data['tags']='';
		foreach($qtags->result() as $row):
			$data['tags']=$data['tags'].';'.$row->name;
		endforeach;
		$data['tags']=$data['tags'].';';
		if(isset($_POST['submit'])){	
			if($_POST['image_id']=='')
   				$_POST['image_id']=NULL;	
   			$_POST['modified']=mdate('%Y-%m-%d  %H:%i:%s',time());

   			//Si pasa la validacion
			if($this->form_validation->run()==TRUE){
   				$_POST['invisible']=0;
				unset($_POST['submit']);
				$tag=$this->tag->insert_tag($_POST['related']);
				unset($_POST['related']);
				$this->db->where( 'id',$_POST['id']);
   				$this->db->update('stories', $_POST);
   				$this->tag->update_story_tag($tag,$_POST['id']);
   				redirect($this->model->name);
		    }	
		}		
		
		$this->view($this->model->name.'/update',$data);
	}	

	function delete(){
		if($this->model->delete($_POST['id']))
        	redirect($this->model->name);
	}
	
	
	function confirm_delete(){
		$data['id']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/confirm_delete',$data);	
	}

	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	
	function visited(){
		$data['title'] = "BLOG - MAS VISITADAS ";
		$data['heading'] = "";
		$data['datestring']="%Y-%m-%d  %H:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all_by($this->uri->segment(3),'reads');
	    $data['categories']=$this->category->get_list();
	    $data['positions'] = $this->positions;
	    $this->view($this->model->name.'/view_visited',$data);
	}
	
	
	function commented(){
		$data['title'] = "BLOGS MAS COMENTADAS ";
		$data['heading'] = "";
		$data['datestring']="%Y-%m-%d  %H:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_commented($this->uri->segment(3));
	    $data['categories']=$this->category->get_list();
	    $data['positions'] = $this->positions;
	    $this->view($this->model->name.'/view_commented',$data);
	}
	
	function list_plus(){
		$option=$this->uri->segment(3);
		$data['noticias']=$this->model->get_plus($option);
		switch($option){
    		case 'visitadas':
    			$this->load->view($this->model->name.'/plus_visited',$data);
    			break;
    		
    		case 'comentadas': 
    			$this->load->view($this->model->name.'/plus_comented',$data);	
    			break;
    			
    		case 'enviadas':
    			$this->load->view($this->model->name.'/plus_send',$data);
    			break;
    	}	
		
	}

	function more(){
		
		$max=$this->uri->segment(3);
		$section=$this->uri->segment(4);
		$num=15;
	
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(8,'laterals');
		
		$data['title']='Mas Noticias';
		$data['noticias']=$this->model->get_more_news($section,$this->uri->segment(5),$max,$num);
		$this->template->write_view('content', $this->model->name.'/more',$data, TRUE);
		
		
		//Cargo las noticias rotativas
		$data['query']=$this->model->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
		
		$this->template->render();
		
	}
	
	function more_ec(){
		
		$max=$this->uri->segment(3);
		$num=15;
	
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(8,'laterals');
		
		$data['title']='Ecuatorianos en el exterior';
		$data['noticias']=$this->model->get_more_news($this->uri->segment(4),$max,$num,18);
		$this->template->write_view('content', $this->model->name.'/more',$data, TRUE);
		
		
		//Cargo las noticias rotativas
		$data['query']=$this->model->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
		
		$this->template->render();
		
	}
	
	function send(){
		$this->load->model('user');
		$this->load->library('email');
		if($this->session->userdata('userid')!= false){
			if(isset($_POST['submit'])){
				$user=$this->user->get($this->session->userdata('userid'));
				$story=current($this->model->get($_POST['id']));
				$this->email->from($user->mail);
				$this->email->to($_POST['to']);
				$this->email->subject('Te han enviado una noticia desde futbolecuador.com');
				$data['datos']='Hola, '.$user->first_name.' '.$user->last_name." pensó que te podia interesar esta noticia:<br><br><br>";
				$data['datos'].=anchor('stories/publica/'.$story->id,$story->title);
				$data['datos'].="<br><br>Visita ".anchor('','futbolecuador.com')." donde podrás encontrar las ultimas noticias del futbol ecuatoriano.";
				$data['disclaimer']="Este es un mail autogenerado, por favor no hacer reply del mismo.";
				$body = $this->load->view('popups/mail_template',$data, true);
				$this->email->message($body);
				$this->email->send();
				$mensaje="<div id='mensaje'>La noticia ha sido enviada correctamente. <br><br>";
			    $mensaje.="<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
			    echo $mensaje;
			}
			else{
				$id=$this->uri->segment(3);
				$data['noticia']=$this->model->get_complete($id);
				$this->load->view('stories/send',$data);
			}
		}
		else{
			//Presento la confirmacion del mensaje enviado
		    $mensaje="<div id='mensaje'>Debes ser un usuario registrado para poder enviar noticias a un amigo. <br><br><ul>";
		    $mensaje.="<li><a href='' onClick='Modalbox.show(\"".base_url()."users/log_in\", {title: \" \", width: 400,overlayClose: true }); return false;' >Ingresa</a></li>";
		    $mensaje.="<li><a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></li></ul></div>";
		    echo $mensaje;
		}	
	}
	
	function imprimir(){
		$this->load->helper('html');
		$id=$this->uri->segment(3);
		$data['noticia']=$this->model->get_complete($id);
		$this->load->view('stories/print',$data);
	}
	
	function set_read(){
		if($this->config->item("encryption_key")==$this->uri->segment(4)){
			$this->model->set_read($this->uri->segment(3));
		}
	}
	
	function send_tweet($title,$id){
		$this->config->set_item('compress_output', 'FALSE');
		$this->load->library('twitter2');
		$auth=$this->twitter2->auth('futbolecuador', 'anarkia1611');
		$aux=$this->twitter2->update("$title - ".base_url().$id);
	}
	
	function fb_post(){
	    $data['noticias']=$this->model->get_by_position(1);
	    $this->load->view('blogs/fb_post',$data);
	}
	
	function fast_foward(){
		$last=$this->model->get_last();
		$last=$last->result();
		redirect(base_url().'stories/publica/'.$last[0]->id);
	}
}
?>