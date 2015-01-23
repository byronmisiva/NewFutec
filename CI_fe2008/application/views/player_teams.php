<div id="admin">
	<h1><?php echo $title.' '.$heading?></h1>

	<div style="margin: 10px">
 		<table class='listing' border=1>
		<tr>
			<th>JUGADOR</th>
			<th>EQUIPO</th>
			<th></th>
		</tr>
		<?php foreach($player as $row):?>
		 	<tr class='altrow'>
		 		<td><?=$row['ln'].' '.$row['fn']?></td>
		 		<td>
		 			<table >
		 			
					<?foreach($row['teams'] as $row2 ):?>
						<tr>
							<td style="border-bottom:0px;"><?=$row2['name']?></td>
							</tr>	
					<?endforeach;?>
		 			
		 			</table>
		 		</td>
		 		<td>
		 			<table >
		 			
					<?foreach($row['teams'] as $row2 ):?>
						<tr>
							<td style="border-bottom:0px;"><?=anchor('players/confirm_delete_fteam/'.$row2['id'].'/'.$row2['name'].'/'.$row['fn'].'/'.$row['ln'], img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Confirmacion','onclick'=>'Modalbox.show(this.href, {title: this.title, width: 400}); return false;'));?></td>
						</tr>	
					<?endforeach;?>
		 			
		 			</table>
		 		</td>
		 		
		 	</tr>
		 <?php endforeach;?>
		 </table>
	 </div>
</div>