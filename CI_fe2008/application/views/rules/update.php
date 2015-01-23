<div id="admin">	
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
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
	<?php echo form_open('rules/update');?>
	<?php echo form_hidden('id',$row->id);?>
	<table border="0" width='50%' style='border: 1px outset black; padding: 5px;margin: 5px;'>
		<tr>
			<td>Nombre:</td>
			<td><?=$row->name ?></td>
		</tr>
		<tr>
			<td>Recurso:</td>
			<td>
			<?php echo form_dropdown('resource_id', $resources, $row->resource_id);?>
			</td>
		</tr>
		<tr>
			<td>Rol:</td>
			<td>
			<?php echo form_dropdown('role_id', $roles, $row->role_id);?>
			</td>
		</tr>
		<tr>
			<td>Permiso:</td>
			<td>
			<?php echo form_dropdown('permission', $permissions, $row->permission);?>
			</td>
		</tr>
		<tr>
			<td>Reenvio:</td>
			<td><input type="text" name="forward" value="<?=$row->forward ?>"/></td>
		</tr>
		<tr>
			<td>Mensaje:</td>
			<td><input type="text" name="message" value="<?=$row->message ?>"/></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Actualizar" /></td>
		</tr>
	</table>
	<?php echo "</form>"?>
</div>
	
	
	