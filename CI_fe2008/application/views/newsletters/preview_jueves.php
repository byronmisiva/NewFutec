<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Boletin futbolecuador.com</title>
</head>

<body>
<table width="700" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
		<table width="700" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="504"><img
					src="<?=base_url()?>imagenes/newsletter/boletin_02.jpg" width="497"
					height="64" /></td>
				<td width="196">
				<div align="center"><span
					style='font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #00426f; font-weight: bold;'><?=ucfirst(strftime('%A, %d %B %Y'));?></span></div>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td height="266">
		<table width="691" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="333">
				<table width="700" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="4">
							<img src="<?=base_url()?>imagenes/newsletter/boletin_04.jpg" width="700" height="15" />
						</td>
					</tr>
					<tr>
						<td width="31">
							<img src="<?=base_url()?>imagenes/newsletter/boletin_05.jpg" width="29" height="170" />
						</td>
						<td width="180" align="center" >
							<div style='width:160px; height:160px; border:1px solid #05398C;'>
        						<a href="<?=base_url().$first->id;?>"><img src="<?=base_url().$first->thumbh160;?>" border="0" /></a>
							</div>
						</td>
						<td width="460">
					        	<a href="<?=base_url().$first->id;?>" style="font-family: Arial, Helvetica, sans-serif; font-size: 15pt; color: #000000; font-weight: bold;text-decoration:none;"><?=$first->title;?></a><br />
					            <span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; font-style: italic;"><?=$first->subtitle;?></span><br />
					          	<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #000000; text-align: justify;"><?=$first->lead;?></span>
					    </td>
						<td width="32">
							<img src="<?=base_url()?>imagenes/newsletter/boletin_09.jpg" width="32" height="170" />
						</td>
					</tr>
					<tr>
						<td colspan="4"><img
							src="<?=base_url()?>imagenes/newsletter/boletin_12.jpg"
							width="700" height="33" /></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align='center'>
		<a href='http://d1.openx.org/ck.php?zoneid=250236' target='_blank'><img src='http://d1.openx.org/avw.php?zoneid=250236&amp;cb=<?=rand()?>' border='0' alt='' /></a>
		<br />
		<br />
		</td>
	</tr>
	<tr>
		<td>
		<table width="700" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign=top height="27"><span
					style="font-size: 14pt; color: #00426f; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Noticias</span></td>
			</tr>
			<?php
			foreach($query as $row):
			?>
			<tr>
				<td>
				<table width="680" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign=top>
						<div align="left"><a href="<?=base_url().$row->id;?>"><img src="<?=base_url().$row->thumbh80?>"
							width="80" height="80" border="0" /></a></div>
						</td>
						<td width="580" valign=top><a href="<?=base_url().$row->id;?>"  style="font-family: Arial, Helvetica, sans-serif; font-size: 15pt; color: #000000; font-weight: bold;text-decoration:none;"><?=$row->title;?></a><br />
						<span
							style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-style: italic;"><?=$row->lead;?></span>
						</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td><img src="<?=base_url()?>imagenes/newsletter/boletin_37.jpg"
					width="680" height="19" /></td>
			</tr>
			<?php endforeach;?>
		</table>
		</td>
	</tr>

	<tr>
		<td height="77">
		<div align="center">
		<!-- PUBLICIDAD 2 -->
		</div>
		</td>
	</tr>
	<tr>
		<td>
		<p align="center"
			style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #00426f; font-weight: bold;">Ley
		de Comercio Electrónico del Ecuador: Este mensaje no puede ser
		considerado SPAM.</p>
		<p align="center"
			style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #00426f; font-weight: bold;">De
		acuerdo a la Ley de Comercio Electrónico del Ecuador y su Reglamento
		publicado en el Registro Oficial 735 del 31 de diciembre de 2002
		decreto No.3496 Artículo 22.- Si usted recibe este mensaje por error o
		desea ser removido de nuestra lista, por favor <a href="<?=base_url()?>newsletters/unregister">HAGA CLICK AQUI</a> para remover la dirección de la lista.</p>
		</td>
	</tr>
</table>
</body>
</html>
