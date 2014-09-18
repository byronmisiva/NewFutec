<?php

class Noticias extends MY_Controller
{

    public $model = 'mdl_noticias';

    public function __construct()
    {
        parent::__construct();
    }

    public function viewNoticiasHome($data = FALSE)
    {
        $this->load->module('banners');
        $banners = array();
        $banners[] = $this->banners->FE_Bigboxnews1();
        $banners[] = $this->banners->FE_Bigboxnews2();
        $banners[] = $this->banners->FE_Bigboxnews3();
        $banners[] = $this->banners->FE_Bigboxnews4();

        $noticias = array();

        $noticias[] = $this->viewNoticia($data);

        $data['noticias'] = $noticias;
        $data['banners'] = $banners;
        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewNoticia ($data = FALSE)
    {
        return $this->load->view('noticiahomemini', $data, TRUE);
    }
}