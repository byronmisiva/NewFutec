<?php

class Noticias extends MY_Controller
{

    public $model = 'mdl_noticias';

    public function __construct()
    {
        parent::__construct();
    }


    public function viewNoticiasHome($totalMiniNews = RESULT_PAGE, $data = FALSE)
    {
        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }


        setlocale(LC_ALL, "es_ES");
        $this->load->module('banners');
        $this->load->module('story');
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
        $storys = $this->mdl_story->storys_by_tags("", $totalMiniNews, $listRotativas);

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $dataStory['isMobile'] = $isMobile;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        //intercalo entre las noticias los banners.
        if ($totalMiniNews > 10) {
            array_splice($noticias, 5, 0, $banners[0]);
            array_splice($noticias, 12, 0, $banners[1]);
            array_splice($noticias, 17, 0, $banners[2]);
            //array_splice($noticias, 25, 0, $banners[3]);
        } else {
            if ($totalMiniNews > 2) {
                array_splice($noticias, 5, 0, $banners[0]);
            }
            if ($totalMiniNews > 10) {

                array_splice($noticias, 12, 0, $banners[1]);
            }
        }
        $data['noticias'] = $noticias;


        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewNoticias($totalMiniNews = RESULT_PAGE, $data = FALSE)
    {
        setlocale(LC_ALL, "es_ES");
        $this->load->module('banners');
        $this->load->module('story');
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
        $storys = $this->mdl_story->storys_by_tags("", $totalMiniNews, $listRotativas);

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        //intercalo entre las noticias los banners.
        if ($totalMiniNews > 10) {
            array_splice($noticias, 5, 0, $banners[0]);
            array_splice($noticias, 12, 0, $banners[1]);
            array_splice($noticias, 17, 0, $banners[2]);
            array_splice($noticias, 25, 0, $banners[3]);
        } else {
            array_splice($noticias, 5, 0, $banners[0]);
            array_splice($noticias, 12, 0, $banners[1]);
        }
        $data['noticias'] = $noticias;

        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewSeccions($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $data = FALSE)
    {
        setlocale(LC_ALL, "es_ES");
        $this->load->module('banners');

        $banners = array();
        $banners[] = $this->banners->FE_Bigboxnews1();
        $banners[] = $this->banners->FE_Bigboxnews2();
        $banners[] = $this->banners->FE_Bigboxnews3();
        $banners[] = $this->banners->FE_Bigboxnews4();
        $noticias = array();

        $data['idsection'] = $idsection;
        $storys = $this->mdl_noticias->get_by_position($totalMiniNews, $idsection, $posSection);

        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        //intercalo entre las noticias los banners.
        if ($totalMiniNews > 10) {
            array_splice($noticias, 5, 0, $banners[0]);
            array_splice($noticias, 12, 0, $banners[1]);
            array_splice($noticias, 17, 0, $banners[2]);
            if ($totalMiniNews > 25)
                array_splice($noticias, 25, 0, $banners[3]);
        } else {
            if ($totalMiniNews > 5)
                array_splice($noticias, 5, 0, $banners[0]);

            if ($totalMiniNews > 12)
                array_splice($noticias, 12, 0, $banners[1]);
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;
        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewSeccionsEquipo($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $data = FALSE)
    {
        setlocale(LC_ALL, "es_ES");
        $noticias = array();

        $data['idsection'] = $idsection;
        $storys = $this->mdl_noticias->get_by_position($totalMiniNews, $idsection, $posSection);

        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $key => $story) {
            $dataStory['story'] = $story;
            if ($key == 0) {
                $noticias[] = $this->viewNoticia($dataStory);
            } else {
                $noticias[] = $this->viewNoticiaNano($dataStory);
            }
        }

        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;
        return $this->load->view('noticiasequipo', $data, TRUE);
    }

    public function viewseccion_plus($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $data = FALSE)
    {
        setlocale(LC_ALL, "es_ES");
        $this->load->module('banners');

        $banners = array();
        $banners[] = $this->banners->FE_Bigboxnews1();
        $banners[] = $this->banners->FE_Bigboxnews2();
        $banners[] = $this->banners->FE_Bigboxnews3();
        $banners[] = $this->banners->FE_Bigboxnews4();
        $noticias = array();

        $data['idsection'] = $idsection;

        $storys = $this->mdl_story->get_plus($totalMiniNews);

        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }

        //intercalo entre las noticias los banners.
        //intercalo entre las noticias los banners.
        if ($totalMiniNews > 10) {
            array_splice($noticias, 5, 0, $banners[0]);
            array_splice($noticias, 12, 0, $banners[1]);
            array_splice($noticias, 17, 0, $banners[2]);
            if ($totalMiniNews > 25)
                array_splice($noticias, 25, 0, $banners[3]);
        } else {
            if ($totalMiniNews > 5)
                array_splice($noticias, 5, 0, $banners[0]);

            if ($totalMiniNews > 12)
                array_splice($noticias, 12, 0, $banners[1]);
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;
        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewNoticia($data = FALSE)
    {
        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $data['isMobile'] = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $data['isMobile'] = true;
        }
        return $this->load->view('noticiahomemini', $data, TRUE);
    }

    public function viewNoticiaNano($data = FALSE)
    {
        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $data['isMobile'] = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $data['isMobile'] = true;
        }
        return $this->load->view('noticiahomenano', $data, TRUE);
    }


    public function viewmininewssidebar($namesection, $idsection, $posSection, $nameSectionUrl, $data = FALSE)
    {
        $data['namesection'] = $namesection;
        $data['idsection'] = $idsection;
        $data['nameSectionUrl'] = $nameSectionUrl;
        $data['noticias'] = $this->mdl_noticias->get_by_position(NUMNEWSSIDE, $idsection, $posSection);
        return $this->load->view('mininewssidebar', $data, TRUE);
    }

    public function viewNewsSection($namesection, $idsection, $posSection, $data = FALSE)
    {
        $data['namesection'] = $namesection;
        $data['idsection'] = $idsection;
        $data['noticias'] = $this->mdl_noticias->get_by_position(NUMNEWSSIDE, $idsection, $posSection);
        return $this->load->view('mininewssidebar', $data, TRUE);
    }
}
