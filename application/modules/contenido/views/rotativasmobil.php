<div class="flexslidermobile preloader " style="height: 348px; overflow: hidden">
    <ul class="slides ">
        <?php
        foreach ($rotativasData as &$rotativa) {
            $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($rotativa->title) . '/' . $rotativa->id;
            ?>
            <li data-thumb="http://www.futbolecuador.com/<?php echo $rotativa->thumbh80; ?>">
                <a href="<?php echo $link ?>">
                    <img src="http://www.futbolecuador.com/<?php echo $rotativa->thumb500; ?>"
                         alt="<?php echo str_replace('"', '', "$rotativa->title"); ?>"/>
                </a>

                <div class="content-text-rotativas">
                    <a href="<?php echo $link ?>">
                    <div class="text-rotativas">
                        <h2><?php echo $rotativa->title; ?> </h2>

                        <h3>
                             <?php echo $rotativa->subtitle; ?>
                        </h3>
                    </div>
                    </a>
                </div>

            </li>
        <?php } ?>
    </ul>
</div>