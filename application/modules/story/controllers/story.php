<?php

class Story extends MY_Controller
{

    public $model = 'mdl_story';

    public function __construct()
    {
        parent::__construct();
    }


    public function top1($data = FALSE)
    {
        $this->output->cache(CACHE_DEFAULT);
        $data['FE_Halfbanner'] = $this->load->view('fe_halfbanner', $data, TRUE);
        $data['FE_Superbanner'] = $this->load->view('fe_superbanner', $data, TRUE);;
        return $this->load->view('top1', $data, TRUE);
    }

    public function viewget_plus($namesection, $idsection, $nameSectionUrl, $data = FALSE)
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->load->module('noticias');

        $data['namesection'] = $namesection;
        $data['nameSectionUrl'] = $nameSectionUrl;
        $data['idsection'] = $idsection;
        $data['noticias'] = $this->mdl_story->get_plus();
        return $this->noticias->load->view('mininewssidebar', $data, TRUE);
    }


    function get_complete($id, $banerintermedio = "", $bannerBottom = "", $bannerTop = "")
    {


        $this->mdl_story->cuentaVisita($id);
        $this->output->cache(CACHE_DEFAULT);
        $this->load->library('user_agent');
        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $data['isMobile'] = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $data['isMobile'] = true;
        }
        $noticia = $this->mdl_story->get_story($id);
        $data['noticia'] = $noticia;

        $data['bannerBottom'] = $bannerBottom;
        $data['bannerTop'] = $bannerTop;

        $data['banerintermedio'] = $banerintermedio;

        //sobre escribo el banner intermedio en caso de que tenga tag AlertasFutbolecuador
        $listtags = $noticia->tags;
         foreach ($listtags  as   $tag) {
            if ($tag->name == "Alertasfutbolecuador") {
                $data2 = array();
                $data2 ['parametro'] = 1;
                $data['banerintermedio'] = $this->banners->anuncio_alertas($data2);
                break;
            }
        }


        $data['autor'] = $this->get_author($noticia->author_id);

        // noticias por tag
        $tags = "";
        foreach ($noticia->tags as $key => $tag) {
            if (($tag->name != "don balon") && ($tag->name != "serie a")&& ($tag->name != "serie b") && ($tag->name != "Campeonato Ecuatoriano") && ($tag->name != "zona fe")) {
                $tags = $tags . "'" . $tag->name . "'";
            }
        }

        $tags = str_replace("''", "','", $tags );
        $data['tagsStorys'] = $this->noticias->viewTags("Noticias Relacionadas", $tags, 0, "noticia", 4, 0, false, false, $id);
        // fin noticias por tag

        //La Voz de las Tribunas
        $this->load->module('noticias');

        $data['laVozDeLasTribunas'] = $this->mdl_noticias->get_by_position(1, LAVOZDELASTRIBUNAS, LAVOZDELASTRIBUNASPOS);
        return $this->load->view('noticiaabierta', $data, TRUE);
    }

    function get_author($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get('users')->result();
        return $data;
    }

    function get_more($section, $noticias = 0, $num = 5)
    {
        $this->output->cache(CACHE_DEFAULT);
        if ($section != 'all') {
            $sec = $this->section->get($section);
            $res = $this->section->get_tag_list($section);
            $tags = array();
            $str_tags = "";
            foreach ($res as $row) {
                $tags[] = $row->tag_id;
                $str_tags .= $row->tag_id . ',';
            }
            $str_tags = trim($str_tags, ',');

            if (count($tags) > 0) {
                $this->db->from('stories_tags st');
                $this->db->where('s.id', 'st.story_id', FALSE);
                $this->db->where('s.position <', 10);
                if (is_null($sec->category_id))
                    $where = "(st.tag_id IN($str_tags))";
                else
                    $where = "(s.category_id=$sec->category_id OR st.tag_id IN($str_tags))";
                $this->db->where($where);

            }
        }

        if (count($noticias) > 0)
            $this->db->where_not_in('s.id', $noticias);
        elseif ($noticias > 0 and !is_array($noticias))
            $this->db->where('s.id <', $noticias);

        $this->db->select('s.*,modified as time', FALSE);
        $this->db->where('s.invisible', '0');
        $this->db->where('s.position <', 10);
        $this->db->limit($num);
        $this->db->order_by('s.created', "desc");
        $this->db->order_by('s.id', "desc");
        $this->db->group_by('s.id');
        $aux = $this->db->get("stories" . ' as s')->result();
        foreach ($aux as $key => $row) {
            $date = explode(" ", $row->time);
            $fecha = explode("-", $date[0]);
            $hora = explode(":", $date[1]);

            $aux[$key]->time = mktime($hora[0], $hora[1], $hora[2], $fecha[1], $fecha[2], $fecha[0]);
            $stat = $this->story_stat->get_story_stat($row->id);
            $row->rate = $stat->rate;

            $aux[$key]->reads = $stat->reads;
            $aux[$key]->sends = $stat->sends;
            $aux[$key]->votes = $stat->votes;

        }

        return $aux;
    }

    //from seccion
    function get($id)
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->db->where('id', $id);
        $aux = current($this->db->get('sections')->result());
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
        $this->output->cache(CACHE_DEFAULT);
        $this->db->where('section_id', $id);
        $data = $this->db->get('sections_tags')->result();
        return $data;
    }

    //end from seccion

    function get_story_stat($story)
    {
        $this->output->cache(CACHE_DEFAULT);
        $this->db->where('story_id', $story);
        $aux = current($this->db->get('stories_stats')->result());

        return $aux;
    }

}