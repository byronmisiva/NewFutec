<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('index/index_v','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('stories','Historias')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php $row=$query->result(0);
	echo form_open('stories/update/'.$this->uri->segment(3));
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('author_id',13)?>
	<table>
	<tr><td>Categor&iacute;a:</td>
	<td><select name="category_id">
		<?php foreach($query2->result() as $row2): ?>
			<option value="<?=$row2->id;?>"
			<?if($row2->id==$row[0]->category_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" value="<?=$row[0]->title?>"/>*</td></tr>
	<tr><td>Subt&iacute;tulo:</td><td><input type="text" name="subtitle" value="<?=$row[0]->subtitle?>"/>*</td></tr>
	<tr><td>Introducci&oacute;n:</td>
	<td><textarea rows="8" cols="20" name="lead"><?=$row[0]->lead?></textarea>*</td></tr>
	<tr><td>Cuerpo:</td>
	<td><textarea rows="8" cols="20" name="body"><?=$row[0]->body?></textarea>*</td></tr>
	<tr><td>Imagen:</td>
	<td><select name="image_id">
		<?php foreach($query3->result() as $row3): ?> 
			<option value="<?=$row3->id;?>" 
			<?if($row3->id==$row[0]->image_id)
				echo "SELECTED";?>			
			><?=$row3->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Relacionado:</td><td><input type="text" name="related" value="<?=$row[0]->related?>"/>*</td></tr>
	<tr><td>Origen:</td><td><input type="text" name="origen" value="<?=$row[0]->origen?>"/>*</td></tr>
	

	<?php if($row[0]->invisible==1){?>
	<tr><td>Historia:</td>
	<td>
		<table>
		<tr><td>Visible:</td><td><?php echo form_radio('invisible', '1', TRUE );?></td></tr> 
		<tr><td>Invisible:</td><td><?php echo form_radio('invisible', '0');?></td></tr>
		</table>
	</td></tr>
	<?php }
	else{?>
	<tr><td>Historia:</td>
	<td>
		<table>
		<tr><td>Visible:</td><td><?php echo form_radio('invisible', '1');?></td></tr> 
		<tr><td>Invisible:</td><td><?php echo form_radio('invisible', '0', TRUE);?></td></tr>
		</table>
	</td></tr>
	<?php }?>


	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('stories/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>