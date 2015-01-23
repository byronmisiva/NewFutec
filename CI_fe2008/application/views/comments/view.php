<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<table class='listing' border=1>
	<tr>
	<th>CREADO</th>
	<th>USUARIO</th>
	<th>TEXTO</th>
	<th>APROBADO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td class='dates'><?php echo  mdate("%d-%m/ %h:%i ", $row->timestamp);?></td>
	 <td><?=$row->nick?></td>
	 <td><?=strip_tags($row->text);?></td>
	 
	 <td><?php if($row->aproved==1) echo 'Si'; else echo 'No';?></td>
	 <td class="actions">
	 <?=anchor('comments/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('comments/confirm_delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('comments/respond/'.$row->id.'/'.$row->story_id, img(array('src'=>'imagenes/icons/coments_add.png','border'=>'0')), array('title' => 'Responder'));?>
	 </td>
	</tr>
	 <?php endforeach;?>
	</table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    	<li> <?=img(array('src'=>'imagenes/icons/news.png','border'=>'0')) ?> <?=anchor('stories','Noticias')?></li>
    </ul>
	</div>
</div>