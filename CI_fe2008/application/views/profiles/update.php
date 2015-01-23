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
	<?php echo form_open_multipart('profiles/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('player_id',$this->uri->segment(4));?>
	<table>
	<tr>
		<td class='required'>*</td>
		<td>T&iacute;tulo:</td>
		<td><input type="text" name="title" value="<?=$row[0]->title ?>" size='70' maxlength="65"/></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Texto:</td>
		<td><textarea name="text" cols=20 rows=8><?=$row[0]->text ?></textarea></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Recuadro (230x190):</td>
		<td><input type="file" name="picture_box" size='60' /></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Foto 1:</td>
		<td><input type="file" name="picture1" size='60' /></td>
	</tr>
	<tr>
		<td class='required'></td>
		<td>Foto 2:</td>
		<td><input type="file" name="picture2" size='60' /></td>
	</tr>
	<tr>
		<td class='required'></td>
		<td>Foto 3:</td>
		<td><input type="file" name="picture3" size='60' /></td>
	</tr>
	<tr>
		<td colspan=3>
		<br />
		<img src="<?=base_url().$row[0]->picture_box; ?>" border="1" width="100" height="100" alt="picture_box" title="Imagen Recuadro" style="padding:2px;" />
		<img src="<?=base_url().$row[0]->picture1; ?>" border="1" width="100" height="100" alt="picture1" title="Foto 1" style="padding:2px;" />
		<img src="<?=base_url().$row[0]->picture2; ?>" border="1" width="100" height="100" alt="picture2" title="Foto 2" style="padding:2px;" />
		<img src="<?=base_url().$row[0]->picture3; ?>" border="1" width="100" height="100" alt="picture3" title="Foto 3" style="padding:2px;" />
		</td>
	</tr>
	</table>
	<br />
	
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('profiles/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>