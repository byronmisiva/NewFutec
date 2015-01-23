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
	<?php echo form_open('stories/insert')?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('author_id',13)?>
	<table>
	<tr><td>Categor&iacute;a:</td>
	<td><select name="category_id">
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>"
				<?php if(set_value('category_id')==$row->id) echo " SELECTED "?>
			><?=$row->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>T&iacute;tulo:</td><td><input type="text" name="title" value="<?php echo set_value('title')?>"/>*</td></tr>
	<tr><td>Subt&iacute;tulo:</td><td><input type="text" name="subtitle" value="<?php echo set_value('subtitle')?>"/>*</td></tr>
	<tr><td>Introducci&oacute;n:</td>
	<td><textarea rows="8" cols="20" name="lead"><?php echo set_value('lead')?></textarea>*</td></tr> 
	<tr><td>Cuerpo:</td>
	<td><textarea rows="8" cols="20" name="body"><?php echo set_value('body')?></textarea>*</td></tr>
	<tr><td>Imagen:</td>
	<td><select name="image_id">
		<option value="">ninguno</option>
		<?php foreach($query2->result() as $row): ?> 
			<option value="<?=$row->id;?>"
				<?php if(set_value('image_id')==$row->id) echo " SELECTED "?>
			><?=$row->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Relacionado:</td><td><input type="text" name="related" value="<?php echo set_value('related')?>"/>*aaaaa</td></tr>
	<tr><td>Origen:</td><td><input type="text" name="origen" value="<?php echo set_value('origen')?>"/>*</td></tr>	
	<?php if(set_value('invisible')==1){?>
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
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('stories/index/');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>