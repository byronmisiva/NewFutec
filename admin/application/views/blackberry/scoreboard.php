<br>
<center>
<table width=100% style="font-family:Arial; font-size:11px;" cellpadding=0 cellspacing=0>
	<?if($matches==0) echo '<tr><td><center>No existen partidos en vivo hoy</center><br></td><tr>';
	  else{?>
	<?foreach($matches as $row):?>
	  <tr>
	  	<td bgcolor="#F3F3F3" style="padding-left: 5px" width=70%><?=$row['home']['name']?></td>
	  	<td bgcolor="#F3F3F3" style="padding-left: 5px" width=30%><?=$row['home']['result']?></td>
	  </tr>
	  <tr>
	  	<td style="padding-left: 5px" width=70%><?=$row['away']['name']?></td>
	  	<td style="padding-left: 5px" width=30%><?=$row['away']['result']?></td>
	  </tr>
	  <tr>
	  	<td bgcolor="#F3F3F3" style="padding-left: 5px; font-weight:bold;" width=70%><?=$row['fecha']?></td>
	  	<td bgcolor="#F3F3F3" style="padding-left: 5px; font-weight:bold;" width=30%><a href="<?=base_url().'blackberries/single/'.$row['id']?>" style="color:black; text-decoration:underline;">Detalles</a></td>
	  </tr>
	  <tr>
	  	<td><br/></td>
	  	<td><br/></td>
	  </tr>
	<?endforeach;
	  }?>
</table>
</center>