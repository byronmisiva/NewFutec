<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th></th>
	<th>NOMBRE</th>
	<th>EQUIPO</th>
	<th>GOLES</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?=img(array('src'=>$row->thumb,'border'=>'0'))?></td>
	 <td><?=$row->last_name.' '.$row->first_name;?></td>
	 <td><?=$row->name;?></td>
	 <td><?=$row->goals;?></td>
	 </tr>
	 <?php endforeach;?>
	 </table>
</div>