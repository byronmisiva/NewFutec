<div>
<p>Seguro que quieres Borrar esta Transferencia ??</p>
<?php 
echo form_open('transfers/delete/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
echo form_hidden('id',$id);
echo form_submit('submit', 'Borrala!!'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
