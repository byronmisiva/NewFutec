<!-- Mini Tabla de Posiciones -->
<div id='modulo'>
	<table class='titulo_normal' cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<th>Tabla de Posiciones</th>
		</tr>
		</table>
		
	<div id="tabla" style='background-color: white;'>
	<table class="tabla_posiciones" cellpadding="0" cellspacing="0">
		<tr>
			<th>Equipo</th>
			<th>Pts</th>
			<th>GD</th>
		</tr>
		<?php 
		$i=false;
		$num=1;
		foreach($tabla as $row){
			if($i==true){
				$class='class="altrow"';
				$i=false;
			}
			else{
				$class='';
				$i=true;
			}
			if($team==$row['id'])
				$bold="style='font-weight: bold;'";
			else
				$bold="";
			echo "<tr $class>\n";
			if(array_key_exists($row['id'],$teams))
				echo "<td class='name' $bold>".anchor('sections/publica/'.$teams[$row['id']],$row['name'])."</td>\n";
			else
				echo "<td class='name' $bold>".$row['name']."</td>\n";
			echo "<td class='data' $bold>".$row['P']."</td>\n";
			echo "<td class='data' $bold>".$row['GD']."</td>\n";
			echo "</tr>\n";
			$num++;
		}
		?>

	</table>
	</div> 
</div>