<br>
<center>
<table id="match" width=310 cellpadding="0" cellspacing="0" class="match">
	<tr>
		<td class="back"> 
			<table id="game" width=310 cellpadding="2" cellspacing="0" class="game">
				<tr>
					<td class="gamel"><?=$matches['home']['name']?></td>
					<td class="games"><?=$matches['home']['result']?></td>
					<td class="games"><?=$matches['away']['result']?></td>
					<td class="gamer"><?=$matches['away']['name']?></td>
				</tr>
				<tr>
					<td class="gamef"><?=$matches['fecha']?></td>
					<td class="gamem" colspan=2  style=" "><?=$matches['minuto']?>'</td>
					<td class="gamet"><?=$matches['tiempo']?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<br>
		</td>
	</tr>
</table>
<?if($matches['actions']!=FALSE){?>
	<table id="action" width=280 cellpadding="2" cellspacing="0" class="action">
		<?$i=1;
		  foreach($matches['actions'] as $row):?>
			<tr>
				<td class="actionm<?if($i%2==0) echo "2"; else echo "1";?>"><?if($row['match_time']<=120) echo $row['match_time'].'\''?></td>
				<td class="actiont<?if($i%2==0) echo "2"; else echo "1";?>"><?=$row['action']?></td>
			</tr>
	    <?$i+=1;
	      endforeach;?>
	    <tr>
	    	<td><br><td>
	    </tr>
    </table>
<?}?>
</center>
<script language="JavaScript">
var time = null
function move() {
window.location = '<?=base_url()?>moviles/single/<?=$this->uri->segment(3).'/'.$this->uri->segment(4)?>'
}
timer=setTimeout('move()',<?=$refresh?>)
</script>

