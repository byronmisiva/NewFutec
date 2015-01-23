<?php
	$col=count($gmatch);
	$row=count($gmatch[$col-1]);
	echo '<table cellspacing="2">';
	for($i=0;$i<$row;$i++){
		echo '<tr>';
		for($j=$col-1;$j>=0;$j--){
			if(isset($gmatch[$j][$i][0]['id'])){
				if($j!=$col-1){
					echo '<td rowspan="'.pow(2,$col-$j-1).'">';
					echo '<table cellpadding="0" cellspacing="0" width=100% height=100%>
							<tr><td  width=15px style="border-top:1px solid black;"><br/><br/></td><td width=15px style="border-left:1px solid black; border-bottom:1px solid black;"><br/></td></tr>
							<tr><td  width=15px style="border-bottom:1px solid black;"><br/><br/></td><td style="border-left:1px solid black;"><br/></td></tr>
						  </table>';
					echo '</td>';
				}
				echo '<td rowspan="'.pow(2,$col-$j-1).'">';
				echo '<table width="100%" style="border:1px solid black;"><tr>
					  <td width="100%"><span style="color:red;">'.$gmatch[$j][$i][0]['id'].'</span> '.$gmatch[$j][$i][0]['home'].' - '.$gmatch[$j][$i][0]['away'].'</td>';
				echo '</tr></table></td>';	
			}
		}
		echo '</tr>';
	}
	echo '</table></br></br>';
	
	if($lmatch!=''){
		$col=count($lmatch);
		$row=count($lmatch[$col-1]);
		echo '<table cellspacing="20">';
		for($i=0;$i<$row;$i++){
			echo '<tr>';
			for($j=$col-1;$j>=0;$j--){
				if(isset($lmatch[$j][$i][0]['id'])){
					echo '<td rowspan="'.pow(2,$col-$j-1).'">';
					echo '<table>
						  <tr><td width="800%">'.$lmatch[$j][$i][0]['th'].'<br/>
						 '.$lmatch[$j][$i][0]['ta'].'</td>';
					echo '</tr></table></td>';	
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}
?>