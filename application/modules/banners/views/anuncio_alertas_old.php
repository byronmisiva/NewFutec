<?php
$turno = rand(0, 1);
// EN CASO QUE EL TAG SEA ALERTAS FUTBOL ECUADOR
if (isset($parametro)){
    if ($parametro== 1 ) $turno = 0;
}

$url = array("http://bit.ly/1Mpzlal", "http://bit.ly/1Y8AE15");
?>
<style>
    .fondo-anuncio {
        background-color: #eaeaed;
        padding-bottom: 5px;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .contenedor-anuncio {
        background-color: #eaeaed;
        border-color: #e6e7e8;
        border-radius: 10px;
        margin-left: 14%;
        margin-top: 10px;
        width: 85%;
    }

    .contenedor-anuncio .col-md-8 p {
        color: #0f314a;
        margin-bottom: 5px !important;
        font-size: 12px;
    }

    .contenedor-anuncio .col-md-8 h2 {
        color: #0f314a;
        margin-bottom: 5px !important;
    }

    .img-alertas {
        text-align: right;
        padding-top: 5px;
        width: 110px;
        width: 19%;
    }

    .img-fe {
        text-align: right;
        padding-top: 5px;
        width: 110px;
    }

    @media screen and (max-width: 775px) {
        .fondo-anuncio {
            background-color: #eaeaed !important;
            padding-bottom: 5px;
            width: 100%;
            height: auto;
            float: left;

        }

        .txt-alertas {
            width: 80% !important;
            float: left;
        }

        .img-alertas {
            float: left;
        }
    }

    @media screen and (max-width: 460px) {
        .contenedor-anuncio {
            background-color: #eaeaed;
            border-color: #e6e7e8;
            border-radius: 10px;
            display: inline-flex;
            margin-left: 0;
            margin-top: 10px;
            width: 100%;
        }

        .img-fe {
            padding-top: 15px;
        }

        .img-alertas {
            padding: 0;
            text-align: center;
            width: 19%;
        }
    }
</style>
<a href="<?php echo $url[$turno] ?>" target="_blank" class="col-md-12 fondo-anuncio">
    <div class="contenedor-anuncio">
        <?php if ($turno == 0) { ?>
            <div class="col-md-4 img-alertas">
                <img src="<?php echo base_url() ?>imagenes/anuncio/alertas.png">
            </div>
            <div class="col-md-8 txt-alertas">
                <h2>#AlertasFutbolecuador</h2>

                <p>Se el primero en leer las noticias de tu equipo favorito.</p>

                <p>Disponible para iOS y Android. Descárgala gratis aquí.</p>
            </div>
        <?php } else { ?>
            <div class="col-md-4 img-fe">
                <img
                    src="<?php echo base_url() ?>imagenes/anuncio/portada-revista_mini.png?refresh=<?php echo rand(10, 1000) ?>"
                    width="70px">
            </div>
            <div class="col-md-8">
                <p>

                <h2>Futbolecuador Magazine</h2></p>
                <p>Encuentra toda la actualidad del fútbol nacional e internacional, en la revista digital de
                    futbolecuador.com.</p>

                <p>Disponible para iOS y Android. Descárgala gratis aquí.</p>
            </div>
        <?php } ?>
    </div>
</a>
