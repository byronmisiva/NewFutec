<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/jugador.png','border'=>'0')) ?> <?=anchor('players','Jugadores')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('players/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
	$row=current($query->result());
	echo form_hidden('id',$row->id);?>
	<table>
		<tr>
			<td>Nombre:</td>
			<td colspan='2'><input type="text" name="first_name" value="<?=$row->first_name?>" />*</td>
		</tr>
		<tr>
			<td>Apellido:</td>
			<td colspan='2'><input type="text" name="last_name" value="<?=$row->last_name?>" />*</td>
		</tr>
		<tr>
			<td>Detalles:</td>
			<td colspan='2'><textarea name="details" rows=13 cols=20 ><?=$row->details?></textarea></td>
		</tr>
		<tr>
			<td>Fecha de Nacimiento:</td>
			<td>
				<input type="text" name="birth" value="<?=$row->birth?>" />*
				<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].birth,'yyyy/mm/dd',this,true)">
				<input type="button" value="Reset" onclick="document.forms[0].birth.value='';">
			</td>
			<td rowspan='6'> 
			<?=img("http://www.futbolecuador.com/".$row->thumb)?>
			</td>
		</tr>
			
		<tr>
			<td>Lugar de Nacimiento:</td>
			<td>
			<select name="born_place">
			<?foreach($countries->result() as $row2):?>
				<option value=<?=$row2->name?> <?php if($row->born_place==$row2->name) echo " SELECTED "?>><?=$row2->name?></option>
			<?endforeach;?>
			</select>	
			</td>

		</tr>		
			
		<tr>
			<td>Altura:</td>
			<td><input type="text" name="height" value="<?=$row->height?>" />cm *</td>
		</tr>
		<tr>
			<td>Posici&oacute;n:</td>
			<td>
				<select name="position">
				<option value="Arquero" <?php if($row->position=="Arquero") echo " SELECTED "?>>Arquero</option>
				<option value="Defensa" <?php if($row->position=="Defensa") echo " SELECTED "?>>Defensa</option>
				<option value="Volante" <?php if($row->position=="Volante") echo " SELECTED "?>>Volante</option>
				<option value="Delantero" <?php if($row->position=="Delantero") echo " SELECTED "?>>Delantero</option>
				</select>
			</td>
		</tr>	
		<tr>
			<td>Apodo:</td>
			<td><input type="text" name="nick" value="<?=$row->nick?>" /></td>
		</tr>
		
		<tr>
			<td>Precio:</td>
			<td><input type="text" name="price" value="<?=$row->price?>" />*</td>
		</tr>
		
		<tr>
			<td>L&iacute;mite:</td>
			<td><input type="text" name="stock" value="<?=$row->stock?>" />*</td></tr>
		<tr>
			<td>Imagen:</td>
			<td><input type="file" name="image" /></td>
		</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('players');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>