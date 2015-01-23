<div style="width:310px; margin-bottom:10px; margin-left:5px; font-type:Arial; font-size: 14px;">
	<?=form_open('moviles/send/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>
	<?=form_hidden('id', $this->uri->segment(3));?>
	<div style='background-color: #FAFBFF; padding: 3px; text-align: left; font-size: 12px; color: #456884; margin: 10px;'>
		Tu vas a enviar la siguiente noticia:
	</div>
	<?if(set_value('from')!='' || set_value('to')!=''){?> 
	<div style='background-color: #FFEAEB; padding: 3px; text-align: left; font-size: 12px; color: #843558; margin: 10px;'>
		<?if(set_value('to')!='')
			echo 'El campo De no es un correo v&aacute;lido';
		  if(set_value('from')!='')
			echo '<br/>El campo Para no es un correo v&aacute;lido';
		?>
	</div>
	<?}?>
	<div style="margin-left:2px;">
		<?=$noticia->title?>
	</div>
	<center>
	<table width=310>
		<tr><td>Envia:</td><td><?=form_input(array('name'=>'name','size'=> '30','value'=>set_value('name')));?></td></tr>
		<tr><td></td><td><span style="font-size:10px;">Nombre de quien env&iacute;a</span></td></tr>
		<tr><td>De:</td><td><?=form_input(array('name'=>'from','size'=> '30','value'=>set_value('from')));?></td></tr>
		<tr><td></td><td><span style="font-size:10px;">Mail de quien env&iacute;a</span></td></tr>
		<tr><td>Para</td><td><?=form_input(array('name'=>'to','size'=> '30','value'=>set_value('to')));?></td></tr>
		<tr><td></td><td><span style="font-size:10px;">Mail destinatario</span></td></tr>
		<tr><td>Comentario</td><td><?=form_textarea(array('name'=>'comment','rows'=>'5','cols'=>'26','value'=>set_value('comment')))?></td></tr>
	</table>
		<input type="submit" name="submit" id="submit" value="Enviar"/>
	</center>
	<?php echo "</form>"?>
</div>
