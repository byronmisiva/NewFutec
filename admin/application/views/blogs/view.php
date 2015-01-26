<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/news_add.png','border'=>'0')) ?> <?=anchor('blogs/insert','Agregar Blog')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>Creado</th>
	<th>Título</th>
	<th>Categoria</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->created;?></td>
	 <td><?php echo $row->title;?></td>
	 <td><?php echo $categories[$row->category_id];?></td>
	 <td class='actions'>
	 <?=anchor('blogs/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('blogs/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('comments/index/'.$row->id, img(array('src'=>'imagenes/icons/coments.png','border'=>'0')), array('title' => 'Comentarios'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/folder.png','border'=>'0')) ?> <?=anchor('categories','Categorias')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
</div>
