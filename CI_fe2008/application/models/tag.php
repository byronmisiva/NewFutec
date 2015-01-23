<?php
class Tag extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='tags';
	}  
	
	function get_all(){
		$this->db->order_by('sum','desc');
		return $this->db->get($this->name);
	}
	
	function get_random(){
		return $this->db->query('SELECT * 
						  		 FROM tags 
						  		 ORDER BY RAND()
						  		 LIMIT 30');
	}
	
	function get_max(){
		$max=$this->db->query('SELECT MAX(sum) as max
							   FROM tags')->result();
		return $max[0]->max;
	}
	
	function get_min(){
		$min=$this->db->query('SELECT MIN(sum) as min
							   FROM tags')->result();
		return $min[0]->min;
	}
	
    function insert_tag($tags)
    {
    	$this->load->helper('string');
		$tags=reduce_multiples($tags, ";", TRUE);
		
		$tag=preg_split('/;/',$tags);
		$tags=array();
    	foreach($tag as $row)
    	{
    		$res=$this->db->query("Select * From tags Where name='".trim($row)."'");
    		if($res->num_rows()==0)
    		{
    			$itag = array('id' => 0,'name' => trim($row),'sum' => 0);
				$this->db->insert($this->name, $itag);
				$itag['id']=$this->db->insert_id();
    		}
    		else
    			$itag=current($res->result_array());
    		
    		$tags[$itag['id']]['id']=$itag['id'];
			$tags[$itag['id']]['name']=$itag['name'];
			$tags[$itag['id']]['sum']=$itag['sum'];
    	}
    	return $tags;
    }
    
    function insert_story_tag($tag, $story_id)
    {
    	$data['id']=0;
    	$data['story_id']=$story_id;
    	foreach($tag as $row):
    		$data['tag_id']=$row['id'];
    		$this->db->insert('stories_tags', $data);
    	endforeach;
    }
    
	function insert_section_tag($tag, $section)
	{
    	$data['id']=0;
    	$data['section_id']=$section;
    		
    	foreach($tag as $row):
    		$data['tag_id']=$row['id'];
    		$this->db->insert('sections_tags', $data);
    	endforeach;
    }
    
    function update_story_tag($tag, $story_id)
    {
    	$data['story_id']=$story_id;
    	
    	$this->db->select('tag_id');
    	$this->db->where('story_id',$story_id);
    	$tags=$this->db->get('stories_tags')->result_array();
    		
    	foreach($tag as $row){
    		$aux=array_search(array('tag_id'=>$row['id']),$tags);
    		if($aux===FALSE){
    			$data['tag_id']=$row['id'];
    			$this->db->insert('stories_tags', $data);
    		}
    		unset($tags[$aux]);
    	}
    	
    	foreach($tags as $tag)
    		$this->db->delete('stories_tags', array('tag_id' => $tag['tag_id'],'story_id' => $story_id)); 
    }
    
    function update_section_tag($tag, $section)
    {   	
    	$data['section_id']=$section;
    	
    	$this->db->select('tag_id');
    	$this->db->where('section_id',$section);
    	$tags=$this->db->get('sections_tags')->result_array();

    	foreach($tag as $row){
    		$aux=array_search(array('tag_id'=>$row['id']),$tags);
    		if($aux===FALSE){
    			$data['tag_id']=$row['id'];
    			$this->db->insert('sections_tags', $data);
    		}
    		unset($tags[$aux]);
    	}
    	
    	foreach($tags as $tag)
    		$this->db->delete('sections_tags', array('tag_id' => $tag['tag_id'],'section_id' => $section)); 
    }
    
    function get_story_tags($story_id)
    {
    	$this->db->select('t.id,t.name');
    	$this->db->from('tags t');
		$this->db->join('stories_tags st', 't.id = st.tag_id');
		$this->db->where('st.story_id',$story_id);
		$this->db->order_by('t.name','asc');
    	$qtags=$this->db->get();
    	
		$tags='';
		foreach($qtags->result() as $row)
			$tags.=$row->name.'; ';

    	return $tags;
    }
    
	function search($text)
	{
		$this->db->like('name',$text);
		$this->db->order_by('sum','desc');
		
		return $this->db->get($this->name);		
	}
}
?>