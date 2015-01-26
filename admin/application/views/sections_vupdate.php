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
	<?php echo form_open_multipart('sections/update/'.$this->uri->segment(3));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$row[0]->name ?>" />*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr> 
	<tr><td>Encabezado:</td>
	<td><select name="header_id">
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->header_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Campeonato:</td>
	<td><select name="championship_id">
		<option value="">ninguno</option>
		<?php foreach($query3->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->championship_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Equipo:</td>
	<td><select name="team_id">
		<option value="">ninguno</option>
		<?php foreach($query4->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->team_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr><td>Categor&iacute;a:</td>
	<td><select name="category_id">
		<option value="">ninguno</option>
		<?php foreach($query5->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->category_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	<tr>
		<td>Encuesta:<?=$survey->survey_id?></td>
		<td><?php echo form_dropdown('survey_id', $surveys, $survey->survey_id);?></td>
	</tr>
	<tr><td>Wap</td>
	<td><select name="wap">
		<option value="0">NO</option>
		<option value="1" 
			<?if($row[0]->wap==1)
				echo "SELECTED";?>			
			>SI</option>
	</select></td></tr>
	<tr><td>Rss:</td>
	<td><select name="rss">
		<option value="0">NO</option>
		<option value="1" 
			<?if($row[0]->rss==1)
				echo "SELECTED";?>			
			>SI</option>
	</select></td></tr>
	<tr><td>Imagen Rss:</td><td><input type="file" name="image_rss" /></td></tr>
	<tr><td>Descrici&oacute;n:</td><td><input type="text" name="description" value="<?=$row[0]->description ?>" /></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('sections');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>