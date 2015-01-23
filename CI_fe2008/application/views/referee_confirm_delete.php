<div>
<p>Seguro que quieres borrar el referee <b><?=$this->uri->segment(4).' '.$this->uri->segment(5)?></b>?</p>
<?php 
echo form_open('referee/delete/'.$this->uri->segment(3));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>