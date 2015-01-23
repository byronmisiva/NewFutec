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
	echo form_hidden('id',$section->id);?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?=$section->name ?>" />*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr> 
	<tr>
		<td>Encabezado:</td>
		<td><?php echo form_dropdown('header_id', $headers, $section->header_id);?></td>
	</tr>
	<tr>
		<td>Campeonato:</td>
		<td><?php echo form_dropdown('championship_id', $championships, $section->championship_id);?></td>
	</tr>
	<tr>
		<td>Equipo:</td>
		<td><?php echo form_dropdown('team_id', $teams, $section->team_id);?></td>
	</tr>
	<tr>
		<td>Categoria:</td>
		<td><?php echo form_dropdown('category_id', $categories, $section->category_id);?></td>
	</tr>
	<tr>
		<td>Seccion Padre:</td>
		<td><?php echo form_dropdown('section_id', $sections, $section->section_id);?></td>
	</tr>
	<tr>
		<td>Encuesta:</td>
		<td><?php echo form_dropdown('survey_id', $surveys, $survey->survey_id);?></td>
	</tr>
	<tr><td>Wap</td>
	<td><select name="wap">
		<option value="0">NO</option>
		<option value="1" 
			<?if($section->wap==1)
				echo "SELECTED";?>			
			>SI</option>
	</select></td></tr>
	<tr><td>Rss:</td>
	<td><select name="rss">
		<option value="0">NO</option>
		<option value="1" 
			<?if($section->rss==1)
				echo "SELECTED";?>			
			>SI</option>
	</select></td></tr>
	<tr><td>Imagen Rss:</td><td><input type="file" name="image_rss" /></td></tr>
	<tr>
		<td>Relacionado:</td>
		<td><input type="text" id="tags1" name="related" size="80" value="<?=$related ?>"/>*
		<div style="width:660px; background-color:#f0f0ee; text-align:center; line-height: 1.7; font-size: 12px;">
			<?foreach($tags->result() as $row):
				echo "<a id=\"".$row->name."\" class=\"\" href='' onClick='append_tag(\"".$row->name."\"); return false;'>".$row->name."</a> | ";
			  endforeach;?>	
		</div></td>
	</tr>
	<tr><td>Descrici&oacute;n:</td><td><input type="text" name="description" value="<?=$section->description ?>" /></td></tr>
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