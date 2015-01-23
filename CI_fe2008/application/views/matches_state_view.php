<?$estado['0']='No Iniciado';
  $estado['1']='Primer Tiempo';
  $estado['2']='Fin del Primer Tiempo';
  $estado['3']='Segundo Tiempo';
  $estado['4']='Fin Segundo Tiempo';
  $estado['5']='Primer Extra';
  $estado['6']='Segundo Extra';
  $estado['7']='Penales';
  $estado['8']='Fin del Partido';?>
<center><b>Estado:</b>
<select id="state" name="state" onChange="state_insert('<?=base_url();?>matches_actions/state_insert','<?=base_url();?>matches_actions/matches_state_view','<?=$this->uri->segment(3)?>','<?=base_url();?>matches_actions/matches_table_view','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>','<?=$this->uri->segment(6)?>','<?=base_url()?>');">
	<?for($i=0; $i<9; $i+=1){?>
		<option value=<?=$i?>><?=$estado[$i]?></option>
	<?}?>
</select></center>