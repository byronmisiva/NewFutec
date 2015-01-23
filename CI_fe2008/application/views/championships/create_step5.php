<div id="admin">
	<h1>Partidos de: "<i><?=$championship->name?></i>"</h1>
	
	<div id='mensaje'>
	Agregar los partidos respectivos del campeonato.
	</div>
	
	<div id='formulario'>
		<form action='<?=base_url()?>matches/ajax_insert' id='form_data' method='POST' onsubmit="return false;">
		<fieldset id="personal">
			<legend>Agregar Partidos</legend>	
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td class='label'>Ronda:</td>
					<td><?php echo form_dropdown('round_id', $rounds,'','id="round_id" onChange="funcion()"');?></td>
				</tr>
				<tr>
					<td class='label'>Grupo:</td>
					<td><?php echo form_dropdown('group_id', array(''=>'Sin datos'),'','id="group_id" onChange="funcion()"');?></td>
				</tr>
				<tr>
					<td class='label'>Jornada:</td>
					<td><?php echo form_dropdown('schedule_id', array(''=>'Sin datos'),'','id="schedule_id"');?></td>
				</tr>
				<tr>
					<td class='label'>Local:</td>
					<td><?php echo form_dropdown('home_id',$teams,'');?></td>
				</tr>
				<tr>
					<td class='label'>Visitante:</td>
					<td><?php echo form_dropdown('away_id',$teams,'');?></td>
				</tr>
				<tr>
					<td class='label'>Estadio:</td>
					<td><?php echo form_dropdown('stadia_id', $stadia,'');?></td>
				</tr>
				<tr>
					<td class='label'>Fecha:</td>
					<td>
						<input type="text" name="date_match" value="" readonly >
						<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].programed,'yyyy/mm/dd hh:ii',this,true)">
						<input type="button" value="Reset" onclick="document.forms[0].programed.value='';">
					</td>
				</tr>
				<tr>
					<td class='label'>Especial:</td>
					<td><?=form_checkbox('special','1');?></td>
				</tr>
				
				<tr>
					<td colspan='2'><input type="button" name="agregar" id="agregar" value="Agregar" class='button_add' onClick="submit_form('data','form_data');" /></td>
				</tr>
			</table>
		</fieldset>
		</form>
		<div id='data' style='margin: 2px; border:1px solid black;'>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>

		</table>
		</div>
	</div>
	
	<div style='width: 100%;'>
		<table border="0" cellpadding="0" cellspacing="2" width='98%' align='center'>
		<tr>
		<td align='left'><input type="button" value="<<< Anterior" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step4/'.$championship->id;?>";'/></td>
		<td align="right"><input type="button" value="Finalizar" name="btn_next" onClick='window.location="<?=base_url().'matches_calendary/matches_all/'.$championship->id;?>";'/></td>
		</tr>
		</table>
	</div>
</div>