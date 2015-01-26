<div id='list_rss'>

<div class='mensaje'>
<strong>¿Que es un feed de noticias ?</strong>
<p>
Un feed de noticias (también conocido como RSS) es un listado del contenido
de un sito web. Se actualiza cada vez que un nuevo contenido se publica en
el sitio.
 
Los lectores de noticias "se suscriben" a los canales de noticias, lo que
significa que 
ellos descargarán las listas de historias en un intervalo que sea
especificado (cada 30 minutos, por ejemplo), y que usted presentará a su
lector de noticias.
 
Un feed de noticias opcionales contiene una lista de titulares de las
historias, una lista de citas, o una lista con pequeños extractos de cada
historia del sitio web (futbolecuador.com contiene extractos).
 
Todos los canales de noticias tendrá un enlace para volver al sitio web, de
modo que si usted ve un título / extracto / historia, y lo desea, puede
hacer clic en el del pedazo del contenido, y será llevado al sitio web para
leerlo.
</p>
<p>
A continuación encontrarás los diferentes links para que te registres desde tu lector RSS preferido
y puedas obtener nuestras noticias de la manera mas rapida.
</p>
</div>


<?php foreach($results as $row):?>
	<div id='rss'>
		<table cellpadding="0" cellspacing="3" width='95%' align='center'>
		<tr>
			<td rowspan='3' width='65px'><a href='http://feeds.feedburner.com/futbolecuador/<?=$row->id;?>'><?=img(array('src'=>$row->image_rss,'border'=>0))?></a></td>
			<td class='title' width='100%'><a href='http://feeds.feedburner.com/futbolecuador/<?=$row->id;?>'><?=$row->name?></a></td>
			<td width='150px'><a href='<?=$google.$row->id?>' <?=$track?>><img src='http://buttons.googlesyndication.com/fusion/add.gif' width='104' height='17' style='border:0' alt='Añadir a mi Google'/></a></td>
		</tr>
			<tr>
			<td><?=$row->description?></td>
			<td ><a href='<?=$yahoo.$row->id?>' <?=$track?>><img src='http://eur.i1.yimg.com/eur.yimg.com/i/es/my/addto1.gif' width='91' height='17' border='0' align=middle alt='Añadir a Mi Yahoo!'></a></td>
		</tr>
		</table>
	</div>
<?php endforeach;?>
</div>