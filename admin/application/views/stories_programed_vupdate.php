<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
	<br>
	<?php 
	echo form_open('stories/programed_update/'.$this->uri->segment(3));
	echo form_hidden('id',$row->id);?>
	<table>
	<tr>
		<td>Programar:</td>
		<td>
		<input type="text" name="programed" value="<?=$row->programed?>" readonly >
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].programed,'yyyy/mm/dd hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].programed.value='';">
		</td>
	</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('stories/programed_view');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>