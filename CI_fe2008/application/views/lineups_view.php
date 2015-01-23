<div id="admin">
	<h1><?=$title.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/alineacion_add.png','border'=>'0'))?> <?=anchor('lineups/insert/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Agregar Alineaci&oacute;n')?></li>
    	<li> <?=img(array('src'=>'imagenes/icons/alineacion.png','border'=>'='))?> <?=anchor('lineups/index/'.$this->uri->segment(3).'/'.$t2id,'Alineaci&oacute;n '.$t2)?>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>JUGADOR</th>
	<th>ESTADO</th>
	<th>POSICI&Oacute;N</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>   
	 <tr class='altrow'>
	 <td><?php echo $row->first_name.' '.$row->last_name;?></td>
	 <td><?php if($row->status==1) echo "Titular"; else echo "Suplente"?></td>
	 <td><?php echo $row->position;?></td>
	 <td class="actions">
	 <?=anchor('lineups/delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0')) ?> <?=anchor('matches/index/'.$m,'Partido')?></li>
    </ul>
	</div>
</div>