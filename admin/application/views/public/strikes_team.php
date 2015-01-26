<div id='modulo'>
	<table class='titulo_normal' cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th>Goleadores del Equipo</th>
	</tr>
	</table>
	<div id='strikes'>
		<table class='list_strikes' cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td width='40%' valign='top' style='padding: 3px;'>
			<table class='first' cellpadding="0" cellspacing="0">
			<tr>
			<td><?=img(array('src'=>$goleador->thumb,'border'=>'1','alt'=>''));?></td>
			</tr>
			<tr>
			<td align='center' style='padding-top: 8px;'><strong>
			<?php
			echo $goleador->first_name.' '.$goleador->last_name;
			if($goleador->nick!='NULL' && $goleador->nick!='')
				echo " ($goleador->nick)";
			?></strong></td>
			</tr>
			</table>
		</td>
		<td width='60%' valign='top' style='padding-top: 4px;'>
			<table class='list' cellpadding="0" cellspacing="0" width='100%'>
			<?php
			$i=1;
			if(count($jugadores)>0){
				foreach($jugadores as $row){
					echo "<tr>\n";
					echo "<td class='pos' valign='top'>$i. </td>\n";
					if($row->nick!='NULL' && $row->nick!='')
						echo "<td class='name' >".$row->nick.".</td>\n";
					else{	
						if($row->last_name!='NULL' && $row->last_name!='')
							echo "<td class='name' >".$row->last_name.' '.substr($row->first_name,0,1).".</td>\n";
						else
							echo "<td class='name' >".$row->first_name."</td>\n";					
					}
					echo "<td class='goal' >$row->goals</td>\n";
					echo "</tr>\n";
					$i++;
				}
			}
			else{
				echo "<tr><td align='center'>Aun no existen goleadores para el equipo.</td></tr>";	
			}
			
			?>
			</table>
		</td>
		</tr>
		</table>
	</div>
</div>