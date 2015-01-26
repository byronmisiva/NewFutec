<div id='story_day' style='cursor:default;'> 
	<table id='data'>
		<tr>
			<td class='date' width='330'>
				
			</td>
			<td rowspan='4' class='image' align='right' width='140'>
			<?=img(array('src'=>$story->thumbh120,'border'=>'0','alt'=>$story->image_name )); ?>
			</td>
			
		</tr>
		<tr>
			<td class='title'><?=strip_tags($story->title);?></td>
		</tr>
		<tr>
			<td class='subtitle'><?=strip_tags($story->subtitle);?></td>
		</tr>
		<tr>
			<td class='lead'><?=$story->lead;?></td>
		</tr>
	</table>
</div>