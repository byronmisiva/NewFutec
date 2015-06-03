<?php
$indice = 0;
foreach ($noticias as $noticia) {
    $findme = '<div class="noticia-img noticiarevista">';
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

            $paraTable = "6";

    } else {
        $validaInicio = substr($noticia, 0, 45);
        $validaInicio2 = substr($noticias[$indice - 1], 0, 45);
        $cadenaCompara = '<div class="margen0-xs clearfix news-detail">';

            $paraTable = "6";
    }
    ?>
    <div
        class="col-md-6 col-sm-6 col-xs-12 separador10 clearfix noti <?php if ($pos == 1) echo "noticia" ?>  ">
        <?php echo $noticia ?>
    </div>

    <?php
    if ($indice % 2 == 1) echo '</div>';
    $indice++;
}
//importante cuando no son par + 1 las noticias  se le cierra el div
if ($indice % 2 == 1) echo '</div>';
?>



