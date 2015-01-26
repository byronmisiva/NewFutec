<br/>
<span class="title">Tu Comentario</span>
<br/>
<table class="news" cellpadding="2" cellspacing="0">
	
	<tr>
		<td>
			<span class="body">Solo puede comentar si es un usuario registrado!</span>
		</td>
	</tr>
	<tr>
		<td>
			<?if($user['user']!='guest'){?>
				<?if($user['user']){?>
					<?=form_open('moviles/add_comment/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>
					<input type="hidden" name="user_id" value="<?=$user['id']?>">
					<textarea style="width:100%;" name="text"></textarea><br/>
					<input type="submit" name="submit" value="Enviar Comentario" />
					<?='</form>';?>
				<?}?>
			<?}?>
			<br/>
		</td>
	</tr>
	<tr>
		<td>
			<?if($user['user']!='guest'){?>
				<?if($user['user']){?>
					<span class="body">El comentario se publicar&aacute; despues de ser aprobado por nuestros administradores.</span><br/><br/>
				<?}?>
			<?}?>
		</td>
	<tr>
	<tr>
		<td>
			<?
			$num=count($comments);
			foreach($comments as $row):
				echo '<table width=100% style="border-bottom:1px solid grey;">';
				echo '<tr><th><span class="title">'.$num.'</span></th><th><span class="title">'.$row->username.'</span></th><th style="text-align:right"><span class="subtitle">'.$row->created.'</span></th></tr>';
				echo '<tr><td></td><td colspan="2" ><span class="body">'.$row->text.'</span></td></tr>';
				echo '</table>';
				$num--;
			endforeach;
			?>
		</td>
	</tr>
</table>