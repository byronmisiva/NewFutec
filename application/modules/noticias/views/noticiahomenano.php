<?php if (isset($tipoLink)) {
    if ($tipoLink == "secction") {
        $link = base_url() . 'site/' . $urlsecction . '/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
    } else {

    }
} else {
    $link = base_url() . 'site/noticia/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
}
// caso abre seccion
if (isset($story->openseccion)) {
    if ($story->openseccion != '')
    $link = base_url() . $story->openseccion;
}
?>
<div class="row clearfix news-detail">
    <div class="col-md-12 column text-news-date hidden-xs">
        <a href="<?php echo $link ?>">
            <?php setlocale(LC_ALL, "es_ES");
            echo strftime("%d %B %Y", strtotime($story->created)); ?>
        </a>
    </div>
    <div class="col-md-12 column col-xs-12">
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
    <?php

    } else {
        ?>
        <div class="col-md-12 col-xs-12 column text-news-sub">
            <a href="<?php echo $link ?>"> <?php echo $story->subtitle ?></a>
        </div>
    <?php
    }?>

</div>
