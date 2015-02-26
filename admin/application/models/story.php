<?php
class Story extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('story_stat');
        $this->load->model('section');
    	$this->name='stories';
	}  

    function get($id){
    	$this->db->where('id',$id);
    	$aux=$this->db->get($this->name)->result();
		return $aux;
    }
    
 	function get_complete($id){
    	$this->db->select('s.*,i.thumb400,i.thumb300,i.thumb150,i.thumbh120,thumbh50, UNIX_TIMESTAMP(s.modified) as datem,i.name as image_name',FALSE);
    	$this->db->join('images i','s.image_id=i.id','LEFT');
    	//$this->db->where('s.image_id','i.id',FALSE);
    	$this->db->where('s.id',$id);
    	$aux=current($this->db->get('stories s')->result());
    	
    	$this->db->select('t.*');
    	$this->db->from('stories_tags st,tags t');
    	$this->db->where('st.tag_id','t.id',FALSE);
    	$this->db->where('st.story_id',$id);
    	$this->db->order_by('t.name','asc');
    	$aux->tags=$this->db->get()->result();
    	if($this->session->userdata('role')>=3){
    		$stat=$this->story_stat->get_story_stat($aux->id);
    		$aux->rate=$stat->rate;
    		$aux->reads=$stat->reads;
    		$aux->sends=$stat->sends;
    		$aux->votes=$stat->votes;	
    	}	
    		
    	return $aux;
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=30;
		$this->pagination->initialize($config);
		$this->db->order_by("created", "desc");
		$this->db->where_not_in('position', array('10','12104'));
		return $this->db->get($this->name,$config['per_page'], $page);
    }
    
    function get_limit($limit){
    	$this->db->order_by("created", "desc");
    	$this->db->limit($limit);
    	$this->db->where('position !=',10);
    	return $this->db->get($this->name);
    }
    
  	function get_all_by($page=0,$data){
    	$config['base_url']=base_url().'/'.$this->name.'/'.$data;
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=30;
		$this->pagination->initialize($config);
		$this->db->where('position !=',10);
		$this->db->where('created >',"ADDTIME(NOW(),'-30 00:00:00')", FALSE); 
		$this->db->order_by($data, "desc");
		return $this->db->get($this->name,$config['per_page'], $page);
    }
    
	function get_by_category($data="",$limit=10){
		if($data!="")
			$this->db->where('category_id',$data, FALSE); 
		$this->db->limit($limit);
		$this->db->where('position <=',10);
		$this->db->order_by('created', "desc");
		return $this->db->get($this->name);
    }
    
        function get_by_position($position,$noticias,$limit,$seccion=""){
    	if($seccion != ""){
    		$sec=$this->section->get($seccion);
            $test2 = $this->db->last_query();
    		$res=$this->section->get_tag_list($seccion);
    		$tags=array();
    		$str_tags="";
    		foreach($res as $row){
    			$tags[]=$row->tag_id;
    			$str_tags.=$row->tag_id.',';
    		}
    		$str_tags=trim($str_tags,',');
            $test1 = $this->db->last_query();
    		if(count($tags)>0){
	    		$this->db->from('stories s, images i,stories_tags st');
	    		$this->db->where('s.id','st.story_id', FALSE);
	    		$this->db->where('i.id','s.image_id', FALSE); 
	    		$this->db->where('s.position <',10);
	    		$where = "(category_id=$sec->category_id OR st.tag_id IN($str_tags))";
				$this->db->where($where);
				$this->db->group_by('s.id');
    		}
    		else{
    			$this->db->from('stories s, images i');
				$this->db->where('i.id','s.image_id', FALSE);	
    		}
    	}
    	else{
    		$this->db->from('stories s, images i');
			$this->db->where('i.id','s.image_id', FALSE);
			$this->db->where('s.position <',10);
			if($position>0)
				$this->db->where('s.position',$position);
    	}
    	
    	$this->db->select('s.*,i.thumbh120 as thumb1,i.thumbh80 as thumb2,i.thumbh50 as thumb3,s.created as time,i.name as image_name',FALSE);
	    $this->db->where('s.invisible','0');
	    if(count($noticias)>0)
	    	$this->db->where_not_in('s.id',$noticias);
	    $l=explode(',',$limit);
		if(count($l)>1)
			$this->db->limit($l[0],$l[1]);
		else
	    	$this->db->limit($limit);
		$this->db->order_by('s.created',"desc");
    	
		$aux=$this->db->get()->result();
        $test = $this->db->last_query();
    	foreach($aux as $key=>$row){
    		$date=explode(" ",$row->time);
    		$fecha=explode("-",$date[0]);
    		$hora=explode(":",$date[1]);
    		
    		$aux[$key]->time=mktime($hora[0],$hora[1],$hora[2],$fecha[1],$fecha[2],$fecha[0]);
    		if($this->session->userdata('role')>=3){
    			$stat=$this->story_stat->get_story_stat($row->id);
    			$row->rate=$stat->rate;
	    		
    			$aux[$key]->reads=$stat->reads;
	    		$aux[$key]->sends=$stat->sends;
	    		$aux[$key]->votes=$stat->votes;	

	    	}	
    	}
    	
		return $aux;
    }
  
	function get_commented($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/commented';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=30;
		$this->pagination->initialize($config);
		
		$past_days=30;
    	$last_month=date('Y-m-d',mktime(0, 0, 0,date("m"),date("d")-$past_days,date("Y")));
		
		$this->db->select('s.*,count(*) as comments');
		$this->db->from('comments c');
		$this->db->where('c.story_id','s.id', FALSE);
		$this->db->where('s.created >',$last_month); 
		$this->db->where('s.invisible','0');
		$this->db->where('s.position !=',10); 
		$this->db->group_by("story_id");
		return $this->db->get($this->name. ' s',$config['per_page'], $page);
    }
    
    function get_more($section,$noticias=0,$num=5){
		
    	$this->load->model('section');
    	if($section!='all'){
    		$sec=$this->section->get($section);
    		$res=$this->section->get_tag_list($section);
    		$tags=array();
    		$str_tags="";
    		foreach($res as $row){
    			$tags[]=$row->tag_id;
    			$str_tags.=$row->tag_id.',';
	    	}
	    	$str_tags=trim($str_tags,',');
	    			
	    	if(count($tags)>0){
		    	$this->db->from('stories_tags st');
		    	$this->db->where('s.id','st.story_id', FALSE);
		    	$this->db->where('s.position <',10);
		    	if(is_null($sec->category_id))
		    		$where = "(st.tag_id IN($str_tags))";
		    	else
		    		$where = "(s.category_id=$sec->category_id OR st.tag_id IN($str_tags))";
				$this->db->where($where);
					
	    	}	
    	}

    	if(count($noticias)>0)
    		$this->db->where_not_in('s.id',$noticias);
    	elseif($noticias>0 and !is_array($noticias))
    		$this->db->where('s.id <', $noticias); 
		
    	$this->db->select('s.*,modified as time',FALSE);
    	$this->db->where('s.invisible','0'); 
    	$this->db->where('s.position <',10);
    	$this->db->limit($num);
    	$this->db->order_by('s.created',"desc");
    	$this->db->order_by('s.id',"desc");
    	$this->db->group_by('s.id');
    	$aux=$this->db->get($this->name.' as s')->result();
    	foreach($aux as $key=>$row){
    		$date=explode(" ",$row->time);
    		$fecha=explode("-",$date[0]);
    		$hora=explode(":",$date[1]);
    		
    		$aux[$key]->time=mktime($hora[0],$hora[1],$hora[2],$fecha[1],$fecha[2],$fecha[0]);
    		if($this->session->userdata('role')>=3){
    			$stat=$this->story_stat->get_story_stat($row->id);
    			$row->rate=$stat->rate;
	    		
    			$aux[$key]->reads=$stat->reads;
	    		$aux[$key]->sends=$stat->sends;
	    		$aux[$key]->votes=$stat->votes;	

	    	}	
    	}
    	
    	return $aux;
    }
    
    function get_plus($option,$num=5){
    	
    	$past_days=7;
    	$last_month=date('Y-m-d',mktime(0, 0, 0,date("m"),date("d")-$past_days,date("Y")));
    	$this->db->where('s.created >',$last_month);
    	$this->db->where('s.invisible','0'); 
    	$this->db->where('s.position !=',10);
    	$this->db->limit($num);
    	
    	switch($option){
    		case 'visitadas':
    			$this->db->from('stories_stats ss');
    			$this->db->where('ss.story_id','s.id', FALSE);
    			$this->db->order_by('ss.reads','desc');
    			$data=$this->db->get($this->name. ' s');
    			break;
    		
    		case 'comentadas': 
    			$this->db->select('s.*,count(*) as comments');
				$this->db->from('comments c');
				$this->db->where('c.story_id','s.id', FALSE);
				$this->db->where('c.aproved','1'); 
				$this->db->group_by("s.id");
				$this->db->order_by("comments","desc");
				$data=$this->db->get($this->name. ' s');	
    			break;
    			
    		case 'enviadas':
    			$this->db->from('stories_stats ss');
    			$this->db->where('ss.story_id','s.id', FALSE);
    			$this->db->order_by('ss.sends','desc');
    			$data=$this->db->get($this->name. ' s');
    			break;
    	}

    
    	return $data;	
    }
    
    function insert($data){
    	
    }
    
    function update($data){
    	
    }
    
    function delete($id){
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return true;
    }
    
    function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc");
    	$this->db->where('position !=',10); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione una Noticia...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_programed(){
    	return $this->db->query('Select * 
    			   			     From stories
    					  	     Where programed is not null AND position != 10');
    	 
    }
    
	function story_category($cat,$num){
		$query=$this->db->query('Select s.*, i.thumb640, i.thumb400, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
								 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified, s.image_id
								  	   From stories as s 
								  	   Where s.category_id='.$cat.' AND s.invisible=0 AND s.position!=10
								  	   Order By s.created DESC
								  	   Limit 0 , '.$num.') as s
								 LEFT JOIN images as i ON s.image_id=i.id');
		
		$request="<Noticias>";
		foreach($query->result() as $story):
			$request=$request."<Noticia>
									<id>".$story->id."</id>
									<titulo>".$story->title."</titulo>
									<subtitulo>".$story->subtitle."</subtitulo>
									<encabezado>".htmlentities(strip_tags($story->lead))."</encabezado>
									<cuerpo>".htmlentities(strip_tags($story->body))."</cuerpo>
									<modificado>".$story->modified."</modificado>
									<thumb640>".$story->thumb640."</thumb640>
									<thumb400>".$story->thumb400."</thumb400>
									<thumb300>".$story->thumb300."</thumb300>
									<thumb150>".$story->thumb150."</thumb150>
									<thumb100>".$story->thumb100."</thumb100>
									<thumbh160>".$story->thumbh160."</thumbh160>
									<thumbh120>".$story->thumbh120."</thumbh120>
									<thumbh80>".$story->thumbh80."</thumbh80>
									<thumbh50>".$story->thumbh50."</thumbh50>
					  		   </Noticia>";
		endforeach;
		$request=$request."</Noticias>";
		return $request;
	}
	
	function story_section($sec,$num){
		$cat=$this->db->query('Select category_id 
						  	   From sections
						  	   Where id='.$sec)->result();	
		return $this->story_category($cat[0]->category_id,$num);
	}
	
	function rss($sec){
		if($sec==FALSE){
			$query=$this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
									 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified, s.image_id
									  	   From stories as s 
									  	   Where s.invisible=0 AND s.position<10
									  	   Order By s.created DESC
									  	   Limit 0 , 20) as s
									 LEFT JOIN images as i ON s.image_id=i.id');
		}
		else{
			$cat=$this->db->query('Select category_id 
							  	   From sections
							  	   Where id='.$sec)->result();	
			
			$query=$this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
									 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified, s.image_id
									  	   From stories as s 
									  	   Where s.category_id='.$cat[0]->category_id.' AND s.invisible=0  AND s.position<10
									  	   Order By s.created DESC
									  	   Limit 0 , 20) as s
									 LEFT JOIN images as i ON s.image_id=i.id');
		}
		
		return $query;
	} 

	function rssNotifificacion($sec){
		if($sec==FALSE){
			$query=$this->db->query('
			Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
			From (Select s.id, s.title, s.subtitle, s.lead, s.body,s.created, s.modified, s.image_id
			  	  From stories as s
				  Where s.invisible=0 AND s.position<10
				  Order By s.created DESC
				  Limit 0 , 20) as s
				  LEFT JOIN images as i ON s.image_id=i.id ORDER BY s.modified') ;
		}
		else{
			$cat=$this->db->query('
				Select category_id
				From sections
				Where id='.$sec)->result();
		
			$query=$this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
									 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified,s.created, s.image_id
									  	   From stories as s
									  	   Where s.category_id='.$cat[0]->category_id.' AND s.invisible=0  AND s.position<10
									  	   Order By s.created DESC
									  	   Limit 0 , 20) as s
									 LEFT JOIN images as i ON s.image_id=i.id ORDER BY s.modified' );
		}
		
		return $query->result();
	}

	function get_banner($max = 5, $exclude = ''){
		$this->db->select("s.id as sid,
				s.id,
				s.title,
				s.subtitle,
				s.sponsored,
				s.created,
				s.rate,
				s.reads,
				s.sends,
				s.votes,
				i.name,
				i.thumbh50,
				i.thumb500", FALSE);
		$this->db->from('stories  s', FALSE);
		$this->db->join('images i', 's.image_id = i.id', FALSE);
		$this->db->where('s.invisible', 0, FALSE);
		$this->db->where('s.position', 1, FALSE);
		$this->db->where('s.sponsored', 0, FALSE);
		$this->db->where('s.created >=', '(DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY))', FALSE);
		$this->db->order_by('s.created','desc', FALSE);
		$this->db->limit($max);
		//para el caso de que se tenga la noticia 6 y que esta no se muestre
		if ($exclude != "")
			$this->db->where('s.category_id !=', $exclude);
		$aux = $this->db->get()->result();
		foreach($aux as $key=>$row){
			if($this->session->userdata('role') >= 3){
				$stat = $this->story_stat->get_story_stat($row->sid);
				$aux[$key]->rate=$stat->rate;
				$aux[$key]->reads=$stat->reads;
				$aux[$key]->sends=$stat->sends;
				$aux[$key]->votes=$stat->votes;

			}
		}

		return $aux;
	}
	
	function get_sponsored($excluded=array(),$max=1){
		
		$this->db->select('s.id as sid,s.*, i.*,i.name as image_name');
		$this->db->from('stories as s, images as i');
		$this->db->where('s.image_id','i.id',FALSE);
		$this->db->where('s.sponsored',1);
		$this->db->where('s.invisible',0);
		if(count($excluded)>1)
			$this->db->where_not_in('s.id',$excluded);
		$this->db->order_by('s.created','desc');
		$this->db->limit($max);
		
		$aux = $this->db->get()->result();
		
		return $aux;
	}
	function get_zonaFE($excluded=array(),$max=1){

		$this->db->select('s.id as sid,s.*, i.*,i.name as image_name');
		$this->db->from('stories as s, images as i');
		$this->db->where('s.image_id','i.id',FALSE);
        $this->db->where('s.category_id',44);
		$this->db->where('s.invisible',0);
		if(count($excluded)>1)
			$this->db->where_not_in('s.id',$excluded);
		$this->db->order_by('s.created','desc');
		$this->db->limit($max);

		$aux = $this->db->get()->result();

		return $aux;
	}

	function story_by_tags($tag, $limit){
		return $this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as datem, i.thumbh50, i.thumbh80 
								 From stories as s, stories_tags as st, tags as t,images as i
								 Where lower("'.$tag.'")=lower(t.name) AND t.id=st.tag_id AND st.story_id=s.id AND s.image_id=i.id AND  s.position!=10
								 Order by s.created desc '.$limit);
	}

	
	function get_stories_movil($limit, $exc, $pos){
		
		if($pos!=0)
			$pos=' and s.position='.$pos;
		else
			$pos=''; 
			
		
		
		return $this->db->query('Select s.id, s.title, s.subtitle, UNIX_TIMESTAMP(s.modified) as datem, i.thumbh120,i.thumbh80, i.thumbh50 
						  		 From stories as s, images as i
					      		 Where invisible=0 and programed is null and s.image_id=i.id and  s.position!=10 and s.id!='.$exc.$pos.'
					      		 Order by s.created desc LIMIT '.$limit);
	}
	
	function get_complete_movil($id){
    	return $this->db->query('Select s.title, s.subtitle, s.lead, UNIX_TIMESTAMP(s.modified) as datem, i.thumbh50,  i.thumbh80, s.body
    							 From stories as s, images as i
    							 where s.id='.$id.' and s.image_id=i.id and  s.position!=10');
	}
	
	function get_stories_movil_section($section,$limit){
		return $this->db->query('Select s.id, s.title, s.subtitle, UNIX_TIMESTAMP(s.modified) as datem, i.thumbh120,i.thumbh80, i.thumbh50 
								 From stories as s, images as i, categories AS c, sections AS e
								 Where invisible=0 and programed is null and s.image_id=i.id and e.id ='.$section.' and e.category_id = c.id and c.id = s.category_id and  s.position!=10 
								 Order by s.created desc LIMIT '.$limit);
	}
	
	
	function get_more_news($section,$indice_paginacion,$numero_noticias) { //TODO  10		
		$this->load->model('section');
		$sec=$this->section->get($section);		
		if(!is_null($sec->category_id))
			$this->db->where('category_id',$sec->category_id);
			
		$this->db->select('s.id, s.title, s.subtitle,s.reads,s.modified,i.thumbh50 as thumb');
		$this->db->from('stories s,images i');
		$this->db->where('s.image_id','i.id',FALSE);		
		$this->db->where('s.position !=',10);
		$this->db->order_by('s.created','desc');
		( $indice_paginacion ) ? $this->db->limit($numero_noticias, $indice_paginacion ) : $this->db->limit( $numero_noticias );
		$aux=$this->db->get();			
		$ult=$aux->last_row();		
		$config['base_url']=base_url().'/'.$this->name.'/more/'.$section;
		//$config['total_rows']=$this->db->count_all_results($this->name);
		$sec->category_id = ( !is_null($sec->category_id) ) ? $sec->category_id : 29;
		$config['total_rows'] = count($this->db->get_where('stories',array('category_id' => $sec->category_id))->result());		
		$config['per_page'] =$numero_noticias;
		$config['uri_segment'] = 4;
		$config['num_links'] = 6;
		$config['first_link'] = '';
		$config['last_link'] = '';
		$config['next_link'] = 'Siguiente';
		$config['prev_link'] = 'Anterior';
		$this->pagination->initialize($config);		
		return $aux->result();
	}
	
	function get_rotativas($num=5){
		$this->db->select('id');
		$this->db->from($this->name);
		$this->db->where('position',1);
		$this->db->order_by('created','desc');
		$this->db->limit($num);
		
		return $this->db->get()->result();
	}
	
	function rotativa($sec=0,$num=5,$pag=0){
	
		$pag=$pag*5;
		$from='';
		if($sec!=0){
			$sec=' AND sc.id ='.$sec.' AND sc.category_id = s.category_id ';
			$from=', sections AS sc';
		}
		else
			$sec='';
		$query=$this->db->query('SELECT s. * , i.thumbh50, i.thumb500,i.thumb300,i.thumb400
								 FROM stories AS s, images AS i'.$from.'
								 WHERE s.image_id = i.id AND s.position<10 
								   '.$sec.'
								 ORDER BY s.created DESC
						  		 LIMIT '.$pag.','.$num);
		
		return $query->result();
	}
	
	function set_read($id){
		$this->db->where('s.story_id',$id);
		$this->db->set('s.reads', 's.reads+1', FALSE);
		$this->db->update('stories_stats s');
	}
	
	function set_send($id){
		$this->db->where('s.story_id',$id);
		$this->db->set('s.sends', 's.sends+1', FALSE);
		$this->db->update('stories_stats s');
	}
	
	function is_position($position,$id){
		$noticia=current($this->get($id));
		if($noticia->position==$position)
			return true;
		return false;	
	}
	
}
?>
