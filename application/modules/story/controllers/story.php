<?php
class Story extends MY_Controller
{

    public $model = 'mdl_story';

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
}