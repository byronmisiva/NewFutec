<div id='alerts'>
<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<th colspan=2> ALERTAS </th>	
	<tr>
	<? if($today_match!=0){ ?>
	<tr>
		<td class="link"><?=anchor('matches/matches_today_view','Partidos de Hoy')?></td>
		<td class="value"><?=$today_match?></td>
	</tr>
	<? } if($no_aprov!=0){ ?>
	<tr>
		<td class="link"><?=anchor('comments/unaproved','Comentarios sin Aprobar')?></td>
		<td class="value"><?=$no_aprov?></td>
	</tr>
	<? } if($no_striker_pic!=0){ ?>
	<tr>
		<td class="link"><?=anchor('players/no_pic_view','Goleador sin Foto')?></td>
		<td class="value"><?=$no_striker_pic?></td>
	</tr>
	<? } if($programed!=0){ ?>
	<tr>
		<td class="link"><?=anchor('stories/programed_view','Noticias Programadas')?></td>
		<td class="value"><?=$programed?></td>
	</tr>
	<? } if($no_image_pic!=0){ ?>
	<tr>
		<td><?=anchor('images/no_thumb','Imagenes sin Thumb')?></td>
		<td class="value"><?=$no_image_pic?></td>
	</tr>
	<? } if($active_survey!=0){ ?>
	<tr>
		<td><?=anchor('surveys/active_survey','Encuestas Activas')?></td>
		<td class="value"><?=$active_survey?></td>
	</tr>
	<? } if($late_games!=0){ ?>
	<tr>
		<td><?=anchor('matches/late_games','Partidos Atrasados')?></td>
		<td class="value"><?=$late_games?></td>
	</tr>
	<? } if($player_teams!=0){ ?>
	<tr>
		<td><?=anchor('players/player_teams','Jugadores + de 2 Equipos')?></td>
		<td class="value"><?=$player_teams?></td>
	</tr>
	<? } if($old_images!=0){ ?>
	<tr>
		<td><?=anchor('images/images_review','Imagenes Antiguas')?></td>
		<td class="value"><?=$old_images?></td>
	</tr>
	<? } ?>
	
</table>
</div>