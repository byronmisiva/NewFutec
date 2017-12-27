<?php
$separador10 = "separador10-xs ";
    if (isset($extraheader)) {
        if ($extraheader == "no") {
            $separador10 = "";
        }
    }

    if (isset($namesection))
    {
        if ($namesection != "") 
        {?>
            <div class="col-md-12 <?php echo $separador10; ?> margen0 ">
                <div class="panel-heading backcuadros auspicio titular">
                    <h4 class="panel-title"><?php echo $namesection; ?></h4>
                </div>
            </div>
    <?php }
    }?>

<?php if(isset($marcador)){?>
            <?php echo $marcador?>
<?php }?>
<?php
$indice = 0;
foreach ($noticias as $noticia) {
    $findme = '<div class="noticia-img">';
    $pos = strpos($noticia, $findme);
    $paraTable = "6";

    if ($indice == 8) {
        if (isset($intermediaBanner))
            echo $intermediaBanner;
    }
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
//importante cuando no son par + 1 las noticias  se le cierra el div
if ($indice % 2 == 1) echo '</div>';
?>
<?php
if (isset($finalmediaBanner))
    echo $finalmediaBanner;
?>

<div class="noticiasextras">
</div>

<div class="col-md-12 text-right fondoazul separador10 masnoticias" offset="<?php echo rand() . "-" . $offset; ?>"
     urlSeccion="<?php echo (isset($urlsecction)) ? $urlsecction : ""; ?>"
     section="<?php echo (isset($idsection)) ? $idsection : ""; ?>"
     pos="<?php echo (isset($posSection)) ? $posSection : "1"; ?>">
    Más Noticias
</div>
