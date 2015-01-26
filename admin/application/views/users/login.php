<div id="admin" style='margin: 50px; margin-left: 100px;' align='center'>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
		<?= $login_errors; ?>
	</ul>
	</div>
	<div id='login' align='center'>
	<?php echo form_open('users/login')?>
	<table class='tabla' cellspacing='0' cellpadding='0'>
		<tr>
		<th colspan='2'>Ingreso Administrativo</th>
		</tr>
		<tr>
			<td class='label'>Usuario:</td>
			<td class='data'><input type="text" id="nick" name="nick" value="<?=set_value('nick');?>"/></td>
		</tr>
		<tr>
			<td class='label'>Clave:</td>
			<td class='data'><input type="password" id="password" name="password" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right" class='button'><input type="submit" id="submit" name="submit" value="Ingresa" /></td>
		</tr>
	</table>
	<?php echo form_close();?>
	</div>
</div>