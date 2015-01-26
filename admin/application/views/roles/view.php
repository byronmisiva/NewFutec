<div id="admin">	
	<h1><?php echo $title; 
			echo $heading;?></h1>
	<br>
	<?php 
	echo mdate($datestring,$time);?>
	<br><br>
	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/group_add.png','border'=>'0')) ?> <?=anchor('roles/insert','Agregar Rol')?></li>
    </ul>
	</div>
	<br>
	<table class="listing" cellpadding="0" cellspacing="0">
	<tr>
		<th>Nombre</th>
		<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class="altrow">
	 <td><?php echo $row->name;?></td>

	 <td class="actions">
	 <?=anchor('roles/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('roles/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();
    	?>
	<br>
	<br>
	<div class="actions">
    <ul>
    	<li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/resource.png','border'=>'0')) ?> <?=anchor('resources','Recursos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/lock.png','border'=>'0')) ?> <?=anchor('rules','Reglas')?></li>
    </ul>
	</div>
</div>
