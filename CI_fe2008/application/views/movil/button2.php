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
	$arrow='<img style="border:0px;" src="'.base_url().'imagenes/template/movil/flecha_izq.png"/>';
	$link=$row['link'];
}
if($row['type']==2){
	$name2=$row['name'];
	$arrow2='<img style="border:0px;" src="'.base_url().'imagenes/template/movil/flecha_der.png"/>';
	$link2=$row['link'];
}
endforeach;
?>
<div style="width:100%; height:28px;">
	<div style="float:left; margin:5px;font-font:Arial; font-size:12px;">
		<a style="color: #06618D;" href='<?=base_url().$link?>'><?=$arrow.' '.$name?></a>
	</div>
	<div style="float:right; margin:5px;font-font:Arial; font-size:12px;">
		<a style="color: #06618D;" href='<?=base_url().$link2?>'><?=$name2.' '.$arrow2?></a>
	</div>
</div>