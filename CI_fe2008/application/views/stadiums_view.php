<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/estadio_add.png','border'=>'0')) ?> <?=anchor('stadiums/insert','Agregar Estadios')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= $this->session->flashdata('upload_image'); ?>
		<?= $this->session->flashdata('delete_error'); ?>
	</ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>CAPACIDAD</th>
	<th>CIUDAD</th>
	<th>ALTURA</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->capacity;?></td>
	 <td><?php echo $row->city;?></td>
	 <td><?php echo $row->height;?></td>
	 <td class="actions">
	 <?=anchor('stadiums/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('stadiums/confirm_delete/'.$row->id.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>