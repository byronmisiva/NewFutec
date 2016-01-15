<?php

class Noticias extends MY_Controller
{

    public $model = 'mdl_noticias';

    public function __construct()
    {
        parent::__construct();
    }

    //parametros
    //mostrarBanner indica si muestra los banners en las noticias
    //totalMiniNews total de noticias a mostrar
    //offset desplazamiento en las noticias

    public function viewNoticiasHome($mostrarBanner = true, $totalMiniNews = RESULT_PAGE, $offset = 0, $data = FALSE, $intermediaBanner = "", $finalmediaBanner = "")
    {
        //$this->output->cache(CACHE_DEFAULT);
        $this->load->library('user_agent');

        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $isMobile = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $isMobile = true;
        }


        setlocale(LC_ALL, "es_ES");
        $this->load->module('story');
        $noticias = array();

        $rotativasData = array();

        if ((!$this->uri->segment(1)) or ($this->uri->segment(2) != "mobil")) {
            $rotativasData = $this->mdl_story->get_banner(6, 44);
            $excluded = array();
            foreach ($rotativasData as $key => $row) {
                $excluded[] = $row->id;
                $rotativasData[$key]->sponsored = false;
            }
            //ponemos en caso de existir la noticia ZONA FE
            //recupera  y cambia por la ultima noticia
            $sponsor = current($this->mdl_story->get_zonafe($excluded));
            $sponsor->id = $sponsor->sid;

            if ($sponsor !== FALSE) {
                array_pop($rotativasData);
                array_push($rotativasData, $sponsor);
            }
        }

        if (count($rotativasData) > 0) {
            $listRotativas = array();
            foreach ($rotativasData as $rotativaData) {
                $listRotativas[] = $rotativaData->id;
            }
        } else {
            $listRotativas = '';
        }
        $storys = $this->mdl_story->storys_by_tags("", $totalMiniNews, $listRotativas, $offset);

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $dataStory['isMobile'] = $isMobile;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        if ($mostrarBanner) {
            //intercalar banners
            $this->load->module('banners');
            $banners = array();
            $banners[] = $this->banners->FE_Bigboxnews1();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }
        $data['noticias'] = $noticias;
        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = "";
        $data['posSection'] = "";
        $data['intermediaBanner'] = $intermediaBanner;
        $data['finalmediaBanner'] = $finalmediaBanner;

        $data['namesection'] = '';


        return $this->load->view('noticiashome', $data, TRUE);
    }


    public function viewNoticias($mostrarBanner = true, $totalMiniNews = RESULT_PAGE, $offset = 0, $data = FALSE)
    {

        setlocale(LC_ALL, "es_ES");
        $this->load->module('story');
        $noticias = array();

        $rotativasData = $this->mdl_story->get_banner(6, 44);

        $listRotativas = array();
        foreach ($rotativasData as $rotativaData) {
            $listRotativas[] = $rotativaData->id;
        }

        $storys = $this->mdl_story->storys_by_tags("", $totalMiniNews, $listRotativas, $offset);

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }

        if ($mostrarBanner) {
            //intercalar banners
            $this->load->module('banners');
            $banners = array();
            $banners[] = $this->banners->FE_Bigboxnews1();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }

        $data['noticias'] = $noticias;
        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = "";
        $data['posSection'] = "";
        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewTagsList($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $offset = 0, $mostrarBanner = true, $data = FALSE)
    {
        //$this->output->cache(CACHE_DEFAULT);
        setlocale(LC_ALL, "es_ES");
        $noticias = array();

        $data['idsection'] = $idsection;


        $this->load->module('story');

        // se hace llamado por el tag

        $storys = $this->mdl_story->news_by_tagsList($idsection, TOTALNEWSINDONBALON, 0);


        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        if ($mostrarBanner) {
            //intercalar banners
            $this->load->module('banners');
            $banners = array();
            $banners[] = $this->banners->FE_Bigboxnews1();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;

        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = trim($idsection);
        $data['posSection'] = $posSection;

        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewTags($namesection, $tags, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $offset = 0, $mostrarBanner = true, $data = FALSE, $idNoticia = false)
    {
        //$this->output->cache(CACHE_DEFAULT);
        setlocale(LC_ALL, "es_ES");
        $noticias = array();

        $data['idsection'] = $tags;

        $this->load->module('story');

        // se hace llamado por el tag

        if ($tags == '')
            return '';
        else
            $storys = $this->mdl_story->news_by_tags($tags, $totalMiniNews, 0, $idNoticia);

        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->load->view('noticiarelacionada', $dataStory, TRUE);
        }
        if ($mostrarBanner) {
            //intercalar banners
            $this->load->module('banners');
            $banners = array();
            $banners[] = $this->banners->FE_Bigboxnews1();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;

        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = trim($tags);
        $data['posSection'] = $posSection;


        return $this->load->view('noticiasrelacionadas', $data, TRUE);
    }

    public function viewSeccions($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $offset = 0, $mostrarBanner = true, $data = FALSE, $excluded = "")
    {
        //$this->output->cache(CACHE_DEFAULT);
        setlocale(LC_ALL, "es_ES");
        $noticias = array();

        $data['idsection'] = $idsection;
        $storys = $this->mdl_noticias->get_by_position($totalMiniNews, $idsection, $posSection, $offset, $excluded);


        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        if ($mostrarBanner) {
            //intercalar banners
            $this->load->module('banners');
            $banners = array();

            //todo cambio copa america
            if ($urlSeccion != "copaamerica")
                $banners[] = $this->banners->FE_Bigboxnews1();
            else
                $banners[] = $this->banners->FE_Bigboxnews1();
            //$banners[] = $this->banners->FE_Bigboxnews1_copa_america();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;

        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = trim($idsection);
        $data['posSection'] = $posSection;

        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewSeccionsSingle($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $offset = 0, $mostrarBanner = true, $data = FALSE)
    {
        //$this->output->cache(CACHE_DEFAULT);
        setlocale(LC_ALL, "es_ES");
        $noticias = array();

        $data['idsection'] = $idsection;
        $storys = $this->mdl_noticias->get_by_position($totalMiniNews, $idsection, $posSection, $offset);


        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;

            $noticias[] = $this->viewNoticiaRevista($dataStory);

        }

        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;

        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = trim($idsection);
        $data['posSection'] = $posSection;

        return $this->load->view('noticiasrevista', $data, TRUE);
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

    public function viewseccion_plus($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $offset = 0, $mostrarBanner = true, $data = FALSE)
    {

        setlocale(LC_ALL, "es_ES");

        $noticias = array();

        $data['idsection'] = $idsection;

        $storys = $this->mdl_story->get_plus($totalMiniNews, $offset);

        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }

        //intercalo entre las noticias los banners.
        if ($mostrarBanner) {
            $this->load->module('banners');

            //intercalar banners
            $this->load->module('banners');
            $banners = array();
            $banners[] = $this->banners->FE_Bigboxnews1();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;
        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = trim($idsection);
        $data['posSection'] = $posSection;
        return $this->load->view('noticiashome', $data, TRUE);
    }

    public function viewNoticia($data = FALSE)
    {

        $this->load->library('user_agent');
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
        //$this->output->cache(CACHE_DEFAULT);
        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $data['isMobile'] = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $data['isMobile'] = true;
        }
        return $this->load->view('noticiahomenano', $data, TRUE);
    }

    public function viewNoticiaRevista($data = FALSE)
    {
        //$this->output->cache(CACHE_DEFAULT);
        $mobiles = array('Apple iPhone', 'Generic Mobile', 'SymbianOS');
        $data['isMobile'] = false;
        if ($this->agent->is_mobile()) {
            $m = $this->agent->mobile();
            if (in_array($m, $mobiles))
                $data['isMobile'] = true;
        }
        return $this->load->view('noticiahomerevista', $data, TRUE);
    }


    public function viewmininewssidebar($namesection, $idsection, $posSection, $nameSectionUrl, $data = FALSE)
    {
        //$this->output->cache(CACHE_DEFAULT);
        $data['namesection'] = $namesection;
        $data['idsection'] = $idsection;
        $data['nameSectionUrl'] = $nameSectionUrl;
        $data['noticias'] = $this->mdl_noticias->get_by_position(NUMNEWSSIDE, $idsection, $posSection);
        return $this->load->view('mininewssidebar', $data, TRUE);
    }

    public function viewNewsSection($namesection, $idsection, $posSection, $data = FALSE)
    {
        //$this->output->cache  (CACHE_DEFAULT);
        $data['namesection'] = $namesection;
        $data['idsection'] = $idsection;
        $data['noticias'] = $this->mdl_noticias->get_by_position(NUMNEWSSIDE, $idsection, $posSection);
        return $this->load->view('mininewssidebar', $data, TRUE);
    }


    public function copaamericaviewSeccions($namesection, $idsection, $posSection, $urlSeccion = "", $totalMiniNews = RESULT_PAGE, $offset = 0, $mostrarBanner = true, $data = FALSE, $excluded = "")
    {
        //$this->output->cache(CACHE_DEFAULT);
        setlocale(LC_ALL, "es_ES");
        $noticias = array();

        $data['idsection'] = $idsection;
        $storys = $this->mdl_noticias->get_by_position($totalMiniNews, $idsection, $posSection, $offset, $excluded);


        $dataStory['tipoLink'] = "secction";

        $dataStory['urlsecction'] = $urlSeccion;

        foreach ($storys as $story) {
            $dataStory['story'] = $story;
            $noticias[] = $this->viewNoticia($dataStory);
        }
        if ($mostrarBanner) {
            //intercalar banners
            $this->load->module('banners');
            $banners = array();
            $banners[] = $this->banners->FE_Bigboxnews1();
            $banners[] = $this->banners->FE_Bigboxnews2();
            $banners[] = $this->banners->FE_Bigboxnews3();
            $banners[] = $this->banners->FE_Bigboxnews4();
            $banners[] = $this->banners->FE_Bigboxnews5();
            //intercalo entre las noticias los banners.
            if ($totalMiniNews > 10) {
                array_splice($noticias, 5, 0, $banners[0]);
                array_splice($noticias, 10, 0, $banners[1]);
                array_splice($noticias, 17, 0, $banners[2]);
                array_splice($noticias, 22, 0, $banners[3]);
                array_splice($noticias, 29, 0, $banners[4]);
            } else {
                if ($totalMiniNews > 2) {
                    array_splice($noticias, 5, 0, $banners[0]);
                }
                if ($totalMiniNews > 10) {

                    array_splice($noticias, 12, 0, $banners[1]);
                }
            }
            //fin intercalar banners
        }
        $data ['namesection'] = $namesection;
        $data['noticias'] = $noticias;

        $data['offset'] = $totalMiniNews + $offset;
        $data['idsection'] = trim($idsection);
        $data['posSection'] = $posSection;

        return $this->load->view('noticiashome', $data, TRUE);
    }

}
