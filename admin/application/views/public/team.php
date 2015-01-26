<div id='team'>
	<div style='float:right; border: 1px solid #06618D; padding: 5px;'><?=img($team->shield2);?></div>
	<div>
	<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
		<tr>
			<td>
				<table cellpadding="3" cellspacing="0" border="0" style="width:100%; background-color: white;">
				<tr>
				<td width='30%'>Nombre Oficial:</td>
				<td width='70%'><?=$team->name?></td>
				</tr>
				<tr>
				<td>Fundación:</td>
				<td><?=$team->foundation?></td>
				</tr>
				<tr>
				<td>Presidente del Club:</td>
				<td><?=$team->president?></td>
				</tr>
				<tr>
				<td>Director Técnico:</td>
				<td><?=$team->couch?></td>
				</tr>			
				<tr>
				<td>Estadio:</td>
				<td><?=$team->stadia?></td>
				</tr>
				<tr>
				<td>Página web oficial:</td>
				<td><a href='http://<?=$team->site;?>' target='_blank'><?=$team->site;?></a></td>
				</tr>
				<tr>
				<td>Página web no oficial:</td>
				<td>
				<?if($team->non_site!="") 
						echo "<a href='http://$team->non_site' target='_blank'>$team->non_site</a>";		
				?>
				</td>
				</tr>
				<tr>
				<td valign='top'>Jugadores Símbolos:</td>
				<td><?=strip_tags($team->best_players,'<br></br>')?></td>
				</tr>
				<tr>
				<td valign='top'>Palmarés:</td>
				<td><?=strip_tags($team->palmares,'<br></br>')?></td>
				</tr>
				</table>
			</td>
		</tr>
	</table>
	</div>
</div>