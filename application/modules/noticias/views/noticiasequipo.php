<?php if (isset($namesection)) {
    if ($namesection != "") {
        ?>
        <div class="col-md-12 separador20 margen0">
            <div class="panel-heading backcuadros">
                <h4 class="panel-title"><?php echo $namesection; ?></h4>
            </div>
        </div>
    <?php
    }
} ?>
<div class="row noticia-content">
    <?php
    foreach ($noticias as $indice => $noticia) {
        if ($indice == 0) {
            ?>
            <div class="col-md-6 separador10  noti   ">
                <?php echo $noticia ?>
            </div>
        <?php
        }
    }
    ?>
    <div class="col-md-6">
        <?php
        foreach ($noticias as $indice => $noticia) {
            if ($indice > 0) {
                if ($indice == 1)  ?>
                    <div class="col-md-12 separador5 <?php if ($indice != count($noticia) -1 ) echo 'lineseparador'; ?>">
                <?php echo $noticia ?>
                </div>
            <?php
            }
            ?>

        <?php
        }
        ?>
        <div class="col-md-12 text-right fondoazul separador10 masnoticias">
            <a href="<?php echo base_url() . 'site/' . $urlsecction. "/0"    ?>">Más noticias</a>
        </div>
    </div>
</div>
