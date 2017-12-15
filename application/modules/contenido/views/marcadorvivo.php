<div id="carousel-marcadorenvivo" class="carousel slide marcadorenvivofondo" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $active = " active";

        foreach ($scores as $score) {?>

            <div class="item <?php echo $active;
            $active = ""; ?>">
                <a href="<?= base_url() ?>site/partido/<?php echo  $this->contenido->_urlFriendly($score->hname) . "-" . $this->contenido->_urlFriendly($score->aname) . "/" . $score->id ; //. "/" . $score->championship_id; ?>">
                    <div class="  text-white">
                        <div class="col-md-12 col-sm-12 col-xs-12 margen0l margen0r   h5">
                            <div class="col-md-1 col-sm-1 col-xs-1 col-xs-1text-center  margen0">
                            </div>
                            <div class="col-md-1  col-sm-1 col-xs-1 margen0">
                                <img src="http://www.futbolecuador.com/<?php echo $score->hthumb; ?>"
                                     alt="<?php echo $score->hname; ?>">
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-8 margen0 h5" style="font-family: Arial;">
                                <?php
                                if (strlen($score->result) == 0) {
                                    $score->result = " - ";
                                    if ($score->state > 0) $score->result = "0 - 0";

                                };?>
                                <div class="col-md-5 col-sm-5 col-xs-5 margen0 h5 text-right" style="font-family: Arial;">
                                    <?php echo $score->hsname; ?>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2 margen0 h5  text-center text-marcador-home" style="font-family: Arial;">
                                    <?php
                                    //echo str_replace(' ', '', $score->result);
                                    echo   $score->result ; ?>
                                </div>
                                <div class="col-md-5 col-sm-5 col-xs-5 margen0 h5 text-left" style="font-family: Arial;">
                                    <?php echo $score->asname; ?>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 col-xs-1text-center margen0">

                                <img src="http://www.futbolecuador.com/<?php echo $score->athumb; ?>"
                                     alt="<?php echo $score->asname; ?>">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 col-xs-1text-center  margen0">
                            </div>
                        </div>
                        <!--<div class="col-md-5 col-md-offset-1 col-sm-6 col-xs-6 col-sm-offset-1 h6 text-blue1 margen0">
                            <p><?php echo $score->championship; ?></p>
                            <p><?php echo $active; ?> </p>
                        </div>-->
                        <!--<div class="col-md-5 col-sm-5 col-xs-5 h6  text-blue1">-->
                        <div class="col-md-12 col-sm-12 col-xs-12 h6  text-blue1 text-center" style="color:#ffffff;">
                            <p style="color:#ffffff;"> <?php setlocale(LC_ALL, "es_ES");
                                echo ucwords (utf8_encode(strftime("%B %d %Hh%M", strtotime($score->date_match))));?>
                            </p>
                            <!--<p><?php echo $active; ?>
                            <?php
                            $states = array(0 => 'No Iniciado', 1 => 'Primer Tiempo', 2 => 'Fin del Primer Tiempo', 3 => 'Segundo Tiempo', 4 => 'Fin del Segundo Tiempo',
                                    5 => 'Primer Extra', 6 => 'Segundo Extra', 7 => 'Penales', 8 => 'Final del Partido');
                                echo $states[$score->state];
                                    ?></p>-->
                        </div>

                        <div class="col-md-12 col-md-offset-0 col-sm-12 col-xs-12 col-sm-offset-1 h6 text-blue1 margen0">
                            
                        </div>
                    </div>
                </a>
            </div>

        <?php
        }
        ?>


    </div>
    <a class="left carousel-control" href="#carousel-marcadorenvivo" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-marcadorenvivo" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right mev"></span>
    </a>
</div>
