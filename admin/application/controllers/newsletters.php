<?php
class Newsletters extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('newsletter');
		$this->form_validation->set_rules('date', 'Fecha', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
	}
			
	function index(){
		$data['title'] = "BOLET&Iacute;N ";
		$data['heading'] = "LISTADO";
		$config['base_url']=base_url().'/newsletters/index/';
		$row=current($this->db->query('SELECT COUNT(*) AS numrows FROM newsletters ')->result());
		$config['total_rows']=$row->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '3';
		$this->pagination->initialize($config);
	    if(!$this->uri->segment(3)=='')
	    	$pagina="LIMIT ".$this->uri->segment(3)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
		
	    $data['query']=$this->db->query("Select * from newsletters Order by date desc ".$pagina);
	    $this->view($this->newsletter->name.'/view',$data);
	}	
	
	function get_news(){
		$like=$this->input->post('autocomplete');
		echo $this->newsletter->get_news($like);
	}
	
	function insert(){	
		$data['title'] = "BOLET&Iacute;N ";
		$data['heading'] = "INSERTAR";
		
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert('newsletters', $_POST);
				redirect('newsletters/index/');
		    }	
		}
		$this->view($this->newsletter->name.'/insert',$data);
	}

	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('newsletters');
		redirect('newsletters');
	}
	
	function confirm_delete(){
		$this->load->view($this->newsletter->name.'/confirm_delete');	
	}
	
	function lista(){
		$data['title'] = "BOLET&Iacute;N ";
		$data['heading'] = "LISTADO";
		$data['query2']=$this->db->query("Select * from newsletters Where id=".$this->uri->segment(3))->result();
		$this->view($this->newsletter->name.'/list',$data);
	}
	
	function list_view($id){
		$data['query']=$this->db->query('Select ns.newsletter_id,ns.id,s.title,s.modified,ns.position 
						  		 From newsletters as n, newsletters_stories ns, stories as s
						  		 Where n.id='.$id.' AND n.id=ns.newsletter_id AND ns.story_id=s.id
						  		 Order by ns.position asc ');
		$this->load->view($this->newsletter->name.'/list_view',$data);
	}
	
	function newsletters_stories_insert(){
		$data['story_id']=$this->uri->segment(4);
		$data['newsletter_id']=$this->uri->segment(3);
		$data['position']=$this->newsletter->getLastOrder($this->uri->segment(3));
		$this->db->insert('newsletters_stories',$data);
		$this->list_view($this->uri->segment(3));
	}
	
	function newsletters_stories_delete(){
		$story=$this->newsletter->getStory($this->uri->segment(3));
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('newsletters_stories');
        $this->newsletter->lessOrder($story->newsletter_id,$story->position);
        $this->list_view($this->uri->segment(4));
	}
	
	function preview(){
		$this->load->model('match_calendary');
		
		$data['query']=$this->db->query('Select n.*, i.thumb150,i.thumbh160,i.thumbh80 
										 From (Select n.tipo,n.date,s.id,s.title,s.lead,s.modified, s.image_id, s.subtitle,ns.position 
						  		 		 	   From newsletters as n, newsletters_stories ns, stories as s 
						  		 		 	   Where n.id='.$this->uri->segment(3).' AND n.id=ns.newsletter_id AND ns.story_id=s.id) as n 
						  		 		 Left Join images as i On n.image_id=i.id Order by n.position asc ')->result();
		
		
		$first=array_shift($data['query']);
		$data['first']=$first;
		
		$nombre_boletin='La Previa en futbolecuador.com';
		if($first->tipo=="lunes"){
			$this->load->model('match_calendary');
			$data['partidos']=$this->match_calendary->matches_last_next(CHAMP_DEFAULT,FALSE);
			$nombre_boletin='El Resumen en futbolecuador.com';
		}

		//De acuerdo al tipo se envia al diferente template para visualizar
		if($this->uri->segment(4)=='enviar'){
			$body=$this->load->view($this->newsletter->name.'/preview_'.$first->tipo,$data,TRUE);
			$num=$this->send_mail($nombre_boletin,$body,$this->uri->segment(3));
			echo "Boletines enviados: ".$num;
		}
		else{
			$this->load->view($this->newsletter->name.'/preview_'.$first->tipo,$data);
		}
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function send_mail($subject,$body,$id){
		$this->load->library('email');
		$batch=5;
		$test=false; //Cambiar para poner el sistema en pruebas solo con el set de correos
		
		$config['bcc_batch_size']=$batch;
		$this->email->initialize($config);
		$this->email->from('boletin@futbolecuador.com','futbolecuador.com');

		$suscripts=array(	'jfchiriboga@misiva.com.ec','oterol@futbolecuador.com',
							'juan_chiriboga@msn.com','cad666@hotmail.com',
							'chirito@hotmail.com','candrade@misiva.com.ec',
							'cadwmaster@gmail.com','cad666@hotmail.com',
							'fhernandez@markplan.com','candrade@markplan.com');
		
		if($test===false){
			$query=$this->db->query('Select * From users Where suscription=1');
			foreach($query->result() as $row)
				$suscripts[]=$row->mail;
		}
		$outputs=array_chunk($suscripts, $batch);
		foreach($outputs as $key=>$suscripts){
			$this->email->bcc($suscripts);
			$this->email->subject($subject);
			$this->email->message($body);
			$this->email->send();
		}
				
		$this->db->set('enviados',count($outputs)*$batch);
		$this->db->where('id',$id);
		$this->db->update('newsletters');
		return count($outputs)*$batch;
	}
	
	function upStoryOrder($id){
		$story=$this->newsletter->getStory($id);
		$max=$this->newsletter->getLastOrder($story->newsletter_id);
		
		if($story->position < ($max-1) ){
			$next=$this->newsletter->getStorybyOrder($story->position+1,$story->newsletter_id);
			$this->newsletter->updateStoryOrder($next->id,$story->position);
			$new_order=$story->position+1;
		}
		else{
			$new_order=0;
			$this->newsletter->addOrder($story->newsletter_id);
		}
		$this->newsletter->updateStoryOrder($story->id,$new_order);
		$this->list_view($story->newsletter_id);
		
	}
	
	function downStoryOrder($id){
		$story=$this->newsletter->getStory($id);
		$max=$this->newsletter->getLastOrder($story->newsletter_id);
		
		if($story->position > 0){
			$next=$this->newsletter->getStorybyOrder($story->position-1,$story->newsletter_id);
			$this->newsletter->updateStoryOrder($next->id,$story->position);
			$new_order=$story->position-1;
		}
		else{
			$new_order=$max-1;
			$this->newsletter->lessOrder($story->newsletter_id);
		}
		
		$this->newsletter->updateStoryOrder($story->id,$new_order);
		$this->list_view($story->newsletter_id);
		
	}
	
	function newsletterSuscription(){
		$equipos['default']->id='';
		$equipos['default']->nombre='';
		$equipos['default']->imagen='imagenes/newsletter/fondos/default.jpg';
		$equipos['default']->flecha=1;
		$equipos[33]->id=33;
		$equipos[33]->nombre='Aucas';
		$equipos[33]->imagen='imagenes/newsletter/fondos/33.jpg';
		$equipos[33]->flecha=2;
		$equipos[34]->id=34;
		$equipos[34]->nombre='Barcelona';
		$equipos[34]->imagen='imagenes/newsletter/fondos/34.jpg';
		$equipos[34]->flecha=1;
		$equipos[35]->id=35;
		$equipos[35]->nombre='Deportivo Cuenca';
		$equipos[35]->imagen='imagenes/newsletter/fondos/35.jpg';
		$equipos[35]->flecha=1;
		$equipos[36]->id=36;
		$equipos[36]->nombre='Deportivo Quito';
		$equipos[36]->imagen='imagenes/newsletter/fondos/36.jpg';
		$equipos[36]->flecha=1;
		$equipos[37]->id=37;
		$equipos[37]->nombre='El Nacional';
		$equipos[37]->imagen='imagenes/newsletter/fondos/37.jpg';
		$equipos[37]->flecha=1;
		$equipos[38]->id=38;
		$equipos[38]->nombre='Emelec';
		$equipos[38]->imagen='imagenes/newsletter/fondos/38.jpg';
		$equipos[38]->flecha=1;
		$equipos[39]->id=39;
		$equipos[39]->nombre='Liga de Quito';
		$equipos[39]->imagen='imagenes/newsletter/fondos/39.jpg';
		$equipos[39]->flecha=1;
		$equipos[77]->id=77;
		$equipos[77]->nombre='Liga de Loja';
		$equipos[77]->imagen='imagenes/newsletter/fondos/77.jpg';
		$equipos[77]->flecha=1;
		$equipos[79]->id=79;
		$equipos[79]->nombre='Manta F.C.';
		$equipos[79]->imagen='imagenes/newsletter/fondos/79.jpg';
		$equipos[79]->flecha=1;
		
		if($this->uri->segment(3))
			$equipo=$this->uri->segment(3);
		else
			$equipo='default';
		
		$data['equipos']=$equipos;
		$data['equipo']=$equipo;
		
		if(isset($_POST['enviar'])){
			$data='';
			$data['nombre']=$_POST['nombre'].' '.$_POST['apellido'];
			$data['equipo']=$_POST['equipo_id'];
			
			$datos['role_id']=2;
			$datos['first_name']=$_POST['nombre'];
			$datos['last_name']=$_POST['apellido'];
			$datos['mail']=$_POST['email'];
			$datos['city_id']=0;
			$datos['country_id']=0;
			$datos['team_id']=$_POST['equipo_id'];
			$datos['suscription']=1;
			$datos['description']='Newsletter';
			$datos['created']=mdate("%Y-%m-%d  %H:%i:%s",time());
			$datos['modified']=mdate("%Y-%m-%d  %H:%i:%s",time());
			$datos['nick']=$_POST['nombre'].' '.$_POST['apellido'];
			$datos['password']='newslettersSHIN';
			$datos['counter']=0;
			$datos['active']=1;
			$datos['last_login']=NULL;
			$datos['activation_key']='newslettersSHIN';
			$datos['points']=0;
			$datos['birth']='0000-00-00';
			$datos['sex']='m';
			$datos['twitter']='ninguno';
			
			$this->db->insert('users', $datos);
			
			$this->load->view('newsletters/suscriptionConfirmation',$data);
		}
		else{
			$this->load->view('newsletters/suscription',$data);
		}
	}
	
}
?>