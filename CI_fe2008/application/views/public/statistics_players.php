<center>
<div id='modulo' style="background-color:#FFFFFF;">	
	<?php if($striker) {?>
	<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th>Estadisticas de los Jugadores de <?=$name?> </th>
		</tr>
	</table>
	<div id='add_comment' style='text-align:left;'>
	<a href='<?=base_url().'sections/publica/'.$this->uri->segment(3)?>'>Regresar a <?=$name?></a>
	</div>
	<br>
	<div id='tabla' style='width:98%;' >
	<table cellpadding="3" cellspacing="0" width="100%"  class="tabla_posiciones" style="text-align:center; font-family: arial; font-size: 14px;">	
		<?php 
		echo '<tr>
			  	<th></th>
			  	<th><img src="'.base_url().'imagenes/icons/gol2.png"/></th>
			  	<th><img src="'.base_url().'imagenes/icons/cancha_pelota.png"/></th>
			  	<th><img src="'.base_url().'imagenes/icons/cancha_porcentaje.png"/></th>
			  	<th><img src="'.base_url().'imagenes/icons/tarjeta_amarilla2.png"/></th>
			  	<th><img src="'.base_url().'imagenes/icons/tarjeta_roja2.png"/></th>
			  </tr>';
		$i=1;
		foreach($striker as $ace):
			if($i%2==0)
				$clas=' class="altrow"';
			else
				$clas='';
			echo '<tr'.$clas.'><td style="text-align:left">'.$ace['name'].'</td><td>'.$ace['gol'].'</td><td>'.$ace['gol_match'].'</td><td>'.$ace['gol_team'].'</td><td>'.$ace['y'].'</td><td>'.$ace['r'].'</td></tr>';
			$i+=1;
		endforeach;
		?>
	</table>
	</div>
	<br>
	<div style="width: 60%"  id='tabla' >
	<table  cellpadding="1" cellspacing="3" width="60%"  class="tabla_posiciones" style="text-align:center; font-family: arial; font-size: 14px;">
		<?='<tr><td><img src="'.base_url().'imagenes/icons/gol2.png"/></td><td>Goles</td></tr>
			<tr><td><img src="'.base_url().'imagenes/icons/cancha_pelota.png"/></td><td>Goles Por Partido</td></tr>
			<tr><td><img src="'.base_url().'imagenes/icons/cancha_porcentaje.png"/></td><td>Porcentaje de Goles del Equipo</td></tr>
			<tr><td><img src="'.base_url().'imagenes/icons/tarjeta_amarilla2.png"/></td><td>Tarjetas Amarillas</td></tr>
			<tr><td><img src="'.base_url().'imagenes/icons/tarjeta_roja2.png"/></td><td>Tarjetas Rojas</td></tr>';
		?>
	</table>
	</div>
	<br>
	<?php }?>
</div>
</center>