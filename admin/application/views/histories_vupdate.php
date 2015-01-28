<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/historiaequipo.png','border'=>'0')) ?> <?=anchor('histories/index/'.$this->uri->segment(4),'Historias')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('histories/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]['id']);
	echo form_hidden('team_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Palmares:</td>
	<td><textarea name="palmares" cols=20 rows=15><?=$row[0]['palmares'] ?></textarea>*</td></tr>
	<tr><td>Mejores Jugadores:</td>
	<td><textarea name="best_players" cols=20 rows=15><?=$row[0]['best_players'] ?></textarea>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('histories/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>