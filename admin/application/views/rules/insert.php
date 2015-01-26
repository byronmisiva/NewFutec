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
	<?php echo form_open('rules/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table border="0" width='50%' style='border: 1px outset black; padding: 5px;margin: 5px;'>
		<tr>
			<td>Recurso:</td>
			<td>
			<?php echo form_dropdown('resource_id', $resources, set_value('resource_id'));?>
			</td>
		</tr>
		<tr>
			<td>Rol:</td>
			<td>
			<?php echo form_dropdown('role_id', $roles, set_value('role_id'));?>
			</td>
		</tr>
		<tr>
			<td>Permiso:</td>
			<td>
			<?php echo form_dropdown('permission', $permissions, set_value('permission'));?>
			</td>
		</tr>
		<tr>
			<td>Reenvio:</td>
			<td><input type="text" name="forward" value="<?=set_value('forward');?>"/></td>
		</tr>
		<tr>
			<td>Mensaje:</td>
			<td><input type="text" name="message" value="<?=set_value('message');?>"/></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Enviar" /></td>
		</tr>
	</table>
	<?php echo "</form>"?>
</div>