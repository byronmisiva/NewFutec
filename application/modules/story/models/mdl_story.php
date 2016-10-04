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

    function get_story($id)
    {
        $this->db->select('s.*, (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id limit 1) AS lecturas, i.thumb400,i.thumb300,i.thumb150,i.thumb640,i.thumbh120,thumbh50, UNIX_TIMESTAMP(s.modified) as datem,i.name as image_name', FALSE);
        $this->db->join('images i', 's.image_id=i.id', 'LEFT');
        //$this->db->where('s.image_id','i.id',FALSE);
        $this->db->where('s.id', $id);
        $aux = current($this->db->get('stories s')->result());

        $this->db->select('t.*');
        $this->db->from('stories_tags st,tags t');
        $this->db->where('st.tag_id', 't.id', FALSE);
        $this->db->where('st.story_id', $id);
        $this->db->order_by('t.name', 'asc');
        $aux->tags = $this->db->get()->result();
        if ($this->session->userdata('role') >= 3) {
            $stat = $this->story_stat->get_story_stat($aux->id);
            $aux->rate = $stat->rate;
            $aux->reads = $stat->reads;
            $aux->sends = $stat->sends;
            $aux->votes = $stat->votes;
        }

        return $aux;
    }
    
    function getNoticiaxMes($mes){
    	$data = $this->db->query('SELECT s.id,s.title, s.subtitle, s.created
From stories s
WHERE month(s.created)='.$mes.'
ORDER BY s.created DESC ');
    	return $data->result();
    	
    }

    function news_by_tagsList($tag, $limit = "", $offset = 0)
    {
        if ("" != $limit) {
            $limit = "limit " . $limit;
        }
        $data = $this->db->query('SELECT s.id, s.category_id, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category, s.title, s.subtitle, s.lead, s.body, s.created, s.modified, UNIX_TIMESTAMP(s.modified) AS datem, i.thumb300, i.thumbh120, i.thumbh80, i.thumbh50
                                    FROM stories_tags st INNER JOIN tags t ON st.tag_id = t.id
                                    INNER JOIN stories s ON s.id = st.story_id
                                    INNER JOIN images i ON s.image_id = i.id
                                    WHERE lower(t. NAME) IN (lower("' . $tag . '")) AND s.position != 10
                                    ORDER BY s.modified DESC ' . $limit);
        return $data->result();
    }

    function news_by_tags($tag, $limit = "", $offset = 0, $newIn = false)
    {
        if ("" != $limit) {
            $limit = "limit " . $limit;
        }

        if ($newIn != false) {
            $notIn = " and s.id <> " .  $newIn;
        } else {
            $notIn = "";
        }
        $tag = mb_strtolower ( $tag );
        $data = $this->db->query('SELECT DISTINCT s.id, s.category_id, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category, s.title, s.subtitle, s.lead, s.body, s.created, s.modified, UNIX_TIMESTAMP(s.modified) AS datem, i.thumb300, i.thumbh120, i.thumbh80, i.thumbh50
                                    FROM stories_tags st INNER JOIN tags t ON st.tag_id = t.id
                                    INNER JOIN stories s ON s.id = st.story_id
                                    INNER JOIN images i ON s.image_id = i.id
                                    WHERE lower(t. NAME) IN (' . $tag . ') AND s.position != 10 ' . $notIn .'
                                    ORDER BY s.modified DESC ' . $limit);

        $test = $this->db->last_query();
        return $data->result();
    }

    function get_destacados()
    {
        $data = $this->db->query('SELECT stories.*, images.thumbh50, images.thumbh120
                                    FROM stories INNER JOIN images ON stories.image_id = images.id
                                    WHERE destacado=3 ORDER BY stories.created DESC
                                    LIMIT 5');
        return $data->result();
    }

    function storys_by_tags($tag = "", $limit = RESULT_PAGE, $exclude = '', $offset = 0)
    {
        $this->load->module('story');
        if ($tag != "") $tag = 'lower("' . $tag . '")=lower(t.name) AND ';
        $this->db->select("s.id, s.category_id, s.title, s.subtitle, s.lead, s.body, s.created, openseccion, (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id limit 1) AS lecturas,  i.thumb300, i.thumbh120,i.thumbh80,i.thumbh50, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category", FALSE);
        $this->db->from('stories  s', FALSE);
        $this->db->join('images i', 's.image_id = i.id', FALSE);
        $this->db->where('s.invisible', 0, FALSE);
        $this->db->where('s.position !=', 10);

        if ($offset > 0) {
            $this->db->order_by('s.created', 'desc', FALSE);
            $this->db->limit($limit, $offset);
        } else {
            $this->db->where('s.id >', '( select MAX(id) from stories )  -  ' . ($limit + 10), false);
        }
        //quitamos las noticias rotativas

        if ($exclude != "")
            $this->db->where_not_in('s.id', $exclude);

        $aux = $this->db->get()->result();
        $temp = $this->db->last_query();
        if ($offset == 0) {
            $aux = array_reverse($aux);
            $aux = array_splice($aux, 0, $limit);
        }
        $test = $this->db->last_query();
        return $aux;
    }

    function get_banner($max = 4, $exclude = '')
    {
    	
    	//$this->db->where('s.sponsored', 0, FALSE);
        $this->db->select("s.id as sid,
				s.id, s.title, s.lead, s.subtitle,
				s.sponsored,
				s.created,
				s.rate,
				s.reads,
				s.sends,
				s.votes,
				s.openseccion,
				i.name,
				i.thumbh50,
				i.thumbh120,
				i.thumbh80,
				i.thumb300,
				i.thumb500", FALSE);
        $this->db->from('stories  s', FALSE);
        $this->db->join('images i', 's.image_id = i.id', FALSE);
        $this->db->where('s.invisible', 0, FALSE);
        $this->db->where('s.position', 1, FALSE);
        
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

    function get_tag_list($id)
    {
        $this->db->where('section_id', $id);

        $data = $this->db->get('sections_tags')->result();
        return $data;

        $base = "SELECT st.tag_id
            FROM (`stories` s)
            JOIN  `stories_tags`  st ON `s`.`id` = `st`.`story_id`
            WHERE (category_id =41 OR st.tag_id IN(\"212\") )
            AND `s`.`invisible` =  '0'
            AND `s`.`position` < 10
            GROUP BY `s`.`id`
            ORDER BY `s`.`created` desc
            LIMIT 8";
    }


    public function get_banner_seccion($limit = 5, $exclude = '', $seccion = '')
    {
        if ($seccion != "") {
            $sec = $this->mdl_noticias->get($seccion);
            $res = $this->mdl_noticias->get_tag_list($seccion);
            $tags = array();
            $str_tags = "";
            foreach ($res as $row) {
                $tags[] = $row->tag_id;
                $str_tags .= '"' . $row->tag_id . '"' . ',';
            }
            $str_tags = trim($str_tags, ',');
            if (count($tags) > 0) {

                $res = $this->db->query("SELECT s.image_id FROM  stories s where (category_id=$sec->category_id )
                                      AND invisible =  '0' ORDER BY created desc LIMIT $limit")->result(0);

                $str_ids = "";
                foreach ($res as $row) {
                    $str_ids .= '"' . $row['image_id'] . '"' . ',';
                }
                $str_ids = trim($str_ids, ',');

                $this->db->from('stories s', false);
                //$this->db->join('(select * from images where  id IN(' . $str_ids . ')) i', 'i.id = s.image_id');
                $this->db->join('images i', 'i.id = s.image_id');

                if ($this->mdl_noticias->validarquery($str_ids, $str_tags, $sec->category_id, 0, $limit)) {
                    //$this->db->join("(SELECT * FROM stories_tags WHERE stories_tags.tag_id IN ($str_tags)) st", 's.id = st.story_id');
                    $this->db->join('`stories_tags` st', 's.id = st.story_id');
                    $where = "(category_id=$sec->category_id OR st.tag_id IN($str_tags))";
                } else {
                    $this->db->join('`stories_tags`  st', 's.id = st.story_id');
                    $where = "(category_id  =$sec->category_id OR st.tag_id IN($str_tags) )";
                }


                $this->db->where($where);

            } else {
                $this->db->join('images i', 'i.id = s.image_id');
                $this->db->from('stories s');
            }
        } else {
            $this->db->from('stories s');
            $this->db->join('images i', 'i.id = s.image_id');
            $this->db->order_by('s.created', "desc");

        }

        $this->db->select('s.*,i.thumb500,,i.thumb300, i.thumbh120 as thumb1,i.thumbh120,i.thumbh80 as thumb2,i.thumbh80 ,i.thumbh50 as thumb3,i.thumbh50,s.created as time, (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id limit 1) AS lecturas, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category', FALSE);
        $this->db->where('s.invisible', '0');

        $this->db->where('s.position <', 10);

        $l = explode(',', $limit);
        if (count($l) > 1)
            $this->db->limit($l[0], $l[1]);
        else {
            $limitNew = $limit;
            $this->db->limit($limitNew * 3);

        }

        $this->db->order_by('s.created', "desc");

        $aux = $this->db->get()->result();
        // por optimizacion
        $aux = $this->mdl_noticias->ajustaArray($aux, $limit);

        $test = $this->db->last_query();
        return $aux;
    }

    function get_banner_seccion2($max = 5, $exclude = '', $id_seccion = '')
    {
        $this->db->select("
				s.id,
				s.title,
				s.lead,
				s.subtitle,
				s.sponsored,
				s.created,
				s.rate,
				s.reads,
				s.sends,
				s.votes,
				i.name,
				i.thumbh50,
				i.thumbh120,
				i.thumbh80,
				i.thumb300, (select name from sections where category_id = s.category_id LIMIT 1) AS seccion,
				i.thumb500", FALSE);
        $this->db->from('stories  s', FALSE);
        $this->db->join('images i', 's.image_id = i.id', FALSE);
        $this->db->where('s.invisible', 0, FALSE);
        $this->db->where('s.position', 1, FALSE);
        $this->db->where('s.sponsored', 0, FALSE);
        $this->db->where('s.created >=', '(DATE_SUB(CURRENT_DATE, INTERVAL 120 DAY))', FALSE);
        $this->db->order_by('s.created', 'desc', FALSE);
        $this->db->limit($max);
        //para el caso de que se tenga la noticia 6 y que esta no se muestre
        if ($exclude != "")
            $this->db->where('s.category_id !=', $exclude);

        if ($id_seccion != '')
            $this->db->where('s.category_id =  ', ' (select category_id from sections where id = (' . $id_seccion . '))', false);

        $aux = $this->db->get()->result();

        $test = $this->db->last_query();

        return $aux;
    }

    function get_banner_tag($max = 5, $exclude = '', $tag)
    {
        $this->db->select("s.id as sid,
				s.id,
				s.title,
				s.lead,
				s.subtitle,
				s.sponsored,
				s.created,
				s.rate,
				s.reads,
				s.sends,
				s.votes,
				s.openseccion,
				i.name,
				i.thumbh50,
				i.thumbh80,
				i.thumb300,
				i.thumb500,
				i.thumb990", FALSE);
        $this->db->from('stories  s', FALSE);
        $this->db->join('images i', 's.image_id = i.id', FALSE);

        $this->db->join('stories_tags', 's.id = stories_tags.story_id', FALSE);
        $this->db->join('tags', 'stories_tags.tag_id = tags.id', FALSE);

        $this->db->where('s.invisible', 0, FALSE);
        $this->db->where('s.position', 1, FALSE);
        $this->db->where('s.sponsored', 0, FALSE);
        $this->db->where('tags.name', $tag);
        $this->db->where('s.created >=', '(DATE_SUB(CURRENT_DATE, INTERVAL 200 DAY))', FALSE);
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

    function get_zonaFE($excluded = array(), $max = 2)
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

    function cuentaVisita($id)
    {
        $sql = 'select `reads` from stories_stats  where story_id=' . $id . ' limit 1';
        $aux = $this->db->query($sql)->result();

        if (isset($aux[0]->reads)) {
            $data = array(
                'reads' => $aux[0]->reads + 1
            );
            $this->db->where('story_id', $id);
            $this->db->update('stories_stats', $data);

        } else {
            $data = array(
                '`reads`' => 1 ,
                '`story_id`' => $id

            );
            $this->db->insert('stories_stats', $data);
        }
        return $aux;
    }

    function get_plus($num = 5, $offset = 0)
    {
        //todo terminar esta funcion
        $past_days = 7;
        $last_month = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - $past_days, date("Y")));
        $this->db->where('s.created >', $last_month);
        $this->db->where('s.invisible', '0');
        $this->db->where('s.position !=', 10);
        $this->db->limit($num, $offset);


        $this->db->from('stories_stats ss');
        $this->db->where('ss.story_id', 's.id', FALSE);
        $this->db->order_by('ss.reads', 'desc');
        $this->db->select('*, , (SELECT stories_stats.reads FROM stories_stats WHERE  stories_stats.story_id = s.id limit 1) AS lecturas, (SELECT categories.name FROM categories WHERE categories.id = s.category_id) AS category', FALSE);

        $data = $this->db->get($this->table_name . ' s')->result();

        foreach ($data as $key => $nota) {
            $this->db->select('i.thumbh120 as thumb1,i.thumbh120, i.thumbh80 as thumb2,i.thumbh50 as thumb3,i.thumbh50,i.thumb300 as thumb300', FALSE);
            $this->db->where('i.id', $nota->image_id);
            $imagenes = $this->db->get("images" . ' i')->result();
            if (count($imagenes) > 0) {
                $data[$key]->thumb1 = $imagenes[0]->thumb1;
                $data[$key]->thumb2 = $imagenes[0]->thumb2;
                $data[$key]->thumb3 = $imagenes[0]->thumb3;
                $data[$key]->thumb300 = $imagenes[0]->thumb300;
                $data[$key]->thumbh50 = $imagenes[0]->thumbh50;
            } else {
                $data[$key]->thumb1 = "";
                $data[$key]->thumb2 = "";
                $data[$key]->thumb3 = "";
                $data[$key]->thumb300 = "";
                $data[$key]->thumbh50 = "";
            }
        }
        return $data;
    }

}