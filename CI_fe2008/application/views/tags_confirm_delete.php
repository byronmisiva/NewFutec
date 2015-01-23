<div>
<p>Seguro que quieres borrar el tag <b><?=$this->uri->segment(4)?></b>?</p>
<?php 
echo form_open('tags/delete/'.$this->uri->segment(3));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
