<posiciones>
<?php 
$i=1;
$request="";
	foreach($tabla as $row):
		$q2=$this->db->query('Select * 
						 From teams 
						 Where id='.$row['id'])->result();	
		
		$request.='<posicion posicion="'.$i.'" equipo="'.$row['name'].'" jugados="'.$row['pj'].'" ganados="'.$row['pg'].'"
									 empatados="'.$row['pe'].'" perdidos="'.$row['pp'].'" puntos="'.$row['points'].'" gol_diferencia="'.$row['gd'].'" 
									 id="'.$row['id'].'" link="'.base_url().'sections/publica/'.$row['section'].'" imagen="'.base_url().$q2[0]->thumb_shield.'" />';
 		$i+=1;
	 endforeach;
echo $request;
?>
</posiciones>