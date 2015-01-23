<div id='anuncio'>
	<?=$anuncio?>
</div>
<table border="0" cellpadding="0" cellspacing="2" width="100%" style='  padding:5px;'>
	<?php foreach($schedules as $row):?>
	<tr>
		<td><?=$row->season?></td>
		<?php $js="new Ajax.Updater('data_schedules','".base_url()."schedules/ajax_delete/$row->id/$round->id'); return false;";?>
		<td align="right"><?=anchor('', img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar','onClick'=>$js));?></td>
	</tr>
	<?php endforeach;?>
</table>