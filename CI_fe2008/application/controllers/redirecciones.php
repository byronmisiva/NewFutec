<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redirecciones extends CI_Controller {
	
	var $usuario;
	
	public function __construct(){
    	parent::__construct();
    	$this->load->model('redireccion');
    	$this->load->model('archivo');
    	$this->load->model('dominio');
    	$this->load->library('acl');
		$this->load->helper('url');
    	
    	if(isset($_GET['l']) || isset($_GET['a'])){
    		;
    	}
    	else{
	    	if(!$this->uri->segment(2)){
	    		redirect(base_url().'redirecciones/login');	
	    	}
	    	else{
		    	if($this->uri->segment(2)=='login'){
						$this->usuario=$this->acl->getCurrentUser();
		    	}
		    	else{
		    		if($this->uri->segment(2)=='index'){
		    			;
		    		}
		    		else{
		    			
		    			if($this->uri->segment(2)=='temporizador'){
		    				;
		    			}
		    			else{
					    	if($this->acl->checkAcl($this->uri->segment(1),$this->uri->segment(2),FALSE)){
					    		$this->usuario=$this->acl->getCurrentUser();
					    	}
					    	else{
					    		redirect(base_url().'redirecciones/login');	
					    	}
		    			}
		    		}
		    	}
	    	
	    	}
    	}
    }
	
	public function index(){
		echo "<html><head>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "var _gaq = _gaq || [];
  				_gaq.push(['_setAccount', 'UA-2423727-22']);
  				_gaq.push(['_setDomainName', 'movi.com.ec']);
				_gaq.push(['_setAllowLinker', true]);
  				_gaq.push(['_trackPageview']);

  				(function() {
    				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  				})();";
		echo "\n</script>\n";
		echo "</head><body></body></html>";
  
		sleep(5);
		
		if(isset($_GET['l'])){
			$resultado=$this->redireccion->getByLocalizador($_GET['l']);
			redirect($resultado->link);
		}
		else{
			if(isset($_GET['a'])){
				$resultado=$this->archivo->getByLocalizador($_GET['a']);
				redirect($resultado->archivo);
			}
			else{
				redirect(base_url().'redirecciones/generador');
			}	
		}
		
	}
	
	function validacion(){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<ul>','</ul>');
		$this->form_validation->set_rules('link', 'Link', 'required');
		$this->form_validation->set_rules('dominio_id', 'Dominio', 'required');
	}
	
	function validacionArchivo(){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<ul>','</ul>');
		$this->form_validation->set_rules('dominio_id', 'Dominio', 'required');
	}
	
	function paginacion(){
		$this->load->library('ajax_pagination');
		$config['base_url'] = base_url().'redireccion/vista/';
		$config['total_rows'] = $this->redireccion->countAll();
		$config['per_page'] = '10'; 
		$config['first_link']='< Primero';
		$config['last_link']='&Uacute;ltimo >';
		$this->ajax_pagination->initialize($config);
	}
	
	public function generador(){
		$data['skin']=$this->usuario['role'];
		$data['opcion']=1;
		$data['datos']='';
		$data['usuario']=$this->usuario;
		$this->load->view('generador',$data);
	}
	
	public function generadorAlterno($opcion,$datos){
		$data=$datos;
		$data['skin']=$this->usuario['role'];
		$data['opcion']=$opcion;
		$data['usuario']=$this->usuario;
		$this->load->view('generador',$data);
	}
	
	public function formulario(){
		$datos['mensaje']='';
		$datos['dominios']=$this->dominio->getAll($this->usuario["role"]);
		if(isset($_POST['enviar'])){
			$this->validacion();	
			if($this->form_validation->run()==TRUE){
				$data['link']=$_POST['link'];
				$pos=strpos($data['link'],'http://');
				$pos2=strpos($data['link'],'https://');
				if($pos===false && $pos2===false ){
					$data['link']='http://'.$data['link'];
				}
				$data['localizador']='1';
				$data['dominio_id']=$_POST['dominio_id'];
				$data['role']=$this->usuario['role'];
				$data['user']=$this->usuario['user'];
				
				
				$ultimo=$this->redireccion->insert($data);
				
				$link=$data['link'];
				$data='';
				$data['localizador']=rand(11,99).$ultimo.rand(11,99);
				$data['id']=$ultimo;
				$this->redireccion->update($data);
				$datos['mensaje']='<a class="link_generado" href="http://'.$_POST['dominio'].'/?l='.$data['localizador'].'" target="_blank">'.$_POST['dominio'].'/?l='.$data['localizador'].'</a>';
				$this->load->view('generado',$datos);
			}
			else{
				$this->load->view('formulario',$datos);
			}
		
		}
		else
			$this->load->view('formulario',$datos);
	}
	
	public function vista(){
		$datos['pagina']=10;
		$datos['dominios']=$this->dominio->getAll($this->usuario["role"]);
		
		$datos['lista']=$this->redireccion->getAll($this->usuario["role"],$this->uri->segment(3),$datos['pagina']);
		$datos['total']=$this->redireccion->countAll($this->usuario["role"]);
		
		$this->load->view('vista',$datos);
	}
	
	public function buscar(){
		$datos['pagina']=10;
		$datos['dominios']=$this->dominio->getAll($this->usuario["role"]);
		if(isset($_POST['link'])){
			$datos['lista']=$this->redireccion->getAllByLink($this->usuario["role"],$this->uri->segment(3),$datos['pagina'],$_POST['link']);
			$datos['total']=$this->redireccion->countAllByLink($this->usuario["role"],$_POST['link']);
			$datos['link']=$_POST['link'];
		}
		else{
			$datos['lista']=$this->redireccion->getAllByLink($this->usuario["role"],$this->uri->segment(3),$datos['pagina'],$this->uri->segment(4));
			$datos['total']=$this->redireccion->countAllByLink($this->usuario["role"],$this->uri->segment(4));
			$datos['link']=$this->uri->segment(4);
		}
		$this->load->view('buscar',$datos);
	}
	
	public function formulario_archivo(){
		$datos['mensaje']='';
		$datos['dominios']=$this->dominio->getAll($this->usuario["role"]);
		if(isset($_POST['enviar'])){
			$this->validacionArchivo();	
			if($this->form_validation->run()==TRUE){
				$this->config_upload();
				if($this->upload->do_upload('archivo')){
					$data['archivo']=$this->upload->data();
					$data['archivo']=base_url().'/archivo/'.$data['archivo']['file_name'];
					$data['localizador']='1';
					$data['dominio_id']=$_POST['dominio_id'];
					$data['role']=$this->usuario['role'];
					$data['user']=$this->usuario['user'];
					
					$ultimo=$this->archivo->insert($data);
					$link=$data['archivo'];
					$data='';
					$data['localizador']=rand(11,99).$ultimo.rand(11,99);
					$data['id']=$ultimo;
					$this->archivo->update($data);
					$datos['dominio_id']=$_POST['dominio_id'];
					$datos['localizador']=$data['localizador'];
					//echo $this->upload->display_errors();
					$this->generadorAlterno(3,$datos);
				}
				else{
					//echo $this->upload->display_errors();
					$this->generadorAlterno(2,'');
				}
			}
			else{
				$this->generadorAlterno(2,'');
			}
		}
		else
			$this->load->view('formulario_archivo',$datos);
	}
	
	public function formulario_archivo_subido(){
		$dominio=$this->dominio->get($this->uri->segment(3));
		$localizador=$this->uri->segment(4);
		$datos['mensaje']='<a class="link_generado" href="'.$dominio->nombre.'/?a='.$localizador.'" target="_blank">'.$dominio->nombre.'/?a='.$localizador.'</a>';
		$this->load->view('generado_archivo',$datos);
	}
	
	public function vista_archivo(){
		$datos['pagina']=10;
		$datos['dominios']=$this->dominio->getAll($this->usuario["role"]);
		
		$datos['lista']=$this->archivo->getAll($this->usuario["role"],$this->uri->segment(3),$datos['pagina']);
		$datos['total']=$this->archivo->countAll($this->usuario["role"]);
		
		$this->load->view('vista_archivo',$datos);
	}
	
	public function buscar_archivo(){
		$datos['pagina']=10;
		$datos['dominios']=$this->dominio->getAll($this->usuario["role"]);
		if(isset($_POST['link'])){
			$datos['lista']=$this->archivo->getAllByLink($this->usuario["role"],$this->uri->segment(3),$datos['pagina'],$_POST['link']);
			$datos['total']=$this->archivo->countAllByLink($this->usuario["role"],$_POST['link']);
			$datos['link']=$_POST['link'];
		}
		else{
			$datos['lista']=$this->archivo->getAllByLink($this->usuario["role"],$this->uri->segment(3),$datos['pagina'],$this->uri->segment(4));
			$datos['total']=$this->archivo->countAllByLink($this->usuario["role"],$this->uri->segment(4));
			$datos['link']=$this->uri->segment(4);
		}
		$this->load->view('buscar_archivo',$datos);
	}
	
	function config_upload(){
		
		$config['allowed_types']='pdf|zip|rar|jpg|gif|png|doc|docx|xls|xlsx|ppt|pptx|fla|psd|ai|id|php|html|wmv|mov|mp3|mp4|mpg|eps|raw|indd';
		$config['upload_path']='./archivo/';
		$config['max_size']	= '10000000000';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
	}
	
	function login(){
		$this->load->library('form_validation');
		$data['login_errors']="";
		$this->form_validation->set_rules('nick', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Clave', 'trim|required|md5');
		if(isset($_POST['enviar'])){
			if ($this->form_validation->run() == TRUE){
				if($this->acl->login($_POST['nick'],$_POST['password'])){
					redirect(base_url().'redirecciones/generador');
				}
				else
				$data['login_errors']="<li>Usuario o clave incorrectos.</li>";
			}
		}
		$this->load->view('login',$data);
	}
	
	function logout(){
		$this->acl->logout(base_url().'redirecciones/login');
	}
	
	function temporizador(){
		if($this->uri->segment(3)){
			$this->archivo->caducados($this->uri->segment(3));
			$this->redireccion->caducados($this->uri->segment(3));
		}
	}
	
}