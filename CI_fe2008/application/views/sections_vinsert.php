<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/seccion.png','border'=>'0')) ?> <?=anchor('sections','Secciones')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('sections/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name"   value="<?php echo set_value('name'); ?>"/> *</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image"  /></td></tr>
	<tr><td>Encabezado:</td>
	<td><select name="header_id">
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>"
			<?php if(set_value('header_id')==$row->id) echo " SELECTED "?>
			><?=$row->name;?></option>
		<?php endforeach;?>
	</select> *</td></tr>
	<tr><td>Campeonato:</td>
	<td><select name="championship_id">
		<option value="">ninguno</option>
		<?php foreach($query2->result() as $row): ?> 
			<option value="<?=$row->id;?>"
			<?php if(set_value('championship_id')==$row->id) echo " SELECTED "?>
			><?=$row->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Equipo:</td>
	<td><select name="team_id">
		<option value="">ninguno</option>
		<?php foreach($query3->result() as $row): ?> 
			<option value="<?=$row->id;?>"
			<?php if(set_value('team_id')==$row->id) echo " SELECTED "?>
			><?=$row->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Categor&iacute;a:</td>
	<td><select name="category_id">
		<option value="">ninguno</option>
		<?php foreach($query4->result() as $row): ?> 
			<option value="<?=$row->id;?>"
			<?php if(set_value('category_id')==$row->id) echo " SELECTED "?>
			><?=$row->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr>
		<td>Encuesta:</td>
		<td><?php echo form_dropdown('survey_id', $surveys, set_value('survey_id'));?></td>
	</tr>
	<tr><td>Wap:</td>
	<td><select name="wap">
		<option value="0"
			<?php if(set_value('wap')==0) echo " SELECTED "?>
		>NO</option>
		<option value="1"
			<?php if(set_value('wap')==1) echo " SELECTED "?>
		>SI</option>
	</select></td></tr>
	<tr><td>Rss:</td>
	<td><select name="rss">
		<option value="0"
			<?php if(set_value('rss')==0) echo " SELECTED "?>
		>NO</option>
		<option value="1"
			<?php if(set_value('rss')==1) echo " SELECTED "?>
		>SI</option>
	</select></td></tr>
	<tr><td>Imagen Rss:</td><td><input type="file" name="image_rss"  /></td></tr>
	<tr><td>Descripci&oacute;n:</td><td><input type="text" name="description"  value="<?php echo set_value('description'); ?>" /></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('sections');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>