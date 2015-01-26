<?php
class Country extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='countries';
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
		$this->pagination->initialize($config);
		$this->db->order_by("created", "desc");
		return $this->db->get($this->name,$config['per_page'], $page);
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
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Pais...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=substr($row->name,0,30);
    	}
    	return $aux;
    }
    
	function get_list_name(){
    	$this->db->select('name');
    	$this->db->order_by("name", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Pais...";
    	foreach($data->result() as $row){
    		$aux[$row->name]=substr($row->name,0,30);
    	}
    	return $aux;
    }
}
?>