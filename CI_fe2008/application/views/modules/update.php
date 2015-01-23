<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modulo.png','border'=>'0')) ?> <?=anchor('modules','Modulos')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php 
	echo form_open('modules/update/'.$this->uri->segment(3));
	echo form_hidden('id',$row->id);?>
	<table>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" value="<?=$row->title?>"/>*</td></tr>
	<tr><td></td>
	<td>
	<?=form_radio('active', 1,($row->active==1)?TRUE:FALSE);?>Activado<br>
	<?=form_radio('active', 0,($row->active==0)?TRUE:FALSE);?>Desactivado
	</td></tr>
	<tr><td></td>
	<td>
	<?=form_radio('visible', 1,($row->visible==1)?TRUE:FALSE);?>Visible<br>
	<?=form_radio('visible', 0,($row->visible==0)?TRUE:FALSE);?>Invisible
	</td></tr>
	<tr>
		<td>Funcion:</td>
		<td><?php echo form_dropdown('function', $functions, $row->function);?></td>
	</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" value=/></td>
	<?php echo "</form>"?>
	<?php echo form_open('modules');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>