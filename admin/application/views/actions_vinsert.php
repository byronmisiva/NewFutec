<?php
echo "<form action='".base_url()."matches_actions/actions_insert' id='add_accion' method='POST'> ";
echo form_input(array('name'=>'match_id','value'=>$this->uri->segment(3),'id'=>'match_id','type'=>'hidden'));

?>
<table class='listing' border=1>
	<tr><th>Acci&oacute;n:</th>
	<td><textarea id="text" name="text" cols="40" rows="10"><?=$this->session->flashdata('text')?></textarea>
	</td></tr>
	<tr><th>Tipo:</th>
	<td><select id="Atype" name="type">
		<option value="cambio">Cambio</option>
		<option value="falta">Falta</option>
		<option value="gol">Gol</option>
		<option value="penal">Penal</option>
		<option value="pitazo">Pitazo</option>
		<option value="tarjeta">Tarjeta</option>
		<option value="tipo">Tipo</option>
	</select></td></tr>
	<tr><th>Minuto:</th>
	<td><select id="match_time" name="match_time">
		<?php for($i=1;$i<121;$i+=1){
			  	echo '<option value='.$i.'>'.$i.'</option>';	
			  }
			  echo '<option value=135>Penales</option>';
		?>
	</select></td></tr>
</table>
<center><input type="button" name='submit' value="Ingreso" onCLick="actions_insert('<?=base_url();?>matches_actions/matches_table_view','<?=base_url();?>matches_actions/actions_insert','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>');" /></center>
<?php
echo "</form>";
?>