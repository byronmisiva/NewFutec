<div id='modulo' style="background-color:white; font-size:14px;">
	<table class='titulo' cellpadding="0" cellspacing="0" width="100%">
	<tr>
	<th>Goleadores del Campeonato - <?=$name?></th>
	</tr>
	</table>
	<div id="strikers" style=" margin:5px; margin-left:10px; margin-right:10px;">
	<table cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #E9E9E9;">
		<tr>
		<?$first=$query->row();
		  $num=$query->num_rows();
		  $id=$first->id
		  ?>
			<td rowspan=<?=$num?> valign=top width=45% style="border-right: 1px solid #E9E9E9;">
				<center>
				<table>
					<tr>
						<td>
							<b><span style="color:red; font-size:18px;">1.</span><span style="font-size:18px;">
							<?php
							echo ' '.$first->last_name.' '.$first->first_name;
							if($first->nick!='NULL')
								echo ' ('.$first->nick.')';
							?>	
							</span></b>
						</td>
					</tr>
					<tr>
						<td>
							<center><img src="<?=base_url().$first->thumb220?>"/></center>
						</td>
					</tr>
					<tr>
						<td>
							<table>
							<tr><td style="text-align:right;"><b>Goles:</b></td><td style="text-align:left;"><?=$first->goals?></td></tr>
							<tr><td style="text-align:right;"><b>Equipo:</b></td><td style="text-align:left;"><?=$first->name?></td></tr>
							<tr><td style="text-align:right;"><b>Edad:</b></td><td style="text-align:left;"><?=mdate('%Y',$first->n-$first->b)-1969?></td></tr>
							<tr><td style="text-align:right;"><b>Estatura:</b></td><td style="text-align:left;"><?=$first->height?> cm.</td></tr>
							<tr><td style="text-align:right;"><b>Posici&oacute;n:</b></td><td style="text-align:left;"><?=$first->position?></td></tr>
							</table>
						</td>
					</tr>
				</table>
				</center>
			</td>
		</tr>
		<?$i=2;
		  foreach($query->result() as $row):
			if($i%2==0)
				$bg='white';
			else
				$bg='#E9E9E9';
		  	if($row->id!=$id){?>
			<tr style='background-color:<?=$bg?>'>
				<td style="padding-left:4px;padding-top:2px;padding-bottom:2px;">
					<span style="color:red;"><b><?=$i.'. '?></b></span>
					<?php
					if($row->nick!='NULL')
						echo $row->nick." ($row->last_name $row->first_name)".'<br>';
					else
						echo $row->last_name.' '.$row->first_name.'<br>';
					?>
					<span style="font-size:12px; color:#373737;"><?=$row->name?></span>
				</td>
				<td style="padding-right:4px;padding-top:2px;padding-bottom:2px;">
					<?=$row->goals?>
				</td>
			</tr>
		<?  $i+=1;}
		  endforeach;?>
	</table>
	</div>
</div>