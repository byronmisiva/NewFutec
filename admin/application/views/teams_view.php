<div id="admin">
	<h1><?=$title.$heading?></h1>
	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/equipo_add.png','border'=>'0')) ?> <?=anchor('teams/insert','Agregar Equipos')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?=$this->session->flashdata('errors');?>
	</ul>
	</div>
	<table class='listing' border=1>
	<tr>
    <?php 
    for($i=65;$i<91;$i++){
    	if($this->uri->segment(3)!=chr($i))
    		echo "<th align='center'>".anchor('teams/index/'.chr($i),chr($i))."</th>";
    	else
    		echo "<th style='font-size: 22px;' align='center'><strong>".chr($i)."</strong></th>";
    }
    ?>
    </tr>
    </table>
	<br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>PA&Iacute;S</th>
	<th>CONTINENTE</th>
	<th>ABREVIADO</th>
	<th>ENTRENADOR</th>
	<th>ESTADIO</th>
	<th></th>
	</tr>
	 <?php foreach($query as $row): ?>
	 <tr class='altrow'>
	 <td><?=anchor('teams/update/'.$row->id,$row->name);?></td>
	 <td><?php echo $row->country;?></td>
	 <td><?php echo $row->continent;?></td>
	 <td><?php echo $row->short_name;?></td>
	 <td><?php echo $row->couch;?></td>
	 <td><?php echo $row->sname;?></td>
	 <td class="actions">
	 <?=anchor('teams/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('teams/confirm_delete/'.$row->id, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 <?=anchor('players_teams/index/'.$row->id, img(array('src'=>'imagenes/icons/jugadoresxequipo.png','border'=>'0')), array('title' => 'Jugadores de Equipo'));?>
	 <?=anchor('histories/index/'.$row->id, img(array('src'=>'imagenes/icons/historiaequipo.png','border'=>'0')), array('title' => 'Historias'));?>
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
    </ul>
	</div>
</div>