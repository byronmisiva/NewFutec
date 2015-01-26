<?php if($query->num_rows()==0){?>
<?='No existen noticias'?>
<?php }else{?>
<table class='listing' border="0">
	<tr>
	<th></th>
	<th>NOTICIA</th>
	<th>FECHA</th>
	<th></th>
	</tr>
	<?php foreach($query->result() as $row):
			$style='';
			if($row->position==0) $style='background-color:#C3D4DB';
	?>
	<tr  class='altrow'>
	<td>
	<div style='cursor: pointer;float:left; width:20px;' onclick='AJX_updater("lista","<?=base_url().'newsletters/downStoryOrder/'.$row->id;?>");'><img src='<?=base_url()?>imagenes/icons/arrow_up.png'/></div>
	<div style='cursor: pointer;float:right; width:20px;' onclick='AJX_updater("lista","<?=base_url().'newsletters/upStoryOrder/'.$row->id;?>");'><img src='<?=base_url()?>imagenes/icons/arrow_down.png'/></div>
	</td>
	<td style='<?=$style?>'><?=$row->title;?></td>
	<td><?=$row->modified;?></td> 
	<td>
		<a class="" href="#" onClick="newsletters_stories_delete('<?=base_url();?>newsletters/newsletters_stories_delete/<?=$row->id?>/<?=$row->newsletter_id?>','lista');"><img src='<?=base_url();?>imagenes/icons/cross.png' border=0></a>
	</td>
	</tr>
	<?php endforeach;?>
</table>
<?php }?>