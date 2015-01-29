<?php
class Championships extends CI_Controller {
	
	var $folder_views;

	function __construct(){
		parent::__construct();
		$this->load->model('championship','model');
		$this->load->model('match_calendary');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('image', 'Imagen', 'callback_upload_image');
   		
		$this->folder_views='championships';
		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index(){
		$data['title'] = "CAMPEONATOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->model->get_all($this->uri->segment(3));
		$this->view($this->folder_views.'/championships_view',$data);
	}	

	function insert(){
		$data['title'] = "CAMPEONATOS ";
		$data['heading'] = "INGRESO";
		
		$_POST['image'] = 'image';
		if(isset($_POST['submit'])){
   			$_POST['active_round']=0;
   			//$rounds=$_POST['rounds'];    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				//unset($_POST['rounds']);
				$this->db->insert('championships', $_POST);
				/*if($this->uri->segment(3)!=""){
					$id=$this->db->insert_id();
					$this->session->set_flashdata('rounds', $rounds);
					redirect('championships/wizard/step2/'.$id);
				}
				else*/
					redirect('championships');
		    }	
		}
		$this->view($this->folder_views.'/championships_vinsert',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('championships');
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('championships');
	}

	function confirm_delete(){
		$this->load->view($this->folder_views.'/championships_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "CAMPEONATOS ";
		$data['heading'] = "ACTUALIZAR";
		
		$_POST['image'] = 'image';
		if(isset($_POST['submit'])){	
			if($_POST['active_round']=='')
   				$_POST['active_round']=0;    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);

				$this->db->where( 'id',$_POST['id']);
       			$this->db->update('championships', $_POST); 

        		redirect('championships/index');
   			}
		}	
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('championships');
		$data['rnds']=$this->db->query('SELECT r.id, r.name
										FROM   rounds as r
										WHERE r.championship_id='.$this->uri->segment(3));
		$this->view($this->folder_views.'/championships_vupdate',$data);
	}
	
	function view($ver,$data)
	{
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function list_played_matches(){
		//$this->output->cache(CACHE_MOVIL);
		$champ=$this->uri->segment(3);
		$data['champ']=$champ;
		$data['partidos']=$this->match_calendary->matches_last_next(FALSE,FALSE);
		$this->load->view($this->folder_views.'/list_results', $data);
	}
	
	function list_match_week(){
		//$this->output->cache(CACHE_MOVIL);
		$champ=$this->uri->segment(3);
		$data['champ']=$champ;
		$data['partidos']=$this->match_calendary->matches_last_next(FALSE,TRUE);
		$this->load->view($this->folder_views.'/list_next', $data);
	}
	
	function list_strikes(){
		$champ=$this->uri->segment(3);
		$data['jugadores']=$this->model->get_strikes($champ);
		$this->load->view($this->folder_views.'/strikes', $data);
	}
	
	function leaderboard($champ){
		//$this->output->cache(CACHE_MOVIL);
		$this->load->model('group');
		$this->load->model('teams_position');
		$this->load->model('section');		
		$data['change']=array(	base_url().'imagenes/icons/flecha_arriba.png',
								base_url().'imagenes/icons/igual.png',
								base_url().'imagenes/icons/flecha_abajo.png');		
		$round=$this->model->get_active_round($champ);
		if($round!=false){ 
			$active_group = current($this->group->get_by_round($round));			
			$data['teams']=$this->section->get_teams($champ);			
			$data['tabla']=$this->teams_position->get_table( $active_group->id );			
			$this->load->view($this->folder_views.'/leaderboard', $data);
		}		
	}
	
	function leaderboard_cumulative($champ){
		//$this->output->cache(CACHE_MOVIL);
		
		$this->load->model('teams_position');
		
		$data['change']=array(	base_url().'imagenes/icons/flecha_arriba.png',
				base_url().'imagenes/icons/igual.png',
				base_url().'imagenes/icons/flecha_abajo.png');
		
		$data['tabla']=$this->teams_position->get_table_by_champ($champ);
		$data['groups']=0;
		
		$this->load->view($this->folder_views.'/leaderboard', $data);
	}
	
	
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
			$field="";
   			return TRUE;
		}
	}
	
	
	function change_config_upload($field){
		switch($field){
			case 'image':
				$config['upload_path']='./imagenes/'.$this->model->name.'/'.$field.'/';
				$config['allowed_types']='gif|jpg|png|swf';
		   		$config['max_size']	= '100000';
		   		$config['max_width']  = '1024000';
				$config['max_height']  = '768000';
				$config['encrypt_name'] = TRUE;
				break;

		}
		$this->load->library('upload',$config);
	}
	
	function wizard(){
		$this->config->set_item('compress_output', 'FALSE');
		$this->load->model('team');
		$step=$this->uri->segment(3);		
		
		switch($step){
			
			case 'step2':
				//STEP 2: Añadir Equipos
				$this->session->set_flashdata('back',$this->uri->uri_string());
				$championship=$this->uri->segment(4);
				$data['teams']=$this->team->get_list();
				$data['my_teams']=$this->team->get_teams_championship($championship)->result();
				$data['championship']=current($this->model->get($championship)->result());
				$this->template->add_js('js/ajax.js');
				$this->view($this->model->name.'/create_step2',$data);
				break;
				
			case 'step3':
				//STEP 3: Crear Rondas
				$this->session->set_flashdata('back',$this->uri->uri_string());
				$rounds_num=$this->session->set_flashdata('rounds');
				if(is_null($rounds_num))
					$rounds_num=1;
				
				$championship=$this->uri->segment(4);
				$rounds=$this->model->get_rounds_championship($championship);
				
				if($rounds->num_rows()==0){
					$aux['championship_id']=$championship;
					$active=false;
					for($i=0;$i<$rounds_num;$i++){
						$aux['name']='Ronda '.($i+1);
						$aux['image']="";
						$aux['priority']=$i;
						$aux['last']=$i;
						$this->db->insert('rounds',$aux);
						if($active==false)
							$active=$this->db->insert_id();
					}
					$this->model->set_active_round($championship,$active);
					$rounds=$this->model->get_rounds_championship($championship);
				}
				
				$rounds=$rounds->result();
				
				$data['rounds']=$rounds;
				$data['championship']=current($this->model->get($championship)->result());
				$this->template->add_js('js/ajax.js');
				$this->view($this->folder_views.'/create_step3',$data);
				break;
				
			case 'step4':
				//STEP 4: Crear grupos y fechas por cada ronda
				$this->load->model('round');
				$this->load->model('schedule');
				
				$championship=$this->uri->segment(4);
				if($this->uri->segment(5)==0)
					$round=$this->round->get_first($championship);
				else
					$round=$this->round->get($this->uri->segment(5));
				
				//Extraigo los grupos de la ronda y si no existen creo uno
				$groups=$this->group->get_by_round($round->id);
				if(count($groups)==0){
					$aux['name']='Grupo General';
					$aux['round_id']=$round->id;
					$aux['description']="Autogenerada por el Wizard";
					$this->db->insert('groups',$aux);
					$groups=$this->group->get_by_round($round->id);
				}
				
				unset($aux);
				
				//Extraigo las fechas de la ronda y si no existen creo una
				$schedules=$this->schedule->get_by_round($round->id);
				if(count($schedules)==0){
					$aux['season']='Fecha 1';
					$aux['round_id']=$round->id;
					$aux['position']=1;
					$this->db->insert('schedules',$aux);
					$schedules=$this->schedule->get_by_round($round->id);
				}
				
				//Presentacion
				$data['round']=$round;
				$data['next_round']=$this->round->get_next($championship,$round);
				$data['groups']=$groups;
				$data['schedules']=$schedules;
				$data['championship']=current($this->model->get($championship)->result());
				$this->template->add_js('js/ajax.js');
				$this->view($this->folder_views.'/create_step4',$data);	
				break;
				
			case 'step5':
				//STEP 5: Crear los partidos del campeonato
				$this->load->model('round');
				
				$championship=$this->uri->segment(4);
				
				$data['championship']=current($this->model->get($championship)->result());
				$data['rounds']=$this->model->get_rounds_championship($championship);
				$data['teams']=current($this->model->get($championship)->result());
				$data['stadia']=current($this->model->get($championship)->result());
				
				$this->view($this->folder_views.'/create_step5',$data);	
				break;
			
			default:
				
				//STEP 1
				$years=array();
				for($i = mdate("%Y",time())-2; $i <= mdate("%Y",time())+1; $i += 1)
					$years[$i]=$i;	
				
				$rounds=array();
				for($i = 1; $i <= 10; $i += 1)
					$rounds[$i]=$i;	
					
				$data['years']=$years;
				$data['rounds']=$rounds;
				$this->view($this->folder_views.'/create_step1',$data);
		}
	}
}