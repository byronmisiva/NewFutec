<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>css/public.css">
	</head>
	<body>
		<table width="570">
			<tr>
				<td colspan=2><center><a href="<?=base_url()?>" target="_blank"><?=img(array('src'=>'imagenes/boletin/head.jpg','border'=>'0'))?></a></center></td>
			</tr>
		</table>
		<br>
		<div style='background-color:#FFFFFF; width: 570px;' >
			<table id='data' >
			<tr><td class='date'><?='Noticias del d&iacute;a / '.mdate('%d de %M de %Y',time())?></td></tr>
			</table><br>
		</div>
		
		<?foreach($query->result() as $row):?>
		<div style='background-color:#FFFFFF; width: 570px;'>
			<div id=story>
			<table id='data' >
				<tr>
					<td  rowspan='3' class="image">
						<a href="<?=base_url()?>stories/publica/<?=$row->id?>" target="_blank"><?=img(array('src'=>base_url().$row->thumb150,'border'=>'0'))?></a>
					</td>
					<td class="title">
						<a href="<?=base_url()?>stories/publica/<?=$row->id?>" target="_blank"><?=$row->title?></a>
					</td>
				</tr>
				<tr>
					<td class='subtitle'>
						<?=$row->subtitle?>
					</td>
				</tr>
				<tr>
					<td class="lead">
						<?=strip_tags($row->lead)?>
					</td>
				</tr>
			</table>
			</div>
		</div>
		<?endforeach;?>
		<div style='background-color:#FFFFFF; width: 570px;'>
			<font size=2>
			<br><br>
				<b>Suscripciones:</b> Este e-mail es autogenerado y lo recibes porque te suscribiste a este bolet&iacute;n a trav&eacute;s de <a href="<?=base_url()?>" target="_blank">Futbol Ecuador</a>. 
				Si deseas modificar tus suscripciones, puedes hacerlo <a href="<?=base_url()?>" target="_blank">aqu&iacute;</a>.
			</font>
		</div>
	</body>
</html>