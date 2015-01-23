<?php
class Statistic_match extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->model('match_calendary');
        
    	$this->name='statistics_matches';
	}  

    function get($id){
    	$this->db->where('id',$id);
    	$aux=$this->db->get($this->name)->result();
		return current($aux);
    }
    
    function get_random($num=1,$championship=20){
    	$aux=$this->match_calendary->matches_last_next($championship,true);
    	$matches=array();
    	foreach($aux as $row)
    		$matches[]=$row->id;
    	$this->db->where_in('match_id',$matches);
    	$this->db->order_by('id','random');
    	$this->db->limit($num);
    	$aux=$this->db->get($this->name)->result();
    	return $aux;
    }
    
    function get_all($match=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$this->db->order_by("match_id", "desc"); 
		return $this->db->get($this->name);
    }
    
    function insert($data){
    	$this->db->insert($this->name,$data);
    }
    
    function update($data,$id){
    	$this->db->where('id',$id);
    	$this->db->update($this->name,$data);
    }
    
    function delete($id){
    	$match=$this->get($id);
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return $match;
    }
    
    function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione una Categoria...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
}
?>