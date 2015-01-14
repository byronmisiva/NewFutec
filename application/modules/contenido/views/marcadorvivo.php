<div id="carousel-marcadorenvivo" class="carousel slide marcadorenvivofondo" data-ride="carousel">
    <div class="carousel-inner">
        <?php
        $active = " active";
        foreach ($scores as $score) {
            ?>

            <div class="item <?php echo $active;
            $active = ""; ?>">
                <a href="site/partido/<?php echo $score->hsname . "-" . $score->asname . "/" . $score->id; ?>">
                    <div class="  text-white">
                        <div class="col-md-12 margen0l margen0r   h5">
                            <div class="col-md-1 text-center  margen0">
                            </div>
                            <div class="col-md-1   margen0">
                                <img src="http://www.futbolecuador.com/<?php echo $score->hthumb; ?>"
                                     alt="<?php echo $score->hname; ?>">
                            </div>
                            <div class="col-md-8 margen0 h5">
                                <?php
                                if (strlen($score->result) == 0) {
                                    $score->result = " - ";
                                    if ($score->state > 0) $score->result = "0 - 0";

                                };?>
                                <div class="col-md-5 margen0 h5 text-right  ">
                                    <?php echo $score->hsname; ?>
                                </div>
                                <div class="col-md-2 margen0 h5  text-center text-marcador-home">
                                    <?php
                                    echo str_replace(' ', '', $score->result); ?>
                                </div>
                                <div class="col-md-5 margen0 h5 text-left  ">
                                    <?php echo $score->asname; ?>
                                </div>
                            </div>
                            <div class="col-md-1 text-center margen0">

                                <img src="http://www.futbolecuador.com/<?php echo $score->athumb; ?>"
                                     alt="<?php echo $score->asname; ?>">
                            </div>
                            <div class="col-md-1 text-center  margen0">
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1 h6 text-blue1 margen0">
                            <p><?php echo $score->championship; ?></p>

                            <p><?php echo $active; ?> </p>
                        </div>
                        <div class="col-md-5 h6  text-blue1">
                            <p> <?php setlocale(LC_ALL, "es_ES");
                                echo ucwords (  strftime("%B %d %Hh%M", strtotime($scores[0]->date_match)));?>
                            </p>
                            <p><?php echo $active; ?>
                                <?php
                                $states = array(0 => 'No Iniciado', 1 => 'Primer Tiempo', 2 => 'Fin del Primer Tiempo', 3 => 'Segundo Tiempo', 4 => 'Fin del Segundo Tiempo',
                                    5 => 'Primer Extra', 6 => 'Segundo Extra', 7 => 'Penales', 8 => 'Final del Partido');
                                echo $states[$score->state];?></p>
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