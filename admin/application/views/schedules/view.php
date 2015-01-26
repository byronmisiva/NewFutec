<div id="admin">
	<h1><?=$title?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/calendario_add.png','border'=>'0')) ?> <?=anchor('schedules/insert/'.$this->uri->segment(3),'Agregar Fecha')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th></th>
	</tr>
	 <?php foreach($schedules as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->season;?></td>
	 <td class="actions">
	 <?=anchor('schedules/position_up/'.$row->id.'/'.$championship->active_round, img(array('src'=>'imagenes/icons/arrow_up.png','border'=>'0')), array('title' => 'Arriba'));?>
	 <?=anchor('schedules/position_down/'.$row->id.'/'.$championship->active_round, img(array('src'=>'imagenes/icons/arrow_down.png','border'=>'0')), array('title' => 'Abajo'));?>
	 <?=anchor('schedules/update/'.$row->id.'/'.$championship->active_round, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('schedules/confirm_delete/'.$row->id.'/'.$championship->active_round.'/'.$row->round_id.'/'.$row->season.'/'.$row->position, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('rounds/index/'.$championship->id,'Rondas')?></li>
    </ul>
	</div>
</div>