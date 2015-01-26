<div id='send_story'>
	<form method="post" id='myform' onsubmit="return false;"/>
	<?=form_hidden('id', $noticia->id);?>
		
	<div style='background-color: #FAFBFF; padding: 3px; text-align: left; font-size: 12px; color: #456884; margin: 10px;'>
		Tu vas a enviar la siguiente noticia:
	</div>
	<div id='title'>
	"<?=$noticia->title?>"
	</div>
	<div id="register">
		<fieldset id="personal">
			<legend>Envia una Noticia</legend>
			<ol>
				<li>
					<label class='left'>Para: </label>
					<?=form_input(array('name'=>'to','size'=> '34'));?><br>
					<span>Direccion e-mail a quien deseas enviar.</span> 
				</li>
				<li>
					<label class='left'>Comentario: </label>
					<?=form_textarea(array('name'=>'comment','rows'=>'5','cols'=>'39'))?>
				</li>
			</ol>
		</fieldset>
		<div style='margin: 10px;'>
			<input type="submit" name="submit" id="submit" value="Enviar" onclick="Modalbox.show('<?=base_url();?>stories/send', {title: ' ',method: 'post', params: Form.serialize('myform'), }); return false;"/>
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