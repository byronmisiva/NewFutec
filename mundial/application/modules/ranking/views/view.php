
 <h1><?php echo $nombreFase;?></h1>
<?php
/*echo "<pre>";
var_dump($ranking);
echo "<pre>";*/
?>
<?php
foreach ($ranking as $rank){
?>
 <h2><?php echo $rank->nombre;?></h2>
 <table class="table table-striped">
 <tr>
       <th>Nombre Equipo</th>
       <td>Puntos</td>
       <td>Puntos Contra</td>
       <td>No. Partidos</td>
       <td>No. Partidos Ganados</td>
       <td>No. Partidos Empatados</td>
       <td>No. Partidos Perdidos</td>
       <td>No. Goles</td>
       <td>No. Goles Contra</td>
       <td>n. Corto</td>
   </tr>
  
<?php
foreach ($rank->tabla as $rankGroup){
//var_dump($rankGroup);
?>
  
      <tr> 
       <td><?php echo (string)$rankGroup->name;?></td>
       <td><?php echo $rankGroup->n_puntos;?></td>
       <td><?php echo $rankGroup->n_puntos_contra;?></td>
       <td><?php echo $rankGroup->n_partidos;?></td>
       <td><?php echo $rankGroup->n_partidos_ganados;?></td>
       <td><?php echo $rankGroup->n_partidos_empatados;?></td>
       <td><?php echo $rankGroup->n_partidos_perdidos;?></td>
       <td><?php echo $rankGroup->n_goles;?></td>
       <td><?php echo $rankGroup->n_goles_contra;?></td>
       <td><?php echo $rankGroup->short_name;?></td>
   <tr>
   
  <?php
}
?>

   
 </table>
   
 
<?php
}
?>