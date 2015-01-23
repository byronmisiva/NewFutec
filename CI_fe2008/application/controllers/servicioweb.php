<?php

    if (isset($_SERVER['HTTP_ORIGIN'])) {  
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
        header('Access-Control-Allow-Credentials: true');  
        header('Access-Control-Max-Age: 86400');   
    }  
      
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  
      
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
      
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
    }  

class Servicioweb extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('story','model');
		$this->load->model('category');
		$this->load->model('image');
		$this->load->model('tag');
		$this->load->model('statistic');		
		$this->load->helper('date');		
	}

	function noticiasAldia(){
		$news=$this->model->rss(FALSE)->result();		
		echo json_encode($news);		
	}

	function news(){
		if($this->uri->segment(3)!=3)
			$news=$this->model->rssNotifificacion($this->uri->segment(3));
		else
			$news=$this->model->rssNotifificacion(FALSE);

/*echo "<pre>";
	var_dump($news);
echo "</pre>";die;*/
		$this->config->set_item('compress_output', 'FALSE');
		
		$data['name']='XML RSS';
		$data['views']=1;
		$this->statistic->sum($data);	
		header('Content-type: text/xml; charset=utf-8');
		$request='<?xml version="1.0" encoding="UTF-8"?>
			  <rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:media="http://search.yahoo.com/mrss/"
     				xmlns:atom="http://www.w3.org/2005/Atom"
     				xmlns:georss="http://www.georss.org/georss">
					<channel>
					<atom:link href=\'http://www.futbolecuador.com/stories/rss\' rel=\'self\' type=\'application/rss+xml\' />
					<title>futbolecuador.com</title>
					<link>http://www.futbolecuador.com</link>
					<description><![CDATA[Futbol del Ecuador y del mundo]]></description>
					<image>
						<title>futbolecuador.com</title>
						<link>http://www.futbolecuador.com</link>
						<url>http://www.futbolecuador.com/images/logo_rss.png</url>
					</image>
					<language>es-ec</language>
					<pubDate>'.date('r',time()).'</pubDate>
				 ';

		foreach($news as $row):
		list($width, $height)=getimagesize($row->thumb400);
		$request=$request.'
		<item>
			<id>'.$row->id.'</id>			
			<title>'.$row->title.'</title>
			<subtitle>'.$row->subtitle.'</subtitle>
	      		<link>'.base_url().'stories/publica/'.$row->id.'</link>	      
			<enlace>'.base_url().'stories/publica/'.$row->id.'</enlace>	      
			<fecha>'.$row->created.'</fecha>			
	      		<guid > '.base_url().'stories/publica/'.$row->id.' </guid>
	      		<pubDate> '.date('r',$row->ntime).' </pubDate>
			<foto url="'.base_url().$row->thumb300.'"></foto>
			<imagen>'.base_url().$row->thumb300.'</imagen>
			<texto>'.$row->lead.'</texto>
	      		<dc:creator> @futbolecuador </dc:creator>	      
	      		<description>
				<![CDATA[
	        		<img src="'.base_url().$row->thumbh80.'"/> 
				<br>'.$row->lead.'
				<span>	&nbsp;</span>
	      			]]>
			</description>
	   		<content:encoded><![CDATA[
			        <p> <em> '.$row->title.' </em>.</p>
			        <figure>
			          <img src="'.base_url().$row->thumb300.'" width="300" />
			          <figcaption>
			           <strong>'.$row->title.' </strong>				            
			          </figcaption>
			        </figure>
			        <p> '.$row->body.'</p>				        
			      ]]>
			   </content:encoded>
			</item>';
		endforeach;
		$request=$request.'</channel></rss>';
		
		print $request;

	}

}
