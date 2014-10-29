<!-- Galería imágenes  -->
<?php $this->load->module("partidos"); ?>
<div class="col-md-6 margen0 sedes">
    <div class="col-md-12 margen0l">
        <h2>
            <div class="iconos sprite-icono_sedes"></div>
            Historias de los mundiales
        </h2>
        <hr class="cabecera">
    </div>
    <div class="clearfix"></div>
    <div id="carousel-historias" class="carousel slide c-fade" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $cont = "active";
            foreach ($datosHistoria as $row) {
                ?>
                <div class="item <?php echo $cont;
                $cont = ''; ?>">
                    <a href="<?php echo base_url() . "site/historias/" . strtolower($this->partidos->_clearStringGion($row['titulo'])) . "/" . $row['id']; ?>">
                        <?php
                        foreach ($row['imagenes'] as $imag) {
                            if (!empty($imag[0])) {
                                ?>
                                <div class="estadio-banner">
                                    <img width="100%" src="<?php echo $imag[0]->thumb250; ?>"
                                         alt="<?php echo $row['titulo']; ?>"
                                         class="img-responsive margin-bottom-20"></div>
                            <?php
                            } else {
                                echo "no imagen";
                            }
                        }
                        ?>
                    </a>

                    <div class="col-md-6 gris"><a href="#carousel-historias" data-slide="prev"
                            ><</a></div>
                    <div class="col-md-6 text-right gris"><a href="#carousel-historias" data-slide="next"
                            >></a></div>
                    <div class="col-md-12 margen0 conten">

                        <h3>
                            <a href="<?php echo base_url() . "site/historias/" . strtolower($this->partidos->_clearStringGion($row['titulo'])) . "/" . $row['id']; ?>"><?php echo $row['titulo']; ?></a>
                        </h3>
                        <a href="<?php echo base_url() . "site/historias/" . strtolower($this->partidos->_clearStringGion($row['titulo'])) . "/" . $row['id']; ?>">
                            <?php echo substr($row['cuerpo'], 0, 180) . "..."; ?>
                        </a>
                    </div>
                    </a>
                </div>
            <?php


            }
            ?>

        </div>


    </div>
</div>
