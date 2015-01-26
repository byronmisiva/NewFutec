<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/arbitro_add.png','border'=>'0')) ?> <?=anchor('referee/insert','Agregar &Aacute;rbitro')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= $this->session->flashdata('image_error') ?>
		<?= $this->session->flashdata('delete_error') ?>
	</ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>NACIMIENTO</th>
	<th>LUGAR</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->last_name.' '.$row->first_name;?></td>
	 <td><?php echo $row->birth;?></td>
	 <td><?php echo $row->born_place;?></td>
	 <td class="actions">
	 <?=anchor('referee/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('referee/confirm_delete/'.$row->id.'/'.$row->first_name.'/'.$row->last_name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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