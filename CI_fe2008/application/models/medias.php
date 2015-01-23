<?php
class Medias extends CI_Model {
	
	var $name;
	var $types;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='media';
		$this->types=array(1=>'podcast',2=>'video');
	}  

    function get($id){
    	$this->db->where('id',$id);
    	$aux=$this->db->get($this->name)->result();
		return current($aux);
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$config['num_links'] = 10;
		
		$this->pagination->initialize($config);
		$this->db->order_by("created", "desc");
		$this->db->order_by("name", "asc");
		return $this->db->get($this->name,$config['per_page'], $page);
    }
    
	function get_all_letter($letter){
		$this->db->like('name', $letter, 'after'); 
		$this->db->order_by("name", "asc");
		return $this->db->get($this->name)->result();
    }
    
    function insert($data){
    	
    }
    
    function update($data){
    	
    }
    
    function delete($id){
    	$aux=$this->get($id);
    	$data=array('640','400','300','150','100','h160','h120','h80','h50');
    	foreach($data as $tam){
    		eval("\$imagen=\$aux->thumb".$tam.";");
    		if($imagen!='')
    			unlink($imagen);
    	}

    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return true;
    }
    
    function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione una Imagen...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_media($type,$num=50){
    	$type=array_search($type,$this->types);
    	if($type!=FALSE){
	    	$this->db->where('type',$type);
	    	$this->db->order_by('created','desc');
	    	$this->db->order_by('name','asc');
	    	$this->db->limit($num);
	    	return $this->db->get($this->name)->result();
    	}    
    	else
    		return $type;
   	}
   	
	function get_media_section($type,$section,$num){
    	//$type=array_search($type,$this->types);
    	//$type=$this->types[$type];
		if($num==FALSE){
    		$num=50;
    	}
    	//if($type!=FALSE){
    		return $this->db->query('Select m.*
    						  		 From sections as s, media_sections as ms, media as m
    						  		 Where s.id='.$section.' and s.id=ms.section_id and ms.media_id=m.id
    						  		 Order by created desc, name asc
    						  		 Limit '.$num)->result();
    	/*}    
    	else
    		return $type;*/
   	}
   	
	function insert_tag($tags,$id){
    	if(substr($tags,0,1)==';')
    		$tags=substr($tags,1);
    	if(substr($tags,strlen($tags)-1,1)==';')
			$tags=substr($tags,0,strlen($tags)-1);
		$tag=preg_split('/;/',$tags);
		$i=-1;
		
    	foreach($tag as $row):
    		$i+=1;
    		$q=$this->db->query("Select id
    							 From sections
    							 Where name='".$tag[$i]."'")->row();

    		
    		$data['id']=0; 
			$data['media_id']=$id;
			$data['section_id']=$q->id;
    		$this->db->insert('media_sections', $data);
    		//var_dump($this->db->last_query());
    	endforeach;
    }
   	
   	
   	
}
?>