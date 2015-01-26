<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/news.png','border'=>'0')) ?> <?=anchor('blogs','Blogs')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/folder.png','border'=>'0')) ?> <?=anchor('categories','Categorias')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open('blogs/update/'.$this->uri->segment(3));?>
	<?=form_hidden('id',$row[0]->id);?>
	<?=form_hidden('author_id',$this->session->userdata('userid'));?>
	<table>
	<tr>
		<td>Categor&iacute;a:</td>
		<td><?php echo form_dropdown('category_id', $categories, $row[0]->category_id);?></td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><input type="text" name="title" size="80" value="<?= $row[0]->title?>"/>*</td>
	</tr>
	<tr>
		<td>Origen:</td>
		<td><input type="text" name="origen" size="40" value="<?= $row[0]->origen?>"/>*</td>
	</tr>
	<tr>
		<td>Cuerpo:</td>
		<td><textarea style="width:100%;" name="body"><?= $row[0]->body?></textarea></td>
	</tr>
	<tr>
		<td>Relacionado:</td>
		<td><input type="text" id="tags1" name="related" size="80" value="<?=$tags?>"/>*
		<div style="width:660px; background-color:#f0f0ee; text-align:center; line-height: 1.7; font-size: 12px;">
			<?foreach($query->result() as $row2):
				echo "<a id=\"".$row2->name."\" class=\"\" href='' onClick='append_tag(\"".$row2->name."\"); return false;'>".$row2->name."</a> | ";
			  endforeach;?>	
		</div></td>
	</tr>
	<tr>
	<td colspan='2'>
	<table>
	<tr>
	<td width='110'>Imagen:</td>
	<td>
		<?php echo form_dropdown('image_id', $images, $row[0]->image_id,'id="image_id" onChange="imageFromSelect(this,\'marco_imagen\',\''.base_url().'\');"');?>
	</td>
	<td rowspan='2' style="padding-left: 40px;">
		<div id='marco_imagen' class='marco_imagen'><?=img(array('src'=>$images_url[$row[0]->image_id],'border'=>'0')) ?></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('blogs/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>