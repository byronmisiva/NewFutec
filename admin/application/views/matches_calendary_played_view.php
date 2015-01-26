<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>FECHA</th>
	<th>CAMPEONATO</th>
	<th>LOCAL</th>
	<th>VISITANTE</th>
	<th>RESULTADO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?=$row->date_match;?></td>
	 <td><?=$row->name;?></td>
	 <td><?=$row->hname;?></td>
	 <td><?=$row->aname;?></td>
	 <td><?=$row->result;?></td>
	 </tr>
	 <?php endforeach;?>
	 </table>
</div>