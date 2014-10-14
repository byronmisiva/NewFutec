<?php

class Mdl_strikes extends MY_Model
{


    public $table_name = "stories";
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

    public function __construct()
    {
        parent::__construct();
    }

    function get_strikers($championship,$num=10){

        if($num==0){
            $limit='';
        }
        else{
            $limit='LIMIT '.$num;
        }

        return	$this->db->query('SELECT p.last_name, p.first_name,p.nick, t.name, COUNT(g.id) as goals, p.id, p.thumb,p.image, p.thumb220, p.position, p.height, p.born_place, UNIX_TIMESTAMP(NOW()) as n, UNIX_TIMESTAMP(p.birth) as b
						 		  FROM goals as o, teams as t, players as p, matches as m, groups as g, rounds as r, championships as c
						 		  WHERE c.id='.$championship.' and c.id=r.championship_id and r.id=g.round_id and g.id=m.group_id and m.id=o.match_id and o.team_id=t.id and o.player_id=p.id and o.type!=3
						 		  GROUP BY (p.id)
								  ORDER BY goals DESC,p.last_name ASC,p.first_name ASC '.$limit)->result();
    }
}