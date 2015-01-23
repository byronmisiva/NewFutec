<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/jugadoresxequipo.png','border'=>'0')) ?> <?=anchor('players_teams/index/'.$this->uri->segment(3),'Jugadores de Equipo')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('players_teams/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('team_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Jugador:</td>
	<td><select name="player_id">
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>"><?=$row->last_name." ".$row->first_name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Fecha Ingreso:</td><td><input type="text" name="date_in" />
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date_in,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].date_in.value='';"></td></tr>
	<tr><td>Fecha Salida:</td><td><input type="text" name="date_out" />
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date_out,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].date_out.value='';"></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('players_teams/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>