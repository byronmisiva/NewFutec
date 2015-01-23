<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('rounds/index/'.$this->uri->segment(4),'Rondas')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('rounds/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));	
	echo form_hidden('id',$query->id);
	echo form_hidden('championship_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$query->name ?>" />*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>Anterior:</td>
	<td><select name="last">
		<option value="">ninguno</option>
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>"
			<?php if($row2->id==$query->last)
				  echo "SELECTED"?>
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name='submit' value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('rounds/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>