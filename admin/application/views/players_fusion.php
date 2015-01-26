<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/jugador.png','border'=>'0')) ?> <?=anchor('players','Jugadores')?></li>
    </ul>
	</div>
	<br>
	<?php echo form_open('players/fusion_players')?>
	<table>
	
	<tr><td>Jugador 1:</td>
	<td><select name="player1">
	<?php foreach($query->result() as $row):?>
	<option value="<?=$row->id?>" <?php if(set_value('player1')==$row->id) echo " SELECTED "?>><?=$row->last_name.' '.$row->first_name?></option>
	<?php endforeach;?>
	</select></td></tr>
	
	<tr><td>Jugador 2:</td>
	<td><select name="player2">
	<?php foreach($query->result() as $row):?>
	<option value="<?=$row->id?>" <?php if(set_value('player2')==$row->id) echo " SELECTED "?>><?=$row->last_name.' '.$row->first_name?></option>
	<?php endforeach;?>
	</select></td></tr>
	
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('players');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>