<center>
<form action="<?=base_url();?>moviles/user_login/1" method="post">
	<table style="background-color: white; margin-top: 10px;" cellspacing='2' cellpadding='0'>
		<tr>
		<td colspan='2'><div style='font-size: 12px; color: red; margin-left: 15px;'><?= validation_errors(); ?><?=$error;?></div></td>
		</tr>
		
		<tr>
			<td><span class="body">Usuario:</span></td>
			<td><input type="text" name="nick" /></td>
		</tr>
		<tr>
			<td><span class="body">Clave:</span></td>
			<td><input type="password" name="password"/></td>
		</tr>
		<tr>
			<td colspan="2" align="right"></td>
		</tr>
	</table>
	
	<div style='margin-top: 10px; text-align: center; padding-top:10px; '>
		<input type="submit" name="submit" value="Ingresar"/>
	</div>
</form>
<br/>

</center>