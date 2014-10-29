<!-- Galería estadios  -->
<div class="col-md-6 margen0 estadios">
    <div class="col-md-12 margen0">
        <h2>
            <div class="iconos sprite-icono_estadios"></div>
            Estadios
        </h2>
        <hr class="cabecera">
    </div>
    <div class="clearfix"></div>
    <div id="carousel-estadios" class="carousel slide c-fade" data-ride="carousel">
        <div class="clearfix"></div>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $cont = "active";
            foreach ($datosEstadio as $row) {
                ?>
                <div class="item <?php echo $cont;
                $cont = ''; ?>">
                    <?php
                    foreach ($row['imagenes'] as $imag) {
                        if (!empty($imag[0])) {
                            ?><div class="estadio-banner">
                            <img width="100%" src="<?php echo $imag[0]->thumb250; ?>" alt="<?php echo $row['nombre']; ?>"
                                 class="img-responsive margin-bottom-20"></div>
                        <?php
                        } else {
                            echo "no imagen";
                        }
                    }
                    ?>
                    <div class="col-md-6 gris"><a href="#carousel-estadios" data-slide="prev"
                            ><</a></div>
                    <div class="col-md-6 text-right gris"><a href="#carousel-estadios" data-slide="next"
                            >></a></div>
                    <div class="col-md-12 margen0l conten">
                        <h3><?php echo $row['nombre']; ?></h3>
                        Ubicado en la ciudad de <?php echo $row['ciudad']; ?>, cuenta con la capacidad máxima
                        de <?php echo $row['capacidad']; ?> personas y pertenece al club
                        deportivo <?php echo $row['club']; ?>
                    </div>
                </div>
            <?php


            }
            ?>
        </div>
    </div>
</div>
<div class="separador col-md-12"></div>
