<div id="modulo" style="width: 100%; background-color:white; font-family: arial; font-size: 14px;">
	<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th>Calendario - <?=$name?></th>
		</tr>
	</table>
	<br>
	
	<?php 
		  $champ='';
		  $round='';
		  $group=''; 
		  $sn='';
		  $tiempo['0']='No iniciado';
		  $tiempo['1']='Primer Tiempo';
		  $tiempo['2']='Fin del Primer Tiempo';
		  $tiempo['3']='Segundo Tiempo';
		  $tiempo['4']='Fin del Segundo Tiempo';
		  $tiempo['5']='Primer Tiempo Extra';
		  $tiempo['6']='Segundo Tiempo Extra';
		  $tiempo['7']='Penales';
		  $tiempo['8']='Fin del Partido'; 
		  $tcheck=0;?>
	
	
	 <?php foreach($query->result() as $row): 
	       if($champ!=$row->cn){
	 			if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div></div></div>';
	 			}
	       		echo '<div id="calendary_all">';
	 			echo '<div id="round">'.$row->rn.'<br>';//.' / '.$row->gn.'
	 			
	 			echo '<div id="name" onClick=\'menu_open("cal_'.$row->sn.'","calendar_data"); return false;\'><div style="padding-left:7px;">Fecha '.$row->sn.'</div></div>
					  <div id=\'cal_'.$row->sn.'\' class="calendar_data" style="font-size:14px;font-weight: normal; border:1px solid #BBBBBB; border-top:0px; backgrond-color:#FFFFFF;padding-top: 5px; margin-right: 5px;">';
		 		
	 			$champ=$row->cn;
		  		$round=$row->rn;
		  		$group=$row->gn; 
		  		$sn=$row->sn;
		  		echo "<table class='listing' cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"back-ground-color:#FFFFFF;\">";
		  		$tcheck=1;
	 	   }
	 	   if($round!=$row->rn){
		  		if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div></div>';
		  		}
	 	   		echo '<div id="round">'.$row->rn.' / '.$row->gn.'<br>';
	 			echo '<div id="name" onclick=\'menu_open("cal_'.$row->sn.'","calendar_data"); return false;\'><div style="padding-left:7px;">Fecha '.$row->sn.'</div></div>
					  <div id=\'cal_'.$row->sn.'\' class="calendar_data" style=\'font-size:14px;font-weight: normal; border:1px solid #BBBBBB; border-top:0px; display:none; backgrond-color:#FFFFFF; padding-top: 5px; margin-right: 5px;\'>';
		  		$round=$row->rn;
		  		$group=$row->gn; 
		  		$sn=$row->sn;
		  		echo "<table class='listing' cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
		  		$tcheck=1;
	 	   }
	 	   /*if($group!=$row->gn){
		  		if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div></div>';
	 	   		}
	 			echo '<div id="name" onclick=\'menu_open("cal_'.$row->sn.'","calendar_data"); return false;\'><div style="padding-left:7px;">Fecha '.$row->sn.'</div></div>
					  <div id=\'cal_'.$row->sn.'\' class="calendar_data" style=\'font-size:14px;font-weight: normal; border:1px solid #BBBBBB; border-top:0px; display:none; backgrond-color:#FFFFFF; padding-top: 5px; margin-right: 5px;\'>';
		  		$group=$row->gn; 
		  		$sn=$row->sn;
		  		echo "<table class='listing' cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
		  		$tcheck=1;
	 	   }*/
	 	   if($sn!=$row->sn){
		  		if($tcheck!=0){
		  			echo '</table>';
		  			echo '</div>';
		  		}
	 			echo '<div id="name" onclick=\'menu_open("cal_'.$row->sn.'","calendar_data"); return false;\'><div style="padding-left:7px;">Fecha '.$row->sn.'</div></div>
					  <div id=\'cal_'.$row->sn.'\' class="calendar_data" style=\'font-size:14px;font-weight: normal; border:1px solid #BBBBBB; border-top:0px; display:none; backgrond-color:#FFFFFF; padding-top: 5px; margin-right: 5px;\'>';
		  		$sn=$row->sn;
		  		echo "<table class='listing' cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">";
		  		$tcheck=1;
	 	   }?>
	 		
	 		
	 		<tr>
	 			<td colspan="6" align="center"><?=$tiempo[$row->state]?></td>
	 		</tr>
	 		<tr>
	 			<td width="15%" align="left"><?="<img src=\"".base_url().$teams['shield'][$row->hid]."\"/>"?></td>
	 			<td width="25%" align="center"><?=$row->hname?></td>
	 			<?if($row->state!=0){?>
	 			<td width="10%" align="center"  style="background-color:#CCCCCC; font-family: arial; font-size: 28px; border:3px solid white; -moz-border-radius: 10px; -webkit-border-radius: 10px;"><?=substr(trim($row->result),0,1)?></td>
	 			<td width="10%" align="center"  style="background-color:#CCCCCC; font-family: arial; font-size: 28px; border:3px solid white; -moz-border-radius: 10px; -webkit-border-radius: 10px;"><?=substr(trim($row->result),4,1)?></td>
	 			<?}else{?>
	 			<td width="20%" colspan="2" align="center"  style="font-family: arial; font-size: 20px;">VS</td>
	 			<?}?>
	 			<td width="25%" align="center"><?=$row->aname?></td>
	 			<td width="15%" align="right"><?="<img src=\"".base_url().$teams['shield2'][$row->aid]."\"/>"?></td>
	 		</tr>
	 		<tr>
	 			<td colspan="6" align="center" style="border-bottom:1px solid grey; "><?=htmlentities(ucfirst(strftime('%A %d de %B del %Y - %H:%M',$row->dm)))?></td>
	 		</tr>
	 		<tr><td> <div style='margin-bottom: 5px;'></div></td></tr>

	 <?php endforeach;
	 	   if($tcheck!=0){
	 		echo '</table></div></div></div>';
	 		}
	 	   else
	 	   	echo 'No existen partidos hoy'?>
</div>