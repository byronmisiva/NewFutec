<div id="admin">	
	<h1><?php echo $title; 
			echo $heading;?></h1>
	<br>
	<?php echo mdate($datestring,$time);?>
	<br><br>
	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/lock_add.png','border'=>'0')) ?> <?=anchor('rules/insert','Agregar Regla')?></li>
    </ul>
	</div>
	<br>
	<div style='margin-left: 3px;'>
	<?=form_dropdown('roles', $roles, set_value('roles'),$js);?>
	</div>
	<div id='result'>
		<table class="listing" cellpadding="0" cellspacing="0">
			<tr>
				<th>Nombre</th>
				<th>Orden</th>
				<th>Permiso</th>
				<th class="actions"></th>
			</tr>
			<?php foreach($query->result() as $row): ?>
			<tr class="altrow">
				<td><?php echo $row->name;?></td>
				<td>
				<?=anchor('rules/priority_up/'.$row->id, img(array('src'=>'imagenes/icons/arrow_up.png','border'=>'0')), array('title' => 'Subir'));?>
				<?=anchor('rules/priority_down/'.$row->id, img(array('src'=>'imagenes/icons/arrow_down.png','border'=>'0')), array('title' => '_Bajar'));?>
				</td>
				<td><?php echo $permissions[$row->permission];?></td>
				<td class="actions">
				<?=anchor('rules/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
				<?=anchor('rules/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
				 
				</td>
			</tr>
			<?php endforeach;?>
		</table>
	</div>
	<br>
    	<?php echo $this->pagination->create_links();
    	?>
	<br>
	<br>
	<div class="actions">
    <ul>
    	<li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/resource.png','border'=>'0')) ?> <?=anchor('resources','Recursos')?></li>
    </ul>
	</div>
</div>
