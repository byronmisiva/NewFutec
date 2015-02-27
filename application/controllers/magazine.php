<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Magazine extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
	}	
	
	public function twitter_feed($type='clubes'){		
		$data['type']=$type;		
		$lists=array(
		'clubes' => array('href'=>'https://twitter.com/futbolecuador/equipos','id'=>'347121552686465024','name'=>'Tweets de @futbolecuador/equipos'),
		'players' => array('href'=>'https://twitter.com/futbolecuador/jugadores','id'=>'346759559605530625','name'=>'Tweets de @futbolecuador/jugadores'));
		
		$data['tweets']=$lists[$type];
		$this->load->view('/magazine/twitter_feed',$data);
		
	}
	
	public function question(){
		$this->load->view('magazine/questions');
	}
	
	public function question_vertical(){
		$this->load->view('magazine/questions_vertical');
	}
	
	public function datosfutec(){
		$data['pageTitle']="#JefeNoSeaMalito";
		$this->load->view('magazine/contenedor',$data);		
	}
	
	function simbiosis(){
		$this->load->view('magazine/simbiosis');		
	}
	
	public function send_form(){
		$body="<html><body><table>";
		foreach($_POST as $key=>$value){
			$body.="<tr><td><strong>".$key.": </strong></td>";
			$body.="<td>".$value."</td></tr>";
			
		}
		$body.="</table></body></html>";
		
		$this->load->library('email');
		
		$this->email->from('contact@misiva.com.ec',"FE Magazine");
		$this->email->to('magazine@misiva.com.ec');
		
		$this->email->subject('Comentario desde FEMag');
		$this->email->message($body);
		
		$this->email->send();
		
		$html="<div class='mensaje' style='width:261px;'> Tu mensaje ha sido enviado correctamente. </div>";
		echo $html;
	}
}
