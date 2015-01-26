<div id="admin">
	<h1>Creación de Nuevo Campeonato</h1>
	
	<div id='mensaje'>
	
	Usted va a iniciar el proceso de creacion de Campeonato.<br>
	Por favor no salir del proceso hasta que se le indique que ha
	terminado.<br> 
	Recuerde que el nombre que ingrese será el que aparece en toda la pagina
	</div>
	
	<div id='formulario'>
		<div class="validation">
			<ul>
				<?= validation_errors(); ?>
			</ul>
		</div>
		
		<?=form_open_multipart('championships/insert/step2')?>
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td class='label'>Nombre:</td>
				<td><input type="text" name="name" size="40" value="<?php echo set_value('name')?>"/>*</td>
			</tr>
			<tr>
				<td class='label'>Logo (300x300):</td>
				<td><input type="file" name="image" /></td>
			</tr>
			<tr>
				<td class='label'>Año:</td>
				<td><?php echo form_dropdown('year', $years, set_value('year'));?></td>
			</tr>
			<tr>
				<td class='label'>Rondas:</td>
				<td><?php echo form_dropdown('rounds', $rounds, set_value('round'));?></td>
			</tr>
			<tr>
				<td colspan='2'  align="right"><input type="submit" name="submit" value="Siguiente >>" /></td>
			</tr>
		</table>
		<?=form_close();?>
	</div>
</div>