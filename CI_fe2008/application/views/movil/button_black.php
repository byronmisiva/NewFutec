<table class="black" style='width:100%;'>
	<tr>
	<?$i=0;
	  $w=320/count($buttons);
	  foreach($buttons as $row):?>
			<td width=<?=$w?> onclick="window.location.href='<?=base_url().$row['link']?>'">
				<a href='<?=base_url().$row['link']?>'><img src="<?=base_url().$row['pic']?>" border="0"/></a>
			</td>
	<?$i+=1;
	  endforeach;
	  echo '</tr><tr>';
	  $i=0;
	  foreach($buttons as $row):?>
			<td width=<?=$w?> onclick="window.location.href='<?=base_url().$row['link']?>'">
				<a href='<?=base_url().$row['link']?>'><?=$row['name']?></a>
			</td>
	<?$i+=1;
	  endforeach;
	 ?>
	</tr>
</table>