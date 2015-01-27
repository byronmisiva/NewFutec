<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
		<?php $this->upload->display_errors();?>
	</ul>
	</div>
	<?php echo form_open_multipart('images/update/'.$this->uri->segment(3));
	echo form_hidden('id',$row->id);?>
	<table>
	<tr><td></td><td style='padding-left: 10px;'><?=img(array('src'=>"http://www.futbolecuador.com/" .$row->thumb150,'border'=>'0'))?></td></tr>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row->name?>" />*</td></tr>
	<tr><td>Texto:</td><td><input type="text" name="text" value="<?=$row->text?>" />*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="original"  /></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('images');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>