<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	
	<div class="actions">
    <ul>
    	<li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?>  <?=anchor('users','Usuarios')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/resource.png','border'=>'0')) ?>  <?=anchor('resources','Recursos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/lock.png','border'=>'0')) ?>  <?=anchor('rules','Reglas')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('roles/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table border='1'>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" name="name" value="<?=set_value('name');?>" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Enviar" /></td>
		</tr>
	</table>
	<?php echo "</form>"?>
</div>