<?php
class Profiles extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('profile','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Titulo', 'required');
		$this->form_validation->set_rules('text', 'Texto', 'required');
		$this->form_validation->set_rules('picture_box', 'Imagen Recuadro', 'callback_upload_image');
		$this->form_validation->set_rules('picture1', 'Foto 1', 'callback_upload_image');
		$this->form_validation->set_rules('picture2', 'Foto 2', 'callback_upload_image');
		$this->form_validation->set_rules('picture3', 'Foto 3', 'callback_upload_image');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		
		$this->init_images=array('picture_box'=>'picture_box','picture1'=>'picture1','picture2'=>'picture2',
								'picture3'=>'picture3');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/profiles/index/'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM profiles where player_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment']='4';
		$this->pagination->initialize($config);
		$data['title'] = "PERFILES ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query('SELECT p.id,l.first_name,l.last_name,p.created,p.title,p.text, UNIX_TIMESTAMP(p.created) as ucreated
						  				 FROM profiles as p , players as l
						 				 WHERE p.player_id=l.id and l.id='.$this->uri->segment(3).' 
						 				 ORDER BY title asc '.$pagina);
		$cn=$this->db->query("SELECT p.first_name,p.last_name
							  FROM players as p
							  WHERE p.id=".$this->uri->segment(3))->result();
	    $data['from']=strtoupper($cn[0]->first_name.' '.$cn[0]->last_name);
	    $this->view('profiles/view',$data);
	}	
	
    function publica(){
		$id=$this->uri->segment(3);
		if($id!=""){
			$data['profile']=$this->model->get($id);
			
			//Defino primero el template publico para poder escribir ahi los modulos
			$this->template->set_template('public');
			$this->template->write('title','futbolecuador.com - '.$data['profile']->title,TRUE);
			$this->template->write('path',base_url(),TRUE);
			
			//centro
			$this->template->write_view('content', 'profiles/public', $data, FALSE);
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			$modulos->set_modulos(8,'laterals');

			$this->template->render();
			
			$this->model->set_read($id);
		}
		else
			redirect();	
		
	}

	function insert()
	{
		$this->load->library('upload');
		
		$data['title'] = "PERFILES ";
		$data['heading'] = "INGRESO";
		
		foreach($this->init_images as $key=>$value)
			$_POST[$key]=$value;
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				$profile['player_id']=$_POST['player_id'];
				$profile['title']=$_POST['title'];
				$profile['text']=$_POST['text'];
				$profile['picture_box']=$_POST['picture_box'];
				$profile['picture1']=$_POST['picture1'];
				$profile['picture2']=$_POST['picture2'];
				$profile['picture3']=$_POST['picture3'];
				$profile['created']=mdate("%Y-%m-%d  %h:%i:%s",time());
		

   				$this->db->insert('profiles', $profile);
	    		redirect('profiles/index/'.$_POST['player_id']);
		    }	
		}
		$this->view('profiles/insert',$data);
	}
	
	function update()
	{
		$this->load->library('upload');
		
		$data['title'] = "PERFILES ";
		$data['heading'] = "ACTUALIZAR";
		
		foreach($this->init_images as $key=>$value)
			$_POST[$key]=$value;
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				$profile['player_id']=$_POST['player_id'];
				$profile['title']=$_POST['title'];
				$profile['text']=$_POST['text'];
				if(isset($_POST['picture_box']))
					$profile['picture_box']=$_POST['picture_box'];
				if(isset($_POST['picture1']))
					$profile['picture1']=$_POST['picture1'];
				if(isset($_POST['picture2']))
					$profile['picture2']=$_POST['picture2'];
				if(isset($_POST['picture3']))
					$profile['picture3']=$_POST['picture3'];
				
				$this->db->where( 'id',$_POST['id']);
   				$this->db->update('profiles', $profile);
   				redirect('profiles/index/'.$_POST['player_id']);
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('profiles');
		$this->view('profiles/update',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('profiles'); 
		redirect('profiles/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('profiles/confirm_delete');	
	}
	
	
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	/*FUNCIONES PRIVADAS*/
	
	function upload_image(&$field){
		
		if(!empty($_FILES[$field]['name'])){
			$this->change_config_upload($field);
			if($this->upload->do_upload($field)){
				$upload=$this->upload->data();
				$field='imagenes/'.$this->model->name.'/'.$field.'/'.$upload['file_name'];
				return TRUE;
	   		}	
	   		else{
	   			$this->form_validation->set_message('upload_image', $this->upload->display_errors());
	   			return FALSE;
	   		}
	   	}
		else{
			unset($_POST[$field]);
			$field="";
   			return TRUE;
		}
	}
	
	
 	function change_config_upload($field){
		$config['upload_path']='./imagenes/'.$this->model->name.'/'.$field.'/';
		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100000';
   		$config['max_width']  = '1024000';
		$config['max_height']  = '768000';
		$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);
	}
}
?>