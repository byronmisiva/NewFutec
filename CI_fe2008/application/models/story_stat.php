<?php
class Story_stat extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
    	$this->name='stories_stats';
	}  

    function insert_story_stat($id){
    	$data['story_id']=$id;
    	$data['rate']=0;
    	$data['reads']=0;
    	$data['sends']=0;
    	$data['votes']=0;
    	$this->db->insert($this->name,$data);    	
    }
    
    function get_story_stat($story){
    	$this->db->where('story_id',$story);
    	$aux=current($this->db->get($this->name)->result());

    	return $aux;
    }
    
    function set_read($story){
    	
    	$this->db->where('s.story_id',$id);
		$this->db->set('s.reads', 's.reads+1', FALSE);
		$this->db->update('stories_stats s');
    	
    }
}
?>