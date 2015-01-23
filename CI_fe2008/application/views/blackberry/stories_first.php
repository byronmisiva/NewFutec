<table width=100% align="center">
		<?foreach($stories as $row):?>
			<tr><td align="center" style="font-family: Arial; font-weight:bold; font-size: 12px;"><?=$row->title?></td></tr>
			<tr><td align="center"><img src="<?=base_url().$row->thumb1?>" border="0"/></td></tr>
			
			<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->time))){?>
				<tr><td align="center" style="font-family: Arial; font-size: 11px;"><?=ucfirst(strftime('%B %d %H:%M',$row->time))?></td></tr>
				<?}else{?>
				<tr><td align="center" style="font-family: Arial; font-weight:bold; font-size: 11px;"><?=ucfirst(strftime('%B %d',$row->time))?></td></tr>
				<?}?>
			
			<tr><td align="center" style="font-family: Arial; font-weight:bold; font-size: 12px;"><a href="<?=base_url().'blackberries/read/'.$row->id.'/1/Noticias'?>" style="color:black; text-decoration:underline;"><?=$row->subtitle?></a></td></tr>
		<?endforeach;?>
</table>