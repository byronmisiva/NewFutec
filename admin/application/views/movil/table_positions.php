<div style="margin-top: 5px; margin-bottom:5px;">
	<table style="text-align:center;width:95%;margin: 0 auto;">
		<tr>
		<?$j=count($grp);
		for($i=0;$i<$j;$i++){?>
			<?if(($i-3)%4==0)
				echo '<tr>';
				$aux=$i+1;?>
			
			<?if($i+1!=$sel){?>	
				<td><a style="font-weight: bold;font-size: 12px; color:#06618C" href="<?=base_url().'welcome/movil/1/'.$aux.'#tablap'?>"><?=ucfirst($grp[$i+1]['name']);?></a></td>
			<?}else{?>
				<td><span style="font-weight: bold;font-size: 12px; color:#000000"><?=ucfirst($grp[$i+1]['name']);?></span></td>
			<?}?>
			
			<?if(($i+1)%4==0)
				echo '<tr>'?>
		<?}?>
		</tr>
	</table>
    <a name="tabla-posiciones"></a>
	<table class="tabla_posiciones" style="width:95%;margin: 0 auto;">
		<tr>
			<th>#</th>
			<th>Equipo</th>
			<th>PJ</th>
			<th>Pts</th>
			<th>GD</th>
		</tr>
		<?php
		if(is_array($tabla)){
			$i=false;
			$j=1;
			foreach($tabla as $row){
				if($i==true){
					$class='class="altrow"';
					$i=false;
				}
				else{
					$class='';
					$i=true;
				}
				
				echo "<tr $class>\n";
				echo "<td class='data'>".$j."</td>\n";
				echo "<td class='name'>".$row['name']."</td>\n";
				echo "<td class='data'>".$row['pj']."</td>\n";
				echo "<td class='data'>".$row['points']."</td>\n";
				echo "<td class='data'>".$row['gd']."</td>\n";
				echo "</tr>\n";
			$j+=1;
			}
		}
		?>
	</table>
</div>