<?php
setlocale(LC_ALL, "es_ES");
$this->load->module("partidos");
?>

    <div class="col-md-12 separador">
        <div class="row">
            <div class="col-md-12 margen0">

                <h2>
                    <div class="iconos sprite-galeria-azul"></div>
                    Videos FIFA 2014
                </h2>
                <hr class="cabecera">
            </div>
            <div class="col-md-12 margen0 maxgaleria">
                <?php

                foreach ($listadovideos as $row) {
                    ?>
                    <!-- imagen  -->
                    <div class="col-lg-6 col-xs-6 margen0 bg-galeria highlight" valor="<?php echo $row->smelyn;?>">
                        <a href="<?php echo $row->url; ?>"><img class="media-object" src="<?php echo base_url('imagenes/partidos.jpg'); ?>" alt=""></a>
                        <div class="text-left"><?php echo $row->local . "-" . $row->visitante; ?></div>
                    </div>
                    <!-- Fin imagene  -->
                <?php
                }
                ?>
            </div>
<div class="clearfix"></div>            
           <div class="col-md-12 margen0">

                <h2>
                    <div class="iconos sprite-galeria-azul"></div>
                    Goles  FIFA 2014
                </h2>
                <hr class="cabecera">
            </div>
            <div class="col-md-12 margen0 maxgaleria">
                <?php
                $dia = 1;
                foreach ($listadogoles as $row2) {
                    ?>
                    <!-- imagen  -->
                    <div class="col-lg-6 col-xs-6 margen0 bg-galeria highlight" valor="<?php echo $row2->smelyn;?>">
                        <a href="<?php echo $row2->url; ?>"><img class="media-object" src="<?php echo base_url('imagenes/goles.jpg'); ?>" alt=""></a>
                        <div class="text-left"><?php echo  $this->partidos->_clearfecha((strftime('%d de %b', strtotime($row2->inicia))))    ; ?></div>
                    </div>
                    <!-- Fin imagene  -->
                <?php
                $dia ++;
                }
                ?>
            </div>
 

        </div>

    </div>
<div class="clearfix"></div>
<!-- Fin  Galería imágenes  -->