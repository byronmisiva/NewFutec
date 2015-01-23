<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato_add.png','border'=>'0')) ?> <?=anchor('gacos/insert/'.$this->uri->segment(3),'Agregar Gaco')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>PARTIDO</th>
	<th>REGRESO</th>
	<th>FECHA</th>
	<th>FECHA</th>
	<th>ESTADIO</th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?=$row->cname;?></td>
	 <td><?=$row->rname;?></td>
	 <td><?=$row->r2name;?></td>
	 <td class="actions">
	 <?=anchor('gacos/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('gacos/confirm_delete/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('gacos_matches/index/'.$row->id, img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')), array('title' => 'Rondas de Campeonato'));?>
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