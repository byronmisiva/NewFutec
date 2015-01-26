<?php
class Goals extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('player_id', 'Jugador', '');
		$this->form_validation->set_rules('minute', 'Minuto', 'required');
		$this->form_validation->set_rules('type', 'Tipo', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	
	function index()
	{
		$config['base_url']=base_url().'/goals/index/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/';
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM goals where match_id = '.$this->uri->segment(3).' and team_id = '.$this->uri->segment(4))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '5';
		$this->pagination->initialize($config);
		$data['title'] = "GOLES ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		if(!$this->uri->segment(5)=='')
	    	$pagina="LIMIT ".$this->uri->segment(5)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query("SELECT g.id, g.minute, g.type,  m.id as match_id, t.name tname, p.first_name, p.last_name
										 FROM goals AS g, matches AS m, teams AS t, players AS p
										 WHERE g.match_id = m.id AND m.id =".$this->uri->segment(3)." AND t.id = g.team_id AND t.id = ".$this->uri->segment(4).' AND p.id=g.player_id 
										 ORDER BY minute asc '.$pagina);
	    $data['query2']=$this->db->query('SELECT m.id, mt.team_id_home, mt.team_id_away
						 				  FROM matches as m, matches_teams as mt
										  WHERE m.id=match_id and match_id='.$this->uri->segment(3));
		$this->view('goals_view',$data);
	}	

	function insert()
	{
		$data['title'] = "GOLES ";
		$data['heading'] = "INGRESO";
		if(isset($_POST['submit'])){	  
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->insert('goals', $_POST);
				redirect('goals/index/'.$_POST['match_id'].'/'.$_POST['team_id']);
		    }	
		}
		$data['query']=$this->db->query("SELECT p.id, p.first_name, p.last_name 
										 FROM (SELECT * 
										 	   FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid 
										 	        FROM lineups AS l 
										 	        WHERE (l.status=1 OR l.status=2) and l.match_id =".$this->uri->segment(3)." AND team_id =".$this->uri->segment(4).") as l 
										 	   LEFT JOIN (SELECT id as cid, player_id as cpid FROM cards AS c 
										 	   WHERE c.match_id =".$this->uri->segment(3)." AND team_id =".$this->uri->segment(4)." AND type=2) AS c ON lpid=cpid) as lc, players as p 
									     WHERE cpid is null and lpid=p.id");
		$this->load->view('goals_vinsert',$data);
	}

	function delete()
	{
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('goals'); 
		redirect('goals/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
	}

	function confirm_delete(){
		$this->load->view('goals_confirm_delete');	
	}
	
	function update()
	{
		$data['title'] = "GOLES ";
		$data['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	  
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
        		$this->db->update('goals', $_POST); 
        		redirect('goals/index/'.$_POST['match_id'].'/'.$_POST['team_id']);
		    }	
		}
		$this->db->where( 'id',$this->uri->segment(3));
		$data['query']=$this->db->get('goals');
		$data['query2']=$this->db->query("SELECT p.id, p.first_name, p.last_name
										 FROM players AS p, players_teams as pt
										 WHERE pt.team_id=".$this->uri->segment(5)." AND pt.player_id=p.id");
		$this->view('goals_vupdate',$data);
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
