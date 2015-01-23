<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/calendario.png','border'=>'0')) ?> <?=anchor('schedules/index/'.$this->uri->segment(4),'Calendario')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('schedules/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('round_id',$this->uri->segment(4))?>
	<table>
	<tr><td>Name:</td><td><input type="text" name="season" value="<?=$row[0]->season ?>" />*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name='submit' value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('schedules/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>