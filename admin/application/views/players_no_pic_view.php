<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>EQUIPO</th>
	<th></th>
	</tr>
	 <?php foreach($striker as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row['last_name'].' '.$row['first_name'];?></td>
	 <td><?php echo $row['team'];?></td>
	 <td class="actions">
	 <?=anchor('players/no_pic_update/'.$row['id'], img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	</table>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>