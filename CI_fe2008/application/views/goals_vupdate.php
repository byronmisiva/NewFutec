<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/gol.png','border'=>'0')) ?> <?=anchor('goals/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5),'Acciones')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('goals/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<?php $row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('match_id',$this->uri->segment(4));
	echo form_hidden('team_id',$this->uri->segment(5))?>
	<table>
	<tr><td>Jugador:</td>
	<td><select name="player_id">
		<?php foreach($query2->result() as $row2): ?>
			<option value="<?=$row2->id;?>"
			<?if($row2->id==$row[0]->player_id)
				echo "SELECTED";?>			
			><?=$row2->first_name.' '.$row2->last_name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Minuto:</td><td><input type="text" name="minute" value="<?=$row[0]->minute?>"/>*</td></tr>
	<tr><td>Tipo:</td>
	<td><select name="type">
		<option value="1" 
			<?php if($row[0]->type==1)
					echo " SELECTED";?>
		>Normal</option>
		<option value="2" 
			<?php if($row[0]->type==2)
					echo " SELECTED";?>
		>Penal</option>
		<option value="3" 
			<?php if($row[0]->type==3)
					echo " SELECTED";?>
		>Autogol</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name='submit' value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('goals/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>	
	</table>
</div>