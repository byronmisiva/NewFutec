<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>
	<br><br>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>VISTAS</th>
	<th>VISTAS %</th>
	<th></th>
	</tr>
	 <?php foreach($stat as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row['name'];?></td>
	 <td><?php echo $row['view'];?></td>
	 <td><?php echo $row['percent'];?></td>
	 <td class="actions">
	 <? if($row['name']!='Total') {?>
	 <?=anchor('statistics/statistics_vdate/'.$row['id'], img(array('src'=>'imagenes/icons/pencil.png','border'=>'0')), array('title' => 'Vista por Fecha'));?>
	 <?	}?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	 </table>
	<br>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>