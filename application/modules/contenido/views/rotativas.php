<div class="flexslider preloader " style="height: 348px; overflow: hidden">
    <ul class="slides ">
        <?php
        foreach ($rotativasData as &$rotativa) {
            ?>
            <li data-thumb="http://www.futbolecuador.com/<?php echo $rotativa->thumbh80; ?>">
                <img src="http://www.futbolecuador.com/<?php echo $rotativa->thumb500; ?>" alt="<?php echo str_replace('"', '', "$rotativa->title"); ?>"/>

                <div class="content-text-rotativas">
                    <div class="text-rotativas">
                        <h2><?php echo $rotativa->title; ?></h2>

                        <h3><?php echo $rotativa->subtitle; ?> <?php //todo link a noticia ?></h3>
                    </div>
                </div>

            </li>
        <?php } ?>
    </ul>
</div>
