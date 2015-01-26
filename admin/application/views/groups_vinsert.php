<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/grupoequipo.png','border'=>'0')) ?> <?=anchor('groups/index/'.$this->uri->segment(3),'Grupos')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('groups/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('round_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?php echo set_value('name')?>"/>*</td></tr>
	<tr><td>Descripci&oacute;n:</td><td><input type="text" name="description" value="<?php echo set_value('description')?>"/></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('groups/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>