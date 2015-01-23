<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/tarjeta.png','border'=>'0')) ?> <?=anchor('cards/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5),'Acciones')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('cards/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5))?>
	<?php $row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('match_id',$this->uri->segment(4));
	echo form_hidden('team_id',$this->uri->segment(5))?>
	<table>
	<tr><td>Jugador:</td>
	<td><select name="player_id">
		<?php foreach($query2->result() as $row2):?>
			<option value="<?=$row2->id;?>"
			<?if($row2->id==$row[0]->player_id)
				echo "SELECTED";?>>
			<?=$row2->first_name.' '.$row2->last_name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Minuto:</td><td><input type="text" name="minute" value="<?=$row[0]->minute?>"/>*</td></tr>
	<tr><td>Tipo:</td>
	<td><select>
		<option value=1
			<?php if ($row[0]->type==1)
			echo " SELECTED";?>
		>Amarilla</option>
		<option value=2
			<?php if ($row[0]->type==2)
			echo " SELECTED";?>
		>Roja</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name='submit' value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('cards/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>