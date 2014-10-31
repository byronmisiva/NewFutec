<div class="panel-heading backcuadros">
    <h4 class="panel-title">
        <? echo $namesection; ?>
    </h4>
</div>

<div class="row">
    <?php foreach ($noticias as $noticia) {
        $link = base_url() . 'site/noticia/' . $this->contenido->_urlFriendly ($noticia->title) . '/' . $noticia->id;
        ?>
        <div class="col-md-12 lineseparador separador10">
            <div class="row">
                <div class="col-md-2 ">
                    <a href="<?php echo $link ?>"><img src="http://www.futbolecuador.com/<?php echo $noticia->thumb3; ?>" alt="<?php echo str_replace('"', '', "$noticia->title"); ?>"></a>
                </div>
                <div class="col-md-10  ">
                    <h2><a href="<?php echo $link ?>"><?php echo $noticia->title; ?></a></h2>
                    <?php echo '<a href="' . $link .  '" class="sidebarlink">' .strip_tags($noticia->lead) . "</a>"; ?>'
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<div class="col-md-12 text-right fondoazul separador10">
    Más noticias
</div>