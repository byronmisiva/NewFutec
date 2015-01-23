<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('transfers/index/'.$this->uri->segment(4),'Transferencias')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('transfers/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->row();
	echo form_hidden('id',$row->id);
	echo form_hidden('championship_id',$this->uri->segment(4));?>
	
	<table>
	<tr><td>Desde:</td><td><select name="team_id_from">
			<option value=''>ninguno</option>
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" <?php if($row->team_id_from==$row2->id) echo " SELECTED "?> ><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	
	<tr><td>Hacia:</td><td><select name="team_id_to">
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" <?php if($row->team_id_to==$row2->id) echo " SELECTED "?> ><?=$row2->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr><td>Jugador:</td><td><select name="player_id">
		<?php foreach($query3->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" <?php if($row->player_id==$row2->id) echo " SELECTED "?> ><?=$row2->last_name.' '.$row2->first_name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr><td>Ronda:</td>
	<td><select name="round_id">
		<?php foreach($query4->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" <?php if($row->round_id==$row2->id) echo " SELECTED "?> ><?=$row2->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr><td>Estado:</td>
	<td><select name="status">
		<option value="1" <?php if($row->status=='1') echo " SELECTED "?> >Cancelada</option>
		<option value="4" <?php if($row->status=='4') echo " SELECTED "?> >Completada</option>
		<option value="3" <?php if($row->status=='3') echo " SELECTED "?> >Posible</option>
		<option value="2" <?php if($row->status=='2') echo " SELECTED "?> >Rumor</option>  
	</select>*</td></tr>
	
	</table>
	
	<table>
	<tr><td><input type="submit" name='submit' value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('transfers/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>