<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('stories/insert','Ingresar Historias')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>T&Iacute;TULO</th>
	<th>CREADO</th>
	<th>POSICI&Oacute;N</th>
	<th>INVISIBLE</th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->title;?></td>
	 <td><?php echo $row->created;?></td>
	 <td><?php echo $row->position;?></td>
	 <td><?php if($row->invisible==1) echo 'SI'; else echo 'NO';?></td>
	 <td><?php echo anchor('stories/position_up/'.$row->id, 'UP')?>
	 	 <?php echo anchor('stories/position_down/'.$row->id, 'DOWN')?></td>
	 <td><?php echo anchor('stories/delete/'.$row->id.'/'.$row->position, 'Borrar')?></td>
	 <td><?php echo anchor('stories/update/'.$row->id, 'Actualizar')?></td>
	 <td><?php echo anchor('coments/index/'.$row->id, 'Comentarios')?></td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('index/index_v','Home')?></li>
    </ul>
	</div>
</div>