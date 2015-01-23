<?
if($type==1){
	$c1='#06618D';
	$c2='white';
	$pic=base_url().'imagenes/template/movil/iso_azul.jpg';
	$link=base_url().'moviles/scoreboard/'.$check;
	$n1='Noticias';
	$n2='<a href="'.$link.'" style="color:'.$c1.'; ">En vivo</a>';
	$n3='grey';
}
else{
	$c1='white';
	$c2='#06618D';
	$pic=base_url().'imagenes/template/movil/iso_blanco.jpg';
	$link=base_url().'welcome/movil/'.$check;
	$n1='Marcador en vivo';
	$n2='<a href="'.$link.'" style="color:'.$c1.'; ">Noticias</a>';
	$n3='#06618D';
}

?>

<table cellpadding="0" cellspacing="0" width=100% style="border-top:grey 1px solid; border-bottom:<?=$n3?> 1px solid; text-align:center; font-type:Arial; font-size:14px;">
	<tr>
		<td width=18% style="background-image: url(<?=$pic?>); height: 25px;"></td>
		<td width=35% style='background-color:<?=$c1?>; color:<?=$c2?>; '><?=$n1?></td>
		<td width=47% valign='bottom'  style='cursor:pointer; color:<?=$c1?>; border-bottom:2px solid <?=$c1?>;' onclick="window.location='<?=$link?>'"><div style="background-color:<?=$c2?>; height:18px; border-left:1px solid black; padding-top:4px; border-bottom:1px solid black;"><?=$n2?></div></td>
	</tr>
</table>