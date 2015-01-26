<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li><?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('index/index_v','Home')?></li>
        <li><?=img(array('src'=>'imagenes/icons/encuestasecciones.png','border'=>'0')) ?> <?=anchor('sections_surveys/index/'.$this->uri->segment(3),'Encuestas de Secci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	<?php echo form_open('sections_surveys/insert/'.$this->uri->segment(3))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('section_id',$this->uri->segment(3))?>
	<table>
	<tr><td>Encuesta:</td>
	<td><select name="survey_id">
		<?php foreach($query->result() as $row): ?> 
			<option value="<?=$row->id;?>"><?=$row->title;?></option>
		<?php endforeach;?>
	</select></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name="submit" value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('sections_surveys/index/'.$this->uri->segment(3));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>