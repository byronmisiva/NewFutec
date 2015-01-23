	<h1><?php echo $title.' '.$heading?></h1>
	<?php echo $this->session->flashdata('errors_validation');?>
	<?php echo form_open('changes/changes_update')?>
	<?php $row=$query->result(0);
	echo form_hidden('id',$row[0]->id);
	echo form_hidden('match_id',$this->uri->segment(4));
	echo form_hidden('team_id',$this->uri->segment(5))?>
	<table>
	<tr><td>Entra:</td>
	<td><select name="in">
		<?php foreach($query2->result() as $row2): ?>
			<option value="<?=$row2->id;?>"
			<?if($row2->id==$row[0]->in)
				echo "SELECTED";?>			
			><?=$row2->first_name.' '.$row2->last_name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Sale:</td>
	<td><select name="out">
		<?php foreach($query2->result() as $row2): ?> 
			<option value="<?=$row2->id;?>" 
			<?if($row2->id==$row[0]->out)
				echo "SELECTED";?>			
			><?=$row2->first_name.' '.$row2->last_name;?></option>
		<?php endforeach;?>
	</select>*</td></tr>
	<tr><td>Minuto:</td><td><input type="text" name="minute" value="<?=$row[0]->minute?>"/></td></tr>
	</table>
	<br>
	<table>
	<tr><td><input type="submit" value="Actualizar" />*</td>
	<?php echo "</form>"?>
	<?php echo form_open('changes/index/'.$this->uri->segment(4).'/'.$this->uri->segment(5));?>
	<td><input type="submit" value="Cancelar"></td></tr>
	<?php echo "</form>"?>	
	</table>