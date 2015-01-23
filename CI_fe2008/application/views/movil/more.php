<table class="news">
	<?$i=1;
	  foreach($stories as $row):?>
		<tr>
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" <?if($i!=1) echo 'class="special"';?> width="60" rowspan=2>
				<img src="<?=base_url().$row->thumb3?>" width="50px" height="50px" border="0" style="margin:2px;"/>
			</th>
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" <?if($i!=1) echo 'class="special"';?>>
				<span class="title"><a href='<?=base_url().'moviles/read/'.$row->id.'/'.$section?>'><?=$row->title?></a></span>
				<?if(mdate('%Y-%m-%d',time())==(mdate('%Y-%m-%d',$row->time))){?>
				<span class="date">(<?=ucfirst(strftime('%B %d %H:%M',$row->time))?>)</span>
				<?}else{?>
				<span class="date">(<?=ucfirst(strftime('%B %d',$row->time))?>)</span>
				<?}?>
			</th>
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" <?if($i!=1) echo 'class="special"';?> width="35" style="text-align: right;" rowspan=2>
				<img src="<?=base_url()?>imagenes/template/movil/iPhoneArrow.png" border="0"/>
			</th>
		</tr>
		<tr>		
			<th onclick="window.location.href='<?=base_url()?>moviles/read/<?=$row->id.'/'.$section?>'" >
				<span class="subtitle"><?=$row->subtitle?></span>
			</th>
		</tr>
	<?$i+=1;
	  endforeach;?>	
</table>