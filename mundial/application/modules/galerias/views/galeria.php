<!-- Galería imágenes  -->
<div class="col-md-12 margen0  separador" id="galeria-dia">
    <div class="row partido-dia">
        <!-- Listado de partidos del Día-->
        <div class="col-md-12 list_partido_dia">
            <div class="col-md-12 cabecera-partidos">
                <h2>
                    <div class="iconos sprite-galeria"></div>
                    Galería
                </h2>
            </div>
            <!-- Partido del Día-->
            <?php

            foreach ($imagenes as $item) {

                ?>
                <!-- imagen  -->
                <div class="col-lg-4 col-sm-4 col-xs-6 margen0">
                    <div class = "imagenes-galeria">
                        <a title="<?php echo $item->nombre; ?>" href="<?php echo $item->visu; ?>" class="minigaleria"  data-toggle="lightbox"><img
                                src="<?php echo $item->thumb250; ?>"  height="98px"></a>
                    </div>
                </div>
                <!-- Fin imagene  -->
            <?php
            }
            ?>
        </div>
        <!-- Fin partido del Día-->
    </div>
    <div class="col-md-12 boton-more-fondo">
        <a href="<?php echo base_url();?>site/galerias" class="boton-more">Ver más ></a>
    </div>
</div>
<!-- Fin  Galería imágenes  -->