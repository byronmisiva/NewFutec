<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modul{
	
	var $CI;
	var $noticias=array();
	var $section;
	var $blocks;
	
	public function __construct(){
		$this->CI =& get_instance();

		$this->positions=array('Rotativas' => '1','Principales' => '2','Noticia del Dia' => '3');
		$section=$this->CI->session->userdata('section');
		if($section=="")
			$section=SECTION_PRIN;
			
		$this->CI->load->model('section');
		$this->section=$this->CI->section->get($section);
		$this->blocks=array('1' => 'content','2' => 'block_left','3'=>'block_right');
	}
	
	
	public function set_modulos($section=0,$block=""){
		$this->CI->load->model('banner');
		$this->CI->load->model('module_section');
		$this->CI->load->model('section');
		
		if($section==0)
			$section=$this->CI->section->get_actual();
		
		if($section!=$this->section->id)
			$this->section=$this->CI->section->get($section);
		
		$mods=$this->CI->module_section->get_modules($section);

		
		switch($block){
		
			case "left":
				foreach($mods as $row){
					if($this->blocks[$row->block]=='block_left'){
						$banner=$this->CI->banner->has_banner($row->module_id);
						if($row->visible==1){
							if(method_exists($this,$row->function)){
								if($banner!=false)
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."','".$banner."');");
								else
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."');");
							}
						}
					}
				}
				break;
				
			case "right":
				foreach($mods as $row){
					if($this->blocks[$row->block]=='block_right'){
						$banner=$this->CI->banner->has_banner($row->module_id);
						if($row->visible==1){
							if(method_exists($this,$row->function)){
								if($banner!=false)
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."','".$banner."');");
								else
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."');");
							}
						}
					}
				}
				break;
				
			case "central":
				foreach($mods as $row){
					if($this->blocks[$row->block]=='content'){
						$banner=$this->CI->banner->has_banner($row->module_id);
						if($row->visible==1){
							if(method_exists($this,$row->function)){
								if($banner!=false)
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."','".$banner."');");
								else
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."');");
							}
						}
					}
				}
				break;
				
			case "laterals":
				foreach($mods as $row){
					if($this->blocks[$row->block]=='block_left' or $this->blocks[$row->block]=='block_right'){
						$banner=$this->CI->banner->has_banner($row->module_id);
						if($row->visible==1){
							if(method_exists($this,$row->function)){
								if($banner!=false)
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."','".$banner."');");
								else
									$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."');");
							}
						}
					}
				}
				break;
				
			default:
				foreach($mods as $row){
					$banner=$this->CI->banner->has_banner($row->module_id);
					if($row->visible==1){
						if(method_exists($this,$row->function)){
							if($banner!=false)
								$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."','".$banner."');");
							else
								$aux=eval("\$this->".$row->function."('".$this->blocks[$row->block]."');");
						}
					}
				}
				break;
		}
		
	}
	
	/*
	 * MODULOS
	 */
	
	public function mod_Titulo_Seccion($block){
		
		$data['name']=$this->section->name;
		$this->CI->template->write_view($block, 'public/section_name', $data, FALSE);
		
	}
	
	
	public function mod_Noticias_Principales($block,$num=8){
		
		$this->CI->load->model('story');
		$aux=$this->CI->story->get_rotativas();
		foreach($aux as $row)
			$this->noticias[]=$row->id;
		
		if(!is_null($this->section->category_id))
			$data['stories']=$this->CI->story->get_by_position($this->positions['Principales'],$this->noticias,$num,$this->section->id);
		else
			$data['stories']=$this->CI->story->get_by_position($this->positions['Principales'],$this->noticias,$num);
		$this->CI->template->write_view($block, 'public/story', $data, FALSE);
		foreach($data['stories'] as $row)
			$this->noticias[]=$row->id;
			
	}
	
	
	public function mod_Blogs_Principales($block,$num=1){
		
		$this->CI->load->model('blog');
		$data['stories']=$this->CI->blog->get_by_position($num);
		$this->CI->template->write_view($block, 'public/story', $data, FALSE);
		foreach($data['stories'] as $row)
			$this->noticias[]=$row->id;
	}
	
	public function mod_Blogs_plus($block){
		
		$this->CI->load->model('blog');
		$data['noticias']=$this->CI->blog->get_by_position(4,'',14);
		$this->CI->template->write_view($block, 'public/blog_plus', $data, FALSE);
		
	}

    //seccion nueva 2013
    public function mod_Blog_ZonaFe($block){
        $this->CI->load->model('blog');
        //$data['noticias']=$this->CI->blog->get_by_categoria(4,'44');
        $data['noticias']=$this->CI->blog->get_by_position(4,'63', 2);
        $this->CI->template->write_view($block, 'public/blog_zonafe', $data, FALSE);    
    }
    //fin seccion nueva 2013
	
	public function mod_Blogs_detaco($block){
		$this->CI->load->model('blog');
		$data['noticias']=$this->CI->blog->get_by_position(4,'',array('12104','12772'));
		if(count($data['noticias'])>0)
			$this->CI->template->write_view($block, 'public/blog_detaco', $data, FALSE);
	}
	
	public function mod_Blogs_reportajes($block){
		$aux=base_url();
		if($aux == 'http://new.futbolecuador.com/'){
			$this->CI->load->model('blog');
			$data['noticias']=$this->CI->blog->get_by_position(4,'',array('2998'));
			if(count($data['noticias'])>0)
				$this->CI->template->write_view($block, 'public/blog_reportajes', $data, FALSE);
		}
	}
	
	
	
	public function mod_Noticias_Dia($block,$num=1){
	
		$this->CI->load->model('story');
		$data['stories']=$this->CI->story->get_by_position($this->positions['Noticia del Dia'],$this->noticias,$num);
		$this->CI->template->write_view($block, 'public/story_day', $data, FALSE);
		foreach($data['stories'] as $row)
			$this->noticias[]=$row->id;
	}
	
	
	public function mod_Mas_Noticias($block){
		
		$this->CI->load->model('story');
		$this->rotativas(5);
		
		$data['name']='Nuestros Embajadores';
		$data['section']=$this->section->id;
		//TODO: Poner la variable general de la seccion ecuatorianos en el exterior
		$data['ecuatorianos']=$this->CI->story->get_more(28,$this->noticias);
		foreach($data['ecuatorianos'] as $row){
			$this->noticias[]=$row->id;
		}
		
		if(is_null($this->section->category_id))
			$data['mas_noticias']=$this->CI->story->get_more('all',$this->noticias);
		else
			$data['mas_noticias']=$this->CI->story->get_more($this->section->id,$this->noticias);
		
		foreach($data['mas_noticias'] as $row)
			$this->noticias[]=$row->id;
		$this->CI->template->write_view($block, 'public/mas_noticias', $data, FALSE);
	}
	
	public function mod_Mas_Noticias_Internacional($block){
		
		$this->CI->load->model('story');
		$this->rotativas(5);
		
		$data['name']='Fútbol Internacional';
		$data['section']=$this->section->id;
		//TODO: Poner la variable general de la seccion ecuatorianos en el exterior
		$data['ecuatorianos']=$this->CI->story->get_more(27,$this->noticias);
		foreach($data['ecuatorianos'] as $row){
			$this->noticias[]=$row->id;
		}
		
		if(is_null($this->section->category_id))
			$data['mas_noticias']=$this->CI->story->get_more('all',$this->noticias);
		else
			$data['mas_noticias']=$this->CI->story->get_more($this->section->id,$this->noticias);
		
		
		foreach($data['mas_noticias'] as $row)
			$this->noticias[]=$row->id;
		$this->CI->template->write_view($block, 'public/mas_noticias', $data, FALSE);
	}
	

	public function mod_Noticias_plus($block){
		$data="";
		$this->CI->template->write_view($block, 'public/noticias_plus', $data, FALSE);
	}
	
	public function mod_Noticia($block){
		
		$this->CI->load->model('story');
		$this->CI->load->model('blog');
		$this->CI->load->model('user');
		$id=$this->CI->uri->segment(3);
		$this->CI->story->set_read($id);
		$data['noticia']=$this->CI->story->get_complete($id);
		$data['blog']=$this->CI->blog->get_last('tribunas'); //Voz de las Tribunas
		$data['detaco']=$this->CI->blog->get_last('taco'); //De taco
		$data['author']=$this->CI->user->get($data['noticia']->author_id);
		$metatags=' <meta property="og:title" content="'.$data['noticia']->title.'" />
					<meta property="og:description" content="'.$data['noticia']->lead.'" />
					<meta property="og:image" content="'.base_url().$data['noticia']->thumb150.'" />';
		$this->CI->template->write('metatags',$metatags);
		$this->CI->template->write_view($block, 'stories/public',$data, FALSE);
		$this->CI->template->write('title',$data['noticia']->subtitle.' - futbolecuador.com',TRUE);
	}
	
	public function mod_Metadata($block){
		$this->CI->load->model('tag');
		$metas=$this->CI->tag->get_all();
		$data='';
		$i=0;
		foreach($metas->result() as $row):
			if($i!=0)
				$data.=', ';
			$data.=trim($row->name);
			$i++;
		endforeach;
		$this->CI->template->write('metas',$data,TRUE);
		
	}
	
	public function mod_Banner($block,$id=0){
		if($id>0){
			$this->CI->load->model('banner');
			$data['banner']=$this->CI->banner->get($id);
			$this->CI->template->write_view($block, 'public/banner', $data, FALSE);
		}
	}
	
	
	public function mod_Banner_Central($block,$id){
		
		$this->CI->load->model('banner');
		$data['banner']=$this->CI->banner->get($id);
		$this->CI->template->write_view($block, 'public/banner_central', $data, FALSE);
	}
	
	
	public function mod_Tabla_Posiciones($block){
		$data['championship']=$this->section->championship_id;
		$data['title']='Tabla de Posiciones';
		
		$this->CI->template->write_view($block, 'public/tabla_posiciones', $data, FALSE);
	}
	
	public function mod_Tabla_Acumulada($block){
		
		$data['championship']=$this->section->championship_id;
		$data['title']='Tabla de Posiciones Acumulada';
		
		$this->CI->template->write_view($block, 'public/tabla_posiciones_acumulada', $data, FALSE);
		
	}
	
	public function mod_Estadisticas(){
		
		$this->CI->load->model('team');
		
		$champ=$this->section->championship_id;
		$team=$this->section->team_id;
		
		$data['statistics']=$this->CI->team->team_all($champ,$team);
		$data['cards']=$this->CI->team->team_cards($champ,$team);
		$data['striker']=$this->CI->team->striker_championship($champ,$team);
		
		
	}
	
	
	public function mod_Resultados($block){
		$data['champ']=$this->section->championship_id;
		$this->CI->template->write_view($block, 'public/resultados', $data, FALSE);
	}
	

	public function mod_Goleadores($block){
		
		$this->CI->load->model('goals_position');
		$this->CI->load->model('championship');
	
		$data['championship']=$this->CI->championship->get($this->section->championship_id)->row();
		$data['jugadores']=$this->CI->goals_position->get_strikers($this->section->championship_id)->result();
		$data['champ']=$this->section->championship_id;
		
		if(count($data['jugadores'])>0)
			$data['goleador']=$data['jugadores'][0];
		else{
			$data['goleador'] = new stdClass();
			$data['goleador']->first_name="";
			$data['goleador']->last_name="";
			$data['goleador']->name="";
			$data['goleador']->thumb="imagenes/players/striker.jpg";
		}
		$this->CI->template->write_view($block, 'public/strikes', $data, FALSE);
	}
	
	
	public function mod_Encuesta($block){
		$this->CI->load->model('survey');
		$data=$this->CI->survey->get_complete($this->section->survey_id);
		if($data !== false)
			$this->CI->template->write_view($block, 'public/survey', $data, FALSE);
	}
	
	
	public function mod_Podcast($block){
		
		$data="";
		$this->CI->template->write_view($block, 'public/podcast', $data, FALSE);
		
	}
	
	
	public function mod_Equipo($block){
		
		$this->CI->load->model('team');
		$data['team']=$this->CI->team->get_details($this->section->team_id);
		$this->CI->template->write_view($block, 'public/team', $data, FALSE);
	}
	
	public function mod_Videos($block){
	
	}
	
	public function mod_La_Previa($block){
		
		$this->CI->load->model('statistic_match');
		$this->CI->load->model('match');
	
		$data['statistic']=current($this->CI->statistic_match->get_random());
		$data['match']=$this->CI->match->get_teams_name($data['statistic']->match_id);
		$this->CI->template->write_view($block, 'public/previa', $data, FALSE);
		
	}
	
	public function mod_Mini_Tabla_Posiciones($block){
		
		$this->CI->load->model('group');
		$this->CI->load->model('championship');
		$this->CI->load->model('teams_position');
		$this->CI->load->model('section');
		
		$data['teams']=$this->CI->section->get_teams();
		$round=$this->CI->championship->get_active_round($this->section->championship_id);
		$data['groups']=$this->CI->group->get_by_round($round);
		if(count($data['groups'])>0){
			$group=current($data['groups'])->id;
			if($group!="")
				$data['tabla']=$this->CI->teams_position->get_tabla($this->CI->teams_position->get_positions($group),$this->CI->teams_position->get_teams($group),$this->CI->teams_position->get_bonus($group));
			
			$data['team']=$this->section->team_id;
			$this->CI->template->write_view($block, 'public/mini_tabla', $data, FALSE);
		}
	}
	
	
	public function mod_Ultimos_Resultados($block){
		
		$this->CI->load->model('team');
		$data=$this->CI->team->get_results($this->section->team_id,8);
		$data['team']=$this->section->team_id;
		$this->CI->template->write_view($block, 'public/results_team', $data, FALSE);
		
	}
	
	
	public function mod_Llaves($block){
		if(!is_null($this->section->championship_id)){
			$data['ch']=$this->section->championship_id;
			$this->CI->template->write_view($block, 'gacos_matches/draw', $data, FALSE);	
		}
	}
	
	
	public function mod_Comentarios_Noticia($block){
		
		$this->CI->load->library('encrypt');
		$id=$this->CI->uri->segment(3);
		$key = 'xEsWa67AFr&w2nE';

		$data['story_key'] = $id;
		$this->CI->template->write_view($block, 'public/comments', $data, FALSE);
		
		/*
		$this->CI->load->model('comment');
		$this->CI->load->model('story');
		$id=$this->CI->uri->segment(3);
		$story=current($this->CI->story->get($id));
		
		if($story->position==10){
			if($id!=""){
				$data['comments']=$this->CI->comment->get_all_by_story($id);
				$data['total']=$this->CI->comment->count_all($id);
			}
			$data['story']=$id;
			$this->CI->template->write_view($block, 'public/comments', $data, FALSE);
		}*/
	}
	
	
	public function mod_Lluvia_Tags($block){
		$this->CI->template->write_view($block, 'public/cargar_tags', '', FALSE);
	}
	
	
	public function mod_Buscador($block){
		
		
		$data="";
		$this->CI->template->write_view($block, 'public/search', $data, FALSE);
	}
	
	public function mod_Statistics($block){
		
		$this->CI->load->model('team');
		$this->CI->load->model('section');
		$dts=$this->CI->section->get($this->CI->uri->segment(3));
		$champ=$dts->championship_id;
		$team=$dts->team_id;
		$data['statistics']=$this->CI->team->team_all($champ,$team);
		$data['cards']=$this->CI->team->team_cards($champ,$team);
		$this->CI->template->write_view($block, 'public/statistics', $data, FALSE);
	}
	
	public function mod_Last_Lineup($block){
		
		$this->CI->load->model('team');
		$this->CI->load->model('section');
		$dts=$this->CI->section->get($this->CI->uri->segment(3));
		$champ=$dts->championship_id;
		$team=$dts->team_id;
		$data=$this->CI->team->last_match($champ,$team);
		if($data!=NULL){
			$team=$this->CI->team->get_shirt($team)->result();
			$data['shirt']=$team[0]->mini_shirt;
			if($data['shirt']=='')
				$data['shirt']='imagenes/lineups/camiseta_1.png';
			$this->CI->template->write_view($block, 'public/last_lineups', $data, FALSE);
		}
	}
	
	public function mod_Team_Pics($block){
		
		$this->CI->load->model('team');
		$this->CI->load->model('section');
		$dts=$this->CI->section->get($this->CI->uri->segment(3));
		$champ=$dts->championship_id;
		$team=$dts->team_id;
		$team=$this->CI->team->get_shirt($team)->result();
		$data['uniform']=$team[0]->shirt;
		$data['uniform2']=$team[0]->shirt2;
		$data['team']=$team[0]->team_pic;
		if($data['uniform']!='' || $data['team']!=''){
			$this->CI->template->write_view($block, 'public/team_pics', $data, FALSE);
		}
	}
	
	public function mod_Goleador_Team($block){
		
		$this->CI->load->model('team');
		$data['jugadores']=$this->CI->team->get_strikes($this->section->team_id);
		
		if(count($data['jugadores'])>0)
			$data['goleador']=$data['jugadores'][0];
		else{
			$data['goleador']->first_name="";
			$data['goleador']->last_name="";
			$data['goleador']->name="";
			$data['goleador']->nick="NULL";
			$data['goleador']->thumb="imagenes/players/striker.jpg";
		}
		$this->CI->template->write_view($block, 'public/strikes_team', $data, FALSE);
	}
	
	public function mod_Links_Teams($block){
		
		$this->CI->load->model('championship');
		$this->CI->load->library('table');
		$teams=$this->CI->championship->get_teams($this->section->championship_id);

		$columns=array();
		foreach($teams as $row){
			if($row['section']>0)
				$columns[]=anchor('sections/publica/'.$row['section'], img(array('src'=>$row['thumb'],'border'=>'0')), array('title' => $row['name']));
			else
				$columns[]=img(array('src'=>$row['thumb'],'border'=>'0'));
		}
		$new_list = $this->CI->table->make_columns($columns, 5);
		$tmpl = array ( 'table_open'  => '<table border="0" cellpadding="2" cellspacing="1" width="100%">','cell_start'=> '<td align="center">', 'cell_alt_start'=> '<td align="center">',);

		$this->CI->table->set_template($tmpl); 
		$data['table']=$this->CI->table->generate($new_list);
		$data['name']='Lista de Equipos';
		$this->CI->template->write_view($block, 'public/link_teams', $data, FALSE);
	}
	
	public function mod_Flickr($block){
		if('http://localhost/CI_fe2008/'!=base_url()){
			$this->CI->load->library('flickr');
			$this->CI->load->library('table');
	 		
			$config = array(
				'type'				=> 'user',
				'user'				=> '42894014@N03',
				'num_items'			=> 15,
				'rss_cache_path'	=> APPPATH.'cache/flickr-rss-cache',
				'cache_time'		=> 3600,
				'img_cache_path'	=> APPPATH.'cache/flickr-image-cache',
				'img_cache_url'		=> base_url().'application/cache/flickr-image-cache',
				'use_cache'			=> false,
				'image_size'		=> 'square',
				'tags'				=> ''
			);
			
			$this->CI->flickr->init($config);
			$photos = $this->CI->flickr->get_photos();
			$table_data=array();
			foreach($photos as $photo){
				$link=str_replace("_s.jpg", ".jpg",$photo['image_url']);
				$table_data[]="<a href='$link' rel=\"lightbox[roadtrip]\"><img src='".$photo['image_url']."' width='40px' border='0'></a>";
			}
			$new_list = $this->CI->table->make_columns($table_data, 5);
				
			$tmpl = array('table_open'=>'<table border="0" width="220px" cellpadding="2" cellspacing="0" align="center">');
	
			$this->CI->table->set_template($tmpl);
			$data['tabla']=$this->CI->table->generate($new_list);
			$this->CI->template->write_view($block, 'public/flickr', $data, FALSE);
		}
	}

	public function mod_Twitter($block){
		/*
		$this->CI->load->library('flickr');
		$this->CI->load->library('table');
 		
		$config = array(
			'type'				=> 'user',
			'user'				=> '42894014@N03',
			'num_items'			=> 20,
			'rss_cache_path'	=> APPPATH.'cache/flickr-rss-cache',
			'cache_time'		=> 300,
			'img_cache_path'	=> APPPATH.'cache/flickr-image-cache',
			'img_cache_url'		=> base_url().'application/cache/flickr-image-cache',
			'use_cache'			=> false,
			'image_size'		=> 'square',
			'tags'				=> 'live',
		);
		
		$this->CI->flickr->init($config);
		
		$photos = $this->CI->flickr->get_photos();
		$table_data=array();
		$i=0;
		$hours=18;
		if($photos[0]['date']>(time() - ($hours * 60 * 60))){
			foreach($photos as $photo){
				if($photo['date']>(time() - ($hours * 60 * 60))){
					$link=str_replace("_s.jpg", ".jpg",$photo['image_url']);
					$feeds[$i]['expand']=$link;
					$feeds[$i]['pics']=$photo['image_url'];
		   			$date=ucfirst(strftime('%H:%M',$photo['date']));
		   			$feeds[$i]['title']='<strong>'.$date.'</strong> - '.$photo['title'];
					$i+=1;
				}
			}
		}
	   	
		if($i!=0){
	   		$data['title']='En Vivo';
	   		$data['feeds']=$feeds;
	   		$this->CI->template->write_view($block, 'blogs/twitter', $data, FALSE);
   		}
   		*/
	}

	function mod_Mundialistas($block){
		$data="";
		$this->CI->template->write_view($block, 'public/mundialistas', $data, FALSE);
	}
	
	function mod_Entrevistas($block){
		$this->CI->load->model('profile');
	
		$data['profile']=$this->CI->profile->get_last();
		if($data['profile']!=false)
			$this->CI->template->write_view($block, 'public/profile', $data, FALSE);
	}
	
	function mod_Noticia_Patrocinada($block){
		$this->CI->load->model('story');
		//$data['story']=current($this->CI->story->get_by_position($this->positions['Noticia del Dia'],$this->noticias,1));
		$data['story']=current($this->CI->story->get_sponsored());
		if($data['story'] !== false)
			$this->CI->template->write_view($block, 'public/story_day_brand', $data, FALSE);

	}
	
	function mod_FEMagazine($block){
		$data=array();
		$this->CI->template->write_view($block, 'public/femagazine', $data, FALSE);
	}


	//FUNCIONES PRIVADAS
	
	function check($id,$last){
		$this->CI->load->model('flash');
		if(($last+300)<time()){
			$data['check']=mdate('%Y-%m-%d %h:%i:%s',time());
			$this->CI->db->where('id',$id);
			$this->CI->db->update('flashes',$data);
			$this->CI->flash->twitter();
		}
	}

	private function is_mod($var) {
	    return (substr($var,0,3) == 'mod');
	}
	
	
	private function rotativas($max){
		$data['query']=$this->CI->story->get_banner($max);
		foreach($data['query'] as $row)
			$this->noticias[]=$row->sid;
	}
	
	public function get_module_methods(){
		$arr=get_class_methods($this);
		$arr=array_filter($arr,array($this,"is_mod"));
		$final=array();
		foreach($arr as $aux){
			$final[$aux]=str_replace('_',' ',substr($aux,4));
		}
		asort($final);
		return $final;
	}
	
}

// END Module_Helper Class

/* End of file modules_helper.php */
/* Location: ./system/application/helper/modules_helper.php */
