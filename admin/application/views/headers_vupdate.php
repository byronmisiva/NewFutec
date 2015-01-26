<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/encabezados.png','border'=>'0')) ?> <?=anchor('headers','Encabezados')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('headers/update/'.$this->uri->segment(3));  
	 	  $row=$query->result(0);
		  echo form_hidden('id',$row[0]->id);?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row[0]->name?>" />*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="file" /></td></tr>
	<tr><td>Ancho:</td><td><input type="text" name="width" value="<?=$row[0]->width?>"/></td></tr>
	<tr><td>Altura:</td><td><input type="text" name="height" value="<?=$row[0]->height?>"/></td></tr>
	<tr><td>Descripci&oacute;n:</td><td><input type="text" name="description" value="<?=$row[0]->description?>"/></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" value=/></td>
	<?php echo "</form>"?>
	<?php echo form_open('headers');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>