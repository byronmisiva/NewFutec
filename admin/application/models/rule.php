<?php
class Rule extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='rules';
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
		$this->db->order_by("order", "asc"); 
		return $this->db->get($this->name,$config['per_page'], $page);
    }
    
    function insert($data){
    	$data['order']=$this->get_max_priority()+1;
    	$this->db->insert($this->name,$data);
    }
    
    function update($data){
    	$this->db->where( 'id',$data['id']);
        $this->db->update($this->name, $data); 
    }
    
    function delete($id){
    	//Extraigo el orden de la regla que voy a borrar
    	$this->db->select('order');
		$row=$this->db->get_where($this->name,array('id'=>$id));
    	$actual=current($row->result())->order;
    	
    	//Borro lo regla
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		
        //Subo el orden de todas las que estaban bajo la regla borrada
        $this->db->query("update rules r set r.order=r.order-1 where r.order>$actual");
        return true;
    }
    
    function get_list(){
    	$this->db->select('id, name');
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Rol...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_max_priority(){
    	$this->db->order_by("order", "desc");
    	$this->db->limit(1);
    	$aux=$this->db->get($this->name)->result();
    	return current($aux)->order;
    }
    
	function get_min_priority(){
    	$this->db->order_by("order", "asc");
    	$this->db->limit(1);
    	$aux=$this->db->get($this->name)->result();
    	return current($aux)->order;
    }
    
    function change_priority($id,$type){
    
    	$max=$this->get_max_priority();
    	$min=$this->get_min_priority();
    	$this->db->select('order');
		$row=$this->db->get_where($this->name,array('id'=>$id));
		$actual=current($row->result())->order;
		
		if($type=='up'){
			switch(TRUE){
				case ($actual==$min):
					$next=$max+1;
					break;
					
				case ($actual>$min):
					$next=$actual-1;
					$this->db->query("update rules r set r.order=r.order+1 where r.order=$next");
					break;
			}
			$this->db->query("update rules r set r.order=$next where id=$id");
		}
		else{
			switch(TRUE){
				case ($actual==$max):
					$next=$min-1;
					break;
					
				case ($actual<$max):
					$next=$actual+1;
					$this->db->query("update rules r set r.order=r.order-1 where r.order=$next");
					break;
			}
			$this->db->query("update rules r set r.order=$next where id=$id");
		}
    }
    
    function get_by_role($role){
    	
    	$this->db->where('role_id',$role);
    	$this->db->order_by('name','asc');
    	
    	$aux=$this->db->get($this->name);
    	return $aux;
    }
}
?>