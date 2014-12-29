<?php if (isset($namesection)) {
    if ($namesection != "") { ?>
<div class="col-md-12 separador20 margen0">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title"><?php echo $namesection ; ?></h4>
    </div>
</div>
<?php }
    } ?>
<?php
$indice = 0;
foreach ($noticias as $noticia) {
    if ($indice % 2 == 0) echo '<div class="row noticia-content">'; ?>
    <div class="col-md-6 separador10  noticia lineseparador">
        <?php echo $noticia ?>
    </div>
    <?php
    if ($indice % 2 == 1) echo '</div>';
    $indice++;
}
?>
<div class="col-md-12 text-right fondoazul separador10 masnoticias">
    Más noticias
</div>
<div class="col-md-12  separador10">

</div>
