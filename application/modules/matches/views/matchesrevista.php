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
<!--Tabla de Posiciones-->


<div class="panel-group separador10" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $i = 1;
    if (isset($fechas)) {

        foreach ($fechas as $key => $team) {
            if ($team->hshield == "") $team->hshield = "imagenes/teams/shield/default.png";
            if ($team->ashield == "") $team->ashield = "imagenes/teams/shield/default.png";
            ?>

            <div class="col-md-12 separador10 margen0  cabeceraequipo  fa-border clearfix partidoblanco"
                 id="partido-<?= $team->id; ?>">

                <div class="col-md-2 col-xs-1 margen0 text-center ">
                    <img class="img-responsive-xs"
                         src="http://www.futbolecuador.com/<?= $team->hshield; ?>">
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
                    <div class="col-md-12 col-xs-12 text-center textos-equipo clearfix">
                        <?= $estado[$team->state] ?>
                    </div>
                    <div class="col-md-12 col-xs-12 text-center textos-equipo clearfix">
                        <?php setlocale(LC_ALL, "es_ES");
                        echo utf8_encode(strftime("%A, %d %B %Y %H:%M", strtotime($team->date_match)));?>
                    </div>
                </div>
                <div class="col-md-2 col-xs-1 text-center margen0">
                    <img class="img-responsive-xs"
                         src="http://www.futbolecuador.com/<?= $team->ashield; ?>">
                </div>
            </div>
            <div class="col-md-12 separador10 margen0  cabeceraequipo  fa-border clearfix partidoblanco detallepartido"
                 id="partido-detalle-<?= $team->id; ?>">
            </div>
            <script type="text/javascript">

                var cargamarcador;
                $(document).ready(function () {
                    $('#partido-<?= $team->id; ?>').click(function (valor) {
                        $('.detallepartido').html("Cargando");
                        $.post(baseUrl + "site/partidodata/partido/<?= $team->id; ?>", function (data) {
                            $('.detallepartido').hide();
                            $('.detallepartido').html("");
                            clearInterval(cargamarcador);

                            $('#partido-detalle-<?= $team->id; ?>').show();
                            $('#partido-detalle-<?= $team->id; ?>').html(data);
                        });

                        cargamarcador = setInterval(function () {
                            $.post(baseUrl + "site/partidodata/partido/<?= $team->id; ?>", function (data) {
                                $('#partido-detalle-<?= $team->id; ?>').html(data);
                            });
                        }, REFRESH_VIVO * 10000)

                    });

                });
            </script>

        <?php
        }
        ?>
    <?php

    } else {
        echo "No existen partidos";
    } ?>

</div>

