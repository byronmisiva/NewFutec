
	<div style='margin-top: 3px;'>
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
		$num=1;
		$sign='';
		if(is_array($tabla)){
			foreach($tabla as $row){
				$class = ( $num % 2 == 0 ) ? 'class="altrow"' : '';
				$sign = ($row['gd']>0) ? '+' : '';				
				if($row['updown']==0)
					$row['updown']='';?>
				<tr <?php echo $class;?>>
					<td class='data' width='15px'><?php echo $num?></td>
					<?php if(isset($teams[$row['id']])){?>
						<td class='name'><?php echo anchor('sections/publica/'.$row['section'],$row['name'])?></td>
					<?php }
					else{?>
						<td class='name'><?php echo $row['name']?></td>
					<?php }?>
					<td align="center">
						<div style="width:25px; height: 20px;">
							<div style="position: absolute;">
								<img src="<?php echo $change[$row['change']] ?>" width="20" height="20">
							</div>
							<div id=down style="position: relative; font-size: 11px; top: 5px; right: 2px; line-height:11px; padding:0px; color:white; width:5px;">
								<?php echo $row['updown']?>
							</div>
						</div>
					</td>	
					<td class='data'><?php echo $row['pj']?></td>
					<td class='data'><?php echo $row['pg']?></td>
					<td class='data'><?php echo $row['pe']?></td>
					<td class='data'><?php echo $row['pp']?></td>
					<td class='data'><?php echo $row['points']?></td>
					<td class='data'><?php echo $sign.$row['gd']?></td>
				</tr>											
				<?php
				$num++;
			}
	}?>
	</table>
</div>