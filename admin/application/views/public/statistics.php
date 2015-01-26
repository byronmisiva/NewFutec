<center>
<div id='modulo' style="background-color: #FFFFFF;">
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<th>Estadisticas del Equipo</th>
	</tr>
</table>
<br>
<div style="font-size: 13px;" id='tabla'>
<table cellpadding="3" cellspacing="0" width="100%"	class="tabla_posiciones" style="text-align: center;">
	<tr>
		<th></th>
		<th>Local</th>
		<th>Visitante</th>
		<th>General</th>
	</tr>
	<tr>
		<td style="text-align: left">Partidos Jugados</td>
		<td><?=$statistics['h']?></td>
		<td><?=$statistics['a']?></td>
		<td><?=$statistics['n']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">Partidos Ganados</td>
		<td><?=$statistics['wh']?></td>
		<td><?=$statistics['wa']?></td>
		<td><?=$statistics['w']?></td>
	</tr>
	<tr>
		<td style="text-align: left">Partidos Empatados</td>
		<td><?=$statistics['dh']?></td>
		<td><?=$statistics['da']?></td>
		<td><?=$statistics['d']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">Partidos Perdidos</td>
		<td><?=$statistics['lh']?></td>
		<td><?=$statistics['la']?></td>
		<td><?=$statistics['l']?></td>
	</tr>
	<tr>
		<td style="text-align: left">% Partidos Ganados</td>
		<td><?=$statistics['whp']?></td>
		<td><?=$statistics['wap']?></td>
		<td><?=$statistics['wp']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">% Partidos Empatados</td>
		<td><?=$statistics['dhp']?></td>
		<td><?=$statistics['dap']?></td>
		<td><?=$statistics['dp']?></td>
	</tr>
	<tr>
		<td style="text-align: left">% Partidos Perdidos</td>
		<td><?=$statistics['lhp']?></td>
		<td><?=$statistics['lap']?></td>
		<td><?=$statistics['lp']?></td>
	</tr>
	<tr class="altrow">
		<td><br>
		</td>
		<td><br>
		</td>
		<td><br>
		</td>
		<td><br>
		</td>
	</tr>
	<tr>
		<td style="text-align: left">Goles a Favor</td>
		<td><?=$statistics['ghe']?></td>
		<td><?=$statistics['gae']?></td>
		<td><?=$statistics['ge']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">Goles en Contra</td>
		<td><?=$statistics['ghr']?></td>
		<td><?=$statistics['gar']?></td>
		<td><?=$statistics['gr']?></td>
	</tr>
	<tr>
		<td style="text-align: left">Goles a Favor Por Partido</td>
		<td><?=$statistics['ghepp']?></td>
		<td><?=$statistics['gaepp']?></td>
		<td><?=$statistics['gepp']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">Goles en Contra Por Partido</td>
		<td><?=$statistics['ghrpp']?></td>
		<td><?=$statistics['garpp']?></td>
		<td><?=$statistics['grpp']?></td>
	</tr>
	<tr>
		<td style="text-align: left">% Goles a Favor</td>
		<td><?=$statistics['ghep']?></td>
		<td><?=$statistics['gaep']?></td>
		<td>100 %</td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">% Goles en Contra</td>
		<td><?=$statistics['ghrp']?></td>
		<td><?=$statistics['garp']?></td>
		<td>100 %</td>
	</tr>
	<tr>
		<td><br>
		</td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">Tarjetas Amarillas</td>
		<td><?=$cards['yh']?></td>
		<td><?=$cards['ya']?></td>
		<td><?=$cards['y']?></td>
	</tr>
	<tr>
		<td style="text-align: left">Tarjetas Rojas</td>
		<td><?=$cards['rh']?></td>
		<td><?=$cards['ra']?></td>
		<td><?=$cards['r']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">Tarjetas Amarillas Por Partido</td>
		<td><?=$cards['yhpp']?></td>
		<td><?=$cards['yapp']?></td>
		<td><?=$cards['ypp']?></td>
	</tr>
	<tr>
		<td style="text-align: left">Tarjetas Rojas Por Partido</td>
		<td><?=$cards['rhpp']?></td>
		<td><?=$cards['rapp']?></td>
		<td><?=$cards['rpp']?></td>
	</tr>
	<tr class="altrow">
		<td style="text-align: left">% Tarjetas Amarillas</td>
		<td><?=$cards['yhp']?></td>
		<td><?=$cards['yap']?></td>
		<td>100 %</td>
	</tr>
	<tr>
		<td style="text-align: left">% Tarjetas Rojas</td>
		<td><?=$cards['rhp']?></td>
		<td><?=$cards['rap']?></td>
		<td>100 %</td>
	</tr>

</table>
</div>
<br>
</div>
</center>
<div id='add_comment'>
<a href='<?=base_url().'teams/publica/'.$this->uri->segment(3)?>'>Estadísticas
		de los Jugadores</a>
</div>
