<div id="carousel-marcadorenvivo" class="carousel slide marcadorenvivofondo" data-ride="carousel">
    <div class="carousel-inner">
        <?php
            $active = " active";
            foreach ($scores as $score) {
                ?>
                <div class="item <?php echo $active; $active = ""; ?>">
                    <div class="row text-white">
                        <div class="col-md-12 text-center h5">
                            <img src="<?php echo $score->hthumb;?>">
                            <?php echo $score->hsname . " ". $score->result . " ". $score->asname ;?>
                            <img src="<?php echo $score->athumb;?>">
                        </div>
                        <div class="col-md-5 col-md-offset-1 h6 text-blue1">
                            <p><?php echo $score->championship;?></p>

                            <p><?php echo $active;?> </p>
                        </div>
                        <div class="col-md-5 h6  text-blue1">
                            <p> <?php setlocale(LC_ALL,"es_ES");echo date("F d H\hi", strtotime($scores[0]->date_match));?></p>
                            <p><?php echo $active;?><?php echo $score->state;?><?php echo $score->minute_match;?></p>
                        </div>
                    </div>
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