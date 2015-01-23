<div id='modulo'>
	<div id='plus'>
		<table class='noticias_plus' cellpadding="0" cellspacing="0" width="227px">
		<tr>
		<th>La Voz de la Tribuna</th>
		</tr>
		</table>	
		<div id='blogs'>	
		<table cellpadding="2" cellspacing="0" width="100%">
		<?php
		foreach($noticias as $noticia){
			echo "<tr><td rowspan=2 onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'><img src='".base_url().$noticia->thumb3."'/></td>
			      <td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'>".ucfirst(strftime('%B %d del %Y',$noticia->time))."</td></tr>
				  <tr><td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'><b>".$noticia->title."</b></td></tr>";
		}
		?>
		</table>
		</div>
	</div>
</div>