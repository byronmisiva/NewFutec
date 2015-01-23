<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0')) ?> <?=anchor('matches/index/'.$group,'Partidos')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('matches/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	$row=current($query->result());
	echo form_hidden('id',$row->id);;
	echo form_hidden('group_id',$this->uri->segment(4))?>
	<table>
	<tr><td>Local:</td>
		<td><select name="team_id_home">
				<?foreach($query2->result() as $row2): ?> 
					<option value="<?=$row2->id;?>" <?if($row2->id==$row->team_id_home) echo "SELECTED"?>><?=$row2->name;?></option>
				<?endforeach;?>
			</select>*
		</td>
	</tr>
	<tr>
		<td>Visitante:</td>
		<td><select name="team_id_away">
				<?foreach($query2->result() as $row2): ?> 
					<option value="<?=$row2->id;?>" <?if($row2->id==$row->team_id_away) echo "SELECTED"?>><?=$row2->name;?></option>
				<?endforeach;?>
			</select>*
		</td>
	</tr>
	<tr><td>Jornada:</td>
	<td><select name="schedule_id">
		<?php foreach($query4->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row->schedule_id)
				echo "SELECTED";?>			
			><?=$row2->season;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Estadio:</td>
	<td><select name="stadia_id">
		<?php foreach($query3->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row->stadia_id)
				echo "SELECTED";?>			
			><?=$row2->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	
	<tr>
		<td>&Aacute;rbitro Central:</td>
		<td><?php echo form_dropdown('referee_id_central', $referees, $row->rid);?>*</td>
	</tr>
	<tr>
		<td>&Aacute;rbitro Linea 1:</td>
		<td><?php echo form_dropdown('referee_id_line1', $referees, $row->r1id);?>*</td>
	</tr>
	<tr>
		<td>&Aacute;rbitro Linea 2:</td>
		<td><?php echo form_dropdown('referee_id_line2', $referees, $row->r2id);?>*</td>
	</tr>
	<tr>
		<td>&Aacute;rbitro Suplente:</td>
		<td><?php echo form_dropdown('referee_id_sub', $referees, $row->rsid);?>*</td>
	</tr>

	<tr><td>Fecha:</td><td><input type="text" name="date_match" value="<?=$row->date_match;?>" />*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date_match,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].date_match.value='';"></td></tr>
	<tr><td>Tiempo:</td>
	<td><select name="state">
		<option value=0 <?php if($row->state==0) echo "SELECTED"?>">No iniciado</option>
		<option value=1 <?php if($row->state==1) echo "SELECTED"?>">Primer Tiempo</option>
		<option value=2 <?php if($row->state==2) echo "SELECTED"?>">Primer Descanso</option>
		<option value=3 <?php if($row->state==3) echo "SELECTED"?>">Segundo Tiempo</option>
		<option value=4 <?php if($row->state==4) echo "SELECTED"?>">Segundo Descanso</option>
		<option value=5 <?php if($row->state==5) echo "SELECTED"?>">Primer Extra</option>
		<option value=6 <?php if($row->state==6) echo "SELECTED"?>">Segundo Extra</option>
		<option value=7 <?php if($row->state==7) echo "SELECTED"?>">Penales</option>
		<option value=8 <?php if($row->state==8) echo "SELECTED"?>">Finalizado</option>
	</select></td></tr>
	<tr><td>Minuto:</td><td><input type="text" name="minute_match" value="<?=$row->minute_match;?>"/></td></tr>
	<tr><td>Resultado:</td><td><input type="text" name="result" value="<?=$row->result;?>"/></td></tr>
	
	<tr><td>Resumen:</td>
	<td><select name="story_id">
			<option value="0">Ningun</option>
		<?php foreach($query6->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row->story_id)
				echo "SELECTED";?>
				><?=$row2->title;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>En vivo:</td>
	<td><select name="live">
		<option value=0 <?php if($row->live==0) echo "SELECTED"?>">No</option>
		<option value=1 <?php if($row->live==1) echo "SELECTED"?>">Si</option>
	</select></td></tr>
	<tr><td>Especial:</td>
	<td><select name="special">
		<option value=0 <?php if($row->special==0) echo "SELECTED"?>">No</option>
		<option value=1 <?php if($row->special==1) echo "SELECTED"?>">Si</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('matches/index/'.$group);?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>