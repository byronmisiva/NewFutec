<div id="admin">
	<h1><?php echo $title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/equipo.png','border'=>'0')) ?> <?=anchor('teams','Equipos')?></li>
    </ul>
	</div>
	<br>
	<div id="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open_multipart('teams/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table class='formulario'>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Nombre:</td>
			<td><input type="text" name="name"
				value="<?php echo set_value("name")?>" /></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Pa&iacute;s:</td>
			<td><?php echo form_dropdown('country', $countries, set_value('country'));?></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Continente:</td>
			<td><?php echo form_dropdown('continent', $continents, set_value('continent'));?></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Nombre Corto:</td>
			<td><input type="text" name="short_name"
				value="<?php echo set_value("short_name")?>" /></td>
		</tr>

		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Fundaci&oacute;n:</td>
			<td><input type="text" name="foundation"
				value="<?php echo set_value('foundation')?>" readonly> <input
				type="button" value="Cal"
				onclick="displayCalendar(document.forms[0].foundation,'yyyy/mm/dd',this,true)">
				<input type="button" value="Reset"
				onclick="document.forms[0].foundation.value='';"></td>
		</tr>

		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Presidente:</td>
			<td><input type="text" name="president"
				value="<?php echo set_value("president")?>" /></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Web Oficial:</td>
			<td><input type="text" name="site"
				value="<?php echo set_value("site")?>" /></td>
		</tr>
		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Web No Oficial:</td>
			<td><input type="text" name="non_site"
				value="<?php echo set_value("non_site")?>" /></td>
		</tr>

		<tr>
			<td><div id='required'>*</div></td>
			<td class='label'>Entrenador:</td>
			<td><input type="text" name="couch"
				value="<?php echo set_value("couch")?>" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Estadio:</td>
			<td><select name="stadia_id">
					<option value="">ninguno</option>
					<?php foreach($query->result() as $row): ?>
					<option value="<?=$row->id;?>"
					<?php if(set_value('stadia_id')==$row->id) echo " SELECTED "?>>
						<?=$row->name;?>
					</option>
					<?php endforeach;?>
			</select></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Twitter:</td>
			<td><input type="text" name="twitter"
				value="<?php echo set_value("twitter")?>" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Foto de Equipo:</td>
			<td><input type="file" name="team_pic" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Escudo:</td>
			<td><input type="file" name="shield" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Thumb Escudo:</td>
			<td><input type="file" name="thumb_shield" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Escudo Inverso:</td>
			<td><input type="file" name="shield2" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Thumb Escudo Inverso:</td>
			<td><input type="file" name="thumb_shield2" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Mini Escudo:</td>
			<td><input type="file" name="mini_shield" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Uniforme:</td>
			<td><input type="file" name="shirt" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Uniforme Alterno:</td>
			<td><input type="file" name="shirt2" /></td>
		</tr>
		<tr>
			<td><div id='required'></div></td>
			<td class='label'>Mini Uniforme:</td>
			<td><input type="file" name="mini_shirt" /></td>
		</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /> </td>
	<?php echo "</form>"?>
	<?php echo form_open('teams');?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>