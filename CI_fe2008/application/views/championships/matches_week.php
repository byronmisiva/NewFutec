<table class='lo_ultimo' cellpadding="0" cellspacing="0" width="100%">
<?php
if(count($partidos)>0){
	foreach($partidos as $row){
		echo "<tr onClick='window.location=\"".base_url()."matches/publica/$row->id\";' >\n";
		echo "<td class='left'>";
		echo "<div style='padding-top:5px;'>\n";
		echo "<div style='float: left; width: 10%; height: 20px;'> ".img($row->hthumb)."</div>\n";
		echo "<div style='float: left; width: 32%; height: 20px;font-size: 11px; padding: 3px;'>$row->hname</div>\n";
		echo "<div style='float: left; width: 10%; height: 20px;font-size: 14px; font-weight: bold;'>vs</div>\n";
		echo "<div style='float: left; width: 32%; height: 20px;font-size: 11px; padding: 3px; text-align: right;'>$row->aname</div>\n";
		echo "<div style='float: left; width: 10%; height: 20px;'> ".img($row->athumb)."</div>\n";
		echo "</div>\n";
		echo "<div style='float: right; width: 100%; font-size: 11px; text-align: center;'>$row->date_match</div>";
		echo "</td>\n";
		echo "</tr>\n";
	}
}
else
	echo "<tr><td align='center' class='blank'>Aun no existen partidos para esta semana.</td></tr>";	
?>
</table>