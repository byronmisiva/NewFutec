<img src="http://www.futbolecuador.com/<?php echo $noticia->thumb400; ?>" alt="<?php echo $noticia->image_name; ?>">
<div class="row clearfix news-open">
    <div class="col-md-12 column text-news-date">
            <?php setlocale(LC_ALL, "es_ES");
            echo $noticia->origen . ", ".  date("l d F Y", strtotime($noticia->created)); ?>
    </div>
    <div class="col-md-12 column ">
       <h1><?php echo $noticia->title; ?></h1>
    </div>
    <div class="col-md-12 column ">
       <h2><?php echo $noticia->subtitle; ?></h2>
    </div>
    <div class="col-md-12 column ">


        <div class="fb-like" data-href="<?='http://www.futbolecuador.com/stories/publica/'.$noticia->id;?>" data-send="false" data-layout="box_count" data-width="90" data-show-faces="false" data-font="arial"></div>

        <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://en.fut.ec/?l=<?=$noticia->id;?>" data-text="<?=$noticia->twitter;?>" data-count="vertical" data-via="futbolecuador" data-lang="es" data-counturl="http://www.futbolecuador.com/stories/publica/<?=$noticia->id;?>">Tweet</a>
        <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

    </div>
    <div class="col-md-12 column ">
        <?php echo $noticia->lead; ?>
        <?php echo html_entity_decode($noticia->body, ENT_COMPAT, 'UTF-8'); ?>
    </div>
</div>

<div class="col-md-12 column content-gris ">
    <div class="col-md-4 column margen0">
        <?php echo $noticia->category_id; ?>
    </div>
    <div class="col-md-8 column margen0 text-right text-news-zone">
        <?php echo $noticia->tags[0]->name; ?>
    </div>
</div>




