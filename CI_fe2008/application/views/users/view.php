<div id="admin">	
	<h1><?php 
			  echo $title; 
			  echo $heading;?></h1>
	<br>
	<?php echo mdate($datestring,$time);?>
	<br><br>
	
	<div class="actions">
    <ul>
        <li><?=img(array('src'=>'imagenes/icons/user_add.png','border'=>'0')) ?> <?=anchor('users/insert','Agregar Usuario')?></li>
         <li><?=img(array('src'=>'imagenes/icons/user_add.png','border'=>'0')) ?> <?=anchor('users/search','Buscar Usuarios')?></li>
        <li><?=img(array('src'=>'imagenes/icons/user_add.png','border'=>'0')) ?> <?=anchor('users/statistics','Estad&iacute;sticas de Usuarios')?></li>
    </ul>
	</div>
	<br>
	<table class="listing" cellpadding="0" cellspacing="0">
	<tr>
		<th>Nombre</th>
		<th>Nick</th>
		<th>E-mail</th>
		<th>Rol</th>
		<th class="actions"></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class="altrow">
	 
	 <td><?php echo $row->first_name.' '.$row->last_name;?></td>
	 <td><?php echo $row->nick;?></td>
	 <td><?php echo $row->mail;?></td>
	 <td><?php echo $row->rol;?></td>
	 <td class="actions">
	 <?=anchor('users/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('users/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 300}); return false;'));?>
	 <?=anchor('users/reset_pass/'.$row->id, img(array('src'=>'imagenes/icons/key.png','border'=>'0')), array('title' => 'Cambiar Clave'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/resource.png','border'=>'0')) ?> <?=anchor('resources','Recursos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/lock.png','border'=>'0')) ?> <?=anchor('rules','Reglas')?></li>
    </ul>
	</div>
</div>
