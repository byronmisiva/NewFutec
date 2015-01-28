<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/encabezados_add.png','border'=>'0')) ?> <?=anchor('headers/insert','Agregar Encabezado')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<? echo $this->session->flashdata('errors_upload_file');?>
		<? echo $this->session->flashdata('delete_error');?>
	</ul>
	</div>
	<table class='listing' border=1>
	<tr>
	<th>ID</th>
	<th>NOMBRE</th>
	<th>ANCHO</th>
	<th>ALTURA</th>
	<th>DESCRIPCI&Oacute;N</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr  class='altrow'>
	 <td><?php echo $row->id;?></td>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->width;?></td>
	 <td><?php echo $row->height;?></td>
	 <td><?php echo $row->description;?></td>
	 <td class="actions">
	 <?=anchor('headers/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('headers/confirm_delete/'.$row->id.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br><br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>
