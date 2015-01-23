<div id="admin">
	<h1><?=$title.''.$heading?></h1>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>LOCAL</th>
	<th>VISITANTE</th>
	<th>FECHA</th>
	<th>TIEMPO</th>
	<th>RESUMEN</th>
	<th></th>
	</tr>
	 <?php foreach($query as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->hname;?></td>
	 <td><?php echo $row->aname;?></td>
	 <td><?php echo $row->date_match;?></td>
	 <td><?php if($row->state==0) echo "No iniciado";
	 		   if($row->state==1) echo "Primer Tiempo";
	 		   if($row->state==2) echo "Primer Descanso";
	 		   if($row->state==3) echo "Segundo Tiempo";
	 		   if($row->state==4) echo "Segundo Descanso";
	 		   if($row->state==5) echo "Primer Extra";
	 		   if($row->state==6) echo "Segundo Extra";
	 		   if($row->state==7) echo "Penales";
	 		   if($row->state==8) echo "Finalizado";?></td>
	 <td><?php if($row->story_id>0) echo "Si"; else echo "No"?>
	 <td class="actions">
	 <?=anchor('matches_actions/index/'.$row->id.'/'.$row->hid.'/'.$row->aid, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
	 <?=anchor('lineups/index/'.$row->id.'/'.$row->hid, img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')), array('title' => 'Alineaci&oacute;n del Local'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>        
    </ul>
	</div>
</div>