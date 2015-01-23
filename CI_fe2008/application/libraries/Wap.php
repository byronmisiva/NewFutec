<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class CI_Wap {

	var $CI;
	
	function CI_Wap(){
		$this->CI =& get_instance();
		$this->CI->load->helper('date');
	}
	
	function header(){
		return $wap='<?xml version="1.0" encoding="UTF-8"?>
					  <!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"
					  "http://www.wapforum.org/DTD/wml_1.1.xml">
					  <wml>';
	}
	
	function close(){
		return $wap='</wml>';
	}
	
	function p_open(){
		return '<p>';
	}
	
	function p_close(){
		return '</p>';
	}
	
	function card_open($id, $title, $op){
		return $wap='<card id="'.$id.'" title="'.$title.'" '.$op.'>';
	}

	function card_close(){
		return $wap='</card>';	
	}
	
	function pic($link,$name){
		return '<img src="'.base_url().$link.'" alt="'.$name.'" />';
	}
	
	function template_open(){
		return '<template>';
	}
	
	function template_close(){ 
		return '</template>';
	}
	
	function next($label,$link){
		return '<do name="'.$label.'" type="unknown" label="'.$label.'">
					<go href="#'.$link.'"/>
				</do>';	
	}
	
	function back($label){
		return '<do name="'.$label.'" type="prev" label="'.$label.'">
					<prev/>
				</do>';
	}
	
	function refresh($link){
		return '<do name="refresh" type="unknown" label="Refrescar">
					<go href="'.base_url().$link.'"/>
				</do>';
	}
	
	function button($links){
		$wap='';
		foreach($links as $row):	
   			$wap=$wap.'<br/><a href="'.base_url().$row['link'].'">'.$row['name'].'</a>';
   		endforeach;
		return $wap;
	}
	
	function news($limit){
		$this->CI->load->model('story');
		$stories=$this->CI->story->get_stories_movil($limit,0,0);
		$wap='<br/><br/>';
		foreach($stories->result() as $row):	
   			$wap=$wap.'<a href="'.base_url().'waps/read/'.$row->id.'">'.$row->title.'</a><br/>';
  		endforeach;
		return $wap;
	}	
	
	function news_section($id,$limit){
		$this->CI->load->model('story');
		$stories=$this->CI->story->get_stories_movil_section($id,$limit);
		$wap='<br/><br/>';
		foreach($stories->result() as $row):	
   			$wap=$wap.'<a href="'.base_url().'waps/read/'.$row->id.'">'.$row->title.'</a><br/>';
  		endforeach;
		return $wap;
	}
	
	function read($story){
		$this->CI->load->model('story');
		$stories=$this->CI->story->get_complete_movil($story);
		foreach($stories->result() as $row):
			$wap='<strong>'.$this->format($row->title).'</strong><br/>
				  <i>'.$this->format($row->subtitle).'</i><br/><br/>
				  <img src="'.base_url().$row->thumbh80.'" alt="'.$this->format($row->title).'"/><br/>'
				 .$this->format($row->lead).$this->format($row->body);
		endforeach;
		
		return $wap;
	} 
	
	function last_result($which){
   		$this->CI->load->model('match_calendary');
   		$query=$this->CI->match_calendary->matches_last_next(28,$which);
	   	$wml='';
		$champ='';
		$round='';
		$group=''; 
		$sn='';
		$tiempo['0']='No iniciado';
		$tiempo['1']='Primer Tiempo';
		$tiempo['2']='Fin del Primer Tiempo';
		$tiempo['3']='Segundo Tiempo';
		$tiempo['4']='Fin del Segundo Tiempo';
		$tiempo['5']='Primer Tiempo Extra';
		$tiempo['6']='Segundo Tiempo Extra';
		$tiempo['7']='Penales';
		$tiempo['8']='Fin del Partido';
		$tcheck=0;
		
	 	foreach($query->result() as $row): 
			if($champ!=$row->cn){
			 	if($tcheck!=0){
					$wml=$wml.'</table>';
				  	$wml=$wml.'<br/>';
			 	}
		       	$wml=$wml.'<table><tr><td>'.$row->cn.'</td></tr></table>';
		 		$wml=$wml.'<table><tr><td>'.$row->rn.'</td></tr></table>';
		 		$wml=$wml.'<table><tr><td>'.$row->gn.'</td></tr></table>';
			  	$wml=$wml.'<br/>';
		 		$wml=$wml.'<table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
		 		$champ=$row->cn;
			  	$round=$row->rn;
			  	$group=$row->gn; 
			  	$sn=$row->sn;
			  	$wml=$wml.'<table columns="2">';
			  	$tcheck=1;
		 	}
		 	if($round!=$row->rn){
			    if($tcheck!=0){
			  		$wml=$wml.'</table>';
			  	}
		 	   	$wml=$wml.'<table><tr><td>'.$row->rn.'</td></tr></table>';
		 		$wml=$wml.'<table><tr><td>'.$row->gn.'</td></tr></table>';
			  	$wml=$wml.'<br/>';
		 		$wml=$wml.'<table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
			  	$round=$row->rn;
			  	$group=$row->gn; 
			  	$sn=$row->sn;
			  	$wml=$wml.'<table columns="2">';
			  	$tcheck=1;
		 	}
		 	if($group!=$row->gn){
			  	if($tcheck!=0){
			  		$wml=$wml.'</table>';
		 	   	}
		 		$wml=$wml.'<table><tr><td>'.$row->gn.'</td></tr></table>';
			  	$wml=$wml.'<br/>';
		 		$wml=$wml.'<table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
			  	$group=$row->gn; 
			  	$sn=$row->sn;
			  	$wml=$wml.'<table columns="2">';
			  	$tcheck=1;
		 	}
		 	if($sn!=$row->sn){
			    if($tcheck!=0){
			  		$wml=$wml.'</table>';
			  	}
			  	$wml=$wml.'<br/>';
		 		$wml=$wml.'<table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
			  	$sn=$row->sn;
			  	$wml=$wml.'<table columns="2">';
			  	$tcheck=1;
		 	}
 	
			$wml=$wml.'<tr>
					 	    <td>'.$row->hname.'</td>	
						    <td>'.substr($row->result,0,1).'</td>
					   </tr>
					   <tr>
							<td>'.$row->aname.'</td>
							<td>'.substr($row->result,4,1).'</td>	
				 	   </tr>
				 	   <tr>
				 			<td>'.mdate('%Y-%m-%d %h:%i',$row->dm).'</td>
				 			<td></td>
				 	   </tr>
				 	   <tr>
				 	   		<td>---------------------------</td>
				 	   		<td></td>
				 	   </tr>
				 	   ';

		endforeach;
	   
		if($tcheck!=0){
	 		$wml=$wml.'</table>';
	   	}
	   	else
	 	   	$wml=$wml.'<p>No existen partidos hoy</p>';

	 	return $wml;
	}
	
	function positions($group){
		$this->CI->load->model('teams_position');
		
		$tabla=$this->CI->teams_position->get_table($group);
		
		$wml='<table columns="5" align="CLCCC">
			  <tr>
				<td></td>
				<td><strong>Equipo</strong></td>
				<td><strong>PJ</strong></td>
				<td><strong>Pts</strong></td>
				<td><strong>GD</strong></td>
			  </tr>';
		$j=1;
		foreach($tabla as $row){
			$wml=$wml."<tr>";
			$wml=$wml."<td class='data'>".$j."</td>\n";
			$wml=$wml."<td class='name'>".$row['name']."</td>\n";
			$wml=$wml."<td class='data'>".$row['pj']."</td>\n";
			$wml=$wml."<td class='data'>".$row['points']."</td>\n";
			$wml=$wml."<td class='data'>".$row['gd']."</td>\n";
			$wml=$wml."</tr>";
			$j+=1;
		}
		$wml=$wml.'</table>';
		return $wml;
	}
	
	function positions_ac($champ){
		$this->CI->load->model('teams_position');
		
		$tabla=$this->CI->teams_position->get_table_by_champ($champ);
		
		
		$wml='<table columns="5" align="CLCCC">
			  <tr>
				<td></td>
				<td><strong>Equipo</strong></td>
				<td><strong>PJ</strong></td>
				<td><strong>Pts</strong></td>
				<td><strong>GD</strong></td>
			  </tr>';
		
		$j=1;
		foreach($tabla as $row){
			$wml=$wml."<tr>";
			$wml=$wml."<td class='data'>".$j."</td>\n";
			$wml=$wml."<td class='name'>".$row['name']."</td>\n";
			$wml=$wml."<td class='data'>".$row['pj']."</td>\n";
			$wml=$wml."<td class='data'>".$row['points']."</td>\n";
			$wml=$wml."<td class='data'>".$row['gd']."</td>\n";
			$wml=$wml."</tr>";
			$j+=1;
		}
		$wml=$wml.'</table>';
		//var_dump($wml);
		return $wml;
	}
	
	function titles($name){
   		$wml='<br/><br/><strong>'.$name.'</strong><br/>';
   		return $wml;
   	}
   	
   	function sections(){
   		$this->CI->load->helper('inflector');
   		$query=$this->CI->db->query('Select * from sections where wap=1');
   		$wml='';
   		foreach($query->result() as $row):
   			$name=underscore('Noticias - '.$row->name);
   			$wml=$wml.'<a href="'.base_url().'waps/more/'.$name.'/'.$row->id.'">'.$row->name.'</a><br/>';
   		endforeach;
   		return $wml;
   	}
	
	function scoreboard(){
   		$data['matches']=$this->matches_today_movil();
   		$this->CI->config->load('config');
   		$ref=REFRESH_VIVO*10;
   		$data['refresh']='<timer value="'.$ref.'"/>';
		return $data;
	}
	
	function single($id){
   		$data['matches']=$this->game_all_movile($id);
   		$this->CI->config->load('config');
   		$ref=REFRESH_VIVO*10;
   		$data['refresh']='<timer value="'.$ref.'"/>';
		return $data;
	}

	function format($text){
		$busca= array('nbsp;','hellip;','&rsquo;','&lsquo;','&ldquo;','&rdquo;','&mdash;','&ntilde;','&Ntilde;','�','�','�','�','�','�','�','�','�','�','�','�','&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;');
		$rempl= array('',     '',       '',       '',       '',       '',       '',       'n',       'N',       'n','N','a','e','i','o','u','A','E','I','O','U','a',							'e',							'i',							'o',							'u',							'A',							'E',							'I',							'O',							'U');
		$texto=str_replace($busca,$rempl,$text);
		$texto=str_replace('&','',$texto);
		return $texto;
	}
	
	function matches_today_movil(){
		$this->CI->load->model('match_calendary');
		$mttd=$this->CI->match_calendary->today_matches('live');
		if($mttd->num_rows<1){
			return '<p>No existen partido en vivo hoy</p>';
		}
		else{
		$wap='';
		foreach($mttd->result() as $row):  
			$aux=strpos(trim($row->result),'-');
			
			$wap=$wap.'<table columns="2" align="LR">
						   <tr>
								<td>'.$row->hname.'</td>
								<td>'.trim(substr(trim($row->result), 0, $aux)).'</td>
						   </tr>
						   <tr>
						   		<td>'.$row->aname.'</td>
						   		<td>'.trim(mb_substr(trim($row->result), $aux+1)).'</td>
						   </tr>
					 	   <tr>
						 	   <td><a href="'.base_url().'waps/single/'.$row->id.'">Detalle</a></td>
						 	   <td></td>
					 	   </tr>
						   <tr>
						   		<td>-------------------------------------------------</td>
						   		<td>-</td>
						   </tr>
						</table>';
		endforeach;
		return $wap;
		}	
	}
	
	function game_all_movile($id){
			$partido=$this->CI->db->query('SELECT m.id, m.group_id, UNIX_TIMESTAMP(m.date_match) as date, m.result, m.stadia_id, mt.team_id_home as hid, mt.team_id_away as aid 
									   FROM matches as m, matches_teams as mt
									   WHERE m.id ='.$id.' AND mt.match_id=m.id')->result() ;
			$home=$this->CI->db->query('Select *
									From teams
									Where id='.$partido[0]->hid)->result();
			$away=$this->CI->db->query('Select *
									From teams
									Where id='.$partido[0]->aid)->result();
			
			$wap='';
			
			
			$aux=strpos(trim($partido[0]->result),'-');
			
			$wap=$wap.'<table columns="2">
						   <tr>
								<td>'.$home[0]->name.'</td>
								<td>'.trim(substr(trim($partido[0]->result), 0, $aux-1)).'</td>
						   </tr>
						   <tr>
								<td>'.$away[0]->name.'</td>
								<td>'.trim(mb_substr(trim($partido[0]->result), $aux+1)).'</td>
						   </tr>
					   </table>';

						
			$accion=$this->CI->db->query('Select match_time, type, text
									  	  From actions
									  	  Where match_id='.$id);
			
			
			$goles=$this->CI->db->query('Select g.minute, p.first_name, p.last_name
										 From goals as g, players as p
										 Where g.match_id='.$id.' and p.id=g.player_id');
			
			$tarjetas=$this->CI->db->query('Select c.minute, c.type, p.first_name, p.last_name
											From cards as c, players as p
											Where c.match_id='.$id.' and p.id=c.player_id');
			
			$cambios=$this->CI->db->query('Select c.minute, p.first_name as fin, p.last_name as lin, l.first_name as fou, l.last_name as lou
										   From changes as c, players as p, players as l
										   Where c.match_id='.$id.' and p.id=c.in and l.id=c.out');
			
			$acciones;
			
			$i=0;
			foreach($goles->result() as $row):
				$acciones[$i]['minuto']=$row->minute;
				$acciones[$i]['type']=100;
				$acciones[$i]['texto']='Gol de '.$row->first_name.' '.$row->last_name;
				$i++;
			endforeach;
			$type[1]='Tarjeta Amarilla';
			$type[2]='Tarjeta Roja';
			foreach($tarjetas->result() as $row):
				$acciones[$i]['minuto']=$row->minute;
				$acciones[$i]['type']=100;
				$acciones[$i]['texto']=$type[$row->type].' para '.$row->first_name.' '.$row->last_name;
				$i++;
			endforeach;
			foreach($cambios->result() as $row):
				$acciones[$i]['minuto']=$row->minute;
				$acciones[$i]['type']=100;
				$acciones[$i]['texto']='Cambio '.$row->fin.' '.$row->lin.' por '.$row->fou.' '.$row->lou;
				$i++;
			endforeach;
			foreach($accion->result() as $row):
				if(is_numeric($row->type)){
					$acciones[$i]['minuto']=$row->match_time;
					$acciones[$i]['type']=$row->type;
					$acciones[$i]['texto']=$row->text;
					$i++;
				}							   
			endforeach;
		
			if($i>0){
				foreach ($acciones as $key=>$arr) {
					$pun[$key] = $arr['minuto'];
					$g1[$key] = $arr['type'];
				}
				array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$acciones);
				
				$wap=$wap.'<br/><strong>Acciones</strong><br/><table columns="1">';
				foreach($acciones as $row):
					if($row['minuto']>120)
						$row['minuto']='';
					else
						$row['minuto']=$row['minuto']."' - ";
					$wap=$wap.'<tr>
							   <td>'.$row['minuto'].$row['texto'].'</td>
							   </tr>';
				endforeach;	
				$wap=$wap.'</table>';
			}
			
			return $wap;
	}
}
?>