<!--    Noticias Home -->
<?php
setlocale(LC_ALL, "es_ES");
?>
<div class=" panel-noticias historias">

    <div class="row">
        <div class="separador"></div>
        <div class="col-md-12">
            <?php
            $this->load->module("partidos");
            $x = 0;
            foreach ($noticias as $noticia) {
            $x++;
            if ($x <= 1) {
            ?>
            <div class="col-md-12">
                <div class="row noticia">

                    <div class="col-md-12">
                        <div class="row">

                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">

                                        <?php
                                        $active = "active";
                                        foreach ($noticia->imagenes as $imagen) {
                                            ?>
                                            <div class="item <?php echo $active;?>">
                                            <img width="100%" class="img-responsive margin-bottom-20 img-historia"
                                                 src="<?php echo $imagen->ftp_visu ?>"
                                                 alt="<?php echo $noticia->titulo ?>">
                                            </div>
                                        <?php
                                            $active = "";
                                        }
                                        ?>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12    margen0l  noticias-detalles separador">

                        <h1 class="noticia-abierta noticia-grande"><?php echo $noticia->titulo ?></h1>
                        <hr class="cabecera">
                        <p class="noticia-abierta"><?php echo $noticia->cuerpo; ?></p>

                        <?php echo $noticia->anecdotas; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12 separador"></div>
            <div class="col-md-12 margen0">
                <div class="col-md-12 margen0">
                    <h2 class="noticia-abierta">
                        <div class="iconos sprite-noticias"></div>
                        Historia de los mundiales
                    </h2>

                </div>
                <?php
                } else {
                    ?>
                    <div class="col-md-6 col-xs-12">
                        <div class="row noticia">
                            <a href="<?php echo base_url() . "site/historias/" . strtolower($this->partidos->_clearStringGion($noticia->titulo)) . '/' . $noticia->id; ?>">
                                <div class="col-sm-5 col-xs-5 margen5r noticia2">
                                    <img class="img-responsive "
                                         src="<?php if (isset($noticia->imagenes[0]->ftp_thumbnail)) echo $noticia->imagenes[0]->ftp_thumbnail ?>"
                                         alt="<?php echo $noticia->titulo ?>">
                                </div>
                                <div class="col-sm-7  col-xs-7 margen5l altonews">
                                    <h3><?php echo $noticia->titulo ?></h3>
                                    <p><?php echo substr($noticia->cuerpo, 0, 120) . "..."; ?></p>
                                    <spam class="boton-more-mini">Ver más ></spam>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12  separador"></div>
                    </div>
                <?php
                }
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--    Fin Noticias Home -->
