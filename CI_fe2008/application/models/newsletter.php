<?php
class Newsletter extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='newsletters';
	}  
	
    function get_news($like){
    	$query=$this->db->query('Select s.*
    							 From (Select *
    							 	   From stories 
    							 	   WHERE title LIKE "%'.$like.'%" 
    							 	   ORDER BY modified desc
    							 	   LIMIT 100) as s
    							 ORDER BY s.title asc');
    	
    	$output='<ul><li>No Existen Resultados</li></ul>';
    	if($query->num_rows()>0){
    		$output='<ul>';
    		foreach($query->result() as $row){
    			$output.='<li id='.$row->id.'><strong>'.$row->title.'</strong></li>';
    		}
    		$output.='</ul>';
    	}
    	return $output;
    }
    
    function get_newsletter($newsletter){
    	$query=$this->db->query('Select ns.id, s.title, s.created 
    					  		 From newsletters as n, stories as s, newsletters_stories as ns
    					  		 Where n.id='.$newsletter.' AND n.id=ns.newsletter_id AND ns.story_id=s.id');
    	return $query; 
    }
    
    function getLastOrder($newsletter){
    	$this->db->select('position');
    	$this->db->where('newsletter_id',$newsletter);
    	$this->db->order_by('position','desc');
    	$this->db->limit(1);
    	$result=current($this->db->get('newsletters_stories')->result());
    	if(isset($result->position))
    		return $result->position+1;
    	else
    		return 0;
    	
    }
    
    function getStory($id){
    	$this->db->where('id',$id);
    	$result=$this->db->get('newsletters_stories')->result();
    	return current($result);
    }
    
    function getStorybyOrder($order,$newsletter){
    	$this->db->where('position',$order);
    	$this->db->where('newsletter_id',$newsletter);
    	$result=$this->db->get('newsletters_stories')->result();
    	return current($result);
    }
    
    function updateStoryOrder($id,$order){
    	$this->db->where('id',$id);
    	$this->db->set('position',$order);
    	return $this->db->update('newsletters_stories');
    }
    
    function addOrder($newsletter,$inicio=0){
    	$this->db->where('newsletter_id',$newsletter);
    	$this->db->where('position >',$inicio);
    	$this->db->set('position','position + 1',FALSE);
    	return $this->db->update('newsletters_stories');
    }
    
    function lessOrder($newsletter,$inicio=0){
    	$this->db->where('newsletter_id',$newsletter);
    	$this->db->where('position >',$inicio);
    	$this->db->set('position','position - 1',FALSE);
    	return $this->db->update('newsletters_stories');
    }
    
}
?>