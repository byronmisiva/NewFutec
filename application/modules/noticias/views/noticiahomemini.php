<div class="noticia-img">
<img src="http://www.futbolecuador.com/<?php echo $story->thumb300 ?>" class="img-responsive" alt="<?php echo $story->title; ?>">
</div>
<div class="row clearfix news-detail">
    <div class="col-md-12 column text-news-date">
        <?php setlocale(LC_ALL,"es_ES");echo date("F d, Y", strtotime($story->created));   ?>
    </div>
    <div class="col-md-12 column ">
        <h2><?php echo $story->title ?></h2>
    </div>
    <div class="col-md-12 column text-news-sub">
        <?php echo $story->subtitle ?>
    </div>
    <div class="col-md-12 column mini-new-conten">
        <?php echo strip_tags($story->lead); ?>
    </div>

</div>
<div class="col-md-12 column content-gris ">
    <div class="col-md-4 column margen0">
        Lecturas <?php echo $story->lecturas ?>
    </div>
    <div class="col-md-8 column margen0 text-right text-news-zone">
        <?php echo $story->category ?>
    </div>
</div>