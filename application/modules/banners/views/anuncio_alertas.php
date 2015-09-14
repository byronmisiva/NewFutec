<?php
$turno=rand (0 , 1 );
$url= array("http://push.futbolecuador.com","http://www.futbolecuador.com/fe-magazin");
?>
<style>
    .fondo-anuncio{
        background-color: #eaeaed;
        padding-bottom: 5px;
    }

    .contenedor-anuncio{
        background-color: #eaeaed;
        border-color: #e6e7e8;
        border-radius: 10px;
        margin-left: 18%;
        margin-top: 10px;
        width: 75%;
    }

    .contenedor-anuncio .col-md-8 p{
        color:#0f314a;
        margin-bottom: 5px !important;
    }

    .contenedor-anuncio .col-md-8 h2{
        color:#0f314a;
        margin-bottom: 5px !important;
    }

    .img-alertas{
        text-align: right;padding-top: 5px;width: 110px;width: 19%;
    }

    .img-fe{
        text-align: right;padding-top: 5px;width: 110px;
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
<a href="<?php echo $url[$turno]?>" target="_blank" class="col-md-12 fondo-anuncio">
    <div class="contenedor-anuncio">
        <?php if ($turno == 0){?>
            <div class="col-md-4 img-alertas" >
                <img src="<?php echo base_url()?>imagenes/anuncio/alertas.png" >
            </div>
            <div class="col-md-8 ">
                <h2>#AlertasFutbolecuador</h2>
                <p>Se el primero en leer las noticias de tu equipo favorito.</p>
                <p>Disponible para iOS y Android. Descárgala gratis aquí.</p>
            </div>
        <?php }else{?>
            <div class="col-md-4 img-fe" >
                <img src="<?php echo base_url()?>imagenes/anuncio/portada-revista_mini.png" width="70px" >
            </div>
            <div class="col-md-8">
                <p><h2>Futbolecuador Magazine</h2></p>
                <p>Encuentra toda la actualidad del fútbol nacional e internacional, en la revista digital de futbolecuador.com.</p>
                <p>Disponible para iOS y Android. Descárgala gratis aquí.</p>
            </div>
        <?php }?>
    </div>
</a>