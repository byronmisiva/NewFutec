<div id="admin">
	<h1><?php echo $title; echo $heading?></h1>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/alineacion.png','border'=>'0')) ?> <?=anchor('lineups/index/'.$this->uri->segment(3).'/'.$this->uri->segment(4),'Alineaci&oacute;n')?></li>
    </ul>
	</div>
	<br>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?php   if ($query->num_rows() > 0) {
		  echo form_open('lineups/insert/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>
	<?php echo form_hidden('id',$id=0);
	echo form_hidden('match_id',$this->uri->segment(3));
	echo form_hidden('team_id',$this->uri->segment(4));
	$i=0?>      
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>ESTADO</th>
	<th>POSICI&Oacute;N</th>
	</tr>
	<?php foreach($query->result() as $row): ?> 
	<tr class='altrow'><td>	
		<?php $i=$i+1;?>
		<?php echo form_hidden('player_id'.$i, $row->id);
			  echo $row->first_name.' '.$row->last_name.' ';?>
	</td><td>			
	<select name="status<?php echo $i?>">
			<option value=2>No convocado</option>
			<option value=0>Suplente</option>
			<option value=1>Titular</option>
			
	</select>
	</td><td>
	<select name="position<?php echo $i?>">
			<option value="Arquero">Arquero</option>
			<option value="Defensa">Defensa</option>
			<option value="Volante">Volante</option>
			<option value="Delantero">Delantero</option>
	</select>
	</td></tr>
	<?php endforeach;?>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" name='submit' value="Ingreso" /></td>
	<?php echo "</form>"?>
	<?php }else{ echo 'Ya no existen m&aacute;s jugadores para ingresar <br><br><table><tr>'; }?>
	<?php echo form_open('lineups/index/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>
</div>