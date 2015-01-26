<div id="admin">	
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/equiposxcampeonato.png','border'=>'0')) ?> <?=anchor('championships_teams/index/'.$this->uri->segment(4),'Equipos de Campeonato')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('championships_teams/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('championship_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Equipo:</td>
	<td><select name="team_id">
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>"  <?php if($row[0]->team_id==$row2->id) echo "SELECTED";?>><?=$row2->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Bonificaci&oacute;n:</td><td><input type="text" name="bonus" value="<?=$row[0]->bonus;?>"/></td></tr>
	<tr><td>Ronda para Bono:</td>
	<td><select name="round_id">
		<option value=''>Ninguna</option>
		<?php foreach($query3->result() as $row2): ?> 
			<option value="<?=$row2->id;?>"  <?php if($row[0]->round_id==$row2->id) echo "SELECTED";?>><?=$row2->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('championships_teams/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>