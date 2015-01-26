   <table border="0" cellpadding="0" cellspacing="5" width='96%'>
    <?php
    $pos="";
    $stat="";
    foreach($lineup as $row){
   		if($stat!=$row->status){
    		echo "<tr><td colspan='2' style='background-color: #EDE9E3;font-weight: bold;'>".$status[$row->status]."</td></tr>";
    		$stat=$row->status;
    	}
   	 	if($pos!=$row->lposition){
    		echo "<tr><td colspan='2' style='background-color: #DFF2FF;padding-left:5px;font-weight: bold;'>".$position[$row->lposition]."</td></tr>";
    		$pos=$row->lposition;
    	}
	    echo '<tr><td>';
	    echo $row->last_name.' '.$row->first_name;
	    echo '</td>';
	    echo '<td>'.anchor('lineups/delete/'.$row->lid.'/'.$row->match_id, img(array('src'=>'imagenes/icons/cross.png','border'=>'0')), array('title' => 'Eliminar')).'</td></tr>';	
    }
    ?>
    </table>
    	