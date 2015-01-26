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
	<?php echo form_open('users/update/'.$row->id);?>
	<?php echo form_hidden('id',$row->id);?>
	<table border="1">
		<tr>
			<td>Rol:</td>
			<td>
				<?php echo form_dropdown('role_id', $roles, $row->role_id);?>
			</td>
		</tr>
		<tr>
			<td>Nombre:</td>
			<td><input type="text" name="first_name" value="<?=$row->first_name ?>" /></td>
		</tr>
		<tr>
			<td>Apellido:</td>
			<td><input type="text" name="last_name" value="<?=$row->last_name ?>" /></td>
		</tr>
		<tr>
			<td>Nick:</td>
			<td><input type="text" name="nick" value="<?=$row->nick ?>" /></td>
		</tr>
		<tr>
			<td>Mail:</td>
			<td><input type="text" name="mail" value="<?=$row->mail ?>" /></td>
		</tr>
		<tr>
			<td>Sexo:</td>
			<td>
				<select name="sex">
					<option value="m" <?if($row->sex=='m') echo 'SELECTED' ?>>Masculino</option>
					<option value="f" <?if($row->sex=='f') echo 'SELECTED' ?>>Femenino</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Fecha De Nacimiento:</td>
			<td><input type="text" name="birth" value="<?=$row->birth;?>"/>
			<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].birth,'yyyy/mm/dd',this,true)">
			<input type="button" value="Reset" onclick="document.forms[0].birth.value='';"></td>
		</tr>
		<tr>
			<td>Pais:</td>
			<td>
			<?php
			$js = 'id="country" onChange="cargaSelect(\'country\',\'city_id\',\''.base_url().'cities/get_cities/\');"';
			echo form_dropdown('country_id', $countries,$row->country_id,$js);
			?>
			</td>
		</tr>
		<tr>
			<td>Ciudad:</td>
			<td>
			<div id='cmb_city_id'>
			<?php 
			$js= 'id="city_id" ';
			echo form_dropdown('city_id', $cities,$row->city_id,$js);
			?>
			</div>
			</td>
		</tr>
		<tr>
			<td>Equipo:</td>
			<td>
				<?php echo form_dropdown('team_id',$teams,$row->team_id);?>
			</td>
		</tr>
		<tr>
			<td>Suscripcion:</td>
			<td><?=form_checkbox('suscription', '1',($row->suscription=='1')?TRUE:FALSE); ?></td>
		</tr>
		<tr>
			<td>Descripcion:</td>
			<td><input type="text" name="description" value="<?=$row->description ?>" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="submit" value="Actualizar" /></td>
		</tr>
	</table>
	<?php echo "</form>"?>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/key.png','border'=>'0')) ?> <?=anchor('users/reset_pass/'.$row->id,'Cambiar la clave')?></li>
    </ul>
	</div>
</div>
	
	
	