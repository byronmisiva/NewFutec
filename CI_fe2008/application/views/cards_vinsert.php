<?php if($query->num_rows()==0){?>
<?='No se pueden ingresar tarjetas <br><br> Ingrese Alineaci&oacute;n'?>
<?php }else{?>
<center>
<table class='listing'  border=1>
<tr><th>Jugador:</th>
<td><select id="player_id" name="player_id">
	<?php foreach($query->result() as $row): ?> 
		<option value="<?=$row->id;?>"<?php if(set_value('player_id')==$row->id) echo ' SELECTED '?>><?=$row->first_name.' '.$row->last_name;?></option>
	<?php endforeach;?>
</select>*</td></tr>
<tr><th>Minuto:</th>
<td><select id="minute" name="minute">
<?php for($i=1;$i<121;$i+=1){
		echo '<option value='.$i.'>'.$i.'</option>';	
}?>
</select>*</td></tr>
<tr><th>Tipo:</th>
<td><select id="type" name="type">
	<option value=1<?php if(set_value('type')==1) echo ' SELECTED '?>>Amarilla</option>
	<option value=2<?php if(set_value('type')==2) echo ' SELECTED '?>>Roja</option>
</select>*</td></tr>
</table>
<br>
<input type="button" name='button' value="Ingreso" onClick="cards_insert('<?=base_url();?>matches_actions/cards_insert','<?=base_url();?>matches_actions/matches_table_view','<?=base_url();?>matches_actions/cards_insert/','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','lista','<?=$this->uri->segment(5)?>','<?=$this->uri->segment(6)?>');">
</center>
<?php }?>