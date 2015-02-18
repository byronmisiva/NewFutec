<?=$survey->title;?>sss
<table class='opciones' cellpadding="0" cellspacing="0" width="100%">
<?php
foreach($options as $row){
	$width=$row->porcent*200;
	$por=$row->porcent*100;
	if($width<1)
		$width=1;
	echo "<tr>\n";
	echo "<td>$row->title ($row->votes - $por %)</td>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td>".img("imagenes/izq.jpg").img(array("src"=>"imagenes/centro.jpg","width"=>$width,"height"=>"8")).img("imagenes/der.jpg")."</td>\n";
	echo "</tr>\n";
}

?>
<tr>
<td align='center' style='font-size: 12px; font-weight: bold;'>
<br>
Votos: <?=$survey->votes;?>
</td>
</tr>
</table>
<br>
<?=anchor('surveys/results/'.$survey->id,'Resultados');?><br>
<?=anchor('ultimas-encuestas','Encuestas');?><br>