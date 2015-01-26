<form action="<?=base_url();?>popups/pauta" method="post" id="myform" onsubmit="return false">
<input name="from" type="hidden" id="from" value="Pauta desde futbolecuador.com" />
<div style='background-color: #FAFBFF; padding: 3px; text-align: left; font-size: 12px; color: #456884; margin: 10px;'>
	Sea parte del selecto grupo de auspiciantes de futbolecuador.com
</div>
<div id="register">
	<fieldset id="personal">
		<legend>Pauta con Nosotros</legend>
		<ol>
			<li>
				<label class='left'>Nombre: * <span style="color: red; font-size: 10px;"><?php if(form_error('nombre')!=""):echo "requerido"; endif;?></span></label>
				<input type="text" name="nombre" value="<?=set_value('nombre');?>" />
			</li>
			<li>
				<label class='left'>Empresa: * <span style="color: red; font-size: 10px;"><?php if(form_error('empresa')!=""):echo "requerido"; endif;?></span></label>
				<input name="empresa" type="text" id="empresa" value="<?=set_value('empresa');?>"/>
			</li>
			<li>
				<label class='left'>Teléfono:</label>
				<input name="telefono" type="text" id="telefono" value="<?=set_value('telefono');?>" />
			</li>
			<li>
				<label class='left'>Dirección:</label>
				<input name="direccion" type="text" id="direccion" value="<?=set_value('direccion');?>" />
			</li>
			<li>
				<label class='left'>E-mail: *</label>
				<input name="email" type="text" id="email" value="<?=set_value('email');?>" />
				<div class="validation" style="margin-right: 50px;"><?=form_error('email'); ?></div>
			</li>
			<li>
				<label class='left'>Mensaje: </label>
				<textarea name="mensaje" id="mensaje" cols="34" rows="5"><?=set_value('mensaje');?></textarea>
			</li>
		</ol>
	</fieldset>
	<div style='margin: 10px;'>
		<input type="submit" name="Submit" id="Submit" value="Enviar" onclick="Modalbox.show('<?=base_url();?>popups/pauta', {title: ' ',method: 'post', params: Form.serialize('myform'), }); return false;"/>
	</div>
</div>
</form>

<div id='footer'>
	<table cellspacing='0' cellpadding='0' width='100%'>
		<tr>
			<td align='left'><?=img('imagenes/popups/logo_misiva.jpg');?></td>
			<td align='right'><?=img('imagenes/popups/logo_smg.jpg');?></td>
		</tr>
	</table>
</div>