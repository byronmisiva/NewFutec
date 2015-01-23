<?php $x=0;?>
<table class="news">
	<?foreach($stories as $row):
		if ($x==1){	?>
		<tr>
			<td colspan="3" style="text-align: center;height: auto;">			
				<!-- FE_SMART_TOP -->
				<div id='div-gpt-ad-1383593619381-4' style='width:320px; display: inline-block;'>
				<script type='text/javascript'>
				googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383593619381-4'); });
				</script>
				</div>
			</td>
		</tr>	
		<?php }?>
		<tr>
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" class="special" width="60" rowspan=2 style="vertical-align: top;">
				<img src="<?=base_url().$row->thumb3?>" width="50px" height="50px" border="0" style="margin:2px;"/>
			</th>
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" class="special">
				<span class="title"><a href='<?=base_url().'moviles/read/'.$row->id.'/'.$section?>'><?=$row->title?></a></span>
				<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->time))){?>
				<span class="date">(<?=ucfirst(strftime('%B %d %H:%M',$row->time))?>)</span>
				<?}else{?>
				<span class="date">(<?=ucfirst(strftime('%B %d',$row->time))?>)</span>
				<?}?>
			</th>
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" width="35" rowspan=2 style="text-align: right;"  class="special">
				<img src="<?=base_url()?>imagenes/template/movil/iPhoneArrow.png" border="0"/>
			</th>
		</tr>
		
		<tr>
			<td onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'">
				<span class="subtitle"><?=$row->subtitle?></span>
			</td>
		</tr>
	<?
	$x++;
	endforeach;?>	
</table>