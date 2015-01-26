<br/>
<?$col[0]="#FFFFFF";
  $col[1]="#F3F3F3";
  $i=0;	 
  $j=0;?>
<table width=100% cellpadding="0" cellspacing="0" >
	<?$i=1;
	  foreach($stories as $row):
	    if($i%2==0){$j=0;}else{$j=1;}?>
		<tr>
			<td width=10% bgcolor="<?=$col[$j]?>" style="font-family: Arial; font-size: 11px; padding-left: 5px">
				<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->time))){?>
				<?=strftime('%B %d %H:%M',$row->time)?>
				<?}else{?>
				<?=strftime('%B %d',$row->time)?>
				<?}?>
			</td>
			<td width=80% bgcolor="<?=$col[$j]?>" style="font-family: Arial; font-size: 11px;"><a href='<?=base_url().'blackberries/read/'.$row->id.'/'.$section?>' style='color:black; text-decoration:underline;'><?=$row->title?></a></td>
		</tr>
	<?$i+=1;
	  endforeach;?>	
</table>
<br/>




