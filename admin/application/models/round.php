<?php
class Round extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='rounds';
	}  

    function get($id){
    	$this->db->where('id',$id);
    	$aux=$this->db->get($this->name)->result();
		return current($aux);
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE*2;
		$config['num_links'] = 10;
		$this->pagination->initialize($config);
		$this->db->order_by("name", "asc"); 
		return $this->db->get($this->name,$config['per_page'], $page);
    }
    
    function delete($id){
    	$item=$this->get($id);
    	$this->reorder_priorities($item->priority,$item->championship_id);
    	$this->db->delete('rounds',array('id'=>$id));
    	return $item;
    }
    
    function reorder_priorities($priority,$championship){
    	$this->db->where('priority >',$priority);
    	$this->db->where('championship_id',$championship);
    	$this->db->set('priority', 'priority-1', FALSE);
    	$this->db->update('rounds');
    }
    
    function get_by_championship($championship){
    	$this->db->where('championship_id',$championship);
		$this->db->order_by('priority','asc');
    	$aux=$this->db->get('rounds')->result();
    	
    	return $aux;
    }
    
    function get_last_priority($championship){
    	$this->db->where('championship_id',$championship);
		$this->db->limit('1');
		$this->db->order_by('priority','desc');
		$last_priority=current($this->db->get('rounds')->result());
		
		if($last_priority!=FALSE)
			$last_priority=$last_priority->priority;
		else
			$last_priority=-1;
			
		return $last_priority;
    }
    
	function get_first($championship){
    	$this->db->where('championship_id',$championship);
		$this->db->limit('1');
		$this->db->order_by('priority','asc');
		$first=current($this->db->get('rounds')->result());

		return $first;
    }

	function get_next($championship,$round){
		$this->db->where('championship_id',$championship);
		$this->db->where('priority >',$round->priority);
		$this->db->limit('1');
		$this->db->order_by('priority','asc');
		$next=$this->db->get('rounds')->result();

		return $next;
		
	}
}
?>