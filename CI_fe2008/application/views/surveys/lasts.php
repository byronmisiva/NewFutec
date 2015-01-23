<div id='modulo'>
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Resultados de Encuestas</th>
</tr>
</table>
</div>

<div id='mas_encuestas'>
	Ultimas <?=$num?> encuestas:
	<ul style='list-style: none; padding: 10px;'>
	<?php
	foreach($last as $row){
		echo "<li style='padding: 5px;'>";
		echo anchor('surveys/results/'.$row->id, '<i>'.ucfirst(strftime('%B %d del %Y',$row->tcreated)).'</i> - '.$row->title." (Votos: ".$row->votes.")")."<br>";
		echo "</li>";
	}
	?>
	</ul>
</div>