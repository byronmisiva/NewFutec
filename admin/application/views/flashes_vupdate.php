<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<?php ?>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php $row=$query->result();
		  echo form_open('flashes/update/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$this->uri->segment(3));?>
	<table>
	<tr>
		<td>Texto:</td>
		<td><textarea style="width:100%;" name="text" ><?=$row[0]->text?></textarea></td>
	</tr>
	</table>	
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('flashes');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>