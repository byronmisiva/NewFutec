<div id="admin">
	<h1><?=$title.''.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/ronda_add.png','border'=>'0')) ?> <?=anchor('rounds/insert/'.$this->uri->segment(3),'Agregar Rondas')?></li>
    </ul>
	</div>
	<br><br>
	<div class="validation">
	<ul>
		<?= $this->session->flashdata('errors_image'); ?>
		<?= $this->session->flashdata('delete_error'); ?>
	</ul>
	</div>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>PRIORIDAD</th>
	<th>&Uacute;LTIMO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->priority;?></td>
	 <td><?php if($row->oname==NULL) echo "Ninguna"; else echo $row->oname;?></td>
	 <td class="actions">
	 <?=anchor('rounds/priority_up/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/arrow_up.png','border'=>'0')), array('title' => 'Arriba'));?>
	 <?=anchor('rounds/priority_down/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/arrow_down.png','border'=>'0')), array('title' => 'Abajo'));?>
	 <?=anchor('rounds/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('rounds/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->priority.'/'.$row->name.'/'.$row->cname, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('groups/index/'.$row->id, img(array('src'=>'imagenes/icons/grupoequipo.png','border'=>'0')), array('title' => 'Grupos'));?>
	 <?=anchor('schedules/index/'.$row->id, img(array('src'=>'imagenes/icons/calendario.png','border'=>'0')), array('title' => 'Fechas'));?>
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