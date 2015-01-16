<?php if (isset($tipoLink)) {
    if ($tipoLink == "secction") {
        $link = base_url() . 'site/' . $urlsecction . '/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
    } else {

    }
} else {
    $link = base_url() . 'site/noticia/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
}
?>

<div class="margen0-xs clearfix news-detail">
    <div class="col-md-12  margen0 col-xs-2">
        <div class="noticia-img">
            <a href="<?php echo $link ?>">
                <img data-original="http://www.futbolecuador.com/<?php echo ($isMobile) ? $story->thumbh80:$story->thumb300; ?>"
                     class="img-responsive lazy"
                     alt="<?php echo str_replace('"', '', "$story->title"); ?>">
            </a>
        </div>
    </div>
    <div class="col-md-12 margen0 column text-news-date hidden-xs">
        <a href="<?php echo $link ?>">
            <?php setlocale(LC_ALL, "es_ES");
            echo strftime("%d %B %Y", strtotime($story->created)); ?>
        </a>
    </div>
    <div class="col-md-12 margen0 column col-xs-10 ">
        <h2><a href="<?php echo $link ?>"><?php echo $story->title ?></a></h2>
    </div>
    <?php
    if (strlen(strip_tags($story->lead)) == 0) {
        $num = 200;
        $str = strip_tags($story->body);
        $str = substr($str, 0, $num);
        $bodyCortado = substr($str, 0, -(strlen($str) - strrpos($str, ' ')));
        echo '<a href="' . $link . '" class="sidebarlink">' . '</a>';
        ?>
        <div class="col-md-12  margen0 col-xs-10  column mini-new-conten">
            <a href="<?php echo $link ?>"> <?php echo $bodyCortado . "..." ?></a>
        </div>
    <?php

    } else {
        ?>
        <div class="col-md-12 margen0 col-xs-10 column text-news-sub">
            <a href="<?php echo $link ?>"> <?php echo $story->subtitle ?></a>
        </div>
        <div class="col-md-12  margen0 column mini-new-conten hidden-xs">
            <a href="<?php echo $link ?>"> <?php echo strip_tags($story->lead); ?></a>
        </div>
    <?php
    }?>
</div>
<div class="col-md-12 column content-gris hidden-xs">
    <div class="col-md-4 column margen0">
        Lecturas <?php echo $story->lecturas ?>
    </div>
    <div class="col-md-8 column margen0 text-right text-news-zone">
        <?php echo $story->category ?>
    </div>
</div>