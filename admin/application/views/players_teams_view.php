<div id="admin">
	<h1><?=$title.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/jugadoresxequipo_add.png','border'=>'0')) ?> <?=anchor('players_teams/insert/'.$this->uri->segment(3),'Agregar Jugadores de Equipos')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>JUGADOR</th>
	<th>EQUIPO</th>
	<th>ENTRADA</th>
	<th>SALIDA</th>
	<th></th>
	</tr>
	<?php foreach($query->result() as $row): ?>
	<tr class='altrow'> 
	<td><?php echo $row->plname." ".$row->pfname;?></td>
	<td><?php echo $row->tname;?></td>
	<td><?php echo $row->date_in;?></td>
	<td><?php echo $row->date_out;?></td>
	<td class="actions">
	 <?=anchor('players_teams/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->pfname.'/'.$row->plname.'/'.$row->tname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	</td>
	</tr>
	<?php endforeach;?>
	</table>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/equipo.png','border'=>'0')) ?> <?=anchor('teams','Equipos')?></li>
    </ul>
	</div>
</div>