<?php 
class Blackberries extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('story');
		$this->load->model('profile');
	}
	
	function read(){ //ready
		$this->output->cache(CACHE_MOVIL);
		$this->load->helper('date');
   		$this->load->model('comment');
		$this->template->set_template('blackberry');
   		
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, TRUE);
		
		$data='';
		$data['buttons']['1']['name']='Portada';
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='M&aacute;s Noticias';	
		$data['buttons']['2']['link']='blackberries/more/0/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$data='';
		$data['stories']=$this->story->get_complete($this->uri->segment(3));
		$this->template->write_view('info1', 'blackberry/read', $data, TRUE);
		
		//$data='';
		//$data['comments']=$this->comment->get_all_by_story($this->uri->segment(3));
		//$data['user']=$this->acl->getCurrentUser();
		//$this->template->write_view('info2', 'blackberry/comments', $data, FALSE);
		
		$this->template->render();
		
		$this->story->set_read($this->uri->segment(3));
		
   	}
   	
	function readProfile(){ //ready
		$this->load->helper('date');
   		$this->load->model('comment');
		$this->template->set_template('blackberry');
   		
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, TRUE);
		
		$data='';
		$data['buttons']['1']['name']='Portada';
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='M&aacute;s Noticias';	
		$data['buttons']['2']['link']='blackberries/more/0/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$data='';
		$data['stories']=$this->profile->get2($this->uri->segment(3));
		$this->template->write_view('info1', 'blackberry/profile', $data, TRUE);
		
		//$data='';
		//$data['comments']=$this->comment->get_all_by_story($this->uri->segment(3));
		//$data['user']=$this->acl->getCurrentUser();
		//$this->template->write_view('info2', 'blackberry/comments', $data, FALSE);
		
		$this->template->render();
		
		$this->story->set_read($this->uri->segment(3));
		
   	}
   	
   	
	function more(){ //ready
		$this->output->cache(CACHE_MOVIL);
		$this->load->helper('inflector');
		$this->load->helper('date');
		$this->load->model('story');
   		$this->template->set_template('blackberry');
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
   		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE); 
   		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['title']=humanize($this->uri->segment(5));
		$this->template->write_view('info1', 'blackberry/title', $data, TRUE);
		
		$f=$this->uri->segment(3);
   		$fo=$f-10;
   		$ff=$f+10;
   		$data='';
		
		if($this->uri->segment(4)==1){
			$data['stories']=$this->story->get_by_position('0','','10,'.$f);
		}
		else{
			$data['stories']=$this->story->get_by_position('0','','10,'.$f,$this->uri->segment(4));
		}
		$data['section']=$this->uri->segment(4).'/'.$this->uri->segment(5);
		$this->template->write_view('info2', 'blackberry/more', $data, TRUE);
		

		if($f>5){
			$data['buttons']['1']['name']='Anterior';
			$data['buttons']['1']['link']='blackberries/more/'.$fo.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
			$data['buttons']['1']['type']=1;
		}
		if(count($data['stories'])>=10){
			$data['buttons']['2']['name']='Siguiente';
			$data['buttons']['2']['link']='blackberries/more/'.$ff.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
			$data['buttons']['2']['type']=2;
		}
		$this->template->write_view('info3', 'blackberry/button2', $data, TRUE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='Marcadores en vivo';	
		$data['buttons']['2']['link']='blackberries/scoreboard';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
   		
		$this->template->render();
   	}
   	
   	function scoreboard(){ //ready
   		//$this->output->cache(CACHE_MOVIL);
   		$this->load->helper('date');
   		$this->template->set_template('blackberry');
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
   		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
   		
		//$data='';
		//$data['user']=$this->acl->getCurrentUser();
		//$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['name']='Recargar la P&aacute;gina';
		$data['link']=base_url().'blackberries/scoreboard';
		$this->template->write_view('info1', 'blackberry/tabs', $data, TRUE);
		
		$data='';
   		$data['matches']=$this->matches_today_movil();
   		$this->template->write_view('info2', 'blackberry/scoreboard', $data, TRUE);
		
   		$data='';
		$data['link']='';
		$data['color']='FFFFFF';
		$data['logo']='imagenes/bb/banner_bpichincha.jpg';
		$this->template->write_view('info3', 'blackberry/banners', $data, FALSE);
   		
		$data="";
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);	
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
   		
		$this->template->render();
   	} 
	function single(){ //ready
		$this->output->cache(CACHE_MOVIL);
		$this->load->helper('date');
		$this->template->set_template('blackberry');
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);	
   		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);	
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['name']='Recargar la P&aacute;gina';
		$data['link']=base_url().'blackberries/single/'.$this->uri->segment(3);
		$this->template->write_view('info1', 'blackberry/tabs', $data, TRUE);
		
		$data='';
   		$data['matches']=$this->game_all_movile($this->uri->segment(3));
   		$this->template->write_view('info3', 'blackberry/single', $data, TRUE);
   		
   		$data='';
		$data['link']='';
		$data['color']='2f4e01';
		$data['logo']='imagenes/bb/credife_bb.jpg';
		$this->template->write_view('info3', 'blackberry/banners', $data, FALSE);
		
		$data="";
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);	
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='Marcadores en vivo';	
		$data['buttons']['2']['link']='blackberries/scoreboard';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
   		
   		
		$this->template->render();	
	}
	
	function matches_today_movil(){
		$this->output->cache(CACHE_MOVIL);
		$this->load->helper('date');
		$this->load->model('timer');
		$this->load->model('match_calendary'                       );
		$mttd=$this->match_calendary->today_matches('live');
		$i=1;
		if(!is_array($mttd))
			return 0;
		else{
			foreach($mttd as $row):  
				$aux=strpos(trim($row->result),'-');
				$match[$i]['home']['name']=$row->hname;
				$match[$i]['home']['sname']=$row->hsname;
				$match[$i]['home']['result']=trim(substr(trim($row->result), 0, $aux));		
				$match[$i]['away']['name']=$row->aname;
				$match[$i]['away']['sname']=$row->asname;
				$match[$i]['away']['result']=trim(mb_substr(trim($row->result), $aux+1));	
				$time=$this->timer->cal_time_movil($row->id);
				$match[$i]['minuto']=$time['minuto'];
				$match[$i]['tiempo']=$time['tiempo'];
				$match[$i]['id']=$row->id;
				$match[$i]['fecha']=ucfirst(strftime('%B %d - %H:%M',$row->hour));
				$i+=1;
			endforeach;
			return $match;
		}	
	}
	
	function games(){
		
		$this->load->helper('inflector');
		$this->load->helper('date');
   		$this->load->model('match_calendary');
   		$this->template->set_template('blackberry');
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
   		
   		$data='';
		$data['link']='welcome/blackberry/';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['title']=humanize($this->uri->segment(5));
		$this->template->write_view('info1', 'blackberry/title', $data, TRUE);
		
		$data='';
		$data['query']=$this->match_calendary->match_game($this->uri->segment(3),$this->uri->segment(4));
   		$this->template->write_view('info1', 'blackberry/calendary', $data, FALSE);
		
		$data='';
		$data['buttons']['1']['name']='Anterior';
		$data['buttons']['1']['link']='blackberries/games/'.$this->uri->segment(3).'/'.($this->uri->segment(4)-1);
		$data['buttons']['1']['type']=1;
		$data['buttons']['2']['name']='Siguiente';
		$data['buttons']['2']['link']='blackberries/games/'.$this->uri->segment(3).'/'.($this->uri->segment(4)+1);
		$data['buttons']['2']['type']=2;
		$this->template->write_view('info3', 'blackberry/button2', $data, FALSE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='Marcadores en vivo';	
		$data['buttons']['2']['link']='blackberries/scoreboard';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		
   		
   		
		$this->template->render();
   	} 
	function game_all_movile($id){
		$this->output->cache(CACHE_MOVIL);
		$this->load->helper('date');
			$this->load->model('timer');
		
			$partido=$this->db->query('SELECT m.id, m.group_id, UNIX_TIMESTAMP(m.date_match) as date, m.result, m.stadia_id, mt.team_id_home as hid, mt.team_id_away as aid 
									   FROM matches as m, matches_teams as mt
									   WHERE m.id ='.$this->uri->segment(3).' AND mt.match_id=m.id')->result() ;
			
			$home=$this->db->query('Select *
									From teams
									Where id='.$partido[0]->hid)->result();
			$away=$this->db->query('Select *
									From teams
									Where id='.$partido[0]->aid)->result();
			
			$aux=strpos(trim($partido[0]->result),'-');
			$match['home']['name']=$home[0]->name;
			$match['home']['result']=trim(substr(trim($partido[0]->result), 0, $aux-1));	
			$match['away']['name']=$away[0]->name;
			$match['away']['result']=trim(mb_substr(trim($partido[0]->result), $aux+1));
			$time=$this->timer->cal_time_movil($id);
			$match['minuto']=$time['minuto'];
			$match['tiempo']=$time['tiempo'];
			$match['id']=$id;
			$match['fecha']=mdate('%Y-%m-%d %h:%i',$partido[0]->date);	
			
			$accion=$this->db->query('Select match_time, type, text
									  From actions
									  Where match_id='.$this->uri->segment(3));
			
			$goles=$this->db->query('Select g.minute, p.first_name, p.last_name
								     From goals as g, players as p
									 Where g.match_id='.$this->uri->segment(3).' and p.id=g.player_id');
			
			$tarjetas=$this->db->query('Select c.minute, c.type, p.first_name, p.last_name
										From cards as c, players as p
										Where c.match_id='.$this->uri->segment(3).' and p.id=c.player_id');
			
			$cambios=$this->db->query('Select c.minute, p.first_name as fin, p.last_name as lin, l.first_name as fou, l.last_name as lou
									   From changes as c, players as p, players as l
									   Where c.match_id='.$this->uri->segment(3).' and p.id=c.in and l.id=c.out');
		
			$match['actions']='';
			
			$i=0;
			foreach($goles->result() as $row):
				$match['actions'][$i]['action']='Gol de '.$row->first_name.' '.$row->last_name;
				$match['actions'][$i]['type']=100;
				$match['actions'][$i]['match_time']=$row->minute;
				$i++;
			endforeach;
			$type[1]='Tarjeta Amarilla';
			$type[2]='Tarjeta Roja';
			foreach($tarjetas->result() as $row):
				$match['actions'][$i]['action']=$type[$row->type].' para '.$row->first_name.' '.$row->last_name;
				$match['actions'][$i]['type']=100;
				$match['actions'][$i]['match_time']=$row->minute;
				$i++;
			endforeach;
			foreach($cambios->result() as $row):
				$match['actions'][$i]['action']='Cambio '.$row->fin.' '.$row->lin.' por '.$row->fou.' '.$row->lou;
				$match['actions'][$i]['type']=100;
				$match['actions'][$i]['match_time']=$row->minute;
				$i++;
			endforeach;
			$types['pitazo']=1;
			$types['falta']=2;
			$types['tarjeta']=3;
			$types['penal']=4;
			$types['gol']=5;
			$types['cambio']=6;
			$types['tipo']=7;
			foreach($accion->result() as $row):
				if(is_numeric($row->type))
					$match['actions'][$i]['type']=$row->type;	
				else
					$match['actions'][$i]['type']=$types[$row->type];	
				
				$match['actions'][$i]['action']=$row->text;
				$match['actions'][$i]['match_time']=$row->match_time;
				$i++;						   
			endforeach;
			if($i>0){
				foreach ($match['actions'] as $key=>$arr) {
					$pun[$key] = $arr['match_time'];
					$g1[$key] = $arr['type'];
				}
				array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$match['actions']);
			}

			return $match;
			
	}

	function tables(){
		$this->output->cache(CACHE_MOVIL);
		$this->load->helper('inflector');
		$this->load->model('teams_position');
		$this->load->model('group');
		$this->template->set_template('blackberry');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
   		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE); 
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['title']='Tablas de '.humanize($this->uri->segment(5));
		$this->template->write_view('info1', 'blackberry/title', $data, TRUE);
		
		
		$groups=$this->group->get_by_champ($this->uri->segment(4)); 
		// var_dump($groups);
		foreach($groups as $row):
			$data['tabla']=$this->teams_position->get_table($row->id);
			$data['grp']=$row->name;
			$this->template->write_view('info3', 'blackberry/table_positions', $data, FALSE);
		endforeach; 
		
		if($this->uri->segment(3)=='c'){
			$data['tabla']=$this->teams_position->get_table_by_champ($this->uri->segment(4));
			$data['grp']='Acumulada';
			$this->template->write_view('info3', 'blackberry/table_positions', $data, FALSE);
		}
		 
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='Marcadores en vivo';	
		$data['buttons']['2']['link']='blackberries/scoreboard';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$this->template->render();		
	}
	
	function icons(){
		$this->template->set_template('blackberry');
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
   		
		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data="";
		$data['title']='Iconos';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);	
		
		$data="";
		$data['buttons']['1']['name']='Blackberry Bold';	
		$data['buttons']['1']['link']='archivos/bold/futbolecuador_bbicon.jad';
		$data['buttons']['2']['name']='Blackberry Pearl y Curve (8310)';
		$data['buttons']['2']['link']='archivos/pearl/futbolecuador_bbicon.jad';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='Marcadores en vivo';	
		$data['buttons']['2']['link']='blackberries/scoreboard';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$this->template->render();		
	}
	
	function user_login(){

		$this->template->set_template('blackberry');
		$this->load->library('form_validation');
		$this->config->set_item('compress_output', 'FALSE');
		$this->form_validation->set_rules('nick', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Clave', 'trim|required|md5');
		$data['error']="";
		if(isset($_POST['submit'])){
			if ($this->form_validation->run() == TRUE){
				$aux=$this->acl->login($_POST['nick'],$_POST['password']);

				if($aux){
					$mensaje="<div id='mensaje'>Ha ingresado correctamente.<br><br>";
				    redirect(base_url().'welcome/blackberry');
				}
				else{
					$data['error']="<li>Usuario o Clave incorrectos.</li>";
					$this->template->write_view('info2','blackberry/visit_login',$data, FALSE);
				}
			}
			else{
				$this->template->write_view('info2','blackberry/visit_login',$data, FALSE);
			}
		}
		else{
			$this->template->write_view('info2','blackberry/visit_login',$data, FALSE);
		}
		
		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
		
		$data='';
		$data['title']='Ingreso';
		$this->template->write_view('info1', 'blackberry/title', $data, FALSE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);
		
		$data="";
		$data['buttons']['1']['name']='Portada';	
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='Marcadores en vivo';	
		$data['buttons']['2']['link']='blackberries/scoreboard';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		
		$this->template->render();
	}
	
	function logout(){
		$this->acl->logout('welcome/blackberry');
	}
	
	function fblogin(){
		$this->config->set_item('compress_output', 'FALSE');
		$this->load->model('user');
		$this->load->library('facebook_connect');
		$fb=$this->facebook_connect->user;
		
		
		$data=array(
				'role_id'=>2,
				'first_name'=>$fb['first_name'],
				'last_name'=>$fb['last_name'],
				'nick'=>$fb['name'],
				'mail'=>'',
				'team_id'=>0,
				'suscription'=>0,
				'description'=>'fb:'.$fb['uid'],
				'created'=>time(),
				'modified'=>time(),
				'password'=>$fb['uid'],
				'counter'=>0,
				'active'=>1,
				'last_login'=>time(),
				'activation_key'=>'',
				'points'=>0,
				'country_id'=>0,
				'city_id'=>0,
				'birth'=>time(),
				'sex'=>0
		);
		
		$check=$this->user->check_username($fb['name']);
		
		if($check==TRUE)
			$this->db->insert('users', $data);
			
		$this->acl->login($fb['name'],$fb['uid']);
		
		redirect(base_url().'welcome/blackberry');
	}
	
	function add_comment(){
		$this->config->set_item('compress_output', 'FALSE');
		
		$this->load->model('user');
		$this->load->model('story');
		
		$user=$this->user->get($_POST['user_id']);
		$story=current($this->story->get($this->uri->segment(3)));

		$this->load->helper('date');
		unset($_POST['submit']);
		$_POST['created']=mdate("%Y-%m-%d  %h:%i:%s ",time());
		$_POST['aproved']=0;
		$_POST['text'];
		$_POST['story_id']=$this->uri->segment(3);
		$this->db->insert('comments', $_POST);
		if(substr($user->description,0,3)=="fb:"){
			$this->load->library('facebook_connect'); 
			$action_links = array( array('text' =>'Ir a la noticia', 'href' => base_url().$story->id)); 
   			$caption = $user->first_name.' '.$user->last->name.' hizo un comentario en esta noticia de futbolecuador.com ';
   			$link=base_url().'blackberries/read/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5);
   			$attachment = array( 'name' => $story->title.' - futbolecuador.com','caption' => $caption, 'href' => base_url().$story->id, 'description' => strip_tags(mb_convert_encoding($story->lead, 'UTF-8','HTML-ENTITIES')));
   			$this->facebook_connect->facebook_client()->render_prompt_feed_url($action_links, $target_id=null, $_POST['text'], $user_message_prompt='Has escuchar tu voz',$caption,$link,$link,$attachment);
		}
		else{
			redirect(base_url().'blackberries/read/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
		}
	}
	
	function fbpost(){
		$this->load->library('facebook_connect');
		$user = $this->session->userdata('facebook_user');
		$err=$this->facebook_connect->client->stream_publish($mensaje);
		echo "Errores:<br>";
		var_dump($err);
	}
	
function sms_info(){
		
   		$this->template->set_template('blackberry');
   		
   		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		
   		$data='';
		$data['link']='welcome/blackberry';
		$data['logo']='imagenes/template/blackberry/titulo_logo.jpg';
		$this->template->write_view('logo', 'blackberry/logo', $data, FALSE);
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
		$this->template->write_view('logo', 'blackberry/fbbutton', $data, FALSE);
		
		$data='';
		$data['title']='';
		$this->template->write_view('info3', 'blackberry/title', $data, TRUE);
		
		$data='';
		$data['buttons']['1']['name']='Portada';
		$data['buttons']['1']['link']='welcome/blackberry';
		$data['buttons']['2']['name']='M&aacute;s Noticias';	
		$data['buttons']['2']['link']='blackberries/more/0/1/Noticias';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		
		$data='';
		$data['img']=base_url().'imagenes/moviles/flecha.png';
		$data['img2']=base_url().'imagenes/moviles/isotipo_s.png';
		$data['img3']=base_url().'imagenes/moviles/sms_tel.jpg';
		$data['img4']=base_url().'imagenes/moviles/mp.jpg';
		$this->template->write_view('info1', 'blackberry/sms_info', $data, TRUE);
		
		$this->template->render();
	}
	
}