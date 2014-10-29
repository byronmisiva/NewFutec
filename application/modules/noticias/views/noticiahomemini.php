<?php $link = base_url() . 'site/noticia/' . $this->contenido->_clearStringGion($story->title) . '/' . $story->id; ?>
<div class="noticia-img">
    <a href="<?php echo $link ?>">
        <img src="http://www.futbolecuador.com/<?php echo $story->thumb300 ?>" class="img-responsive"
             alt="<?php echo str_replace('"', '', "$story->title"); ?>">
    </a>
</div>
<div class="row clearfix news-detail">
    <div class="col-md-12 column text-news-date">
        <a href="<?php echo $link ?>">
            <?php setlocale(LC_ALL, "es_ES");
            echo date("F d, Y", strtotime($story->created)); ?>
        </a>
    </div>
    <div class="col-md-12 column ">
        <h2><a href="<?php echo $link ?>"><?php echo $story->title ?></a></h2>
    </div>
    <div class="col-md-12 column text-news-sub">
        <a href="<?php echo $link ?>"> <?php echo $story->subtitle ?></a>
    </div>
    <div class="col-md-12 column mini-new-conten">
        <a href="<?php echo $link ?>"> <?php echo strip_tags($story->lead); ?></a>
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