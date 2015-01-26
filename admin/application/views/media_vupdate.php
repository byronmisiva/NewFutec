<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/medio.png','border'=>'0')) ?> <?=anchor('media','Medios')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('media/update/'.$this->uri->segment(3));  
		  $row=$query->result(0);
		  echo form_hidden('id',$row[0]->id);?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row[0]->name?>" />*</td></tr>
	<tr><td>Tipo:</td>
	<td><select name="type">
		<option value=1 <?php if($row[0]->type==1) echo " SELECTED "?>>Podcast</option>
		<option value=2 <?php if($row[0]->type==2) echo " SELECTED "?>>Video</option>
	</select>*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="file" /></td></tr>
	<tr><td>Descripci&oacute;n:</td>
	<td><textarea cols="20" rows="8" name="description"><?=$row[0]->description?></textarea></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" value=/></td>
	<?php echo "</form>"?>
	<?php echo form_open('media');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>