<?php if (isset($namesection)) {
    if ($namesection != "") {
        ?>
        <div class="col-md-12 separador10-xs margen0">
            <div class="panel-heading backcuadros">
                <h4 class="panel-title"><?php echo $namesection; ?></h4>
            </div>
        </div>
    <?php
    }
} ?>
<?php
$indice = 0;
foreach ($noticias as $noticia) {

    $findme = '<div class="noticia-img">';
    $pos = strpos($noticia, $findme);
    $paraTable = "6";
    if ($indice % 2 == 0) {
        echo '<div class="row noticia-content">';
        $validaInicio = substr($noticia, 0, 45);
        if (isset ($noticias[$indice + 1]))
            $validaInicio2 = substr($noticias[$indice + 1], 0, 45);
        else
            $validaInicio2 = "";
        $cadenaCompara = '<div class="margen0-xs clearfix news-detail">';
        if (($validaInicio != $cadenaCompara) or ($validaInicio2 != $cadenaCompara))
            $paraTable = "12";
        else
            $paraTable = "6";

    } else {
        $validaInicio = substr($noticia, 0, 45);
        $validaInicio2 = substr($noticias[$indice - 1], 0, 45);
        $cadenaCompara = '<div class="margen0-xs clearfix news-detail">';
        if (($validaInicio != $cadenaCompara) or ($validaInicio2 != $cadenaCompara))
            $paraTable = "12";
        else
            $paraTable = "6";
    }


    ?>
    <div
        class="col-md-6 col-sm-<?= $paraTable ?> separador10 clearfix noti <?php if ($pos == 1) echo "noticia" ?> lineseparador">
        <?php echo $noticia ?>
    </div>
    <?php
    if ($indice % 2 == 1) echo '</div>';
    $indice++;
}
?>
<div class="noticiasextras">
</div>

<div class="col-md-12 text-right fondoazul separador10 masnoticias" offset="<?php echo rand() . "-" . $offset; ?>"
     section="<?php echo $idsection; ?>" pos="<?php echo $posSection; ?>">
    Más Noticias
</div>
