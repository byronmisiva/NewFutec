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


<div class="col-md-12 separador10-xs margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            <? echo $title; ?>
        </h4>
    </div>
    <div class="hidden-xs" id = "fechascalendario">
        <?php if (isset($teamsFecha)) {
            $fondogris = "texto-gris-strong";
            foreach ($teamsFecha as $key => $teams) {
                $totalTeams = count($teamsFecha);
                ?>
                <a class="sidebarlink" href="#<?= $key ?>">
                    <div class="fondogris borde separador10 text-center   miniletra <?php echo $fondogris; $fondogris = "texto-gris"; ?>"
                         style="width: <?= 100 / $totalTeams ?>%; float: left">
                        Fecha<br>

                        <div style="font-size: 13px"><?= $key ?></div>
                    </div>

                </a>
            <?php
            }
        } ?>
    </div>
</div>

<div class="panel-group separador10" id="accordion" role="tablist" aria-multiselectable="true">
    <?php
    $i = 1;
    if (isset($teamsFecha)) {
        foreach ($teamsFecha as $key => $teams) {

            ?>
            <div class="col-md-12 separador10">
                <a id="<?= $key ?>"></a>
            </div>
            <div class="col-md-12  fondoazul  separador20">
                <a id="<?= $key ?>"></a><h4 class="contenidos">Fecha <?= $key ?></h4>
            </div>
            <?php
            foreach ($teams as $key => $team) {
                if ($teams_pics['shield'][$team->hid] == "") $teams_pics['shield'][$team->hid] = "imagenes/teams/shield/default.png";
                ?>
                <div class="col-md-12 separador10 margen0  cabeceraequipo  fa-border clearfix">
                    <a class="sidebarlink"
                       href="<?= base_url('site/partido/' . $this->matches->_urlFriendly($team->hname) . '-' . $this->matches->_urlFriendly($team->aname) . '/' . $team->id) ?>">

                        <div class="col-md-2 col-xs-1 margen0 text-center ">
                            <img class="img-responsive-xs"
                                 src="<?= base_url($teams_pics['shield'][$team->hid]); ?>">
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
                                echo utf8_encode(strftime("%A, %d %B %Y %H:%M", strtotime($team->dm)));?>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-1 text-center margen0">
                            <img class="img-responsive-xs"
                                 src="<?= base_url($teams_pics['shield'][$team->aid]); ?>">
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        <?php
        }
    } else {
        echo "No existen partidos";
    } ?>

</div>

