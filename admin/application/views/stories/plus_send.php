<table class='options' cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td onClick="get_plus('plus','<?=base_url();?>stories/list_plus/visitadas','<?=base_url();?>');">+ Leídas</td>
		<td class='selected' >+ Enviadas</td>
	</tr>
</table>

<table class='noticias_plus' cellpadding="0" cellspacing="0" width="100%">
<?php 
foreach($noticias->result() as $noticia){
	echo "<tr><td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'>".$noticia->title."</td></tr>";
}
?>
</table>
