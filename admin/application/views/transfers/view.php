<div id="admin">
	<?$status[1]='Cancelada';
	  $status[2]='Rumor';
	  $status[3]='Posible';
	  $status[4]='Completada';?>
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato_add.png','border'=>'0')) ?> <?=anchor('transfers/insert/'.$this->uri->segment(3),'Agregar Transferencias')?></li>
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
	<th>HACIA</th>
	<th>DESDE</th>
	<th>JUGADOR</th>
	<th>ESTADO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->ttname;?></td>
	 <td><?php echo $row->tfname;?></td>
	 <td><?php echo $row->last_name.' '.$row->first_name;?></td>
	 <td><?php echo $status[$row->status];?></td>
	 <td class="actions">
	 <?=anchor('transfers/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('transfers/confirm_delete/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
    <?php echo $this->pagination->create_links();?>
	<br>
	<div class="actions">
    <ul>
        <li><?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>