<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
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
	<?=form_open('blogs/insert',array('name'=>'insert'));?>
	<?=form_hidden('id',$id=0);?>
	<?=form_hidden('author_id',$this->session->userdata('userid'));?>
	<?=form_hidden('position',$this->session->userdata('userid'));?>
	<table>
	<tr>
		<td>Categor&iacute;a:</td>
		<td><?php echo form_dropdown('category_id', $categories, set_value('category_id'));?></td>
	</tr>
	<tr>
		<td>T&iacute;tulo:</td>
		<td><input type="text" name="title" size="80" value="<?php echo set_value('title')?>"/>*</td>
	</tr>
	<tr>
		<td>Origen:</td>
		<td><input type="text" name="origen" size="40" value="<?php echo set_value('origen')?>"/>*</td>
	</tr>	
	<tr>
		<td>Cuerpo:</td>
		<td><textarea rows="10" cols="20" style="width:100%;" name="body"><?php echo set_value('body')?></textarea></td>
	</tr>
	<tr>
		<td>Relacionado:</td>
		<td><input type="text" id="tags1" name="related" size="80" value="<?php echo set_value('related')?>"/>*
		<div style="width:660px; background-color:#f0f0ee; text-align:center; line-height: 1.7; font-size: 12px;">
			<?foreach($query->result() as $row):
				echo "<a id=\"".$row->name."\" class=\"\" href='' onClick='append_tag(\"".$row->name."\"); return false;'>".$row->name."</a> | ";
			  endforeach;?>	
		</div></td>
	</tr>
	<tr>
	<td colspan='2'>
	<table>
	<tr>
	<td width='110'>Imagen:</td>
	<td>
		<?php echo form_dropdown('image_id', $images, set_value('image_id'),'id="image_id" onChange="imageFromSelect(this,\'marco_imagen\',\''.'http://www.futbolecuador.com/'.'\');"');?>
	</td>
	<td rowspan='2' style="padding-left: 40px;">
		<div id='marco_imagen' class='marco_imagen'></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('blogs/index/');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>