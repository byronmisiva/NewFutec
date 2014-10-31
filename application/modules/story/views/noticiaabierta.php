<?php $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly($noticia->title) . '/' . $noticia->id; ?>
<div class="row clearfix news-open separador10 noticiaabierta">
    <div class="col-md-12 separador10">
        <div class="col-md-7 margen10r">
            <div class="row">
                <img class="img-responsive margen10b margen10r"
                     src="http://www.futbolecuador.com/<?php echo $noticia->thumb400; ?>"
                     alt="<?php echo $noticia->image_name; ?>">
            </div>
        </div>
        <?php setlocale(LC_ALL, "es_ES");
        echo $noticia->origen . ", " . date("l d F Y", strtotime($noticia->created)); ?>
        <h1><?php echo $noticia->title; ?></h1>

        <h2 class="gris sub"><?php echo $noticia->subtitle; ?></h2>

        <div class="fb-like" data-href="<?= 'http://www.futbolecuador.com/stories/publica/' . $noticia->id; ?>"
             data-send="false" data-layout="box_count" data-width="90" data-show-faces="false" data-font="arial"></div>

        <a href="http://twitter.com/share" class="twitter-share-button"
           data-url="http://en.fut.ec/?l=<?= $noticia->id; ?>" data-text="<?= $noticia->twitter; ?>"
           data-count="vertical" data-via="futbolecuador" data-lang="es"
           data-counturl="http://www.futbolecuador.com/stories/publica/<?= $noticia->id; ?>">Tweet</a>
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

        <?php echo html_entity_decode($noticia->lead, ENT_COMPAT, 'UTF-8'); ?>
        <?php echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8'); ?>
    </div>
</div>

<div class="col-md-12 column content-gris ">
    <div class="col-md-4 column margen0">
        <?php echo $noticia->lecturas; ?> lecturas
    </div>
    <div class="col-md-8 column margen0 text-right text-news-zone">
        <?php echo $noticia->tags[0]->name; ?>
    </div>
</div>

<div class="col-xs-12 col-md-12 backcuadros block-title">
    <h4 class="panel-title">Comentarios </h4>
</div>

<div class="margen0 col-xs-12 col-md-12 center-block" data-href="<?php //echo $url?>">
    <div class="fb-comments" data-href="<?php echo $link ?>" data-width="100%" data-numposts="5"
         data-colorscheme="light"></div>
</div>