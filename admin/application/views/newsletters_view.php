<div id="admin">
	<h1><?=$title.''.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/partido_add.png','border'=>'0')) ?> <?=anchor('newsletters/insert/','Agregar Bolet&iacute;n')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>FECHA</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->date;?></td>
	
	 <td class="actions">
	 <?=anchor('newsletters/confirm_delete/'.$row->id.'/'.$row->date, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('newsletters/lista/'.$row->id, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Noticias del Bolet&iacute;n'));?>
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