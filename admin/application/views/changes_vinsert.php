<?php if($query->num_rows()==0 || $query2->num_rows()==0){?>
<?='No se pueden realizar cambios <br><br> Ya no existen m&aacute;s suplentes o debe ingresar alineaci&oacute;n '?>
<?php }else{?>
<center>
<table  class='listing' border=1>
<tr><th>Entra:</th>
<td><select id="in" name="in">
	<?php foreach($query->result() as $row): ?> 
		<option value="<?=$row->id;?>"<?php if(set_value('in')==$row->id) echo " SELECTED "?>><?=$row->first_name.' '.$row->last_name;?></option>
	<?php endforeach;?>
</select>*</td></tr>
<tr><th>Sale:</th>
<td><select id="out" name="out">
	<?php foreach($query2->result() as $row): ?> 
		<option value="<?=$row->id;?>"<?php if(set_value('out')==$row->id) echo " SELECTED "?>><?=$row->first_name.' '.$row->last_name;?></option>
	<?php endforeach;?>
</select>*</td></tr>
<tr><th>Minuto:</th>
<td><select id="minute" name="minute">
<?php for($i=1;$i<121;$i+=1){
		echo '<option value='.$i.'>'.$i.'</option>';	
}?>
</select>*</td></tr>
</table>
<br>
<input type="button" name='button' value="Ingreso" onClick="changes_insert('<?=base_url();?>matches_actions/changes_insert','<?=base_url();?>matches_actions/matches_table_view','<?=base_url();?>matches_actions/changes_insert/','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','lista','<?=$this->uri->segment(5)?>','<?=$this->uri->segment(6)?>');">
</center>
<?php }?>