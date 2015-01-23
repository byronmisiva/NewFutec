<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/mediosecciones.png','border'=>'0')) ?> <?=anchor('media_sections/index/'.$this->uri->segment(4),'Medios de Secci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	<?php echo form_open('media_sections/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('section_id',$this->uri->segment(4))?>
	<table>
	<tr><td>Media:</td>
	<td><select name="media_id">
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->media_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('media_sections/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>