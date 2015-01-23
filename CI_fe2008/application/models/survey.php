<?php
class Survey extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='surveys';
	}    

    function get($id){
    	$this->db->where( 'id',$id);
		return current($this->db->get($this->name)->result());
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$config['num_links'] = 10;
		$this->pagination->initialize($config);
		$this->db->select('*,UNIX_TIMESTAMP(created) as ucreated');
		$this->db->order_by("created", "desc"); 
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
    	$this->db->order_by("created", "desc");
    	$this->db->order_by("title", "asc");
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione una Encuesta...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->title;
    	}
    	return $aux;
    }
    
    
    function get_complete($survey){
    	$survey=$this->get($survey);
    	if($survey !== false){
	    	$this->db->where('survey_id',$survey->id);
	    	$options=$this->db->get('options');
	    	
	    	$data['survey']=$survey;
	    	$data['options']=$options->result();
	    	return $data;
    	}
    	else
    		return false;
    }
    
    function vote($survey,$option){
    	$last_vote = $this->session->userdata('last_vote');
    	
    	$limit_vote=time()-(12*60*60); //12 horas antes
    	if($last_vote==false or $last_vote<=$limit_vote){
	    	$this->db->where('survey_id',$survey);
	    	$this->db->where('id',$option);
	    	$this->db->set('votes', 'votes+1', FALSE);
	    	$this->db->update('options');
	    	
	    	$this->db->where('id',$survey);
	    	$this->db->set('votes', 'votes+1', FALSE);
	    	$this->db->update($this->name);
	    	
	    	$this->session->set_userdata('last_vote',time());
    	}
    }
    
    function get_results($survey){
    	$data=$this->get_complete($survey);
    	$total=$data['survey']->votes;
    	
    	foreach($data['options'] as $key=>$row){
    		if($row->votes>0)
    			$val=round($row->votes/$total,4);
    		else
    			$val=0;
    		$data['options'][$key]->porcent=$val;
    	}
		
		return $data;
    }
    
    function active_survey(){
    	return $this->db->query('SELECT ss.id, eid, uid, e.name, u.title, Datediff( NOW( ) , ss.date_start ) as days, u.votes, UNIX_TIMESTAMP(u.created) as created
						  		 FROM ( SELECT MAX( id ) AS id, section_id AS eid, survey_id AS uid, date_start
										FROM (SELECT *
											  FROM sections_surveys
											  ORDER BY id DESC) AS eu
											  GROUP BY section_id ) AS ss
									    LEFT JOIN sections AS e ON e.id = ss.eid
									    LEFT JOIN surveys AS u ON u.id = ss.uid');	
    }
    
    
    function get_last($num){
    	$this->db->select('*,UNIX_TIMESTAMP(created) as tcreated');
    	$this->db->order_by('created','des');
    	$this->db->limit($num);
    	
    	$aux=$this->db->get($this->name);
    	
    	return $aux->result();
    }

}
?>