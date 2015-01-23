<?php
foreach($stories as $row):
?>
<div id='story_day' onClick='window.location="<?=base_url();?>stories/publica/<?=$row->id;?>";'> 
	<table id='data'>
		<tr>
			<td class='date' width='330'>
				<!-- FE_ND_AUSPICIO -->
				<div id='FE_ND_AUSPICIO' style='width:320px; height:50px; background-image: url(http://adserver.misiva.com.ec/futbolecuador/2013/noticia_del_dia/noticia.png); background-repeat:no-repeat;'>
					<script type='text/javascript'>
					GA_googleFillSlot("FE_ND_AUSPICIO");
					</script>
				</div>
			</td>
			<td rowspan='4' class='image' align='right' width='140'>
			<?=img(array('src'=>$row->thumb1,'border'=>'0','alt'=>$row->image_name )); ?>
			</td>
			
		</tr>
		<tr>
			<td class='title'><?=anchor('stories/publica/'.$row->id,strip_tags($row->title));?></td>
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