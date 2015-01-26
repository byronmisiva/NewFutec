<div>
<p>Seguro que quieres Borrar esta Noticia ??</p>
<?php 
echo form_open('stories/delete/');
echo form_hidden('id',$id);
echo form_submit('submit', 'Borrala!!'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
