<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('rounds/index/'.$this->uri->segment(3),'Rondas')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('rounds/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('championship_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?php echo set_value('name'); ?>"/>*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>Anterior:</td>
	<td><select name="last">
			<option value="">ninguno</option>
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('last')==$row->id) echo " SELECTED "?> ><?=$row->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('rounds/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>
