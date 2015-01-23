<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/historiaequipo.png','border'=>'0')) ?> <?=anchor('histories/index/'.$this->uri->segment(3),'Historias')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('histories/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('team_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Palmares:</td>
	<td><textarea name="palmares" cols=20 rows=15><?php echo set_value('palmares')?></textarea>*</td></tr>
	<tr><td>Mejores Jugadores:</td>
	<td><textarea name="best_players" cols=20 rows=15><?php echo set_value('best_players')?></textarea>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('histories/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>