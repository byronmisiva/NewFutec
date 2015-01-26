<div id="admin">
	<h1><?= $title.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/historiaequipo_add.png','border'=>'0')) ?> <?=anchor('histories/insert/'.$this->uri->segment(3),'Agregar Historias')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>PALMARES</th>
	<th>MEJORES JUGADORES</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->palmares;?></td>
	 <td><?php echo $row->best_players;?></td>
	 <td class="actions">
	 <?=anchor('histories/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('histories/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/equipo.png','border'=>'0')) ?> <?=anchor('teams','Equipos')?></li>
    </ul>
	</div>
</div>