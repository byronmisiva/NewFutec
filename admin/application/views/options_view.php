<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/opcion_add.png','border'=>'0')) ?> <?=anchor('options/insert/'.$this->uri->segment(3),'Agregar Opciones')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>OPCI&Oacute;N</th>
	<th>VOTOS</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->title;?></td>
	 <td><?php echo $row->votes;?></td>
	 <td class="actions">
	 <?=anchor('options/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('options/confirm_delete/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/encuesta.png','border'=>'0')) ?> <?=anchor('surveys','Encuestas')?></li>
    </ul>
	</div>
</div>