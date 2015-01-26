<?php
class Groups extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('group','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('name', 'Nombre', 'required');
		$this->form_validation->set_rules('description', 'description', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	function index(){
		$config['base_url']=base_url().'/groups/index/'.$this->uri->segment(3);
		$row=current($this->db->query('SELECT COUNT(*) AS numrows FROM groups where round_id = '.$this->uri->segment(3))->result());
		$config['total_rows']=$row->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "GRUPOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
		$data['query']=$this->db->query("SELECT g.id, g.name, r.name as rname, g.description
						 				 FROM (groups as g,rounds as r)
						  				 WHERE g.round_id=r.id and r.id=".$this->uri->segment(3).' 
						  				 ORDER BY name '.$pagina);
		$data['query2']=$this->db->query('SELECT championship_id
						  FROM rounds
						  WHERE id='.$this->uri->segment(3));
		$cn=$this->db->query("SELECT c.name as cname, r.name as rname
							  FROM championships as c, rounds as r
							  WHERE r.id=".$this->uri->segment(3)." AND r.championship_id=c.id")->result();
	    $data['from']=strtoupper($cn[0]->cname.' / '.$cn[0]->rname);	
		$this->view('groups_view',$data);
	}	
	
	function all(){
		$this->load->model('championship');
		$championship=current($this->championship->get($this->uri->segment(3))->result());
		$data['heading'] = "Grupos de";
		$data['championship'] = $championship;
		$data['groups']=$this->model->get_by_round($championship->active_round);
		
		$this->view($this->model->name.'/view2',$data);
	}

	function insert(){
		$data['title'] = "GRUPOS ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert('groups', $_POST);
				redirect('groups/index/'.$_POST['round_id']);
		    }	
		}
		$this->view('groups_vinsert',$data);
	}
	
	function ajax_insert(){
		unset($_POST['agregar']);
		
		$aux['round_id']=$_POST['round_id'];
		$aux['name']=$_POST['name'];
		$aux['description']='Grupo creado por Wizard';
		$this->db->insert('groups',$aux);
		
		$data['groups']=$this->model->get_by_round($_POST['round_id']);
		$data['round']->id=$_POST['round_id'];
    	$data['anuncio']="El grupo: '".$aux['name']."' ha sido agregado.";
    	
    	$this->load->view('groups/ajax_view',$data);
	}
	
	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('groups'); 
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
        redirect('groups/index/'.$this->uri->segment(4));
	}
	
	function ajax_delete(){
		$id=$this->uri->segment(3);
		$round=$this->uri->segment(4);
		$item=$this->model->delete($id);

		$data['groups']=$this->model->get_by_round($round);
    	$data['anuncio']="El grupo: '".$item->name."' ha sido eliminado.";
    	$data['round']->id=$round;
    	
    	$this->load->view('groups/ajax_view',$data);
	}
	
	function confirm_delete(){
		$this->load->view('groups_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "GRUPOS ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
	   			$this->db->update('groups', $_POST);
	   			redirect('groups/index/'.$_POST['round_id']);
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('groups');
		$this->view('groups_vupdate',$data);
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