<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
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
				echo '<table width="100%" style="border:1px solid black; -webkit-border-radius: 7px; -moz-border-radius: 7px; border-radius: 7px;"><tr>
					  <td width="100%">
					  <table width="100%"><tr><td style="border-bottom:1px solid black;">'.$gmatch[$j][$i][0]['home'].'</td></tr>
					  <tr><td>'.$gmatch[$j][$i][0]['away'].'</td></tr></table></td>';
						
				if($gmatch[$j][$i][0]['result']!=''){
					$aux=explode('-',$gmatch[$j][$i][0]['result']);
					echo '<td bgcolor="#c2c2c2" width="10%"><table><tr><td style="border-bottom:1px solid black;">'.$aux[0].'</td></tr><tr><td>'.$aux[1].'</td></tr></table></td>';
				}
				if(isset($gmatch[$j][$i][1])){
					if($gmatch[$j][$i][1]['result']!=''){
						$aux=explode('-',$gmatch[$j][$i][1]['result']);
						echo '<td  bgcolor="#7f7f7f" width="10%" style="-webkit-border-top-right-radius: 7px; -webkit-border-bottom-right-radius: 7px; -moz-border-radius-topright: 7px; -moz-border-radius-bottomright: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px;"><table><tr><td style="border-bottom:1px solid black;">'.$aux[1].'</td></tr><tr><td>'.$aux[0].'</td></tr></table></td>';
					}
				}
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
						  <tr><td width="800%">'.$lmatch[$j][$i][0]['home'].'<br/>
						 '.$lmatch[$j][$i][0]['away'].'</td>';
							
					if($lmatch[$j][$i][0]['result']!=''){
						$aux=explode('-',$lmatch[$j][$i][0]['result']);
						echo '<td>'.$aux[0].'<br/>'.$aux[1].'</td>';
					}
					if(isset($lmatch[$j][$i][1])){
						if($lmatch[$j][$i][1]['result']!=''){
							$aux=explode('-',$lmatch[$j][$i][1]['result']);
							echo '<td>'.$aux[1].'<br/>'.$aux[0].'</td>';
						}
					}
					echo '</tr></table></td>';	
				}
			}
			echo '</tr>';
		}
		echo '</table>';
	}
?>
</body>
</html>