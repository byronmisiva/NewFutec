<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/perfiljugador.png','border'=>'0')) ?> <?=anchor('profiles/index/'.$this->uri->segment(4),'Perfiles')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('profiles/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('player_id',$this->uri->segment(4));?>
	<table>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" value="<?=$row[0]->title ?>"/>*</td></tr>
	<tr><td>Texto:</td>
	<td><textarea name="text" name="submit" cols=20 rows=8><?=$row[0]->text ?></textarea>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('profiles/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>