<div id='modulo' style="width: 180px;">
	<div id='plus'>
		<div id='blogs' width="180px">	
		<table cellpadding="2" cellspacing="0" width="180px">
		<?php
		foreach($noticias as $noticia){
			echo "<tr>
					<td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'>
						<center><img src='".base_url().$noticia->thumb1."'/></center>
					</td>
				  </tr>
				  <tr>						
				      <td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'>
				      	".ucfirst(strftime('%B %d del %Y',$noticia->time))."
				      </td>
			      </tr>
				  <tr>
				  	<td onClick='window.location=\"".base_url()."stories/publica/$noticia->id\";'>
				  		<b>".$noticia->title."</b>
				  	</td>
				  </tr>";
		}
		?>
		</table>
		</div>
	</div>
</div>