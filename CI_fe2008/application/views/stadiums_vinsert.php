<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','estadio'=>'0')) ?> <?=anchor('stadiums','Estadios')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('stadiums/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?php echo set_value('name')?>"/>*</td></tr>
	<tr><td>Capacidad:</td><td><input type="text" name="capacity" value="<?php echo set_value('capacity')?>"/>*</td></tr>
	<tr><td>Ciudad:</td><td><input type="text" name="city" value="<?php echo set_value('city')?>"/>*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height" value="<?php echo set_value('height')?>"/>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /> </td>
	<?php echo "</form>"?>
	<?php echo form_open('stadiums');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>