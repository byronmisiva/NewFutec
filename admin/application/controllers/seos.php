<?php
class Seos extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('seo','model');
    }

    function sitemap(){

        // secciones de la pagina
        $data['seccions']=$this->model->get_seccions();

        // secciones dinamicas de la pagina
        $data['stories']=$this->model->get_all_stories();
        $data['tags']=$this->model->get_all_tags();

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap", $data);
    }
    function sitemap_news(){
        $data['stories']=$this->model->get_stories_news();

        //get_tags_storie();

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemapnews", $data);
    }
}