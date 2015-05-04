<?php $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($noticia->title) . '/' . $noticia->id; ?>
<div class="row clearfix news-open separador10-xs noticiaabierta">
    <div class="col-md-12 ">
        <div class="col-md-7 margen10r">
            <div class="row">
                <img width="100%" height="100%" src="http://www.futbolecuador.com/imagenes/000295a9fc4f680acd3abcf5cc9a278e.png" style="position: absolute;">
                <img class="img-responsive margen10b margen10r margen0-xs"
                     src="http://www.futbolecuador.com/<?php echo $noticia->thumb400; ?>"
                     alt="<?php echo $noticia->image_name; ?>">
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
        <div class="col-md-5  col-xs-12">
            <div class="col-md-6 col-xs-4">
                <div class="fb-like"
                     data-href="<?= 'http://www.futbolecuador.com/site/noticia/interesante/' . $noticia->id; ?>"
                     data-send="false" data-layout="box_count" data-width="90" data-show-faces="false"
                     data-font="arial"></div>
            </div>
            <div class="col-md-6 col-xs-4">
                <a href="http://twitter.com/share" class="twitter-share-button"
                   data-url="http://en.fut.ec/?l=<?= $noticia->id; ?>" data-text="<?= $noticia->twitter; ?>"
                   data-count="vertical" data-via="futbolecuador" data-lang="es"
                   data-counturl="<?= $link; ?>">Tweet</a>
                <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
            </div>
            <div class="col-md-0 col-xs-4 visible-xs-block visible-xs-block">
                <!--        Tag para watsapp-->
                <a class='ssba'
                   data-action='share/whatsapp/share'
                   href='whatsapp://send?text= <?= $noticia->title ?> <?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3) . '/'. $noticia->id;  ?>'>
                    <img border='0' src='<?php echo base_url() ?>imagenes/moviles/boton-whatapp2.png'/></a>
            </div>
        </div>
        <div class="margen10lados-sx  separador5">
            <?php echo html_entity_decode($noticia->lead, ENT_COMPAT, 'UTF-8'); ?>
        </div>
        <div class="ebzNative"></div>
        <div class="margen10lados-sx noticia-body">
            <?php echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8'); ?>
        </div>
        <div class="margen10lados-sx noticia-body">
            <br/>
            <?php if (isset($autor[0]->twitter)){ ?>
                <a href="http://www.twitter.com/<?php echo $autor[0]->twitter; ?>"
                   target="_blank">@<?php echo $autor[0]->twitter; ?></a><br/>
            <?php }
            ?>
            <?php if (isset($autor[0]->mail)){ ?>
                <a href="mailto:<?php echo $autor[0]->mail; ?>"
                   target="_blank"><?php echo $autor[0]->mail; ?></a><br/>
            <?php }
            ?>
            <br/>
                <a href="<?php echo base_url() ."site/noticia/". $this->story->_urlFriendly($laVozDeLasTribunas[0]->title) ."/". $laVozDeLasTribunas[0]->id ?>">  <strong>La voz de las tribunas:</strong> <?php echo $laVozDeLasTribunas[0]->title; ?></a>

        </div>
    </div>
</div>
<div class="col-md-12 column content-gris hidden-xs">
    <div class="col-md-4 col-xs-4 column margen0 hidden">
        Lecturas <?php echo $noticia->lecturas; ?>
    </div>
    <div class="col-md-12 col-xs-12 column margen0 text-right text-news-zone">
        <?php foreach ($noticia->tags as $key => $tag) {
            echo $tag->name;
            if ($key < count($noticia->tags) - 1) echo ", ";
        } ?>
    </div>
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