<div style='margin: 0px; padding: 0px;'>
	<form action="<?=base_url();?>popups/contact_us" method="post" id="myform" onsubmit="return false">
	<input name="from" type="hidden" id="from" value="Contacto desde futbolecuador.com" />
	<div style='background-color: #FAFBFF; padding: 3px; text-align: left; font-size: 12px; color: #456884; margin: 10px;'>
		Tu opinión nos interesa.<br />Escríbenos tus comentarios y sugerencias.
	</div>
	<div id="register">
		<fieldset id="personal">
			<legend>Contáctanos</legend>
			<ol>
				<li>
					<label class='left'>Nombre: </label>
					<input type="text" name="nombre" value="<?=set_value('first_name');?>" />
				</li>
				<li>
					<label class='left'>E-mail: </label>
					<input name="email" type="text" id="email" size="20" />
				</li>
				<li>
					<label class='left'>Mensaje: </label>
					<textarea name="mensaje" id="mensaje" cols="34" rows="5"></textarea>
				</li>
			</ol>
		</fieldset>
		<div style='margin: 10px;'>
			<input type="submit" name="Submit" id="Submit" value="Enviar" onclick="Modalbox.show('<?=base_url();?>popups/contact_us', {title: ' ',method: 'post', params: Form.serialize('myform'), }); return false;"/>
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