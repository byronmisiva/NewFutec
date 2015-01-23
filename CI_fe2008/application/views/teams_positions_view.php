<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th></th>
	<th>EQUIPO</th>
	<th>PJ</th>
	<th>PG</th>
	<th>PE</th>
	<th>PP</th>
	<th>GF</th>
	<th>GC</th>
	<th>P</th>
	<th>GD</th>
	<th></th>
	</tr>
	<?php $i=1 ?>
	 <?php foreach($tabla as $row): ?>
	 <tr class='altrow'>
	 <td><?=$i?></td>
	 <td><?=$row['name'];?></td>
	 <td><?=$row['PJ'];?></td>
	 <td><?=$row['PG'];?></td>
	 <td><?=$row['PE'];?></td>
	 <td><?=$row['PP'];?></td>
	 <td><?=$row['GF'];?></td>
	 <td><?=$row['GC'];?></td>
	 <td><?=$row['P'];?></td>
	 <td><?=$row['GD'];?></td>
	 </tr>
	 <?php $i+=1;?>
	 <?php endforeach;?>
	 </table>
</div>