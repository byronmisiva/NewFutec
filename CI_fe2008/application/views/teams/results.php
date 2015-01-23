
<table class='options' cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width='50%' class='selected'>Resultados</td>
		<td width='50%' onClick="ajax_update('results','<?=base_url();?>teams/por_jugar/<?=$team;?>');">Por Jugar</td>
	</tr>
</table>
<div id='ultimos' style='padding: 2px; background-color: white;'>
<table class='lo_ultimo' cellpadding="0" cellspacing="0" width="100%">

<?php
$group=0;
if(count($partidos)>0){
	foreach($partidos as $row){
		if($group!=$row->group_id){
			echo "<tr class='title'><td colspan='6' class='title'>".$champs[$row->group_id]."</td></tr>";
			$group=$row->group_id;
		}
		echo "<tr onClick='window.location=\"".base_url()."matches/publica/$row->id\";' >\n";
		echo "<td width='10%' >".img($row->home_shield)."</td>\n";
		echo "<td width='30%' class='left'>$row->home_name</td>\n";
		echo "<td  class='result'>".trim($row->home_result)."</td>\n";
		echo "<td  class='result'>".trim($row->away_result)."</td>\n";
		echo "<td width='30%' class='right'>$row->away_name</td>\n";
		echo "<td width='10%' >".img($row->away_shield)."</td>\n";
		echo "</tr>\n";
	}
}
else{
	echo "<tr><td align='center' class='blank'>El equipo no tiene partidos jugados</td></tr>";	
}
?>
</table>
</div>