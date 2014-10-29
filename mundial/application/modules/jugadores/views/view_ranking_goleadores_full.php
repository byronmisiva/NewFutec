<!-- Goleadores  -->
<div class="col-md-12 separador">
    <div class="row main-goleadores">
        <!-- Goleador Principal  -->
        <div class="col-md-12">
            <div class="col-md-2 col-xs-2 "><img src="<?php echo (string)$goleadores[0]->foto ?>"></div>
            <div  class="col-md-10 col-xs-10 ">
                <div  class="col-md-12  ">
                    <div class="col-md-3 col-xs-6 center-block">
                        <div class="iconos sprite-escudo-<?php echo strtolower((string)$goleadores[0]->name); ?>"></div>
                    </div>
                    <div class="col-md-9  col-xs-6">
                        <h1><?php echo (string)$goleadores[0]->nombre . " " . (string)$goleadores[0]->apellido ?></h1>
                        <h2><?php echo (string)$goleadores[0]->name ?></h2>
                        <h2><?php echo (string)$goleadores[0]->n_goles . ' Goles' ?></h2>
                    </div>
                </div>
                <div class="separador  col-md-12"></div>
                <div class="col-md-12  "><?php echo (string)$goleadores[0]->detalles ?></div>
            </div>
            <!-- --------  -->
        </div>
        <div class="separador clearfix col-md-12"></div>
        <div class="separador  col-md-12"></div>
        <?php
        for ($i = 1; $i < count($goleadores); $i++) {
            //if((string)$goleadores[$i]->nombre!=""){            ?>
            <div class="col-md-12 gol-cuerpo margen0">

                <div
                    class="col-md-10 col-xs-10 margen0">
                    <div
                        class=" margen15 iconos sprite-escudo-<?php echo strtolower((string)$goleadores[$i]->short_name); ?>"></div>
                    <?php echo (string)$goleadores[$i]->nombre . " " . (string)$goleadores[$i]->apellido . " (" . (string)$goleadores[$i]->name . ")"; ?></div>
                <div class="col-md-2 col-xs-2  margen0 text-center gris"><?php echo (string)$goleadores[$i]->n_goles; ?></div>
            </div>
        <?php
           //}
        } ?>
    </div>

</div>
<div class="separador col-md-12"></div>
<!-- Fin  Goleadores  -->