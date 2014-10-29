<?php
class MY_Controller extends MX_Controller{
	
	public $model;

	function __construct() {
		parent::__construct();	
		if ( $this->model ){
			$this->load->model( $this->model );
		}	
		
	}
	
	function _check_exist( $where, $single = FALSE ){
		if ( $this->model ){
			$modelString = $this->model;
			return $this->$modelString->get_by( $where, $single );
		}
	}
	
	function _insert($data){
		$modelString = $this->model;
		return $this->$modelString->save( $data, $id = NULL);
	}
	
	function get( $params, $single = FALSE ){
		if ( $this->model ){
			$modelString = $this->model;			
			return $this->$modelString->get( $params, $single );		
		}		
	}
	
	function _update( $data, $id ){
		if ( $this->model ){
			$modelString = $this->model;	
			return $this->$modelString->save( $data, $id );
		}
	}


    function _clearfecha ($string) {
        $string = str_replace(
            array("Jun","Julio","jun", "jul", "Saturday",  "Sunday",
                "Monday", "Tuesday", "Wednesday", "Thursday", "Friday" ),
            array("Junio", "Julio","Junio", "Julio", "Sábado",  "Domingo",
                "Lunes", "Martes", "Miercoles", "Jueves", "Viernes" ),
            $string
        );
        return $string;
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
                "."),
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



    /*function get_where( $where, $single ){
        $modelString = $this->model;
        $query = $this->mdl_perfectcontroller->get_where($id);
        return $query;
    }



    function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_perfectcontroller');
        $query = $this->mdl_perfectcontroller->get_with_limit($limit, $offset, $order_by);
        return $query;
    }



    function get_where_custom($col, $value) {
        $this->load->model('mdl_perfectcontroller');
        $query = $this->mdl_perfectcontroller->get_where_custom($col, $value);
        return $query;
    }*/

	

	/*

	function _delete($id){
		$this->load->model('mdl_perfectcontroller');
		$this->mdl_perfectcontroller->_delete($id);
	}

	function count_where($column, $value) {
		$this->load->model('mdl_perfectcontroller');
		$count = $this->mdl_perfectcontroller->count_where($column, $value);
		return $count;
	}

	function get_max() {
		$this->load->model('mdl_perfectcontroller');
		$max_id = $this->mdl_perfectcontroller->get_max();
		return $max_id;
	}

	function _custom_query($mysql_query) {
		$this->load->model('mdl_perfectcontroller');
		$query = $this->mdl_perfectcontroller->_custom_query($mysql_query);
		return $query;
	}*/

}