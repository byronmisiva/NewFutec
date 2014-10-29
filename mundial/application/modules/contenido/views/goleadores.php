<!-- Goleadores  -->
<div class="col-md-12 separador">
    <div class="row main-goleadores">
        <div class="col-md-12 cabecera-partidos">
            <h2>
                <div class="iconos sprite-icono_goleadores"></div>
                Goleadores
            </h2>
        </div>
        <div class="col-md-12 gol-cabeza gris margen0">
            <div class="col-md-2 "></div>
            <div class="col-md-8 movi-headline-regular">Nombre</div>
            <div class="col-md-2 movi-headline-regular margen0 text-center">Goles</div>
        </div>
        <?php
        for ($i = 0; $i < 5; $i++) {
            ?>
            <div class="col-md-12 gol-cuerpo margen0">
                <div class="col-md-2 ">
                    <div class="iconos sprite-escudo-arg"></div>
                </div>
                <div class="col-md-8 ">Lionel Messi (Argentina)</div>
                <div class="col-md-2 margen0 text-center gris">7</div>
            </div>
        <?php
        } ?>
    </div>
    <div class="col-md-12 boton-more-fondo margen0">
        <a href="#" class="boton-more">Ver todos ></a>
    </div>
</div>
<!-- Fin  Goleadores  -->