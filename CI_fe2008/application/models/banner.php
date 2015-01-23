<?php
class Banner extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='banners';
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
    	$aux['']="Seleccione un Banner...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function has_banner($id){
    	$banner_id=0;
    	$this->db->select('id');
    	$this->db->where('module_id', $id);
    	$data=current($this->db->get($this->name)->result());
    	if(isset($data->id))
    		return $data->id;
    	else
    		return FALSE;
    }
}
?>