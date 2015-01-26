<div id='modulo'>
	<table class='titulo_credife_lt' cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th><div style='margin-top:10px;'>Goleadores</div></th>
	</tr>
	</table>
	<div id='strikes'>
		<div id='champ'>
		<?=$championship->name;?>
		</div>
		<table class='list_strikes' cellpadding="0" cellspacing="0" width="100%">
		<tr>
		<td width='40%' valign='top' style='padding: 3px;'>
			<table class='first' cellpadding="0" cellspacing="0">
			<tr>
			<td><?php
			
				if($goleador->thumb!="")
					echo img(array('src'=>$goleador->thumb,'border'=>'1','alt'=>''));
				else
					echo img(array('src'=>'imagenes/players/striker.jpg','border'=>'1','alt'=>''));
				?>
			</td>
			</tr>
			<tr>
			<td align='center' style='padding-top: 8px;'><strong><?=$goleador->first_name.' '.$goleador->last_name?></strong></td>
			</tr>
			<tr>
			<td align='center'><?=$goleador->name?></td>
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
					/*if($row->nick!='NULL')
						echo "<td class='name' >".$row->nick.".</td>\n";
					else*/
						echo "<td class='name' >".$row->last_name.' '.substr($row->first_name,0,1).".</td>\n";
					echo "<td class='goal' >$row->goals</td>\n";
					echo "</tr>\n";
					$i++;
				}
			}
			else{
				echo "<tr><td align='center'>Aun no existen goleadores para el campeonato.</td></tr>";	
			}
			
			?>
			</table>
		</td>
		</tr>
		</table>
		<div id='boton_mas'>
			<div style='float:left;'><?=img('imagenes/icons/isotipo_plomo.jpg');?></div>
			<div style='float:right; margin-top:5px;'><?=img('imagenes/icons/flecha.jpg');?></div>
			<div style='text-align:center; float:none; padding-top: 2px;'>
			<a href="<?=base_url().'goals_positions/publica/'.$champ?>"  style="font-size:12px; text-decoration: none">Ver Lista Completa </a>
			</div>
		</div>
	</div>
</div>