<!--Tabla de Posiciones-->
<div class="col-md-12 separador10-xs margen0r">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Final Champions League
        </h4>
    </div>
    <?php if ($dispositivo == 1) {
    ?>
    <iframe frameborder="0" height="740" width="100%" marginheight="0" marginwidth="0" frameborder="no" scrolling="no" src="http://sportslive-feed.com.s3.amazonaws.com/futbolecuador/html/indexMobile.html"></iframe>
    <?php
} else {
        ?>
        <iframe frameborder="0" height="740" width="100%" marginheight="0" marginwidth="0" frameborder="no" scrolling="no" src="http://sportslive-feed.com.s3.amazonaws.com/futbolecuador/html/index.html#/live-e800865-ticker"></iframe>
    <?php
    }
    ?>
</div>

