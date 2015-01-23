<div id='title'>Comentarios</div>
<?php
foreach($comments as $row){
	$via='futbolecuador';
	if(substr($row->description,0,3)=='fb:')
		$via='facebook';
	
	echo "<div id='comment'>";
	echo "<div style='float:left;  font-style: normal; color: grey; font-size: 18px; padding-right:4px;'>".$total." </div>"." <div id='texto'> ".strip_tags($row->text)."</div>";
	echo "<br/><div id='usuario'>$row->username <span style='font-style: normal; color: black;'>via $via</span></div>";
	echo "<div id='fecha'>".$row->created."</div>";
	echo "</div>";
	$total--;
}
?>
<div id='title'></div>
