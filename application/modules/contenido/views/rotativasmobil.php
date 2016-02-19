<div class="flexslidermobile preloader " style=" height: 190px; overflow: hidden">
    <ul class="slides ">
        <?php
        foreach ($rotativasData as &$rotativa) {
            $linkbody = $rotativa->subtitle;
            if ($linkbody == "")
                $linkbody = $rotativa->title;
            $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($linkbody) . '/' . $rotativa->id;
            if (isset($rotativa->openseccion)) {
                if ($rotativa->openseccion != '')
                    $link = base_url() . $rotativa->openseccion;
            }
            ?>
            <li>
                <a href="<?php echo $link ?>">
                    <img class="img-responsive" src="http://www.futbolecuador.com/<?php echo $rotativa->thumb300; ?>"
                         alt="<?php echo str_replace('"', '', "$rotativa->title"); ?>"
                         title="<?php echo str_replace('"', '', "$rotativa->title"); ?>"/>
                </a>
                <div class="content-text-rotativas">
                    <a href="<?php echo $link ?>">
                    <div class="text-rotativas">
                        <h3><?php echo $rotativa->title; ?> </h3>
                    </div>
                    </a>
                </div>

            </li>
        <?php } ?>
    </ul>
</div>
