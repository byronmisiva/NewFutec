<div id='rotativas'>
	<div id='left'>
	<?php foreach($query as $key=>$row):
			if($key==$check)
				$class="class='selected'";
			else
				$class=""
	?>
		<div id='mn_<?=$key?>' <?=$class?> onClick="rotativa_appear('content_<?=$key?>');"><img src="<?=base_url().$row->thumbh50?>" border='0' alt='<?=$row->name;?>' title='<?=$row->title;?>'></div>


    <?php endforeach;?>
	</div>
	
	<?php foreach($query as $key=>$row):
			if($key==$check)
				$style="";
			else
				$style="display:none;";

			if($row->sponsored)
				$link=$row->link;
			else
				$link=base_url().'stories/publica/'.$row->sid;
	?>
	
	<div  onClick='window.location = "<?=$link;?>";' id='content_<?=$key?>'  style="<?=$style?>background-image: url(<?=site_url($row->thumb500)?>); position:absolute;top:0px;right:0px;width:510px; height: 277px; background-repeat:no-repeat; background-position: top left;cursor: pointer; background-size: cover;">
		<div style="float: right; width: 509px; border: 1px solid black;" >
			<div id=down style="float: right; margin-top: 217px; width: 100%; height:58px; background: black; filter:alpha(opacity=70); opacity: .8;"></div>
			<div style="position:absolute; top:218px; left:0px; width: 100%; height:55px; color:#FFFFFF; padding: 5px; font-family: arial;font-size:16px;">	
				<div style='font-weight:bold;'><?=$row->title;?></div>
				<div style="padding-top: 10px; font-size: 13px;"><?=$row->subtitle;?></div>
			</div>
			<?php if($row->sponsored){ ?>
			<div style="position:absolute; top:5px; right:5px;">	
				<img src="<?=base_url();?>imagenes/auspicio_rotativa.png" border="0" />
			</div>
			
			<?php } ?>
		</div>
		<div style="position:absolute; top:0px; left:0px;">
			<img src='<?=base_url();?>imagenes/protect.gif' width='500' height='277'>
		</div>
	</div>
	
	<?php endforeach;?>
	
</div>