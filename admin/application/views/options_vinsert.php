<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')) ?> <?=anchor('options/index/'.$this->uri->segment(3),'Opciones')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('options/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('survey_id',$this->uri->segment(3))?>
	<table>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" />*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('options/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>