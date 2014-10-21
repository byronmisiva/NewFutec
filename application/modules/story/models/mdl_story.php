<?php

class Mdl_story extends MY_Model
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

    function storys_by_tags($tag = "", $limit = RESULT_PAGE)
    {
        if ($tag != "") $tag = 'lower("' . $tag . '")=lower(t.name) AND ';
        $this->db->select("s.id, s.category_id, s.title, s.subtitle, s.lead, s.created, (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id) AS lecturas,  i.thumb300, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category", FALSE);
        $this->db->from('stories  s', FALSE);
        $this->db->join('images i', 's.image_id = i.id', FALSE);
        $this->db->where('s.invisible', 0, FALSE);
        $this->db->where('s.position !=', 10);
        $this->db->order_by('s.created', 'desc', FALSE);
        $this->db->limit($limit);
        $aux = $this->db->get()->result();
        return $aux;
    }

    function get_banner($max = 5, $exclude = '')
    {
        $this->db->select("s.id as sid,
				s.id,
				s.title,
				s.subtitle,
				s.sponsored,
				s.created,
				s.rate,
				s.reads,
				s.sends,
				s.votes,
				i.name,
				i.thumbh80,
				i.thumb500", FALSE);
        $this->db->from('stories  s', FALSE);
        $this->db->join('images i', 's.image_id = i.id', FALSE);
        $this->db->where('s.invisible', 0, FALSE);
        $this->db->where('s.position', 1, FALSE);
        $this->db->where('s.sponsored', 0, FALSE);
        $this->db->where('s.created >=', '(DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY))', FALSE);
        $this->db->order_by('s.created', 'desc', FALSE);
        $this->db->limit($max);
        //para el caso de que se tenga la noticia 6 y que esta no se muestre
        if ($exclude != "")
            $this->db->where('s.category_id !=', $exclude);
        $aux = $this->db->get()->result();
        foreach ($aux as $key => $row) {
            if ($this->session->userdata('role') >= 3) {
                $stat = $this->story_stat->get_story_stat($row->sid);
                $aux[$key]->rate = $stat->rate;
                $aux[$key]->reads = $stat->reads;
                $aux[$key]->sends = $stat->sends;
                $aux[$key]->votes = $stat->votes;

            }
        }

        return $aux;
    }

    function get_zonaFE($excluded = array(), $max = 1)
    {

        $this->db->select('s.id as sid,s.*, i.*,i.name as image_name');
        $this->db->from('stories as s, images as i');
        $this->db->where('s.image_id', 'i.id', FALSE);
        $this->db->where('s.category_id', 44);
        $this->db->where('s.invisible', 0);
        if (count($excluded) > 1)
            $this->db->where_not_in('s.id', $excluded);
        $this->db->order_by('s.created', 'desc');
        $this->db->limit($max);

        $aux = $this->db->get()->result();

        return $aux;
    }

    function get_plus($num = 5)
    {
//todo terminar esta funcion
        $past_days = 7;
        $last_month = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - $past_days, date("Y")));
        $this->db->where('s.created >', $last_month);
        $this->db->where('s.invisible', '0');
        $this->db->where('s.position !=', 10);
        $this->db->limit($num);


        $this->db->from('stories_stats ss');
        $this->db->where('ss.story_id', 's.id', FALSE);
        $this->db->order_by('ss.reads', 'desc');



        $data = $this->db->get($this->table_name . ' s')->result();
        $test = $this->db->last_query();
        foreach ($data as $key=>$nota) {
                $this->db->select('i.thumbh120 as thumb1,i.thumbh80 as thumb2,i.thumbh50 as thumb3', FALSE);
            $this->db->where('i.id', $nota->image_id);
            $imagenes = $this->db->get("images" . ' i')->result();
            $data[$key]->thumb1 = $imagenes[0]->thumb1;
            $data[$key]->thumb2 = $imagenes[0]->thumb2;
            $data[$key]->thumb3 = $imagenes[0]->thumb3;
        }
        return $data;
    }

}