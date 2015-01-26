<?php
class Schedules extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('schedule','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('season', 'Nombre', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	function index(){
		$data['title'] = "CALENDARIO ";
		$data['heading'] = "ACCESO";
		$data['query']=$this->db->query("SELECT s.id, s.season, s.position, r.name				 				 
								         FROM (schedules as s,rounds as r)
						  				 WHERE s.round_id=r.id and r.id=".$this->uri->segment(3).' 
						  				 ORDER BY s.position DESC ');
		$data['query2']=$this->db->query('SELECT championship_id
						  				  FROM rounds
						  				  WHERE id='.$this->uri->segment(3));
		$cn=$this->db->query("SELECT c.name as cname, r.name as rname
							  FROM championships as c, rounds as r
							  WHERE r.id=".$this->uri->segment(3)." AND r.championship_id=c.id")->result();
	    $data['from']=strtoupper($cn[0]->cname.' / '.$cn[0]->rname);	
		$this->view('schedules_view',$data);
	}	

	function all(){
		$this->load->model('championship');
		
		$championship=current($this->championship->get($this->uri->segment(3))->result());
		
		$data['schedules']=$this->model->get_by_round($championship->active_round);
		$data['championship']=$championship;
		$data['title']='Fechas de "'.$championship->name.'"';
		
		$this->view($this->model->name.'/view',$data);
	}	
	
	function insert(){
		$data['title'] = "CALENDARIO ";
		$data['heading'] = "INGRESO DE FECHA";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$_POST['position']=$this->position($_POST['round_id'])+1;
				$this->db->insert('schedules', $_POST);
				redirect('schedules/index/'.$_POST['round_id']);
		    }	
		}
		$this->view('schedules_vinsert',$data);
	}
	
	function ajax_insert(){
		unset($_POST['agregar']);
		
		$last_position=$this->model->get_last_position($_POST['round_id']);
		
		$aux['round_id']=$_POST['round_id'];
		$aux['season']=$_POST['name'];
		$aux['position']=$last_position+1;

		$this->db->insert('schedules',$aux);

    	$data['schedules']=$this->model->get_by_round($_POST['round_id']);
    	$data['anuncio']="La fecha: '".$aux['season']."' ha sido agregada.";
    	$data['round']->id=$_POST['round_id'];
    	
    	$this->load->view('schedules/ajax_view',$data);
	}
	
	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('schedules'); 
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		$query=$this->db->query("SELECT id, position
		   				         FROM schedules
		   				         WHERE round_id=".$this->uri->segment(4)."
		   				         ORDER BY position DESC");
   		foreach($query->result() as $row):
			if($row->position < $this->uri->segment(5)){
				$position['position']=$row->position+1;
				$this->db->where( 'id',$row->id);
   				$this->db->update('schedules', $position);
		}
		endforeach;
        redirect('schedules/index/'.$this->uri->segment(4));
	}
	
	function ajax_delete(){
		$id=$this->uri->segment(3);
		$round=$this->uri->segment(4);
		$item=$this->model->delete($id);

		$data['schedules']=$this->model->get_by_round($round);
    	$data['anuncio']="La fecha: '".$item->season."' ha sido eliminada.";
    	$data['round']->id=$round;
    	
    	$this->load->view('schedules/ajax_view',$data);
	}
	
	function confirm_delete(){
		$this->load->view('schedules_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "CALENDARIO ";
		$data['heading'] = "ACTUALIZAR FECHA";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
	   			$this->db->update('schedules', $_POST);
	   			redirect('schedules/index/'.$_POST['round_id']);
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('schedules');
		$this->view('schedules_vupdate',$data);
	}	
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function position($round)
	{
		$row=current($this->db->query("SELECT MAX(position) as position
		   				       FROM schedules
		   				       WHERE round_id=".$round)->result());
		return $row->position;
	}
	
	function position_up()
	{
		$row=current($this->db->query("SELECT MAX(position) as position
		   				       FROM schedules
		   				       WHERE round_id=".$this->uri->segment(4))->result());
		$row2=current($this->db->query("SELECT position
								FROM schedules
								WHERE id=".$this->uri->segment(3))->result());
		$row3=current($this->db->query("SELECT MIN(position) as position
		   				        FROM schedules
		   				        WHERE round_id=".$this->uri->segment(4))->result());
		
		if($row2->position==$row->position)
		{
			$position['position']=$row3->position-1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('schedules', $position);
		}
		else
		{
			$query=$this->db->query("SELECT id, position
		   				       		 FROM schedules
		   				       		 WHERE round_id=".$this->uri->segment(4)."
		   				       		 ORDER BY position DESC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->position==$row2->position+1)
					$aux=1;
				if($row->position!=$row2->position+1)
				{
					$position['position']=$row->position+1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('schedules', $position);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('schedules/index/'.$this->uri->segment(4));
	}
	
	function position_down()
	{
		$row=current($this->db->query("SELECT MAX(position) as position
		   				       FROM schedules
		   				       WHERE round_id=".$this->uri->segment(4))->result());
		$row2=current($this->db->query("SELECT position
								FROM schedules
								WHERE id=".$this->uri->segment(3))->result());
		$row3=current($this->db->query("SELECT MIN(position) as position
		   				        FROM schedules
		   				        WHERE round_id=".$this->uri->segment(4))->result());
		if($row2->position==$row3->position)
		{
			$position['position']=$row->position+1;
			$this->db->where( 'id',$this->uri->segment(3));
   		    $this->db->update('schedules', $position);
		}
		else
		{
			$query=$this->db->query("SELECT id, position
		   				       		 FROM schedules
		   				       		 WHERE round_id=".$this->uri->segment(4)."
		   				       		 ORDER BY position ASC");
			$aux=0;
			foreach($query->result() as $row):
				if($row->position==$row2->position-1)
					$aux=-1;
				if($row->position!=$row2->position-1)
				{
					$position['position']=$row->position-1+$aux;
					$this->db->where( 'id',$row->id);
   					$this->db->update('schedules', $position);
   					$aux=0;	
				}
			endforeach;
		}
   		redirect('schedules/index/'.$this->uri->segment(4));
	}
	
}
?>