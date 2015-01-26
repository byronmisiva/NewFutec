<br>
<center>
<table id="match" style="width:100%;border-collapse:collapse; border-spacing: 0;" class="match">
	<?if($matches==0) echo '<tr><td><div style="font-size:16px;width:98%;margin:0 auto;color:#01416F;text-align:center;">Hoy no existen partidos en vivo</div>';
	  else{?>
	<?foreach($matches as $row):?>
	<tr>
		<td onclick="window.location.href='<?=base_url()?>moviles/single/<?=$row['id']?>/<?=$section?>'" class="back"> 
			<table id="game" style="width:100%;" class="game">
				<tr>
					<td class="gamel"><a href='<?=base_url().'moviles/single/'.$row['id']?>'><?=$row['home']['name']?></a></td>
					<td class="games"><?=$row['home']['result']?></td>
					<td class="games"><?=$row['away']['result']?></td>
					<td class="gamer"><a href='<?=base_url().'moviles/single/'.$row['id']?>'><?=$row['away']['name']?></a></td>
				</tr>
				<tr>
					<td class="gamef"><?=$row['fecha']?></td>
					<td class="gamem" colspan=2><?=$row['minuto']?>'</td>
					<td class="gamet"><?=$row['tiempo']?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<br>
		</td>
	</tr>
	<?endforeach;
	  }?>
</table>
</center>
<script>
var time = null
function move() {
window.location = '<?=base_url()?>moviles/scoreboard/<?=$this->uri->segment(3)?>'
}
timer=setTimeout('move()',<?=$refresh?>)
</script>