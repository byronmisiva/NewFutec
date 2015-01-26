<?php
class Transfers extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('transfer');
		$this->load->model('championship');
		$this->load->model('team');
		$this->load->model('player');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->form_validation->set_rules('team_id_from', 'Desde', '');
		$this->form_validation->set_rules('team_id_to', 'Hacia', 'required');
		$this->form_validation->set_rules('player_id', 'Jugador', 'required');
		$this->form_validation->set_rules('championship_id', 'Campeonato', 'required');
		$this->form_validation->set_rules('round_id', 'Ronda', 'required');
		$this->form_validation->set_rules('status', 'Estado', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	function publica(){
		$championship=$this->uri->segment(3);
		$champ=$this->championship->get($this->uri->segment(3))->row();
		$teams='';
		$query=$this->team->get_teams_championship($championship);
		$status[1]='Cancelada';
	  	$status[2]='Rumor';
	  	$status[3]='Posible';
	  	$status[4]='Completada';
	  	
		foreach($query->result() as $row):
			$trans=$this->transfer->get_transfers($row->id,$champ->active_round);
			$teams[$row->id]['id']=$row->id;
			$teams[$row->id]['name']=$row->name;
			$teams[$row->id]['shield2']=$row->shield2;
			$teams[$row->id]['transfer']='';	
			
			foreach($trans->result() as $row2):
				$teams[$row->id]['transfer'][$row2->id]['from_name']=$row2->tfname;
				$teams[$row->id]['transfer'][$row2->id]['to_name']=$row2->ttname;
				$teams[$row->id]['transfer'][$row2->id]['from_ms']=$row2->tfms;
				$teams[$row->id]['transfer'][$row2->id]['to_ms']=$row2->ttms;
				$teams[$row->id]['transfer'][$row2->id]['from_id']=$row2->team_id_from;
				$teams[$row->id]['transfer'][$row2->id]['to_id']=$row2->team_id_to;
				$teams[$row->id]['transfer'][$row2->id]['status']=$status[$row2->status];
				$teams[$row->id]['transfer'][$row2->id]['player']=$row2->first_name.' '.$row2->last_name;
				
				if($row2->team_id_from==$row->id)
					$teams[$row->id]['transfer'][$row2->id]['if']=1;
				if($row2->team_id_to==$row->id)
					$teams[$row->id]['transfer'][$row2->id]['if']=2;
			endforeach;
			
		endforeach;
		$data['teams']=$teams;
		$data['championship']=$championship;
		$this->view('transfers/transfers',$data);
	}
		
	function index(){
		$champ=$this->championship->get($this->uri->segment(3))->row();
		$config['base_url']=base_url().'/transfers/index/'.$this->uri->segment(3);
		$row=$this->transfer->num($this->uri->segment(3));
		$config['total_rows']=$row;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "TRANSFERENCIAS - ";
		$data['heading'] = $champ->name;
		$data['query']=$this->transfer->get_all($this->uri->segment(3));
	    $this->view('transfers/view',$data);
	}
	
	function insert(){
		$data['title'] = "TRANSFERENCIAS ";
		$data['heading'] = "INGRESO";
		$data['query']=$this->team->get_teams();
		$data['query2']=$this->player->get_players();
		$data['query3']=$this->championship->get_rounds_championship($this->uri->segment(3));
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				if($_POST['team_id_from']=='')
					$_POST['team_id_from']=NULL;
				unset($_POST['submit']);
					$this->db->insert('transfers', $_POST);
					redirect('transfers/index/'.$this->uri->segment(3));
		    }	
		}
		$this->view('transfers/insert',$data);
	}
	
	function update(){
		$data['title'] = "TRANSFERENCIAS ";
		$data['heading'] = "ACTUALIZAR";
		$data['query']=$this->transfer->get($this->uri->segment(3));
		$data['query2']=$this->team->get_teams_championship($this->uri->segment(4));
		$data['query3']=$this->player->get_players();
		$data['query4']=$this->championship->get_rounds_championship($this->uri->segment(4));
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				if($_POST['team_id_from']=='')
					$_POST['team_id_from']=NULL;
				unset($_POST['submit']);
					$this->db->where('id',$_POST['id']);
					$this->db->update('transfers', $_POST);
					redirect('transfers/index/'.$this->uri->segment(4));
		    }	
		}
		$this->view('transfers/update',$data);
	}
	
	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('transfers');
		if(!$this->db->_error_message()==""){
			$this->session->set_flashdata('delete_error','Elemento relacionado en otra tabla no es posible borrar');
		}
		redirect('transfers/index/'.$this->uri->segment(4));
	}

	function confirm_delete(){
		$this->load->view('transfers/confirm_delete');	
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
}
?>