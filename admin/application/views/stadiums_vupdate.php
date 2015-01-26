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
	<?php echo form_open_multipart('stadiums/update/'.$this->uri->segment(3));
		  $row=current($query->result());
		  echo form_hidden('id',$row->id);?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row->name?>"/>*</td></tr>
	<tr><td>Capacidad:</td><td><input type="text" name="capacity" value="<?=$row->capacity?>" />*</td></tr>
	<tr><td>City:</td><td><input type="text" name="city" value="<?=$row->city?>"/>*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height" value="<?=$row->height?>" />*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('stadiums');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>