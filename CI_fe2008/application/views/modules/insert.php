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
	<?php echo form_open('modules/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" value="<?php echo set_value('title')?>"/>*</td></tr>
	<tr><td></td>
	<td>
	<?=form_radio('active', 1,set_radio('active', '1',TRUE));?>Activado<br>
	<?=form_radio('active', 0,set_radio('active', '0'));?>Desactivado
	</td></tr>
	<tr><td></td>
	<td>
	<?=form_radio('visible', 1,set_radio('visible', '1',TRUE));?>Visible<br>
	<?=form_radio('visible', 0,set_radio('visible', '0'));?>Invisible
	</td></tr>

	<tr>
		<td>Funcion:</td>
		<td><?php echo form_dropdown('function', $functions, set_value('function'));?></td>
	</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('modules');?>
	<td><input type="submit" value="Cancelar"></td>
	<?php echo "</form>"?>
	</table>
</div>