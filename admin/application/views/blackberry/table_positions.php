<?
$color[0]='#FFFFFF';
$color[1]='#F3F3F3';
?>
<center>
<table width=100% style="font-family: Arial; font-size: 11px;">
	<tr><td width=100% style="font-weight:bold;"><?=$grp?></td></tr>
	<tr><td width=100%>
		<table width=100% cellpadding="0" cellspacing="0">
			<tr>
				<th width=10% bgcolor='#F3F3F3'></th>
				<th width=60% bgcolor='#F3F3F3'>Equipo</th>
				<th width=10% bgcolor='#F3F3F3'>PJ</th>
				<th width=10% bgcolor='#F3F3F3'>Pts</th>
				<th width=10% bgcolor='#F3F3F3'>GD</th>
			</tr>
			<?php
			if(is_array($tabla)){
				$i=1;
				$j=1;
				foreach($tabla as $row){
					if($j%2==0){$i=1;}else{$i=0;}
					echo "<tr>";
					echo "<td style=\"font-family: Arial; font-size: 11px;\" bgcolor=\"$color[$i]\" width=10% align=\"center\">".$j."</td>\n";
					echo "<td style=\"font-family: Arial; font-size: 11px;\" bgcolor=\"$color[$i]\" width=60%>".$row['name']."</td>\n";
					echo "<td style=\"font-family: Arial; font-size: 11px;\" bgcolor=\"$color[$i]\" width=10% align=\"center\">".$row['pj']."</td>\n";
					echo "<td style=\"font-family: Arial; font-size: 11px;\" bgcolor=\"$color[$i]\" width=10% align=\"center\">".$row['points']."</td>\n";
					echo "<td style=\"font-family: Arial; font-size: 11px;\" bgcolor=\"$color[$i]\" width=10% align=\"center\">".$row['gd']."</td>\n";
					echo "</tr>";
				$j+=1;
				}
			}
			?>
		</table>
	</td></tr>
</table>
</center>
<br/>
<br/>