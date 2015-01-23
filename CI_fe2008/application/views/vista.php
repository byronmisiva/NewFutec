<?php $new=$query;
//var_dump($new)?>
<div id='rota'>
<div id=contenttot  style="background-image: url(<?=site_url($new[$check]->thumb500)?>); margin-top: 5px; margin-left: 5px; width:560px; height: 277px; background-repeat:no-repeat; background-position: top right; ">
	<div id=left style="float:left; padding-left:3px ">
		<a id='0' href="" onClick="change_news('<?=base_url();?>stories/vista_rotativa','0','<?=base_url();?>'); parar('0'); return false;" ><img src="<?=base_url().$new[0]->thumbh50?>" <?if($check==0){?>style="margin-top: 1px; margin-left: 1px; border: 2px solid white;"<?}else{?>style="border: 1px solid black;"<?}?> border='0' alt=''></a><br>
		<a id='1' href="" onClick="change_news('<?=base_url();?>stories/vista_rotativa','1','<?=base_url();?>'); parar('1'); return false;" ><img src="<?=base_url().$new[1]->thumbh50?>" <?if($check==1){?>style="margin: 1px; border: 2px solid white;"<?}else{?>style="margin: 2px; border: 1px solid black;"<?}?> border='0' alt=''></a><br>
		<a id='2' href="" onClick="change_news('<?=base_url();?>stories/vista_rotativa','2','<?=base_url();?>'); parar('2'); return false;" ><img src="<?=base_url().$new[2]->thumbh50?>" <?if($check==2){?>style="margin: 1px; border: 2px solid white;"<?}else{?>style="margin: 2px; border: 1px solid black;"<?}?> border='0' alt=''></a><br>
		<a id='3' href="" onClick="change_news('<?=base_url();?>stories/vista_rotativa','3','<?=base_url();?>'); parar('3'); return false;" ><img src="<?=base_url().$new[3]->thumbh50?>" <?if($check==3){?>style="margin: 1px; border: 2px solid white;"<?}else{?>style="margin: 2px; border: 1px solid black;"<?}?> border='0' alt=''></a><br>
		<a id='4' href="" onClick="change_news('<?=base_url();?>stories/vista_rotativa','4','<?=base_url();?>'); parar('4'); return false;" ><img src="<?=base_url().$new[4]->thumbh50?>" <?if($check==4){?>style="margin: 1px; border: 2px solid white;"<?}else{?>style="margin: 2px; border: 1px solid black;"<?}?> border='0' alt=''></a><br>
	</div>
	<div onClick='window.location = "<?=base_url().'stories/publica/'.$new[$check]->sid;?>";' style="float: right; width: 498px; border: 1px solid black; cursor: pointer;" >
	<div id=down style="float: right; margin-top: 215px; width: 497px; height:58px; border: 1px solid black; background: black; filter:alpha(opacity=70); opacity: .7;">
		<div style="color:#FFFFFF; padding-top: 5px; padding-left: 8px; font-family: arial;">	
			<b><?=$new[$check]->title;?></b>
			<br>
			<i style="padding-top: 10px; font-size: 13px;"><?=$new[$check]->subtitle;?></i>
		</div>
	</div>
	</div>
</div>
</div>
<script type="text/javascript">
var next=0;
var espera=10;
var rotativo;
inicio();

function cambiar(){
	if(next==4)
		next=0;
	else
		next=next+1;
	change_news('<?=base_url();?>stories/vista_rotativa',next,'<?=base_url();?>');
}
</script>