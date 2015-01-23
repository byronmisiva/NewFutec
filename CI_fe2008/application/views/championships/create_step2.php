<div id="admin">
	<h1>Equipos de: "<i><?=$championship->name?></i>"</h1>
	
	<div id='mensaje'>
	Agregar los equipos al Campenato, recuerde que deben estar creados los equipos antes de iniciar<br>
	este proceso. <br>
	Solo los equipos ingresados constaran dentro del campeonato. 
	</div>
	
	<div id='formulario'>
		<form action='<?=base_url()?>championships_teams/ajax_insert' id='form_send' method='POST'>
		<?=form_input(array('name'=>'championship_id','value'=>$championship->id,'id'=>'championship_id','type'=>'hidden'));?>
		<fieldset id="personal">
			<legend>Agrega los Equipos al Campeonato</legend>	
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td class='label'><?=form_dropdown('team_id', $teams, set_value('team'));?></td>
					<td><input type="button" name="agregar" id="agregar" value="Agregar" class='button_add' onClick="submit_form('data','form_send');" /></td>
				</tr>
			</table>
		</fieldset>
		</form>
		<div id='data' style='margin: 2px; border:1px solid black;'>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>
		<?php foreach($my_teams as $row):?>
		<tr>
			<td><?=$row->name?></td>
			<?php $js="new Ajax.Updater('data','".base_url()."championships_teams/ajax_delete/$row->ctid/$championship->id'); return false;";?>
			<td><?=anchor('', img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar','onClick'=>$js));?></td>
		</tr>
		<?php endforeach;?>
		</table>
		</div>
	</div>
		<div style='text-align:right; padding-right: 10px;'>
		<input type="button" value="Siguiente >>>" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step3/'.$championship->id;?>";'/>
		</div>
</div>