<div class="panel-heading backcuadros">
    <h4 class="panel-title">
        <? echo $namesection; ?>
    </h4>
</div>

<div class="row">
    <?php foreach ($noticias as $noticia) {
        ?>
        <div class="col-md-12 lineseparador separador10">
            <div class="row">
                <div class="col-md-2 ">
                    <img src="http://www.futbolecuador.com/<?php echo $noticia->thumb3; ?>" alt="<?php echo str_replace('"', '', "$noticia->title"); ?>">
                </div>
                <div class="col-md-10  ">
                    <h2><?php echo $noticia->title; ?></h2>
                    <?php echo strip_tags($noticia->lead); ?><br/>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<div class="col-md-12 text-right fondoazul separador10">
    Más noticias
</div>