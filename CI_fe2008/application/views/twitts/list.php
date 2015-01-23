<table class='listing' border=1>
<tr>
<th>TIPO</th>
<th>ELEMENTO</th>
<th></th>
</tr>
 <?php foreach($results as $row):?>
 <tr class='altrow'>
 <td><?php echo $row->name;?></td>
 <td><?php echo $row->element_name;?></td>
 <td class="actions">
 <?=anchor('twitts/delete/'.$row->id, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'AJX_updater(\'listado\',\''.base_url().'twitts/delete/'.$row->id.'\'); return false;'));?>
</td>
 </tr>
 <?php endforeach;?>
</table>
