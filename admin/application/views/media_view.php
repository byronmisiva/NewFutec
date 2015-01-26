<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/medio_add.png','border'=>'0')) ?> <?=anchor('media/insert','Agregar Medio')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
		<?= $this->session->flashdata('image_errors');?>
		<?= $this->session->flashdata('delete_error');?>
	</ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>TIPO</th>
	<th>CREADO</th>
	<th>PUNTOS</th>
	<th>VOTOS</th>
	<th>JUEGOS</th>
	<th>DOWNLOADS</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php if($row->type==1) echo 'Podcast'; else echo 'Video';?></td>
	 <td><?php echo $row->created;?></td>
	 <td><?php echo $row->points;?></td>
	 <td><?php echo $row->votes;?></td>
	 <td><?php echo $row->plays;?></td>
	 <td><?php echo $row->downloads;?></td>
	 <td class="actions">
	 <?=anchor('media/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('media/confirm_delete/'.$row->id.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 
	 </tr>
	 <?php endforeach;?>
	 </table>
	<div id='pagination'>
    <?php echo $this->pagination->create_links();?>
    </div>
    <br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>