<div class="flexslider preloader " style="height: 348px; overflow: hidden">
    <ul class="slides ">
        <?php
        foreach ($rotativasData as &$rotativa) {
            $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($rotativa->title) . '/' . $rotativa->id;
            ?>
            <li style="height: 348px;" data-thumb="http://www.futbolecuador.com/<?php echo $rotativa->thumbh80; ?>">
                <a href="<?php echo $link ?>">
                    <img class="img" src="http://www.futbolecuador.com/<?php echo $rotativa->thumb500; ?>"
                         alt="<?php echo str_replace('"', '', "$rotativa->title"); ?>" style="height: 348px;" />
                </a>

                <div class="content-text-rotativas">
                    <a href="<?php echo $link ?>">
                        <div class="col-md-12 margen0 text-rotativas">
                            <div class="col-md-12 margen0">
                                <h2><?php echo $rotativa->title; ?> </h2>

                                <h3>
                                    <?php echo $rotativa->subtitle; ?>
                                </h3>
                            </div>
                            <!--<div class="col-md-1  margen0 text-right">
                                <img src="<?php /*echo 'assets/img/leer-mas-home.png' */?>"   />
                            </div>-->
                        </div>
                    </a>
                </div>

            </li>
        <?php } ?>
    </ul>
</div>
