<?php

class Surveys extends MY_Controller
{

    public $model = 'mdl_surveys';

    public function __construct()
    {
        parent::__construct();
    }

    public function encuesta_formulario($data = FALSE)
    {

        $ultimaEncuesta = $this->mdl_surveys->get_last_survey();
        $data['survey'] = $ultimaEncuesta[0];
        $data['options'] = $this->mdl_surveys->get_survey_options($data['survey']->id);

        return $this->load->view('encuesta_formulario', $data, TRUE);
    }

    public function encuesta_resultado($data = FALSE)
    {

        $ultimaEncuesta = $this->mdl_surveys->get_last_survey();
        $data['survey'] = $ultimaEncuesta[0];
        $data['options'] = $this->mdl_surveys->get_survey_options($data['survey']->id);

        $total = 0;
        foreach ($data['options'] as $option){
            $total +=    $option->votes;
        }

        foreach ($data['options'] as $orden => $option){
            $porcentaje = round($data['options'][$orden]->votes * 100 / $total, 0 );
            $data['options'][$orden]->porcentaje = $porcentaje;
        }
        $this->load->view('encuesta_resultado', $data);
    }

}