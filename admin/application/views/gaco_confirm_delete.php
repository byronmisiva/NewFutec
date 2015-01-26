<div>
<p>Seguro que quieres borrar gaco <b><?=$this->uri->segment(3)?></b>?</p>
<?php 
echo form_open('matches/delete_gaco/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>