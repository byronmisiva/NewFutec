<?php
class Profile extends CI_Model {
	
	var $name;
	
	function __construct() {
        parent::__construct();
        $this->name='profiles';
	}  
	
	function get_last(){
		
		$this->db->select('profiles.*,players.first_name,players.last_name');
		$this->db->from('profiles');
		$this->db->join('players', 'players.id = profiles.player_id');
		$this->db->order_by('created','desc');
		$this->db->limit(1);
		$profile=$this->db->get();
		if($profile->num_rows()>0)
			return current($profile->result());
		else
			return false;
	}  
	
	function get_last2(){
		
		$this->db->select('profiles.*, UNIX_TIMESTAMP(created) as datem, players.first_name,players.last_name');
		$this->db->from('profiles');
		$this->db->join('players', 'players.id = profiles.player_id');
		$this->db->order_by('created','desc');
		$this->db->limit(1);
		$profile=$this->db->get();
		if($profile->num_rows()>0){
			$profile=current($profile->result());
			$profile->subtitle='';
			$profile->lead='';
			$profile->body=$profile->text;
			return $profile;
		}	
		else
			return false;
	}
	
	function get($id){
		$this->db->select('profiles.*,players.first_name,players.last_name');
		$this->db->from('profiles');
		$this->db->join('players', 'players.id = profiles.player_id');
		$this->db->where('profiles.id',$id);
		
		$profile=$this->db->get()->result();
		return current($profile);
	}
	
	function get2($id){
		$this->db->select('profiles.*, UNIX_TIMESTAMP(created) as datem, players.first_name,players.last_name');
		$this->db->from('profiles');
		$this->db->join('players', 'players.id = profiles.player_id');
		$this->db->where('profiles.id',$id);
		
		$profile=$this->db->get()->result();
		return current($profile);
	}
	
	function set_read($id){
		$this->db->where('id',$id);
		$this->db->set('p.reads','p.reads+1',FALSE);
		$this->db->update($this->name.' p');
	}
	
}
?>