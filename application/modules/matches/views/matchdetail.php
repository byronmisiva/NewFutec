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
    <div class="col-md-12   margen0">
        <div class="panel-heading backcuadros auspicio marcador">
            <h1 class="tabla textomarcadorenvivo"><? echo $title; ?></h1>
        </div>
    </div>
    <!--El marcador-->
    <div class="panel-group separador10" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        foreach ($teamsFecha as $teams) {
            ?>
            <?php
            foreach ($teams as $team) {
                if ($teams_pics['shield'][$team->hid] == "") $teams_pics['shield'][$team->hid] = "imagenes/teams/shield/default.png";
                ?>
                <div class="col-md-12 col-xs-12 separador10 margen0  cabeceraequipo  fa-border clearfix">
                    <a class="sidebarlink"
                       href="<?= base_url('site/partido/' . $this->matches->_urlFriendly($team->hname) . '-' . $this->matches->_urlFriendly($team->aname) . '/' . $team->id) ?>">

                        <div class="col-md-2 col-xs-1 margen0 text-center ">
                            <img class="img-responsive-xs"
                                 src="http://www.futbolecuador.com/<?= $teams_pics['shield'][$team->hid]; ?>"
                                 alt="<?= $team->hname ?>" title="<?= $team->hname ?>">
                        </div>
                        <div class="col-md-8 col-xs-10   margen0    ">
                            <div class="col-md-12 col-xs-12   margen0    ">
                                <div class="col-md-5 col-xs-5 text-left nombre-equipo margen0 ">
                                    <?= $team->hname ?>
                                </div>
                                <div class="col-md-2 col-xs-2 text-center margen0">
                                    <div class="col-md-12 text-center resultado-equipo margen0">
                                        <? echo ($team->result == "") ? "vs" : $team->result; ?>
                                    </div>

                                </div>
                                <div class="col-md-5 col-xs-5 text-right nombre-equipo margen0">
                                    <?= $team->aname ?>
                                </div>
                            </div>
                            <div class="matchdetailestado col-md-12 col-xs-12 text-center textos-equipo clearfix">
                                <?php if (($cronometro['estado'] == 1) || ($cronometro['estado'] == 3) || ($cronometro['estado'] == 5) || ($cronometro['estado'] == 6)) {
                                    echo '<div class = "cronometro">' . $cronometro['minuto'] . ":" . $cronometro['segundo'] . " - " . $cronometro['tiempo'] . "</div>";

                                } else {
                                    echo $estado[$team->state];
                                }
                                ?>
                            </div>
                            <div class="col-md-12 col-xs-12 text-center textos-equipo clearfix">
                                <?php setlocale(LC_ALL, "es_ES");
                                echo ucwords(utf8_encode(strftime("%A, %d %B %Y, %HH%M", strtotime($team->dm))));?>

                            </div>
                        </div>
                        <div class="col-md-2 col-xs-1 text-center margen0">
                            <img class="img-responsive-xs"
                                 src="http://www.futbolecuador.com/<?php
                                 if ((isset($teams_pics['shield'][$team->aid])) or ($teams_pics['shield'][$team->aid] != "")) {
                                     echo $teams_pics['shield'][$team->aid];
                                 } else {
                                     echo "/imagenes/teams/shield/default.png";
                                 } ?>" alt="<?= $team->aname ?>" title="<?= $team->aname ?>">
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        <?php
        }
        ?>
    </div>

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
        <div class="col-md-12 col-xs-12  separador0 margen0">
            <?php echo $banner; ?>
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


    <div class="col-md-12 col-xs-12 separador10-xs margen0l">
        <div class="panel-heading fondoazul">
            <h4 class="panel-title">
                <a href="<?= base_url('site/marcadorenvivo') ?>">
                    Ir Listado Marcador en Vivo
                </a>

            </h4>
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
    <div class=" comentariosC col-xs-12 col-md-12 backcuadros block-title separador10">
        <h4 class="panel-title">Comentarios </h4>
    </div>

    <div class=" comentariosB separador10 col-xs-12 col-md-12 center-block" data-href="<?php //echo $url?>">
        <div class="fb-comments"
             data-href="<?php echo base_url() . "site/partido/" . $this->matches->_urlFriendly($teams[0]->hname) . "-" . $this->matches->_urlFriendly($teams[0]->aname) . "/" . $teams[0]->id ?>"
             data-width="100%" data-numposts="5"
             data-colorscheme="light"></div>
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