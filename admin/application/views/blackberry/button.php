<table width=100%>
	<?$col[0]="#FFFFFF";
	  $col[1]="#F3F3F3";
      $i=0;
	  $j=1;
	  foreach($buttons as $row):
	  	if($i%2==0){$j=0;}else{$j=1;}
		echo '<tr><td width=100% bgcolor="'.$col[$j].'" style="font-family: Arial; font-size: 11px;"><a href="'.base_url().$row['link'].'" style="color:black; text-decoration:underline;">'.$row['name'].'</a></td></tr>';	
	    $i++;  
	endforeach;
	?>
</table>