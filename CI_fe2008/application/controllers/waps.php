<?php
class Waps extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model('story');
   		$this->load->library('Wap');
   		$this->config->set_item('compress_output', 'FALSE');
	}
	
	function read(){
		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Anterior');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Noticia','');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		$wml=$wml.$this->wap->read($this->uri->segment(3));
		$wml=$wml.$this->wap->p_close();
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
		$this->story->set_read($this->uri->segment(3));
   	}
   	
   	function more(){
   		$this->load->helper('inflector');
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Anterior');
		$wml=$wml.$this->wap->template_close();
		
		$wml=$wml.$this->wap->card_open('1',humanize($this->uri->segment(3)),'');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		
		if($this->uri->segment(4)==FALSE)
			$wml=$wml.$this->wap->news('10');
		else
			$wml=$wml.$this->wap->news_section($this->uri->segment(4),'10');
		
		$wml=$wml.$this->wap->p_close();	
		$wml=$wml.$this->wap->next('Mas','2');
		$wml=$wml.$this->wap->card_close();
		
		$wml=$wml.$this->wap->card_open('2',humanize($this->uri->segment(3)),'');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		
		if($this->uri->segment(4)==FALSE)
			$wml=$wml.$this->wap->news('10,10');
		else
			$wml=$wml.$this->wap->news_section($this->uri->segment(4),'10,10');

		$wml=$wml.$this->wap->p_close();
		$wml=$wml.$this->wap->next('Mas','3');
		$wml=$wml.$this->wap->card_close();
		
		$wml=$wml.$this->wap->card_open('3',humanize($this->uri->segment(3)),'');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		
		if($this->uri->segment(4)==FALSE)
			$wml=$wml.$this->wap->news('20,10');
		else
			$wml=$wml.$this->wap->news_section($this->uri->segment(4),'20,10');
		
		$wml=$wml.$this->wap->p_close();
		$wml=$wml.$this->wap->next('Mas','4');
		$wml=$wml.$this->wap->card_close();
		
		$wml=$wml.$this->wap->card_open('4',humanize($this->uri->segment(3)),'');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		
		if($this->uri->segment(4)==FALSE)
			$wml=$wml.$this->wap->news('30,10');
		else
			$wml=$wml.$this->wap->news_section($this->uri->segment(4),'30,10');
		
		$wml=$wml.$this->wap->p_close();
		$wml=$wml.$this->wap->next('Mas','5');
		$wml=$wml.$this->wap->card_close();
		
		$wml=$wml.$this->wap->card_open('5',humanize($this->uri->segment(3)),'');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		
		if($this->uri->segment(4)==FALSE)
			$wml=$wml.$this->wap->news('40,10');
		else
			$wml=$wml.$this->wap->news_section($this->uri->segment(4),'40,10');

		$wml=$wml.$this->wap->p_close();	
		$wml=$wml.$this->wap->next('Mas','6');
		$wml=$wml.$this->wap->card_close();
		
		$wml=$wml.$this->wap->card_open('6',humanize($this->uri->segment(3)),'');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->p_open();
		
		if($this->uri->segment(4)==FALSE)
			$wml=$wml.$this->wap->news('50,10');
		else
			$wml=$wml.$this->wap->news_section($this->uri->segment(4),'50,10');
		
		$wml=$wml.$this->wap->p_close();
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
   	
   	function last_results(){
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Principal');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Ultimos Resultados','');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->last_result(FALSE);
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
   	
	function calendary(){
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Principal');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Ultimos Resultados','');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->last_result(TRUE);
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
   	
   	function scoreboards(){
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Principal');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Ultimos Resultados','ontimer="'.base_url().'waps/scoreboards'.'"');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$data=$this->wap->scoreboard();
		$wml=$wml.$data['matches'];
		$wml=$wml.$data['refresh'];
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
   	
   	function single(){
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Anterior');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Ultimos Resultados','ontimer="'.base_url().'waps/single/'.$this->uri->segment(3).'"');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$data=$this->wap->single($this->uri->segment(3));
		$wml=$wml.$data['matches'];
		$wml=$wml.$data['refresh'];
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
   	
   	function positions(){
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Menu de Tabla de Posiciones');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Tabla de Posiciones','');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->positions($this->uri->segment(3));
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
   	
   	function positions_ac(){
   		$wml=$this->wap->header();
		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Menu de Tabla de Posiciones');
		$wml=$wml.$this->wap->template_close();
		$wml=$wml.$this->wap->card_open('1','Tabla de Posiciones','');
		$wml=$wml.$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml=$wml.$this->wap->positions_ac($this->uri->segment(3));
		$wml=$wml.$this->wap->card_close();
		$wml=$wml.$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
   		echo $wml;
   	}
   	
   	function position(){
   		$wml=$this->wap->header();
   		$wml=$wml.$this->wap->template_open();
		$wml=$wml.$this->wap->back('Principal');
		$wml=$wml.$this->wap->template_close();
		$wml.=$this->wap->card_open('1','Menu de Tabla de Posiciones','');
		$wml.=$this->wap->pic('imagenes/template/wap/titulo_logo.png','Futbol Ecuador');
		$wml.=$this->wap->p_open();
		/*$links[1]['name']='Serie A - Cuadrangular - Grupo 1';
		$links[1]['link']='waps/positions/96';
		$links[2]['name']='Serie A - Cuadrangular - Grupo 2';
		$links[2]['link']='waps/positions/97';*/
		$links[3]['name']='Serie A';
		$links[3]['link']='waps/positions_ac/28';
		$links[4]['name']='Serie B';
		$links[4]['link']='waps/positions_ac/29';
		$links[5]['name']='Libertadores Grupo A';
		$links[5]['link']='waps/positions/102';
		$links[6]['name']='Libertadores Grupo B';
		$links[6]['link']='waps/positions/103';
		$links[7]['name']='Libertadores Grupo C';
		$links[7]['link']='waps/positions/104';
		$links[8]['name']='Libertadores Grupo D';
		$links[8]['link']='waps/positions/105';
		$links[9]['name']='Libertadores Grupo E';
		$links[9]['link']='waps/positions/106';
		$links[10]['name']='Libertadores Grupo F';
		$links[10]['link']='waps/positions/107';
		$links[11]['name']='Libertadores Grupo G';
		$links[11]['link']='waps/positions/108';
		$links[12]['name']='Libertadores Grupo H';
		$links[12]['link']='waps/positions/109';
		/*$links[4]['name']='Serie B';
		$links[4]['link']='waps/positions/86';
		$links[5]['name']='Serie B - Acumulada';
		$links[5]['link']='waps/positions_ac/21';
		$links[6]['name']='Eliminatorias';
		$links[6]['link']='waps/positions/53';*/
		$wml.=$this->wap->button($links);
		$wml.=$this->wap->p_close();                                                                              
		$wml.=$this->wap->card_close();
		$wml.=$this->wap->close();
		header("Content-type: text/vnd.wap.wml");
		echo $wml;
   	}
}