<div class="col-md-12 separador10">
    <img src="assets/dummys/redes-buscar.jpg">
</div>
<div class="col-md-12 separador10  margen0r lateral">

    <div id="collapseTwo" class="panel-collapse collapse in">
        <div class="panel-body panel-body-clear-margin">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#resultados" role="tab"
                       data-toggle="tab">Resultados</a></li>
                <li class="">
                    <a href="#proximafecha" role="tab"
                       data-toggle="tab">Próxima fecha</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="proximafecha">
                    <div class="well well-sm">
                        <!--contenido colapsable-->
                        <div class="panel-group" id="accordion1">
                            <?php
                            $active = "in";
                            foreach ($campeonatos as $campeonato) {
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1"
                                               href="#<?php echo $campeonato->shortname; ?>1">
                                                <?php echo $campeonato->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>1"
                                         class="panel-collapse collapse <?php echo $active;
                                         $active = ""; ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><?php if (count($resultado) >= 2) echo $resultado[0]; ?>
                                                            <img
                                                                src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"><?php echo $partido->hname; ?>
                                                        </li>
                                                        <li class="list-group-item"><?php if (count($resultado) >= 2) echo $resultado[1]; ?>
                                                            <img
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
                        <div class="panel-group" id="accordion2">
                            <?php
                            $active = "in";
                            foreach ($campeonatosResultados as $campeonato) {
                                ?>

                                <div class="panel panel-default panel-no-border">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion2"
                                               href="#<?php echo $campeonato->shortname; ?>">
                                                <?php echo $campeonato->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="<?php echo $campeonato->shortname; ?>"
                                         class="panel-collapse collapse <?php echo $active;
                                         $active = ""; ?>">
                                        <div class="panel-body panel-body-clear-margin">
                                            <?php
                                            foreach ($campeonato->partidos as $partido) {
                                                $resultado = explode("-", $partido->result);
                                                ?>
                                                <div class="panel panel-default">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><?php if (count($resultado) >= 2) echo $resultado[0]; ?>
                                                            <img
                                                                src="http://www.futbolecuador.com/<?php echo $partido->hshield; ?>"><?php echo $partido->hname; ?>
                                                        </li>
                                                        <li class="list-group-item"><?php if (count($resultado) >= 2) echo $resultado[1]; ?>
                                                            <img
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
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 separador10">
    <img src="assets/dummys/publi_300-250.jpg">
</div>
<!--Tabla de posiciones-->

<div class="col-md-12 separador10">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Tabla de posiciones
        </h4>
    </div>

    <div id="collapseTwo" class="panel-collapse collapse in tablaposiciones">
        <div class="panel-body panel-body-clear-margin">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#posiciones" role="tab"
                       data-toggle="tab">Posiciones</a></li>
                <li class="">
                    <a href="#acumulada" role="tab"
                       data-toggle="tab">Acumulada</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active panel-no-border" id="posiciones">
                    <? echo $scroreBoardSingle; ?>
                </div>
                <div class="tab-pane" id="acumulada">
                    <? echo $scroreBoardAcumulative; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 text-right fondoazul">
        Más detalles >
    </div>
</div>
<!--Fin Tabla de posiciones-->


<!--Goleadores-->

<div class="col-md-12 separador10">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Goleadores
        </h4>
    </div>
    <? echo $scroreBoardSingle; ?>

    <div class="col-md-12 text-right fondoazul">
        Más detalles >
    </div>
</div>
<!--Fin Tabla de posiciones-->