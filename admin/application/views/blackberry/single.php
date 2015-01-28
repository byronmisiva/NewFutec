<?
$color[0]="#F3F3F3";
$color[1]="#FFFFFF";
?>
<br>
<center>
<table width=100% style="font-family:Arial; font-size:11px;" cellpadding=0 cellspacing=0>
	<tr><td bgcolor="#F3F3F3"  style="padding-left: 5px" width=70%><?=$matches['home']['name']?></td><td bgcolor="#F3F3F3"  style="padding-left: 5px" width=30%><?=$matches['home']['result']?></td></tr>
	<tr><td style="padding-left: 5px" width=70%><?=$matches['away']['name']?></td><td  style="padding-left: 5px" width=30%><?=$matches['away']['result']?></td></tr>
	<tr><td bgcolor="#F3F3F3"  style="padding-left: 5px; font-weight:bold;" width=70%><?=$matches['tiempo'].'  -  '.$matches['minuto']."'"?></td><td bgcolor="#F3F3F3"  style="padding-left: 5px" width=30%></td></tr>
</table>
<br/>	
<br/>	
<br/>
<?if($matches['actions']!=FALSE){?>
	<table width=100% style="font-family:Arial; font-size:11px;" cellpadding=0 cellspacing=0>
		<?$i=1;
		  $j=0;
		  foreach($matches['actions'] as $row):
		  if($i%2==0){$j=1;}else{$j=0;}?>
			<tr><td width=10% bgcolor="<?=$color[$j]?>" style="text-align:right; padding-left: 5px" width=2%><?if($row['match_time']<=120) echo $row['match_time'].'\''?></td><td width=98% bgcolor="<?=$color[$j]?>" style="padding-left: 10px" ><?=$row['action']?></td></tr>
	    <?$i+=1;
	      endforeach;?>
	    <tr><td><br/><td></tr>
    </table>
<?}?>
</center>
<br/>


