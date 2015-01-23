	<h1><?php echo $title.' '.$heading?></h1>
	<?php echo form_open('timers/timers_update')?>
	<?php $row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('match_id',$this->uri->segment(4));?>
	<table>
	<tr><td>Acci&oacute;n:</td>
	<td><select name="action"> 
			<option value=1
			<?if(1==$row[0]->action)
				echo "SELECTED";?>			
			>Play</option>
			<option value=0
			<?if(0==$row[0]->action)
				echo "SELECTED";?>			
			>Stop</option>
	</select>*</td></tr>
	<tr><td>Tiempo de Juego:</td>
	<td><select name="play_time"> 
			<option value=1 
			<?if(1==$row[0]->play_time)
				echo "SELECTED";?>			
			>Primero</option>
			<option value=2
			<?if(2==$row[0]->play_time)
				echo "SELECTED";?>			
			>Segundo</option>
			<option value=3
			<?if(3==$row[0]->play_time)
				echo "SELECTED";?>			
			>Extra 1</option>
			<option value=4
			<?if(4==$row[0]->play_time)
				echo "SELECTED";?>			
			>Extra 2</option>		
	</select>*</td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" value="Actualizar" /></td>
	<?php echo "</form>"?>
	<?php echo form_open('timers/index/'.$this->uri->segment(4));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>
	</table>