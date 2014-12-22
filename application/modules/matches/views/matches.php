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
<!--Tabla de posiciones-->
<div class="col-md-12 separador20 margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            <? echo $title; ?>
        </h4>
    </div>
    <div class="panel-group separador20" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $i = 1;
        foreach ($teamsFecha as $key => $teams) {

            ?>
            <div class="panel panel-default panel-no-border">
                <div class="panel-heading" role="tab" id="heading<?= $key ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>"
                           aria-expanded="true" aria-controls="collapse<?= $key ?>">
                            Fecha <?= $key ?>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?= $key ?>" class="panel-collapse collapse <? if ($i == 1) {
                    echo 'in';
                    $i = 0;

                }; ?>"
                     role="tabpanel"
                     aria-labelledby="heading<?= $key ?>">
                    <div class="panel-body margen0">
                        <?php
                        $i = 0;
                        foreach ($teams as $key => $team) {
                            if ($teams_pics['shield'][$team->hid] == "") $teams_pics['shield'][$team->hid] = "imagenes/teams/shield/default.png";
                            ?>
                            <div class="col-md-12 separador10 margen0  cabeceraequipo  fa-border ">
                                <a class="sidebarlink"
                                   href="<?= base_url('site/partido/' . $this->matches->_urlFriendly($team->hname) . '-' . $this->matches->_urlFriendly($team->aname) . '/' . $team->id) ?>">

                                    <div class="col-md-2 margen0 text-center ">
                                        <img
                                            src="http://www.futbolecuador.com/<?= $teams_pics['shield'][$team->hid]; ?>">
                                    </div>
                                    <div class="col-md-8 separador10 margen0    ">
                                        <div class="col-md-5 text-left nombre-equipo margen0 ">
                                            <?= $team->hname ?>
                                        </div>
                                        <div class="col-md-2 text-center margen0">
                                            <div class="col-md-12 text-center resultado-equipo margen0">
                                                <? echo ($team->result == "") ? "vs" : $team->result; ?>
                                            </div>
                                            <div class="col-md-12 text-center margen0 textos-equipo">
                                                <?= $estado[$team->state] ?>
                                            </div>
                                        </div>
                                        <div class="col-md-5 text-right nombre-equipo margen0">
                                            <?= $team->aname ?>
                                        </div>
                                        <div class="col-md-12 text-center textos-equipo">
                                            <?= $team->cn . " / " . $team->dm ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center margen0">
                                        <img
                                            src="http://www.futbolecuador.com/<?= $teams_pics['shield'][$team->aid]; ?>">
                                    </div>
                                </a>


                            </div>



                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

