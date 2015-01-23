<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/user.png','border'=>'0')) ?> <?=anchor('users','Usuarios')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/group.png','border'=>'0')) ?> <?=anchor('roles','Roles')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/resource.png','border'=>'0')) ?> <?=anchor('resources','Recursos')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/lock.png','border'=>'0')) ?> <?=anchor('rules','Reglas')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php echo form_open('users/insert')?>
	<?php echo form_hidden('id',$id=0)?>
	<table border='1'>
		<tr>
			<td>Rol:</td>
			<td>
			<?php echo form_dropdown('role_id', $roles, set_value('role_id'));?>
			</td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" name="first_name" value="<?=set_value('first_name');?>" /></td>
		</tr>
		<tr>
			<td>Apellido:</td>
			<td><input type="text" name="last_name" value="<?=set_value('last_name');?>"/></td>
		</tr>
		<tr>
			<td>Nick:</td>
			<td><input type="text" name="nick" value="<?=set_value('nick');?>"/></td>
		</tr>
		<tr>
			<td>Mail:</td>
			<td><input type="text" name="mail" value="<?=set_value('mail');?>"/></td>
		</tr>
		
		<tr>
			<td>Sexo:</td>
			<td>
				<select name="sex">
					<option value="m" <?if(set_value('sex')=='m') echo 'SELECTED' ?>>Masculino</option>
					<option value="f" <?if(set_value('sex')=='f') echo 'SELECTED' ?>>Femenino</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Fecha De Nacimiento:</td>
			<td><input type="text" name="birth" value="<?=set_value('birth');?>"/>
			<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].birth,'yyyy/mm/dd',this,true)">
			<input type="button" value="Reset" onclick="document.forms[0].birth.value='';"></td>
		</tr>
		<tr>
			<td>Pais:</td>
			<td>
			<?php 
			$js = 'id="country" onChange="cargaSelect(\'country\',\'city_id\',\''.base_url().'cities/get_cities/\');"';
			echo form_dropdown('country_id', $countries,"",$js);
			?>
			</td>
		</tr>
		<tr>
			<td>Ciudad:</td>
			<td>
			<div id='cmb_city_id'>
			<?php 
			$js= 'id="city_id" disabled="disabled"';
			echo form_dropdown('city_id', $cities,"",$js);
			?>
			</div>
			</td>
		</tr>
		<tr>
			<td>Equipo:</td>
			<td>
			<?php echo form_dropdown('team_id', $teams, set_value('team_id'));?>
			</td>
		</tr>
		<tr>
			<td>Boletín Semanal:</td>
			<td><?=form_checkbox('suscription', '1',TRUE); ?></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td>Confirmacion de Clave:</td>
			<td><input type="password" name="passconf" /></td>
		</tr>
		<tr>
			<td>Descripcion:</td>
			<td><input type="text" name="description" value="<?=set_value('description');?>"/></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Enviar" /></td>
		</tr>
	</table>
	<?php echo "</form>"?>
</div>