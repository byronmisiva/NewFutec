<?php
$link = "noticialink-" . $story->id;
?>
<div class="col-md-12 col-xs-12 col-sm-12  margen0 col-xs-12 <?php echo $link; ?>">
    <div class="noticia-img">

        <img src="http://www.futbolecuador.com/<?php echo $story->thumb300; ?>"
             class="img-responsive lazy  "
             alt="<?php echo str_replace('"', '', "$story->title"); ?>"
             title="<?php echo str_replace('"', '', "$story->title"); ?>">

    </div>
</div>

<div class="col-md-11 col-xs-11 col-sm-11 margen0-xs  news-detail <?php echo $link; ?>">


    <div class="col-md-12 col-xs-12 margen0-noti column text-news-date  ">

        <?php setlocale(LC_ALL, "es_ES");
        echo ucfirst(strftime("%B %d %Y", strtotime($story->created))); ?>

    </div>
    <div class="col-md-12 col-xs-12 col-sm-12 margen0-noti column col-xs-10 ">
        <h2> <?php echo $story->title ?> </h2>
    </div>
    <?php
    if (strlen(strip_tags($story->lead)) == 0) {
        $num = 200;
        $str = strip_tags($story->body);
        $str = substr($str, 0, $num);
        $bodyCortado = substr($str, 0, -(strlen($str) - strrpos($str, ' ')));

        ?>
        <div class="col-md-12 col-xs-12  col-sm-12  margen0-noti col-xs-10  column mini-new-conten">
            <?php echo $bodyCortado . "..." ?>
        </div>
    <?php

    } else {
        ?>
        <div class="col-md-12 col-xs-12 col-sm-12 margen0-noti col-xs-10 column text-news-sub">
            <?php echo $story->subtitle ?>
        </div>

    <?php
    }?>
</div>

<div class="col-md-1 col-xs-1 col-sm-1 <?php echo $link; ?> ">
    <div class="noticias-mas"></div>
</div>

<div id="noticia-<?php echo $story->id ?>"  class="noticiafondo">
<div class="contnoticiarevista">
    <div class=""><h3><?php echo $story->title ?></h3></div>
    <?php setlocale(LC_ALL, "es_ES");
    echo ucfirst(strftime("%B %d %Y", strtotime($story->created))); ?>

    <div class=""><h2><?php echo $story->subtitle ?></h2></div>
    <div class=""><?php echo $story->title ?></div>
    <div class=""><?php echo $story->lead ?></div>
    <img src="http://www.futbolecuador.com/<?php echo $story->thumb300; ?>"
         class="img-responsive lazy  "
         alt="<?php echo str_replace('"', '', "$story->title"); ?>"
         title="<?php echo str_replace('"', '', "$story->title"); ?>">

    <div class=""><?php echo $story->body ?></div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.<?php echo $link; ?>').click(function (valor) {

            var myClass = this.className;
            var clases = myClass.split(" ");
            idnoticia = "noticia-" + clases[6].split("-")[1];
            $("#" +idnoticia).show();
        })
        $("#noticia-" + <?php echo  $story->id;?>).click (function(){
            $("#noticia-" + <?php echo  $story->id;?>).hide();
        })
    });
</script>


