<div style='margin: 0px; padding: 0px;'>
	<form action="<?=base_url();?>users/forgot" method="post" id="myform" onsubmit="return false">
	<input name="from" type="hidden" id="from" value="Contacto desde futbolecuador.com" />
	<div style='background-color: #FAFBFF; padding: 3px; text-align: left; font-size: 12px; color: #456884; margin: 10px;'>
		Si no recuerdas tu clave ingresa tu nombre de usuario o email en el campo de texto y te enviaremos una nueva clave.
	</div>
	<div id="register">
		<fieldset id="personal">
			<legend>Olvido de clave</legend>
			<ol>
				<li>
					<label>Usuario / Email: </label>
					<input type="text" name="usuario" id="usuario"/>
					<div class="validation" style="margin-right: 50px;"><?=form_error('usuario'); ?></div>
				</li>
			</ol>
		</fieldset>
		<div style='margin: 10px;'>
			<input type="submit" name="Submit" id="Submit" value="Enviar" onclick="Modalbox.show('<?=base_url();?>users/forgot', {title: ' ',method: 'post', params: Form.serialize('myform'), }); return false;"/>
		</div>
	</div>
</form>
</div>
<div id='footer'>
	<table cellspacing='0' cellpadding='0' width='100%'>
		<tr>
			<td align='left'><?=img('imagenes/popups/logo_misiva.jpg');?></td>
			<td align='right'><?=img('imagenes/popups/logo_smg.jpg');?></td>
		</tr>
	</table>
</div>