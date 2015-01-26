<?php
class Gacos extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('gaco');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('session');
		
		$this->form_validation->set_rules('start_round', 'Start Round', 'required');
		$this->form_validation->set_rules('end_round', 'End Round', 'required');
		$this->form_validation->set_rules('type', 'Tipo', 'required');
		$this->form_validation->set_rules('away_gol', 'Gol de Visitante', '');
		$this->form_validation->set_rules('win_loser', 'Ida y Vuelta', '');
		$this->form_validation->set_rules('list', 'Clasificacion en lista', '');
		
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->template->add_js('js/ajax.js');
	}
	
	function index(){
		$config['base_url']=base_url().'/rounds/index'.$this->uri->segment(3);
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM gaco where championship_id = '.$this->uri->segment(3))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "GACO ";
		$data['heading'] = "ACCESO";

	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT c.name as cname, r.name as rname, r2.name as r2name, g.*
										 FROM championships as c, rounds as r, rounds as r2, gaco as g 
										 WHERE c.id=".$this->uri->segment(3)." 
										   and r.id=g.start_round 
										   and r2.id=g.end_round 
										   and g.championship_id=".$this->uri->segment(3)."
										   ".$pagina);

		$this->view('gacos/view',$data);
	}
	
	function insert(){
		$data['title']='GACO ';
		$data['heading']='INGRESO';
		if(isset($_POST['submit'])){				
			if($_POST['type']==2){
				$this->form_validation->set_rules('num_pass', 'Num Pass', 'required');
				$this->form_validation->set_rules('num_best', 'Num Best', 'required');
			}
			else{
				$this->form_validation->set_rules('num_pass', 'Num Pass', '');
				$this->form_validation->set_rules('num_best', 'Num Best', '');
			}
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert('gaco',$_POST);
				redirect('gacos/index/'.$this->uri->segment(3));	
			}
		}
		$data['query']=$this->db->query('Select *
										  From rounds
										  Where championship_id='.$this->uri->segment(3));
		$this->view('gacos/insert',$data);
	}
	
	function update(){
		$data['title']='GACO ';
		$data['heading']='ACTUALIZAR';
		if(isset($_POST['submit'])){				
			if($_POST['type']==2){
				$this->form_validation->set_rules('num_pass', 'Num Pass', 'required');
				$this->form_validation->set_rules('num_best', 'Num Best', 'required');
			}
			else{
				$this->form_validation->set_rules('num_pass', 'Num Pass', '');
				$this->form_validation->set_rules('num_best', 'Num Best', '');
			}
			
			if(!isset($_POST['away_gol']))
				$_POST['away_gol']=0;
			if(!isset($_POST['win_loser']))
				$_POST['win_loser']=0;
			if(!isset($_POST['list']))
				$_POST['list']=0;
				
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where('id',$_POST['id']);
				$this->db->update('gaco',$_POST);
				redirect('gacos/index/'.$this->uri->segment(4));	 
			}
		}
		$data['query']=$this->db->query('Select *
										  From rounds
										  Where championship_id='.$this->uri->segment(4));
		$data['query2']=$this->db->query('Select *
										  From gaco
										  Where id='.$this->uri->segment(3));
		$this->view('gacos/update',$data);
	}
	
	function confirm_delete(){
		$this->load->view('gacos/confirm_delete');	
	}
	
	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('gaco');
		redirect('gacos/index/'.$this->uri->segment(4));
	}
	
	function rules(){
		
		$ex=explode('_',$this->uri->segment(5));
		
		if($ex[2]==1)
			$var='checked="checked"';
		else
			$var='';
		
		if($this->uri->segment(4)==2)
			echo '<br/>
			      SOLO PARA GRUPOS
				  <table>
					<tr><td>Posiciones:</td><td><input type="text" name="num_pass" value="'.$ex[0].'"/>*</td></tr>
					<tr><td>Mejores:</td><td><input type="text" name="num_best" value="'.$ex[1].'"/>*</td></tr>
					<tr><td>Clasificacion en lista:</td><td><input type="checkbox" name="list" value="1" '.$var.'/></td></tr>	
				  </table>';
		else
			echo'';      
	}
	
	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}
	
	function matches_view(){
		$data=$this->gaco->matches_view($this->uri->segment(3),$this->uri->segment(4));
		if($data['gmatch']!=''){
			header('Content-type: text/html; charset=utf-8');
			$this->load->view('gacos/matches_view',$data);
		}
	}
	
	function matches_view_admin(){
		$data=$this->gaco->matches_view($this->uri->segment(3),$this->uri->segment(4));
		if($data['gmatch']!=''){
			header('Content-type: text/html; charset=utf-8');
			$this->load->view('gacos/matches_view_admin',$data);
		}
	}
	
	function xml_matches_view(){
		$data=$this->gaco->matches_view($this->uri->segment(3),$this->uri->segment(4));
		if($data['gmatch']!=''){		
			header('Content-type: text/xml');
			$this->load->view('gacos/xml_matches_view',$data);
		}
	}
	
	function check(){
		$this->load->model('gaco_match');
		$this->gaco_match->delete(95);
	} 
}
?>