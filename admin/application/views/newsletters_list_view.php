<?php if($query->num_rows()==0){?>
<?='No existen noticias'?>
<?php }else{?>
<table class='listing' border=1>
	<tr>
	<th>NOTICIA</th>
	<th>FECHA</th>
	<th></th>
	</tr>
	<?php foreach($query->result() as $row): ?>
	<tr  class='altrow'>
	<td><?=$row->title;?></td>
	<td><?=$row->modified;?></td> 
	<td>
		<a class="" href="#" onClick="newsletters_stories_delete('<?=base_url();?>newsletters/newsletters_stories_delete','<?=base_url();?>newsletters/list_view','<?=$row->id?>','<?=$this->uri->segment(3)?>');"><img src='<?=base_url();?>imagenes/icons/cross.png' border=0></a>
	</td>
	</tr>
	<?php endforeach;?>
</table>
<?php }?>