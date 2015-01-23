<div id='anuncio'>
	<?=$anuncio?>
</div>
<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>
	<?php foreach($my_teams as $row):?>
	<tr>
		<td><?=$row->name?></td>
		<?php $js="new Ajax.Updater('data','".base_url()."championships_teams/ajax_delete/$row->ctid/$championship->id'); return false;";?>
		<td><?=anchor('', img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar','onClick'=>$js));?></td>
	</tr>
	<?php endforeach;?>
</table>