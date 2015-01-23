<div id='modulo' style="background-color: white; margin-top: 5px; margin-bottom: 5px;">

<table style="background-color: white"  cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td colspan="2">
		<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<th>&Uacute;ltima Alineaci&oacute;n</th>
			</tr>
		</table>
	</td>
</tr>
<tr><td valign="top" width='70%'>
<div id=field  style="position:relative; margin-top: 0px; margin-left: 0px; height: 350px; background-repeat:no-repeat; background-position: top left; ">
	<img src="<?=base_url().'imagenes/lineups/cancha.jpg'?>"/>
<?php $i=3;
	  $pdef['xo']=40;
	  $pdef['xf']=254;
	  $pdef['y']=60;
	  
	  $pvol['xo']=40;
	  $pvol['xf']=254;
	  $pvol['y']=130;
	  
	  $pdel['xo']=80;
	  $pdel['xf']=214;
	  $pdel['y']=220;
	  
	  $defe=count($def);
	  $vola=count($vol);
	  $dela=count($del);

	  $udef=$defe;
	  $uvol=$vola;
	  $udel=$dela;
	  
	  $aux=0
	  
	  ?>
	  
	
	<!-- Arquero -->
	
	<div id=down style="position: absolute; top:  10px; left: 147px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 20px; left: 165px; border: 0px ; color:black;">1</div>
	
	<!-- Defensas -->
	
	<?if($defe>2){?>
	<div id=down style="position: absolute; top: 80px; left: 40px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 90px; left: 58px; border: 0px ; color:black;">2</div>
	
	
	<?$num=$defe+1?>
	<div id=down style="position: absolute; top: 80px; left: 254px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 90px; left: 272px; border: 0px ; color:black;"><?=$num?></div>
			
	<?$udef=$defe-2;
	  }
	  $aux=($pdef['xf']-$pdef['xo'])/($udef+1);
	  for($i=1; $i<=$udef; $i++){?>
	  	<?$num=$i+2;?>
	  	<div id=down style="position: absolute; top: 60px; left: <?=40+($aux*$i)?>px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
		</div>
		<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 70px; left: <?=40+($aux*$i)+19?>px; border: 0px ; color:black;"><?=$num?></div>
	<?}?>
	
	
	<!-- Volantes -->
	<?$aux2=0;
	  if($vola>2){?>
	<?$num=$defe+2?>
	<?if($num>9) $aux2=12; else $aux2=17;?>
	<div id=down style="position: absolute; top: 160px; left: 40px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 170px; left: <?=41+$aux2?>px; border: 0px ; color:black;"><?=$num?></div>
	<?$num=$defe+$vola+1?>
	<?if($num>9) $aux2=12; else $aux2=17;?>
	<div id=down style="position: absolute; top: 160px; left: 254px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 170px; left: <?=255+$aux2?>px; border: 0px ; color:black;"><?=$num?></div>
	
	<?$uvol=$vola-2;
	  }
	  $aux=($pvol['xf']-$pvol['xo'])/($uvol+1);
	  for($i=1; $i<=$uvol; $i++){?>
	  	<?$num=$defe+2+$i?>
	  	<?if($num>9) $aux2=12; else $aux2=17;?>
	  	<div id=down style="position: absolute; top: 130px; left: <?=40+($aux*$i)?>px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
		</div>
		<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 140px; left: <?=41+($aux*$i)+$aux2?>px; border: 0px ; color:black;"><?=$num?></div>
	<?}?>
	
	
	<!-- Delantera -->
	<?if($dela>=2){?>
	<?$num=$defe+$vola+2?>
	  	<?if($num>9) $aux2=12; else $aux2=17;?>
	<div id=down style="position: absolute; top: 225px; left: 80px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 235px; left: <?=81+$aux2?>px; border: 0px ; color:black;"><?=$num?></div>
	<?$num=$defe+$vola+$dela+1?>
	  	<?if($num>9) $aux2=12; else $aux2=17;?>
	<div id=down style="position: absolute; top: 225px; left: 214px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
	</div>
	<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 235px; left: <?=215+$aux2?>px; border: 0px ; color:black;"><?=$num?></div>
	
	
	<?$num=$defe+$vola+2;
	  $udel=$dela-2;
	  }
	  else{
	  	$num=$num=$defe+$vola+1;
	  }
	  $aux=($pdel['xf']-$pdel['xo'])/($udel+1);
	  for($i=1; $i<=$udel; $i++){?>
	  	<?$num+=$i?>
	  	<?if($num>9) $aux2=12; else $aux2=17;?>
	  	<div id=down style="position: absolute; top: 210px; left: <?=80+($aux*$i)?>px; border: 0px ; color:white;">
			<img src="<?=base_url().$shirt?>"/>
		</div>
		<div id=down style="font-size: 13px; font-weight: bold; position: absolute; top: 220px; left: <?=81+($aux*$i)+$aux2?>px; border: 0px ; color:black;"><?=$num?></div>
	<?}?>
	
</div>
</td>
<td valign="top">
<table style="font-family: arial; font-size: 13px; margin-top: 5px;" id="alineacion" width='100%'>
	<tr><td colspan="2" style='background-color: #BBBBBB;color: white;' ><b>Titulares</b></td></tr>
	<tr><td>1</td><td><?=$arq['name']?></td></tr>
	<?$i=2;
	foreach($def as $row):
		echo '<tr><td>'.$i.'</td><td>'.$row['name'].'</td></tr>';	
		$i+=1;
	endforeach;
	foreach($vol as $row):
		echo '<tr><td>'.$i.'</td><td>'.$row['name'].'</td></tr>';	
		$i+=1;
		endforeach;
	foreach($del as $row):
		echo '<tr><td>'.$i.'</td><td>'.$row['name'].'</td></tr>';	
		$i+=1;
	endforeach;
	?>
</table>
</td></tr>
<?if($sup!=""){?>
<tr>
	<td colspan="2">
		<?
			echo '<table style="font-family: arial; font-size: 14px;">
					<tr>
						<td valign="top">
							<b>Suplentes: </b>
						</td><td>';
			
			$j=0;
			
			
			foreach($sup as $row):
				if($j==1)
				echo ', ';
				echo $row['name'];
				$j=1;	
			endforeach;
			
			echo '</td></tr></table>'
		?>
	</td>
</tr>
<?}?>
</table>
</div>

<div id='modulo'>
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Noticias</th>
</tr>
</table>
</div>

	
