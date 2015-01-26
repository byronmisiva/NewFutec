<div id="admin">
	<h1><?=$title.$heading?></h1>
	<h2><?=$from?></h2>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/perfiljugador_add.png','border'=>'0')) ?> <?=anchor('profiles/insert/'.$this->uri->segment(3),'Agregar Perfil')?></li>
    </ul>
	</div>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>T&Iacute;TULO</th>
	<th>CREADO</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->title;?></td>
	 <td><?php echo $row->created;?></td>
	 <td class="actions">
	 <?=anchor('profiles/update/'.$row->id.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('profiles/confirm_delete/'.$row->id.'/'.$this->uri->segment(3).'/'.$row->title.'/'.$row->first_name.'/'.$row->last_name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
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
        <li> <?=img(array('src'=>'imagenes/icons/jugador.png','border'=>'0')) ?> <?=anchor('players','Jugadores')?></li>
    </ul>
	</div>
</div>