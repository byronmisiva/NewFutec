<div>
<p>Seguro que quieres borrar la encuesta <b><?=$this->uri->segment(5)?></b> de secci&oacute;n <b><?=$this->uri->segment(6)?></b>?</p>
<?php 
echo form_open('sections_surveys/delete/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>