<center>
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
	$tcheck=0;
?>
<br/>
 <?php 
 	foreach($query->result() as $row): 
		if($champ!=$row->cn){
		 	if($tcheck!=0){
				echo '</table>';
			  	echo '<br>';
		 	}
	 		echo '<table width=100%><tr><td align="left" style=" font-family:Arial; font-weight:bold; font-size:11px; ">Fecha '.$row->sn.'</td></tr></table>';
	 		$champ=$row->cn;
		  	$round=$row->rn;
		  	$group=$row->gn; 
		  	$sn=$row->sn;
		  	echo '<table width=100% cellpadding=0 cellspacing=0>';
		  	$tcheck=1;
	 	}
	 	if($round!=$row->rn){
		    if($tcheck!=0){
		  		echo '</table>';
		  	}
	 		echo '<table width=100%><tr><td></td></tr></table>';
		  	$round=$row->rn;
		  	$group=$row->gn; 
		  	$sn=$row->sn;
		  	echo '<table width=100% cellpadding=0 cellspacing=0>';
		  	$tcheck=1;
	 	}
	 	if($group!=$row->gn){
		  	if($tcheck!=0){
		  		echo '</table>';
	 	   	}
	 		echo '<table width=100%><tr><td></td></tr></table>';
		  	$group=$row->gn; 
		  	$sn=$row->sn;
		  	echo '<table width=100% cellpadding=0 cellspacing=0>';
		  	$tcheck=1;
	 	}
	 	if($sn!=$row->sn){
		    if($tcheck!=0){
		  		echo '</table>';
		  	}
	 		echo '<table width=100% cellpadding=0 callspacing=0><tr><td></td></tr></table>';
		  	$sn=$row->sn;
		  	echo '<table width=100% cellpadding=0 cellspacing=0>';
		  	$tcheck=1;
	 	}
?>	 	
			 <tr>
			 	<td bgcolor="#F3F3F3" width="60%" style="font-family:Arial; font-size:11px;"><?=$row->hname?></td>	
				<td bgcolor="#F3F3F3" width="40" style="font-family:Arial; font-size:11px; padding-left:10px;"><?=substr($row->result,0,1)?></td>
			 </tr>
			 <tr>
				<td bgcolor="#FFFFFF" width="60%" style="font-family:Arial; font-size:11px;"><?=$row->aname?></td>
				<td bgcolor="#FFFFFF" width="40%" style="font-family:Arial; font-size:11px; padding-left:10px;"><?=substr($row->result,4,1)?></td>	
			 </tr>
			 <tr>
			 	<td bgcolor="#F3F3F3" width="60%" style="font-family:Arial; font-weight:bold; font-size:11px;"><?=strftime('%Y-%m-%d %H:%M',$row->dm)?></td>
			 	<td bgcolor="#F3F3F3" width="40%" style="font-family:Arial; font-weight:bold; font-size:11px; padding-left:10px;"><?=$tiempo[$row->state]?></td>
			 </tr>
			<tr>
				<td width="60%" height=11px style="font-family:Arial; font-weight:bold; font-size:6px;"></td>
				<td width="40%" height=11px style="font-family:Arial; font-weight:bold; font-size:6px;"></td>
			</tr>

<?php  endforeach;
	   if($tcheck!=0){
	 		echo '</table>';
	   }
	   else
	 	   	echo '<span style="font-family:Arial; font-size:11px; padding-left:10px;">No existen partidos</span>';
?>
</center>
