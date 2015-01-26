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
	<?php echo form_open_multipart('players/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="first_name" value="<?php echo set_value('first_name')?>"/>*</td></tr>
	<tr><td>Apellido:</td><td><input type="text" name="last_name" value="<?php echo set_value('last_name')?>"/>*</td></tr>
	<tr><td>Detalles:</td>
	<td><textarea name="details" rows=13 cols=20><?php echo set_value('details')?></textarea></td></tr>
	<tr><td>Fecha de Nacimiento:</td><td><input type="text" name="birth" value="<?php echo set_value('birth')?>" readonly>*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].birth,'yyyy/mm/dd',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].birth.value='';"></td></tr>
	<tr><td>Lugar de Nacimiento:</td>
	<td><select name="born_place">
		<?foreach($countries->result() as $row):?>
			<option value=<?=$row->name?> <?php if(set_value('born_place')==$row->name) echo " SELECTED "?>><?=$row->name?></option>
		<?endforeach;?>
	</select></td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height" value="<?php echo set_value('height')?>"/>*</td></tr>
	<tr><td>Posici&oacute;n:</td>
	<td><select name="position">
			<option value="Arquero" <?php if(set_value('position')=="Arquero") echo " SELECTED "?>>Arquero</option>
			<option value="Defensa" <?php if(set_value('position')=="Defensa") echo " SELECTED "?>>Defensa</option>
			<option value="Volante" <?php if(set_value('position')=="Volante") echo " SELECTED "?>>Volante</option>
			<option value="Delantero" <?php if(set_value('position')=="Delantero") echo " SELECTED "?>>Delantero</option>
	</select></td></tr>	
	<tr><td>Apodo:</td><td><input type="text" name="nick" value="<?php echo set_value('nick')?>"/></td></tr>
	<tr><td>Precio:</td><td><input type="text" name="price" />*</td></tr>
	<tr><td>L&iacute;mite:</td><td><input type="text" name="stock" />*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
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