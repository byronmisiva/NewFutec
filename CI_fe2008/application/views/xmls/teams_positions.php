<posiciones>
<?php 
$i=1;
$request="";
foreach($tabla as $row):
 		$q=$this->db->query('Select * 
						 From sections 
						 Where team_id='.$row['id']);
		$q2=$this->db->query('Select * 
						 From teams 
						 Where id='.$row['id'])->result();	
 		$section='';
		if($q->num_rows()>0){
			$q1=$q->result();
			$section=base_url().'sections/publica/'.$q1[0]->id;
		}
		
		
		$request.='<posicion posicion="'.$i.'" equipo="'.$row['name'].'" jugados="'.$row['PJ'].'" ganados="'.$row['PG'].'"
									 empatados="'.$row['PE'].'" perdidos="'.$row['PP'].'" puntos="'.$row['P'].'" gol_diferencia="'.$row['GD'].'" 
									 id="'.$row['id'].'" link="'.$section.'" imagen="'.base_url().$q2[0]->thumb_shield.'" />';
 	$i+=1;
 endforeach;
echo $request;
?>
</posiciones>