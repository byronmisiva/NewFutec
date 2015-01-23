<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
	<br>
	<?php echo form_open_multipart('players/no_pic_update/'.$this->uri->segment(3));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);?>
	<table>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('players/no_pic_view');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>