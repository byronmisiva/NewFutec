<?php
$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
?>
<div class="col-md-12 separador clearfix"></div>


<div class="panel-group" id="accordion">
    <?php
    $fechaTemp = "";
    $numpartido = 0;
    $imprime = 0;
    foreach ($partidos as $key => $partido) {
        switch ($numpartido) {
            case 0:
                $faseTexto =  "Octavos de final";
                $imprime = 1;
                break;
            case 8:
                $faseTexto =  "Cuartos de final";
                $imprime = 1;
                break;
            case 12:
                $faseTexto =  "Semifinal ";
                $imprime = 1;
                break;
            case 14:
                $faseTexto =  "Tercer puesto";
                $imprime = 1;
                break;
            case 15:
                $faseTexto =  "Final";
                $imprime = 1;
                break;
        }
        if ($imprime == 1){
        ?>
        <div class="col-md-12 movi-headline-regular cabecera-grupos1" id="grupo-a">
            <h2><?php echo $faseTexto; ?></h2>
        </div>
        <hr class="cabecera">
        <?php
            $imprime = 0;
        }
        $numpartido++;

        $fecha = $partido->fecha;
        if ($fecha != $fechaTemp) {
            echo '<div class="col-md-12 separador"></div><div class="col-md-12 movi-headline-regular minuto-a-minuto-fecha" id="' . ucfirst(strftime('%m-%d', strtotime($partido->fecha))) . '"><a name="' . ucfirst(strftime('%m-%d', strtotime($partido->fecha))) . '">' . $this->partidos->_clearfecha(utf8_encode(ucfirst(strftime('%A %d de %b. %Y', strtotime($partido->fecha))))) . '</a></div>';
            $fechaTemp = $fecha;
        }
        ?>
        <?php $in = '' ?>
        <div class="panel panel-default">
            <div class="panel-heading movi-headline-regular panel-minute">
                <a href="<?php echo base_url().'site/minutoAminutoPartido/'.$partido->id?>"  >
                    <div class="row minuto-header margen2">
                        <div class="col-md-9 col-xs-12">
                            <div class="row">
                                <div class="col-md-5  col-xs-5">
                                    <div class="row">
                                        <div class="col-md-2 col-xs-4 text-right margen0">
                                           <span
                                                class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                                        </div>
                                        <div class="col-md-10 col-xs-8 text-center margen0">
                                            <span
                                              class="margen5l"><a href="<?php echo base_url("site/equipo/".$partido->local. "/".strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ) ?>"> <? echo $partido->nombre_local ?></a></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-2  col-xs-2 text-center margen0">
                                    <?  echo $partido->golesLocal . " - " .$partido->golesVisitante ?>
                                    <?   //todo aumentar cuando el marcador cambia    ?>
                                </div>
                                <div class="col-md-5  col-xs-5">
                                    <div class="row">
                                        <div class="col-md-10 col-xs-8 text-center margen0">
                                            <span
                                             class="left"><a href="<?php echo base_url("site/equipo/".$partido->visitante. "/".strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ) ?>"> <? echo $partido->nombre_visitante ?></a> </span>
                                        </div>
                                        <div class="col-md-2 col-xs-4 text-left margen0">
                                            <span
                                            class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12  col-xs-12 ">
                                    <div class="col-md-12 col-xs-12 text-center minuto-horario">
                                        <div class="col-md-12 col-xs-6  margen0 text-center">
                                            <?php echo '<b>' . $partido->hora . '</b> - ' . $partido->estadio_nombre ?>
                                        </div>
                                        <div class="col-md-12 col-xs-6 text-right margen0 solomovil">
                                            <a href="<?php echo base_url(); ?>site/minutoAminutoPartido/<?php echo $partido->id; ?>">Minuto
                                                a minuto</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 partidos-calendar opciones deshabilitado">
                            <div class="row">

                                <div class="col-md-12 col-xs-12 text-right">
                                    <span class="iconos sprite-icono_video text-right"></span>
                                    <a href="<?php echo $partido->url; ?>" >Ver Video</a>
                                </div>
                                <div class="col-md-12 col-xs-12 text-right">
                                    <span class="iconos sprite-icono_minutoaminuto text-right"></span>
					 <a href="<?php echo base_url(); ?>site/minutoAminutoPartido/<?php echo $partido->id; ?>" >Minuto a minuto</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>

            </div>

            <?php if ($partidoOpen === FALSE) { ?>
                <?php if ($key == 0) { ?>
                    <?php $in = 'in' ?>
                <?php } ?>
            <?php
            } else {
                ?>
                <?php if ($partidoOpen == $partido['partidoResumen']->id) { ?>
                    <?php $in = 'in' ?>
                <?php } ?>
            <?php
            }
             ///inicio minuto a minuto
              ?>
        </div>
    <?php } ?>
</div>
