<?php

class Mdl_stories extends MY_Model
{

    public $table_name = "sections";
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

    function getNameSection($id)
    {
        $this->db->where('id', $id);
        $this->db->from('sections');
        return $this->db->get()->result();
    }

    function getNameTeam($name)
    {
        $this->db->where('name', $name);
        $this->db->from('teams');
        return $this->db->get()->result();
    }

    function getNameStadia($id)
    {
        $this->db->where('id', $id);
        $this->db->from('stadia');
        return $this->db->get()->result();
    }

    function getHistories($id)
    {
        $this->db->where('team_id', $id);
        $this->db->from('histories');
        return $this->db->get()->result();
    }


    function rss($sec)
    {
        if ($sec == FALSE) {
            $query = $this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
									 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified, s.image_id
									  	   From stories as s
									  	   Where s.invisible=0 AND s.position<10
									  	   Order By s.created DESC
									  	   Limit 0 , 20) as s
									 LEFT JOIN images as i ON s.image_id=i.id');
        } else {
            $cat = $this->db->query('Select category_id
							  	   From sections
							  	   Where id=' . $sec)->result();

            $query = $this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
									 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified, s.image_id
									  	   From stories as s
									  	   Where s.category_id=' . $cat[0]->category_id . ' AND s.invisible=0  AND s.position<10
									  	   Order By s.created DESC
									  	   Limit 0 , 20) as s
									 LEFT JOIN images as i ON s.image_id=i.id');
        }

        return $query;
    }
    
    function rssnewRotativas (){    	
    	/*$query = $this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
				 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified, s.image_id
		   	     From stories as s
				 Where s.invisible=0 AND s.position=1
					  	Order By s.created DESC
				  	    Limit 0 , 20) as s
						LEFT JOIN images as i ON s.image_id=i.id');*/
    	
    	
    	$this->db->select("s.id as sid,s.id,UNIX_TIMESTAMP(s.modified) as ntime, s.title, s.lead, s.subtitle,s.body,s.sponsored,s.created,s.openseccion,i.name,i.thumbh50,
				i.thumbh120,i.thumbh80,i.thumb300,i.thumb500, i.thumb640", FALSE);
    	$this->db->from('stories  s', FALSE);
    	$this->db->join('images i', 's.image_id = i.id', FALSE);
    	$this->db->where('s.invisible', 0, FALSE);
    	$this->db->where('s.position', 1, FALSE);
    	$this->db->where('s.sponsored', 0, FALSE);
    	$this->db->where('s.created >=', '(DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY))', FALSE);
    	$this->db->order_by('s.created', 'desc', FALSE);
    	$this->db->limit(20);
    	//para el caso de que se tenga la noticia 6 y que esta no se muestre    	
    	$aux = $this->db->get()->result();
    	return $aux;
    	
    	
    	
    }

    function rssmarcador()
    {
        $query = $this->db->query('Select * From imagenesmarcador ORDER BY creado DESC ');
        return $query;
    }
    function rssmarcadorprueba()
    {
        $query = $this->db->query('Select * From imagenesmarcador ORDER BY creado DESC ');
        return $query;
    }

    function rssNotifificacion($sec)
    {
        if ($sec == FALSE) {
            $query = $this->db->query('
			Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
			From (Select s.id, s.title, s.subtitle, s.lead, s.body,s.created, s.modified, s.image_id
			  	  From stories as s
				  Where s.invisible=0 AND s.position<10
				  Order By s.created DESC
				  Limit 0 , 20) as s
				  LEFT JOIN images as i ON s.image_id=i.id ORDER BY s.modified');
        } else {
            $cat = $this->db->query('
				Select category_id
				From sections
				Where id=' . $sec)->result();

            $query = $this->db->query('Select s.*, UNIX_TIMESTAMP(s.modified) as ntime, i.thumb640, i.thumb400, i.thumb500, i.thumb300, i.thumb150, i.thumb100, i.thumbh160, i.thumbh120, i.thumbh80, i.thumbh50
									 From (Select s.id, s.title, s.subtitle, s.lead, s.body, s.modified,s.created, s.image_id
									  	   From stories as s
									  	   Where s.category_id=' . $cat[0]->category_id . ' AND s.invisible=0  AND s.position<10
									  	   Order By s.created DESC
									  	   Limit 0 , 20) as s
									 LEFT JOIN images as i ON s.image_id=i.id ORDER BY s.modified');
        }

        return $query->result();
    }
}