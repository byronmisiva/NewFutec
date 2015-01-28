<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/jugadoresxequipo.png','border'=>'0')) ?> <?=anchor('players_teams/index/'.$this->uri->segment(4),'Jugadores de Equipo')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('players_teams/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('team_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Jugador:</td>
	<td><select name="player_id">
		<?php foreach($query2->result() as $row2): ?>
			<option value="<?=$row2->id;?>"
			<?if($row2->id==$row[0]->player_id)
				echo "SELECTED";?>			
			><?=$row2->$row2->last_name." ".first_name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Fecha Ingreso:</td><td><input type="text" name="date_in" value="<?=$row[0]->date_in;?>"/>
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date_in,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].date_in.value='';"></td></tr>
	<tr><td>Fecha Salida:</td><td><input type="text" name="date_out" value="<?=$row[0]->date_out;?>"/>
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date.out,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].date.out.value='';"></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('players_teams/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>