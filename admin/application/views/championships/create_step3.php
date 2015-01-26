<div id="admin">
	<h1>Rondas de: "<i><?=$championship->name?></i>"</h1>
	
	<div id='mensaje'>
	Administre las rondas deseadas para el campeonato, si los nombres por defecto no son de su agrado<br>
	puede borrarlas y crear nuevas.
	</div>
	<div id='formulario'>
		<form action='<?=base_url()?>rounds/ajax_insert' id='form_send' method='POST' onsubmit="return false;">
		<?=form_input(array('name'=>'championship_id','value'=>$championship->id,'id'=>'championship_id','type'=>'hidden'));?>
		<fieldset id="personal">
			<legend>Agregar Rondas</legend>	
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td class='label'><input type="text" name='name'/></td>
					<td><input type="button" name="agregar" id="agregar" value="Agregar" class='button_add' onClick="submit_form('data','form_send');" /></td>
				</tr>
			</table>
		</fieldset>
		</form>
		<div id='data' style='margin: 2px; border:1px solid black;'>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>
		<?php foreach($rounds as $row):?>
		<tr>
			<td><?=$row->name?></td>
			<?php $js="new Ajax.Updater('data','".base_url()."rounds/ajax_delete/$row->id/$championship->id/0'); return false;";?>
			<td><?=anchor('', img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar','onClick'=>$js));?></td>
		</tr>
		<?php endforeach;?>
		</table>
		</div>
	</div>
	
	<div style='width: 100%;'>
		<table border="0" cellpadding="0" cellspacing="2" width='98%' align='center'>
		<tr>
		<td align='left'><input type="button" value="<<< Anterior" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step2/'.$championship->id;?>";'/></td>
		<td align="right"><input type="button" value="Siguiente >>>" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step4/'.$championship->id;?>";'/></td>
		</tr>
		</table>
	</div>
</div>