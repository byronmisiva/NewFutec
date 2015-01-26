<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/accion_add.png','border'=>'0')) ?> <?=anchor('actions/insert/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Agregar Acciones')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>ACCI&Oacute;N</th>
	<th>MINUTO</th>
	<th>CREADO</th>
	<th>TIPO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->text;?></td>
	 <td><?php echo $row->match_time;?></td>
	 <td><?php echo $row->created;?></td>
	 <td><?php echo $row->type;?></td>
	 <td class="actions">
	 <?=anchor('actions/update/'.$row->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('actions/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$row->text.'/'.$row->tname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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