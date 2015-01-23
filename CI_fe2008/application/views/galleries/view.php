<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div id='form_insert' style='width:95%;margin:10px;'>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open('galleries')?>
	<fieldset id="personal">
		<legend>Inserta un nuevo registro:</legend>
		<table>
		<tr><td>Nombre:</td><td><?=form_input('name',set_value('name'));?>*</td></tr>
		<tr><td>Id de Flickr:</td><td><?=form_input('flickr',set_value('flickr'));?>*</td></tr>
		<tr><td colspan='2'><?=form_submit('submit', 'Ingreso');?></td>
		</table>
	</fieldset>
	<?=form_close();?>
	</div>
	
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>FLICKR ID</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row):?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->flickr;?></td>
	 <td class="actions">
	 <?=anchor('galleries/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('galleries/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 450}); return false;'));?>

	 </td>
	 </tr>
	 <?php endforeach;?>
	</table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Inicio')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
</div>