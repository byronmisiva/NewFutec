<?php
class Videos extends MY_Controller{
    public $model = 'mdl_videos';
    public function __construct(){
        parent::__construct();
    }

    function view(){
        $videos = $this->mdlvideos->getAllVideosByFecha();
        return $this->load->view ("videosOpen", FALSE, TRUE );
    }
    // el video en cada una de las paginas
 

    function viewVideosHeader(){
        $videos = $this->db->query('SELECT * FROM videos WHERE UNIX_TIMESTAMP(ADDTIME(inicia,"2:00:0")) <= UNIX_TIMESTAMP(now()) AND typo = "partido" ORDER BY inicia DESC   ');
        $listadovideos = $videos->result();
        $data['listadovideos']=$listadovideos;

        $goles = $this->db->query('SELECT * FROM videos WHERE inicia <= NOW() AND typo = "goles" AND visible = 1 ORDER BY inicia');
        $listadogoles = $goles->result();
        $data['listadogoles']=$listadogoles;


        $videoVivo = $this->db->query('SELECT  *  FROM videos WHERE UNIX_TIMESTAMP(SUBTIME(inicia,"0:30:0"))  <= UNIX_TIMESTAMP( NOW())  AND UNIX_TIMESTAMP(NOW()) <= UNIX_TIMESTAMP(ADDTIME(inicia,"3:00:0"))
                                    AND typo = "partido" AND visible = 1  ORDER BY inicia DESC LIMIT 1' );

        $videoVivoSecond = $this->db->query('SELECT  *  FROM videos WHERE UNIX_TIMESTAMP(SUBTIME(inicia,"0:30:0"))  <= UNIX_TIMESTAMP( NOW())  AND UNIX_TIMESTAMP(NOW()) <= UNIX_TIMESTAMP(ADDTIME(inicia,"2:00:0"))
                                    AND typo = "partido" AND visible = 2  ORDER BY inicia DESC LIMIT 1' );

        /* $videoVivo = $this->db->query('SELECT  id, smelyn, inicia  FROM videos WHERE UNIX_TIMESTAMP(SUBTIME(inicia,"0:20:0"))  <= UNIX_TIMESTAMP(SUBTIME(NOW(),"2:35:00"))  AND UNIX_TIMESTAMP(SUBTIME(NOW(),"2:35:00")) <= UNIX_TIMESTAMP(ADDTIME(inicia,"2:00:0"))
        AND typo = "partido" AND visible = 1  ORDER BY inicia DESC LIMIT 1' );*/

        $listadovideoVivo = $videoVivo->result();
        $data['listadovideoVivo']=$listadovideoVivo;

        $listadovideoVivoSecond = $videoVivoSecond->result();
        $data['listadovideoVivoSecond']=$listadovideoVivoSecond;



        return $this->load->view ("videosheader", $data, TRUE );
    }
    // listado de videos si se hace click  en uno de ellos
    public function viewVideosHome( $data = FALSE ){
        $this->load->helper('date');
        $datestring = "%Y-%m-%d";
        $time = time();
        $fechaActual=mdate($datestring, $time);

        $foldername=$fechaActual;

        $this->load->module( 'galerias' );
        $this->load->module( 'imagenes' );

        $galeria= $this->galerias->get( array('select'=>'*', 'where'=>array( 'nombre' => 'Galeria - '.$foldername )),TRUE);
        $imagenes= $this->imagenes->get( array('select'=>'*', 'where'=>array('galerias_id'=>$galeria->id), 'limit'=>"9"));

        $data['galeria']=(array)$galeria;
        $data['imagenes']=(array)$imagenes;
        return $this->load->view( 'galeria', $data, TRUE );

    }

    public function viewVideosFull( $data = FALSE ){
        $this->load->helper('date');

        $videos = $this->db->query('SELECT * FROM videos WHERE inicia <= NOW() AND typo = "partido" AND visible = 1 ORDER BY inicia');
        $listadovideos = $videos->result();
        $data['listadovideos']=$listadovideos;


         $videoVivo = $this->db->query('SELECT   * FROM videos WHERE UNIX_TIMESTAMP(SUBTIME(inicia,"0:20:0"))  <= UNIX_TIMESTAMP( NOW())  AND UNIX_TIMESTAMP(NOW()) <= UNIX_TIMESTAMP(ADDTIME(inicia,"2:00:0"))
                                        AND typo = "partido" AND visible = 1  ORDER BY inicia DESC LIMIT 1' );

   /* $videoVivo = $this->db->query('SELECT  *  FROM videos WHERE UNIX_TIMESTAMP(SUBTIME(inicia,"0:20:0"))  <= UNIX_TIMESTAMP(SUBTIME(NOW(),"3:35:00"))  AND UNIX_TIMESTAMP(SUBTIME(NOW(),"3:35:00")) <= UNIX_TIMESTAMP(ADDTIME(inicia,"2:00:0"))
        AND typo = "partido" AND visible = 1  ORDER BY inicia DESC LIMIT 1' );*/

        $listadovideoVivo = $videoVivo->result();
        $data['listadovideoVivo']=$listadovideoVivo;


        $goles = $this->db->query('SELECT * FROM videos WHERE inicia <= NOW() AND typo = "goles" AND visible = 1 ORDER BY inicia');
        $listadogoles = $goles->result();
        $data['listadogoles']=$listadogoles;



        return $this->load->view( 'view_videos_full', $data, TRUE );
    }
}