<?php if (isset($tipoLink)) {
    if ($tipoLink == "secction") {
        $link = base_url() . 'site/' . $urlsecction . '/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
    } else {

    }
} else {
    $link = base_url() . 'site/noticia/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
}
?>


<div class="row clearfix news-detail">
    <div class="col-md-2 col-sm-3">
        <a href="<?php echo $link ?>"><img
                src="http://www.futbolecuador.com/<?php echo $story->thumbh50; ?>"
                alt="<?php echo str_replace('"', '', "$story->title"); ?>"
                title="<?php echo str_replace('"', '', "$story->title"); ?>"></a>
    </div>
    <div class="col-md-10 col-sm-9">
        <div class="col-md-12 column col-xs-12">
            <h2><a href="<?php echo $link ?>"><?php echo $story->title ?></a></h2>
        </div>

        <div class="col-md-12 col-xs-12 column text-news-sub">
            <a href="<?php echo $link ?>"> <?php echo $story->subtitle ?></a>
        </div>
    </div>


</div>


