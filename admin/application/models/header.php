<?php
class Header extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='headers';
    }
    
    function get($id){
    	$this->db->where('id',$id);
    	$aux=$this->db->get($this->name)->result();
    	return current($aux);
    }
    
 	function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc");
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Encabezado...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
}
?>