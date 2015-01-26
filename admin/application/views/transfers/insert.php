<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('transfers/index/'.$this->uri->segment(3),'Transferencias')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('transfers/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('championship_id',$this->uri->segment(3))?>
	<table>
	
	<tr><td>Desde:</td><td><select name="team_id_from">
			<option value=''>ninguno</option>
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('team_id_from')==$row->id) echo " SELECTED "?> ><?=$row->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	
	<tr><td>Hacia:</td><td><select name="team_id_to">
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('team_id_to')==$row->id) echo " SELECTED "?> ><?=$row->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr><td>Jugador:</td><td><select name="player_id">
		<?php foreach($query2->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('player_id')==$row->id) echo " SELECTED "?> ><?=$row->last_name.' '.$row->first_name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr><td>Ronda:</td>
	<td><select name="round_id">
		<?php foreach($query3->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('round_id')==$row->id) echo " SELECTED "?> ><?=$row->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr><td>Estado:</td>
	<td><select name="status">
		<option value="1" <?php if(set_value('round_id')=='1') echo " SELECTED "?> >Cancelada</option>
		<option value="4" <?php if(set_value('round_id')=='4') echo " SELECTED "?> >Completada</option>
		<option value="3" <?php if(set_value('round_id')=='3') echo " SELECTED "?> >Posible</option>
		<option value="2" <?php if(set_value('round_id')=='2') echo " SELECTED "?> >Rumor</option>  
	</select>*</td></tr>
	
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('transfers/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>
