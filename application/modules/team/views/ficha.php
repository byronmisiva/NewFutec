<!--ficha Equipo-->


<div class="col-md-12  fondoazul  separador10">
    <h4 class="contenidos">Perfil</h4>
</div>
<div class="row noticia-content">

    <div class="col-md-6 separador10     ">
        <div class="col-md-12 separador5   h3">
            <strong>PALMARÉS</strong>
        </div>
        <div class="col-md-12       ">
            <?php if (isset($infoEquipo->histories[0]->palmares)) { ?>
                <?php echo $infoEquipo->histories[0]->palmares; ?>
            <?php } ?>
        </div>
        <div class="col-md-12 separador5   h3 ">
            <strong>ESTADIO</strong>
        </div>
        <div class="col-md-12       ">
            <?php echo $infoEquipo->stadia[0]->name; ?>
        </div>

    </div>
    <div class="col-md-6 separador10     ">

        <div class="col-md-12 separador10">
            <?php if (isset($infoEquipo->team_pic)) { ?>
                <img src="http://www.futbolecuador.com/<?php echo $infoEquipo->team_pic; ?>"
                     class="img-responsive imagen-full" alt="Foto Equipo <?php echo $infoEquipo->name; ?>">
            <?php } ?>
        </div>
    </div>
</div>


<div class="col-md-12  fondoazul  separador10 ">
    <h4 class="contenidos">Partidos <?php echo $infoEquipo->name; ?></h4>
</div>

<?php
echo $fechas;
?>


<!--lsitado de jugadores -->
<div class="col-md-12 separador10 margen0">

    <div class="col-md-6 separador10 margen0">
        <div class="col-md-12  fondoazul ">
            <h4 class="contenidos">El Equipo </h4>
        </div>
        <div class="col-md-12  margen0 separador10 separador10r ">
        <div class="borde">
            <div class="col-md-6 col-xs-6 separador10    ">
                <?php if (isset($infoEquipo->shield)) { ?>
                    <img class="img-responsive imagen-full"
                         src="http://www.futbolecuador.com/<?php echo $infoEquipo->shield_big; ?>">
                <?php } ?>
            </div>
            <div class="col-md-5 col-xs-5 separador10   ">
                <?php if (isset($infoEquipo->shirt) and (strlen($infoEquipo->shirt) > 0)) { ?>
                    <img class="img-responsive imagen-full" src="<?php echo base_url($infoEquipo->shirt); ?>">
                <?php } ?>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-6 separador10 margen0 contenido">


        <div id="collapseOne" class="panel-collapse collapse in tablaposiciones">
            <div class="panel-body panel-body-clear-margin margen0">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li class="active quarter  text-center">
                        <a href="#arqueros" role="tab" data-toggle="tab">Arqueros</a></li>
                    <li class="quarter  text-center">
                        <a href="#defensas" role="tab" data-toggle="tab">Defensas</a></li>
                    <li class="quarter  text-center">
                        <a href="#volantes" role="tab" data-toggle="tab">Volantes</a></li>
                    <li class="quarter    text-center">
                        <a href="#delanteros" role="tab" data-toggle="tab">Delanteros</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active panel-no-border" id="arqueros">
                        <?php
                        foreach ($infoJugadoresEquipo['arqueros'] as $jugador) {
                            ?>
                            <div class="col-md-12 separador5  margen0 lineseparador-dot">
                                <?php
                                echo $jugador->last_name . ", " . $jugador->first_name; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="defensas">
                        <?php
                        foreach ($infoJugadoresEquipo['defensas'] as $jugador) {
                            ?>
                            <div class="col-md-12 separador5 margen0 lineseparador-dot">
                                <?php
                                echo $jugador->last_name . ", " . $jugador->first_name; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane panel-no-border" id="volantes">
                        <?php
                        foreach ($infoJugadoresEquipo['volantes'] as $jugador) {
                            ?>
                            <div class="col-md-12 separador5 margen0 lineseparador-dot">
                                <?php
                                echo $jugador->last_name . ", " . $jugador->first_name; ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="delanteros">
                        <?php
                        foreach ($infoJugadoresEquipo['delanteros'] as $jugador) {
                            ?>
                            <div class="col-md-12 separador5 margen0 lineseparador-dot">
                                <?php
                                echo $jugador->last_name . ", " . $jugador->first_name; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



