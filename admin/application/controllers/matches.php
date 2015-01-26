<?php
class Matches extends CI_Controller {
	
	var $actions_type;
	var $states;
	
	function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('team_id_home', 'Local', 'required');
		$this->form_validation->set_rules('team_id_away', 'Visitante', 'required');
		$this->form_validation->set_rules('schedule_id', 'Jornada', 'required');
		$this->form_validation->set_rules('stadia_id', 'Estadio', 'required');
		$this->form_validation->set_rules('referee_id_central', '&Aacute;rbitro Central', '');
		$this->form_validation->set_rules('referee_id_line1', '&Aacute;rbitro Linea 1', '');
		$this->form_validation->set_rules('referee_id_line2', '&Aacute;rbitro Linea 2', '');
		$this->form_validation->set_rules('referee_id_sub', '&Aacute;rbitro Suplente', '');
		$this->form_validation->set_rules('date_match', 'Fecha', 'required');
		$this->form_validation->set_rules('state', 'Tiempo', '');
		$this->form_validation->set_rules('minute_match', 'Minuto', 'is_natural');
		$this->form_validation->set_rules('result', 'Resultado', '');
		$this->form_validation->set_rules('special', 'Especial', '');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		$this->template->add_js('js/calendar.js');
		$this->template->add_js('js/ajax.js');
		$this->template->add_css('css/calendar.css');
		$this->load->model('match','model');
		$this->load->model('gaco_match');
		
		$path="imagenes/icons/";
		$this->actions_type=array('gol'=>$path."gol.png",'falta'=>$path."tarjeta.png",'tarjeta'=>$path."tarjeta.png",'pitazo'=>$path."arbitro.png",
							'92'=>$path."arbitro.png",'93'=>$path."arbitro.png",'94'=>$path."arbitro.png",
							'95'=>$path."arbitro.png",'96'=>$path."arbitro.png",'97'=>$path."arbitro.png",
							'98'=>$path."arbitro.png",'99'=>$path."arbitro.png",'2'=>$path."tarjeta_roja.png",
							'1'=>$path."tarjeta_amarilla.png",'in'=>$path."entra.png",'out'=>$path."sale.png",'tipo'=>$path.'player.png','cambio'=>$path.'cambio.png');
		
		$this->states=array(0=>'No Iniciado',1=>'Primer Tiempo',2=>'Fin del Primer Tiempo',3=>'Segundo Tiempo',4=>'Fin del Segundo Tiempo',
							5=>'Primer Extra',6=>'Segundo Extra',7=>'Penales',8=>'Final del Partido');
		
	}
	
	function publica(){
		
		$id=$this->uri->segment(3);
		if($id!=""){
			$this->load->model('section');
			//Defino primero el template publico para poder escribir ahi los modulos
			$this->template->set_template('public');
			$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
			$this->template->write('path',base_url(),TRUE);
			$data=$this->model->get_full($id);
			$data['actions_type']=$this->actions_type;
			$data['states']=$this->states;
			$this->template->write_view('content', $this->model->name.'/public',$data, TRUE);
			
			//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
			$this->load->helper('modul');
			$modulos=new Modul();
			
			$modulos->section->championship_id=$data['partido']->championship_id;
			$modulos->noticias[]=$id;  //Añado el id de la noticia actual para que no se repita
			$modulos->set_modulos(0,'laterals');
			
			$this->template->render();
		}
		else
			redirect();	
	}
	
	function index(){
		$config['base_url']=base_url().'/matches/index/'.$this->uri->segment(3);
		$row=current($this->db->query('SELECT COUNT(*) AS numrows FROM matches where group_id = '.$this->uri->segment(3))->result());
		if($row->numrows > 0)
			$config['total_rows']=$row->numrows;
		else
			$config['total_rows']=0;
		$config['per_page']='10';
		$config['uri_segment'] = '4';
		$this->pagination->initialize($config);
		$data['title'] = "PARTIDOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    if(!$this->uri->segment(4)=='')
	    	$pagina="LIMIT ".$this->uri->segment(4)." , ".$config['per_page'];
	    else
	    	$pagina="LIMIT ".$config['per_page'];
		$data['query']=$this->db->query("SELECT mg.*, ms.sname, hname, aname, hid, aid, UNIX_TIMESTAMP(mg.date_match)
										 FROM((SELECT m.id, m.group_id, m.date_match, m.state, m.minute_match, m.result, m.story_id, g.name as gname, m.live 
											   FROM matches as m, groups as g 
											   WHERE m.group_id = g.id and g.id=".$this->uri->segment(3).") as mg,
											  (SELECT m.id, s.name as sname 
											   FROM matches as m, stadia as s 
											   WHERE m.stadia_id = s.id and m.group_id=".$this->uri->segment(3).") as ms,
											  (SELECT m.id , t.name hname, t.id as hid
											   FROM matches as m, teams as t, matches_teams as mt
											   WHERE m.id = mt.match_id and mt.team_id_home=t.id and m.group_id=".$this->uri->segment(3).") as mth,
											  (SELECT m.id , t.name aname, t.id as aid
											   FROM matches as m, teams as t, matches_teams as mt
										       WHERE m.id = mt.match_id and mt.team_id_away=t.id and m.group_id=".$this->uri->segment(3).") as mta)
										 WHERE mg.id=ms.id and mg.id=mth.id and mg.id=mta.id 
										 ORDER BY date_match desc ".$pagina);
		$data['query2']=$this->db->query('SELECT round_id
						 				  FROM groups
						  				  WHERE id='.$this->uri->segment(3));
		
		$cn=$this->db->query("SELECT c.name as cname, r.name as rname, g.name as gname, c.id, r.last
							  FROM championships as c, rounds as r, groups as g
							  WHERE g.id=".$this->uri->segment(3)." AND g.round_id=r.id AND r.championship_id=c.id")->result();
	
		
		/*$data['gaco_matches']=$this->db->query("SELECT gm.*, t1.name as hname, t2.name  as aname
												FROM (SELECT gm. *
													  FROM gaco_matches AS gm
													  WHERE gm.group_id=".$this->uri->segment(3).") AS gm
												LEFT JOIN matches_teams AS mt ON gm.match_id = mt.match_id
												LEFT JOIN teams AS t1 ON mt.team_id_home = t1.id
												LEFT JOIN teams AS t2 ON mt.team_id_away = t2.id");
		*/
		
		//$data['gaco_matches']=$this->gaco_match->get_matches($this->uri->segment(3));
		
		$data['gaco_matches']=$this->gaco_match->get_matches($this->uri->segment(3));
		
		$data['from']=strtoupper($cn[0]->cname.' / '.$cn[0]->rname.' / '.$cn[0]->gname);
		$data['ifrm']=$cn[0]->id.'/'.$cn[0]->last;		
		$this->view('matches/matches_view',$data);
	}	

	function insert(){
		
		$this->load->model('referee');
		$data4['title'] = "PARTIDOS ";
		$data4['heading'] = "INGRESO";
		
		if(isset($_POST['submit'])){
			if(isset($_POST['gaco'])){
				if($this->form_validation->run()==TRUE){
					unset($_POST['submit']);
					unset($_POST['gaco']);
					if($_POST['minute_match']=='')
			   			$_POST['minute_match']=0;
			   		if($_POST['referee_id_central']==0)
			   			$_POST['referee_id_central']=NULL;
			   		if($_POST['referee_id_line1']==0)
			   			$_POST['referee_id_line1']=NULL;
			   		if($_POST['referee_id_line2']==0)
			   			$_POST['referee_id_line2']=NULL;
			   		if($_POST['referee_id_sub']==0)
			   			$_POST['referee_id_sub']=NULL;
			   		$data['result']='0 - 0';
					$this->db->insert('gaco_matches',$_POST);
					redirect('matches/index/'.$_POST['group_id']);
				}
			}
			else{
				if($this->form_validation->run()==TRUE){
					unset($_POST['submit']);
		   			if($_POST['minute_match']=='')
		   				$_POST['minute_match']=0;
		   			if($_POST['referee_id_central']==0)
		   				$_POST['referee_id_central']=NULL;
		   			if($_POST['referee_id_line1']==0)
		   				$_POST['referee_id_line1']=NULL;
		   			if($_POST['referee_id_line2']==0)
		   				$_POST['referee_id_line2']=NULL;
		   			if($_POST['referee_id_sub']==0)
		   				$_POST['referee_id_sub']=NULL;
		   			$data['result']='0 - 0';
			    	$data['group_id']=$_POST['group_id'];
			    	$data['date_match']=$_POST['date_match'];
		   			$data['state']=$_POST['state'];
		   			$data['minute_match']=$_POST['minute_match'];
		   			$data['result']=$_POST['result'];
		   			$data['stadia_id']=$_POST['stadia_id'];
		   			$data['schedule_id']=$_POST['schedule_id'];	
		   			$data['special']=$_POST['special'];
		   			$data['live']=$_POST['live'];
		   			if($_POST['story_id']>0)
		   				$data['story_id']=$_POST['story_id'];
		   			$data2['team_id_home']=$_POST['team_id_home'];
		   			$data2['team_id_away']=$_POST['team_id_away'];
		   			$data3['referee_id_central']=$_POST['referee_id_central'];
		   			$data3['referee_id_line1']=$_POST['referee_id_line1'];
		   			$data3['referee_id_line2']=$_POST['referee_id_line2'];
		   			$data3['referee_id_sub']=$_POST['referee_id_sub'];
		   			if($this->db->insert('matches', $data)){
		   				$data2['match_id']=$this->db->insert_id();
		   				$data3['match_id']=$this->db->insert_id();
		   				$this->db->insert('matches_teams', $data2);
		   				$this->db->insert('matches_referee', $data3);				
	   				}
		    		redirect('matches/index/'.$_POST['group_id']);
			    }
			}	
		}
		$data4['query']=$this->db->query('Select t.id, t.name 
										  From championships_teams as ct, teams as t,
     										   (Select distinct(c.id)
     											From groups as g, rounds as r, championships as c
     											Where g.id='.$this->uri->segment(3).'  and g.round_id=r.id and r.championship_id=c.id) as c
										  Where c.id=ct.championship_id and ct.team_id=t.id');
		$data4['referees']=$this->referee->get_list();
		$data4['query2']=$this->db->get('stadia');
		$data4['query5']=$this->db->query('SELECT *
										   FROM (SELECT s.id, s.title, s.created
      											 FROM stories as s
      											 ORDER BY s.created DESC
      											 LIMIT 50) as s
										   ORDER BY s.title ASC');
		$data4['query3']=$this->db->query('SELECT s.id, s.season
										  FROM groups as g, schedules as s
										  WHERE g.id='.$this->uri->segment(3).' AND g.round_id=s.round_id');
		$data4['query6']=$this->db->query('SELECT r.last, r.championship_id, r.id
										   FROM rounds as r, groups as g
										   WHERE g.id='.$this->uri->segment(3).' AND g.round_id=r.id');
		$this->view('matches/matches_vinsert',$data4);
		
	}
	
	function delete()
	{
		$this->db->query('Update gaco_matches
 							 Set match_id=NULL
							 Where match_id='.$this->uri->segment(3));
		
		$this->db->where( 'match_id',$this->uri->segment(3));
        $this->db->delete('matches_teams'); 
        $this->db->where( 'match_id',$this->uri->segment(3));
        $this->db->delete('matches_referee'); 
		$this->db->where( 'id',$this->uri->segment(3));
        $this->db->delete('matches'); 
		redirect('matches/index/'.$this->uri->segment(4));
	}
	
	function delete_gaco()
	{
		$this->gaco_match->delete($this->uri->segment(3));
		redirect('matches/index/'.$this->uri->segment(4));
	}
	
	function confirm_delete(){
		$this->load->view('matches/matches_confirm_delete');	
	}
	
	function gaco_confirm_delete(){
		$this->load->view('matches/gaco_confirm_delete');	
	}
	
	function update(){
	
		$this->load->model('referee');
		$this->load->model('group');
		$this->load->model('team');
		
		$data4['title'] = "PARTIDOS ";
		$data4['heading'] = "ACTUALIZAR";
		if(isset($_POST['submit'])){	    
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
	   			if($_POST['minute_match']=='')
	   				$_POST['minute_match']=0;
	   			if($_POST['referee_id_central']==0)
		   			$_POST['referee_id_central']=NULL;
	   			if($_POST['referee_id_line1']==0)
	   				$_POST['referee_id_line1']=NULL;
	   			if($_POST['referee_id_line2']==0)
	   				$_POST['referee_id_line2']=NULL;
	   			if($_POST['referee_id_sub']==0)
	   				$_POST['referee_id_sub']=NULL;
		  		$data['group_id']=$_POST['group_id'];
		    	$data['date_match']=$_POST['date_match'];
	   			$data['state']=$_POST['state'];
	   			$data['minute_match']=$_POST['minute_match'];
	   			
	   			if($_POST['result'] == "")
	   				$data['result']="0 - 0";
	   			else
	   				$data['result']=$_POST['result'];
	   			
	   			$data['stadia_id']=$_POST['stadia_id'];
	   			$data['schedule_id']=$_POST['schedule_id'];	  
	   			$data['special']=$_POST['special'];
	   			 			
	   			$data['live']=$_POST['live'];
	   			$data['story_id']=NULL;
	   			if($_POST['story_id']>0)
	   				$data['story_id']=$_POST['story_id'];
	   			$data2['team_id_home']=$_POST['team_id_home'];
	   			$data2['team_id_away']=$_POST['team_id_away'];
	   			$data3['referee_id_central']=$_POST['referee_id_central'];
	   			$data3['referee_id_line1']=$_POST['referee_id_line1'];
	   			$data3['referee_id_line2']=$_POST['referee_id_line2'];
	   			$data3['referee_id_sub']=$_POST['referee_id_sub'];
	   			/*
	   			if($data['state']==8){
	   				$this->load->model('gaco_match');
	   				$this->gaco_match->generate_matches($data['group_id']);
	   			}
	   			*/
	   			$this->db->where( 'id',$_POST['id']);
	   			if($this->db->update('matches', $data)){
	   				$this->db->where( 'match_id',$_POST['id']);
	   				$this->db->update('matches_teams', $data2);
	   				$this->db->where( 'match_id',$_POST['id']);
	   				$this->db->update('matches_referee', $data3);
	   			}
   				redirect('matches/index/'.$_POST['group_id']);
		    }	
		}
		
		$match=$this->model->get($this->uri->segment(3));
		$data4['match']=$match;

		$data4['teams'] = $this->team->get_list_championship($this->group->get_champ($match->group_id));
		
		$data4['matches_team']=$this->team->get_by_match($match->id);
		$data4['matches_referees']=$this->referee->get_by_match($match->id);
		
		$data4['stadiums']=$this->db->get('stadia');
		$data4['referees']=$this->referee->get_list();
		
		$data4['stories']=$this->db->query('SELECT *
										   FROM (SELECT s.id, s.title, s.created
      											 FROM stories as s
      											 ORDER BY s.created DESC
      											 LIMIT 50) as s
										   ORDER BY s.title ASC');
		
		$data4['seasons']=$this->db->query('SELECT s.id, s.season
										  FROM groups as g, schedules as s
										  WHERE g.id='.$match->group_id.' AND g.round_id=s.round_id');
		$data4['group']=$match->group_id;
		
		$data4['states']=$this->states;
		
		$this->view('matches/update',$data4);
	}	
	
	function matches_options()
	{
		$data['title']='OPCIONES DEL ';
		$data['heading']=' PARTIDO';
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
	    $data['time']=time();
	    $data['query']=$this->db->query("SELECT t.id, t.name 
	    								 FROM teams as t
	    								 WHERE t.id=".$this->uri->segment(4)." OR t.id=".$this->uri->segment(5)); 
		$data['query2']=$this->db->query('SELECT group_id
						  				  FROM matches
						  				  WHERE id='.$this->uri->segment(3));
	    $this->view('matches/matches_options_view',$data);
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
	
	function matches_today_view(){
		$this->load->model('match_calendary');
		$data['title'] = "PARTIDOS ";
		$data['heading'] = "DE HOY";	
	   	$data['query']= $this->match_calendary->today_matches('');
			
		$this->view('matches/matches_today_view',$data);
	}
	
	function late_games(){
		$this->load->model('match_calendary');	
		$data['title'] = "PARTIDOS ";
		$data['heading'] = "ATRASADOS";	
	   	$data['query']= $this->match_calendary->late_games();
		$this->view('matches/last_games',$data);
	}
	//TODO: Partidos por jugarse
	
	function update_result(){
		$matches=$this->model->get_all();
		foreach($matches as $row){
			$home=$this->model->get_goals($row->id,$row->e1);
			$away=$this->model->get_goals($row->id,$row->e2);
			$result=$home.' - '.$away;
			$this->db->where('id', $row->id);
			$this->db->update($this->model->name,array('result'=>$result)); 
		}
	}
	
	function select_teams(){
		$this->config->set_item('compress_output', 'FALSE');
		$lovi['1']='team_id_home';
		$lovi['2']='team_id_away';
		
		$query=$this->db->query('Select t.id, t.name 
								 From championships_teams as ct, teams as t,
     								 (Select distinct(c.id)
     								  From groups as g, rounds as r, championships as c
     								  Where g.id='.$this->uri->segment(3).'  and g.round_id=r.id and r.championship_id=c.id) as c
								 Where c.id=ct.championship_id and ct.team_id=t.id');
		
		echo '<select name="'.$lovi[$this->uri->segment(4)].'">';
		foreach($query->result() as $row): 
			echo '<option value="'.$row->id.'">'.$row->name.'</option>';
		endforeach;
		echo '</select>';
	}
	
	function select_qualified(){
		$this->config->set_item('compress_output', 'FALSE');
		$lovi['1']='team_id_home';
		$lovi['2']='team_id_away';
		
		$dts=$this->db->query('Select r.championship_id, r.id, r.last
							   From rounds as r, groups as g
							   Where g.id='.$this->uri->segment(3).' and g.round_id=r.id')->row();
		
		$grps=$this->db->query('Select *
								From groups as g
								Where g.round_id='.$dts->last);
		
		$row=$this->db->query('Select *
							   From gaco
							   Where id='.$this->uri->segment(5))->row();
		
		$pass=$row->num_pass;
		$best=$row->num_best;
		$i=0;
		
		echo '<select name="'.$lovi[$this->uri->segment(4)].'">';	
		
		if($row->list==0){

			if($best==0)
				$pass+=1;

			foreach($grps->result() as $row):
				for($i=1;$i<$pass;$i++){
					echo '<option value="'.$i.'_'.$row->id.'">'.$i.' '.$row->name.'</option>';
				}
			
			endforeach;
			
			for($i=1;$i<=$best;$i++){
				echo '<option value="'.$i.'_b_'.$pass.'">'.$i.' mejor '.$pass.'</option>';
			}
		
		}
		else{
			if($best!=0)
				$pass-=1;
			$tts=(($grps->num_rows())*$pass)+($best);
			for($i=1;$i<=$tts;$i++)
				echo '<option value="'.$i.'">'.$i.'</option>';
		}
	
		
		echo '</select>';
	} 
	
	function select_games(){
		$this->config->set_item('compress_output', 'FALSE');
		$groups='';
		$lovi['1']='team_id_home';
		$lovi['2']='team_id_away';
		
		$dts=$this->db->query('Select r.championship_id, r.id, r.last
							   From rounds as r, groups as g
							   Where g.id='.$this->uri->segment(3).' and g.round_id=r.id')->row();
		
		$grps=$this->db->query('Select *
								From groups as g
								Where g.round_id='.$dts->last);
		
		$gaco=$this->db->query('Select *
							    From gaco
							    Where id='.$this->uri->segment(5))->row();
		
		$g_games=$this->db->query('Select gm.*
								   From gaco_matches as gm, groups as g
								   Where g.round_id='.$dts->last.' and gm.group_id=g.id');
		
		
		
		$games=$this->db->query('Select m.*, t.name as th, t2.name as ta
								 From matches as m, groups as g, matches_teams as mt, teams as t, teams as t2
								 Where g.round_id='.$dts->last.' and g.id=m.group_id and m.id=mt.match_id and mt.team_id_home=t.id and mt.team_id_away=t2.id');	
		
		foreach($grps->result() as $row):
			$groups[$row->id]=$row->name;
		endforeach;
		
		
		$i=0;
		
		echo '<select name="'.$lovi[$this->uri->segment(4)].'">';	
		
		if($gaco->win_loser==0){
			
			if($g_games->num_rows()==0){
				foreach($games->result() as $row):
					echo '<option value="g_'.$row->id.'">'.$row->th.' vs '.$row->ta.'</option>';
				endforeach;
			}
			
			foreach($g_games->result() as $row):		
				$tih=$this->get_names($row->team_id_home,$row->sdt1);
				$tia=$this->get_names($row->team_id_away,$row->sdt2);			
				echo '<option value="g_'.$row->id.'">'.$row->id.'</option>';//.$tih.' vs '.$tia.
			endforeach;

		}
		else{
			if($g_games->num_rows()==0){
				foreach($games->result() as $row):
					echo '<option value="g_'.$row->id.'">Ganador '.$row->th.' vs '.$row->ta.'</option>';
					echo '<option value="l_'.$row->id.'">Perdedor '.$row->th.' vs '.$row->ta.'</option>';
				endforeach;
			}
			
			foreach($g_games->result() as $row):
				$tih=$this->get_names($row->team_id_home,$row->sdt1);
				$tia=$this->get_names($row->team_id_away,$row->sdt2);			
				echo '<option value="g_'.$row->id.'">Ganador '.$row->id.'</option>';
				echo '<option value="l_'.$row->id.'">Perdedor '.$row->id.'</option>';
			endforeach;
		
		}
		
		echo '</select>';
	}
	
	function get_names($name,$std){
		if($std==1){
			if(strpos($name,'g')===FALSE || strpos($name,'l')===FALSE){
				return $name;	
			}
			else{
				$match=explode('_',$name);
				
				$mt=$this->db->query('Select t.name as th, t2.name as ta
									  From matches_teams as mt, teams as t, teams as t2
									  Where mt.team_id_home=t.id and mt.team_id_away=t2.id and mt.match_id='.$match[1])->row();

				$aux=$mt->th.' vs '.$mt->ta;
				return $aux;
			}
		}
		
		if($std==2){
			$team=$this->db->query('Select name
							  		From teams
							  		Where id='.$name)->row();
			return $team->name;
		}
		
		if($std==3){
			
			if(!is_numeric($name)){
			
				if(strpos($name,'b')!==FALSE){
					$clas=explode('_',$name);
					return ''.$clas[0].' mejor '.$clas[2];
				}
				else{
					$clas=explode('_',$name);
					
					$grp=$this->db->query('Select name
									  	   From groups
									  	   Where id='.$clas[1])->row();
					
					$aux=$clas[0].' '.$grp->name;
					
					return $aux;
				}
				
			}
			
			else
				return $name;
			
		}
	}
	
	function check_radios(){
		$this->config->set_item('compress_output', 'FALSE');
		$opt['1']='opt_home';
		$opt['2']='opt_away';
		
		$row=$this->db->query('Select r.championship_id, r.id
						  	   From groups  as g, rounds as r
						  	   Where g.id='.$this->uri->segment(3).' and r.id=g.round_id')->row();
		
		$row=$this->gaco_rules($row->championship_id,$row->id);
		
		if($this->uri->segment(4)==1 && $row->type==1){
			echo '<input type="radio" id="st2" name="sdt'.$this->uri->segment(5).'" value="2" checked onChange="select_load(\''.base_url().'matches/\',\''.$opt[$this->uri->segment(5)].'\',\'2\',\''.$this->uri->segment(3).'\',\''.$this->uri->segment(5).'\',\'0\');"/>Equipo
				  <input type="radio" id="st1" name="sdt'.$this->uri->segment(5).'" value="1" onChange="select_load(\''.base_url().'matches/\',\''.$opt[$this->uri->segment(5)].'\',\'1\',\''.$this->uri->segment(3).'\',\''.$this->uri->segment(5).'\',\''.$row->id.'\');"/>Partidos';
			echo form_hidden('gaco_id',$row->id);
		}
		else {
			if($this->uri->segment(4)==1 && $row->type==2){
				echo '<input type="radio" id="st2" name="sdt'.$this->uri->segment(5).'" value="2" checked onChange="select_load(\''.base_url().'matches/\',\''.$opt[$this->uri->segment(5)].'\',\'2\',\''.$this->uri->segment(3).'\',\''.$this->uri->segment(5).'\',\'0\');"/>Equipo
					  <input type="radio" id="st3" name="sdt'.$this->uri->segment(5).'" value="3" onChange="select_load(\''.base_url().'matches/\',\''.$opt[$this->uri->segment(5)].'\',\'3\',\''.$this->uri->segment(3).'\',\''.$this->uri->segment(5).'\',\''.$row->id.'\');"/>Clasificado';
				echo form_hidden('gaco_id',$row->id);
			}
			else{
				echo '';
			}
		}
	}
	
	function gaco_rules($champ,$round){
		$query=$this->db->query('Select *
						  		 From gaco
						  		 Where championship_id='.$champ);
	
		foreach($query->result() as $row):
			if($this->gaco_inside($row->start_round, $row->end_round,$round)){
				return $row;
			}
		endforeach;
		
	}
	
	function gaco_inside($start,$end,$round){
		$i=0;

		if($start==$end)
			$i=-1;
		else{
			if($end==$round)
				$i=1;
			if($start==$round)
				$i=-1;
		}
			
		while($i==0){
			$row=$this->db->query('Select last
								   From rounds
							  	   Where id='.$end)->row();
			
			if($row->last==$start)
				$i=-1;
			else{
				if($row->last==$round)
					$i=1;
				if($row->last==0)
					$i=-1;
			}		
			$end=$row->last;
		}
		
		
		if($i==1)
			return true;
		else
			return false;
	}
	
	function update_referees(){
		$this->db->where('match_id', $_POST['match_id']);
		$this->db->update('matches_referee', $_POST);
	}
}
?>