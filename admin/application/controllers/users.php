<?php
class Users extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('user','model');
		$this->load->model('rol');
		$this->load->model('team');
		$this->swfCharts=base_url().'Charts/Line.swf' ;
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('fusioncharts') ;
		$this->template->add_js('js/FusionCharts.js');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->library('table');
		$this->template->add_css('css/calendar.css');
		$this->template->add_js('js/calendar.js');
		$this->load->library('session');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		//Validacion ACL
		$this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2));
		//echo $this->session->userdata('mensaje');
	}

	function index(){
		$data['title'] = "USUARIOS ";
		$data['heading'] = "ACCESO";
		$data['datestring']="%Y-%m-%d  %h:%i %a ";
		$data['time']=time();
		$data['query']=$this->model->get_all($this->uri->segment(3));
		//Visualizacion
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $this->model->name.'/view',$data, TRUE);
		$this->template->render();
	}

	function search(){
		$data['title']="BUSQUEDA DE";
		$data['heading']=" USUARIOS";
		$data['users']='';
		$this->form_validation->set_rules('search', 'Busqueda', '');
		if($this->uri->segment(3)==1){
			$this->form_validation->run()==TRUE;
			if(strrpos($_POST['search'], "@")===FALSE){
				$data['users']=$this->db->query('Select distinct(id), first_name, last_name, nick, mail
												 From users
								  		 		 Where first_name like "%'.$_POST['search'].'%"
								    	   		    Or last_name like "%'.$_POST['search'].'%"
								    	   		    Or nick like "%'.$_POST['search'].'%"
								  		 		 Order by last_name, first_name, nick');
			}
			else{
				$data['users']=$this->db->query('Select distinct(id), first_name, last_name, nick, mail
									     		 From users
								  		 		 Where mail like "%'.$_POST['search'].'%"
								  		 		 Order by last_name, first_name, nick');
			}
		}
		$this->view('users/search',$data);
	}

	function statistics(){
		$data['title']='ESTADISTICAS';
		$data['heading']=' POR D&Iacute;A';
		if(isset($_POST['submit'])){
			$fechah=$_POST['fechah'];
			$fechaa=$_POST['fechaa'];
			unset($_POST['submit']);
		}
		else{
			$fechah=mdate('%Y-%m-%d',time());
			$fechaa=$this->model->calcularFecha($fechah,-30);
		}
		$query=$this->model->statistics($fechah,$fechaa);
		$paso=1;

		if($query->num_rows()>10){
			$paso=round($query->num_rows()/10,0);
		}


		$request="<chart caption='Grafica de Usuarios Ingresados' subcaption='Desde ".$fechaa." Hasta ".$fechah."' xAxisName='Dia' yAxisName='Vistas' yAxisMinValue='0' showValues='0' alternateHGridColor='FCB541' alternateHGridAlpha='20' divLineColor='FCB541' divLineAlpha='50' canvasBorderColor='666666' baseFontColor='666666' lineColor='FCB541' labelStep='".$paso."' labelDisplay='Rotate' slantLabels='1' >";
		foreach($query->result() as $row):
		$request=$request."<set label='".mdate('%Y-%m-%d',$row->created2)."' value='".$row->num."'/>";
		endforeach;

		$request=$request."<styles><definition><style name='Anim1' type='animation' param='_xscale' start='0' duration='1'/><style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6'/><style name='DataShadow' type='Shadow' alpha='40'/></definition><application><apply toObject='DIVLINES' styles='Anim1'/><apply toObject='HGRID' styles='Anim2'/><apply toObject='DATALABELS' styles='DataShadow,Anim2'/></application></styles></chart>";

		$data['graph'] = $this->fusioncharts->renderChart($this->swfCharts,'',$request,"productSales", 600, 400, false, false) ;
		$data['fechah']=$fechah;
		$data['fechaa']=$fechaa;

		$total=0;
		foreach($query->result() as $row):
		$total=$total+$row->num;
		endforeach;

		$i=0;
		foreach($query->result() as $row):
		$stat[$i]['date']=mdate('%Y-%m-%d',$row->created2);
		$stat[$i]['view']=$row->num;
		$stat[$i]['percent']=round($row->num*100/$total,2);
		$i+=1;
		endforeach;

		$stat[$i]['date']='Total';
		$stat[$i]['view']=$total;
		$stat[$i]['percent']=100;
		$data['stat']=$stat;
		$data['total']=$this->model->statistics_all();
		$this->view('users/statistics',$data);
	}


	function insert(){
		$this->template->add_js('js/ajax.js');
		$this->load->model('country');
		$this->load->model('city');

		$data['title'] = "USUARIOS ";
		$data['heading'] = "INGRESO";
		$data['teams']=$this->team->get_list_ec();
		$data['roles']=$this->rol->get_list();
		$data['countries']=$this->country->get_list();
		$data['cities']=array(''=>"Seleccione una Ciudad...");

		$this->form_validation->set_rules('role_id', 'Rol', 'required');
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('nick', 'Apodo', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('mail', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('country_id', 'Pais', 'required');
		$this->form_validation->set_rules('city_id', 'Ciudad', 'required');
		$this->form_validation->set_rules('team_id', 'Equipo', 'required');
		$this->form_validation->set_rules('suscription', 'Suscripcion', 'required|numeric');
		$this->form_validation->set_rules('password', 'Clave', 'trim|required|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'Confirmación de Clave', 'trim|required');
		$this->form_validation->set_rules('birth', 'Fecha de Nacimiento', 'required');
		$this->form_validation->set_rules('sex', 'Sexo', 'required');

		if(isset($_POST['submit'])){
			$_POST['created']=mdate("%Y-%m-%d  %H:%i:%s",time());
			$_POST['modified']=NULL;
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				unset($_POST['passconf']);
				$_POST['activation_key']=sha1(time());
				$this->db->insert($this->model->name, $_POST);
				redirect($this->model->name);
			}
		}

		//Visualizacion
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $this->model->name.'/insert',$data, TRUE);
		$this->template->render();
	}

	function delete(){
		if($this->model->delete($_POST['id']))
		redirect($this->model->name);
	}

	function confirm_delete(){
		$data['user_id']=$this->uri->segment(3);
		$this->load->view($this->model->name.'/confirm_delete',$data);
	}

	function update(){

		$this->template->add_js('js/ajax.js');
		$this->load->model('country');
		$this->load->model('city');

		$data['title'] = "USUARIOS ";
		$data['heading'] = "ACTUALIZAR";
		$data['teams']=$this->team->get_list_ec();
		$data['roles']=$this->rol->get_list();
		$data['row']=$this->model->get($this->uri->segment(3));
		$data['countries']=$this->country->get_list();
		$data['cities']=$this->city->list_by_country($data['row']->country_id);

		//var_dump($data['cities']);
		$this->form_validation->set_rules('role_id', 'Rol', 'required');
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('nick', 'Apodo', 'trim|required|min_length[5]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('mail', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('country_id', 'Pais', 'required');
		$this->form_validation->set_rules('city_id', 'Ciudad', 'required');
		$this->form_validation->set_rules('team_id', 'Equipo', 'required');
		$this->form_validation->set_rules('suscription', 'Suscripcion', 'required|numeric');
		$this->form_validation->set_rules('birth', 'Lugar de Nacimiento', 'required');
		$this->form_validation->set_rules('sex', 'Sexo', 'required');
		 
		if(isset($_POST['submit'])){
			$_POST['modified']=mdate("%Y-%m-%d  %H:%i:%s",time());
			if($this->form_validation->run()==TRUE){
				unset($_POST['submit']);
				$this->db->where( 'id',$_POST['id']);
				$this->db->update($this->model->name, $_POST);
				redirect($this->model->name);
			}
			else
			$data['row']=$this->model->get($_POST['id']);
		}
		else
		$data['row']=$this->model->get($this->uri->segment(3));

		//Visualizacion
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $this->model->name.'/update',$data, TRUE);
		$this->template->render();

	}

	function reset_pass(){
		$data['title'] = "CAMBIAR LA CLAVE";

		$this->form_validation->set_rules('password', 'Clave', 'trim|required|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'Confirmacion de Clave', 'trim|required');

		if(isset($_POST['submit'])){
			if ($this->form_validation->run() == TRUE){
				$this->model->change_pass($_POST['id'],$_POST['password']);
				//TODO: Poner mensaje de que se cambio con exito la clave
				redirect($this->model->name);
			}
			else
			$data['result']=$this->model->get($_POST['id']);
		}
		else
		$data['result']=$this->model->get($this->uri->segment(3));

		//Visualizacion
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $this->model->name.'/resetpass',$data, TRUE);
		$this->template->render();
	}

	function login(){

		$data['title'] = "LOGIN";
		$data['login_errors']="";
		$this->form_validation->set_rules('nick', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Clave', 'trim|required|md5');

		if(isset($_POST['submit'])){
			if ($this->form_validation->run() == TRUE){
				if($this->acl->login($_POST['nick'],$_POST['password'])){
					redirect('admin');
				}
				else
				$data['login_errors']="<li>Usuario o clave incorrectos.</li>";
			}
				
		}
		else{	
			//Visualizacion
			$this->template->set_template('public');
	
			$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
			$this->template->write('path',base_url(),TRUE);
			$this->template->write('menu','',TRUE);
			$this->template->write_view('content', $this->model->name.'/login',$data, TRUE);
			$this->template->write('block_left',"<div style='background-color: white; width:230px; height: 250px; margin-left:2px;'></div>",TRUE);
			$this->template->write('block_right',"<div style='background-color: white; width:227px; height: 250px; margin-left:-1px;'></div>",TRUE);
			$this->template->render();
		}

	}

	function logout(){
		$this->acl->logout('');
	}

	function log_in(){
		$this->config->set_item('compress_output', 'FALSE');
		$this->form_validation->set_rules('nick', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Clave', 'trim|required|md5');
		$data['error']="";
		if(isset($_POST['submit'])){
			if ($this->form_validation->run() == TRUE){
				$aux=$this->acl->login($_POST['nick'],$_POST['password']);

				if($aux){
					$mensaje="<div id='mensaje'>Ha ingresado correctamente.<br><br>";
					$mensaje.="<a href='' onClick='window.location =\"".base_url().$this->uri->uri_string()."\"  style='text-align: center;'>Cerrar la ventana</a></div>";
					echo $mensaje;
				}
				else{
					$data['error']="<li>Usuario o Clave incorrectos.</li>";
					$this->load->view($this->model->name.'/visit_login',$data);
				}
			}
			else
			$this->load->view($this->model->name.'/visit_login',$data);
		}
		else
		$this->load->view($this->model->name.'/visit_login',$data);
	}
	
	function r2(){
		
	}
	
	function register(){
		$this->config->set_item('compress_output', 'FALSE');
		/*
		
		$this->template->set_template('public');

		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu','',TRUE);
	
		$this->template->write('block_left',"<div style='background-color: white; width:230px; height:707px; margin-left:2px;'></div>",TRUE);
		$this->template->write('block_right',"<div style='background-color: white; width:227px; height: 707px; margin-left:-1px;'></div>",TRUE);

		
		//Cargo las noticias rotativas
		$this->load->model('story');
		$data['query']=$this->story->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
*/
		$this->load->model('country');
		$this->form_validation->set_error_delimiters('', '');

		$data['teams']=$this->team->get_list_ec();
		$data['countries']=$this->country->get_list();
		$data['cities']=array(''=>"Seleccione una Ciudad...");

		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'trim|required|min_length[5]|max_length[12]|xss_clean|callback_username_check');
		$this->form_validation->set_rules('mail', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('country_id', 'Pais', 'required');
		$this->form_validation->set_rules('team_id', 'Equipo', 'required');
		$this->form_validation->set_rules('terminos', 'Equipo', 'required');
		$this->form_validation->set_rules('password', 'Clave', 'trim|required|matches[passconf]|min_length[5]|md5');
		$this->form_validation->set_rules('passconf', 'Confirmación de Clave', 'trim|required');
		$this->form_validation->set_rules('sex', 'Sexo', 'trim|required');

		$this->form_validation->set_rules('year', 'A�o', 'trim|required');

		$this->form_validation->set_rules('month', 'Mes', 'trim|required');

		$this->form_validation->set_rules('day', 'D�a', 'trim|required');


		if(isset($_POST['submit']))
		if($this->form_validation->run() == TRUE){
			$pass=$_POST['passconf'];
			$user=$_POST['first_name']." ".$_POST['last_name'];
			$created=mdate("%Y-%m-%d  %H:%i:%s",time());
			$key=sha1($created);
			if(!isset($_POST['suscription']))
				$_POST['suscription']=0;
			$data=array('role_id'=>1,'first_name'=>$_POST['first_name'],'last_name'=>$_POST['last_name'],'nick'=>$_POST['nick'],
							'mail'=>$_POST['mail'],'country_id'=>$_POST['country_id'],'team_id'=>$_POST['team_id'],
							'password'=>$_POST['password'],'created'=>$created,'modified'=>$created,'description'=>"Usuario creado desde la Nueva Pagina",
							'activation_key'=>$key,'suscription'=>$_POST['suscription'],'city_id'=>$_POST['city_id'],'sex'=>$_POST['sex'],
							'birth'=>$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']);

			$this->db->insert($this->model->name, $data);
			$this->send_active_mail($key,$_POST['nick'],$pass,$user,$_POST['mail']);
			 $this->load->view($this->model->name.'/confirm_register');
			//Presento la confirmacion del Usuario creado y que revise el mail
			/*
			$mensaje="<div id='mensaje'>Solo falta un paso para ser parte de nuestra comunidad. Recibirás un correo para ";
			$mensaje.="terminar con el registro, tienes que dar Click en el link <strong>'Activar tu cuenta'</strong><br><br>";
			$mensaje.="Ya puedes cerrar esta ventana.<br><br>";
			$mensaje.="<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
			echo $mensaje;
			*/
		}
		else{
			//$this->template->write_view('content', $this->model->name.'/register',$data, TRUE);
			//$this->template->render();
			$this->load->view($this->model->name.'/register',$data);
		}
		else{
			//$this->template->write_view('content', $this->model->name.'/register',$data, TRUE);
			//$this->template->render();
			$this->load->view($this->model->name.'/register',$data);
		}	
	}

	function username_check($str){
		$this->config->set_item('compress_output', 'FALSE');
		if($this->model->check_username($str))
		return TRUE;
		else{
			$this->form_validation->set_message('username_check', 'Ese %s ya existe, prueba con otro.');
			return FALSE;
		}
	}

	function send_active_mail($key,$nick,$pass,$user,$mail){
		$mensaje="$user<br><br>\n\n";
		$mensaje.='Gracias por registrarte a futbolecuador.com pronto recibiras increibles noticias, ';
		$mensaje.="guarda este mensaje para recordar tu usuario y contraseña.<br><br>\n\n";
		$mensaje.="Usuario: $nick <br>\n";
		$mensaje.="Clave: $pass <br><br><br>\n\n\n";
		$mensaje.="Da click en el siguiente link para terminar el proceso de activacion de tu cuenta.<br><br>\n\n";
		$mensaje.="{unwrap}<a href='".base_url()."users/activation/$nick/$key'>Activar tu cuenta</a>{/unwrap}<br><br>\n\n";
		$mensaje.="Si no puedes dar click en el link, copia la siguiente dirección en el explorador.<br><br>\n\n";
		$mensaje.="{unwrap}".base_url()."users/activation/$nick/$key{/unwrap}<br><br>\n\n";
		$mensaje.="Atentamente,<br>\n";
		$mensaje.="futbolecuador.com";


		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf8';
		$config['mailtype'] = 'html';
		$config['wordwrap'] = FALSE;

		$this->email->initialize($config);

		$this->email->from('no_reply@futbolecuador.com','futbolecuador.com');
		$this->email->to($mail);

		$this->email->subject("futbolecuador.com - Activacion de Registro");

		$this->email->message($mensaje);

		$this->email->send();
		//echo $this->email->print_debugger();
	}

	function activation(){
		$this->config->set_item('compress_output', 'FALSE');
		$nick=$this->uri->segment(3);
		$key=str_replace('=','',$this->uri->segment(4));

		$message['title']=" ";
		if($this->model->activate_user($nick,$key)){
			$message['text']="<strong>$nick</strong> , tu cuenta fue activada correctamente ";
			$this->session->set_flashdata('message',$message );
		}
		else{
			$message['text']="<strong>$nick</strong> , hubo un error al activar tu cuenta, intentalo nuevamente. ";
			$this->session->set_flashdata('message',$message );
		}
		redirect();
	}

	function forgot(){
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('usuario', 'Usuario / Email', 'trim|required|xss_clean|callback_forgot_pass');

		if(isset($_POST['Submit'])){
			if($this->form_validation->run() == TRUE){
				$pass=$this->generatePassword();
				$this->send_forgot_pass($_POST['usuario'],$pass);

				//Presento la confirmacion del Usuario creado y que revise el mail
				$mensaje="<div id='mensaje'>En pocos minutos recibiras un correo al email que registraste en nuestra pagina con las instrucciones ";
				$mensaje.="para el cambio de clave.<br><br>";
				$mensaje.="Ya puedes cerrar esta ventana.<br><br>";
				$mensaje.="<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
				echo $mensaje;
			}
			else
			$this->load->view($this->model->name.'/forgot');
		}
		else
		$this->load->view($this->model->name.'/forgot');
	}

	function forgot_pass(&$str){
		if(strrchr($str,'@')==FALSE)
		$user=$this->model->get_user($str,'nick');
		else
		$user=$this->model->get_user($str,'mail');

		if($user!=FALSE){
			$str=$user->id;
			return TRUE;
		}
		else{
			$this->form_validation->set_message('forgot_pass', 'El %s no existe, intente nuevamente.');
			return FALSE;
		}
	}


	function send_forgot_pass($user,$pass){
		$this->model->set_forgot_pass($user,$pass);
		$user=$this->model->get($user);
			
		$mensaje="$user->first_name $user->last_name<br><br>\n\n";
		$mensaje.="Hemos recibido una peticion para recordarle la clave desde el sitio futbolecuador.com, ";
		$mensaje.="A continuacion le enviamos un link para confirmar su cambio de clave, ademas le entregamos la nueva clave para ingresar a la pagina.<br><br>\n\n";
		$mensaje.="Usuario: $user->nick <br>\n";
		$mensaje.="Clave: $pass <br><br><br>\n\n\n";
		$mensaje.="Da click en el siguiente link para terminar el proceso de cambio de clave, si no das click en el link tu nueva clave no se activará.<br><br>\n\n";
		$mensaje.="{unwrap}<a href='".base_url()."users/activate_pass/$user->nick/$user->activation_key'>Activar tu nuevo password</a>{/unwrap}<br><br>\n\n";
		$mensaje.="Si no puedes dar click en el link, copia la siguiente dirección en el explorador.<br><br>\n\n";
		$mensaje.="{unwrap}".base_url()."users/activate_pass/$user->nick/$user->activation_key{/unwrap}<br><br>\n\n";
		$mensaje.="Atentamente,<br>\n";
		$mensaje.="futbolecuador.com";


		$this->load->library('email');


		$this->email->from('no_reply@futbolecuador.com','futbolecuador.com');
		$this->email->to($user->mail);

		$this->email->subject("futbolecuador.com - Cambio de clave");

		$this->email->message($mensaje);

		$this->email->send();
		//echo $this->email->print_debugger();

	}

	function generatePassword($length=9, $strength=0) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength & 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength & 2) {
			$vowels .= "AEUY";
		}
		if ($strength & 4) {
			$consonants .= '23456789';
		}
		if ($strength & 8) {
			$consonants .= '@#$%';
		}

		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}


	function activate_pass(){
		$nick=$this->uri->segment(3);
		$key=$this->uri->segment(4);
		$message['title']=" ";
		if($this->model->activate_pass($nick,$key)){
			$message['text']="<strong>$nick</strong> , tu clave ha sido cambiada correctamente ";
			$this->session->set_flashdata('message',$message );
		}
		else{
			$message['text']="<strong>$nick</strong> , existió un error al cambiar tu clave, intentalo nuevamente. ";
			$this->session->set_flashdata('message',$message );
		}
		redirect();
	}

	function profile(){
		$this->load->model('country');
		$this->load->model('city');
		$this->load->model('story');
		$this->load->model('comment');
		$id=$this->session->userdata('userid');
		$_POST['resultado']=FALSE;
		$this->form_validation->set_rules('first_name', 'Nombre', 'trim|required|');
		$this->form_validation->set_rules('last_name', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('mail', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('country_id', 'Pais', 'required');
		$this->form_validation->set_rules('team_id', 'Equipo', 'required');
		$this->form_validation->set_rules('country_id', 'Pais', 'required');
		$this->form_validation->set_rules('password', 'Clave', 'trim|matches[passconf]|md5');
		$this->form_validation->set_rules('passconf', 'Confirmación de Clave', 'trim');
		$this->form_validation->set_rules('sex', 'Sexo', 'trim|required');
		$this->form_validation->set_rules('year', 'A�o', 'trim|required');
		$this->form_validation->set_rules('month', 'Mes', 'trim|required');
		$this->form_validation->set_rules('day', 'D�a', 'trim|required');

		if(isset($_POST['Submit'])){
			if($this->form_validation->run() == TRUE){
				unset($_POST['Submit']);
				unset($_POST['passconf']);
				if($_POST['password']=='')
				unset($_POST['password']);
				$_POST['birth']=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
				unset($_POST['year']);
				unset($_POST['month']);
				unset($_POST['day']);
				if(!isset($_POST['suscription'])){
					$_POST['suscription']=0;
				}
				unset($_POST['resultado']);
				$this->db->update($this->model->name,$_POST,array('id' => $id));
				$_POST['resultado']=TRUE;
			}
		}

		$this->form_validation->set_error_delimiters('', '');

		$data['user']=$this->model->get($id);
		$data['teams']=$this->team->get_list_ec();
		$data['countries']=$this->country->get_list();
		$data['cities']=$this->city->list_by_country($data['user']->country_id);
		$data['name']="Perfil de Usuario";
		$data['comments']=$this->comment->get_by_user($id);
		$data['aproved']=array("por_aprobar.jpg","aprobado.jpg","rechazado.jpg");

		$this->template->set_template('public');

		//Utilizo el Helper de Modulos para posicionar los modulos de acuerdo a la seccion
		$this->load->helper('modul');
		$modulos=new Modul();
		$modulos->set_modulos(0,'laterals');

		//Cargo las noticias rotitavias
		$this->load->model('story');
		$data['query']=$this->story->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);

		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu','',TRUE);
		$this->template->write_view('content', $this->model->name.'/profile',$data, TRUE);
		$this->template->render();
	}

	function view($ver,$data){
		$this->load->library('Alert');
		$this->template->write('title','futbolecuador.com - Administrador',TRUE);
		$this->template->write('path',base_url(),TRUE);
		$this->template->write('menu',$this->menu->build_menu(),TRUE);
		$this->template->write_view('content', $ver,$data, TRUE);
		$this->template->render();
	}

	function fblogin(){
		$this->config->set_item('compress_output', 'FALSE');
		
		$config = array('file' => 'facebook');
		$this->load->library('Facebook_connect',$config);
		$fb=$this->facebook_connect->user;
		
		$data=array(
				'role_id'=>2,
				'first_name'=>$fb['first_name'],
				'last_name'=>$fb['last_name'],
				'nick'=>$fb['name'],
				'mail'=>$fb['email'],
				'team_id'=>0,
				'suscription'=>0,
				'description'=>'fb:'.$fb['id'],
				'created'=>time(),
				'modified'=>time(),
				'password'=>$fb['id'],
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
		
		$check=$this->model->check_username($fb['name']);
		
		if($check==TRUE)
			$this->db->insert($this->model->name, $data);
			
		$this->acl->login($fb['name'],$fb['id']);
		
		redirect();
	}
	
	function fbpost(){
		$this->load->library('facebook_connect');
		
		$user = $this->session->userdata('facebook_user');
		$err=$this->facebook_connect->client->stream_publish($mensaje);
		echo "Errores:<br>";
		var_dump($err);
	}
}
?>
