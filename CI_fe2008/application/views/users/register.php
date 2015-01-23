<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Lo Mejor del F&uacute;tbol Ecuatoriano">
<meta name="verify-v1" content="Hce4cvZEurCLqvJK3uxqf3PNtXUFk9CbggQVL+EjiJI=" >
<title><?=base_url().'- Registro'?></title>
<link type="text/css" rel="stylesheet" href="<?=base_url();?>css/public.css">
<link type="text/css" rel="stylesheet" href="<?=base_url();?>css/modalbox.css">
<link type="text/css" rel="stylesheet" href="<?=base_url();?>css/lightbox.css" media="screen" >
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/effects.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/lightbox.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/scripts.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/public_ajax.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/modalbox.js"></script>
</head>
<body>

<center>
<div>
	<a src="<?=base_url()?>"><img src="<?=base_url().'/imagenes/titulo_normal.png'?>"></img></a>
</div>


<div id="register" style="background-color:white; width:525px;">
	<form action="<?=base_url();?>users/register" method="post" id="myform"> 
	<fieldset id="personal">
	<legend>Datos Personales</legend>
	<ol>
		<li>
			<label>Nombre: <em>requerido</em></label>
			<input type="text" name="first_name" value="<?=set_value('first_name');?>" /> <span style="color: red;"><?php if(form_error('first_name')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Apellido: <em>requerido</em></label>
			<input type="text" name="last_name" value="<?=set_value('last_name');?>"/> <span style="color: red;"><?php if(form_error('last_name')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Usuario: <em>requerido</em></label>
			<input type="text" name="nick" value="<?=set_value('nick');?>"/> <span style="color: red;"><?php if(form_error('nick')!=""):echo "*"; endif;?></span>
			<div class="validation" style="margin-right: 50px;"><?=form_error('nick'); ?></div>
		</li>
		
		<li>
			<label>Sexo: <em>requerido</em></label>
			<select name="sex">
				<option value="m" <?if(set_value('sex')=='m') echo 'SELECTED' ?>>Masculino</option>
				<option value="f" <?if(set_value('sex')=='f') echo 'SELECTED' ?>>Femenino</option>
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
					<option value="<?=$i?>"  <?if(set_value('day')==$i) echo 'SELECTED' ?>><?=$i?></option>
				<?}?>
			</select><span style="color: red;"><?php if(form_error('day')!=""):echo "*"; endif;?></span>
		</li>
		<?$month[1]='Enero'; $month[2]='Febrero'; $month[3]='Marzo'; $month[4]='Abril'; $month[5]='Mayo'; $month[6]='Junio'; 
			  $month[7]='Julio'; $month[8]='Agosto'; $month[9]='Septiembre'; $month[10]='Octubre'; $month[11]='Noviembre'; $month[12]='Diciembre'; ?>
		<li>
			<label>Mes: </label>
			<select name="month">
				<?for($i=1;$i<13;$i++){?>
					<option value="<?=$i?>" <?if(set_value('month')==$i) echo 'SELECTED' ?>><?=$month[$i]?></option>
				<?}?>
			</select><span style="color: red;"><?php if(form_error('month')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>A&ntilde;o: </label>
			<select name="year">
				<?for($i=mdate('%Y',time());$i>1930;$i--){?>
					<option value="<?=$i?>"  <?if(set_value('year')==$i) echo 'SELECTED' ?>><?=$i?></option>
				<?}?>
			</select><span style="color: red;"><?php if(form_error('year')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Clave: <em>requerido</em></label>
			<input type="password" name="password" /> <span style="color: red;"><?php if(form_error('password')!=""):echo "*"; endif;?></span>
			<div class="validation" style="margin-right: 50px;"><?=form_error('password'); ?></div>
		</li>
		<li>
			<label>Confirma tu Clave: <em>requerido</em></label>
			<input type="password" name="passconf" /> <span style="color: red;"><?php if(form_error('passconf')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Email: <em>requerido</em></label>
			<input type="text" name="mail" value="<?=set_value('mail');?>"/> <span style="color: red;"><?php if(form_error('mail')!=""):echo "*"; endif;?></span>
			<div class="validation" style="margin-right: 50px;"><?=form_error('mail'); ?></div>
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
			echo form_dropdown('country_id', $countries,"",$js);
			?>
			<span style="color: red;"><?php if(form_error('country_id')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Ciudad:</label>
			<div id='cmb_city_id'>
			<?php 
			$js= 'id="city_id" disabled="disabled"';
			echo form_dropdown('city_id', $cities,"",$js);
			?>
			<span style="color: red;"><?php if(form_error('city_id')!=""):echo "*"; endif;?></span>
			</div>
		</li>
		<li>
			<label>Hincha de:</label>
			<?php echo form_dropdown('team_id', $teams, set_value('team_id'));?>
			<span style="color: red;"><?php if(form_error('team_id')!=""):echo "*"; endif;?></span>
		</li>
		<li>
			<label>Suscripcion:</label>
			<?=form_checkbox(array('name'=>'suscription','id'=>'suscription','value'=> '1','checked'=> TRUE,'style'=> 'width:15px;'));?> 
		</li>
		<li>
			<label>Acepto los <a href="<?=base_url();?>terminos.html" target="_blank">terminos de uso</a>:</label>
			<?=form_checkbox(array('name'=>'terminos','id'=>'terminos','value'=> 'accept','style'=> 'width:15px;'));?>
		</li>
	</ol>
	</fieldset>
	<input type="submit" name="submit" value="Registrate !!"  />
	<input type="button" name="regresar" value="Regresar"  onClick="location.href='<?=base_url()?>'"/>
	</form>
</div>
</center>
<!-- 
<div id='footer'>
	<table cellspacing='0' cellpadding='0' width='100%'>
		<tr>
			<td align='left'><?//=img('imagenes/popups/logo_misiva.jpg');?></td>
			<td align='right'><?//=img('imagenes/popups/logo_smg.jpg');?></td>
		</tr>
	</table>
</div>
 -->
 </body>
 </html>