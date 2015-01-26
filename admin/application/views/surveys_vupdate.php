<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/encuesta.png','border'=>'0')) ?> <?=anchor('surveys','Encuestas')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('surveys/update/'.$this->uri->segment(3));
	$row=current($query->result());
	echo form_hidden('id',$row->id);?>
	<table>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" value="<?=$row->title?>"/>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" value=/></td>
	<?php echo "</form>"?>
	<?php echo form_open('surveys');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>