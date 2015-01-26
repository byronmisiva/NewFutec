<div>
<p>Seguro que quieres Borrar este Blog ??</p>
<?php 
echo form_open('blogs/delete/');
echo form_hidden('id',$id);
echo form_submit('submit', 'Borrala!!'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
