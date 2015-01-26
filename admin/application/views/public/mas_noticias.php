<div id='modulo'>
<table class='mas_noticias' cellpadding="0" cellspacing="0" width="100%" style='background-color:white; padding-bottom: 5px;'>
<tr>
<th onClick='window.location = "<?=base_url().'stories/more/'.$section;?>";' style='cursor: pointer;'>Más noticias</th>
<th onClick='window.location = "<?=base_url().'stories/more/28'?>";' style='cursor: pointer;'><?=$name?></th>
</tr>
<tr>
<td valign="top" >
<table class="noticias" cellpadding="0" cellspacing="0" style='margin-bottom: 5px;'>
<?php 
$read='';
foreach($mas_noticias as $noticia){
	if($this->session->userdata('role')>=3) 
		$read=' | Lecturas: '.$noticia->reads;
	echo "<tr><td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'><a href='".base_url()."stories/publica/$noticia->id'>".$noticia->title."</a> <div id='fecha'>".ucfirst(strftime('%B %d del %Y',$noticia->time)).$read."</div></td></tr>";
}
?>
</table>
</td>
<td valign="top" style='border-left: 1px solid black;'>
<table class="noticias1" cellpadding="0" cellspacing="0" style='margin-bottom: 5px;'>
<?php
$read='';
foreach($ecuatorianos as $noticia){
	if($this->session->userdata('role')>=3) 
		$read=' | Lecturas: '.$noticia->reads;
	echo "<tr><td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'><a href='".base_url()."stories/publica/$noticia->id'>".$noticia->title."</a> <div id='fecha'>".ucfirst(strftime('%B %d del %Y',$noticia->time)).$read."</div></td></tr>";
}
?>
</table>
</td>
</tr>
<tr>
<td align='left' class='ver_mas_left' >
	<div id='boton_mas' onClick='window.location ="<?=base_url().'stories/more/'.$section?>"'>
		<div style='float:left;'><?=img('imagenes/icons/isotipo_plomo.jpg');?></div>
		<div style='float:right; margin-top:5px;'><?=img('imagenes/icons/flecha.jpg');?></div>
		<div style='text-align:center; float:none; padding-top: 2px;'>
		<a href="<?=base_url().'stories/more/'.$section;?>"  style="font-size:12px; text-decoration: none">Ver más noticias </a>
		</div>
	</div>
</td>
<td align='right' class='ver_mas_right'>
	<div id='boton_mas' onClick='window.location ="<?=base_url().'stories/more/28'?>"'>
		<div style='float:left;'><?=img('imagenes/icons/isotipo_plomo.jpg');?></div>
		<div style='float:right; margin-top:5px;'><?=img('imagenes/icons/flecha.jpg');?></div>
		<div style='text-align:center; float:none; padding-top: 2px;'>
		<a href="<?=base_url().'stories/more/28'?>"  style="font-size:12px; text-decoration: none">Ver más noticias </a>
		</div>
	</div>
</td>
</tr>
</table>
</div>