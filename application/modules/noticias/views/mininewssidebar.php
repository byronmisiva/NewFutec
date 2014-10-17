<div class="panel-heading backcuadros">
    <h4 class="panel-title">
        <? echo $namesection; ?>
    </h4>
</div>
<?php foreach ($noticias as $noticia) {
?>
    <img src="http://www.futbolecuador.com/<?php echo $noticia->thumb3; ?>" class="img-responsive">
    <?php echo $noticia->title; ?><br/>
    <?php echo $noticia->lead; ?><br/>
<?php } ?>
<div class="col-md-12 text-right fondoazul separador10">
    Más noticias
</div>