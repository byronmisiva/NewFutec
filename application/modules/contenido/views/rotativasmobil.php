<div class="flexslidermobile preloader " style=" height: 190px; overflow: hidden">
    <ul class="slides ">
        <?php
         $cont = 1;
        foreach ($rotativasData as &$rotativa) 
        {
        if ($cont == 5){?>
            <li style="height: 348px;position: relative;" data-thumb="http://www.futbolecuador.com/assets/img/icono-video.jpg">
                 <script src="//player.performgroup.com/eplayer.js#711e8a5ffd743a6badd37f21a2.1c09jd19fxf3oz6towba3lina" async></script>
            </li>
      <?php }
            else
            {
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
            }


            
        <?php } ?>
    </ul>
</div>
