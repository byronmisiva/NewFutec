<div id="admin" style='border-left: 1px solid black;'>
	<h1><?php echo $title.$heading?></h1>
	<table class='listing' border=1>
	<tr>
	<th>NOMBRE</th>
	<th>SUM</th>
	<th></th>
	</tr>
	 <?php foreach($query->result() as $row): ?>
	 <tr class='altrow'>
	 <td><?php echo $row->name;?></td>
	 <td><?php echo $row->sum;?></td>
	 <td class="actions">
	 <?=anchor('tags/confirm_delete/'.$row->id.'/'.$row->name, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?>
	 </td>
	 </tr>
	 <?php endforeach;?>
	</table>
	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/house.png','border'=>'0')) ?> <?=anchor('admin','Home')?></li>
    </ul>
	</div>
</div>