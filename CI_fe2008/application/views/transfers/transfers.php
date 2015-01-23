<?
$flh[2]=base_url().'imagenes/icons/llega.png';
$flh[1]=base_url().'imagenes/icons/se_va.png'; 
$num=count($teams);
?>
<center>
	<div style="width:510px; border: 1px solid black; background: black; ">
			<table width="510px" cellpadding=0 cellspacing=0>
				<?$i=0;
				  $j=0;
				  foreach($teams as $row):
				  	$off='opacity:0.4;filter:alpha(opacity=40);';
				  	if($i==0){?>
				 	<tr>
				 	<?}?>
				 	<td><center>
				 	<?if(is_array($row['transfer'])){
				 			$off='';
				 			echo '<div id="s_'.$j.'" onClick="transfers_appear(\'t_'.$j.'\','.$num.');" style="cursor: pointer;">';
				 	  }
				 	  else{
				 	  		
				 	  	echo '<div>'; 
				 	  }?>
				 		<img border=0 style="<?=$off?>" src="<?=base_url().$row['shield2']?>"/></div></center></td>
				 	<?$i+=1;
				 	  $j++;
				 	if($i==6){?>
				 	</tr>
				 	<?$i=0;}?>
				<?endforeach;?>
			</table>
			<br/>
			<br/>
		<?$i=0;
		 foreach($teams as $row):
			$id=$row['id'];
			if($i==0)
				echo '<center><div id="t_'.$i.'"><table width="300px" cellpadding=0 cellspacing=0>';
			else
				echo '<center><div id="t_'.$i.'" style="display:none"><table width="300px" cellpadding=0 cellspacing=0>';
			
			if(is_array($row['transfer'])){	
				echo '<tr><td colspan=3 style="color:white; text-align:center;">'.$row['name'].'</td></tr>';
				echo '<tr><td><br/></td></tr>';
					
				foreach($row['transfer'] as $trans):
			 		if($id==$trans['from_id']){
			 			echo '<tr><td width=55% style="color:white;">'.$trans['player'].'</td><td width=20% style="font-size:10px; color:white; text-align:center;"><img src="'.$flh[$trans['if']].'"/><br/>'.$trans['status'].'</td><td width=25% style="text-align:right;"><img src="'.base_url().$trans['to_ms'].'"/></td></tr>';
				 	} 
				 	else{
						echo '<tr><td width=55% style="color:white;">'.$trans['player'].'</td><td width=20% style="font-size:10px; color:white; text-align:center;"><img src="'.$flh[$trans['if']].'"/><br/>'.$trans['status'].'</td><td width=25% style="text-align:right;"><img src="'.base_url().$trans['from_ms'].'"/></td></tr>';
			 		}
			 	endforeach;
			}
			
			echo '</table></div></center>';
			$i++;
		  endforeach;?>	
	</div>
</center>