<div id="admin">	
	<h1><?php echo $title." / ".$heading;?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/resource_add.png','border'=>'0')) ?> <?=anchor('resources/insert','Agregar Recurso')?></li>
    </ul>
	</div>
	<br>
	<table class="listing" cellpadding="0" cellspacing="0">
	<tr>
		<th>Nombre</th>
		<th>Controlador</th>
		<th>Funcion</th>
		<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class="altrow">
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->controller;?></td>
	 <td><?php echo $row->function;?></td>

	 <td class="actions">
	 <?=anchor('resources/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('resources/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/lock.png','border'=>'0')) ?> <?=anchor('rules','Reglas')?></li>
    </ul>
	</div>
</div>
