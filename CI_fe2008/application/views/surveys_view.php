<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/encuesta_add.png','border'=>'0')) ?> <?=anchor('surveys/insert','Agregar Encuesta')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<? echo $this->session->flashdata('delete_error')?>
	</ul>
	</div>
	<table class='listing' border=1>
	<tr>
	<th>T&Iacute;TULO</th>
	<th>VOTOS</th>
	<th>CREADO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->title;?></td>
	 <td><?php echo $row->votes;?></td>
	 <td><?php echo $row->created;?></td>
	 <td class="actions">
	 <?=anchor('surveys/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('surveys/confirm_delete/'.$row->id, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('options/index/'.$row->id, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
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