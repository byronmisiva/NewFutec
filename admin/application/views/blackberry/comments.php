<br/>
<span class="title" style='font-size: 12px;'>Tu Comentario</span>
<br/>
<table width=100% class="" cellpadding="2" cellspacing="0">
	
	<tr>
		<td width=100%>
			<span class="body" style='font-size: 11px;'>Solo puede comentar si es un usuario registrado!</span>
		</td>
	</tr>
	<tr>
		<td width=100%>
			<?if($user['user']!='guest'){?>
				<?if($user['user']){?>
					<?=form_open('blackberries/add_comment/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
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
		<td width=100%>
			<?if($user['user']!='guest'){?>
				<?if($user['user']){?>
					<span class="body" style='font-size: 11px;'>El comentario se publicar&aacute; despues de ser aprobado por nuestros administradores.</span><br/><br/>
				<?}?>
			<?}?>
		</td>
	<tr>
	<tr>
		<td width=100%>
			<?
			$num=count($comments);
			foreach($comments as $row):
				echo '<table width=100% style="border-bottom:1px solid grey;">';
				echo '<tr><th width=5% ><span class="title" style=\'font-size: 12px;\'>'.$num.'</span></th><th align=left><span class="title" style=\'font-size: 12px;\'>'.$row->username.'</span></th><th style="text-align:right"><span class="subtitle" style=\'font-size: 12px;\'>'.$row->created.'</span></th></tr>';
				echo '<tr><td width=5%></td><td colspan="2" ><span class="body" style=\'font-size: 11px;\'>'.$row->text.'</span></td></tr>';
				echo '</table>';
				$num--;
			endforeach;
			?>
		</td>
	</tr>
</table>