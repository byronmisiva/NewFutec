<div>
<p>Seguro que quieres borrar esta instantanea?</p>
<?php 
echo form_open('flashes/delete/'.$this->uri->segment(3));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
