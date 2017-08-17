<?php

class Banners extends MY_Controller
{

    public $model = 'mdl_banners';

    public function __construct()
    {
        parent::__construct();
    }
    
    function banner_video_der($data = FALSE){
    	return $this->load->view('fe_video_inferior', $data, TRUE);
    }
    
    function fe_expandible_noticia($data = FALSE){
    	return $this->load->view('fe_expandible_noticia', $data, TRUE);
    }

    public function top1($data = FALSE)
    {
        $data['FE_Halfbanner'] = $this->load->view('fe_cocafm', $data, TRUE);
        /*if (CHAMP_DEFAULT == 63 ){
        	$this->load->module('contenido');
        	$data['marcador'] = $this->contenido->marcadorHeader();
        }*/
        $data['FE_Superbanner'] = $this->load->view('fe_superbanner', $data, TRUE) ;
        return $this->load->view('top1', $data, TRUE);
    }

    public function topStory($data = FALSE)
    {
        $data['FE_Halfbanner'] = $this->load->view('fe_cocafm', $data, TRUE);
        $data['FE_Superbanner'] = $this->load->view('fe_superbanner', $data, TRUE) . $this->load->view('fe_superbanner_passback', $data, TRUE);
        return $this->load->view('top1', $data, TRUE);
    }

    public function FE_Bigboxbanner($data = FALSE)
    {
        return $this->load->view('fe_bigboxbanner', $data, TRUE);
    }

    public function fe_mobile_intertisial($data = FALSE)
    {
        return $this->load->view('fe_banner_intertisial', $data, TRUE);
    }

    public function FE_Megabanner($data = FALSE)
    {
        return $this->load->view('fe_megabanner', $data, TRUE);
    }

    public function FE_Bigboxnews1($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews1', $data, TRUE);
    }
	/*union layer*/
    public function fe_union($data = FALSE)
    {	
    	return $this->load->view('union/fe_nissa', $data);
    }
    
    public function fe_union2($data = FALSE)
    {
    	return $this->load->view('union/fe_s8', $data);
    }

    public function fe_union3($data = FALSE)
    {
    	return $this->load->view('union/fe_kia', $data);
    }

    public function fe_union4($data = FALSE)
    {
    	return $this->load->view('union/fe_kia_sport', $data);
    }

    public function fe_union_ford($data = FALSE)
    {
    	return $this->load->view('union/fe_ford', $data);
    }

     public function anuncio_alertas($data = FALSE)
    {
    	return $this->load->view('anuncio_alertas', $data, TRUE);
    }
    
    public function fe_noticia_patrocinada($data = FALSE)
    {
    	return $this->load->view('fe_noticia_patrocinada', $data, TRUE);
    }
    
	public function fe_cinta_copa($data = FALSE)
    {
    	return $this->load->view('fe_cinta_copa', $data, TRUE);
    }
    
    public function fe_square_copa($data = FALSE)
    {
    	return $this->load->view('fe_square_copa', $data, TRUE);
    } 


    public function FE_desplegable_movil($data = FALSE)
    {
        return $this->load->view('fe_desplegable_movil', $data, TRUE);
    }
    
    public function fe_desplegable_movil_tap_tap($data = FALSE)
    {
    	return $this->load->view('fe_tap__tap_home', $data, TRUE);
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
    public function FE_Skyscraper_de($data = FALSE)
    {
        return $this->load->view('fe_skyscraper_de', $data, TRUE);
    }

    public function FE_Skyscraper_iz($data = FALSE)
    {
        return $this->load->view('fe_skyscraper_iz', $data, TRUE);
    }

    public function fe_smart_bottom($data = FALSE)
    {
        return $this->load->view('fe_smart_bottom', $data, TRUE);
    }

    public function fe_smart_top($data = FALSE)
    {
        return $this->load->view('fe_smart_top', $data, TRUE);
    }
    public function fe_smart_bottom_internas($data = FALSE)
    {
        return $this->load->view('fe_smart_bottom_internas', $data, TRUE);
    }

    public function fe_smart_top_internas($data = FALSE)
    {
        return $this->load->view('fe_smart_top_internas', $data, TRUE);
    }

    public function fe_skin($data = FALSE)
    {
        return $this->load->view('fe_skin', $data, TRUE);
    }


    public function fe_cocafm($data = FALSE)
    {
        return "";
        //return $this->load->view('fe_cocafm', $data, TRUE);
    }

    public function fe_loading_movil($data = FALSE)
    {
        return $this->load->view('fe_loading_movil', $data, TRUE);
    }

    public function fe_splash($data = FALSE)
    {
        return $this->load->view('fe_splash', $data, TRUE);
    }

    //// copa america banners
    public function fe_brand_header($data = FALSE)
    {
        return $this->load->view('fe_brand_header', $data, TRUE);
    }

    public function fe_hp_brand($data = FALSE)
    {
        return $this->load->view('fe_hp_brand', $data, TRUE);
    }

    public function top_copaamerica($data = FALSE)
    {
        $data['FE_Halfbanner'] = $this->load->view('fe_cocafm', $data, TRUE);
        //$data['FE_Halfbanner'] = $this->load->view('fe_halfbanner', $data, TRUE);
        $data['FE_Superbanner'] = $this->load->view('fe_superbanner_copaamerica', $data, TRUE);
        return $this->load->view('top1', $data, TRUE);
    }

    public function fe_skin_copaamerica($data = FALSE)
    {
        return $this->load->view('fe_skin_copaamerica', $data, TRUE);
    }

    public function fe_header($data = FALSE)
    {
    	
        return $this->load->view('fe_header', $data, TRUE);
    }

    public function fe_amazon($data = FALSE)
    {
        return $this->load->view('fe_amazon', $data, TRUE);
    }

    public function fe_taboola($data = FALSE)
    {
        return $this->load->view('fe_taboola', $data, TRUE);
    }

    // fin copa america banners

    public function fe_header_copa_america($data = FALSE)
    {
        return $this->load->view('fe_header_copa_america', $data, TRUE);
    }


    public function dpaSportsLive($data = FALSE)
    {
        return $this->load->view('dpasportslive', $data, TRUE);
    }

    public function dpaSportsLiveMovil($data = FALSE)
    {
        return $this->load->view('dpasportslivemovil', $data, TRUE);
    }

    public function dpaSportsLiveFrame($data = FALSE)
    {
        return $this->load->view('dpasportsliveiframe', $data, TRUE);
    }

    public function dpaSportsLiveFrameMovil($data = FALSE)
    {
        return $this->load->view('dpasportsliveframemovil', $data, TRUE);
    }

    public function fe_smart_bottom_copa_america($data = FALSE)
    {
        return $this->load->view('fe_smart_bottom_copa_america', $data, TRUE);
    }

    public function fe_smart_top_copa_america($data = FALSE)
    {
        return $this->load->view('fe_smart_top_copa_america', $data, TRUE);
    }

    public function fe_loading_movil_copa_america($data = FALSE)
    {
        return $this->load->view('fe_loading_movil_copa_america', $data, TRUE);
    }

    public function FE_Bigboxnews1_copa_america($data = FALSE)
    {
        return $this->load->view('fe_bigboxnews1_copa_america', $data, TRUE);
    }

    public function FE_BigboxSidebar1_copaamerica($data = FALSE)
    {
        return $this->load->view('fe_bigboxsidebar1_copaamerica', $data, TRUE);
    }

    public function fe_video_banner($data = FALSE)
    {
    	return $this->load->view('fe_video_banner', $data, TRUE);
    }
    
    public function fe_splash_g13($data = FALSE)
    {
    	return $this->load->view('fe_splash_g13.php', $data, TRUE);
    }
    

    public function fe_netsonic_tv($data = FALSE)
    {
        return $this->load->view('fe_netsonic_tv', $data, TRUE);
    }
    
    

    public function fe_netsonic_home($data = FALSE)
    {
        return $this->load->view('fe_netsonic_home', $data, TRUE);
    }

    public function fe_new_filmstrip_banner($data = FALSE)
    {
        return $this->load->view('fe_new_filmstrip_banner', $data, TRUE);
    }


    public function fe_superbanner_passback($data = FALSE)
    {
        // agencia externa tempormente inhabilitado
        return $this->load->view('fe_superbanner_passback', $data, TRUE);
    }

    public function fe_intext($data = FALSE)
    {
        return $this->load->view('fe_intext', $data, TRUE);
    }


}
