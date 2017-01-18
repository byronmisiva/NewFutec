<?php
class Mdl_encuesta extends MY_Model{
	
	public $table_name = "lista_formacion";	
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

	public function __construct(){
		parent::__construct();		
	}
			
	function getEncuesta($id)
	{					 
		$query = $this->db->query('SELECT frm.player_id, frm.id,eq.first_name,eq.last_name,frm.imagen, 
				                          frm.posicion, voto, frm.checked
								   FROM lista_formacion AS frm, players as eq 
 	                               where eq.id=frm.player_id
								   and frm.encuesta_id='.$id);
		if ($query->num_rows() == 0){
			return NULL;
		}else{
			return $query->result();
		}				 			
	   }
	   
	function validarUsuario($mail){
		$query = $this->db->query("SELECT *
								   FROM registro_encuesta
 	                               where mail = '".$mail."'");
		if ($query->num_rows() == 0){
			return NULL;
		}else{
			return current($query->result());
		}
	}
	
	function registrarUsuario($datos){
		$query = $this->db->query("SELECT *
								   FROM registro_encuesta
 	                               where mail = '".$datos["mail"]."'");
		if ($query->num_rows() == 0){				
			if($this->db->insert("registro_encuesta",$datos))
				return $this->validarUsuario($datos["mail"]);
		}else{
			return current($query->result());
		}
	}

	function insertEncuesta($nombre,$team,$formacion){
	   $dato = array("nombre"=>$nombre,
	     	         "id_team"=>$team,
	   		 		 "formacion"=>$formacion,
	   				 "activo"=>"1",
	   				);
      	   $this->db->insert("encuesta_formacion",$dato);
	   return $this->db->insert_id();
	}
	
	function updateUserVotos($id,$lista){		
		$this->db->query("UPDATE registro_encuesta SET posicion=".json_encode($lista)." WHERE id = ".$id);
	}

	function getEncuestaActiva(){
	   	$query = $this->db->query('SELECT *
								   FROM encuesta_formacion
                                   where activo=1
	   							   order by creado desc	
	   							   limit 1');
	   	return current($query->result());
	}

	function getListaEquipo($id){
		$query = $this->db->query('SELECT first_name,last_name, player_id, team_id 
					   FROM fe2008.players_teams as eq, fe2008.players as pl 
					   WHERE eq.team_id='.$id.' and pl.id=eq.player_id order by first_name asc');
		return $query->result();
	}
	
    function sumVoto($id, $x){
	   	$query = $this->db->query('SELECT * FROM lista_formacion where id = '.$id);
	   	$resultado = current($query->result());	 
	   	$votos = (int)$resultado->voto;
	   	$votos = $votos + 1;	   	
	   	$this->db->query("UPDATE lista_formacion SET voto = ".$votos." WHERE id = ".$id);
	    switch ($x) {
		    case 1:
		        $pos = (int)$resultado->pos1;
	   			$pos = $pos + 1;
	   			$sql ="pos1 =".$pos;
		        break;
		    case 2:
		        $pos = (int)$resultado->pos2;
	   			$pos = $pos + 1;
	   			$sql ="pos2 =".$pos;
		        break;
		    case 3:
		        $pos = (int)$resultado->pos3;		        
	   			$pos = $pos + 1;
	   			$sql ="pos3 =".$pos;
		        break;
		    case 4:
		       	$pos = (int)$resultado->pos4;
	   			$pos = $pos + 1;
	   			$sql ="pos4 =".$pos;
		       	break;
		   case 5:
		       	$pos = (int)$resultado->pos5;
	   			$pos = $pos + 1;
	   			$sql ="pos5 =".$pos;
		       	break;
		    case 6:
		        $pos = (int)$resultado->pos6;
	   			$pos = $pos + 1;
	   			$sql ="pos6 =".$pos;
		        break;
		    case 7:
		        $pos = (int)$resultado->pos7;
	   			$pos = $pos + 1;
	   			$sql ="pos7 =".$pos;
		        break;
		    case 8:
		       	$pos = (int)$resultado->pos8;
	   			$pos = $pos + 1;
	   			$sql ="pos8 =".$pos;
		       	break;
		    case 9:
		       	$pos = (int)$resultado->pos9;
	   			$pos = $pos + 1;
	   			$sql ="pos9 =".$pos;
		       	break;
		    case 10:
		        $pos = (int)$resultado->pos10;
	   			$pos = $pos + 1;
	   			$sql ="pos10 =".$pos;
		        break;
		    case 11:
		       	$pos = (int)$resultado->pos11;
	   			$pos = $pos + 1;
	   			$sql ="pos11 =".$pos;
		       	break;
		}
	   	$this->db->query("UPDATE lista_formacion SET ".$sql." WHERE id = ".$id);
	   		
   }
   
   function sumRegistro($encuesta){
	   	$query = $this->db->query('SELECT * FROM encuesta_formacion where id = '.$encuesta);
	   	$resultado = current($query->result());	 
	   	$votos = (int)$resultado->total_votos;
	   	$votos = $votos + 1;	   	
	   	$this->db->query("UPDATE encuesta_formacion SET total_votos= ".$votos." WHERE id = 1");	
                return $votos;
	   }
	   
	 function getSumaEncuesta($opcion,$tabla){
	 	$query = $this->db->query('SELECT * FROM '.$tabla.' where active = 1');
	 	$resultado = current($query->result());
	 	if ($opcion == "1"){
	 		$votos = (int)$resultado->voto1;
	 		$votos = $votos + 1;
	 		$this->db->query("UPDATE ".$tabla." SET voto1= ".$votos." WHERE id = ".$resultado->id);
	 	}else{
	 		$votos = (int)$resultado->voto2;
	 		$votos = $votos + 1;
	 		$this->db->query("UPDATE ".$tabla." SET voto2= ".$votos." WHERE id = ".$resultado->id);
	 	}
	 	return $votos;
	 }  
	 
	 function getEncuestaTotal($opcion,$tabla){
	 	$query = $this->db->query('SELECT * FROM '.$tabla.' where active = 1');
	 	$resultado = current($query->result());
	 	if ($opcion == "1"){
	 		$votos = (int)$resultado->voto1;
	 	}else{
	 		$votos = (int)$resultado->voto2;
	 	}
	 	return $votos;
	 }

    function getNomina(){
	   $query = $this->db->query('SELECT frm.player_id, frm.id,eq.first_name,eq.last_name,frm.imagen , frm.posicion,voto, frm.checked
								   FROM lista_formacion AS frm, players as eq 
                                   where eq.id=frm.player_id
                                   order by frm.voto;');		
		return $query->result();			
	  }
	  
  function getLista($encuesta,$pos){
	   	$query = $this->db->query('SELECT frm.'.$pos.' as puntos, frm.player_id, frm.id,eq.first_name,eq.last_name,frm.imagen , frm.posicion,voto, frm.checked
								   FROM lista_formacion AS frm, players as eq
                                   where eq.id=frm.player_id
	   							   and frm.encuesta_id = '.$encuesta.'
	   							   order by frm.'.$pos.' desc
	   							   limit 1');
	   	return current($query->result());
	   }
	
}
