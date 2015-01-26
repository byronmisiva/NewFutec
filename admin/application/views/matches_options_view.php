<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>

	 <?php foreach($query->result() as $row): ?>
	 <br><br>
	 <b><?php echo $row->name ?></b>
	 <br>
	 
	 
	 <div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/accion.png','border'=>'0')) ?> <?=anchor('actions/index/'.$this->uri->segment(3).'/'.$row->id, 'ACCIONES')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/gol.png','border'=>'0')) ?> <?=anchor('goals/index/'.$this->uri->segment(3).'/'.$row->id, 'GOLES')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/tarjeta.png','border'=>'0')) ?> <?=anchor('cards/index/'.$this->uri->segment(3).'/'.$row->id, 'TARJETAS')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/cambio.png','border'=>'0')) ?> <?=anchor('changes/index/'.$this->uri->segment(3).'/'.$row->id, 'CAMBIOS')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')) ?> <?=anchor('lineups/index/'.$this->uri->segment(3).'/'.$row->id, 'ALINEACI&Oacute;N')?></li>
    </ul>
	</div>
	 
	<?php endforeach; ?>
	<br>
	<?php $row=$query2->result(0);?>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0')) ?> <?=anchor('matches/index/'.$row[0]->group_id,'Partidos')?></li>
    </ul>
	</div>	  
</div>