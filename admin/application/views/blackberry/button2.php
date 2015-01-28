<?
$name='';
$arrow='';
$link='';
$name2='';
$arrow2='';
$link2='';
foreach($buttons as $row):
if($row['type']==1){
	$name=$row['name'];
	$arrow='<<';
	$link=$row['link'];
}
if($row['type']==2){
	$name2=$row['name'];
	$arrow2='>>';
	$link2=$row['link'];
}
endforeach;
?>

<table width=100%>
<tr>
<td align="left" style='margin-top:1px; margin-bottom:1px; font-font:Arial; font-size:11px;'><a style="color: #06618D;" href='<?=base_url().$link?>'><?=$arrow.' '.$name.' '?></a></td>
</tr>
<tr>
<td align="right" style='margin-top:1px; margin-bottom:1px; font-font:Arial; font-size:11px;'><a style="color: #06618D;" href='<?=base_url().$link2?>'><?=' '.$name2.' '.$arrow2?></a></td>
</tr>
</table>
<br/>