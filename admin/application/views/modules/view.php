<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modulo_add.png','border'=>'0')) ?> <?=anchor('modules/insert','Agregar Modulos')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= $this->session->flashdata('delete_error'); ?>
	</ul>
	</div>
	<br>
	<table class='listing' border=1>
	<tr>
	<th>T&Iacute;TULO</th>
	<th>ACTIVO</th>
	<th>VISIBLE</th>
	<th></th>
	</tr>

	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->title;?></td>
	 <td><?php if($row->active==1) echo "Activado"; else echo "Desactivado";?></td>
	 <td><?php if($row->visible==1) echo "Visible"; else echo "Invisible";?></td>
	 <td class="actions">
	 <?=anchor('modules/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('modules/confirm_delete/'.$row->id.'/'.$row->title, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('banners/index/'.$row->id, img(array('src'=>'imagenes/icons/banners.png','border'=>'0')), array('title' => 'Banners'));?>
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