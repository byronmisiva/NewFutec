<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/gol_add.png','border'=>'0')) ?> <?=anchor('goals/insert/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Agregar Goles')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>EQUIPO</th>
	<th>JUGADOR</th>
	<th>MINUTO</th>
	<th>TIPO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->tname;?></td>
	 <td><?php echo $row->first_name.' '.$row->last_name;?></td>
	 <td><?php echo $row->minute;?></td>
	 <td><?php if($row->type==1) echo 'Normal'; if($row->type==2) echo 'Penal'; if($row->type==3) echo 'Autogol'?></td>
	 <td class="actions">
	 <?=anchor('goals/update/'.$row->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('goals/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$row->tname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<?php $row=$query2->result(0);?>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/opcion.png','border'=>'0')) ?> <?=anchor('matches/matches_options/'.$row[0]->id.'/'.$row[0]->team_id_home.'/'.$row[0]->team_id_away,'Opciones del Partido')?></li>
    </ul>
	</div>
</div>