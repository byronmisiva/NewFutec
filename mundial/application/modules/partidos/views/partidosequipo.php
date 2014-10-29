<?php
$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
?>

<div class="col-md-12 margen0">
    <h2>
        <div class="iconos sprite-icono_partidos_blue"></div>
        Partidos
    </h2>
    <hr class="cabecera">

</div>

<div class="clearfix"></div>

<div class="panel-group azul">
    <?php
    foreach ($partidos as $key => $partido) {
        ?>
        <div class="panel panel-default clearfix">
            <div class="panel-heading movi-headline-regular panel-minute margen2">
                <div class="row minuto-header  azul">
                    <div class="col-md-9 col-xs-10">
                        <div class="row">




                            <div class="col-md-12 margen0 ">


                                    <div class="col-md-5 col-xs-5 text-center  margen0">
                                                    <span
                                                        class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                                                        <span
                                                            class="margen5l"><? echo $partido->nombre_local ?></span>
                                    </div>
                                    <div class="col-md-2 col-xs-2 text-center marcador margen0">
                                        <? echo $partido->golesLocal ?> - <? echo $partido->golesVisitante ?>
                                    </div>
                                    <div class="col-md-5 col-xs-5 text-center margen0">
                                            <span
                                                class="left"><? echo $partido->nombre_visitante ?></span>
                                            <span
                                                class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                                    </div>

                            </div>


                        </div>
                    </div>
                    <div class="col-md-3 col-xs-2 opciones">
                        <div class="row">
                            <div class="col-md-2 col-xs-0 margen0r ocultar">
                                <div class="iconos sprite-icono-informacion"></div>
                            </div>
                            <div class="col-md-10 col-xs-12 text-center minuto-horario-equipo margen0 ">
                                <?php echo '<span class="ocultar ">' . ucfirst(strftime('%d / %b - ', strtotime($partido->fecha))).  '</span><span class="">' . $partido->hora . '</span>';
                                echo '<span class=" col-xs-12 ocultar ">'.$partido->estadio_nombre. '</span>'  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
