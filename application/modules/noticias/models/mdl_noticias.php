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

        $base = "SELECT st.tag_id
FROM (`stories` s)
JOIN  `stories_tags`  st ON `s`.`id` = `st`.`story_id`
WHERE (category_id =41 OR st.tag_id IN("212") )
AND `s`.`invisible` =  '0'
AND `s`.`position` < 10
GROUP BY `s`.`id`
ORDER BY `s`.`created` desc
LIMIT 8";
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
                $str_tags .= '"' . $row->tag_id . '"' . ',';
            }
            $str_tags = trim($str_tags, ',');
            if (count($tags) > 0) {
                if (isset($position)) {
                    $res = $this->db->query("SELECT s.image_id FROM  stories s where (category_id=$sec->category_id )
                                      AND invisible =  '0'   ORDER BY created desc LIMIT $limit")->result(0);
                } else
                    $res = $this->db->query("SELECT s.image_id FROM  stories s where (category_id=$sec->category_id )
                                      AND invisible =  '0'  ORDER BY created desc LIMIT $limit")->result(0);

                $str_ids = "";
                foreach ($res as $row) {
                    $str_ids .= '"' . $row['image_id'] . '"' . ',';
                }
                $str_ids = trim($str_ids, ',');

                $this->db->from('stories s', false);
               //$this->db->join('(select * from images where  id IN(' . $str_ids . ')) i', 'i.id = s.image_id');
                $this->db->join('(select * from images ) i', 'i.id = s.image_id');

                if ($this->validarquery($str_ids, $str_tags, $sec->category_id, $position, $limit)) {
                    $this->db->join('(select * from `stories_tags`   ) st', 's.id = st.story_id');
                    $where = "(category_id=$sec->category_id OR st.tag_id IN($str_tags))";
                } else {
                    $this->db->join('(select * from `stories_tags` where tag_id IN( ' . $str_tags . ' ) ) st', 's.id = st.story_id');
                    $where = "(category_id  =$sec->category_id OR st.tag_id IN($str_tags) )";
                }


                //  $this->db->where('s.position <', 10);


                $this->db->where($where);
                $this->db->group_by('s.id');
            } else {
                $this->db->from('stories s, images i');
                $this->db->where('i.id', 's.image_id', FALSE);
            }
        } else {
            $this->db->from('stories s, images i');
            $this->db->where('i.id', 's.image_id', FALSE);
            //$this->db->where('s.position <', 10);

            //if ($position > 0)
            //    $this->db->where('s.position', $position);
        }

        $this->db->select('s.*,i.thumb300, i.thumbh120 as thumb1,i.thumbh120,i.thumbh80 as thumb2,i.thumbh80 ,i.thumbh50 as thumb3,i.thumbh50,s.created as time, (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id) AS lecturas, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category', FALSE);
        $this->db->where('s.invisible', '0');

        //Check if there are multiple positions
        if (is_array($position)) {
            $this->db->where_in('s.position', $position);
        } else {
            //arreglo generico
            if (isset($position)) {
                if ($position == 2)
                    $this->db->where('s.position <', 10);
                else
                    $this->db->where('s.position', $position);


            }
        }

        $l = explode(',', $limit);
        if (count($l) > 1)
            $this->db->limit($l[0], $l[1]);
        else
            $this->db->limit($limit, $offset);
        $this->db->order_by('s.created', "desc");

        $aux = $this->db->get()->result();
        $test = $this->db->last_query();

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

    public function validarquery($images, $tags, $categoria, $position, $limit)
    {

        if (isset($position)) {
            if ($position == 2)
                $positioQuery = " < 10";
            else
                $positioQuery = " = " . $position;
            $query = 'SELECT s.*
                    FROM (`stories` s)
                    JOIN (select * from images where id IN(' . $images . ')) i ON `i`.`id` = `s`.`image_id`
                    JOIN (select * from `stories_tags` where tag_id IN( ' . $tags . ' ) ) st ON `s`.`id` = `st`.`story_id`
                    WHERE (category_id =' . $categoria . ' OR st.tag_id IN(' . $tags . ') )
                    AND `s`.`invisible` =  "0"
                    AND `s`.`position` ' . $positioQuery.'
                    LIMIT ' . $limit;
        } else
            $query = 'SELECT s.*
                    FROM (`stories` s)
                    JOIN (select * from images where id IN(' . $images . ')) i ON `i`.`id` = `s`.`image_id`
                    JOIN (select * from `stories_tags` where tag_id IN( ' . $tags . ' ) ) st ON `s`.`id` = `st`.`story_id`
                    WHERE (category_id =' . $categoria . ' )
                    AND `s`.`invisible` =  "0"
                    LIMIT ' . $limit;

        $query = $this->db->query($query);

        if ($query->num_rows() <= 5) {
            return true;

        } else {
            return false;
        }

    }


}