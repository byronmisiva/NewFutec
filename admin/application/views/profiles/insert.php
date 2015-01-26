<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/perfiljugador.png','border'=>'0')) ?> <?=anchor('profiles/index/'.$this->uri->segment(3),'Perfil')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open_multipart('profiles/insert/'.$this->uri->segment(3));?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('player_id',$this->uri->segment(3))?>
	<table cellpadding="2" cellspacing="2">
		<tr>
			<td class='required'>*</td>
			<td>T&iacute;tulo:</td>
			<td><input type="text" name="title" value="<?php echo set_value('title')?>" size='70' maxlength="65"/></td>
		</tr>
		<tr>
			<td class='required'>*</td>
			<td>Texto:</td>
			<td><textarea name="text" cols=20 rows=8><?php echo set_value('text')?></textarea></td>
		</tr>
		<tr>
			<td class='required'>*</td>
			<td>Recuadro (230x190): </td>
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
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('profiles/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>