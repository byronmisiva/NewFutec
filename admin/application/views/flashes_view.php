<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('flashes/insert','Ingresar Instantanea')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOTICIA</th>
	<th>CREADO</th>
	<th></th>	
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?=strip_tags($row->text);?></td>
	 <td><?=$row->date;?></td>
	 <td  class="actions">
	 <?=anchor('flashes/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('flashes/confirm_delete/'.$row->id, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('index/index_v','Home')?></li>
    </ul>
	</div>
</div>