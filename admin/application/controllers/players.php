<?php
class Players extends CI_Controller {
	
	var $thumb_width;
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
		$this->load->model('player','model');
		$this->form_validation->set_rules('first_name', 'Nombre', 'required');
		$this->form_validation->set_rules('last_name', 'Apellido', 'required');
		$this->form_validation->set_rules('details', 'Detalles', '');
		$this->form_validation->set_rules('birth', 'Fecha de Nacimiento', '');
		$this->form_validation->set_rules('born_place', 'Lugar de Nacimiento', 'required');
		$this->form_validation->set_rules('height', 'Altura', '');
		$this->form_validation->set_rules('position', 'Posici&oacute;n', 'required');
		$this->form_validation->set_rules('nick', 'apodo', '');
		$this->form_validation->set_rules('price', 'Precio', 'required');
		$this->form_validation->set_rules('stock', 'Limite', 'required');
		$this->form_validation->set_rules('image', 'Foto', 'callback_upload_image');
		
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$config['upload_path']='../imagenes/players/players/';
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
		
		$this->folder_views='players';
		
		$this->thumb_width=80;
		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
		
	}
	
	function index()
	{
		$config['base_url']=base_url().'/players/index/'.$this->uri->segment(3);
	    if($this->uri->segment(3)=='ABC')
	    	$config['total_rows']=$this->db->count_all_results('players');
	    else{
			$row=current($this->db->query("SELECT COUNT(*) AS numrows FROM players WHERE last_name LIKE '".$this->uri->segment(3)."%' ")->result());
			$config['total_rows']=$row->numrows;
		}
		$config['per_page']=30;
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "JUGADORES ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['page']=$this->uri->segment(4);
	    if(!$this->uri->segment(4)==''){
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    	
	    }
	    else{
	    	$pagina="LIMIT ".$config['per_page'];
	    }	
	    if($this->uri->segment(3)=='ABC'){	
	   		$data['query']=$this->db->query("SELECT *, UNIX_TIMESTAMP(birth) as Ubirth
	   										 FROM players 
	   										 ORDER BY last_name asc ".$pagina);
		}
		else{
	   		$data['query']=$this->db->query("SELECT *, UNIX_TIMESTAMP(birth) as Ubirth
										 	 FROM players
									     	 WHERE last_name LIKE '".$this->uri->segment(3)."%' 
									     	 ORDER BY last_name asc ".$pagina);
		}
		$this->view($this->folder_views.'/players_view',$data);
	}	

	function insert()
	{
		$data['title'] = "JUGADORES ";
		$data['heading'] = "INGRESO";
		$_POST['image']='image';
		if(isset($_POST['submit']) && $this->form_validation->run()==TRUE){	    
			unset($_POST['submit']);
			$letter=substr($_POST['last_name'],0,1);
			if($_POST['image']!=''){
				$file_name=substr(strrchr($_POST['image'],'/'),1);
				
				$_POST['thumb']="imagenes/players/thumb/".$file_name;
				$_POST['thumb220']="imagenes/players/thumb220/".$file_name;
				
				//Thumb
				$dimension['file_name']='./'.$_POST['image'];
				$dimension['width']=$this->thumb_width;
				$dimension['path']='../imagenes/players/thumb/';
				$this->images_thumb($dimension);
				
				//Thumb 220
				$dimension['file_name']='./'.$_POST['image'];
				$dimension['width']=220;
				$dimension['path']='../imagenes/players/thumb220/';
				$this->images_thumb($dimension);
			}

			$this->db->insert('players', $_POST);
   			redirect('players/index/'.$letter);
	    	
		}
		
		$data['countries']=$this->db->query('Select name From countries Order by name asc');
		$this->view($this->folder_views.'/players_vinsert',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('players'); 
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('players/index/'.$this->uri->segment(4));
	}
		
	
	function confirm_delete(){
		$this->load->view($this->folder_views.'/players_confirm_delete');	
	}
	
	
	function update()
	{
		$data['title'] = "JUGADORES ";
		$data['heading'] = "ACTUALIZAR";
		$_POST['image']='image';
		if(isset($_POST['submit']) && $this->form_validation->run()==TRUE){	    
			unset($_POST['_']);
			unset($_POST['submit']);
			$letter=substr($_POST['last_name'],0,1);
			if($_POST['image']!=''){
				$file_name=substr(strrchr($_POST['image'],'/'),1);
				
				$_POST['thumb']="imagenes/players/thumb/".$file_name;
				$_POST['thumb220']="imagenes/players/thumb220/".$file_name;
				
				//Thumb
				$dimension['file_name']='./'.$_POST['image'];
				$dimension['width']=$this->thumb_width;
				$dimension['path']='../imagenes/players/thumb/';
				$this->images_thumb($dimension);

				//Thumb 220
				$dimension['file_name']='./'.$_POST['image'];
				$dimension['width']=220;
				$dimension['path']='../imagenes/players/thumb220/';
				$this->images_thumb($dimension);

				$this->session->set_flashdata('image_error',$this->upload->display_errors());
			}

    		
	    	$this->db->where( 'id',$_POST['id']);
        	$this->db->update('players', $_POST);	
        	//redirect('players/index/'.$letter);
        	$this->index() ;

		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('players');
		$data['countries']=$this->db->query('Select name From countries Order by name asc');
		$this->view($this->folder_views.'/players_vupdate',$data);
	}

	function images_thumb($dimension)
	{
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $dimension['file_name'];
		$config['new_image']=$dimension['path'];
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
	
	function no_pic_view(){
		$this->load->model('goals_position');
		$data['title'] = "GOLEADORES ";
		$data['heading'] = "SIN FOTO";	
	   	
		$query=$this->db->query("SELECT id
	   							 FROM championships");
		
		$i=0;
		$striker=array();
		foreach($query->result() as $row):
			$res=$this->goals_position->get_strikers($row->id);
			if($res->num_rows()>0){
				$res2=$res->result();
				if($res2[0]->thumb==NULL){
					$striker[$i]['id']=$res2[0]->id;
					$striker[$i]['first_name']=$res2[0]->first_name;
					$striker[$i]['last_name']=$res2[0]->last_name;
					$striker[$i]['team']=$res2[0]->name;
					$i+=1;
				}
			}
		endforeach;
		$data['striker']=$striker;		
		$this->view($this->folder_views.'/players_no_pic_view',$data);
	}
	
	function no_pic_update(){
		$data['title'] = "JUGADORES SIN FOTO ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			if($this->upload->do_upload('image')){
				$upload=$this->upload->data();
				$_POST['image']='/imagenes/players/players/'.$upload['file_name'];
				$_POST['thumb']="/imagenes/players/thumb/".$upload['file_name'];
				$dimension['file_name']=$upload['full_path'];
				$dimension['width']=$this->thumb_width;
				$this->images_thumb($dimension);
	    	}
		    $this->db->where( 'id',$_POST['id']);
	        $this->db->update('players', $_POST);	
	        redirect('players/no_pic_view');
		 }	

		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('players');
		$this->view($this->folder_views.'/players_no_pic_vupdate',$data);
	}
	
	function fusion_players(){
		$data['title'] = "FUSI&Oacute;N DE ";
		$data['heading'] = "JUGADORES";
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			$data['id']=$_POST['player1'];
			$data['id2']=$_POST['player2'];
			$this->model->fusion_players($data);
			redirect('players');
		}
		$data['query']=$this->model->get_players();
		$this->view($this->folder_views.'/players_fusion',$data);
	}
	
	function player_teams(){
		$data['title'] = "JUGADORES CON VARIOS EQUIPOS ";
		$data['heading'] = "";	
	   	$query= $this->model->get_player_teams();
	   	$player='';
	   	$i=1;
	   	
	   	foreach($query->result() as $row):
	   		$player[$i]['id']=$row->id;
	   		$player[$i]['fn']=$row->fn;
	   		$player[$i]['ln']=$row->ln;
	   		$player[$i]['teams']='';
	   		$query2=$this->model->get_teams_player($row->id);
	   		$j=1;
	   			foreach($query2->result() as $row2):
	   				$player[$i]['teams'][$j]['id']=$row2->id;
	   				$player[$i]['teams'][$j]['name']=$row2->name;
	   				$j+=1;
	   			endforeach;	
	   		$i+=1;
	   	endforeach;
	   	
	   	$data['player']=$player;
		$this->view($this->folder_views.'/player_teams',$data);
	}
	
	function delete_fteam()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('players_teams'); 
		redirect('players/player_teams');
	}
	
	function confirm_delete_fteam(){
		$this->load->view($this->folder_views.'/players_teams_confirm_delete_fteam');	
	}
	
	function get_player(){
		$this->config->set_item('compress_output', 'FALSE');
		$like=$this->input->post('autocomplete');
		echo $this->model->get_player($like);
	}
	
	/*FUNCIONES PRIVADAS*/
	
	function upload_image(&$field){
		
		if(!empty($_FILES[$field]['name'])){
			$this->change_config_upload($field);
			if($this->upload->do_upload($field)){
				$upload=$this->upload->data();
				$field='../imagenes/'.$this->model->name.'/'.$field.'/'.$upload['file_name'];
				return TRUE;
	   		}	
	   		else{
	   			$this->form_validation->set_message('upload_image', $this->upload->display_errors());
	   			return FALSE;
	   		}
	   	}
		else{
			//unset($_POST[$field]);
			$field="";
   			return TRUE;
		}
	}
	
	
 	function change_config_upload($field){
		$config['upload_path']='../imagenes/'.$this->model->name.'/'.$field.'/';
		$config['allowed_types']='gif|jpg|png|swf';
   		$config['max_size']	= '100000';
   		$config['max_width']  = '1024000';
		$config['max_height']  = '768000';
		$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);
	}
	
}
?>