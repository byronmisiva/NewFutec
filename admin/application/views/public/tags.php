<div id='modulo'>
	<table class='noticias_plus' cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th>Etiquetas</th>
		</tr>
	</table>
	<div style="background-color:#FFFFFF; padding: 2px; text-align: justify;" >
			<?$i=1;
			  $color1='#E8E8E8';
			  $color2='#34293A';
			  foreach($tag as $row):
			  	$apu=$row['num']+1;
			  	echo '<a href="'.base_url().'stories/tags/'.underscore($row['name']).'" style="text-decoration: none; "><span id="tag'.$i.'"onmouseover="change_font(\'tag'.$i.'\',\''.$apu.'px\',\''.$color1.'\',\''.$color2.'\')"onmouseout="change_font(\'tag'.$i.'\',\''.$row['num'].'px\',\'white\',\'#'.$row['r'].$row['g'].$row['b'].'\')"style="text-decoration: none; font-size:'.$row['num'].'px; color:#'.$row['r'].$row['g'].$row['b'].'">'.$row['name'].'</span></a>'."\n";
			  	$i+=1;
			  endforeach;?>	  
	</div>
</div>