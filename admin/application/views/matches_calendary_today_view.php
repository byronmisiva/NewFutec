<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<?php 
		  $champ='';
		  $round='';
		  $group=''; 
		  $sn='';
		  $tiempo['0']='No iniciado';
		  $tiempo['1']='Primer Tiempo';
		  $tiempo['2']='Fin del Primer Tiempo';
		  $tiempo['3']='Segundo Tiempo';
		  $tiempo['4']='Fin del Segundo Tiempo';
		  $tiempo['5']='Primer Tiempo Extra';
		  $tiempo['6']='Segundo Tiempo Extra';
		  $tiempo['7']='Penales';
		  $tiempo['8']='Fin del Partido';
		  $tcheck=0;
	 ?>
	 
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato.png','border'=>'0')) ?> <?=anchor('championships','Campeonatos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('rounds/index/'.$id,'Rondas')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/grupoequipo.png','border'=>'0')) ?> <?=anchor('groups/all/'.$id.'/'.$round,'Grupos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/calendario.png','border'=>'0')) ?> <?=anchor('schedules/all/'.$id.'/'.$round,'Fechas')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0')) ?> <?=anchor('championships_teams/index/'.$id,'Equipos')?></li>
    </ul>
	</div>
	
	
	 <?php foreach($query->result() as $row): 
	       if($champ!=$row->cn){
	 			if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div></div></div></div><br>';
	 			}
	 			echo '<div style="margin-left: 10px; border: 1px outset gray; padding: 5px;">'.$row->rn;
	 			echo '<div style="margin-left: 5px; font-size; 12px;">'.$row->gn;
	 			echo '<div style="margin-left: 5px">Fecha '.$row->sn;
	 			$champ=$row->cn;
		  		$round=$row->rn;
		  		$group=$row->gn; 
		  		$sn=$row->sn;
		  		echo "<table class='listing'>";
		  		$tcheck=1;
	 	   }
	 	   if($round!=$row->rn){
		  		if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div></div></div>';
		  		}
	 	   		echo '<div style="margin-left: 5px">'.$row->rn;
	 			echo '<div style="margin-left: 5px">'.$row->gn;
	 			echo '<div style="margin-left: 5px">Fecha '.$row->sn;
		  		$round=$row->rn;
		  		$group=$row->gn; 
		  		$sn=$row->sn;
		  		echo "<table class='listing' border=1>";
		  		$tcheck=1;
	 	   }
	 	   /*if($group!=$row->gn){
		  		if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div></div>';
	 	   		}
	 			echo '<div style="margin-left: 5px">'.$row->gn;
	 			echo '<div style="margin-left: 5px">Fecha '.$row->sn;
		  		$group=$row->gn; 
		  		$sn=$row->sn;
		  		echo "<table class='listing' border=1>";
		  		$tcheck=1;
	 	   }*/
	 	   if($sn!=$row->sn){
		  		if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div>';
		  		}
	 			echo '<div style="margin-left: 5px">Fecha '.$row->sn;
		  		$sn=$row->sn;
		  		echo "<table class='listing' border=1>";
		  		$tcheck=1;
	 	   }?>
	 		
	 		<tr class='altrow'>
	 			<td width="20%"><?= date_format(date_create($row->date_match), 'Y-m-d H:i')?></td>
	 			<td width="40%"><?=$row->hname.' vs '.$row->aname?></td>
	 			<td width="10%"><?=$row->result?></td>
	 			<td width="15%"><?=$tiempo[$row->state]?></td>
	 			<td width="15%"><?=anchor('matches/update/'.$row->id.'/'.$row->gid, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 				<?=anchor('matches_actions/index/'.$row->id.'/'.$row->hid.'/'.$row->aid, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
	 			    <?=anchor('lineups/index/'.$row->id.'/'.$row->hid, img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')), array('title' => 'Alineaci&oacute;n del Local'));?></td>
	 		</tr>

	 <?php endforeach;
	 	   if($tcheck!=0){
	 		echo '</table></div></div></div></div>';
	 		}
	 	   else
	 	   	echo 'No existen partidos hoy'?>
</div>