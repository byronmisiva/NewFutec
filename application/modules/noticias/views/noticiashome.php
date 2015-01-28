<?php if (isset($namesection)) {
    if ($namesection != "") { ?>
<div class="col-md-12 separador10-xs margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title"><?php echo $namesection ; ?></h4>
    </div>
</div>
<?php }
    } ?>
<?php
$indice = 0;
foreach ($noticias as $noticia) {

$findme   = '<div class="noticia-img">';
$pos = strpos($noticia, $findme);

    if ($indice % 2 == 0) echo '<div class="row noticia-content">'; ?>
    <div class="col-md-6 col-sm-6 separador10 clearfix noti <?php if ($pos==1) echo "noticia" ?> lineseparador">
        <?php echo $noticia ?>
    </div>
    <?php
    if ($indice % 2 == 1) echo '</div>';
    $indice++;
}
?>
<div class="noticiasextras">
</div>

<div class="col-md-12 text-right fondoazul separador10 masnoticias"  offset="<?php echo rand() .  "-" .$offset  ;?>" section="<?php echo $idsection;?>" pos="<?php echo $posSection;?>">
    Más Noticias
</div>
