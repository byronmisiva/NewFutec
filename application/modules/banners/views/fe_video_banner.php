<?php
/*****/
/*
 * Donde 0 Teads, 1 netsonic, 2 Futbolecuador
 */
$turno = rand(0, 1);
//$turno = 2;
if ($turno == "0"){
	$this->load->view('fe_video_teads');
}else if ($turno == "1"){
	$this->load->view('fe_video_netsonic');
}else if ($turno == "2"){
	$this->load->view('fe_video_futbolecuador');
}
?>




