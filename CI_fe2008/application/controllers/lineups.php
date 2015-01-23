<?php
class Lineups extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('lineup','model');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		
		//Validacion ACL
		if(!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
			redirect('admin');
		}
	}
	
	function index(){
		$this->load->model('match');
		$this->load->model('team');
		
		$data['title']='Ingresar Alineacion';
		
		$match_id=$this->uri->segment(3);
		$teams=$this->match->get_teams($match_id);
		
		$data['championship']=$this->match->get_champ($match_id);
		$data['status']=array(1=>'Titular',0=>'Suplente','2'=>'Suplente que Entra','3'=>'Titular que Sale','4'=>'Suplente Cambiado');
		$data['position']=array('Arquero'=>'Arquero','Defensa'=>'Defensa','Volante'=>'Volante','Delantero'=>'Delantero');
		
		$data['home']=current($this->team->get($teams->team_id_home)->result());
		$data['away']=current($this->team->get($teams->team_id_away)->result());
		
		$data['players_home']=$this->team->get_players_list($teams->team_id_home);
		$data['players_away']=$this->team->get_players_list($teams->team_id_away);
		
		$data['lineup_home']=$this->model->get_lineup($match_id,$teams->team_id_home);
		$data['lineup_away']=$this->model->get_lineup($match_id,$teams->team_id_away);
		
		
		$this->template->add_js('js/ajax.js');
		$this->view('lineups/view',$data);
	}
	
	function add(){
		if(isset($_POST['submit'])){
			if($this->model->no_exist($_POST)){
				$data['match_id']=$_POST['match_id'];
				$data['team_id']=$_POST['team_id'];
				$data['player_id']=$_POST['player_id'];
				$data['position']=$_POST['position'];
				$data['status']=$_POST['status'];
				$data['points']=0;
				$this->db->insert('lineups', $data);
			}
		}
		$data['status']=array(1=>'Titular',0=>'Suplente','2'=>'Suplente que Entra','3'=>'Titular que Sale','4'=>'Suplente Cambiado');
		$data['position']=array('Arquero'=>'Arquero','Defensa'=>'Defensa','Volante'=>'Volante','Delantero'=>'Delantero');
		
		$data['lineup']=$this->model->get_lineup($_POST['match_id'],$_POST['team_id']);
		$this->load->view($this->model->name.'/single',$data);
	}
	
	function insert()
	{
		$data2['title'] = "ALINEACI&Oacute;N ";
		$data2['heading'] = "INGRESO";
		
		
		if(isset($_POST['submit'])){	
				unset($_POST['submit']);
				$row=$this->db->query("SELECT COUNT(l.id) as total
							   FROM (SELECT p.*, l.id as lid
								     FROM  (SELECT p.id, p.first_name, p.last_name
									        FROM players AS p, players_teams as pt
										 	WHERE pt.team_id=".$_POST['team_id']." AND pt.player_id=p.id) as p
									 LEFT JOIN lineups as l on p.id=l.player_id and l.match_id=".$_POST['match_id']." and l.team_id=".$_POST['team_id']." ) as l
							   WHERE l.lid is null")->result(0);
		
				$data['id']=$_POST['id'];
				$data['team_id']=$_POST['team_id'];
				$data['match_id']=$_POST['match_id'];
				$data['points']=0;
				
				for($i=1; $i<=$row[0]->total; $i=$i+1)
				{
					if($_POST['status'.$i]!=2){
						$data['player_id']=$_POST['player_id'.$i];
						$data['position']=$_POST['position'.$i];
						$data['status']=$_POST['status'.$i];
						$this->db->insert('lineups', $data);
					}
				}
				redirect('/lineups/index/'.$_POST['match_id'].'/'.$_POST['team_id']);
		}
		
		
		$data2['query']=$this->db->query("SELECT *
										 FROM (SELECT p.*, l.id as lid
										 	   FROM  (SELECT p.id, p.first_name, p.last_name
										 		 	  FROM players AS p, players_teams as pt
										 			  WHERE pt.team_id=".$this->uri->segment(4)." AND pt.player_id=p.id) as p
										 	   LEFT JOIN lineups as l on p.id=l.player_id and l.match_id=".$this->uri->segment(3)." and l.team_id=".$this->uri->segment(4)." ORDER BY p.first_name asc,p.last_name desc) as l
										 WHERE l.lid is null");
		
		
		$this->view('lineups_vinsert',$data2);
	}

	
	function delete(){
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('lineups'); 
        redirect('lineups/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('lineups_confirm_delete');	
	}
	
	function add_points(){//cambiar estructura de puntos en tabla
		$this->db->where('id', $_POST['id']);
		$this->db->update('lineups', $_POST); 	
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
