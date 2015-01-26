<?php
class Championship extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->load->library('pagination');
    	$this->name='championships';
	}    

    function get($id){
    	$this->db->where('id',$id);
		return $this->db->get($this->name);
    }
    
    function get_rounds_championship($id){
    	$this->db->where('championship_id',$id);
    	$this->db->order_by('priority','asc');
    	$aux=$this->db->get('rounds');
    	return $aux;
    }
    
    function get_all($page=0){
    	$config['base_url']=base_url().'/'.$this->name.'/index';
		$config['total_rows']=$this->db->count_all_results($this->name);
		$config['per_page']=RESULT_PAGE;
		$this->pagination->initialize($config);
		$this->db->select('c.*,r.name as rname');
	    $this->db->from($this->name.' c');
	    $this->db->join('rounds r', 'r.id = c.active_round', 'left');
	    $this->db->order_by('c.year','desc');
	    $this->db->order_by('c.name','asc');
	    $this->db->limit($config['per_page'], $page);
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
    
    function get_list(){
    	$this->db->select('id, name');
    	$this->db->order_by("name", "asc");
    	$data=$this->db->get($this->name);
    	$aux['']="Seleccione un Campeonato...";
    	foreach($data->result() as $row){
    		$aux[$row->id]=$row->name;
    	}
    	return $aux;
    }
    
    function get_active_round($id){
    	$this->db->select('active_round as round');
    	$this->db->where('id',$id);
    	$data=current($this->db->get($this->name)->result());
    	if($data->round==0){
    		$this->db->select('id as round');
    		$this->db->where('championship_id',$id);
    		$this->db->order_by('priority','desc');
    		$data=current($this->db->get('rounds')->result());
    	}
    	if(isset($data->round))
    		return $data->round;
    	else
    		return false;
    }
    
    function get_match_week($id){
    	$round=$this->get_active_round($id);
    	
    	$fecha=$this->weekStartEnd(mdate("%Y-%m-%d",time()));
		$query=$this->db->query('SELECT mh . * , ma.aid, ma.aname,ma.athumb, c.id as champ, c.name
						          FROM   (SELECT m . * , t.id hid, t.name AS hname,t.mini_shield as hthumb  
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_home = t.id) AS mh, 
						                 (SELECT m . * , t.id aid, t.name AS aname,t.mini_shield  as athumb 
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_away = t.id ) AS ma,
						                  championships as c, rounds as r, groups as g
						          WHERE mh.id = ma.id AND mh.date_match >"'.mdate("%Y-%m-%d %h:%i:%s",time()).'" 
						          AND mh.date_match < "'.$fecha['end'].' 23:59:59" AND mh.group_id = g.id AND g.round_id = r.id 
						          AND r.championship_id=c.id AND c.id='.$id.' 
						          ORDER BY c.name, mh.date_match ASC');
		return $query->result();
    }
    
    function played_matches($id) // Todo partido jugado sta semana
	{
		$fecha=$this->weekStartEnd(mdate("%Y-%m-%d",time()));
		$query=$this->db->query('SELECT mh . * , ma.aid, ma.aname,ma.athumb, c.id as champ, c.name,LEFT(mh.result,2) as hresult,RIGHT(mh.result,2) as aresult
						          FROM   (SELECT m . * , t.id hid, t.name AS hname,t.mini_shield as hthumb 
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_home = t.id) AS mh, 
						                 (SELECT m . * , t.id aid, t.name AS aname,t.mini_shield  as athumb
						                  FROM matches AS m, matches_teams AS mt, teams AS t
						                  WHERE mt.match_id = m.id AND mt.team_id_away = t.id ) AS ma,
						                  championships as c, rounds as r, groups as g
						          WHERE mh.id = ma.id AND mh.date_match <"'.mdate("%Y-%m-%d %h:%i:%s",time()).'" 
						          AND mh.date_match > "'.$fecha['start'].' 00:00:00" AND mh.group_id = g.id AND g.round_id = r.id 
						          AND r.championship_id=c.id AND c.id='.$id.' 
						          ORDER BY c.name, mh.date_match ASC');
		return $query->result();
	}
	
    
	function weekStartEnd($date){
		$dateArr=explode("-",$date);
		$dayInWeekNo=date("N", mktime(0, 0, 0, $dateArr[1],$dateArr[2],$dateArr[0]));
           
		$weekStartEndPosition=array(
		1=>array("start"=>0,"end"=>6),
		2=>array("start"=>-1,"end"=>5),
		3=>array("start"=>-2,"end"=>4),
		4=>array("start"=>-3,"end"=>3),
		5=>array("start"=>-4,"end"=>2),
		6=>array("start"=>-5,"end"=>1),
		7=>array("start"=>-6,"end"=>0)
		);
		           
		$weekStart=date("Y-m-d",
		mktime(0,0,0,$dateArr[1],
		$dateArr[2]+
		$weekStartEndPosition[$dayInWeekNo]["start"],
		$dateArr[0]));
		
		$weekEnd=date("Y-m-d",
		mktime(0,0,0,$dateArr[1],
		$dateArr[2]+
		$weekStartEndPosition[$dayInWeekNo]["end"],$dateArr[0]));
		           
		return array("start"=>$weekStart,"end"=>$weekEnd);
	}
	
	function get_active(){
		
		$this->db->where('active_round >',0);
		$aux=$this->db->get($this->name);
		
		return $aux->result();
	}
	
	function get_teams($championship){
		$this->load->model('section');
		
		$sections_teams=$this->section->get_teams();
		
		$this->db->select('t.*');
		$this->db->from('championships_teams ct,teams t');
		$this->db->where('ct.team_id','t.id',FALSE);
		$this->db->where('ct.championship_id',$championship);
		$this->db->order_by('t.name','asc');
		
		$aux=$this->db->get()->result();
		$res=array();
		foreach($aux as $row){
			if(array_key_exists($row->id,$sections_teams))
				$section=$sections_teams[$row->id];
			else
				$section=0;
			
			$res[]=array('id'=>$row->id,'name'=>$row->name,'thumb'=>$row->shield,'section'=>$section);	
		}
		return $res;
	}
	
	function get_groups($champ){
		$query=$this->db->query('Select g.id, g.name
						  		 From championships as c, rounds as r, groups as g
						  		 Where c.id='.$champ.' and r.id=c.active_round and r.id=g.round_id');
		
		$i=1;
		$groups=false;
		foreach($query->result() as $row):
			$groups[$i]['id']=$row->id;
			$groups[$i]['name']=$row->name;
			$i++;
		endforeach;
		
		return $groups;
	}
	
	function get_last_schedule($champ){
		$champ=current($this->get($champ)->result());
	
		$this->db->where('round_id',$champ->active_round);
		$this->db->order_by('position','asc');
		$this->db->limit(1);
		$aux=current($this->db->get('schedules')->result());
		if($aux!=false)
			return $aux->id;
		else
			return false;
	}
	
	function set_active_round($championship,$round){
		$this->db->where('id',$championship);
		$this->db->set('active_round',$round);
		$this->db->update($this->name);
	}
}
?>