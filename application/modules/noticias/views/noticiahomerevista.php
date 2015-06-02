<?php
$linkbody = $story->subtitle;
if ($linkbody == "")
    $linkbody = $story->title;
if (isset($tipoLink)) {

    if ($tipoLink == "secction") {
        $link = base_url() . 'site/' . $urlsecction . '/' . $this->noticias->_urlFriendly($linkbody) . '/' . $story->id;
    } else {

    }
} else {
    $link = base_url() . 'site/noticia/' . $this->noticias->_urlFriendly($linkbody) . '/' . $story->id;
}
?>
<div class="col-md-12 col-xs-12 col-sm-12  margen0 col-xs-12">
    <div class="noticia-img">
        <a href="<?php echo $link ?>">
            <img src="http://www.futbolecuador.com/<?php echo $story->thumb300; ?>"
                 class="img-responsive lazy  "
                 alt="<?php echo str_replace('"', '', "$story->title"); ?>" title="<?php echo str_replace('"', '', "$story->title"); ?>">
        </a>
    </div>
</div>

<div class="col-md-11 col-xs-11 col-sm-11 margen0-xs  news-detail">


    <div class="col-md-12 col-xs-12 margen0-noti column text-news-date  ">
        <a href="<?php echo $link ?>">
            <?php setlocale(LC_ALL, "es_ES");
            echo ucfirst(strftime("%B %d %Y", strtotime($story->created))); ?>
        </a>
    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 margen0-noti column col-xs-10 ">
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
        <div class="col-md-12 col-xs-12  col-sm-12  margen0-noti col-xs-10  column mini-new-conten">
            <a href="<?php echo $link ?>"> <?php echo $bodyCortado . "..." ?></a>
        </div>
    <?php

    } else {
        ?>
        <div class="col-md-12 col-xs-12 col-sm-12 margen0-noti col-xs-10 column text-news-sub">
            <a href="<?php echo $link ?>"> <?php echo $story->subtitle ?></a>
        </div>

    <?php
    }?>
</div>

<div class="col-md-1 col-xs-1 col-sm-1 ">
    <div class="noticias-mas"></div>
</div>
