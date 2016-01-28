<?php $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($noticia->title) . '/' . $noticia->id; ?>
<div class="row clearfix news-open separador10-xs noticiaabierta">
    <div class="col-md-12 ">
        <div class="col-md-7 margen10r">
            <div class="row">
                <img width="100%" height="100%"
                     src="http://www.futbolecuador.com/imagenes/000295a9fc4f680acd3abcf5cc9a278e.png"
                     style="position: absolute;">
                <img class="img-responsive margen10b margen10r margen0-xs"
                     src="http://www.futbolecuador.com/<?php echo $noticia->thumb400; ?>"
                     alt="<?php echo $noticia->image_name; ?>">
                <?php echo $bannerTop; ?>
            </div>
        </div>
        <div class="margen10lados-sx fechaabierta">
            <?php setlocale(LC_ALL, "es_ES");
            echo $noticia->origen . ", " . ucwords(utf8_encode(strftime("%A %d %B %Y, %HH%M", strtotime($noticia->created)))); ?>
            <h2 class="h2noticiaabierta  "><?php echo $noticia->title; ?></h2>
        </div>
        <div class="margen10lados-sx">
            <h1 class="gris sub margen10lados-sx"><?php echo $noticia->subtitle; ?></h1>
        </div>
        <div class="col-md-5  col-xs-12 margen0">

            <div class="col-md-12 col-xs-12 margen0">                
                    <div class="col-md-6 col-xs-4">
                        <div class="fb-like"
                             data-href="<?= 'http://www.futbolecuador.com/site/noticia/interesante/' . $noticia->id; ?>"
                             data-send="false" data-layout="box_count" data-width="90" data-show-faces="true"
                             data-font="arial"></div>
                    </div>
                    <div class="col-md-6 col-xs-4 separadortw">
                        <a href="http://twitter.com/share" class="twitter-share-button"
                           data-url="http://en.fut.ec/?l=<?= $noticia->id; ?>" data-text="<?= $noticia->twitter; ?>"
                           data-count="vertical" data-via="futbolecuador" data-lang="es"
                           data-counturl="<?= $link; ?>">Tweet</a>
                        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                    </div>
                
                <div class="col-md-0 col-xs-4 visible-xs-block margen0  ">
                    <!--        Tag para watsapp-->
                    <a class='ssba'
                       data-action='share/whatsapp/share'
                       href='whatsapp://send?text= <?= $noticia->title ?> <?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) . '/' . $noticia->id; ?>'>
                        <img border='0' src='<?php echo base_url() ?>imagenes/moviles/boton-whatapp2.png'/></a>
                </div>
            </div>
            <!-- Botones para redireccionar descarga aplicacion alertas -->
            <!--  <div class="col-md-12 col-xs-7   margen0">
                <div class="col-md-0 col-xs-6   margen0">
                    <a target="_blank" href="https://itunes.apple.com/app/id1008177383"
                       onclick="ga('send', 'event', 'btn-ios','click','push');"><img class="img-responsive"
                                                                                     src="<?php echo base_url() ?>imagenes/moviles/ios.png"
                                                                                     id="btn-ios"> </a>
                </div>
                <div class="col-md-0 col-xs-6   margen0">
                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.misiva.futbolecuadorpush"
                       onclick="ga('send', 'event', 'btn-android','click','push');"><img class="img-responsive"
                                                                                         src="<?php echo base_url() ?>imagenes/moviles/android.png"
                                                                                         id="btn-android"> </a>
                </div>
            </div>-->
        </div>
        <div class="margen10lados-sx  separador5">
            <?php echo html_entity_decode($noticia->lead, ENT_COMPAT, 'UTF-8'); ?>
        </div>
        <div class="ebzHere"></div>
        <?php if (!strpos($noticia->body, "Lee la noticia completa en")) {
            ?>
            <div class="banerintermedio">
                <?php echo $banerintermedio; ?>
            </div>

        <?php }
        ?>
        <div class="margen10lados-sx noticia-body">
            <?php echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8'); ?>
        </div>

        <?php if (strpos($noticia->body, "Lee la noticia completa en")) {
            ?>
            <div class="banerintermedio">

                <?php echo $banerintermedio; ?>
            </div>

        <?php }
        ?>
        <?php if ( strlen ( $tagsStorys ) >3) {?>

        <div class="col-md-12 column content-gris ">
                Leer también
        </div>
        <div class="col-xs-12 col-md-12 margen0 separador10 tagstorys">
            <?php echo $tagsStorys; ?>
        </div>

        <?php } ?>

        <div class="margen10lados-sx noticia-body separador10 col-xs-12 col-md-12 ">
            <br/>
            <?php if (isset($autor[0]->twitter)) { ?>
                <a href="http://www.twitter.com/<?php echo $autor[0]->twitter; ?>"
                   target="_blank">@<?php echo $autor[0]->twitter; ?></a><br/>
            <?php }
            ?>
            <?php if (isset($autor[0]->mail)) { ?>
                <a href="mailto:<?php echo $autor[0]->mail; ?>"
                   target="_blank"><?php echo $autor[0]->mail; ?></a><br/>
            <?php }
            ?>

            <a href="<?php echo base_url() . "site/noticia/" . $this->story->_urlFriendly($laVozDeLasTribunas[0]->title) . "/" . $laVozDeLasTribunas[0]->id ?>">
                <strong>La voz de las tribunas:</strong> <?php echo $laVozDeLasTribunas[0]->title; ?></a>

            <!-- Link para redirecionar a push.futbolecuador.com -->
            <!-- <a href="http://push.futbolecuador.com/">
                ¿Querías ser el primero en leer esta noticia? Descarga ya <strong>#Alertas</strong>FutbolEcuador y recibe inmediatamente las alertas de tu equipo favorito.
            </a> -->
            <br/>
        </div>
    </div>
</div>
<div class="col-md-12 column content-gris hidden-xs">
    <div class="col-md-4 col-xs-4 column margen0 hidden">
        Lecturas <?php echo $noticia->lecturas; ?>
    </div>
    <div class="col-md-12 col-xs-12 column margen0 text-right text-news-zone">
        <?php foreach ($noticia->tags as $key => $tag) {
            echo "<a href=" .base_url() . "site/tags/" . $this->story->_urlFriendly($tag->name) .">" .$tag->name  . "</a>";
            if ($key < count($noticia->tags) - 1) echo ", ";
        } ?>
    </div>
</div>


<div class="col-xs-12 col-md-12 margen0">
    <?php echo $bannerBottom; ?>
</div>
<div class="col-xs-12 col-md-12 backcuadros block-title separador10">
    <h4 class="panel-title">Comentarios </h4>
</div>
<div class="separador10 col-xs-12 col-md-12 center-block" data-href="<?php //echo $url?>">
    <div class="fb-comments" data-href="<?php echo $link ?>" data-width="100%" data-numposts="5"
         data-colorscheme="light"></div>
</div>
<script>
    setTimeout(function () {
        $.post(baseUrl + "site/setloc/<?php echo  $noticia->id;?>");
    }, 2500)
</script>