<!-- Comentarios Vivo  -->
<div class="col-md-12 margen0">
<div class="col-md-12 margen0"><h2>Minuto a Minuto/ Comentarios</h2></div>
<?php foreach ($comentarios as $comments){?>
    <div class="row magen0">
        <div class="col-md-12 margen0">
            <div class="col-md-1 "><?php echo $comments->tipo?></div>
             <div class="col-md-1 "><?php 
             $mystring = $comments->tiempo;
             if($mystring!=""){
             $findme   = '+';
             $pos = strpos($mystring, $findme);
	             if ($pos === false) {
	             	$findme1   = 'h';
	             	$pos1 = strpos($mystring, $findme1);
	             	if ($pos1 === false) {
	             		$tiempo= $mystring."'";
	             	 }else {
	             	 	$tiempo=$mystring;
	             	 } 
	             } else {
	                $cadenTiempo=explode('+',$mystring);
	                $min1= $cadenTiempo[0];
	                $min1= $cadenTiempo[1];
	                $tiempo=(string)((int)$cadenTiempo[0]+(int)$cadenTiempo[1])."'";
	             }    
	            
             }else {
             	$tiempo=$mystring;
             }
             echo $tiempo;
             ?></div>
            <div  class="col-md-10 "><?php echo $comments->comentario?></div>    
        </div>
       </div>
 <?php }?>
  </div> 
  <div class="separador col-md-12"></div>   
  


