<?php
	echo "<?xml version='1.0' standalone='yes'?>";
	$col=count($gmatch);
	$row=count($gmatch[$col-1]);
	echo '<partidos>
			<ganadores>';
	for($i=$col-1;$i>=0;$i--){
		echo '<ronda>';
		for($j=0;$j<$row;$j++){
			if(isset($gmatch[$i][$j][0]['id'])){
				echo '<partido>
						<equipo1>'.$gmatch[$i][$j][0]['home'].'</equipo1>
						<equipo2>'.$gmatch[$i][$j][0]['away'].'</equipo2>
						<result1>';
				if($gmatch[$i][$j][0]['result']!=''){
					$aux=explode('-',$gmatch[$i][$j][0]['result']);
					echo '<h>'.$aux[0].'</h>
						  <a>'.$aux[1].'</a>';
				}
				echo 	'</result1>
						 <result2>';
				if(isset($gmatch[$i][$j][1])){
					if($gmatch[$i][$j][1]['result']!=''){
						$aux=explode('-',$gmatch[$i][$j][1]['result']);
						echo '<h>'.$aux[1].'</h>
							  <a>'.$aux[0].'</a>';
					}
				}
				echo '</result2>
					  </partido>';
			}
		}
		echo '</ronda>';
	}
	echo '</ganadores>
		<perdedores>';
	if($lmatch!=''){
		$col=count($lmatch);
		$row=count($lmatch[$col-1]);
		for($i=$col-1;$i>=0;$i--){
			echo '<ronda>';
			for($j=0;$j<$row;$j++){
				if(isset($lmatch[$i][$j][0]['id'])){
					echo '<partido>
							<equipo1>'.$lmatch[$i][$j][0]['home'].'</equipo1>
							<equipo2>'.$lmatch[$i][$j][0]['away'].'</equipo2>
							<result1>';					
					if($lmatch[$i][$j][0]['result']!=''){
						$aux=explode('-',$lmatch[$i][$j][0]['result']);
						echo '<h>'.$aux[0].'</h>
							  <a>'.$aux[1].'</a>';
					}
					echo	'</result1>
							 <result2>';
					if(isset($lmatch[$i][$j][1])){
						if($lmatch[$i][$j][1]['result']!=''){
							$aux=explode('-',$lmatch[$i][$j][1]['result']);
							echo '<h>'.$aux[1].'</h>
								  <a>'.$aux[0].'</a>';
						}
					}
					echo '	</result2>
						  </partido>';
				}
			}
			echo '</ronda>';
		}
	}
	echo '</perdedores>
		  </partidos>';
?>