<table class='lo_ultimo' cellpadding="0" cellspacing="0" width="100%">
<?php
if(count($partidos)>0){
	foreach($partidos as $row){
		echo "<tr onClick='window.location=\"".base_url()."matches/publica/$row->id\";' >\n";
		echo "<td width='10%' >".img($row->hthumb)."</td>\n";
		echo "<td width='30%' class='left'>$row->hname</td>\n";
		echo "<td  class='result'>".trim($row->hresult)."</td>\n";
		echo "<td  class='result'>".trim($row->aresult)."</td>\n";
		echo "<td width='30%' class='right'>$row->aname</td>\n";
		echo "<td width='10%' >".img($row->athumb)."</td>\n";
		echo "</tr>\n";
	}
}
else
	echo "<tr><td align='center' class='blank'>Aun no existen partidos jugados.</td></tr>";	
?>
</table>