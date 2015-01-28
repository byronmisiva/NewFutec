<div id='modulo'>
<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
<tr>
<th>Resumen del Partido</th>
</tr>
</table>
</div><div id='partido'>
	<table class='general' width='100%'>
	<tr>
	<td colspan='2'>
		<table class='marcador'  width='100%'>
		<tr>
			<td align='left'><?=img($home->shield)?></td>
			<td align='center'><?=$partido->result_home?><br><?=$home->name?></td>
			<td align='center'><strong>VS</strong></td>
			<td align='center'><?=$partido->result_away?><br><?=$away->name?></td>
			<td align='right'><?=img($away->shield2)?></td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
		<td><strong>Fecha:</strong></td>
		<td><strong>Arbitros:</strong></td>
	</tr>
	<tr>
		<td class='data'><?=$partido->date_match?></td>
		<td class='data'>
		<?php
		if(isset($referee->rf))
			echo $referee->rf." ".$referee->rl;
		?>
		</td>
	</tr>
	<tr>
		<td><strong>Estadio:</strong></td>
		<td class='data'>
		<?php
		if(isset($referee->r1f))
			echo $referee->r1f." ".$referee->r1l;
		?>
		</td>
	</tr>
	<tr>
		<td class='data'><?=$stadia->name?></td>
		<td class='data'>
		<?php
		if(isset($referee->r2f))
			echo $referee->r2f." ".$referee->r2l;
		?>
		</td>
	</tr>
	<tr>
		<td><strong>Estado del Partido:</strong></td>
		<td class='data'>
		<?php
		if(isset($referee->rsf))
			echo $referee->rsf." ".$referee->rsl;
		?>
		</td>
	</tr>
	<tr>
		<td class='data'><?=$states[$partido->state]?></td>
		<td></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
	<td colspan='2' class='titulo' align='center'>Alineación</td>
	</tr>
	<tr>
	<td width='50%' class='all' valign='top'>
	<table class='lineup'  width='100%'>
	<?php 
	$type[1]='Arquero';
	$type[2]='Defensa';
	$type[3]='Volante';
	$type[4]='Delantero';
	
	$tit=0;
	$check=0;
	
	foreach($lineup_home as $row){
		if($row->status==0 && $tit==0){
			echo "<tr><td></td></tr><tr><td  align='left'><b>Titulares</b></td></tr>";
			$tit+=1;
		}
		
		if($row->status==1 && $tit==1){
			echo "<tr><td><br/></td></tr><tr><td  align='left'><b>Suplentes</b></td></tr>";
			$tit+=1;
		}
		
		if($row->position!=$check){
			echo "<tr><td></td></tr><tr><td  align='left'><b>".$type[$row->position]."</b></td></tr>";
			$check=$row->position;
		}
		echo "<tr><td width=95% align='left'>$row->name</td><td width=5% align='left'><b>$row->points</b></td></tr>\n";
			
		
	}
	?>
	</table>
	</td>
	<td width='50%' class='all' valign='top'>
	<table class='lineup'  width='100%'>
	<?php 
	$tit=0;
	$check=0;
	foreach($lineup_away as $row){
		
		if($row->status==0  && $tit==0){
			echo "<tr><td></td></tr><tr><td></td><td align='right'><b>Titulares</b></td></tr>";
			$tit+=1;
		}
		
		if($row->status==1  && $tit==1){
			echo "<tr><td><br/></td></tr><tr><td></td><td align='right'><b>Suplentes</b></td></tr>";
			$tit+=1;
		}
		
		if($row->position!=$check){
			echo "<tr><td></td></tr><tr><td></td><td align='right'><b>".$type[$row->position]."<b></td></tr>";
			$check=$row->position;
		}
		echo "<tr><td width=5% align='right'><b>$row->points</b></td><td width=95% align='right'>$row->name</td></tr>\n";
	}
	?>
	</table>
	</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
	<td colspan='2' class='titulo' align='center'>Goles</td>
	</tr>
	<tr>
	<td class='all' valign='top'>
	<table class='goals'  width='100%' >
	<?php 
	foreach($goals_home as $row){
		echo "<tr><td align='left'>".img($actions_type['gol'])." $row->name ( <span style='color:red;'>$row->minute'</span> )</td></tr>\n";
	}
	?>
	</table>
	</td>
	<td class='all' valign='top'>
	<table class='goals'  width='100%'>
	<?php 
	foreach($goals_away as $row){
		echo "<tr><td align='right'>( <span style='color:red;'>$row->minute'</span> ) $row->name ".img($actions_type['gol'])."</td></tr>\n";
	}
	?>
	</table>
	</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
	<td colspan='2' class='titulo' align='center'>Tarjetas</td>
	</tr>
	<tr>
	<td class='all' valign='top' valign='top'>
	<table class='cards'  width='100%' >
	<?php 
	foreach($cards_home as $row){
		echo "<tr><td align='left'>".img($actions_type[$row->type])." $row->name ( <span style='color:red;'>$row->minute'</span> )</td></tr>\n";
	}
	?>
	</table>
	</td>
	<td class='all' valign='top'>
	<table class='cards'  width='100%' >
	<?php 
	foreach($cards_away as $row){
		echo "<tr><td align='right'>( <span style='color:red;'>$row->minute'</span> ) $row->name ".img($actions_type[$row->type])."</td></tr>\n";
	}
	?>
	</table>
	</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
	<td colspan='2' class='titulo' align='center'>Cambios</td>
	</tr>
	<tr>
	<td class='all' valign='top'>
	<table class='changes'  width='100%' >
	<?php 
	foreach($changes_home as $row){
		echo "<tr><td align='left'>".img($actions_type['in']).$row->in."<br>".img($actions_type['out']).$row->out." ( <span style='color:red;'>".$row->minute."'</span> )<br>"."</td></tr>\n";
	}
	?>
	</table>
	</td>
	<td class='all' valign='top'>
	<table class='changes'  width='100%' >
	<?php 
	foreach($changes_away as $row){
		echo "<tr><td align='right'>".$row->in.img($actions_type['in'])."<br>( <span style='color:red;'>".$row->minute."'</span> ) ".$row->out.img($actions_type['out'])." <br>"."</td></tr>\n";
	}
	?>
	</table>
	</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
	<td colspan='2' class='titulo' align='center'>Acciones</td>
	</tr>
	<tr>
	<td colspan='2' class='all' valign='top'>
	<table class='acciones'  width='100%'>
	<?php 
	foreach($actions as $row){
		echo "<tr>\n";
		echo "<td>".img($actions_type[$row->type])." $row->text</td>\n";
		echo "<tr>\n";
	}
	?>
	</table>
	</td>
	</tr>
	<?php 
	if($partido->story_id){
		echo "<tr>\n";
		echo "<td colspan='2'>".anchor('stories/publica/'.$partido->story_id, 'Leer resumen del partido')."</td>\n";
		echo "</tr>\n";
	}
	?>
	</table>
</div>