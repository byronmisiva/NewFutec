<div id='ultimos'>
	<table class='options' cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width='50%' onClick="ajax_update('ultimos','<?=base_url();?>championships/list_played_matches/<?=$champ?>','<?=base_url();?>');" >Resultados</td>
			<td width='50%' class='selected' >Próxima Fecha</td>
		</tr>
	</table>
	<?php
	$cn="";
	$i=0;
	if(count($partidos)>0){
		foreach($partidos as $row){
			//Reviso los campeonatos para ir agrupando
			if($cn!=$row->cn){
				if($cn!="")
					echo "</table></div></div>\n";
					
				if($row->cid!=$champ){
					$display='display:none; ';
					$script="menu_open(\"data_$row->cid\",\"datas\"); return false;";
				}
				else{
					$display="";
					$script="menu_open(\"data_$row->cid\",\"datas\"); return false;";
				}
				
				echo "<div id='camp'>\n";
				echo "<div id='name' onclick='$script'>$row->cn</div>\n";
				echo "<div id='data_$row->cid' style='$display' class='datas'>\n";
				echo "<table class='lo_ultimo' cellpadding='0' cellspacing='0' width='100%'>\n";
				$cn=$row->cn;
			}
			
			$home=trim(substr($row->result,0,2));
			$away=trim(substr($row->result,-1,2));
			if($row->hshield=="")
				$row->hshield='imagenes/teams/mini_shields/default.jpg';
			if($row->ashield=="")
				$row->ashield='imagenes/teams/mini_shields/default.jpg';
			
			echo "<tr class='date'><td colspan='5' class='date'>".htmlentities(ucwords(strftime('%A, %d %B - %H:%M',$row->dm)))."</td></tr>\n";
			echo "<tr onClick='window.location=\"".base_url()."matches/publica/$row->id\";' >\n";
			echo "<td width='10%' >".img($row->hshield)."</td>\n";
			echo "<td width='30%' class='left'>$row->hname</td>\n";
			echo "<td  class='result'>vs</td>\n";
			echo "<td width='30%' class='right'>$row->aname</td>\n";
			echo "<td width='10%' >".img($row->ashield)."</td>\n";
			echo "</tr>\n";
			
			if(array_key_exists($i+1,$partidos))
				$pcn=$partidos[$i+1]->cn;
			else
				$pcn="Fin";
			if($pcn!=$cn){
				echo "</table>\n";
				echo "<div id='boton_mas'>\n";
				echo "<div style='float:left;'>".img('imagenes/icons/isotipo_plomo.jpg')."</div>\n";
				echo "<div style='float:right; margin-top:5px;'>".img('imagenes/icons/flecha.jpg')."</div>\n";
				echo "<div style='text-align:center; float:none; padding-top: 2px;'>\n";
				echo "<a href=".base_url()."matches_calendary/publica/".$row->cid." style='font-size:12px; text-decoration: none'>Calendario Completo</a>\n";
				echo "</div>\n";
				echo "</div></div></div>\n";
			}
			$i=$i+1;
		}
	}
	else{
		echo "Aun no existen partidos jugados.";	
	}
	?>
</div>