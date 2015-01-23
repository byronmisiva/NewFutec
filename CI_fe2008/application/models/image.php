<?php
class Image extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='images';
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
	
    function get_list_url($thumb){
    	$this->db->select('id,name,'.$thumb.' as thumb');
    	$this->db->order_by("name", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione una Imagen...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->thumb;
    	}
    	return $aux;
    }
    
    function get_no_thumb(){
    	return $this->db->query('Select *
    					  	     From images
    					  	     Where thumbh50=""
    							 Order by name asc ')->result(); 
    }
    
    function get_not_used(){
    	$res=$this->db->query('	SELECT *
									FROM images
									WHERE created < (NOW() - INTERVAL 1 YEAR) and id not in (
    									SELECT distinct image_id
										FROM fe2008.stories
										WHERE created > (NOW() - INTERVAL 1 YEAR) and image_id IS NOT NULL order by created desc)')->result();
    	
    	return $res;
    }
  
}
?>