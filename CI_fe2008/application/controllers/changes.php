<?php
class Changes extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('in', 'Entra', '');
		$this->form_validation->set_rules('out', 'Sale', '');
		$this->form_validation->set_rules('minute', 'Minuto', 'required');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
	}
	
	function index()
	{
		$config['base_url']=base_url().'/changes/index/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/';
		$row=$this->db->query('SELECT COUNT(*) AS numrows FROM changes where match_id = '.$this->uri->segment(3).' and team_id = '.$this->uri->segment(4))->result(0);
		$config['total_rows']=$row[0]->numrows;
		$config['per_page']='10';
		$config['uri_segment'] = '5';
		$this->pagination->initialize($config);
		$data['title'] = "CAMBIOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
		if(!$this->uri->segment(5)=='')
	    	$pagina="LIMIT ".$this->uri->segment(5)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
	    $data['query']=$this->db->query('SELECT pin.id, pin.minute, pin.match_id, pin.tname, pin.fnin, pin.lnin, pout.fnout, pout.lnout
	    								 FROM (SELECT c.id, c.minute,   m.id as match_id, t.name tname, p.first_name fnin, p.last_name lnin
										 FROM changes AS c, matches AS m, teams AS t, players AS p
										 WHERE c.match_id = m.id AND m.id ='.$this->uri->segment(3).' AND t.id = c.team_id AND t.id = '.$this->uri->segment(4).' AND p.id=c.in ) as pin,
										 (SELECT c.id, c.minute,   m.id as match_id, t.name tname, p.first_name fnout, p.last_name lnout
										 FROM changes AS c, matches AS m, teams AS t, players AS p
										 WHERE c.match_id = m.id AND m.id ='.$this->uri->segment(3).' AND t.id = c.team_id AND t.id = '.$this->uri->segment(4).' AND p.id=c.out ) as pout
										 WHERE pin.id=pout.id 
										 ORDER BY minute asc '.$pagina);
		$data['query2']=$this->db->query('SELECT m.id, mt.team_id_home, mt.team_id_away
						  FROM matches as m, matches_teams as mt
						  WHERE m.id=match_id and match_id='.$this->uri->segment(3));
		$this->view('changes_view',$data);
	}	

	function insert()
	{
		$data3['title'] = "CAMBIOS ";
		$data3['heading'] = "INGRESO";
		$_POST['match_id']=$this->uri->segment(3);
		$_POST['team_id']=$this->uri->segment(4);
		$_POST['in']=$this->uri->segment(5);
		$_POST['out']=$this->uri->segment(6);
		$_POST['minute']=$this->uri->segment(7);
		if($this->uri->segment(8)=="ingreso"){	   
				$this->db->insert('changes', $_POST);
				$row=$this->db->query("SELECT id, status FROM lineups WHERE match_id = ".$_POST['match_id']." AND player_id=".$_POST['in'])->result(0);
	        	$row2=$this->db->query("SELECT id, status FROM lineups WHERE match_id = ".$_POST['match_id']." AND player_id=".$_POST['out'])->result(0);
	    		$data['status']=2;
	    		if($row2[0]->status==1)
	    			$data2['status']=3;
	    		else
	    			$data2['status']=4;
	        	$this->db->where( 'id',$row[0]->id);
	        	$this->db->update('lineups', $data); 
	        	$this->db->where( 'id',$row2[0]->id);
	        	$this->db->update('lineups', $data2);
				redirect('changes/index/'.$_POST['match_id'].'/'.$_POST['team_id']);
		    	
		}
		
		
		
		$data3['query2']=$this->db->query("SELECT p.id, p.first_name, p.last_name 
										 FROM (SELECT * 
										 	   FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid 
										 	        FROM lineups AS l 
										 	        WHERE (l.status=1 OR l.status=2) and l.match_id =".$this->uri->segment(3)." AND team_id =".$this->uri->segment(4).") as l 
										 	   LEFT JOIN (SELECT id as cid, player_id as cpid FROM cards AS c 
										 	   WHERE c.match_id =".$this->uri->segment(3)." AND team_id =".$this->uri->segment(4)." AND type=2) AS c ON lpid=cpid) as lc, players as p 
									     WHERE cpid is null and lpid=p.id");
		$data3['query']=$this->db->query("SELECT p.id, p.first_name, p.last_name 
										 FROM (SELECT * 
										 	   FROM(SELECT id as lid, match_id as lmid, team_id as ltid, player_id as lpid 
										 	        FROM lineups AS l 
										 	        WHERE l.status=0 and l.match_id =".$this->uri->segment(3)." AND team_id =".$this->uri->segment(4).") as l 
										 	   LEFT JOIN (SELECT id as cid, player_id as cpid FROM cards AS c 
										 	   WHERE c.match_id =".$this->uri->segment(3)." AND team_id =".$this->uri->segment(4)." AND type=2) AS c ON lpid=cpid) as lc, players as p 
									     WHERE cpid is null and lpid=p.id");
		
		$this->load->view('changes_vinsert',$data3);
	}

	function delete()
	{
		$row=$this->db->query("SELECT c.in, c.out FROM changes as c WHERE id = ".$this->uri->segment(3))->result(0);    	
	    $row2=$this->db->query("SELECT id, status FROM lineups WHERE match_id = ".$this->uri->segment(4)." AND player_id=".$row[0]->in)->result(0);
	    $row3=$this->db->query("SELECT id, status FROM lineups WHERE match_id = ".$this->uri->segment(4)." AND player_id=".$row[0]->out)->result(0);
	    $data['status']=0;
	    if($row3[0]->status==4)
	    	$data2['status']=2;
	    else
	    	$data2['status']=1;
	    $this->db->where( 'id',$row2[0]->id);
	    $this->db->update('lineups', $data); 
	    $this->db->where( 'id',$row3[0]->id);
	    $this->db->update('lineups', $data2);
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('changes'); 
        redirect('changes/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
	}

	function confirm_delete(){
		$this->load->view('changes_confirm_delete');	
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
