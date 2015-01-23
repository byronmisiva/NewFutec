<div>
<p>Seguro que quieres borrarlo ??</p>
<?php 
echo form_open('users/delete/');
echo form_hidden('id',$user_id);
echo form_submit('submit', 'Borralo!!'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>
