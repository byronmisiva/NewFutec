<?php
class Videos extends MY_Controller{

    //public $model = 'mdl_grupos';
    public $model = FALSE;

    public function __construct(){
        parent::__construct();
    }

    function view(){
        return $this->load->view ("videosOpen", FALSE, TRUE );
    }

    function viewVideosHeader(){
        return $this->load->view ("videosheader", FALSE, TRUE );
    }
}