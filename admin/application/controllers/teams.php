<?php
class Teams extends CI_Controller {
	
	var $init_images;
	var $continents;
	var $folder_views;
	
	function __construct(){
		parent::__construct();
		$this->load->model('team','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('country', 'Pa&iacute;s', 'required');
		$this->form_validation->set_rules('continent', 'Continente', 'required');
		$this->form_validation->set_rules('short_name', 'Nombre Corto', 'required');
		$this->form_validation->set_rules('couch', 'Entrenador', 'required');
		$this->form_validation->set_rules('stadia_id', 'Estadio', '');
		$this->form_validation->set_rules('president', 'Presidente', 'required');
		$this->form_validation->set_rules('foundation', 'Fundaci&oacute;n', 'required');
		$this->form_validation->set_rules('site', 'Estadio', '');
		$this->form_validation->set_rules('non_site', 'Estadio', '');
		
		$this->form_validation->set_rules('shield', 'Escudo izquierdo', 'callback_upload_image');
		$this->form_validation->set_rules('thumb_shield', 'Mini-Escudo izquierdo', 'callback_upload_image');
		$this->form_validation->set_rules('shield2', 'Escudo derecho', 'callback_upload_image');
		$this->form_validation->set_rules('thumb_shield2', 'Escudo derecho mini', 'callback_upload_image');
		$this->form_validation->set_rules('mini_shield', 'Mini-Escudo derecho', 'callback_upload_image');
		$this->form_validation->set_rules('shirt', 'Camiseta', 'callback_upload_image');
		$this->form_validation->set_rules('shirt2', 'Camiseta Alterna', 'callback_upload_image');
		$this->form_validation->set_rules('mini_shirt', 'Mini-Camiseta', 'callback_upload_image');
		$this->form_validation->set_rules('team_pic', 'Foto del Equipo', 'callback_upload_image');
		
		$this->init_images=array('shield'=>'shield','thumb_shield'=>'thumb_shield','shield2'=>'shield2',
								'thumb_shield2'=>'thumb_shield2','mini_shield'=>'mini_shield',
								'shirt'=>'shirt','shirt2'=>'shirt2','mini_shirt'=>'mini_shirt',
								'team_pic'=>'team_pic');
		
		$this->continents=array(''=>'Seleccione un Continente...','Africa'=>'Africa','Asia'=>'Asia',
								'Centroamérica'=>'Centroamérica','Europa'=>'Europa','Norteamérica'=>'Norteamérica',
								'Oceanía' => 'Oceanía','Sudamérica'=>'Sudamérica');


   		$this->template->add_js('js/calendar.js');
		$this->template->add_css('css/calendar.css');
		
		$this->folder_views='teams';
   		
   		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
	
	
	function publica(){
		$id=$this->uri->segment(3);
		if($id!=""){
			$this->load->model('section');
			//Defino primero el template publico para poder escribir ahi los modulos
			$this->template->set_template('public');
			$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
			$this->template->write('path',base_url(),TRUE);
			
			//centro
			
			$dts=$this->section->get($this->uri->segment(3));
			$champ=$dts->championship_id;
			$team=$dts->team_id;
			$name=$this->model->get($team)->row();
			$data['name']=$name->name;
			$data['striker']=$this->model->striker_championship($champ,$team);
			$this->template->write_view('content', 'public/statistics_players', $data, FALSE);
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			$modulos->set_modulos(0,'laterals');
			
			$this->template->render();
		}
		else
			redirect();	
	}
	
	
	function index(){
		
		if($this->uri->segment(3)!='')
			$result=$this->model->get_all_letter($this->uri->segment(3),$this->uri->segment(4));
		else
			$result=$this->model->get_all_letter('A');

		$data['title'] = "EQUIPOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		$data['query']=$result;
		$this->view($this->folder_views.'/teams_view',$data);
	}	

	function insert(){
		$this->load->library('upload');
		$this->load->model('country');
		
		foreach($this->init_images as $key=>$value)
			$_POST[$key]=$value;
			
		if(isset($_POST['submit']) and $this->form_validation->run()==TRUE){	    
			
			unset($_POST['submit']);
			if($_POST['stadia_id']=='')
   				$_POST['stadia_id']=NULL;
   			   				   				
   			$this->db->insert('teams',$_POST);
   			
   			$letter=strtoupper(substr($_POST['name'],0,1));
   			redirect('teams/index/'.$letter);
		    
		}
		
		/*PRESENTACION*/
		
		$data['title'] = "EQUIPOS ";
		$data['heading'] = "INGRESO";
		$data['query']=$this->db->get('stadia');
		$data['countries']=$this->country->get_list_name();
		$data['continents']=$this->continents;
		$this->view($this->folder_views.'/teams_vinsert',$data);
	}
	
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('teams'); 
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
        redirect('teams');
	}
	
	
	function confirm_delete(){
		$this->load->view($this->folder_views.'/teams_confirm_delete');	
	}
		
	
	function update(){
		$this->load->library('upload');
		$this->load->model('country');

		foreach($this->init_images as $key=>$value)
			$_POST[$key]=$value;
			
		if(isset($_POST['submit']) and $this->form_validation->run()==TRUE){    
			if($_POST['stadia_id']=='')
   				$_POST['stadia_id']=NULL;
			unset($_POST['submit']);

   			$this->db->where( 'id',$_POST['id']);
   			$this->db->update('teams',$_POST);
   			$letter=strtoupper(substr($_POST['name'],0,1));
   			redirect('teams/index/'.$letter);
	    
		}
		
		/*PRESENTACION*/
		
		$data['title'] = "EQUIPOS ";
		$data['heading'] = "ACTUALIZAR";
		$data['countries']=$this->country->get_list_name();
		$data['continents']=$this->continents;
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('teams');
		$data['query2']=$this->db->get('stadia');
		$this->view($this->folder_views.'/teams_vupdate',$data);
	}
	
		
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	
	function ultimos(){
		$this->output->cache(CACHE_DEFAULT);
		$data=$this->model->get_results($this->uri->segment(3),8);
		$data['team']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/results', $data, FALSE);
	}
	
	
	function por_jugar(){
		$this->output->cache(CACHE_DEFAULT);
		$data=$this->model->get_results($this->uri->segment(3),0);
		$data['team']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/por_jugar', $data, FALSE);
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