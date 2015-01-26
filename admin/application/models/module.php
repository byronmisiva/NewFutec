<?php
class Module extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='modules';
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
		$this->db->order_by("title", "asc");
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
    	$this->db->select('id, title');
    	$this->db->order_by("title", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Modulo...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->title;
    	}
    	return $aux;
    }
    
    function get_banner_movil(){
    	$query=$this->db->query('Select b.file, b.link, b.code
    					   		 From modules as m, banners as b
    					   		 Where m.id=61 and m.id=b.module_id
    					   		 Order by b.id desc');
    	if($query->num_rows()>0){
	    	$row=$query->row();
	    	if($row->code!='')
	    		return '<script>'.$row->code.'</script>';
	    	else{
		    	if($row->file=='')
		    		return $row->link;
		    	else
	    			return $row->file;
	    	}
    	}
    	else
    		return '';
    }
}
?>