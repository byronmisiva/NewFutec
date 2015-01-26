<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('comments/index/'.$comment->story_id,'Comentarios')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php 
	echo form_open('comments/respond/'.$comment->id);
	echo form_hidden('id',0);
	echo form_hidden('story_id',$comment->story_id);
	echo form_hidden('user_id',$user);
	echo form_hidden('comment_id',$comment->id);
	echo form_hidden('aproved',1);
	
	?>
	<table>
	<tr><td>Comentario:</td>
	<td><?=$comment->text?></td></tr>
	<tr><td>Respuesta:</td>
	<td><textarea name="text" cols=20 rows=8><?php echo set_value('text')?></textarea></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('comments/index/'.$comment->story_id);?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>