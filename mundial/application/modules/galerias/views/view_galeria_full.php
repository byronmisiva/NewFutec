<?php
setlocale(LC_ALL, "es_ES");
?>
<!-- Galería imágenes  -->
 <?php
    foreach ($galerias as $item) {
    	$mystring = $item['nombre'];
    	$findme   = 'home';
    	$pos = strpos($mystring, $findme);
    	// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
    	// porque la posición de 'a' está en el 1° (primer) caracter.
    	if ($pos==false) {
    
        	?>
        
<div class="col-md-12 separador">
    <div class="row">
        <div class="col-md-12 margen0">
          
            <h2>
             <div class="iconos sprite-galeria-azul"></div>
                <?php 
                $rest = substr($item['nombre'], 9, 17);
                echo ucfirst(strftime('%B %d / %Y', strtotime($rest)));
                ?>
            </h2>
             <hr class="cabecera">
        </div>
<div class="col-md-12 margen0 maxgaleria">        

       <?php
       $cont=0;
      
       foreach ($item['imagenes'] as $row) {
            ?>
            <!-- imagen  -->
            <div class="col-lg-3 col-xs-6 margen0 bg-galeria">
                <a title="<?php echo $row->nombre; ?>" href="<?php echo $row->visu; ?>" class="img-galeria-full minigaleria"  data-toggle="lightbox">
                <img src="<?php echo $row->thumb250; ?>">
                </a>
            </div>
            <!-- Fin imagene  -->
        <?php
        }
        ?>
    </div>
        </div>
  
</div>
 <?php
    	}
        	 }
        ?>
<div class="clearfix"></div>
<!-- Fin  Galería imágenes  -->