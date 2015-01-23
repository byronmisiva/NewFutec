<div id="admin">
	<h1>Grupos y Fechas de: "<i><?=$championship->name?></i>"</h1>
	
	<div id='mensaje'>
	Ingrese los grupos y fechas para cada una de las rondas que se crearon. Por defecto<br>
	se creara un grupo y una fecha por Ronda.
	</div>
	
	<div id='subtitulo'>
		RONDA: <i>"<?=$round->name;?>"</i>	
	</div>
	
	<div id='formulario'>
		<form action='<?=base_url()?>groups/ajax_insert' id='form_groups' method='POST' onsubmit="return false;">
		<?=form_input(array('name'=>'round_id','value'=>$round->id,'id'=>'round_id','type'=>'hidden'));?>
		<fieldset id="personal">
			<legend>Agregar Grupos</legend>	
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td class='label'><input type="text" name='name'/></td>
					<td><input type="button" name="agregar" id="agregar" value="Agregar" class='button_add' onClick="submit_form('data_groups','form_groups');" /></td>
				</tr>
			</table>
		</fieldset>
		</form>
		<div id='data_groups' style='margin: 2px; border:1px solid black;'>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>
		<?php foreach($groups as $row):?>
		<tr>
			<td><?=$row->name?></td>
			<?php $js="new Ajax.Updater('data_groups','".base_url()."groups/ajax_delete/$row->id/$round->id'); return false;";?>
			<td><?=anchor('', img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar','onClick'=>$js));?></td>
		</tr>
		<?php endforeach;?>
		</table>
		</div>
		<br><br>
		<form action='<?=base_url()?>schedules/ajax_insert' id='form_schedules' method='POST' onsubmit="return false;">
		<?=form_input(array('name'=>'round_id','value'=>$round->id,'id'=>'round_id','type'=>'hidden'));?>
		<fieldset id="personal">
			<legend>Agregar Fechas</legend>	
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td class='label'><input type="text" name='name'/></td>
					<td><input type="button" name="agregar" id="agregar" value="Agregar" class='button_add' onClick="submit_form('data_schedules','form_schedules');" /></td>
				</tr>
			</table>
		</fieldset>
		</form>
		<div id='data_schedules' style='margin: 2px; border:1px solid black;'>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>
		<?php foreach($schedules as $row):?>
		<tr>
			<td><?=$row->season?></td>
			<?php $js="new Ajax.Updater('data_schedules','".base_url()."schedules/ajax_delete/$row->id/$round->id'); return false;";?>
			<td><?=anchor('', img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar','onClick'=>$js));?></td>
		</tr>
		<?php endforeach;?>
		</table>
		</div>
	</div>
	
	<div style='width: 100%;'>
		<table border="0" cellpadding="0" cellspacing="2" width='98%' align='center'>
		<tr>
		<td align='left'><input type="button" value="<<< Anterior" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step3/'.$championship->id;?>";'/></td>
		<?php if($next_round==false){?>
		<td align="right"><input type="button" value="Siguiente >>>" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step5/'.$championship->id;?>";'/></td>
		<?php 
		}
		else{
			$next_round=current($next_round);
		?>
		<td align="right"><input type="button" value="Siguiente >>>" name="btn_next" onClick='window.location="<?=base_url().'championships/wizard/step4/'.$championship->id.'/'.$next_round->id;?>";'/></td>
		<?php }?>
		</tr>
		</table>
	</div>
</div>