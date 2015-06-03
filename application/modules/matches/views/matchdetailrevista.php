<?php
$estado['0'] = 'No Iniciado';
$estado['1'] = 'Primer Tiempo';
$estado['2'] = 'Fin del Primer Tiempo';
$estado['3'] = 'Segundo Tiempo';
$estado['4'] = 'Fin Segundo Tiempo';
$estado['5'] = 'Primer Extra';
$estado['6'] = 'Segundo Extra';
$estado['7'] = 'Penales';
$estado['8'] = 'Fin del Partido';?>
    <!--Titulo-->

    <div class="matchdetail col-md-12 separador10-xs margen0 margen0-xs">



    <div class="col-md-6 col-xs-6  separador10   margen0l ">
        <div class="col-md-12  col-xs-12    clearfix borde">
            <div class="col-md-6  col-xs-6  margen0">
                <img class="img-responsive"
                     src="http://www.futbolecuador.com/<?php if ((isset($infoLocal->shirt)) or ($infoLocal->shirt != "")) {
                         echo $infoLocal->shirt;
                     } else {
                         echo "imagenes/teams/shirt/uniforme.jpg";
                     } ?>" alt="<?php echo $infoLocal->name ?>" title="<?php echo "Camiseta de " . $infoLocal->name ?>">
            </div>
            <div class="col-md-6   col-xs-6 margen0">
                <div class="col-md-12 col-xs-12 text-right separador10 nombre-equipo margen5l">
                    Director Técnico
                </div>
                <div class="col-md-12 col-xs-12 text-right  margen5l">
                    <?php echo $infoLocal->couch ?>
                </div>
                <div class="col-md-12 col-xs-12 text-right separador10 nombre-equipo margen5l">
                    Estrategia
                </div>
                <div class="col-md-12 col-xs-12 text-right  margen5l">
                    <?php echo $estrategiaLocal ?>
                </div>
                <div class="col-md-12 col-xs-12 text-right separador10 nombre-equipo margen5l  text-visitante">
                    <div class="text-right   bottom">
                        Local
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-md-6 col-xs-6 separador10   margen0r ">
        <div class="col-md-12   col-xs-12  clearfix borde">
            <div class="col-md-6   col-xs-6 margen0">
                <div class="col-md-12 col-xs-12 text-left separador10 nombre-equipo margen5l">
                    Director Técnico
                </div>
                <div class="col-md-12 col-xs-12 text-left  margen5l">
                    <?php echo $infoVisitante->couch ?>
                </div>
                <div class="col-md-12 col-xs-12 text-left separador10 nombre-equipo margen5l">
                    Estrategia
                </div>
                <div class="col-md-12 col-xs-12 text-left  margen5l">
                    <?php echo $estrategiaVisitante ?>
                </div>
                <div class="col-md-12 col-xs-12 text-left separador10 nombre-equipo margen5l  text-visitante">
                    <div class="  bottom">
                        Visitante
                    </div>
                </div>

            </div>
            <div class="col-md-6  col-xs-6  margen0">
                <img class="img-responsive"
                     src="http://www.futbolecuador.com/<?php if ((isset($infoVisitante->shirt)) or ($infoVisitante->shirt != "")) {
                         echo $infoVisitante->shirt;
                     } else {
                         echo "imagenes/teams/shirt/uniforme.jpg";
                     } ?>"
                     alt="<?php echo $infoVisitante->name ?>"
                     title="<?php echo "Camiseta de " . $infoVisitante->name ?>">
            </div>
        </div>
    </div>

    <!--GOLES-->
    <div class="col-md-12 col-xs-12 separador10 margen0 clearfix">
        <div class="col-md-6 col-xs-6 margen0l">
            <div class="col-md-12   col-xs-12 margen0">
                <div class="panel-heading fondoazul">
                    <h4 class="panel-title">
                        Goles
                    </h4>
                </div>
            </div>
            <!--El marcador-->
            <div class="col-md-12  col-xs-12 margen0      clearfix">
                <?php
                if (count($golesLocal) > 0) {
                    foreach ($golesLocal as $golLocal) {
                        ?>
                        <div
                            class="col-md-12 col-xs-12 separador5   lineseparador-dot"> <?php echo $golLocal->first_name . " " . $golLocal->last_name . " - " . $golLocal->minute . "'"; ?></div>
                    <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-6   col-xs-6 margen0r">
            <div class="col-md-12  col-xs-12  margen0">
                <div class="panel-heading fondoazul">
                    <h4 class="panel-title">
                        Goles
                    </h4>
                </div>
            </div>
            <!--El marcador-->
            <div class="panel-group  " id="accordion" role="tablist" aria-multiselectable="true">
                <div class="col-md-12 col-xs-12  margen0   clearfix">
                    <?php
                    if (count($golesVisitante) > 0) {
                        foreach ($golesVisitante as $golVisitante) {
                            ?>
                            <div
                                class="col-md-12 col-xs-12 separador5   lineseparador-dot"> <?php echo $golVisitante->first_name . " " . $golVisitante->last_name . " - " . $golVisitante->minute . "'"; ?></div>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--actions -->
    <div class="col-md-12 col-xs-12  separador10 margen0">
        <div class="col-md-12  col-xs-12  margen0">

            <div class="panel-heading fondoazul">
                <h4 class="panel-title">
                    Comentarios
                </h4>
            </div>
        </div>
        <!--El actions-->
        <div class="col-md-12   margen0  <?php if (count($actions) > 0) echo "panelGuest" ?> clearfix">
            <?php
            if (count($actions) > 0) {
                foreach ($actions as $action) {
                    ?>
                    <div class="col-md-12 col-xs-12 separador5   lineseparador-dot">
                        <div class="col-md-2 col-xs-2">
                            <div class="col-md-6 col-xs-6">
                                <img src="<?php echo $action['tipo']; ?>" alt="Acción partido" title="Acción partido">
                            </div>
                            <div class="col-md-6 col-xs-6 nombre-equipo">
                                <?php echo $action['minuto'];
                                echo is_numeric($action['minuto']) ? "'" : ""; ?>
                            </div>
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <?php echo $action['texto']; ?>
                        </div>
                    </div>
                <?php

                }
            }
            ?>
        </div>
    </div>


    <!--Titulares-->
    <div class="col-md-12 col-xs-12 separador10  margen0 clearfix">
        <div class="col-md-6 col-xs-6 margen0l">
            <div class="col-md-12  col-xs-12   margen0">
                <div class="panel-heading fondoazul">
                    <h4 class="panel-title">
                        Titulares
                    </h4>
                </div>
            </div>
            <!--El marcador-->
            <div class="col-md-12 col-xs-12  margen0      clearfix">
                <?php
                if (count($titularesLocal) > 0) {
                    foreach ($titularesLocal as $titular) {
                        if ($titular->status == 1 || $titular->status == 3) {
                            $accionesJugador = accionJugador($titular);
                            ?>
                            <div
                                class="col-md-12 col-xs-12 separador5   lineseparador-dot"> <?php echo $titular->last_name . " " . $titular->first_name . $accionesJugador; ?></div>
                        <?php
                        }
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-6 col-xs-6   margen0r">
            <div class="col-md-12 col-xs-12   margen0">
                <div class="panel-heading fondoazul">
                    <h4 class="panel-title">
                        Titulares
                    </h4>
                </div>
            </div>
            <!--El marcador-->
            <div class="panel-group  " id="accordion" role="tablist" aria-multiselectable="true">
                <div class="col-md-12 col-xs-12  margen0   clearfix">
                    <?php
                    if (count($titularesVisitante) > 0) {
                        foreach ($titularesVisitante as $titular) {
                            if ($titular->status == 1 || $titular->status == 3) {
                                $accionesJugador = accionJugador($titular);
                                ?>
                                <div
                                    class="col-md-12 col-xs-12 separador5   lineseparador-dot"> <?php echo $titular->last_name . " " . $titular->first_name . $accionesJugador; ?></div>
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--Suplentes -->
    <div class="col-md-12 col-xs-12 separador10   margen0      clearfix">
        <div class="col-md-6 col-xs-6  margen0l">
            <div class="col-md-12 col-xs-12    margen0">
                <div class="panel-heading fondoazul">
                    <h4 class="panel-title">
                        Suplentes
                    </h4>
                </div>
            </div>
            <!--El marcador-->
            <div class="col-md-12 col-xs-12  margen0      clearfix">
                <?php
                if (count($titularesLocal) > 0) {
                    foreach ($titularesLocal as $titular) {
                        if (!($titular->status == 1 || $titular->status == 3)) {
                            $accionesJugador = accionJugador($titular);
                            ?>
                            <div
                                class="col-md-12 col-xs-12 separador5   lineseparador-dot"> <?php echo $titular->last_name . " " . $titular->first_name . $accionesJugador; ?></div>
                        <?php
                        }
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-6 col-xs-6   margen0r">
            <div class="col-md-12  col-xs-12  margen0">
                <div class="panel-heading fondoazul">
                    <h4 class="panel-title">
                        Suplentes
                    </h4>
                </div>
            </div>
            <!--El marcador-->
            <div class="panel-group  " id="accordion" role="tablist" aria-multiselectable="true">
                <div class="col-md-12  col-xs-12 margen0   clearfix">
                    <?php
                    if (count($titularesVisitante) > 0) {
                        foreach ($titularesVisitante as $titular) {
                            if (!($titular->status == 1 || $titular->status == 3)) {
                                $accionesJugador = accionJugador($titular);
                                ?>
                                <div
                                    class="col-md-12 col-xs-12 separador5   lineseparador-dot"> <?php echo $titular->last_name . " " . $titular->first_name . $accionesJugador; ?></div>
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <!--test
<div class="col-md-12 separador10-xs margen0l">
    <div class="col-md-12    margen0">
        <div class="panel-heading fondoazul">
            <h4 class="panel-title">
                Otros Partidos
            </h4>
        </div>
    </div>

    <div class="col-md-12   margen0      clearfix">
        <?php
    if (count($titularesLocal) > 0) {
        foreach ($titularesLocal as $titular) {
            if (!($titular->status == 1 || $titular->status == 3)) {
                ?>
                    <div
                        class="col-md-12 separador5   lineseparador-dot"> <?php echo $titular->last_name . " " . $titular->first_name; ?></div>
                <?php
            }
        }
    }
    ?>
    </div>
</div>
-->

    </div>


    <script>
        var idEquipo = "<?php echo $idEquipo; ?>";

    </script>
<?php
function accionJugador($titular)
{
    $accionesJugador = "";
    if (isset($titular->cambios)) {
        foreach ($titular->cambios as $cambio) {
            if ($titular->id == $cambio->in) {
                $accionesJugador .= ' <img  alt="Cambio - ' . $cambio->minute . '\'" src="http://www.futbolecuador.com/imagenes/icons/mccambio.png" title="Cambio - ' . $cambio->minute . '\'"> (' . $cambio->minute . '\')';
            }
            if ($titular->id == $cambio->out) {
                $accionesJugador .= ' <img  alt="Cambio - ' . $cambio->minute . '\'" src="http://www.futbolecuador.com/imagenes/icons/mccambio.png" title="Cambio - ' . $cambio->minute . '\'"> (' . $cambio->minute . '\')';
            }
        }
    }
    if (isset($titular->tarjetas)) {
        foreach ($titular->tarjetas as $tarjeta) {
            if ($tarjeta->type == 1)
                $accionesJugador .= ' <img  alt="Tarjeta Amarilla - ' . $tarjeta->minute . '\'" src="http://www.futbolecuador.com/imagenes/icons/tarjeta_amarilla2.png" title="Tarjeta Amarilla - ' . $tarjeta->minute . '\'"> (' . $tarjeta->minute . '\')';
            else
                $accionesJugador .= ' <img  alt="Tarjeta Roja - ' . $tarjeta->minute . '\'" src="http://www.futbolecuador.com/imagenes/icons/tarjeta_roja2.png" title="Tarjeta Roja - ' . $tarjeta->minute . '\'"> (' . $tarjeta->minute . '\')';
        }
    }
    return $accionesJugador;
}

?>