<?php
class Popups extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('table');
		$this->load->library('form_validation');
	}

	function contact_us(){
		$this->config->set_item('compress_output', 'FALSE');
		$this->load->helper('html');
		
		if(isset($_POST['Submit'])){
			$this->table->add_row('Nombre: ', $_POST['nombre']);
			$this->table->add_row('E-mail: ', $_POST['email']);
			$this->table->add_row('Mensaje: ',$_POST['mensaje']);
			
			$tmpl = array ( 'table_open'  => '<table border="0" width="90%" cellpadding="2" cellspacing="1">' );
			$this->table->set_template($tmpl); 
			$table=$this->table->generate(); 
			
			$this->send_mail($_POST['from'],$table,'info@futbolecuador.com');
			
			//Presento la confirmacion del mensaje enviado
		    $mensaje="<div id='mensaje'>Tu mensaje ha sido enviado <strong>correctamente</strong>. <br><br>";
		    $mensaje.="<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
		    echo $mensaje;
		}
		else
			$this->load->view('popups/contact_us');
	}
	
	function contact(){
		$this->load->helper('html');
		
		//Defino primero el template publico para poder escribir ahi los modulos
		$this->template->set_template('public');
		$this->template->write('title','futbolecuador.com - Lo mejor del fútbol ecuatoriano',TRUE);
		$this->template->write('path',base_url(),TRUE);
		
		$data="";
		$this->template->write_view('content', 'popups/contact', $data, FALSE);
		
		
		//Cargo las noticias rotitavias
		$this->load->model('story');
		$data['query']=$this->story->get_banner(5);
		$data['check']=0;
		$this->template->write_view('rotativas', 'stories/rotativa',$data, TRUE);
		
		
		//Renderizo el template
		$this->template->render();
	}
	
	function pauta(){
		$this->config->set_item('compress_output', 'FALSE');
		$this->load->helper('html');
		
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|');
		$this->form_validation->set_rules('empresa', 'Empresa', 'trim|required');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('telefono', 'Telefono', '');
		$this->form_validation->set_rules('direccion', 'Dirección', '');
		$this->form_validation->set_rules('mensaje', 'Mensaje', '');
		
		if(isset($_POST['Submit']) ){
			if($this->form_validation->run() == TRUE){
				$this->table->add_row('Nombre: ', $_POST['nombre']);
				$this->table->add_row('Empresa: ', $_POST['empresa']);
				$this->table->add_row('Teléfono: ', $_POST['telefono']);
				$this->table->add_row('Dirección: ', $_POST['direccion']);
				$this->table->add_row('E-mail: ', $_POST['email']);
				$this->table->add_row('Comentarios: ',$_POST['mensaje']);
				
				$tmpl = array ( 'table_open'  => '<table border="0" width="90%" cellpadding="2" cellspacing="1">' );
				$this->table->set_template($tmpl); 
				$table=$this->table->generate(); 
				
				$this->send_mail($_POST['from'],$table,'publicidad@futbolecuador.com');
				
				//Presento la confirmacion del mensaje enviado
			    $mensaje="<div id='mensaje'>Tu mensaje ha sido enviado <strong>correctamente</strong>. <br><br>";
			    $mensaje.="<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
			    echo $mensaje;
			}
			else
				$this->load->view('popups/pauta');
		}
		else
			$this->load->view('popups/pauta');
	}
	
	function send_mail($subject,$table,$to){
		$this->load->library('email');
		
		$data['datos']=$table;
		$data['disclaimer']="Este es un mail autogenerado, por favor no hacer reply del mismo.";
		
		$this->email->from('no_reply@futbolecuador.com','Desde futbolecuador.com');
		$this->email->reply_to('no_reply@futbolecuador.com','Desde futbolecuador.com');
		$this->email->to($to);
		
		
		$this->email->subject($subject);
		
		$body = $this->load->view('popups/mail_template',$data, true);
		$this->email->message($body);
		
		$this->email->send();
		
	}
	
}
?>