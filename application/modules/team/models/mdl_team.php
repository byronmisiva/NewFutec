<?php
class Mdl_team extends MY_Model{
	
	public $table_name = "teams";
	public $primary_key = "id";	
	public $joins;	
	public $select_fields;	
	public $total_rows;	
	public $page_links;	
	public $current_page;	
	public $num_pages;	
	public $optional_params;	
	public $order_by;	
	public $form_values = array();

	public function __construct(){
		parent::__construct();		
	}

    function get($id){
        $this->db->where( 'id',$id);
        return $this->db->get($this->table_name);
    }

    function getJugadoresEquipo($id){
        $equipo= [];
        $this->db->select('players.first_name, players.last_name, players.position ');
        $this->db->from('players_teams');
        $this->db->join('players', 'players_teams.player_id = players.id');
        $this->db->where( 'team_id',$id);
        $this->db->where( 'position',"Arquero");

        $equipo['arqueros'] =   $this->db->get()->result();

        $this->db->select('players.first_name, players.last_name, players.position ');
        $this->db->from('players_teams');
        $this->db->join('players', 'players_teams.player_id = players.id');
        $this->db->where( 'team_id',$id);
        $this->db->where( 'position',"Defensa");

        $equipo['defensas'] =   $this->db->get()->result();

        $this->db->select('players.first_name, players.last_name, players.position ');
        $this->db->from('players_teams');
        $this->db->join('players', 'players_teams.player_id = players.id');
        $this->db->where( 'team_id',$id);
        $this->db->where( 'position',"Volante");

        $equipo['volantes'] =   $this->db->get()->result();

        $this->db->select('players.first_name, players.last_name, players.position ');
        $this->db->from('players_teams');
        $this->db->join('players', 'players_teams.player_id = players.id');
        $this->db->where( 'team_id',$id);
        $this->db->where( 'position',"Delantero");

        $equipo['delanteros'] =   $this->db->get()->result();

        $equipo['maxelementos'] =  max (count($equipo['arqueros']),count($equipo['defensas']),count($equipo['volantes']),count($equipo['delanteros']));

        return $equipo;
    }
}