<center>
<form action="<?=base_url();?>blackberries/user_login" method="post">
	
	<table width=100% style="background-color: white; margin-top: 10px;" cellspacing='2' cellpadding='0'>
		<tr>
		<td colspan='2'><div style='font-size: 12px; color: red; margin-left: 15px;'><?= validation_errors(); ?><?=$error;?></div></td>
		</tr>
		
		<tr>
			<td width=40% align=right><span class="body">Usuario:</span></td>
			<td width=60% align=left><input type="text" name="nick" /></td>
		</tr>
		<tr>
			<td width=40% align=right><span class="body">Clave:</span></td>
			<td width=60% align=left><input type="password" name="password"/></td>
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