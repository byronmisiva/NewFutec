<table class='noticias_plus' cellpadding="0" cellspacing="0" width="100%">
<?php 
foreach($noticias->result() as $noticia){
	echo "<tr><td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'>".$noticia->title."</td></tr>";
}
?>
</table>
