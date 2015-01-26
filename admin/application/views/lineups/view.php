<div id="admin">
	<h1><?=$title?></h1>

	<div class="actions">
    <ul>
        <li> <?=img(array('src'=>'imagenes/icons/partido.png','border'=>'0'))?> <?=anchor('matches_calendary/matches_all/'.$championship,'Regresar a Partidos')?></li>
    	<li> <?=img(array('src'=>'imagenes/icons/gol2.png','border'=>'='))?> <?=anchor('matches_actions/index/'.$this->uri->segment(3).'/'.$home->id.'/'.$away->id,'Marcador en Vivo')?>
    </ul>
    </div>
    <br>
    <br>
    <table border="0" cellpadding="0" cellspacing="0" width='100%'>
    	<tr>
    	<td width='50%' align='center'>
    	<div id='team_lineup'>
    		<div id='name'><?=$home->name?></div>
    		<form action='<?=base_url()?>lineups/add' id='add_lineup_home' method="post">
    			<?=form_hidden('match_id',$this->uri->segment(3));?>
    			<?=form_hidden('team_id',$home->id);?>
    			<table border="0" cellpadding="0" cellspacing="2">
    			<tr>
    				<td colspan='2'><?=form_dropdown('player_id', $players_home, set_value('player_id'));?></td>
    			</tr>
    			<tr>
    				<td>Posicion:</td>
    				<td><?=form_dropdown('position', $position, set_value('position'));?></td>
    			</tr>
    			<tr>
    				<td>Estado:</td>
    				<td><?=form_dropdown('status', $status, set_value('status'));?></td>
    			</tr>
    			<tr>
    				<td colspan='2'><input type='button' name="submit" value="Agregar" onClick='submit_lineup("final_home_lineup","add_lineup_home");'/></td>
    			</tr>
    			</table>
    		</form>
    	</div>
    	</td>
    	<td width='50%' align='center'>
		<div id='team_lineup'>
    		<div id='name'><?=$away->name?></div>
    		<form action='<?=base_url()?>lineups/add' id='add_lineup_away' method="post">
    			<?=form_hidden('match_id',$this->uri->segment(3));?>
    			<?=form_hidden('team_id',$away->id);?>
    			<table border="0" cellpadding="0" cellspacing="2">
    			<tr>
    				<td colspan='2'><?=form_dropdown('player_id', $players_away, set_value('player_id'));?></td>
    			</tr>
    			<tr>
    				<td>Posicion:</td>
    				<td><?=form_dropdown('position', $position, set_value('position'));?></td>
    			</tr>
    			<tr>
    				<td>Estado:</td>
    				<td><?=form_dropdown('status', $status, set_value('status'));?></td>
    			</tr>
    			<tr>
    				<td colspan='2'><input type='button' name="submit" value="Agregar" onClick='submit_lineup("final_away_lineup","add_lineup_away");'/></td>
    			</tr>
    			</table>
    		</form>
    	</div>
    	</td>
    	</tr>
    	<tr>
    	<td valign='top' align='center'>
    	<div id='final_home_lineup'>
    	<table border="0" cellpadding="0" cellspacing="5" width='96%'>
    		<?php
    		$pos="";
    		$stat="";
    		$j=0;
    		foreach($lineup_home as $row){
    			if($stat!=$row->status){
    				echo "<tr><td colspan='3' style='background-color: #EDE9E3;font-weight: bold;'>".$status[$row->status]."</td></tr>";
    				$stat=$row->status;
    			}
    			if($pos!=$row->lposition){
    				echo "<tr><td colspan='3' style='background-color: #DFF2FF;padding-left:5px;font-weight: bold;'>".$position[$row->lposition]."</td></tr>";
    				$pos=$row->lposition;
    			}
    			echo '<tr><td>';
    			echo $row->last_name.' '.$row->first_name;
    			echo '</td>';
    			echo '<td>';
    			
    			echo "<form action='".base_url()."lineups/add_points' id='add_point_home_".$j."' method='post'>";
    			echo form_hidden('id',$row->lid);
    			//var_dump($row);
    			echo'<select name="points" onChange=\'submit_points("add_point_home_'.$j.'");\'>';
    			for($i=0;$i<=10;$i+=0.1)
    				if(round($row->lpoints,1)==round($i,1))
    					echo '<option value='.round($i,1).' selected>'.round($i,1).'</option>'; 
    				else
    					echo '<option value='.round($i,1).'>'.round($i,1).'</option>'; 
    			echo '</select>';
    			
    			echo '</form>';
    			
    			echo'</td>';
    			echo '<td>'.anchor('lineups/delete/'.$row->lid.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar')).'</td></tr>';
    			$j++;
    		}
    		?>
    	</table>
    	</div>
    	</td>
    	<td valign='top' align='center'>
    	<div id='final_away_lineup'>
    	<table border="0" cellpadding="0" cellspacing="5" width='96%'>
    		<?php 
    		$pos="";
    		$stat="";
    		$j=0;
    		foreach($lineup_away as $row){
    			if($stat!=$row->status){
    				echo "<tr><td colspan='3' style='background-color: #EDE9E3;font-weight: bold;'>".$status[$row->status]."</td></tr>";
    				$stat=$row->status;
    			}
    			if($pos!=$row->lposition){
    				echo "<tr><td colspan='3' style='background-color: #DFF2FF;padding-left:5px;font-weight: bold;'>".$position[$row->lposition]."</td></tr>";
    				$pos=$row->lposition;
    			}
    			echo '<tr><td>';
    			echo $row->last_name.' '.$row->first_name;
    			echo '</td>';
    			echo '<td>';
    			
    			echo "<form action='".base_url()."lineups/add_points' id='add_point_away_".$j."' method='post'>";
    			echo form_hidden('id',$row->lid);
    			echo'<select name="points" onChange=\'submit_points("add_point_away_'.$j.'");\'>';
    			for($i=0;$i<=10;$i+=0.1){
    				if(round($row->lpoints,1)==round($i,1))
    					echo '<option value='.round($i,1).' selected>'.round($i,1).'</option>'; 
    				else
    					echo '<option value='.round($i,1).'>'.round($i,1).'</option>'; 
    			}
    			echo '</select>';
    			
    			echo '</form>';
    			
    			echo'</td>';
    			echo '<td>'.anchor('lineups/delete/'.$row->lid.'/'.$this->uri->segment(3), img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar')).'</td></tr>';
    			$j++;
    		}
    		?>
    	</table>
    	</div>
    	</td>
    	</tr>
    
    </table>
</div>