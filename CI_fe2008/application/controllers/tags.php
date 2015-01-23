<?php
class Tags extends CI_Controller {

	var $aeropuertos;
	
	function __construct(){
		parent::__construct();
		$this->load->model('tag','model');
		$this->load->helper('html');
		$this->load->helper('url');
		
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
		
	}
	
	function index(){
		$data['title'] = "TAGS ";
		$data['heading'] = "LISTADO";
	    $data['query']=$this->model->get_all();
		$this->view('tags_view',$data);
	}	

	function confirm_delete(){
		$this->load->view('tags_confirm_delete');	
	}
	
	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('tags');
		redirect('tags');
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function search_tag(){
		
		$texto=$this->input->post('related');
		
		$resultados=$this->model->search($texto);
		
		if($resultados->num_rows()>0){
			$texto='<ul>';
	    	foreach($resultados->result() as $row){
	   			$texto.='<li id='.$row->id.'>'.$row->name.'</li>';
	   		}
    		$texto.='</ul>';
		}
		else{
			$texto="<ul><li id=0>No Existen Resultados</li></ul>";
		}
		
		echo $texto;
		
	}
	
	public function cargar_tags(){
		$this->output->cache(CACHE_DEFAULT);
		$this->load->model('tag');
		$this->load->helper('inflector');
		$m=($this->tag->get_max()-$this->tag->get_min())/(25-15);
		$b=$this->tag->get_min()-($m*15);	
		$tags=$this->tag->get_random();	
		$i=0;
		foreach($tags->result() as $row):
			$data['tag'][$i]['name']=$row->name;
			$data['tag'][$i]['num']=($row->sum-$b)/$m;
			$up=(((($row->sum-$b)/$m)-15)*9);
			$data['tag'][$i]['r']=dechex(153-$up);
			$data['tag'][$i]['g']=dechex(203-$up);
			$data['tag'][$i]['b']=dechex(226-$up);
			$i+=1;
		endforeach;		
		$this->load->view('public/tags', $data);	
	}
}
?>