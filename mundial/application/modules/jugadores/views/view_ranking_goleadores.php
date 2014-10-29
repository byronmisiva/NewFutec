<!-- Goleadores -->
<?php if( !$ajax ){?>
<div id='modul_ranking_goleadores'>
    <?php }?>
    <!-- Goleadores  -->
    <div class="col-md-12 separador">
        <div class="row main-goleadores">
            <div class="col-md-12 cabecera-partidos">
                <h2>
                    <div class="iconos sprite-icono_goleadores"></div>
                    Goleadores
                </h2>
            </div>
            <div class="col-md-12 gol-cabeza gris margen0">
                <div class="col-md-2 "></div>
                <div class="col-md-8 movi-headline-regular">Nombre</div>
                <div class="col-md-2 movi-headline-regular margen0 text-center">Goles</div>
            </div>
            <?php
            for ($i = 0; $i < 5; $i++) {
                //if((string)$goleadores[$i]->nombre!=""){ 
                ?>
                <div class="col-md-12 gol-cuerpo margen0">

                    <div class="col-md-2 ">
                        <div class="iconos sprite-escudo-<?php echo strtolower ((string)$goleadores[$i]->short_name);?>"></div>
                    </div>
                    <div class="col-md-8 ">
			<?php echo (string)$goleadores[$i]->nombre." ".(string)$goleadores[$i]->apellido . " (" . (string)$goleadores[$i]->short_name. ")";?>
			</div>
                    <div class="col-md-2 margen0 text-center gris"><?php echo (string)$goleadores[$i]->n_goles;?></div>
                </div>
            <?php
              // } 
            } ?>
        </div>

    </div>
    <!-- Fin  Goleadores  -->
    <div class="col-md-12 boton-more-fondo margen0">
        <a href="<?php echo base_url('site/goleadores')?>" class="boton-more">Ver todos ></a>
    </div>
    <?php if( !$ajax ){?>
</div>
<?php }?>
<!-- Fin Goleadores  -->


