<div id="modulo">
<table class="titulo" width=100% cellpadding="0" cellspacing="0" >
	<tr>
		<th><?=$title?></th>
	</tr>
</table>
</div>

<div style='width:100%;position:relative;height:120px;'>
	<div id='contenedor' style='position:relative;width:410px; padding-left:60px; padding-right:45px; margin-top:2px; margin-left:1px;'>
	<?php
	$i=0;
 	$max=count($feeds);
    foreach($feeds as $row){
    	if($i>4)
    		$display='display:none;';
    ?>
    <div id='live_<?=$i?>' style='float:left; margin:3px; <?=$display?>' onMouseOver="live_title('<?=$row['title']?>');">
	<a href='<?=$row['expand']?>' rel="lightbox[live]" title="<?=$row['title']?>">
		<img src="<?=$row['pics']?>" border='0'/>
	</a>
	</div>
	<?php
    	
	$i+=1;
    }
    $display="";
	if($max<5)
		$display='display:none';
    ?>
	</div>
	<div id='flecha_iz' style='position:absolute;top:20px;left:10px;display:none;' onClick="live_less('<?=$max;?>'); return false;"><img src="<?=base_url().'imagenes/twitter/flecha_iz_over.jpg'?>"/></div>
	<div id='flecha_de' style='position:absolute;top:20px;right:10px;<?=$display;?>' onClick="live_more('<?=$max;?>'); return false;"><img src="<?=base_url().'imagenes/twitter/flecha_de_over.jpg'?>"/></div>
	<div id='titulo_live' style='position:absolute;top:80px;width:510px;height:40px; padding-top:8px; text-align: center;'></div>
</div>
