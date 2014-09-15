<div class="flexslider">
    <ul class="slides">
        <?php
        foreach ($query as &$dataimagen) {
            ?>
            <li data-thumb="<?php echo $dataimagen->thumbh80; ?>">
                <img src="<?php echo $dataimagen->thumb500; ?>"/>

                <div class="content-text-rotativas">
                    <div class="text-rotativas">
                        <h2><?php echo $dataimagen->title; ?></h2>

                        <h3><?php echo $dataimagen->subtitle; ?></h3>
                    </div>
                </div>
                <?php echo $dataimagen->id; ?>
            </li>
        <?php } ?>
    </ul>
</div>