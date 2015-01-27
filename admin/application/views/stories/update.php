<div id="admin">
	<h1><?=$title.$heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/news.png','border'=>'0')) ?> <?=anchor('stories','Noticias')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/folder.png','border'=>'0')) ?> <?=anchor('categories','Categorias')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open('stories/update/'.$this->uri->segment(3));?>
	<?=form_hidden('id',$row[0]->id);?>
	<?=form_hidden('previous_url',$previous_url);?>
	
	<table style='font-size:14px;'>
	<tr>
		<td class='required'>*</td>
		<td>Categor&iacute;a:</td>
		<td><?php echo form_dropdown('category_id', $categories, $row[0]->category_id);?></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Posición:</td>
		<td><?php echo form_dropdown('position', $positions, $row[0]->position);?></td>
	</tr>
	<tr>
		<td class='required'></td>
		<td>Programar:</td>
		<td>
		<input type="text" name="programed" value="<?=$row[0]->programed?>" readonly >
		<input type="button" value="Cal" onclick="displayCalendar(document.forms[0].programed,'yyyy/mm/dd hh:ii',this,true)">
		<input type="button" value="Reset" onclick="document.forms[0].programed.value='';">
		</td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>T&iacute;tulo:</td>
		<td><input type="text" name="title" size="80" value="<?= $row[0]->title?>"/></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Subt&iacute;tulo:</td>
		<td><input type="text" name="subtitle" size="80" value="<?= $row[0]->subtitle?>"/></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Twitter:</td>
		<td><input type="text" name="twitter" size="80" maxlength="120" value="<?= $row[0]->twitter?>"/></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td>Origen:</td>
		<td><input type="text" name="origen" size="40" value="<?= $row[0]->origen?>"/></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td valign='top'>Introducci&oacute;n:</td>
		<td><textarea style="width:100%;" name="lead"><?= $row[0]->lead?></textarea></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td valign='top'>Cuerpo:</td>
		<td><textarea style="width:100%;" name="body"><?= $row[0]->body?></textarea></td>
	</tr>
	<tr>
		<td class='required'>*</td>
		<td valign='top'>Relacionado:</td>
		<td>
			<input type="text" id="tags" name="related" size="80" value="<?=$tags?>" />
			<span id="indicator1" style="display: none">
			  <img src="<?=base_url();?>imagenes/icons/loader.gif" alt="Buscando..." />
			</span>
			<div id="autocomplete_choices" class="autocomplete">
			</div>
			<div style="padding:2px; color:gray; text-align:left; line-height: 1.7; font-size: 13px;">
				Separa las etiquetas con punto y coma ( ; ).
			</div>
		
		</td>
	</tr>
	<tr>
		<td class='required'></td>
		<td valign='top'>Patrocinada:</td>
		<td>
			<?php
			$sponsor = FALSE;
			if($row[0]->sponsored == 1)
				$sponsor = TRUE;
			echo form_checkbox('sponsored', '1', $sponsor); 
			?>
		</td>
	</tr>
	<tr>
	<td colspan='3'>
	<table>
	<tr>
	<td class='required'>*</td>
	<td width='85' valign='top'>Imagen:</td>
	<td valign='top'>
		<?php echo form_dropdown('image_id', $images, $row[0]->image_id,'id="image_id" onChange="imageFromSelect(this,\'marco_imagen\',\''.base_url().'\');"');?>
	</td>
	<td rowspan='2' style="padding-left: 40px;">
		<div id='marco_imagen' class='marco_imagen'><?=img(array('src'=>"http://www.futbolecuador.com/" .$images_url[$row[0]->image_id],'border'=>'0')) ?></div>
	</td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('stories/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>

<script type="text/javascript">
new Ajax.Autocompleter("tags", "autocomplete_choices", "<?=base_url().'tags/search_tag'?>",{tokens: ';',minChars: '3',indicator: 'indicator1',afterUpdateElement : addToken});
	function addToken(text, li) {
	   text.value+='; ';
	}
</script>