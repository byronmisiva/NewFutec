<?php

class Galerias extends MY_Controller
{

    public $model = "mdl_galerias";


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function viewGaleriaHome($data = FALSE)
    {
        $this->load->helper('date');
        $datestring = "%Y-%m-%d";
        $time = time();
        $fechaActual = mdate($datestring, $time);

        $foldername = "home";

        $this->load->module('galerias');
        $this->load->module('imagenes');


        $galeria = $this->galerias->get(array('select' => '*', 'where' => array('nombre' => 'Galeria - ' . $foldername)), TRUE);
        //$last = $this->db->last_query();
        if (count($galeria) > 0) {
            $imagenes = $this->imagenes->get(array('select' => '*', 'where' => array('galerias_id' => $galeria->id), 'limit' => "9"));

            $data['galeria'] = (array)$galeria;
            $data['imagenes'] = (array)$imagenes;
            return $this->load->view('galeria', $data, TRUE);

        }
    }


    public function viewGaleriasFull($data = FALSE)
    {
        $this->load->helper('date');
        $datestring = "%Y-%m-%d";
        $time = time();
        $fechaActual = mdate($datestring, $time);

        $foldername = "home";

        $this->load->module('galerias');
        $this->load->module('imagenes');

        $galeria = $this->galerias->get(array('select' => '*', 'like' => array('nombre' => 'Galeria')));
        $cont = 0;
        $datosGalerias = array();
        foreach ($galeria as $gal) {
            $imagenes = $this->imagenes->get(array('select' => '*', 'where' => array('galerias_id' => $gal->id), 'limit' => "16"));
            $datosGalerias[$cont] = array(
                "id_Galeria" => $gal->id,
                "nombre" => $gal->nombre,
                'imagenes' => $imagenes
            );
            $cont++;
        }

        $data['galerias'] = $datosGalerias;
        return $this->load->view('view_galeria_full', $data, TRUE);

    }


    function syncGaleriasDiarias()
    {
        $this->load->helper('date');
        $datestring = "%Y-%m-%d";
        $time = time();
        $fechaActual = mdate($datestring, $time);


        $imagenes = $this->imagenesDirectorio($fechaActual);
        $this->data_model($imagenes, $fechaActual);

        //$imagenes=$this->imagenesDirectorio("home");
        //$this->data_model($imagenes, "home");

    }

    public function data_model($imagenes, $foldername)
    {

        $this->load->helper('date');
        $this->load->module('galerias');
        $this->load->module('imagenes');
        $subDiarios = SITE_HARD_ROOT_FILE . "imagenes/galeriasdiarias/" . $foldername;
        $destino = strtolower('imagenes/galeriasdiarias/' . $foldername) . '/';
        /*$this->load->helper('date');
        $datestring = "%Y-%m-%d";
        $time = time();
        $fechaActual=mdate($datestring, $time);*/


        //Creo la galeria para el estadio
        if (!$this->galerias->_check_exist(array('nombre' => 'Galeria - ' . $foldername))) {
            $galeria = array('nombre' => 'Galeria - ' . $foldername, 'publico' => 0);
            $galeria['id'] = $this->galerias->_insert($galeria, NULL, FALSE);
        } else {
            $galeria['id'] = $this->galerias->_check_exist(array('nombre' => 'Galeria - ' . $foldername), TRUE)->id;
        }

        //Borro la imagen previamente en la base para volverla a ingresar
        $this->mdl_imagenes->delete(array('galerias_id' => $galeria['id']), TRUE);

        //Borro archivo fisico del servidor por si hay reemplazos o eliminacion, nuevas fotos
        $this->imagenes->_deleteFolder($destino . "main");
        $this->imagenes->_deleteFolder($destino . "thumb250");
        $this->imagenes->_deleteFolder($destino . "visu");

        //numero de imagenes x carpeta actual
        $numImagenes = count($imagenes);
        $fotos = 1;

        for ($i = 0; $i < $numImagenes; $i++) {
            $mystring = $imagenes[$i];
            //separo los archivos de imagen con los de los nombres de las posibles carpetas
            if ($mystring != ".DS_Store" && $mystring != ".." && $mystring != "." && $mystring != "main" && $mystring != "thumb250" && $mystring != "visu") {

                $pos1 = strpos($mystring, 'jpg');
                $pos2 = strpos($mystring, 'jpeg');
                // Nótese el uso de ===. Puesto que == simple no funcionará como se espera
                // porque la posición de 'a' está en el 1° (primer) caracter.
                if (!$pos1 || !$pos2) {
                    $this->galerias->syncFotosGalery($mystring, array(
                            'origen' => $subDiarios . '/', //origen
                            'galerias_id' => $galeria['id'], // id galeria
                            'destino' => strtolower('imagenes/galeriasdiarias/' . $foldername) . '/', //destino
                            'titulo' => 'Galeria - ' . $foldername . ' - ' . $fotos // nombre de la foto
                        )
                    );
                    $fotos++;
                }
            }
        }

    }

    public function imagenesDirectorio($foldername)
    {
        $directorios = SITE_HARD_ROOT_FILE . "imagenes/galeriasdiarias/" . $foldername;
        $imagenesCarpetaDiarios = scandir($directorios, 1);
        return $imagenesCarpetaDiarios;
    }


    public function syncFotosGalery($node = "", $imageDetails = array('origen' => '', 'galerias_id' => '', 'titulo' => '', 'modulo' => '', 'equipo_id' => ''))
    {

        $this->load->module('imagenes');
        $imagen = array('descripcion' => '', 'main' => '', 'ftp_main' => '', 'thumb250' => '', 'ftp_thumbnail' => '', 'visu' => '', 'ftp_visu' => '');
        $imagenName = $node; // Nombre de la imagen sin path
        $imagen['descripcion'] = $imageDetails['titulo'];


        //Chequeo que la imagen no exista
        //Recorro todos los componentes de la imagen

        if (!$this->imagenes->_check_exist(array('nombre' => $imageDetails['titulo']))) {

            $this->imagenes->_createFolder($imageDetails['destino'] . "main/");


            if ($this->imagenes->_copyFileFromDiskGalery($imageDetails['origen'] . $imagenName, $imageDetails['destino'] . "main/" . $imagenName)) { //Extraigo la imagen del ftp y la copio en el server
                $imagen['main'] = base_url($this->imagenes->_clearString(str_replace(" ", "-", $imageDetails['destino'] . "main/" . $imagenName)));
                $imagen['ftp_main'] = '';
                $imagen['thumbnail'] = '';
                $thumb250 = $this->imagenes->_resize_image($imagenName, $imageDetails['destino'] . "main/" . $imagenName, $imageDetails['destino'] . 'thumb250/', '250');
                $imagen['thumb250'] = base_url($this->_clearString(str_replace(" ", "-", $thumb250)));
                $imagen['ftp_thumbnail'] = '';
                $visu = $this->imagenes->_resize_image($imagenName, $imageDetails['destino'] . "main/" . $imagenName, $imageDetails['destino'] . "visu/", '500');
                $imagen['visu'] = base_url($this->_clearString(str_replace(" ", "-", $visu)));
                $imagen['ftp_visu'] = '';

            }

            //Inserto los datos de las imagenes
            $imagen['galerias_id'] = $imageDetails['galerias_id'];
            $imagen['nombre'] = ($imageDetails['titulo'] != "") ? $imageDetails['titulo'] : $imagenName;
            $this->mdl_imagenes->save($imagen, NULL, FALSE);

        }

    }

}