<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato.png','border'=>'0')) ?> <?=anchor('championships','Campeonatos')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('championships/insert')?>
	<?php echo form_hidden('id',$id=0);?>
	<table>
	<tr><td>Nombre:</td><td><input type="text" name="name" value="<?php echo set_value('name')?>"/>*</td></tr>
	<tr><td>Imagen:</td><td><input type="file" name="image" /></td></tr>
	<tr><td>A&ntilde;o</td>
	<td><select name="year">
	<?php for($i = 2000; $i <= mdate("%Y",time())+1; $i += 1){?>
	<option value="<?php echo $i?>" <?php if(set_value('year')==$i) echo " SELECTED "?>><?php echo $i?></option><?php }?>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('championships');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>