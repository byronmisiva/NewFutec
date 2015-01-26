<div id="edit_comment">
<form action="<?=base_url();?>comments/edit_comment" id="comentario" method="post">
<table cellpadding="0" cellspacing="0">
	<tr><td><?=anchor('users/profile','Volver')?><br><br></td></tr>
	<tr><td>
	Comentario:
	<input name="id" value="<?=$id?>" id="id" type="hidden">
	</td></tr>
	<tr><td><textarea name="text" cols="60" rows="5"><?=$comment->text?></textarea></td></tr>
	<tr><td><input type="submit" name="submit" value="Reenviar Comentario" /></td></tr>
</table>
</form>
</div>