<table width=100% cellspacing=0 cellpadding=2>
	<?$col[0]="#FFFFFF";
	  $col[1]="#F3F3F3";
      $i=0;
	  $j=0;
	  foreach($stories as $row):
	  	if($i%2==0){$j=0;}else{$j=1;}?>
	  	<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->time))){?>
				<tr><td width=10% bgcolor="<?=$col[$j]?>" style="font-family: Arial; font-size: 11px;"><?=ucfirst(strftime('%H:%M',$row->time))?></td>
				<?}else{?>
				<tr><td width=10% bgcolor="<?=$col[$j]?>" style="font-family: Arial; font-size: 11px;"><?=ucfirst(strftime('%B %d',$row->time))?></td>
				<?}?>
		<td  width=90% bgcolor="<?=$col[$j]?>" style="font-family: Arial; font-size: 11px;"><a href="<?=base_url().'blackberries/read/'.$row->id.'/1/Noticias'?>" style="color:black; text-decoration:underline;"><?=$row->title?></a></td></tr>
	<?$i++;
	  endforeach;?>
	  <tr><td width=10% style="font-family: Arial; font-weight: bold; font-size: 11px; padding-left: 8px;"><a href="<?=base_url().'blackberries/more/9/1'?>" style="color:black; text-decoration:underline;">M&aacute;s Noticias</a></td><td width=90%></td></tr>
</table>