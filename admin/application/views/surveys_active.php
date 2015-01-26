<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<br>
	<table class='listing' border=1>
	<tr>
	<th>CREADO</th>
	<th>T&Iacute;TULO</th>
	<th>SECCION</th>
	<th>VOTOS</th>
	<th>ACTIVO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo mdate('%Y-%m-%d',$row->created);?></td>
	 <td><?php echo $row->title;?></td>
	 <td><a href="<?=base_url().'sections/update/'.$row->eid?>"><?php echo $row->name;?></a></td>
	 <td><?php echo $row->votes;?></td>
	 <td><?php echo $row->days;?></td>
	 <td class="actions">
	 <?=anchor('options/index/'.$row->uid, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
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