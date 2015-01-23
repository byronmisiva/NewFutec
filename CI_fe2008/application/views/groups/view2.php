<div id="admin">
	<h1><?=$heading?></h1>
	<h2><?=$championship->name?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/grupoequipo_add.png','border'=>'0')) ?> <?=anchor('groups/insert/'.$this->uri->segment(3),'Agregar Grupos')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<? echo $this->session->flashdata('delete_error');?>
	</ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>DESCRIPCI&Oacute;N</th>
	<th></th>
	</tr>
	 <?php foreach($groups as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->description;?></td>
	 <td class="actions">
	 <?=anchor('groups/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('groups/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->name.'/'.$row->rname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('matches/index/'.$row->id, img(array('src'=>'imagenes/icons/partido.png','border'=>'0')), array('title' => 'Partidos'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('matches_calendary/matches_all/'.$championship->id,'Partidos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')) ?> <?=anchor('rounds/index/'.$championship->id,'Rondas')?></li>
    </ul>
	</div>
</div>