<?php
class Section extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='sections';
	}  

    function get($id){
    	$this->db->where('id',$id);
    	$aux=current($this->db->get($this->name)->result());
		$aux->survey_id=$this->get_survey($id);
    	//Extraigo el padre para ver si tiene datos que heredar
    	if(isset($aux->section_id)){
			if(!is_null($aux->section_id)){
	    		$parent=$this->get($aux->section_id);

		    	//Compruebo los datos heredados
		    	if(is_null($aux->team_id))
		    		$aux->team_id=$parent->team_id;
		    	if(is_null($aux->championship_id))
		    		$aux->championship_id=$parent->championship_id;
		    	if(is_null($aux->category_id))
		    		$aux->category_id=$parent->category_id;
		    		
		    	if($aux->survey_id==false)
		    		$aux->survey_id=$parent->survey_id;
	    	}
    	}
    		
    	return $aux;
    }
    
    function get_name($id){
    	$this->db->select('name,header_id');
    	$this->db->where('id',$id);
    	$aux=current($this->db->get($this->name)->result());
    	return $aux;
    }
    
    function get_by_name($name){
    	$this->db->where('name',$name);
    	$aux=$this->db->get($this->name)->result();
		return current($aux);
    }
    
    function get_all(){	
		$this->db->select('s . * , c.name AS cname, h.name AS hname, t.name AS tname, ch.name AS chname,sp.name as parent');
		$this->db->from('sections AS s');
		$this->db->join('sections AS sp', 'sp.id = s.section_id', 'left');
		$this->db->join('categories AS c', 'c.id = s.category_id', 'left');
		$this->db->join('headers AS h', 'h.id = s.header_id', 'left');
		$this->db->join('teams AS t', 't.id = s.team_id', 'left');
		$this->db->join('championships AS ch', 'ch.id = s.championship_id', 'left');
		$this->db->order_by('s.priority','desc');

		return $this->db->get();
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
    
    function get_list($id=""){
    	if(!empty($id))
    		$this->db->where('id !=',$id);
    		
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc"); 
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione una Seccion...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_tag_list($id){
    	$this->db->where('section_id',$id);
    	$data=$this->db->get('sections_tags')->result();
    	return $data;
    }
    
    function get_tag_string($id){
    	$this->db->select('distinct(t.id),t.name');
    	$this->db->from('tags as t, sections_tags as st, sections as s');
    	$this->db->where('s.id',$id);
    	$this->db->where('s.id','st.section_id',FALSE);
    	$this->db->where('st.tag_id','t.id',FALSE);
    	$this->db->order_by('t.name','asc');
		$qtags=$this->db->get();
    	
    	$tags="";
		foreach($qtags->result() as $row):
			$tags=$tags.';'.$row->name;
		endforeach;
    	
    	return $tags.";";
    }
    
    function get_survey($section){
    	$this->db->where('section_id',$section);
		$this->db->order_by('id','desc');
		$this->db->limit(1);
		$survey=current($this->db->get('sections_surveys')->result());
		if($survey!=false)
			return $survey->survey_id;
		else
			return false;
    }
    
	function get_actual(){
		$sect=$this->session->userdata('section');
		if($sect==""){
			$this->session->set_userdata('section', SECTION_PRIN);
			$sect=SECTION_PRIN;
		}
		return $sect;
	}
	
	function exist($id){
		$num= $this->db->get_where($this->name, array('id' => $id))->num_rows();
		if($num>0)
			return TRUE;
	
		return FALSE;	
	}
	
	function list_rss(){
		$this->db->where('rss',1);
		$this->db->order_by("priority", "desc");
		return $this->db->get($this->name)->result();
	}
	
	function get_teams(){
		$this->db->select('id,team_id');
		$this->db->where('team_id >',0);
		$aux=$this->db->get($this->name);
		
		$res=array();
		foreach($aux->result() as $row){
			$res[$row->team_id]=$row->id;
		}
		
		return $res;
	}
	
	function get_teams_by_champ($champ){
		
		
	}
	
	function get_champ($id){
		$this->db->where('id',$id);
    	$aux=current($this->db->get($this->name)->result());
    		
    	return $aux->championship_id;
		
	}
	
}
?>