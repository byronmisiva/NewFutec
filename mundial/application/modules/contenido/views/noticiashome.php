<!--    Noticias Home -->
<?php
setlocale(LC_ALL, "es_ES");
?>
<div class=" panel-noticias">

    <div class="row">
        <div class="col-md-12">
            <h2>
                <div class="iconos sprite-noticias"></div>
                Noticias
            </h2>
            <hr class="cabecera">

        </div>
        <div class="col-md-12">
            <?php
            $this->load->module("partidos");
            $x = 0;
            foreach ($noticias as $noticia) {
                $x++;
                if ($x <= 2) {
                    ?>
                    <div class="col-md-6 ">
                        <div class="row noticia">
                            <a href="<?php echo base_url() . "site/noticia/" . strtolower($this->partidos->_clearStringGion($noticia->titulo)) . '/' . $noticia->id; ?>">
                            <div class="col-md-12 margen0l noticia1">
                                <img width="100%" class="img-responsive margin-bottom-20"
                                     src="<?php if (isset  ($noticia->imagenes->thumb250)) echo  $noticia->imagenes->thumb250 ?>"
                                     alt="<?php echo $noticia->titulo ?>">
                            </div>
                            <div class="col-md-12 margen0l pie-imagen-noticia">
                                <?php echo ucfirst(strftime('%B %d / %Y  %Hh%M', strtotime($noticia->creado))); ?>
                            </div>
                            <div class="col-md-12 margen0l  altonews ">
                                <h3><?php echo strip_tags ( $noticia->titulo) ?></h3>

                                <p><?php echo substr(strip_tags ($noticia->cuerpo), 0, 250) . "..."; ?></p>
                                    <spam class="boton-more-mini">Ver más ></spam>
                            </div>
                            </a>
                        </div>
                    </div>

                <?php
                } else {
                    $cuerpo = "";
                    if ($x > 4) $cuerpo = "hrcuerpo";
                    ?>
                    <div class="col-md-6 margen0l">
                        <hr class="<?php echo $cuerpo ?>">
                        <div class="row noticia">
                            <a href="<?php echo base_url() . "site/noticia/" . strtolower($this->partidos->_clearStringGion($noticia->titulo)) . '/' . $noticia->id; ?>"  >
                                <div class="col-sm-4 col-xs-5  col-md-4  col-lg-4 margen5r noticia2">
                                    <img class="img-responsive "
                                         src="<?php if (isset($noticia->imagenes->ftp_thumbnail)) echo $noticia->imagenes->ftp_thumbnail ?>"
                                         alt="<?php echo strip_tags ( $noticia->titulo) ?>">
                                </div>
                                <div class="col-sm-8  col-xs-7 col-md-8 col-lg-8 margen5l altonews">
                                    <div class="col-md-12 margen0l mini-noticia-fecha">
                                        <?php echo ucfirst(strftime('%B %d / %Y  %Hh%M', strtotime($noticia->creado))); ?>
                                    </div>
                                    <h3><?php echo $noticia->titulo ?></h3>

                                    <p><?php echo substr(strip_tags ( $noticia->cuerpo), 0, 100) . "..."; ?></p>

                                    <spam class="boton-more-mini">Ver más ></spam>

                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }

                if ($x == 2){
                    echo ' <div class="clearfix"></div>';
                }
            }
            ?>
            <div class="col-md-12 boton-more-fondo">
                <a href="<?php echo base_url("site/noticia") ?>" class="boton-more">Más noticias ></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--    Fin Noticias Home -->
