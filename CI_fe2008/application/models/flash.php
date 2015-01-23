<?php
class Flash extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->name='flashes';
	}    

    function get($id){
    	$this->db->where( 'id',$id);
		return $this->db->get('flashes');
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/flashes/index';
		$config['total_rows']=$this->db->count_all_results('flashes');
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->select('*');
	    $this->db->from('flashes');
	    $this->db->order_by('date','desc');
	    $this->db->limit($config['per_page'], $page);
		return $this->db->get();
    }
    
    function get_last($hours=2){
    	$this->db->select('*,UNIX_TIMESTAMP(date) as utime');
    	$this->db->where('date >=',"SUBTIME(NOW(),'$hours:0')",FALSE);
    	$aux=$this->db->get($this->name);
    	
    	$line="";
    	foreach($aux->result() as $row){
    		$line.="<span style='font-weight: bold; font-style:italic;padding-right: 5px;'>".mdate('%H:%i ',$row->utime)."</span>".strip_tags($row->text);
    	}
    	
    	return $line;
    }
    
    function insert($data){
    	$this->db->insert('flashes', $data);
    }
    
    function update($data){
    	$this->db->where( 'id',$data['id']);
   		$this->db->update('flashes', $data);
    }
    
    function delete($id){
    	$this->db->where( 'id', $id);
        $this->db->delete('flashes'); 
		return true;
    }
    
    function get_num($num){
    	return $this->db->query('Select * 
    					  From flashes
    					  Order by date desc
    					  Limit 0,'.$num);
    }
    
    function get_today($num){
    	
    	$past_days=1;
    	$yesterday=date('Y-m-d',mktime(0, 0, 0,date("m"),date("d")-$past_days,date("Y")));
    	
    	$this->db->where('date >',$yesterday);
    	$this->db->order_by('date','desc');
    	$this->db->limit($num);
    	$aux=$this->db->get($this->name);
    	
    	return $aux;
    	
    }
}
?>