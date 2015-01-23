<div id="admin">
	<h1><?=$title.''.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/equiposxcampeonato_add.png','border'=>'0')) ?> <?=anchor('championships_teams/insert/'.$this->uri->segment(3),'Agregar Equipos de Campeonato')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>ID</th>
	<th>NOMBRE EQUIPO</th>
	<th>BONIFICACI&Oacute;N</th>
	<th>RONDA DE BONO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->id;?></td>
	 <td><?php echo $row->tname;?></td>
	 <td><?php if($row->bonus==NULL) echo 'No'; else echo $row->bonus;?></td>
	 <td><?php if($row->rname==NULL) echo 'Ninguna'; else echo $row->rname;?></td>
	 <td class="actions">
	 <?=anchor('championships_teams/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')));?>
	 <?=anchor('championships_teams/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->tname.'/'.$row->cname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/campeonato.png','border'=>'0')) ?> <?=anchor('championships','Campeonatos')?></li>
    </ul>
	</div>
</div>