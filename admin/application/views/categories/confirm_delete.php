<div>
<p>Seguro que quieres borrar esta Categoria ??</p>
<?php 
echo form_open('categories/delete/');
echo form_hidden('id',$id);
echo form_submit('submit', 'Borralo!!'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
