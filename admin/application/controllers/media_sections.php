<?php 
class Media_sections extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('media_id', 'Medios', 'required');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/media_sections/index/'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM media_sections where section_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "MEDIOS DE SECCIONES ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query('SELECT s.name, msm.*
										 FROM sections as s , 
											  (SELECT ms.id as msid, ms.media_id as msmedia_id, ms.section_id mssection_id, m.name as mname 
											   FROM media_sections as ms, media as m
											   WHERE ms.media_id= m.id) as msm
											   WHERE s.id = msm.mssection_id and s.id= '.$this->uri->segment(3).' 
											   ORDER BY mname asc '.$pagina);
		$this->view('media_sections_view',$data);
	}
	
	function insert()
	{
		$data['title'] = "MEDIOS DE SECCIONES ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	
			unset($_POST['submit']);
			$this->db->insert('media_sections', $_POST);
	    	redirect('media_sections/index/'.$_POST['section_id']);
		}
		$data['query']=$this->db->get('media');
		$this->view('media_sections_vinsert',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('media_sections'); 
		redirect('media_sections/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('media_sections_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "MEDIOS DE SECCIONES ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			unset($_POST['submit']);
			$this->db->where('id',$_POST['id']);
   			$this->db->update('media_sections', $_POST);
	    	redirect('media_sections/index/'.$_POST['section_id']);
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']= $this->db->get('media_sections');
		$data['query2']=$this->db->get('media');
		$this->view('media_sections_vupdate',$data);
	}
	
	function xml_podcast(){
		if($this->config->item("encryption_key")==$this->uri->segment(3)){
			//$this->output->cache(5);
			$query=$this->db->query('SELECT s.id, s.name, COUNT( m.id ) AS podcast
									 FROM sections AS s, media_sections AS ms, media AS m
									 WHERE s.id = ms.section_id AND ms.media_id = m.id AND m.type =1
									 GROUP BY s.id');
			
			$request='<podcast>';
			
			foreach($query->result() as $row):
				$request=$request.'<section>
									 <id>'.$row->id.'</id>
									 <nombre>'.$row->name.'</nombre>
									 <numero>'.$row->podcast.'</numero>
								   </section>';
			endforeach;
			
			$request=$request.'</podcast>';
			
			$data['request']=$request;
			header('Content-type: text/xml');
			$this->load->view('xmls/podcast_sections',$data);
		}
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
}	
?>