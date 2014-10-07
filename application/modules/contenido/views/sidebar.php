<div class="col-md-12 separador10">
    <img src="assets/dummys/redes-buscar.jpg">
</div>
<div class="col-md-12 separador10  margen0r">

    <div id="collapseTwo" class="panel-collapse collapse in">
        <div class="panel-body panel-body-clear-margin">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#proximafecha" role="tab"
                       data-toggle="tab">Próxima fecha</a></li>
                <li class="">
                    <a href="#resultados" role="tab"
                       data-toggle="tab">Resultados</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="proximafecha">
                    <div class="well well-sm">
                        <!--contenido colapsable-->
                        <div class="panel-group" id="accordion">
                            <?php
                            $active = "in";
                            foreach ($campeonatos as $campeonato) {
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $campeonato->shortname; ?>">
                                                <?php echo $campeonato->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>" class="panel-collapse collapse <?php echo $active;
                                    $active = ""; ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><?php if (count($resultado) >=2) echo $resultado[0];?><img
                                                                src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"><?php echo $partido->hname; ?>
                                                        </li>
                                                        <li class="list-group-item"><?php if (count($resultado) >=2)  echo $resultado[1];?><img
                                                                src="http://www.futbolecuador.com/<?php echo $partido->ashield; ?>"><?php echo $partido->aname; ?>
                                                        </li>
                                                    </ul>
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
                </div>
                <div class="tab-pane" id="resultados">
                    <div class="well well-sm">
                        <!--contenido colapsable-->
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">
                                            Collapsible Group Item #1
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne2" class="panel-collapse collapse in">
                                    <div class="panel-body panel-body-clear-margin">
                                        contenido 1
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2">
                                            Collapsible Group Item #2
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo2" class="panel-collapse collapse">
                                    <div class="panel-body panel-body-clear-margin">
                                        Cocntenido 2
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img src="assets/dummys/proxima-fecha.png">

</div>
<div class="col-md-12 separador10">
    <img src="assets/dummys/publi_300-250.jpg">
</div>
<div class="col-md-12 separador10">
    <img src="assets/dummys/tablaposiciones.jpg">
</div>