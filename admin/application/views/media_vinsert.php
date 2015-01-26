<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/medio.png','border'=>'0')) ?> <?=anchor('media','Medios')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('media/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?php set_value("name")?>"/>*</td></tr>
	<tr><td>Tipo:</td>
	<td><select name="type">
		<option value=1 <?php if(set_value("type")==1) echo " SELECTED "?>>Podcast</option>
		<option value=2 <?php if(set_value("type")==2) echo " SELECTED "?>>Video</option>
	</select>*</td></tr>
	<tr><td>Archivo:</td><td><input type="file" name="file" /></td></tr>
	<tr><td>Descripci&oacute;n:</td>
	<td><textarea cols="20" rows="8" name="description"><?php echo set_value("description")?></textarea></td></tr>
	
	<tr>
		<td>Relacionado:</td>
		<td><input type="text" id="tags1" name="related" size="80" value=""/>*
		<div style="width:660px; background-color:#f0f0ee; text-align:center; line-height: 1.7; font-size: 12px;">
			<?foreach($query->result() as $row):
				echo "<a id=\"".$row->name."\" class=\"\" href='' onClick='append_tag(\"".$row->name."\"); return false;'>".$row->name."</a> | ";
			  endforeach;?>	
		</div></td>
	</tr>
	
	
	
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	</table>
</div>