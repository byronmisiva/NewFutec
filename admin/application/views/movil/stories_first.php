<table class="news">	
	<tr>
		<?foreach($stories as $row):?>
			<td onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" width="125" rowspan=3 >
				<img src="<?=base_url().$row->thumb1?>" width="120px" height="120px" border="0"/>
			</td>
			<td onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'">
				<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->time))){?>
				<span class="date"><?=ucfirst(strftime('%B %d %H:%M',$row->time))?></span>
				<?}else{?>
				<span class="date"><?=ucfirst(strftime('%B %d',$row->time))?></span>
				<?}?>
			</td>
			<td onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" width="35" rowspan=3 style="text-align: right;">
				<img src="<?=base_url()?>imagenes/template/movil/iPhoneArrow.png" width="25px" height="20px" border="0"/>
			</td>
		</tr>
		<tr>
			<td onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'">
				<span class="title_first"><a href='<?=base_url().'moviles/read/'.$row->id.'/'.$section?>'><?=$row->title?></a></span>
			</td>
		</tr>
		<tr>
			<td onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'">
				<span class="subtitle"><?=$row->subtitle?></span>
			</td>
		<?endforeach;?>
	</tr>
	 <tr>
		<td colspan="3" style="text-align: center;">			
			<!-- FE_SMART_TOP 
			<div id='div-gpt-ad-1383593619381-4' style='width:320px; display: inline-block;'>
			<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-4'); });
			</script>
			</div>-->
		</td>
	</tr> 
</table>