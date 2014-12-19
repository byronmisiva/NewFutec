<?php

class Matches extends MY_Controller
{

    public $model = 'mdl_matches';

    public function __construct()
    {
        parent::__construct();
    }

    public function matches($idSerie, $title)
    {
        $data['title'] = $title;

        $data['teamsFecha']=$this->mdl_matches->matches_all($idSerie);
        $data['teams_pics']=$this->mdl_matches->get_pics_teams($idSerie);

     //   $this->template->write_view('content', 'public/calendary_all', $data, FALSE);

       return $this->load->view('matches', $data, true);

    }


    public function getChampionship ($id) {
        $this->db->where('id',$id);
        return $this->db->get('championships');
    }


}
