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
        Redes
    </div>
    <div class="col-md-12 column ">
        <?php echo html_entity_decode($noticia->lead); ?>
        <?php echo html_entity_decode($noticia->body); ?>
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




