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
                    <img src="http://www.futbolecuador.com/<?php echo $noticia->thumb3; ?>" >
                </div>
                <div class="col-md-10  ">
                    <h2><?php echo $noticia->title; ?></h2>
                    <?php  if (strlen(strip_tags($noticia->lead))==0) echo cortarTexto (strip_tags($noticia->body), 100) . "..."; ?>
                    <?php echo strip_tags($noticia->lead); ?><br/>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<div class="col-md-12 text-right fondoazul separador10">
    Más noticias
</div>
<?php
function cortarTexto($str,$num)
{
$str = substr($str,0,$num);
return substr($str,0, -(strlen($str)-strrpos($str,' ')) );
}
?>