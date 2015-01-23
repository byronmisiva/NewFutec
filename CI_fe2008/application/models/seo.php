<?php
class Seo extends CI_Model {

   //  var $limit = " LIMIT 4 ";
    var $limit = " ";

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->name='seos';
    }
       // genera seccion fijas
    function get_seccions(){

        $result = array();
        $result[] = array("url" => base_url(), "desc" => "Home" );
        $result[] = array ("url" => base_url() . "marcador-en-vivo" , "desc" => "Marcador en vivio" );
        $result[] = array ("url" => base_url() . "calendario-campeonato-ecuatoriano" , "desc" => "Calendario Campeonato ecuador" );
        $result[] = array ("url" => base_url() . "goleadores-campeonato-ecuatoriano-serie-a-2014" , "desc" => "Goleadores calendario campeonato ecuador" );
        $result[] = array ("url" => base_url() . "ultimas-encuestas" , "desc" => "Últimas 30 encuestas" );
        $result[] = array ("url" => base_url() . "fuera-de-juego" , "desc" => "Fuera de Juego" );

        $result[] = array ("url" => base_url() . "equipo/olmedo" , "desc" => "Olmedo" );
        $result[] = array ("url" => base_url() . "equipo/el-nacional" , "desc" => "El Nacional" );
        $result[] = array ("url" => base_url() . "equipo/universidad-catolica-de-quito" , "desc" => "Universidad Católica de Quito" );
        $result[] = array ("url" => base_url() . "equipo/emelec" , "desc" => "Emelec" );
        $result[] = array ("url" => base_url() . "equipo/liga-de-loja" , "desc" => "Liga de Loja" );
        $result[] = array ("url" => base_url() . "equipo/independiente-del-valle" , "desc" => "Independiente del Valle" );
        $result[] = array ("url" => base_url() . "equipo/barcelona" , "desc" => "Barcelona" );
        $result[] = array ("url" => base_url() . "equipo/liga-de-quito" , "desc" => "LDU" );
        $result[] = array ("url" => base_url() . "equipo/manta-fc" , "desc" => "Manta FC" );
        $result[] = array ("url" => base_url() . "equipo/deportivo-cuenca" , "desc" => "Deportivo Cuenca" );
        $result[] = array ("url" => base_url() . "equipo/mushuc-runa" , "desc" => "Mushuc Runa" );
        $result[] = array ("url" => base_url() . "equipo/deportivo-quito" , "desc" => "Deportivo Quito" );

        $result[] = array ("url" => base_url() . "eliminatorias" , "desc" => "Eliminatorias" );
        $result[] = array ("url" => base_url() . "serie-a" , "desc" => "Serie A futbol ecuatoriano" );
        $result[] = array ("url" => base_url() . "serie-b" , "desc" => "Serie A futbol ecuatoriano" );
        $result[] = array ("url" => base_url() . "seleccion-nacional" , "desc" => "Selección ecuatoriana de fútbol" );
        $result[] = array ("url" => base_url() . "copa-libertadores" , "desc" => "Resultados copa libertadores de américa" );
        $result[] = array ("url" => base_url() . "copa-sudamericana" , "desc" => "Copa Sudamericana resultados" );
        $result[] = array ("url" => base_url() . "zona-fe" , "desc" => "Zona FE" );
        $result[] = array ("url" => base_url() . "revista-fe-magazine" , "desc" => "FE Magazine" );
        $result[] = array ("url" => base_url() . "nuestros-embajadores" , "desc" => "Nuestros embajadores" );
 
      return $result;
    }

    function get_all_stories(){
        $query = $this->db->query('SELECT id, title, subtitle, DATE_FORMAT(created,"%Y-%m-%dT%H:%i:%s-05:00") AS created FROM stories ORDER BY stories.created DESC'. $this->limit);
        return $query->result();
    }

    function get_stories_news(){
        $query = $this->db->query('SELECT id, title, subtitle, DATE_FORMAT(created,"%Y-%m-%dT%H:%i:%s-05:00") AS created FROM stories ORDER BY stories.created DESC LIMIT 40');

        $data = $query->result();
        foreach ($query->result() as $row):
            $row->keywords = $this->get_tags_storie($row->id);
        endforeach;


        return $data;
    }

    function get_all_tags(){
        $query = $this->db->query('SELECT name FROM tags ORDER BY sum DESC' . $this->limit);
        return $query->result();
    }

    function get_tags_storie($idstorie){
        $query = $this->db->query("SELECT tags.name
                                    FROM tags INNER JOIN stories_tags ON tags.id = stories_tags.tag_id
                                    WHERE stories_tags.story_id = '".$idstorie."'");
        $data = '';
        $i = 0;
        foreach ($query->result() as $row):
            if ($i != 0)
                $data .= ', ';
            $data .= trim($row->name);
            $i++;
        endforeach;
        return $data;
    }

}