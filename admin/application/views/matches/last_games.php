<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<?php $tiempo['0']='No iniciado';
		  $tiempo['1']='Primer Tiempo';
		  $tiempo['2']='Fin del Primer Tiempo';
		  $tiempo['3']='Segundo Tiempo';
		  $tiempo['4']='Fin del Segundo Tiempo';
		  $tiempo['5']='Primer Tiempo Extra';
		  $tiempo['6']='Segundo Tiempo Extra';
		  $tiempo['7']='Penales';
		  $tiempo['8']='Fin del Partido';?>

	 	    <div style="margin: 10px">
		 		<table class='listing' border=1>
		 		<tr>
					<th>FECHA</th>
					<th>PARTIDO</th>
					<th>RESULTADO</th>
					<th>ESTADO</th>
					<th></th>
				</tr>
		 		<?php foreach($query->result() as $row):?>
		 		<tr class='altrow'>
		 			<td width="20%"><?=mdate('%Y-%m-%d %h:%i',$row->dm)?></td>
		 			<td width="40%"><?=$row->hname.' vs '.$row->aname?></td>
		 			<td width="10%"><?=$row->result?></td>
		 			<td width="15%"><?=$tiempo[$row->state]?></td>
		 			<td width="15%"><?=anchor('matches/update/'.$row->id.'/'.$row->rid, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
		 				<?=anchor('matches_actions/index/'.$row->id.'/'.$row->hid.'/'.$row->aid, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
		 			    <?=anchor('lineups/index/'.$row->id.'/'.$row->hid, img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')), array('title' => 'Alineaci&oacute;n del Local'));?></td>
		 		</tr>
		 		<?php endforeach;?>
		 		</table>
	 		</div>
</div>