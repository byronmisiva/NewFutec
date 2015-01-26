<div id="admin">	
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
    	<li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/resource.png','border'=>'0')) ?> <?=anchor('resources','Recursos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/lock.png','border'=>'0')) ?> <?=anchor('rules','Reglas')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('resources/update');?>
	<?php echo form_hidden('id',$row->id);?>
	<table border="0" width='50%' style='border: 1px outset black; padding: 5px;margin: 5px;'>
		<tr>
			<td>Nombre:</td>
			<td><?=$row->name ?></td>
		</tr>
		<tr>
			<td>Controlador:</td>
			<td><input type="text" name="controller" value="<?=$row->controller ?>" /></td>
		</tr>
		<tr>
			<td>Funcion:</td>
			<td><input type="text" name="function" value="<?=$row->function ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Actualizar" /></td>
		</tr>
	</table>
	<?php echo "</form>"?>
</div>
	
	
	