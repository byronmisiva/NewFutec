<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/equiposxcampeonato.png','border'=>'0')) ?> <?=anchor('championships_teams/index/'.$this->uri->segment(3),'Equipos de Campeonato')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('championships_teams/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('championship_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Equipo:</td>
	<td><select name="team_id">
		<?php foreach($query2->result() as $row): ?> 
			<option value="<?=$row->id;?>"  <?php if(set_value('team_id')==$row->id) echo "SELECTED";?>><?=$row->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Bonificaci&oacute;n:</td><td><input type="text" name="bonus" value=<?php echo set_value('bonus')?>></td></tr>
	<tr><td>Ronda para Bono:</td>
	<td><select name="round_id">
		<option value=''>Ninguna</option>
		<?php foreach($query3->result() as $row): ?> 
			<option value="<?=$row->id;?>"  <?php if(set_value('round_id')==$row->id) echo "SELECTED";?>><?=$row->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('championships_teams/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>