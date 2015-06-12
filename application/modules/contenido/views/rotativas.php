<div class="flexslider preloader " style="height: 348px; overflow: hidden">
    <ul class="slides ">
        <?php

        foreach ($rotativasData as &$rotativa) {
            $linkbody = $rotativa->subtitle;
            if ($linkbody == "")
                $linkbody = $rotativa->title;

            if (isset($linkseccion))
            $link = base_url() . 'site/'.$linkseccion.'/' . $this->contenido->_urlFriendly($linkbody) . '/' . $rotativa->id;
            else
            $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($linkbody) . '/' . $rotativa->id;
            ?>
            <li style="height: 348px;" data-thumb="http://www.futbolecuador.com/<?php echo $rotativa->thumbh80; ?>">
                <a href="<?php echo $link ?>">
                    <img width="100%" height="100%" src="http://www.futbolecuador.com/imagenes/000295a9fc4f680acd3abcf5cc9a278e.png" style="position: absolute;">
                    <img class="img" src="http://www.futbolecuador.com/<?php echo $rotativa->thumb500; ?>"
                         alt="<?php echo str_replace('"', '', "$rotativa->title"); ?>" title="<?php echo str_replace('"', '', "$rotativa->title"); ?>" style="height: 348px;" />
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
