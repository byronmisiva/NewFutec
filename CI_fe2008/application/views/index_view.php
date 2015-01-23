	<h1><?php echo $title; echo $heading;?></h1>
	<br>
	<?php echo mdate($datestring,$time);?>
	<br><br>
	<table border=1>
	<tr>
	 <td><?php echo anchor('referee', '&Aacute;rbitros')?></td>
	 <td><?php echo anchor('championships', 'Campeonatos')?></td>
	</tr>
	<tr>
	 <td><?php echo anchor('categories', 'Categor&iacute;as')?></td>
	 <td><?php echo anchor('headers', 'Encabezados')?></td>
	</tr>
	<tr>
	 <td><?php echo anchor('surveys', 'Encuestas')?></td>
	 <td><?php echo anchor('teams', 'Equipos')?></td>
	</tr>
	<tr>
	 <td><?php echo anchor('stadiums', 'Estadios')?></td>
	 <td><?php echo anchor('stories', 'Historias')?></td>
	</tr>
	<tr>
	 <td><?php echo anchor('images', 'Im&aacute;genes')?></td>
	 <td><?php echo anchor('players', 'Jugadores')?></td>
	</tr>
	<tr>
	 <td><?php echo anchor('media', 'Medios')?></td>
	 <td><?php echo anchor('modules', 'M&oacute;dulos')?></td>
	</tr>
	<tr>
	 <td><?php echo anchor('sections', 'Secciones')?></td>
	 <td><?php echo anchor('users', 'Usuarios')?></td>
	</tr>
	</table>
