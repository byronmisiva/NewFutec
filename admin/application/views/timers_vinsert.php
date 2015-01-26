	<h1><?php echo $title.' '.$heading?></h1>
	<?php echo form_open('timers/timers_insert')?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('match_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Acci&oacute;n:</td>
	<td><select name="action">
			<option value=1>Play</option>
			<option value=0>Stop</option>
	</select></td></tr>
	<tr><td>Tiempo de Juego:</td>
	<td><select name="play_time">
			<option value=1>Primero</option>
			<option value=2>Segundo</option>
			<option value=3>Extra 1</option>
			<option value=4>Extra 2</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('timers/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>