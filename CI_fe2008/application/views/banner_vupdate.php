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
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('module_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row[0]->name ?>" />*</td></tr>
	<tr><td>Archivo:</td><td><input type="file" name="file" /></td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>Enlace:</td><td><input type="text" name="link" value="<?=$row[0]->link ?>" /></td></tr>
	<tr><td>Inicio:</td>
	<td><input type="text" name="start" value="<?=$row[0]->start ?>" readonly/>*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].start,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].start.value='';"></td></tr>
	<tr><td>F&iacute;n:</td>
	<td><input type="text" name="end"  value="<?=$row[0]->end ?>" readonly/>*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].end,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].end.value='';"></td></tr>
	<tr><td>C&oacute;digo:</td><td><input type="text" name="code"  value="<?=$row[0]->code ?>"/></td></tr>
	<tr><td>Ancho:</td><td><input type="text" name="width"  value="<?=$row[0]->width ?>"/>*</td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height"  value="<?=$row[0]->height ?>"/>*</td></tr>
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