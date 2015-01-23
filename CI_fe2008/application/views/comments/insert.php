<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('index/index_v','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/modules.png','border'=>'0')) ?> <?=anchor('coments/index/'.$this->uri->segment(3),'Comentarios')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php 
	echo form_open('comments/insert/'.$this->uri->segment(3));
	echo form_hidden('id',$id=0);
	echo form_hidden('story_id',$story);
	echo form_hidden('user_id',$user);
	echo form_hidden('comment_id',$comment=0);
	?>
	<table>
	<tr><td>Texto:</td>
	<td><textarea name="text" cols=20 rows=8><?php echo set_value('text')?></textarea>*</td></tr>
	<tr><td>Estado:</td>
	<td><select name="aproved">
		<option value=1 <?php if(set_value('aproved')==1) echo " SELECTED " ?>>Aprovado</option>
		<option value=0 <?php if(set_value('aproved')==0) echo " SELECTED " ?>>Desaprovado</option>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('comments/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>