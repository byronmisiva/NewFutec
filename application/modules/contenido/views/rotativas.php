<div class="flexslider" style="height: 369px; overflow: hidden">
    <ul class="slides">
        <?php
        foreach ($query as &$dataimagen) {
            ?>
            <li data-thumb="http://www.futbolecuador.com/<?php echo $dataimagen->thumbh80; ?>">
                <img src="http://www.futbolecuador.com/<?php echo $dataimagen->thumb500; ?>"/>

                <div class="content-text-rotativas">
                    <div class="text-rotativas">
                        <h2><?php echo $dataimagen->title; ?></h2>

                        <h3><?php echo $dataimagen->subtitle; ?> <?php echo $dataimagen->id; ?></h3>
                    </div>
                </div>

            </li>
        <?php } ?>
    </ul>
</div>
