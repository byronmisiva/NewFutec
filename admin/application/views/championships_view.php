<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/campeonato_add.png','border'=>'0')) ?> <?=anchor('championships/insert','Agregar Campeonato')?></li>
    </ul>
	</div>

	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>A&Ntilde;O</th>
	<th>RONDA</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><a href="<?=base_url().'matches_calendary/matches_all/'.$row->id?>"><?php echo $row->name;?></a></td>
	 <td><?php echo $row->year;?></td>
	 <td><?php if($row->active_round==0) echo "ninguna"; else echo $row->rname;?></td>
	 <td class="actions">
	 <?=anchor('championships/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('championships/confirm_delete/'.$row->id.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('rounds/index/'.$row->id, img(array('src'=>'imagenes/icons/ronda.png','border'=>'0')), array('title' => 'Rondas de Campeonato'));?>
	 <?=anchor('championships_teams/index/'.$row->id, img(array('src'=>'imagenes/icons/equiposxcampeonato.png','border'=>'0')), array('title' => 'Equipo del Campeonato'));?>
	 <?=anchor('gacos/index/'.$row->id, img(array('src'=>'imagenes/icons/equiposxcampeonato.png','border'=>'0')), array('title' => 'Reglas de Gaco'));?>
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