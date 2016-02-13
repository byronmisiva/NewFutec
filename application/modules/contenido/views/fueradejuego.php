<!--Tabla de Posiciones-->
<div class="col-md-12 separador10-xs margen0r">
    <div class="panel-heading backcuadros">
        <h4 class="panel-title">
            Fuera de Juego
        </h4>
    </div>

    <div class="  ">
        <div class="linksFueraJuego col-md-12">
            <div class="controlfueraJuego"><img class="prev"
                                                src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/controls/left-fuera.jpg"
                                                width="18" heigth="115"/></div>
            <div class="otrasmodelos">
                <ul>
                    <?php for ($i = 24; $i >= 1; $i--) { ?>
                        <li style="list-style-type: none; float:left" class="galeria<?php echo $i ?>"><img
                                id="galeria<?php echo $i ?>"
                                src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria<?php echo $i ?>/1b.jpg"
                                width="110" heigth="140" alt="Modelo Futbol Ecuador"/></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="controlfueraJuego">
                <img class="next"
                     src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/controls/right-fuera.jpg"
                     width="18" heigth="115"/>
            </div>
            <!-- Feel free to load scripts in the footer -->
            <link rel="stylesheet" href="<?= base_url('assets/css/fueradejuego/liquid-slider.css') ?>"/>
            <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/fueradejuego/fueradejuego.css') ?>"/>
        </div>
        <?php slidemodelo2 (12 , 'Karen', 24, ' ' ) ; //15 ?>
        <?php slidemodelo(10, 'Karen', 23); ?>
        <?php slidemodelo(11, 'Karen', 22); ?>
        <?php slidemodelo(9, 'Karen', 21); ?>
        <?php slidemodelo(10, 'Karen', 20); ?>
        <?php slidemodelo(10, 'Karen', 19); ?>
        <?php slidemodelo(11, 'Karen', 18); ?>
        <?php slidemodelo(10, 'Karen', 17); ?>
        <?php slidemodelo(10, 'Karen', 16); ?>
        <?php slidemodelo(5, 'Karen', 15); ?>
        <?php slidemodelo(11, 'Karen', 14); //15?>
        <?php slidemodelo(11, 'Karen', 13); //16?>
        <?php slidemodelo(12, 'Karen', 12); ?>
        <?php slidemodelo(10, 'Paulina', 11); ?>
        <?php slidemodelo(10, 'Alisson Hidalgo', 10); ?>
        <?php slidemodelo(11, 'Angeles azules', 9); //13 ?>
        <?php slidemodelo(10, 'Michelle López', 8); ?>
        <?php slidemodelo(9, 'Diana Bastidas', 7); ?>
        <?php slidemodelo(11, 'Diana Bastidas', 6); ?>
        <?php slidemodelo(10, 'Diana Bastidas', 5); ?>
        <?php slidemodelo(10, 'Diana Bastidas', 4); ?>
        <?php slidemodelo(10, 'Diana Bastidas', 3); ?>
        <?php slidemodelo(12, 'Marcela Recalde', 2); ?>
        <?php slidemodelo(10, 'Diana Bastidas', 1); ?>
        <!--<div class="col-md-12 text-right fondoazul  ">
            Más hinchas
        </div> -->
        <div class="col-md-12 separador20">
            <a href="http://andresrodzap.wix.com/arzfotografia" target="_blank">
                <img src="http://www.futbolecuador.com/imagenes/fuera-de-juego/fotografo.png" class="img-responsive">
            </a>
        </div>
    </div>
</div>

<?php function slidemodelo($total, $nombre, $galeria, $lazo = 'lazo')
{ ?>
    <div class="containerfueradejuego galeria<?php echo $galeria; ?>content">
        <div class="liquid-slider" id="main-slider<?php echo $galeria; ?>">
            <?php for ($i = 1; $i <= $total; $i++) { ?>
                <div>
                    <h2 class="title hidden">
                        <div class="thum-fuera"><img class="img-responsive"
                                                     src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria<?php echo $galeria; ?>/<?php echo $i; ?>b.jpg"
                                                     alt=" "/></div>
                    </h2>
                    <img class="img-responsive <?php echo $lazo; ?>"
                         data-original="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria<?php echo $galeria; ?>/<?php echo $i; ?>a.jpg"
                         alt="<?php echo $nombre; ?>"/></div>
            <?php } ?>
        </div>
    </div>
<?php } ?>

<?php function slidemodelo2($total, $nombre, $galeria )
{ ?>
    <div class="containerfueradejuego galeria<?php echo $galeria; ?>content">
        <div class="liquid-slider" id="main-slider<?php echo $galeria; ?>">
            <?php for ($i = 1; $i <= $total; $i++) { ?>
            <div>
                <h2 class="title hidden">
                    <div class="thum-fuera"><img class="img-responsive"
                                                 src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria<?php echo $galeria; ?>/<?php echo $i; ?>b.jpg"
                                                 alt=" "/></div>
                </h2>
                <img class="img-responsive lazo"
                     src="<?= base_url() ?>imagenes/galerias-fuera-de-juego/galeria<?php echo $galeria; ?>/<?php echo $i; ?>a.jpg"
                     alt="<?php echo $nombre; ?>"/>
            </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
