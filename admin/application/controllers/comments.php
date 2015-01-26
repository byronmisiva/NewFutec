<?php
class Comments extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('comment','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('text', 'Texto', 'required');
		$this->form_validation->set_rules('aproved', 'Estado', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	function index(){
		$data['title'] = "COMENTARIOS ";
		$data['heading'] = "LISTADO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all($this->uri->segment(3));
	    
	    $this->view($this->model->name.'/view',$data);
	
	}	
	
	function unaproved(){
		$data['title'] = "COMENTARIOS ";
		$data['heading'] = "NO APROBADOS";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_aproved($this->uri->segment(3),false);
	    
	    $this->view($this->model->name.'/view_unaproved',$data);
	}
	
	function aproved(){
		$data['title'] = "COMENTARIOS ";
		$data['heading'] = "APROBADOS";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_aproved($this->uri->segment(3));
	    
	    $this->view($this->model->name.'/view_aproved',$data);
	}
	
	function aprove(){
		$this->load->model('user');
		
		$comment=$this->model->get($this->uri->segment(3));
		$this->model->set_aprove($this->uri->segment(3),'1');
		$this->user->rate($comment->user_id,'+');
		redirect($this->model->name.'/unaproved');
	}
	
	function unaprove(){
		$this->load->model('user');
		
		$comment=$this->model->get($this->uri->segment(3));
		$this->model->set_aprove($this->uri->segment(3),'2');
		$this->user->rate($comment->user_id,'-');
		redirect($this->model->name.'/unaproved');
	}

	function insert()
	{
		$data['title'] = "COMENTARIOS ";
		$data['heading'] = "INGRESO";
		$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert($this->model->name, $_POST);
	    		redirect('comments/index/'.$_POST['story_id']);
		    }	
		}
		$this->view($this->model->name.'/insert',$data);
	}
	
	function add(){
		$this->load->model('user');
		$this->load->model('story');
		
		$user=$this->user->get($_POST['user_id']);
		$story=current($this->story->get($_POST['story_id']));
		
		$this->config->set_item('compress_output', 'FALSE');
		unset($_POST['envio']);
		$data['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
		$data['aproved']=0;
		$data['user_id']=$_POST['user_id'];
		$data['story_id']=$_POST['story_id'];
		$data['comment_id']=$_POST['comment_id'];
		$data['text']=$_POST['text'];
		
		$this->db->insert($this->model->name, $data);
		
		if(substr($user->description,0,3)=="fb:"){
			$this->load->library('facebook_connect');
			$attachment = array( 'name' => $story->title, 'href' => base_url().$story->id, 'caption' => '{*actor*} hizo un comentario en esta noticia de futbolecuador.com', 'description' => strip_tags(mb_convert_encoding($story->lead, 'UTF-8','HTML-ENTITIES')));
			$action_links = array( array('text' =>'Ir a la noticia', 'href' => base_url().$story->id)); 
			$this->facebook_connect->client->stream_publish($_POST['text'],$attachment,$action_links);
		}
		
		echo "<div id='error'>El comentario ha sido ingresado con exito, se publicará despues de ser aprobado por nuestros administradores.</div>";	
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
		$data['title'] = "COMENTARIOS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
   				$this->db->update('comments', $_POST);
   				redirect($this->model->name);
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('comments');
		$this->view($this->model->name.'/update',$data);
	}
	
	function respond(){
		$data['title'] = "COMENTARIOS ";
		$data['heading'] = "INGRESO";
		$data['comment']=$this->model->get($this->uri->segment(3));
		$data['user']=$this->session->userdata('userid');
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
				$this->db->insert($this->model->name, $_POST);
	    		redirect('comments/index/'.$_POST['story_id']);
		    }	
		}
		
		$this->view($this->model->name.'/respond',$data);
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
	
	function get_all(){
		$data['comments']=$this->model->get_all_by_story($this->uri->segment(3),0);
		$data['total']=$this->model->count_all($this->uri->segment(3));
		$this->load->view($this->model->name.'/all_comments',$data);
	}
	
	function add_comment(){
		$this->config->set_item('compress_output', 'FALSE');
		$data['story']=$this->uri->segment(3);
		$data['user']=$this->session->userdata('userid');
		$data['comment_id']=0;
		
		if($data['user']>0){
			$this->load->view($this->model->name.'/add_comment',$data);
		}
		else{
			echo "<div id='error'>Para ingresar un comentario debes ser un usuario registrado.<br><br>";
			echo "<a href='' onClick='Modalbox.show(\"".base_url()."users/log_in\", {title: \" \", width: 400}); return false;'>Ingresar</a></div>";
		}
	}
	
	function edit_comment(){
		$data['id']=$this->uri->segment(3);
		$data['comment']=$this->model->get($data['id']);
		
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			$_POST['aproved']=0;
			$this->db->where( 'id',$_POST['id']);
   			$this->db->update('comments', $_POST);
   			redirect('users/profile');	
		}
		
		$this->load->view($this->model->name.'/edit_comment',$data);
	}
		
}
?>