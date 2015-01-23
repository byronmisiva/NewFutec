<table class='options' cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width='50%' onClick="ajax_update('results','<?=base_url();?>teams/ultimos/<?=$team;?>');">Resultados</td>
		<td width='50%' class='selected'>Próxima Fecha</td>
	</tr>
</table>
<div id='ultimos' style='padding: 2px; background-color: white;'>
<table class='lo_ultimo' cellpadding="0" cellspacing="0" width="100%">

<?php
$group=0;
if(count($partidos)>0){
	foreach($partidos as $row){
		if($group!=$row->group_id){
			echo "<tr class='title'><td colspan='5' class='title'>".$champs[$row->group_id]."</td></tr>";
			$group=$row->group_id;
		}
		$pieces = explode(" ", $row->date_match);
		echo "<tr class='date'><td colspan='3' class='date' align='left'>".$pieces[0]."</td><td colspan='2' class='date' align='right'>".$pieces[1]."</td></tr>";
		echo "<tr onClick='window.location=\"".base_url()."matches/publica/$row->id\";' >\n";
		echo "<td width='10%' >".img($row->home_shield)."</td>\n";
		echo "<td width='30%' class='left'>$row->home_name</td>\n";
		echo "<td  class='result'>vs</td>\n";
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