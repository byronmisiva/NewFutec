<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('comments/index/'.$this->uri->segment(4),'Comentarios')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('comments/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);?>
	<table>
	<tr><td>Texto:</td>
	<td><textarea name="text" cols=20 rows=8><?=$row[0]->text ?></textarea>*</td></tr>
	<tr><td>Estado:</td>
	<td><select name="aproved">
		<option value=1
		<?php if($row[0]->aproved==1)
		echo " SELECTED"?>
		>Aprobado</option>
		<option value=0
		<?php if($row[0]->aproved==0)
		echo " SELECTED"?>
		>Desaprobado</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('comments/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>