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
        $storys=$this->mdl_story->storys_by_tags();
        foreach ($storys as $story){
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        //intercalo entre las noticias los banners.
        array_splice($noticias, 5, 0, $banners[0]);
        array_splice($noticias, 12 , 0, $banners[1]);
        array_splice($noticias, 17, 0, $banners[2]);
        array_splice($noticias, 25, 0, $banners[3]);
        $data['noticias'] = $noticias;


        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewNoticia ($data = FALSE)
    {
        return $this->load->view('noticiahomemini', $data, TRUE);
    }
}
