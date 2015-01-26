<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<br><br>
	
	
	<?php $i=0; foreach($matches as $row): ?>
	
	<?php if($i!=$row['week']){?>
	<?php if($i!=0) echo '</table><br><br>' ?>
	<b>SEMANA <?php echo $row['week']?></b>
	<table class='listing' border=1>
	<tr>
	<th>FECHA</th>
	<th>GRUPO</th>
	<th>LOCAL</th>
	<th>VISITANTE</th>
	<th></th>
	</tr>
	<?php $i=$row['week'];}?>
	 
	 <tr class='altrow'>
	 <td><?=$row['date_match'];?></td>
	 <td><?=$row['gname'];?></td>
	 <td><?=$row['hname'];?></td>
	 <td><?=$row['aname'];?></td>
	 </tr>
	 <?php endforeach;?>
	 </table>
</div>