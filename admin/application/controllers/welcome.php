<?php

class Welcome extends CI_Controller {
	var $establet = 0;
	public function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('date');
	}
	
	function index()
	{
        redirect('admin');

		if('http://'.$_SERVER['SERVER_NAME'].'/'!=base_url() and 'http://'.$_SERVER['SERVER_NAME'].'/CI_fe2008/'!=base_url())
			Header('Location: '.base_url());
		
		$this->load->library('user_agent');
				
		$mobiles=array('Apple iPhone','Apple iPod Touch','Android','Windows CE','Symbian S60','Apple iPad',"LG","Nokia");
		//Redirecciono de acuerdo al browser

		if ($this->agent->is_mobile()){
			$m=$this->agent->mobile();
			if($m == "Android" and preg_match('/\bAndroid\b.*\bMobile/i',$this->agent->agent) == 0)
				$m = "Android Tablet";
			switch($m){
				case 'Apple iPad':
                    $this->establet  = 1;
					break;
					
				case 'Android Tablet':
                    $this->establet  = 1;
                    echo "tablet";
					break;
				
				case in_array($m,$mobiles):
					redirect('welcome/movil');
					exit;
					break;
					
				case 'BlackBerry':
					redirect('welcome/blackberry');
					exit;
					break;
					
				default:
					redirect('welcome/wap');
					exit;
			}
			
		}
		
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);

		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos();
		
		//Renderizo el template
		$this->template->render();
		
		
	}
	
	function rotativas(){
		//$this->output->cache(CACHE_DEFAULT);
			
		$this->load->model('story');
		$data['query']=$this->story->get_banner(6,44);
		$excluded = array();
		foreach($data['query'] as $key=>$row){
			$excluded[]=$row->id;
			$data['query'][$key]->sponsored = false;
		}

        //ponemos en caso de existir la noticia ZONA FE

        //recupera  y cambia por la ultima noticia
		$sponsor = current($this->story->get_zonafe($excluded));
		if($sponsor !== FALSE){
			array_pop($data['query']);
			array_push($data['query'], $sponsor);
		}
        //fin poner en caso de existir la ZONEFE

		
		$data['check']=0;
		$this->load->view('stories/rotativa',$data);
	}
	
	function admin(){
		if (!$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){  	 
			redirect('/users/login');  
		}  
	}
	
	function movil(){
		//$this->output->cache(CACHE_MOVIL);
		$this->load->model('module');
		$this->load->model('section');

		$id=0;
		$section[1]=CHAMP_DEFAULT;
		$championship['1']=$this->section->get_champ(SECTION_PRIN); //Campeonato Serie A (Campeonato 1)
		//$championship['2']=MUNDIAL; //Eliminatorias (Campeonato 2)
		
		
		//Cargo los modelos necesarios
		$this->load->model('story');
		$this->load->model('teams_position');
		$this->load->model('championship');
		
		$champ=1;
		if($this->uri->segment(3)!=false)
			$champ=$this->uri->segment(3);
		
		$grp=$this->championship->get_groups($championship[$champ]);
		$sel=1;
		$tabla=false;
		if(is_array($grp)){
			if($this->uri->segment(4)!==FALSE){
				$tabla=$this->teams_position->get_table($grp[$this->uri->segment(4)]['id']);
				$sel=$this->uri->segment(4);
			}
			else{
				$tabla=$this->teams_position->get_table($grp['1']['id']);
			}
		}

		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('movil');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$data='';
		$data['link']='welcome/movil/'.$champ;
		if($champ==1){
	   		$data['logo']='imagenes/template/movil/titulo_logo.jpg';
		}
		else{
   			$data['logo']='imagenes/template/movil/eliminatorias.jpg';
		}
		$this->template->write_view('logo', 'movil/logo', $data, FALSE);
		
		$data='';
		$data['user']=$this->acl->getCurrentUser();
        // cambio Byron Herrera
		//$this->template->write_view('logo', 'movil/fbbutton', $data, FALSE);
		
		$data='';
		$data['type']=1;
		$data['check']=$this->uri->segment(3);
		$this->template->write_view('button1', 'movil/tabs', $data, TRUE);
		
		$data='';
		$data['buttons']['1']['name']='M&aacute;s Noticias';
		$data['buttons']['1']['link']='moviles/more/4/'.$champ;
		$data['buttons']['1']['type']=2;
		$this->template->write_view('button2', 'movil/button2', $data, TRUE);
		
		$data='';
		$data['buttons']['1']['name']='Marcador en Vivo';
		$data['buttons']['1']['link']='moviles/scoreboard/'.$champ;
		$data['buttons']['1']['pic']='imagenes/template/movil/marcador.png';
		$data['buttons']['2']['name']='Calendario & Resultados';
		$data['buttons']['2']['link']='moviles/games/'.$championship[$champ].'/'.$champ.'/0';
		$data['buttons']['2']['pic']='imagenes/template/movil/calendario.png';
		/*if($this->uri->segment(3)==1){
			$data['buttons']['3']['name']='Sud&aacute;frica 2010';
			$data['buttons']['3']['link']='welcome/movil/2';
			$data['buttons']['3']['pic']='imagenes/template/movil/sudafrica.png';
		}else{
			$data['buttons']['3']['name']='F&uacute;tbol Ecuatoriano';
			$data['buttons']['3']['link']='welcome/movil/1';
			$data['buttons']['3']['pic']='imagenes/template/movil/futec.png';
		}*/
		$this->template->write_view('button3', 'movil/button_black', $data, TRUE);
		
		$data='';
		$data['link']=$this->module->get_banner_movil();
		if($data['link']!='')
			$this->template->write_view('banner1', 'movil/banner', $data, TRUE);
		
		
		$data='';
		$data['sel']=$sel;
		$data['grp']=$grp;
		$data['tabla']=$tabla;

		if(is_array($tabla)){
			$this->template->write_view('info2','movil/table_positions',$data,TRUE);
			$data='';
			$data['title']='Tabla de Posiciones';
			$this->template->write_view('title2', 'movil/title', $data, TRUE);
		}

        //leo la tabla de pocisiones Acumulada
        $tabla2 = $this->teams_position->get_table_by_champ(SERIE_A);$data='';
		$data['sel']=$sel;
		$data['grp']=$grp;
        $data['grp'][1]['name']= "";
		$data['tabla']=$tabla2;
 		if(is_array($tabla)){
			$this->template->write_view('info3','movil/table_positions',$data,TRUE);
            $data['title']='Tabla Acumulada';
            $this->template->write_view('title3', 'movil/title', $data, TRUE);
		}
        //fin posiciones Acumuladas

		$data='';
		$noticias='';
		if($champ==1){
			$data['stories']=$this->story->get_by_position('3',$noticias,'1','');
			$noticias['0']=$data['stories']['0']->id;
		}
		else{
			$data['stories']=$this->story->get_by_position('3',$noticias,'1',$section[$champ]);
			$noticias['0']=$data['stories']['0']->id;
		}
		
		$data['section']=$this->uri->segment(3);
		$this->template->write_view('info1', 'movil/stories_first', $data, TRUE);
		
		$data='';
		if($champ==1){
			$data['stories']=$this->story->get_by_position('0',$noticias,'6','');
		}
		else{
			$data['stories']=$this->story->get_by_position('0',$noticias,'6',$section[$champ]);
		}
		
		
		$data['section']=$champ;
		$this->template->write_view('info1', 'movil/stories', $data, FALSE);
		
		$data='';
		$this->load->model('blog');
		$blog=$this->blog->get_last('tribunas');
		if(count($blog)>0)
			$data['link']=base_url().'moviles/read/'.$blog[0]->id.'/1';
		$data['img']=base_url().'imagenes/moviles/button_vt.jpg';
		$data['bg1']="#398BB0";
		$data['bg2']="#0D4664";
		$data['nombre']="La Voz de las Tribunas";
		$this->template->write_view('button2', 'movil/sms_button', $data, FALSE);
		
		$data='';
		$this->load->model('profile');

       //$blog=$this->blog->get_last('taco');
        $blog= $this->story->get_zonafe();
		if(count($blog)>0)
			$data['link']=base_url().'moviles/read/'.$blog[0]->sid.'/1';
		$data['img']=base_url().'imagenes/moviles/button_en.jpg';
		$data['bg1']="#0D4664";
		$data['bg2']="#06618D";
		$data['nombre']="Zona FE";
		$this->template->write_view('button2', 'movil/sms_button', $data, FALSE);
		
		$this->template->render();
	}
	
	function wap(){
		$this->load->library('user_agent');
		$m=$this->agent->mobile();
		if($m=='BlackBerry')
			redirect('welcome/blackberry');
		
		$this->config->set_item('compress_output', 'FALSE');
		$this->load->library('Wap');
		$wml=$this->wap->header();
		$wml.=$this->wap->card_open('1','Principal','');
		$wml.=$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml.=$this->wap->pic('http://stat.wapalizer.com/stat/182879423/','');
		$wml.=$this->wap->p_open();
		
		$links[1]['name']='Noticias';
		$links[1]['link']='waps/more/Noticias';
		$links[2]['name']='Tablas de Posiciones';
		$links[2]['link']='waps/position';
		$links[3]['name']='Resultados';
		$links[3]['link']='waps/last_results';
		$links[4]['name']='Calendario';
		$links[4]['link']='waps/calendary';
		$links[5]['name']='Marcador en vivo';
		$links[5]['link']='waps/scoreboards';
		
		$wml.=$this->wap->button($links);
		$wml.=$this->wap->titles('Secciones');
		$wml.=$this->wap->sections();
		$wml.=$this->wap->p_close();                                                                              
		$wml.=$this->wap->card_close();
		$wml.=$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
	}
	
	
	function blackberry(){
		//$this->output->cache(CACHE_MOVIL);
		
		$id=0;
		$this->load->model('module');
		
		/* FBLOGIN
		if(isset($_GET['auth_token'])){
			$token=$_GET['auth_token'];
			$this->load->library('facebook_connect');
			$session=$this->facebook_connect->fb->do_get_session($token);
			$profile_data = array('uid','first_name', 'last_name', 'name', 'locale', 'pic_square', 'profile_url');
			$info = $this->facebook_connect->fb->api_client->users_getInfo($session["uid"], $profile_data);
			$user = $info[0];
			redirect(base_url().'blackberries/fblogin');
		}
		*/
		
		
		$this->load->model('module');
		//Cargo los modelos necesarios
		$this->load->model('story');
		//Defino primero el template publico para poder escribir ahi los modulos
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
		$data['link']=$this->module->get_banner_movil();
		if($data['link']!='')
			$this->template->write_view('banner1', 'blackberry/banner', $data, TRUE);
		
		$data='';
		$data['name']='Marcador en Vivo';
		$data['link']=base_url().'blackberries/scoreboard';
		$this->template->write_view('info1', 'blackberry/tabs', $data, TRUE);	
		
		$data='';
		$data['name']='Descarga el Icono para tu BB';
		$data['link']=base_url().'blackberries/icons';
		$this->template->write_view('info1', 'blackberry/tabs', $data, FALSE);	
			
		$data='';
		$data['stories']=$this->story->get_by_position('3','','1','');
		$noticias['0']=$data['stories']['0']->id;
		$this->template->write_view('info2', 'blackberry/stories_first', $data, TRUE);
		
		$id=$data['stories']['0']->id;
		
		$data="";
		$data['title']='Noticias';
		$this->template->write_view('info3', 'blackberry/title', $data, TRUE);	
		
		$data='';
		$data['stories']=$this->story->get_by_position('0',$noticias,'9','');
		$this->template->write_view('info3', 'blackberry/stories', $data, FALSE);
		
		
		
		
		$data='';
		$this->load->model('blog');
		$blog=$this->blog->get_last();
		$data['link']=base_url().'blackberries/read/'.$blog[0]->id.'/1/La Voz de las Tribunas';
		$data['img']=base_url().'imagenes/moviles/flecha.png';
		$data['img2']=base_url().'imagenes/moviles/isotipo_s.png';
		$this->template->write_view('info2', 'blackberry/voz_tribuna', $data, FALSE);
		
		$data='';
		$this->load->model('profile');
		$profile=$this->profile->get_last();
		$data['link']=base_url().'blackberries/readProfile/'.$profile->id.'/1/Entrevistas';
		$data['img']=base_url().'imagenes/moviles/flecha.png';
		$data['img2']=base_url().'imagenes/moviles/isotipo_s.png';
		$this->template->write_view('info2', 'blackberry/entrevista', $data, FALSE);
				
		$data='';
		$data['color']="000000";
		$data['link']='http://www.getandgo.ec';
		$data['logo']='imagenes/bb/getandgo.jpg';
		$this->template->write_view('info2', 'blackberry/banners', $data, FALSE);
		
		
		$data="";
		$data['title']='Secciones';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);	
		
		$data="";
		$data['buttons']['1']['name']='Nuestros Embajadores';	
		$data['buttons']['1']['link']='blackberries/more/0/28/Noticias_-_Nuestros_Embajadores';
		$data['buttons']['2']['name']='Serie A';
		$data['buttons']['2']['link']='blackberries/more/0/'.SERIE_A.'/Noticias_-_Serie_A';
		$data['buttons']['3']['name']='Serie B';
		$data['buttons']['3']['link']='blackberries/more/0/'.SERIE_B.'/Noticias_-_Serie_B';
		$data['buttons']['4']['name']='Copa Libertadores';
		$data['buttons']['4']['link']='blackberries/more/0/'.LIBERTADORES.'/Noticias_-_Copa_Libertadores';
		/*$data['buttons']['5']['name']='Eliminatorias 2010';
		$data['buttons']['5']['link']='blackberries/more/0/33/Noticias_-_Eliminatorias_2010';*/
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$data="";
		$data['title']='Resultados & Calendarios';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);	
		
		$data="";
		$data['buttons']['1']['name']='Serie A';	
		$data['buttons']['1']['link']='blackberries/games/'.SERIE_A.'/0/Serie_A';
		$data['buttons']['2']['name']='Serie B';
		$data['buttons']['2']['link']='blackberries/games/'.SERIE_B.'/0/Serie_B';
		$data['buttons']['3']['name']='Copa Libertadores 2011';
		$data['buttons']['3']['link']='blackberries/games/'.LIBERTADORES.'/0/Copa_Libertadores';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		$data="";
		$data['title']='Tablas de Posiciones';
		$this->template->write_view('info3', 'blackberry/title', $data, FALSE);
		
		$data="";
		$data['buttons']['1']['name']='Serie A';	
		$data['buttons']['1']['link']='blackberries/tables/c/'.SERIE_A.'/Serie_A';
		$data['buttons']['2']['name']='Serie B';
		$data['buttons']['2']['link']='blackberries/tables/c/'.SERIE_B.'/Serie_B';
		$data['buttons']['3']['name']='Copa Libertadores';
		$data['buttons']['3']['link']='blackberries/tables/a/'.LIBERTADORES.'/Copa_Libertadores';
		$this->template->write_view('info3', 'blackberry/button', $data, FALSE);
		
		/*$data='';
		$data['link']=base_url().'blackberries/sms_info';
		$data['img']=base_url().'imagenes/moviles/flecha.png';
		$data['img2']=base_url().'imagenes/moviles/isotipo_s.png';
		$this->template->write_view('info2', 'blackberry/sms_button', $data, FALSE);
		*/
		
		
		$this->template->render();
		
	}
	
	function search(){
		//$this->output->cache(CACHE_MENU);
		$this->load->model('story');
		
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');
		
		$this->template->write_view('content', 'public/search_results',"",TRUE);
		
		//Cargo las noticias rotitavias
		$this->load->model('story');
		$data['query']=$this->story->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
		
		//Renderizo el template
		$this->template->render();
	}
	
	function publicMenu(){
		//$this->output->cache(CACHE_MENU);
		
		$this->load->model('teams_position');
		$this->load->model('team');
		
		$positions=$this->teams_position->get_table_by_champ(CHAMP_DEFAULT);
		$teams=array();
		foreach($positions as $key=>$pos){
			$teams[$key]=current($this->team->get($pos['id'])->result());
			$teams[$key]->seccion=$pos['section'];
		}
		
		$data['equipos']=$teams;
		$data['futbol']=array(
							array('id'=>SECTION_SERIE_A,'name'=>'Serie A','image'=>'imagenes/template/menu/fut_nac_02.png','over'=>'imagenes/template/menu/fut_nac_rollover_02.png'),
							array('id'=>SECTION_SERIE_B,'name'=>'Serie B','image'=>'imagenes/template/menu/fut_nac_03.png','over'=>'imagenes/template/menu/fut_nac_rollover_03.png'),
							array('id'=>SECTION_SELECCION,'name'=>'Selección Nacional','image'=>'imagenes/template/menu/fut_nac_04.png','over'=>'imagenes/template/menu/fut_nac_rollover_04.png')
							);
							
		$data['copas']=array(
							array('id'=>SECTION_LIBERTADORES,'name'=>'Copa Libertadores','image'=>'imagenes/template/menu/copas_02.png','over'=>'imagenes/template/menu/copas_rollover_02.png'),
							array('id'=>SECTION_SUDAMERICANA,'name'=>'Copa Sudamericana','image'=>'imagenes/template/menu/copas_03.png','over'=>'imagenes/template/menu/copas_rollover_03.png')
							);
							
		$this->load->view('public/menu',$data);
	
	}
	

}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
