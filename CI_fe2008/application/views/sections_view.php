<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/seccion_add.png','border'=>'0')) ?> <?=anchor('sections/insert','Agregar Secci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<? echo $this->session->flashdata('errors_upload_image');
		   echo $this->session->flashdata('errors_upload_imagerss');
		   echo $this->session->flashdata('delete_error')?>
	</ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>EQUIPO</th>
	<th>CAMPEONATO</th>
	<th>CATEGOR&Iacute;A</th>
	<th>WAP</th>
	<th>RSS</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->tname;?></td>
	 <td><?php echo $row->chname;?></td>
	 <td><?php echo $row->cname;?></td>
	 <td><?php if($row->wap==1) echo 'Si'; else echo 'No';?></td>
	 <td><?php if($row->rss==1) echo 'Si'; else echo 'No';?></td>
	 <td class="actions">
	 <?=anchor('sections/priority_up/'.$row->id, img(array('src'=>'imagenes/icons/arrow_up.png','border'=>'0')), array('title' => 'Arriba'));?>
	 <?=anchor('sections/priority_down/'.$row->id, img(array('src'=>'imagenes/icons/arrow_down.png','border'=>'0')), array('title' => 'Abajo'));?>
	 <?=anchor('sections/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('sections/confirm_delete/'.$row->id.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('modules_sections/index/'.$row->id, img(array('src'=>'imagenes/icons/modulossecciones.png','border'=>'0')), array('title' => 'M&oacute;dulos de Secci&oacute;n'));?>
	 <?=anchor('media_sections/index/'.$row->id, img(array('src'=>'imagenes/icons/mediosecciones.png','border'=>'0')), array('title' => 'Media de Secci&oacute;n'));?>
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