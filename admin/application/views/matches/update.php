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
	<?php 
	echo form_open('matches/update/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
	echo form_hidden('id',$match->id);
	echo form_hidden('group_id',$match->group_id);
	?>
	<table>
		<tr>
			<td class='required'>*</td>
			<td>Local:</td>
			<td>
				<?php echo form_dropdown('team_id_home', $teams, $matches_team['home']->id);?>
			</td>
		</tr>
		<tr>
			<td class='required'>*</td>
			<td>Visitante:</td>
			<td>
				<?php echo form_dropdown('team_id_away', $teams, $matches_team['away']->id);?>
			</td>
		</tr>
		<tr>
			<td class='required'>*</td>
			<td>Jornada:</td>
			<td><select name="schedule_id">
				<?php foreach($seasons->result() as $row2): ?> 
					<option value="<?=$row2->id;?>" 
					<?if($row2->id==$match->schedule_id)
						echo "SELECTED";?>			
					><?=$row2->season;?></option>
				<?php endforeach;?>
			</select></td>
		</tr>
		<tr>
			<td class='required'>*</td>
			<td>Estadio:</td>
			<td><select name="stadia_id">
				<?php foreach($stadiums->result() as $row2): ?> 
					<option value="<?=$row2->id;?>" 
					<?if($row2->id==$match->stadia_id)
						echo "SELECTED";?>			
					><?=$row2->name;?></option>
				<?php endforeach;?>
			</select></td>
		</tr>
		
		<tr>
			<td class='required'>*</td>
			<td>&Aacute;rbitro Central:</td>
			<td><?php

				echo form_dropdown('referee_id_central', $referees, isset ($matches_referees[0]->id) ? $matches_referees[0]->id:"" );?></td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>&Aacute;rbitro Linea 1:</td>
			<td><?php echo form_dropdown('referee_id_line1', $referees, isset ($matches_referees[1]->id) ? $matches_referees[0]->id:"" );?></td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>&Aacute;rbitro Linea 2:</td>
			<td><?php echo form_dropdown('referee_id_line2', $referees, isset ($matches_referees[2]->id) ? $matches_referees[0]->id:"" );?></td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>&Aacute;rbitro Suplente:</td>
			<td><?php echo form_dropdown('referee_id_sub', $referees, isset ($matches_referees[3]->id) ? $matches_referees[0]->id:"" );?></td>
		</tr>
	
		<tr>
			<td class='required'>*</td>
			<td>Fecha:</td><td><input type="text" name="date_match" value="<?=$match->date_match;?>" />
			<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date_match,'yyyy/mm/dd  hh:ii',this,true)">
			<input type="button" value="Reset" onclick="document.forms[0].date_match.value='';"></td></tr>
		<tr>
			<td class='required'></td>
			<td>Tiempo:</td>
			<td>
			<?php echo form_dropdown('state', $states, $match->state);?>
			</td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>Minuto:</td>
			<td><input type="text" name="minute_match" value="<?=$match->minute_match;?>"/></td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>Resultado:</td>
			<td><input type="text" name="result" value="<?=$match->result;?>"/></td>
		</tr>
		
		<tr>
			<td class='required'>*</td>
			<td>Resumen:</td>
			<td><select name="story_id">
					<option value="0">Ningun</option>
				<?php foreach($stories->result() as $row2): ?> 
					<option value="<?=$row2->id;?>" 
					<?if($row2->id==$match->story_id)
						echo "SELECTED";?>
						><?=$row2->title;?></option>
				<?php endforeach;?>
			</select></td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>En vivo:</td>
			<td><select name="live">
				<option value=0 <?php if($match->live==0) echo "SELECTED";?>>No</option>
				<option value=1 <?php if($match->live==1) echo "SELECTED";?>>Si</option>
			</select></td>
		</tr>
		<tr>
			<td class='required'></td>
			<td>Especial:</td>
			<td><select name="special">
				<option value=0 <?php if($match->special==0) echo "SELECTED"?>>No</option>
				<option value=1 <?php if($match->special==1) echo "SELECTED"?>>Si</option>
			</select></td>
		</tr>
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