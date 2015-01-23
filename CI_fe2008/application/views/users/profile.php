<div id='modulo'>
	<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th><?=$name;?></th>
	</tr>
	</table>
</div>
<br/>
<div id='validation' style="background-color:#F2F3F9; text-align:center; text-font:Arial; font-size:12px; ">
<?php if($_POST['resultado']){
	  	echo 'Sus datos han sido actualizados correctamente';
	  }?>
</div>
<div id="profile">
	<form action="<?=base_url();?>users/profile" method="post" id="myform"> 
	<fieldset id="personal">
	<legend>Datos Personales</legend>
	<ol>
		<li>
			<label>Nombre: <em>requerido</em></label>
			<input type="text" name="first_name" value="<?=$user->first_name;?>" /> <span style="color: red;"><?php if(form_error('first_name')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Apellido: <em>requerido</em></label>
			<input type="text" name="last_name" value="<?=$user->last_name;?>"/> <span style="color: red;"><?php if(form_error('last_name')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Email: <em>requerido</em></label>
			<input type="text" name="mail" value="<?=$user->mail;?>"/> <span style="color: red;"><?php if(form_error('mail')!=""):echo "*"; endif;?></span>
			<div class="validation" style="margin-right: 50px;"><?=form_error('mail'); ?></div>
		</li>
		<li>
			<label>Sexo: <em>requerido</em></label>
			<select name="sex">
				<option value="m" <?if($user->sex=='m') echo 'SELECTED' ?>>Masculino</option>
				<option value="f" <?if($user->sex=='f') echo 'SELECTED' ?>>Femenino</option>
			</select><span style="color: red;"><?php if(form_error('sex')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Fecha de Nacimiento <em>requerido</em></label>
		</li>
		<li>
			<br/>
		</li>
		
		
		<li>
			<label>D&iacute;a: </label>
			<select name="day">
				<?for($i=1;$i<32;$i++){?>
					<option value="<?=$i?>" <?if(mdate('%d',$user->daten)==$i) echo 'SELECTED' ?>><?=$i?></option>
				<?}?>
			</select><span style="color: red;"><?php if(form_error('day')!=""):echo "*"; endif;?></span>
		</li>
		
		<?$month[1]='Enero'; $month[2]='Febrero'; $month[3]='Marzo'; $month[4]='Abril'; $month[5]='Mayo'; $month[6]='Junio'; 
			  $month[7]='Julio'; $month[8]='Agosto'; $month[9]='Septiembre'; $month[10]='Octubre'; $month[11]='Noviembre'; $month[12]='Diciembre'; ?>
		<li>
			<label>Mes: </label>
			<select name="month">
				<?for($i=1;$i<13;$i++){?>
					<option value="<?=$i?>" <?if(mdate('%m',$user->daten)==$i) echo 'SELECTED' ?>><?=$month[$i]?></option>
				<?}?>
			</select><span style="color: red;"><?php if(form_error('month')!=""):echo "*"; endif;?></span>
		</li>
		
		<li>
			<label>A&ntilde;o:</label>
			<select name="year">
				<?for($i=mdate('%Y',time());$i>1930;$i--){?>
					<option value="<?=$i?>"  <?if(mdate('%Y',$user->daten)==$i) echo 'SELECTED' ?>><?=$i?></option>
				<?}?>
			</select><span style="color: red;"><?php if(form_error('year')!=""):echo "*"; endif;?></span>
		</li>
		
		<li>
			<label>Cambiar Clave: <em>requerido</em></label>
			<input type="password" name="password" /> <span style="color: red;"><?php if(form_error('password')!=""):echo "*"; endif;?></span>
			<div class="validation" style="margin-right: 50px;"><?=form_error('password'); ?></div>
		</li>
		<li>
			<label>Confirmar Clave: <em>requerido</em></label>
			<input type="password" name="passconf" /> <span style="color: red;"><?php if(form_error('passconf')!=""):echo "*"; endif;?></span>
		</li>
		
		</ol>
	</fieldset>
	<fieldset id='other'>
	<legend>Donde Vives</legend>
	<ol>                                
		<li>
			<label>Pais:</label>
			<?php 
			$js = 'id="country" onChange="cargaSelect(\'country\',\'city_id\',\''.base_url().'cities/get_cities/\');"';
			echo form_dropdown('country_id', $countries,$user->country_id,$js);
			?>
			<span style="color: red;"><?php if(form_error('country_id')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Ciudad:</label>
			<div id='cmb_city_id'>
			<?php 
			$js= 'id="city_id" ';
			echo form_dropdown('city_id', $cities,$user->city_id,$js);
			?>
			<span style="color: red;"><?php if(form_error('city_id')!=""):echo "*"; endif;?></span>
			</div>
		</li>
		<li>
			<label>Hincha de:</label>
			<?php echo form_dropdown('team_id', $teams,$user->team_id);?>
			<span style="color: red;"><?php if(form_error('team_id')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Boletín Semanal:</label>
			<input type="checkbox" name="suscription" value="1" <?if($user->suscription==1){ echo 'checked="checked"'; }?>></input>
		</li>
	</ol>
	</fieldset>
	<div style='text-align:right; margin-right: 10px;'>
	<input type="submit" name="Submit" value="Actualizar" />
	</div>
	</form>
</div>
<div id='modulo' style='margin-top: 10px;'>
	<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th>Comentarios</th>
	</tr>
	</table>
</div>
<div id='comments'>
	<?php 
	foreach($comments as $row){
		echo "<div id='user_comments'>";
		echo "<table cellpadding='0' cellspacing='0' width='100%'>";
		echo "<tr>";
		echo "<td class='date' colspan='2'>";
		if($row->aproved==2)
			echo "<a href='' onClick='ajax_update(\"comments\",\"".base_url()."comments/edit_comment/$row->id\");return false;' style='color: #0763AE;'><img src='".base_url()."imagenes/icons/send.png' border='0' alt='' ></a> ";
		echo $row->created."</td>";	
		echo "</tr>";
		echo "<tr>";
		echo "<td class='title'>".anchor('stories/publica/'.$row->sid,$row->title)."</td>";
		echo "<td align='center' rowspan='2' width='75' style='background-color:white;'>".img("imagenes/icons/".$aproved[$row->aproved])."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td class='text'>".$row->text."</td>";
		echo "</tr>";
		echo "</table>";
		echo "</div>";
	}
	?>
</div>