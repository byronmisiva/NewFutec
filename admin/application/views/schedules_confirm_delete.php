<div>
<p>Seguro que quieres borrar la fecha <b><?=$this->uri->segment(5)?></b> de la ronda <b><?=$this->uri->segment(6)?></b>?</p>
<?php 
echo form_open('schedules/delete/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(7));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>