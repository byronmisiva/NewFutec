<?php
class Sections extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
		//Cargo todos los modelos necesarios
   		$this->load->model('section','model');
   		$this->load->model('survey');
   		$this->load->model('header');
   		$this->load->model('championship');
   		$this->load->model('team');
   		$this->load->model('category');
   		$this->load->model('tag');
		
   		//Cargo librerias, helpers y configuro las validaciones para los formularios
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('header_id', 'Encabezado', 'required');
		$this->form_validation->set_rules('wap', 'Wap', 'required');
		$this->form_validation->set_rules('rss', 'Rss', 'required');
		$this->form_validation->set_rules('description', 'Descripci&oacute;', '');
		$this->form_validation->set_rules('image', 'Imagen', 'callback_upload_image');
		$this->form_validation->set_rules('image_rss', 'Imagen RSS', 'callback_upload_image');
		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->rsegment(1),$this->uri->rsegment(2),FALSE)){
			redirect('admin');
		}
	}
	
	
	function index(){
		$data['title'] = "SECCIONES ";
		$data['heading'] = "ACCESO";
    
	    $data['query']=$this->model->get_all();
		$this->view($this->model->name.'/view',$data);
	}	
	
	function publica(){
		$this->load->library('parser');
		//$this->config->set_item('compress_output', 'FALSE');
		$id=$this->uri->rsegment(3);
		if(!empty($id) and $this->model->exist($id)){
			$section=$this->model->get_name($id);
			$header=$this->header->get($section->header_id);
			$sec_name=strtolower(str_replace(" ", "_",$section->name));
			
			
			$this->template->set_template('public2');
			$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
			$this->template->write('path',base_url(),TRUE);
			$this->template->write_view('header',$header->file,array(),TRUE);
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			$modulos->set_modulos($id);
		
			$this->template->write('section',$sec_name,TRUE);

			$this->template->render();
		}
		else
			redirect();
		
	}
	
	
	function insert(){
		$this->template->add_js('js/ajax.js');
		
		
		$data['title'] = "SECCIONES ";
		$data['heading'] = "INGRESO";
		$data['surveys']= $this->survey->get_list();
		$data['sections']= $this->model->get_list();
		$data['headers']=$this->header->get_list();
		$data['championships']=$this->championship->get_list();
		$data['teams']=$this->team->get_list();
		$data['categories']=$this->category->get_list();
		$data['tags']=$this->tag->get_all();
		
		$_POST['image'] = 'image';
		$_POST['image_rss'] = 'image_rss';
		if(isset($_POST['submit']) and $this->form_validation->run()){
			unset($_POST['submit']);
			
			//Seteo a NULL los foreign keys para hacer el insert
			if($_POST['team_id']=='')
   				$_POST['team_id']=NULL;
   			if($_POST['championship_id']=='')
   				$_POST['championship_id']=NULL;
   			if($_POST['category_id']=='')
   				$_POST['category_id']=NULL;
   			if($_POST['section_id']=='')
		   			$_POST['section_id']=NULL;
   				
   			$_POST['priority']=$this->priority()+1;   
			$survey=$_POST['survey_id'];
			unset($_POST['survey_id']);
			
			$tag=$this->tag->insert_tag($_POST['related']);
			unset($_POST['related']);
   			$this->db->insert('sections', $_POST);
			$this->tag->insert_section_tag($tag,$this->db->insert_id());
   			
   			if($survey!="")
   				$this->db->insert('sections_surveys',array('survey_id'=>$survey,'section_id'=>$this->db->insert_id(),'date_start'=>mdate('%Y-$m-$d',time())));
    		
	   		redirect($this->model->name);
	
		}

		$this->view($this->model->name.'/insert',$data);
	}

	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('sections'); 
		if($this->db->_error_message()==""){
			$query=$this->db->query("SELECT id, priority
		   				       FROM sections
		   				       ORDER BY priority DESC");
	        foreach($query->result() as $row):
				if($row->priority < $this->uri->segment(4)){
					$priority['priority']=$row->priority+1;
					$this->db->where( 'id',$row->id);
	   				$this->db->update('sections', $priority);
				}
			endforeach;
		}
		else{
		$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('sections');
	}
	
	
	function confirm_delete(){
		$this->load->view($this->model->name.'/confirm_delete');
	}
	
	
	function update(){
		$this->template->add_js('js/ajax.js');
		
		$data['title'] = "SECCIONES ";
		$data['heading'] = "ACTUALIZAR";
		$data['surveys']= $this->survey->get_list();
		$data['headers']=$this->header->get_list();
		$data['championships']=$this->championship->get_list();
		$data['teams']=$this->team->get_list();
		$data['categories']=$this->category->get_list();
		$data['section']=$this->model->get($this->uri->segment(3));
		$data['sections']= $this->model->get_list($data['section']->id);
		$data['tags']=$this->tag->get_all();
		$data['related']=$this->model->get_tag_string($this->uri->segment(3));
		
		//Pongo datos en los Post de las imagenes para que pase la validacion
		$_POST['image'] = 'image';
		$_POST['image_rss'] = 'image_rss';
		if(isset($_POST['submit']) and $this->form_validation->run()==TRUE){	
				unset($_POST['submit']);
				$survey=$_POST['survey_id'];
				unset($_POST['survey_id']);
				
				//Seteo a NULL los foreign keys para hacer el insert
				if($_POST['team_id']=='')
		   			$_POST['team_id']=NULL;
		   		if($_POST['championship_id']=='')
		   			$_POST['championship_id']=NULL;
		   		if($_POST['category_id']=='')
		   			$_POST['category_id']=NULL;
		   		if($_POST['section_id']=='')
		   			$_POST['section_id']=NULL;
		   		if($_POST['image']=='')
		   			unset($_POST['image']);
		   		if($_POST['image_rss']=='')
		   			unset($_POST['image_rss']);	
		   			
		   		$tag=$this->tag->insert_tag($_POST['related']);
				unset($_POST['related']);
				
   				$this->db->where( 'id',$_POST['id']);
   				$this->db->update('sections', $_POST);
   				$this->tag->update_section_tag($tag,$_POST['id']);
   				if($survey!="")
   					$this->db->insert('sections_surveys',array('survey_id'=>$survey,'section_id'=>$_POST['id'],'date_start'=>mdate('%Y-%m-%d',time())));
	    		redirect($this->model->name);
		}
		
		$this->db->where('section_id',$this->uri->segment(3));
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$data['survey']=current($this->db->get('sections_surveys')->result());
		if(!$data['survey'])
			$data['survey']->survey_id="";
		$this->view($this->model->name.'/update',$data);
	}	
	
	function priority()
	{
		$row=$this->db->query("SELECT MAX(priority) as priority
		   				       FROM sections")->result(0);
		return $row[0]->priority;
	}
	
	
	function priority_up()
	{
		$row=$this->db->query("SELECT MAX(priority) as priority
		   				       FROM sections")->result(0);
		$row2=$this->db->query("SELECT priority
								FROM sections
								WHERE id=".$this->uri->segment(3))->result(0);
		$row3=$this->db->query("SELECT MIN(priority) as priority
		   				       FROM sections")->result(0);
		if($row2[0]->priority==$row[0]->priority)
		{
			$priority['priority']=$row3[0]->priority-1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('sections', $priority);
		}
		else
		{
			$query=$this->db->query("SELECT id, priority
		   				       FROM sections
		   				       ORDER BY priority DESC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->priority==$row2[0]->priority+1)
					$aux=1;
				if($row->priority!=$row2[0]->priority+1)
				{
					$priority['priority']=$row->priority+1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('sections', $priority);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('sections');
	}
	
	
	function priority_down()
	{
		$row=$this->db->query("SELECT MAX(priority) as priority
		   				       FROM sections")->result(0);
		$row2=$this->db->query("SELECT priority
								FROM sections
								WHERE id=".$this->uri->segment(3))->result(0);
		$row3=$this->db->query("SELECT MIN(priority) as priority
		   				       FROM sections")->result(0);
		if($row2[0]->priority==$row3[0]->priority)
		{
			$priority['priority']=$row[0]->priority+1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('sections', $priority);
		}
		else
		{
			$query=$this->db->query("SELECT id, priority
		   				       FROM sections
		   				       ORDER BY priority ASC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->priority==$row2[0]->priority-1)
					$aux=-1;
				if($row->priority!=$row2[0]->priority-1)
				{
					$priority['priority']=$row->priority-1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('sections', $priority);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('sections');
	} 
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	
	function set_null(&$field=NULL){
		return TRUE;
	}
	
	
	function upload_image(&$field){
		
		if(!empty($_FILES[$field]['name'])){
			$this->change_config_upload($field);
			if($this->upload->do_upload($field)){
				$upload=$this->upload->data();
				$field='imagenes/sections/'.$field.'/'.$upload['file_name'];
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
				$config['upload_path']='./imagenes/sections/'.$field;
				$config['allowed_types']='gif|jpg|png|swf';
		   		$config['max_size']	= '100000';
		   		$config['max_width']  = '1024000';
				$config['max_height']  = '768000';
				$config['encrypt_name'] = TRUE;
				break;

			case 'image_rss':
				$config['upload_path']='./imagenes/sections/'.$field;
				$config['allowed_types']='gif|jpg|png|swf';
		   		$config['max_size']	= '100000';
		   		$config['max_width']  = '1024000';
				$config['max_height']  = '768000';
				$config['encrypt_name'] = TRUE;
				break;
		}
		$this->load->library('upload',$config);
	}
	
	
	public function list_rss(){
		$this->load->model('story');
		$data['results']=$this->model->list_rss();
		$data['google']="http://www.google.com/ig/adde?moduleurl=http://feeds.feedburner.com/futbolecuador/";
		$data['yahoo']="http://add.my.yahoo.com/content?url=http://feeds.feedburner.com/futbolecuador/";
		$data['track']="onClick=\"javascript:urchinTracker('/tracking/feed');\"";
		
		//Visualizacion
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		//Inserto los modulos especificos
		$data['name']="Listado de Fuentes RSS";
		$this->template->write_view('content', 'public/section_name', $data, FALSE);
		$this->template->write_view('content', $this->model->name.'/list_rss', $data, FALSE);
		
		
		$this->db->last_query();
		$data['query']=$this->story->get_banner();
		$data['check']=0;
		$this->template->write_view('rotativas', 'vista',$data, TRUE);
		$this->template->add_js('js/ajax.js');
		
		$this->template->render();
	}
	
	public function widgets(){
		//Visualizacion
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		//Inserto los modulos especificos
		$data['name']="Widgets";
		$this->template->write_view('content', 'public/section_name', $data, FALSE);
		$this->template->write_view('content', $this->model->name.'/widgets', $data, FALSE);
		
		$this->db->last_query();
		$data['query']=$this->story->get_banner();
		$data['check']=0;
		$this->template->write_view('rotativas', 'vista',$data, TRUE);
		$this->template->add_js('js/ajax.js');
		
		$this->template->render();
		
	}
	
	function list_xml(){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->config->item("encryption_key")==$this->uri->segment(3)){
			$this->load->model('statistic');
			$data['name']='XML Seccion Lista';
			$data['views']=1;
			$this->statistic->sum($data);
			$results=$this->model->list_rss();	
			$request= "<?xml version='1.0'  encoding='utf-8'?>\n";
			$request=$request.'<secciones>';
			foreach($results as $row):
				$request=$request.'<seccion>
									<id>'.base_url().'stories/news_section/'.$row->id.'</id>
									<nombre>'.$row->name.'</nombre>
						   		   </seccion>';
			endforeach;
			$request=$request.'</secciones>';
			header('Content-type: text/xml; charset=utf-8');
			print $request;
		}
	}	
}

?>