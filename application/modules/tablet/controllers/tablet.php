<?php

class Tablet extends MY_Controller
{
    public $model = 'mdl_tablet';
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo "hola";
    }
    public function read(){
        $this->db->select('s.*', FALSE);
        $this->db->where('s.id', $this->uri->segment(3));
        $aux = current($this->db->get('stories s')->result());

        $nombre = $this->_urlFriendly($aux->title);
        redirect(base_url() . 'site/noticia/'.$nombre.'/' . $offset = $this->uri->segment(3));
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
                ".", '"', '“', '”'  ),
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
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
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
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
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