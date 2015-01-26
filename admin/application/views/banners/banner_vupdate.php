<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/banners.png','border'=>'0')) ?> <?=anchor('banners/index/'.$this->uri->segment(4),'Banners')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('banners/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query;
	echo form_hidden('id',$row->id);
	echo form_hidden('module_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row->name ?>" />*</td></tr>
	<tr><td>Archivo:</td><td><input type="file" name="file" /></td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>Enlace:</td><td><input type="text" name="link" value="<?=$row->link ?>" /></td></tr>
	<tr><td>Inicio:</td>
	<td><input type="text" name="start" value="<?=$row->start ?>" readonly/>*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].start,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].start.value='';"></td></tr>
	<tr><td>F&iacute;n:</td>
	<td><input type="text" name="end"  value="<?=$row->end ?>" readonly/>*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].end,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].end.value='';"></td></tr>
	<tr><td>C&oacute;digo:</td><td><textarea name='code' id='code' rows="4" cols="50" class='tinyNoEditor'><?=$row->code ?></textarea></td></tr>
	<tr><td>Ancho:</td><td><input type="text" name="width"  value="<?=$row->width ?>"/>*</td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height"  value="<?=$row->height ?>"/>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('banners/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>