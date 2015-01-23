<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0')) ?> <?=anchor('matches/index/'.$this->uri->segment(3),'Partidos')?></li>
    </ul>
	</div>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>

	<?$r=$query6->row()?>
	<iframe src="<?=base_url().'gacos/matches_view_admin/'.$r->championship_id.'/'.$r->last?>" width="800" height="180" frameborder="0" align="top">
		No tienes soporte para iFrames
	</iframe>
	<br>
	<br>
	<?php echo form_open('matches/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('group_id',$this->uri->segment(3))?>
	<table>
	<tr>
		<td><input type="checkbox" name="gaco" id="gaco" onChange="radio_check('<?=base_url();?>matches/check_radios/<?=$this->uri->segment(3).'/'?>','dstd1','gaco','1');radio_check2('<?=base_url();?>matches/check_radios/<?=$this->uri->segment(3).'/'?>','dstd2','gaco','2');select_load('<?=base_url().'matches/'?>','opt_home','2','<?=$this->uri->segment(3)?>','1','0');select_load2('<?=base_url().'matches/'?>','opt_away','2','<?=$this->uri->segment(3)?>','2','0');" value="1"/>Activar GACO<br/></td>
	</tr>
	<tr>    
		<td>Local:</td>
		<td><div id="opt_home">
			<select name="team_id_home">
				<?foreach($query->result() as $row): ?> 
					<option value="<?=$row->id;?>" <?php if(set_value('team_id_home')==$row->id) echo "SELECTED"?>><?=$row->name;?></option>
				<?endforeach;?>
			</select>*
		</div></td>
		<td>
			<div id="dstd1">
				
			</div>
		</td>
	</tr>
	<tr>
		<td>Visitante:</td>
		<td><div id="opt_away">
			<select name="team_id_away">
				<?foreach($query->result() as $row): ?> 
					<option value="<?=$row->id;?>" <?php if(set_value('team_id_away')==$row->id) echo "SELECTED"?>><?=$row->name;?></option>
				<?endforeach;?>
			</select>*
		</div></td>
		<td>
			<div id="dstd2">
					
			</div>
		</td>
	</tr>
	<tr><td>Jornada:</td>
	<td><select name="schedule_id">
		<?php foreach($query3->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('schedule_id')==$row->id) echo "SELECTED"?>><?=$row->season;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Estadio:</td>
	<td><select name="stadia_id">
		<?php foreach($query2->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('stadia_id')==$row->id) echo "SELECTED"?>><?=$row->name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr>
		<td>&Aacute;rbitro Central:</td>
		<td><?php echo form_dropdown('referee_id_central', $referees, set_value('referee_id_central'));?>*</td>
	</tr>
	<tr>
		<td>&Aacute;rbitro Linea 1:</td>
		<td><?php echo form_dropdown('referee_id_line1', $referees, set_value('referee_id_line1'));?>*</td>
	</tr>
	<tr>
		<td>&Aacute;rbitro Linea 2:</td>
		<td><?php echo form_dropdown('referee_id_line2', $referees, set_value('referee_id_line2'));?>*</td>
	</tr>
	<tr>
		<td>&Aacute;rbitro Suplente:</td>
		<td><?php echo form_dropdown('referee_id_sub', $referees, set_value('referee_id_sub'));?>*</td>
	</tr>
	
	<tr><td>Fecha:</td><td><input type="text" name="date_match" value="<?php echo set_value('date_match')?>" readonly/>*
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].date_match,'yyyy/mm/dd  hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].date_match.value='';"></td></tr>
	<tr><td>Tiempo:</td>
	<td><select name="state">
		<option value=0 <?php if(set_value('state')==0) echo "SELECTED"?>">No iniciado</option>
		<option value=1 <?php if(set_value('state')==1) echo "SELECTED"?>">Primer Tiempo</option>
		<option value=2 <?php if(set_value('state')==2) echo "SELECTED"?>">Primer Descanso</option>
		<option value=3 <?php if(set_value('state')==3) echo "SELECTED"?>">Segundo Tiempo</option>
		<option value=4 <?php if(set_value('state')==4) echo "SELECTED"?>">Segundo Descanso</option>
		<option value=5 <?php if(set_value('state')==5) echo "SELECTED"?>">Primer Extra</option>
		<option value=6 <?php if(set_value('state')==6) echo "SELECTED"?>">Segundo Extra</option>
		<option value=7 <?php if(set_value('state')==7) echo "SELECTED"?>">Penales</option>
		<option value=8 <?php if(set_value('state')==8) echo "SELECTED"?>">Finalizado</option>
	</select></td></tr>
	<tr><td>Minuto:</td><td><input type="text" name="minute_match" value="<?php echo set_value('minute_match')?>"/></td></tr>
	<tr><td>Resultado:</td><td><input type="text" name="result" value="<?php echo set_value('result')?>"/></td></tr>
	<tr><td>Resumen:</td>
	<td><select name="story_id">
			<option value="0">Ningun</option>
		<?php foreach($query5->result() as $row): ?> 
			<option value="<?=$row->id;?>" <?php if(set_value('story_id')==$row->id) echo "SELECTED"?>><?=$row->title;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>En vivo:</td>
	<td><select name="live">
		<option value=0 <?php if(set_value('live')==0) echo "SELECTED"?>">No</option>
		<option value=1 <?php if(set_value('live')==1) echo "SELECTED"?>">Si</option>
	</select></td></tr>
	<tr><td>Especial:</td>
	<td><select name="special">
		<option value=0 <?php if(set_value('special')==0) echo "SELECTED"?>">No</option>
		<option value=1 <?php if(set_value('special')==1) echo "SELECTED"?>">Si</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('matches/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>