<div id="admin">
	<h1><?=$title;?></h1>
	<div id='form_insert' style='width:95%;margin:10px;'>
	<div class="validation">
	<ul>
		<?= validation_errors(); ?>
	</ul>
	</div>
	<?=form_open('statistics_matches');?>
	<?=form_hidden('match_id',$match);?>
	<fieldset id="personal">
		<legend>Inserta un nuevo registro:</legend>
		<table>
		<tr><td><?=form_textarea('text',set_value('text'));?></td></tr>
		<tr><td colspan='2'><?=form_submit('submit', 'Ingreso');?></td>
		</table>
	</fieldset>
	<?=form_close();?>
	</div>
	
	<table class='listing' border=1>
	<tr>
	<th>TEXTOS</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row):?>
	 <tr class='altrow'>
	 <td><?php
		 echo substr($row->text,0,250);
		 if(strlen($row->text)>250)
		 	echo ' ...';
		 ?>
	 </td>
	 <td class="actions" valign='middle'>
	 <?=anchor('statistics_matches/update/'.$row->id, img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Editar'));?>
	 <?=anchor('statistics_matches/delete/'.$row->id,img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar'));?>

	 </td>
	 </tr>
	 <?php endforeach;?>
	</table>
	<br>
    	<?php echo $this->pagination->create_links();?>
	<br>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Inicio')?></li>
        <li> <?=img(array('src'=>'imagenes/icons/images.png','border'=>'0')) ?> <?=anchor('images','Imagenes')?></li>
    </ul>
	</div>
</div>