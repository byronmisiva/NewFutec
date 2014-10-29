<?php
$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
?>
<!-- Listado de partidos del Día-->
<div class="col-md-12 margen0  separador panel-noticias" id="partidos-del-dia">
        <!-- Listado de partidos del Día-->

        <div class="col-md-12 margen0 ">
            <h2>
                <div class="iconos sprite-noticias"></div>
                <span class="col-md-9 margen0">Partidos de día</span><span class="col-md-3 pull-right margen0"> <?php
                    $partesFecha = explode('-', $fechas[0]->fecha);
                    echo $partesFecha[1] . "/" . $partesFecha[2];?></span>
            </h2>
            <hr class="cabecera">

        </div>
        <!-- Partido del Día-->



        <div class="panel-group" id="accordion">

            <div class="panel panel-default">
                <div class="panel-heading movi-headline-regular panel-minute">
                <?php
                $fechaTemp = "";
                $numero = 0;
                foreach ($fechas as $row) {
                    $fecha = $row->fecha;
                    ?>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margen0">
                        <a href="<?php echo base_url(); ?>site/calendario/<?php echo $fechas[0]->id; ?>#<?php echo ucfirst(strftime('%m-%d', strtotime($row->fecha))) ?>"
                           alt="<?php echo $row->nombre_local ?>"
                           title="<?php echo $row->nombre_local . " - " . $row->nombre_visitante ?>">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 margen0 cuerpo">
                                <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5 margen2">
                                    <span
                                        class="iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($row->nombre_local)) ?>"></span><?php echo $row->nombre_local ?>

                                </div>
                                <div class="col-md-2 col-lg-2 col-sm-2 col-xs-1 margen0 text-center ">
                                        <span class="right"><?php  echo $row->golesLocal ."-".  $row->golesVisitante;
                                             ?></span>
                                </div>
                                <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5   text-right margen0 ">

                                </span><?php echo $row->nombre_visitante ?>
                                <span
                                        class="iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($row->nombre_visitante)) ?>">
                                </div>
                                <div class="col-xs-1 margen0 text-right minitexto">
                                    <?php echo $row->hora ?>
                                </div>

                            </div>
                        </a>
                    </div>

                    <div class="clearfix"></div>
                <?php
                }
                ?>
            </div>
            </div>
        </div>

        <!-- Fin partido del Día-->
    <div class="col-md-12 boton-more-fondo">
        <a href="<?php echo base_url(); ?>site/calendario" class="boton-more">Calendario completo ></a>
    </div>
</div>
<!-- Listado de partidos del Día-->