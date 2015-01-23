<div>
<p>Seguro que quieres eliminar al jugador <b><?=$this->uri->segment(6).' '.$this->uri->segment(7)?></b> de la alineaci&oacute;n ?</p>
<?php 
echo form_open('lineups/delete/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
echo form_submit('submit', 'Borrar'); 
echo form_input(array('type' => 'button','value' => 'No, lo hagas!','onclick' => 'Modalbox.hide()'));
echo form_close();
?>
</div>