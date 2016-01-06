<?php if (isset($tipoLink)) {
    if ($tipoLink == "secction") {
        $link = base_url() . 'site/' . $urlsecction . '/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
    } else {

    }
} else {
    $link = base_url() . 'site/noticia/' . $this->noticias->_urlFriendly($story->title) . '/' . $story->id;
}
?>
<li><strong><a href="<?php echo $link ?>"><?php echo $story->title ?></a></strong></li>




