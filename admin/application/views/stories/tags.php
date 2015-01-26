<div id='modulo'>
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th><?=$name;?></th>
</tr>
</table>
</div>
<?php 
foreach($query->result() as $row):
?>
<div id='story' onClick='window.location="<?=base_url();?>stories/publica/"+<?=$row->id;?>;'> 
	<table id='data'>
		<tr>
			<td rowspan='4' class='image'>
			<?=img(array('src'=>$row->thumbh80,'border'=>'1'));?>
			</td>
			<td class='date'><?=mdate('%M %d del %Y',$row->datem);?></td>
		</tr>
		<tr>
			<td class='title'><span class='hour'><?=strip_tags($row->title);?></span></td>
		</tr>
		<tr>
			<td class='subtitle'><?=strip_tags($row->subtitle);?></td>
		</tr>
		<tr>
			<td class='lead'><?=strip_tags($row->lead);?></td>
		</tr>
	</table>
</div>
<?php endforeach;?>
<br>
<center><?php echo $this->pagination->create_links();?></center>
