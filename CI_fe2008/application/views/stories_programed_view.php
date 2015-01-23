<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>Programado</th>
	<th>Título</th>
	<th>Categoria</th>
	<th>Posicion</th>
	<th>Visible</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->programed;?></td>
	 <td><?php echo $row->title;?></td>
	 <td><?php echo $categories[$row->category_id];?></td>
	 <td><?php echo $positions[$row->position];?></td>
	 <td><?php if($row->invisible==1) echo 'NO'; else echo 'SI';?></td>
	 <td class='actions'>
	 <?=anchor('stories/programed_update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>