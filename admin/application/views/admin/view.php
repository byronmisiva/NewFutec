
<div id="admin">
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/news_add.png','border'=>'0')) ?> <?=anchor('stories/insert','Agregar Noticia')?></li>
    	<li> <?=img(array('src'=>'imagenes/icons/news_add.png','border'=>'0')) ?> <?=anchor('http://pegasus.mobile20.com/suscripciones','Mensajes SMS')?></li>
    </ul>
	</div>
	<table style='width: 100%' border='0'>
		<tr>
			<td width='50%' valign='top' >
			<table class='principal' border='1'>
				<tr>
					<th onClick="location.href='stories'" style='cursor: pointer;'>Ultimas Noticias</th>
				</tr>
				 <?php foreach($stories->result() as $row): ?>
				 <tr class='altrow'>
				 <td onClick="location.href='<?='stories/update/'.$row->id?>'"><?=$row->title;?></td>
				 </tr>
				 <?php endforeach;?>
			</table>
			</td >
			<td width='50%' valign='top'>
			<table class='principal'>
				<tr>
					<th colspan=3 onClick="location.href='matches'" style='cursor: pointer;'>Partidos de Hoy <?='('.mdate('%Y-%m-%d',time()).')'?></th>	
							
				</tr>
					<?php $tcheck=0;
						  foreach($matches as $row): ?>
						  
					 		<tr class='altrow'>
					 			<td width="66%"><?=$row->hname.' vs '.$row->aname?></td>
					 			<td width="15%"><?=date_format(date_create($row->date_match), 'H:i')?></td>

					 			<td width="19%"><?=anchor('matches/update/'.$row->id.'/'.$row->group_id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
					 				<?=anchor('matches_actions/index/'.$row->id.'/'.$row->team_id_home.'/'.$row->team_id_away, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
					 			    <?=anchor('lineups/index/'.$row->id.'/'.$row->team_id_home, img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')), array('title' => 'Alineaci&oacute;n del Local'));?></td>
					 		</tr>
							<? $tcheck=1?>
					 <?php endforeach;
					 	   if($tcheck==0){
					 			echo '<tr><th>No existen partidos hoy</th></tr>';
					 		}
					 	   ?>
			</table>
			</td>
		</tr>
		<tr>
			<td valign='top'>
			<table class='principal'>
				<tr>
					<th colspan=2 onClick="location.href='instant'" style='cursor: pointer;'>Patrocinadas</th>
				</tr>
				<?php foreach($sponsored as $row): ?>
				 <tr class='altrow'>
				 <td onClick="location.href='<?='stories/update/'.$row->sid?>'"><?=$row->title;?></td>
				 </tr>
				 <?php endforeach;?>
				
			</table>
			</td>
			<td valign='top'>
			<table class='principal'>
				<tr>
					<th colspan='2' onClick="location.href='comments'" style='cursor: pointer;'>Comentarios</th>
				</tr>
				</table>
			</td>
		</tr>
	</table>
</div>