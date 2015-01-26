<div>
<?php 
  $change[0]=base_url().'imagenes/icons/flecha_arriba.png';
  $change[1]=base_url().'imagenes/icons/igual.png';
  $change[2]=base_url().'imagenes/icons/flecha_abajo.png';

  if(count($groups)>1){
	echo '<ul id="groups_tabs" class="subsection_tabs">';
	$i=0;
	foreach($groups as $row){
		if($active==$row->id)
			$css='tab_active';
		else
			$css='tab';
		
		echo "\n<li class='$css'><a href='javascript:get_tabla_posiciones(\"tabla\",\"".base_url()."teams_positions/table_positions/".$row->id."\");' name='1'>$row->name</a></li>";
	}
	echo '</ul>';
  }
 ?>
 </div>
 <div style='margin-top:3px;'>
<table class="tabla_posiciones" cellpadding="0" cellspacing="0">
		<tr>
			
			<th colspan='3' style='padding-left: 10px;'>Equipo</th>
			<th>PJ</th>
			<th>PG</th>
			<th>PE</th>
			<th>PP</th>
			<th>Pts</th>
			<th>GD</th>
		</tr>
		<?php 
		$i=false;
		$num=1;
		$sign='';
		foreach($tabla as $row){
			if($i==true){
				$class='class="altrow"';
				$i=false;
			}
			else{
				$class='';
				$i=true;
			}
			if($row['gd']>0)
				$sign='+';
			else
				$sign='';
			if($row['updown']==0)
				$row['updown']='';
			
			echo "<tr $class>\n";
			echo "<td class='data' width='15px'>".$num.".</td>\n";
			if(isset($teams[$row['id']]))
				echo "<td class='name'>".anchor('sections/publica/'.$row['section'],$row['name'])."</a></td>\n";
			else
				echo "<td class='name'>".$row['name']."</td>\n";	
			//echo "<td class='data' style='text-align:left;'><img src='".$change[$row['change']]."'/>".' '.$row['updown']."</td>\n";
			echo '<td align="center">
					<div style="width:25px; height: 20px;">
						<div style="position: absolute;">
							<img src="'.$change[$row['change']].'" width="20" height="20">
						</div>
						<div id=down style="position: relative; font-size: 11px; top: 5px; right: 2px; line-height:11px; padding:0px; color:white; width:5px;">
							'.$row['updown'].'
						</div>
					</div>
				  </td>';
			
			
			echo "<td class='data'>".$row['pj']."</td>\n";
			echo "<td class='data'>".$row['pg']."</td>\n";
			echo "<td class='data'>".$row['pe']."</td>\n";
			echo "<td class='data'>".$row['pp']."</td>\n";
			echo "<td class='data'>".$row['points']."</td>\n";
			echo "<td class='data'>".$sign.$row['gd']."</td>\n";
			echo "</tr>\n";
			$num++;
		}?>
	</table>
	</div>