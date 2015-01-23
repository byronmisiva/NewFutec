<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/arbitro.png','border'=>'0')) ?> <?=anchor('referee','&Aacute;rbitro')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('referee/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="first_name" value="<?php set_value('first_name')?>"/>*</td></tr>
	<tr><td>Apellido:</td><td><input type="text" name="last_name" value="<?php set_value('last_name')?>"/>*</td></tr>
	<tr><td>Fecha de Nacimiento:</td>
	<td><input type="text" name="birth" value="<?php set_value('birth')?>">*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].birth,'yyyy/mm/dd',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].birth.value='';"></td></tr>
	<tr><td>Lugar de Nacimiento:</td><td><input type="text" name="born_place" value="<?php set_value('born_place')?>"/>*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('referee/index');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>