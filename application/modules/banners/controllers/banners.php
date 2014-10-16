<?php
class Banners extends MY_Controller
{

    public $model = 'mdl_banners';

    public function __construct()
    {
        parent::__construct();
    }

    public function top1($data = FALSE)
    {
        $data['FE_Halfbanner'] = $this->load->view('fe_halfbanner', $data, TRUE);
        $data['FE_Superbanner'] = $this->load->view('fe_superbanner', $data, TRUE);;
        return $this->load->view('top1', $data, TRUE);
    }
    public function FE_Bigboxbanner($data = FALSE)
    {
        return $this->load->view('fe_bigboxbanner', $data, TRUE);
    }
    public function FE_Megabanner($data = FALSE)
    {
        return $this->load->view('fe_megabanner', $data, TRUE);
    }

    public function FE_Bigboxnews1($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews1', $data, TRUE);
    }

    public function FE_Bigboxnews2($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews2', $data, TRUE);
    }
    public function FE_Bigboxnews3($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews3', $data, TRUE);
    }
    public function FE_Bigboxnews4($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews4', $data, TRUE);
    }
    public function FE_Bigboxnews5($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews5', $data, TRUE);
    }
    public function FE_Bigboxnews6($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews6', $data, TRUE);
    }

    //banner sidebar

    public function FE_BigboxSidebar1($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar1', $data, TRUE);
    }

    public function FE_BigboxSidebar2($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar2', $data, TRUE);
    }
    public function FE_BigboxSidebar3($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar3', $data, TRUE);
    }
    public function FE_BigboxSidebar4($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar4', $data, TRUE);
    }
    public function FE_BigboxSidebar5($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar5', $data, TRUE);
    }
    public function FE_BigboxSidebar6($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar6', $data, TRUE);
    }

    //fin banners sidebar

    public function FE_overlaybanner($data = FALSE)
    {
        return $this->load->view('fe_overlaybanner', $data, TRUE);
    }
    public function FE_interstitial($data = FALSE)
    {
        return $this->load->view('fe_interstitial', $data, TRUE);
    }
    public function FE_Skyscraper1($data = FALSE)
    {
        return $this->load->view('fe_skyscraper1', $data, TRUE);
    }
    public function FE_Skyscraper2($data = FALSE)
    {
        return $this->load->view('fe_skyscraper2', $data, TRUE);
    }


}