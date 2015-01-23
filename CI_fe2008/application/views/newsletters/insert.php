<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/calendario.png','border'=>'0')) ?> <?=anchor('newsletters/index/','Bolet&iacute;n')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('newsletters/insert/')?>
	<?php echo form_hidden('id',$id=0);?>
	<table>
	<tr><td>Fecha:</td><td><input type="text" name="date" value="<?php echo set_value('date')?>" readonly/>*
	<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date,'yyyy/mm/dd  hh:ii',this,true)">
	<input type="button" value="Reset" onclick="document.forms[0].date.value='';"></td></tr>
	<tr>
	<td>Tipo:</td>
	<td>
	<?php
	$options = array('lunes'=> 'Lunes','jueves'=>'Jueves');
	echo form_dropdown('tipo', $options, 'lunes');
	?>
	</td>
	</tr>
	
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('newsletters/index/');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>