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
 <?php 
 	if($query != false){
 	foreach($query->result() as $row): 
		if($champ!=$row->cn){
		 	if($tcheck!=0){
				echo '</table>';
			  	echo '</div></div></div></div><br>';
		 	}
	       	echo '<div class="titlecal" style="margin: 10px;">';
	 		echo '<div class="titlecal">';
	 		echo '<div class="titlecal">';
		  	echo '<div class="titles"></div>';
	 		echo '<div class="titlef"><table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
	 		$champ=$row->cn;
		  	$round=$row->rn;
		  	$group=$row->gn; 
		  	$sn=$row->sn;
		  	echo '<table id="fecha" style="width:100%;"  class="fecha">';
		  	$tcheck=1;
	 	}
	 	if($round!=$row->rn){
		    if($tcheck!=0){
		  		echo '</table>';
		  		echo '</div></div></div>';
		  	}
	 	   	echo '<div class="titlecal">';
	 		echo '<div class="titlecal">';
		  	echo '<div class="titles"></div>';
	 		echo '<div class="titlef"><table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
		  	$round=$row->rn;
		  	$group=$row->gn; 
		  	$sn=$row->sn;
		  	echo '<table  id="fecha" cellpadding="2" cellspacing="0"  class="fecha" width="300">';
		  	$tcheck=1;
	 	}
	 	if($group!=$row->gn){
		  	if($tcheck!=0){
		  		echo '</table>';
		  		echo '</div></div>';
	 	   	}
	 		echo '<div class="titlecal">';
		  	echo '<div class="titles"></div>';
	 		echo '<div class="titlef"><table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
		  	$group=$row->gn; 
		  	$sn=$row->sn;
		  	echo '<table  id="fecha"   cellpadding="2" cellspacing="0"  class="fecha" width="300">';
		  	$tcheck=1;
	 	}
	 	if($sn!=$row->sn){
		    if($tcheck!=0){
		  		echo '</table>';
		  		echo '</div>';
		  	}
		  	echo '<div class="titles"></div>';
	 		echo '<div class="titlef"><table><tr><td>Fecha '.$row->sn.'</td></tr></table>';
		  	$sn=$row->sn;
		  	echo '<table  id="fecha" cellpadding="2" cellspacing="0" class="fecha" width="300">';
		  	$tcheck=1;
	 	}
	 	if($row->result=="")
	 		$row->result="0 - 0";
?>	 	
			<tr>
			 	<th width="40%" class="matchl" ><?=$row->hname?></th>	
				<th width="10%" class="goals"><?=substr($row->result,0,1)?></th>
				<th width="10%" class="goals"><?=substr($row->result,4,1)?></th>	
				<th width="40%" class="matchr" ><?=$row->aname?></th>
			 </tr>
			 <tr>
			 	<th width="50%" class="datel"  colspan=2><?=strftime('%Y-%m-%d %H:%M',$row->dm)?></th>
			 	<th width="50%" class="dater"  colspan=2><?=$tiempo[$row->state]?></th>
			 </tr>

<?php  endforeach;
 		}
	   if($tcheck!=0){
	 		echo '</table></div></div></div></div>';
	   }
	   else
	 	   	echo '<div style="font-size:16px;width:98%;margin:0 auto;color:#01416F;text-align:center;">No existen partidos hoy</div>';
?>