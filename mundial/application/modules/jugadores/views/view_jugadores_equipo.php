<div class="col-md-12 margen0">
    <h2>
        <div class="iconos sprite-icono_jugador"></div>
        Plantilla Jugadores  
    </h2>
    <hr class= "cabecera">

</div>


<!-- Jugadores -->
<div id='modul_ranking_goleadores'>
    <!-- Goleadores  -->
    <div class="col-md-12 separador">
        <div class="row main-goleadores">


            <div class="col-md-6 gol-cabeza gris margen2">
                <div class="col-md-2 col-xs-2"><strong>#</strong></div>
                <div class="col-md-8 col-xs-8 "><strong>Nombre</strong></div>
                <div class="col-md-2  col-xs-2 margen0 text-center"><strong>POS</strong></div>
            </div>
            <div class="col-md-6 gol-cabeza gris margen2 main-goleadores-movi">
                <div class="col-md-2 col-xs-2"><strong>#</strong></div>
                <div class="col-md-8 col-xs-8 "><strong>Nombre</strong></div>
                <div class="col-md-2  col-xs-8 margen0 text-center"><strong>POS</strong></div>
            </div>
            <?php
            foreach ($jugadores as $jugador) {	
                ?>
                <div class="col-md-6 gol-cuerpo margen0">
                    <div class="col-md-2 col-xs-2 margen0 text-center "><?php echo $jugador->n_camiseta;?></div>
                    <div class="col-md-8 col-xs-8"><?php echo (string)$jugador->nombre." ".(string)$jugador->apellido;?></div>
                    <div class="col-md-2 col-xs-2 margen0 text-center "><?php echo (string)strtoupper(substr($jugador->posicion,0,3));?></div>
                </div>
            <?php
            } ?>
        </div>

    </div>
    <!-- Fin  Jugadores  -->
    
</div>
<div class="separador"></div>

