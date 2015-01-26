<?php
class Popups extends Controller {

	function Popups(){
		parent::Controller();
		$this->load->library('table');
		$this->load->library('form_validation');
	}

	function contact_us(){
		
		if(isset($_POST['Submit'])){
			$this->table->add_row('Nombre: ', $_POST['nombre']);
			$this->table->add_row('E-mail: ', $_POST['email']);
			$this->table->add_row('Mensaje: ',$_POST['mensaje']);
			
			$tmpl = array ( 'table_open'  => '<table border="0" width="90%" cellpadding="2" cellspacing="1">' );
			$this->table->set_template($tmpl); 
			$table=$this->table->generate(); 
			
			$this->send_mail($_POST['from'],$table);
			
			//Presento la confirmacion del mensaje enviado
		    $mensaje="<div id='mensaje'>Tu mensaje ha sido enviado <strong>correctamente</strong>. <br><br>";
		    $mensaje.="<a href='' onClick='Modalbox.hide(); return false;' style='text-align: center;'>Cerrar la ventana</a></div>";
		    echo $mensaje;
		}
		else
			$this->load->view('popups/contact_us');
	}
	
	function pauta(){
		
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
				
				$this->send_mail($_POST['from'],$table);
				
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
	
	function send_mail($subject,$table){
		$this->load->library('email');
		
		$data['datos']=$table;
		$data['disclaimer']="Este es un mail autogenerado, por favor no hacer reply del mismo.";
		
		$this->email->from('no_reply@futbolecuador.com','futbolecuador.com');
		$this->email->to('info@futbolecuador.com');
		
		$this->email->subject($subject);
		
		$body = $this->load->view('popups/mail_template',$data, true);
		$this->email->message($body);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
	
}
?>