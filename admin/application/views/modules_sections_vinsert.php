<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modulossecciones.png','border'=>'0')) ?> <?=anchor('modules_sections/index/'.$this->uri->segment(3),'Modulos de Secci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	<?php echo form_open('modules_sections/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('section_id',$this->uri->segment(3))?>
	<table>
	<tr>
		<td>Sección:</td>
		<td><?=$section->name;?></td>
	</tr>
	<tr><td>M&oacute;dulo:</td>
	<td><?php echo form_dropdown('module_id', $modules, set_value('module_id'));?></td></tr>
	<tr>
		<td>Bloque:</td>
		<td><?php echo form_dropdown('block', $blocks, set_value('block'));?></td>
	</tr>
	<tr><td></td>
	<td>
	<?=form_radio('visible', 1,set_radio('visible', '1',TRUE));?>Visible<br>
	<?=form_radio('visible', 0,set_radio('visible', '0'));?>Invisible
	</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('modules_sections/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>