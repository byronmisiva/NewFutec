<?php

class Mdl_Noticias extends MY_Model
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

    public $name = "sections";

    public function __construct()
    {
        parent::__construct();
    }

    // from secction
    function get($id)
    {
        $this->db->where('id', $id);
        //$this->db->from('sections');
        $aux = current($this->db->get($this->name)->result());
        $aux->survey_id = $this->get_survey($id);
        //Extraigo el padre para ver si tiene datos que heredar
        if (isset($aux->section_id)) {
            if (!is_null($aux->section_id)) {
                $parent = $this->get($aux->section_id);

                //Compruebo los datos heredados
                if (is_null($aux->team_id))
                    $aux->team_id = $parent->team_id;
                if (is_null($aux->championship_id))
                    $aux->championship_id = $parent->championship_id;
                if (is_null($aux->category_id))
                    $aux->category_id = $parent->category_id;

                if ($aux->survey_id == false)
                    $aux->survey_id = $parent->survey_id;
            }
        }

        return $aux;
    }

    function get_tag_list($id)
    {
        $this->db->where('section_id', $id);

        $data = $this->db->get('sections_tags')->result();
        return $data;
    }


    function get_survey($section)
    {
        $this->db->where('section_id', $section);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        $survey = current($this->db->get('sections_surveys')->result());
        if ($survey != false)
            return $survey->survey_id;
        else
            return false;
    }

    //end from secction


    public function get_by_position($limit, $seccion = "", $position, $offset = 0)
    {
        if ($seccion != "") {
            $sec = $this->get($seccion);
            $res = $this->get_tag_list($seccion);
            $tags = array();
            $str_tags = "";
            foreach ($res as $row) {
                $tags[] = $row->tag_id;
                $str_tags .= $row->tag_id . ',';
            }
            $str_tags = trim($str_tags, ',');
            if (count($tags) > 0) {
                $this->db->from('stories s, images i,stories_tags st');
                $this->db->where('s.id', 'st.story_id', FALSE);
                $this->db->where('i.id', 's.image_id', FALSE);
                $where = "(category_id=$sec->category_id OR st.tag_id IN($str_tags))";
                $this->db->where($where);
                $this->db->group_by('s.id');
            } else {
                $this->db->from('stories s, images i');
                $this->db->where('i.id', 's.image_id', FALSE);
            }
        } else {
            $this->db->from('stories s, images i');
            $this->db->where('i.id', 's.image_id', FALSE);
        }

        $this->db->select('s.*,i.thumb300, i.thumbh120 as thumb1,i.thumbh120,i.thumbh80 as thumb2,i.thumbh80 ,i.thumbh50 as thumb3,s.created as time, (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id) AS lecturas, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category', FALSE);
        $this->db->where('s.invisible', '0');

        //Check if there are multiple positions
        if (is_array($position))
            $this->db->where_in('s.position', $position);
        else
            $this->db->where('s.position', $position);

        $l = explode(',', $limit);
        if (count($l) > 1)
            $this->db->limit($l[0], $l[1]);
        else
            $this->db->limit($limit, $offset);
        $this->db->order_by('s.created', "desc");


        $aux = $this->db->get()->result();

        foreach ($aux as $key => $row) {
            $date = explode(" ", $row->time);
            $fecha = explode("-", $date[0]);
            $hora = explode(":", $date[1]);

            $aux[$key]->time = mktime($hora[0], $hora[1], $hora[2], $fecha[1], $fecha[2], $fecha[0]);
            if ($this->session->userdata('role') >= 3) {

                $stat = $this->story_stat->get_story_stat($row->id);

                $row->rate = $stat->rate;

                $aux[$key]->reads = $stat->reads;
                $aux[$key]->sends = $stat->sends;
                $aux[$key]->votes = $stat->votes;
            }
        }
        return $aux;
    }


}