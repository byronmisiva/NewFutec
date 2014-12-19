<!--Tabla de posiciones-->
<div class="col-md-12 separador20 margen0r">
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
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?= $key ?>">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>"
                           aria-expanded="true" aria-controls="collapse<?= $key ?>">
                            Fecha <?= $key . $i ?>
                        </a>
                    </h4>
                </div>
                <div id="collapse<?= $key ?>" class="panel-collapse collapse <? if ($i == 1) {
                    echo 'in';
                    $i = 0;

                }; ?>"
                     role="tabpanel"
                     aria-labelledby="heading<?= $key ?>">
                    <div class="panel-body">
                        <?php
                        $i = 0;
                        foreach ($teams as $key => $team) {
                            if ($teams_pics['shield'][$team->hid] =="") $teams_pics['shield'][$team->hid] = "imagenes/teams/shield/default.png";
                            ?><pre>
                            <div class="col-md-12 separador10 margen0r">
                                <div class="col-md-2">
                                    <img src="http://www.futbolecuador.com/<?= $teams_pics['shield'][$team->hid]; ?>">
                                </div>
                                <div class="col-md-3 text-left">
                                    <?= $team->hname ?>
                                </div>
                                <div class="col-md-2 text-center">
                                    <?= $team->result ?>
                                </div>
                                <div class="col-md-3 text-right">
                                    <?= $team->aname ?>
                                </div>
                                <div class="col-md-2 " >
                                    <img src="http://www.futbolecuador.com/<?= $teams_pics['shield'][$team->aid]; ?>" align="right">
                                </div>
                                <div class="col-md-12 text-center">
                                    <?= $team->cn . "/ " . $team->date_match ?>
                                </div>

                            </div>
                            </pre>



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

