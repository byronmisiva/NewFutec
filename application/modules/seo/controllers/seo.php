<?php

class Seo extends MY_Controller
{
    public $model = 'mdl_seo';
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

    }

    public function sitemap(){

        // secciones de la pagina
        $data['seccions']=$this->mdl_seo->get_seccions();

        // secciones dinamicas de la pagina
        $data['stories']=$this->mdl_seo->get_all_stories();
       // $this->_urlFriendly($row->title).'/'.$row->id.'

        $data['tags']=$this->mdl_seo->get_all_tags();

        header("Content-Type: text/xml;charset=iso-8859-1");

        $this->load->module('seo');
        $this->load->view("sitemap", $data);
    }
    public function sitemap_news(){

        $data['stories']=$this->mdl_seo->get_stories_news();

        //get_tags_storie();

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemapnews", $data);
    }


    function _clearStringGion($string) {
        $tempSting = str_replace(' ','-',$this->_clearString($string) );

        $tempSting = str_replace(
            array("\\", "¨", "º",  "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "'", "¡",
                "¿", "[", "^", "`", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                ".", '"', '“', '”',"‘", "’", ' ' ),
            '',
            $tempSting
        );

        $tempSting = str_replace('---','-',$tempSting );
        $tempSting = str_replace('--','-',$tempSting );

        return $tempSting;
    }
    function _clearString($string)
    {

        $string = trim($string);
        $string = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä', 'ã'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'a'),
            $string
        );

        $string = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $string
        );

        $string = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $string
        );

        $string = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô', 'õ', 'ø'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O', 'o', 'o'),
            $string
        );

        $string = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $string
        );

        $string = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño

        return $string;
    }

    function _urlFriendly ($string){
        return strtolower($this->_clearStringGion ($string)) ;
    }
}