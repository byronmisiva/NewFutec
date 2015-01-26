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
