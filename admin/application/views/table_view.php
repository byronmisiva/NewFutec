<?php if(count($tabla)==0){?>
<?='No existen acciones'?>
<?php }else{?>
<table class='listing' border=1>
	<tr>
	<th>MIN</th>
	<th>ACCI&Oacute;N</th>
	<th></th>
	</tr>
	<?php foreach($tabla as $row): ?>
	<tr class='altrow'>
	<td><?if($row['minute']<=120) echo $row['minute'];?></td>
	<td><?=img(array('src'=>$row['team'],'border'=>'0','width'=>20,'height'=>20)).'  '.$row['text']?></td> 
	<td>
		<?if($row['type']==4 || $row['type']==92 || $row['type']==93 || $row['type']==94 || $row['type']==95 || $row['type']==96 || $row['type']==97 || $row['type']==98 || $row['type']==99){?><a class="" href="#" onClick="acg_delete('<?=base_url();?>matches_actions/delete_actions/','<?=base_url();?>matches_actions/matches_table_view','<?=$row['id']?>','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>');"><img src='<?=base_url();?>imagenes/icons/cross.png' border=0></a><?php }?>
		<?if($row['type']==1){?><a class="" href="#" onClick="acg_delete('<?=base_url();?>matches_actions/delete_goals/','<?=base_url();?>matches_actions/matches_table_view','<?=$row['id']?>','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>','1','<?=base_url();?>matches_actions/score_view');"><img src='<?=base_url();?>imagenes/icons/cross.png' border=0></a><?php }?>
		<?if($row['type']==2){?><a class="" href="#" onClick="acg_delete('<?=base_url();?>matches_actions/delete_cards/','<?=base_url();?>matches_actions/matches_table_view','<?=$row['id']?>','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>','0');"><img src='<?=base_url();?>imagenes/icons/cross.png' border=0></a><?php }?>
		<?if($row['type']==3){?><a class="" href="#" onClick="changes_delete('<?=base_url();?>matches_actions/delete_changes/','<?=base_url();?>matches_actions/matches_table_view','<?=$row['id']?>','<?=$this->uri->segment(3)?>','<?=$this->uri->segment(4)?>','<?=$this->uri->segment(5)?>','0');"><img src='<?=base_url();?>imagenes/icons/cross.png' border=0></a><?php }?>
	</td>
	</tr>
	<?php endforeach;?>
</table>
<?php }?>
