<div id='modulo'>
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Resultados de Encuestas</th>
</tr>
</table>
</div>

<div id='resultado'>
	<?=$survey->title;?>
	<table cellpadding="0" cellspacing="2" width="90%">
	<?php
	foreach($options as $row){
		$width=$row->porcent*400;
		if($width<1)
			$width=1;
		echo "<tr>\n";
		echo "<td>$row->title <span style='font-size:12px'>($row->porcent%)</span></td>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td>".img("imagenes/izq.jpg").img(array("src"=>"imagenes/centro.jpg","width"=>$width,"height"=>"8")).img("imagenes/der.jpg")."</td>\n";
		echo "</tr>\n";
	}
	?>
	</table>
	Votos Totales: <span style='color:red;'><?=$survey->votes;?></span>
</div>

<div id='mas_encuestas'>
	Ultimas 5 encuestas:
	<ul style='list-style: none; padding: 10px;'>
	<?php
	foreach($last as $row){
		echo "<li style='padding: 5px;'>";
		echo anchor('surveys/results/'.$row->id, '<i>'.ucfirst(strftime('%B %d del %Y',$row->tcreated)).'</i> - '.$row->title." (Votos: ".$row->votes.")")."<br>";
		echo "</li>";
	}
	?>
	</ul>
	<div id='add_comment'>
	<?=anchor('surveys/last','Mas encuestas')?>
	</div>
</div>
