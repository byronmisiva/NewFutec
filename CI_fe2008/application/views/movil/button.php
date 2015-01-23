<table class="buttonm" cellpadding="0" cellspacing="0">
	<tr>
		<td><center>
			<table  class="button" cellpadding="0" cellspacing="2">
				<tr>
					<?$i=0;
		 			  $w=316/count($buttons);
		  			  foreach($buttons as $row):
						  if($row['pic']!='')
					  		$minus=5;
					  	  else
					  		$minus=0;
					?>
						  <th width=<?=$w?> onclick="window.location.href='<?=base_url().$row['link']?>'">
						  	  <table>
						  	  	<tr>
						  	  		<td width=<?=$w-$minus?>><div style="margin-left:<?=$minus*8?>px;"><a href='<?=base_url().$row['link']?>'><?=$row['name']?></a></div></td>
						  	  		<?if($row['pic']!=''){?>
						  	  		<td width=<?=$minus?>><img src="<?=base_url().$row['pic']?>"></td>
						  	  		<?}?>
								</tr>
						  	  </table>
						  </th>
						  <?$i+=1;
		  			  endforeach;?>
				</tr>
			</table>
			</center>
		</td>
	<tr>
</table>