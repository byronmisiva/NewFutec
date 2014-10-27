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
        setlocale(LC_ALL, "es_ES");
        $this->load->module('banners');
        $banners = array();
        $banners[] = $this->banners->FE_Bigboxnews1();
        $banners[] = $this->banners->FE_Bigboxnews2();
        $banners[] = $this->banners->FE_Bigboxnews3();
        $banners[] = $this->banners->FE_Bigboxnews4();
        $noticias = array();

        $rotativasData = $this->mdl_story->get_banner(6, 44);

        $listRotativas = array();
        foreach ($rotativasData as $rotativaData) {
            $listRotativas[] = $rotativaData->id;
        }

        $storys = $this->mdl_story->storys_by_tags ("",  RESULT_PAGE, $listRotativas);

        $test = $this->mdl_story->storys_by_tags ("serie a",  1);
        $test2= $this->mdl_story->storys_by_tags ("serie b",  1);
        $test3 = $this->mdl_story->storys_by_tags ("seleccion",  1);



        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        //intercalo entre las noticias los banners.
        array_splice($noticias, 5, 0, $banners[0]);
        array_splice($noticias, 12, 0, $banners[1]);
        array_splice($noticias, 17, 0, $banners[2]);
        array_splice($noticias, 25, 0, $banners[3]);
        $data['noticias'] = $noticias;


        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewNoticia($data = FALSE)
    {
        return $this->load->view('noticiahomemini', $data, TRUE);
    }

    public function viewmininewssidebar($namesection, $idsection, $posSection,  $data = FALSE)
    {
        $data['namesection'] = $namesection;
        $data['idsection'] = $idsection;
        $data['noticias'] = $this->mdl_noticias->get_by_position(NUMNEWSSIDE, $idsection, $posSection);
        return $this->load->view('mininewssidebar', $data, TRUE);
    }


}
