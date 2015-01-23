<?php
class Module_Section extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='modules_sections';
	}  

    function get($id){
    	$this->db->where('id',$id);
    	$aux=$this->db->get($this->name)->result();
		return current($aux);
    }
    
    
    function get_all($section=""){
		
		$this->db->select('ms.id as msid, ms.module_id as msmodule_id, ms.section_id mssection_id, ms.position msposition, ms.block as block,s.name as name,m.title as mtitle');
		$this->db->from('sections s, modules m, modules_sections ms');
		$this->db->where('s.id','ms.section_id', FALSE);
		$this->db->where('m.id','ms.module_id', FALSE);
		$this->db->where('s.id',$section);
		$this->db->order_by("block", "asc");
		$this->db->order_by("msposition","asc");
		return $this->db->get();
    }
      
    
    function delete($id){
    	$this->db->where( 'id', $id);
        $this->db->delete($this->name); 
		return true;
    }
    
    
    function get_modules_block($section,$block){
    	$this->db->select('m.*,ms.*');
		$this->db->from('sections s, modules m, modules_sections ms');
		$this->db->where('s.id','ms.section_id', FALSE);
		$this->db->where('m.id','ms.module_id', FALSE);
		$this->db->where('s.id',$section);
		$this->db->where('ms.block',$block);
		$this->db->order_by("ms.position","asc");
		return $this->db->get()->result();
    }
    
 	
    function get_modules($section){
 		$sections[]=$section;
 		
 		//Verifico si tiene una seccion padre y la aumento si es el caso
 		$sect=current($this->db->get_where('sections',array('id' => $section))->result());
 		if(!is_null($sect->section_id))
 			$sections[]=$sect->section_id;
 	
    	$this->db->select('m.*,ms.*');
		$this->db->from('sections s, modules m, modules_sections ms');
		$this->db->where('s.id','ms.section_id', FALSE);
		$this->db->where('m.id','ms.module_id', FALSE);
		$this->db->where_in('s.id',$sections);
		$this->db->order_by("ms.block","asc");
		$this->db->order_by("ms.section_id","desc");
		$this->db->order_by("ms.position","asc");
		
		$aux=$this->db->get()->result();
		//echo $this->db->last_query();
		return $aux;
    }

	
    function position_up($id){
		$original=$this->get($id);
		
		$this->db->where('section_id',$original->section_id);
		$this->db->where('block',$original->block);
		$this->db->where('position <',$original->position);
		$this->db->order_by('position','desc');
		$this->db->limit(1);
		$before=current($this->db->get($this->name)->result());

		if($before===FALSE){
			$max=$this->get_max_priority($original->section_id,$original->block);
			$this->db->update($this->name,array('position'=>$max+1), array('id' => $original->id));
		}
		else{
			$this->db->update($this->name,array('position'=>$before->position), array('id' => $original->id));
			$this->db->update($this->name,array('position'=>$original->position), array('id' => $before->id));
		}
	}
	
	
    function position_down($id){
		$original=$this->get($id);
		
		$this->db->where('section_id',$original->section_id);
		$this->db->where('block',$original->block);
		$this->db->where('position >',$original->position);
		$this->db->order_by('position','asc');
		$this->db->limit(1);
		$before=current($this->db->get($this->name)->result());

		if($before===FALSE){
			$min=$this->get_min_priority($original->section_id,$original->block);
			$this->db->update($this->name,array('position'=>$min-1), array('id' => $original->id));
		}
		else{
			$this->db->update($this->name,array('position'=>$before->position), array('id' => $original->id));
			$this->db->update($this->name,array('position'=>$original->position), array('id' => $before->id));
		}
		
	}
	
	
	function get_max_priority($section,$block){
		$this->db->select('position');
		$this->db->where('section_id',$section);
		$this->db->where('block',$block);
		$this->db->order_by('position','desc');
		$this->db->limit(1);
		$aux=current($this->db->get($this->name)->result());
		return $aux->position;
	}
	
	
	function get_min_priority($section,$block){
		$this->db->select('position');
		$this->db->where('section_id',$section);
		$this->db->where('block',$block);
		$this->db->order_by('position','asc');
		$this->db->limit(1);
		$aux=current($this->db->get($this->name)->result());
		return $aux->position;
	}
}
?>