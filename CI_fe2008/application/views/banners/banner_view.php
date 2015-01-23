<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/banners_add.png','border'=>'0')) ?> <?=anchor('banners/insert/'.$this->uri->segment(3),'Agregar Banners')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= $this->session->flashdata('errors_image'); ?>
		<?= $this->session->flashdata('errors_file'); ?>
	</ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>INICIO</th>
	<th>F&Iacute;N</th>
	<th>IMPRESIONES</th>
	<th>CLICKS</th>
	<th>TOTAL</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->start;?></td>
	 <td><?php echo $row->end;?></td>
	 <td><?php echo $row->prints;?></td>
	 <td><?php echo $row->clicks;?></td>
	 <td><?php echo $row->total;?></td>
	 <td><?php echo $row->width;?></td>
	 <td><?php echo $row->height;?></td>
	 <td class="actions">
	 <?=anchor('banners/position_up/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/arrow_up.png','border'=>'0')), array('title' => 'Arriba'));?>
	 <?=anchor('banners/position_down/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/arrow_down.png','border'=>'0')), array('title' => 'Abajo'));?>
	 <?=anchor('banners/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('banners/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->position.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/modulo.png','border'=>'0')) ?> <?=anchor('modules','Modulos')?></li>
    </ul>
	</div>
</div>