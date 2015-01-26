<div id="admin">
	<h1><?=$title.''.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/partido_add.png','border'=>'0')) ?> <?=anchor('matches/insert/'.$this->uri->segment(3),'Agregar Partidos')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>LOCAL</th>
	<th>VISITANTE</th>
	<th>ESTADIO</th>
	<th>FECHA</th>
	<th>TIEMPO</th>
	<th>RESUMEN</th>
	<th>EN VIVO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->hname;?></td>
	 <td><?php echo $row->aname;?></td>
	 <td><?php echo $row->sname;?></td>
	 <td><?php echo $row->date_match;?></td>
	 <td><?php if($row->state==0) echo "No iniciado";
	 		   if($row->state==1) echo "Primer Tiempo";
	 		   if($row->state==2) echo "Fin Primer Tiempo";
	 		   if($row->state==3) echo "Segundo Tiempo";
	 		   if($row->state==4) echo "Fin Segundo Tiempo";
	 		   if($row->state==5) echo "Primer Extra";
	 		   if($row->state==6) echo "Segundo Extra";
	 		   if($row->state==7) echo "Penales";
	 		   if($row->state==8) echo "Fin del Partido";?></td>
	 <td><?php if($row->story_id>0) echo "Si"; else echo "No"?></td>
	 <td><?php if($row->live==1)  echo "Si"; else echo "No";?>
	 <td class="actions">
	 <?=anchor('matches/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('matches/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->hname.'/'.$row->aname.'/'.$row->gname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('matches_actions/index/'.$row->id.'/'.$row->hid.'/'.$row->aid, img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')), array('title' => 'Opciones'));?>
	 <?=anchor('lineups/index/'.$row->id.'/'.$row->hid, img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')), array('title' => 'Alineaci&oacute;n del Local'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<iframe src="<?=base_url().'gacos/matches_view_admin/'.$ifrm?>" width="800" height="180" frameborder="0" align="top">
		No tienes soporte para iFrames
	</iframe>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>N&Uacute;MERO</th>
	<th>LOCAL</th>
	<th>VISITANTE</th>
	<th></th>
	</tr>
	 <?php if($gaco_matches!=''){ foreach($gaco_matches as $row): ?>
	 <tr class='altrow'>
	 <td><?=$row['id']?></td>
	 <td><?=$row['th']?></td>
	 <td><?=$row['ta']?></td>
	 <td class="actions">
	 <?=anchor('matches/gaco_confirm_delete/'.$row['id'].'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;}?>
	 </table>
	 <br>
	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <?php $row=current($query2->result());?>
        <li> <?=img(array('src'=>'imagenes/icons/grupoequipo.png','border'=>'0')) ?> <?=anchor('groups/index/'.$row->round_id,'Grupos')?></li>
    </ul>
	</div>
</div>