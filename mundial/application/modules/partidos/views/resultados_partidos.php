<?php
$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
?>
<div class="col-md-12 separador"></div>
<div class="row separador sin-padding-laterales">
    <div class="col-md-12 cabecera-minuto sin-padding-laterales">
        <div class="flotar_iz  movi-headline-regular minutotitulo"><h2>Minuto a Minuto</h2></div>
    </div>
</div>

<div class="row separadorTop sin-padding-laterales" id="partidoMinuto">
<div class="col-md-12 sin-padding-laterales">
<div class="row">
    <div class="col-md-12  minuto-a-minuto-fecha"
         id="<?php echo trim(ucfirst(strftime("%b%d", strtotime($registro->fecha)))) ?>">
        <?php echo ucfirst(strftime("%b %d", strtotime($registro->fecha))) ?></div>
</div>

<!-- <div class="panel-heading panel-minute">
	<div class="row minuto-header">
		<div class="col-md-12">
			<div
				class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_local)) ?> bandera-calendario">
			</div>
			<div class="nombre-calendario"><?php echo $registro->nombre_local ?></div>
			<div class="marcador-calendario"><?php echo $registro->resultado ?></div>
			<div class="right nombre-calendario"><?php echo $registro->nombre_visitante ?></div>
			<div
				class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_visitante)) ?> bandera-calendario">
			</div>
			<div class="col-md-12 minuto-horario detalle-calendario"><?php echo $registro->nombre_estadio; ?>
			</div>
		</div>
	</div>
</div>-->

<div class="row minuto-header margen2">
    <div class="col-md-12 col-xs-12">
        <div class="row">
            <div class="col-md-5  col-xs-5">
                <div class="row">
                    <div class="col-md-2 col-xs-4 text-right margen0"><span
                            class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_local)) ?>"></span>
                    </div>
                    <div class="col-md-10 col-xs-8 text-center margen0 " style="color:#095A7C;"><span class="margen5l">
					<?php echo $registro->nombre_local ?></span></div>
                </div>
            </div>
            <div class="col-md-2  col-xs-2 text-center margen0"><?php echo $registro->resultado ?>
                <? //todo aumentar cuando el marcador cambia    ?></div>
            <div class="col-md-5  col-xs-5">
                <div class="row">
                    <div class="col-md-10 col-xs-8 text-center margen0" style="color:#095A7C;"><span class="margen5l">
					<?php echo $registro->nombre_visitante ?></span></div>
                    <div class="col-md-2 col-xs-4 text-left margen0"><span
                            class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($registro->nombre_visitante)) ?>"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-12  col-xs-12 ">
                <div
                    class="col-md-12 col-xs-12 text-center minuto-horario"><?php echo '<b>' . date("H:m:s", strtotime($registro->fecha)) . '</b> - ' . $registro->nombre_estadio ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row sin-padding-laterales">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-12 separador"></div>

            <div class="col-md-12 cabecera-minutoaminuto titulo-alinear-izq movi-headline-regular"
                 style="color:#095A7C;">
                Comentarios
            </div>
            <div class="col-md-12 comentarios"
                 id="comentarios"><?php foreach ($comentarios as $row) { ?>
                    <div class="row">
                        <div class="col-md-1 col-xs-2"><?php echo $row->tiempo ?></div>
                        <div class="col-md-11 col-xs-10"><?php echo $row->comentario ?></div>
                    </div>
                <?php } ?></div>
        </div>

    </div>

</div>

<div class="row separadorTop margen0">
    <div class="col-md-5 col-xs-6 ">
        <div class="row sin-padding-laterales">
            <div class="col-md-12 col-xs-12 cabecera-minutoaminuto">

                <span class="titulo-alinear-izq movi-headline-regular "
                      style="color:#095A7C;">Goles <?php echo $registro->nombre_local ?></span>
            </div>
            <div
                class="col-md-12 col-xs-12 texto-minuto "><?php foreach ($goles_local as $row) { ?>
                    <div class="col-md-8 col-xs-10"><?php echo $row->corto; ?></div>
                    <div class="col-md-4 col-xs-2"><?php echo $row->minuto ?></div>
                <?php } ?></div>
        </div>

    </div>
    <div class="col-md-2 col-xs-0"></div>
    <div class="col-md-5 col-xs-6 ">
        <div class="row">
            <div class="col-md-12 col-xs-12 cabecera-minutoaminuto">
                <span class="titulo-alinear-izq movi-headline-regular"
                      style="color:#095A7C;">Goles <?php echo $registro->nombre_visitante ?></span>
            </div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($goles_visitante as $row) { ?>
                    <div class="col-md-8 col-xs-10"><?php echo $row->corto; ?></div>
                    <div class="col-md-4 col-xs-2"><?php echo $row->minuto ?></div>
                <?php } ?></div>
        </div>
    </div>
</div>

<div class="row separadorTop sin-padding-laterales">
    <div class="col-md-5 col-xs-6 sin-padding-laterales">
        <div class="row sin-padding-laterales">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto">
                <span class="titulo-alinear-izq movi-headline-regular" style="color:#095A7C;">Tarjetas</span></div>
            <div
                class="col-md-12 col-xs-12 margen0 texto-minuto"><?php foreach ($tarjetas_local as $row) { ?>
                    <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto; ?></div>
                    <div class="col-md-2 col-xs-2 margen0 "><?php echo $row->minuto ?></div>
                    <div class="col-md-2 col-xs-2 margen0 ">
                        <div class="tarjeta-<?php echo strtolower($row->tipo_tarjeta) ?>"></div>
                    </div>
                <?php } ?></div>
        </div>
    </div>
    <div class="col-md-2 col-xs-0"></div>
    <div class="col-md-5 col-xs-6  sin-padding-laterales">
        <div class="row sin-padding-laterales">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto">
                <span class="titulo-alinear-izq movi-headline-regular movi-headline-regular" style="color:#095A7C;">Tarjetas</span>
            </div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($tarjetas_visitante as $row) { ?>
                    <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto; ?></div>
                    <div class="col-md-2 col-xs-2 margen0 "><?php echo $row->minuto ?></div>
                    <div class="col-md-2 col-xs-2 margen0 ">
                        <div class="tarjeta-<?php echo strtolower($row->tipo_tarjeta) ?>"></div>
                    </div>
                <?php } ?></div>
        </div>
    </div>
</div>

<div class="row separadorTop sin-padding-laterales">
    <div class="col-md-6 col-xs-5 ">
        <div class="row">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto  margen0 titulo-alinear-izq movi-headline-regular"
                style="color:#095A7C;">
                Alineación <?php echo $registro->nombre_local ?></div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($alineacion_local as $row) {
                    if (strtolower($row->posicion) != "reserva" && strtolower($row->posicion) != "entrenador") {
                        ?>
                        <div class="col-md-2 col-xs-2 margen0 "><?php foreach ($cambios_local as $cambio) {
                                if ($cambio->sale_id == $row->jugadores_id) {
                                    ?>
                                    <div class="sale"></div>
                                <?php
                                }
                            }
                            ?></div>
                        <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto ?></div>
                        <div class="col-md-2 col-xs-2 margen0 "><?php echo $row->numero ?></div>
                    <?php
                    }

                }?></div>
        </div>
    </div>
    <div class="col-md-0 col-xs-2"></div>
    <div class="col-md-6 col-xs-5  margen0 ">
        <div class="row">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto titulo-alinear-izq movi-headline-regular"
                style="color:#095A7C;">
                Alineación <?php echo $registro->nombre_visitante ?></div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($alineacion_visitante as $row) {

                    if (strtolower($row->posicion) != "reserva" && strtolower($row->posicion) != "entrenador") {
                        ?>
                        <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto ?></div>
                        <div class="col-md-2 col-xs-2 margen0 "><?php echo $row->numero ?></div>
                        <div class="col-md-2 col-xs-2 margen0 "><?php foreach ($cambios_visitante as $cambio) {
                                if ($cambio->sale_id == $row->jugadores_id) {
                                    ?>
                                    <div class="sale"></div>
                                <?php
                                }
                            }?></div>
                    <?php
                    }
                }?></div>
        </div>
    </div>
</div>

<div class="row separadorTop sin-padding-laterales">
    <div class="col-md-5 col-xs-6 ">
        <div class="row">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto titulo-alinear-izq movi-headline-regular"
                style="color:#095A7C;">
                Reservas <?php echo $registro->nombre_local ?></div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($alineacion_local as $row) {
                    if (strtolower($row->posicion) == "reserva" && strtolower($row->posicion) != "entrenador") {
                        ?>
                        <div class="col-md-2 col-xs-2 margen0 "><?php foreach ($cambios_local as $cambio) {
                                if ($cambio->entra_id == $row->jugadores_id) {
                                    ?>
                                    <div class="entra"></div>
                                <?php
                                }
                            }?></div>
                        <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto ?></div>
                        <div class="col-md-2 col-xs-2 margen0 "><?php echo $row->numero ?></div>
                    <?php
                    }
                }?></div>
        </div>
    </div>
    <div class="col-md-2 col-xs-0"></div>
    <div class="col-md-5 col-xs-6 ">
        <div class="row">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto titulo-alinear-izq movi-headline-regular"
                style="color:#095A7C;">
                Reservas <?php echo $registro->nombre_visitante ?></div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($alineacion_visitante as $row){
                if (strtolower($row->posicion) == "reserva" && strtolower($row->posicion) != "entrenador"){
                ?>
                <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto ?></div>
                <div class="col-md-2 col-xs-2 margen0 "><?php echo $row->numero ?></div>
                <div class="col-md-2 col-xs-2 margen0 "
                " ><?php foreach ($cambios_visitante as $cambio)
                    if ($cambio->entra_id == $row->jugadores_id) {
                        ?>
                        <div class="entra"></div>
                    <?php } ?></div>
            <?php
            }
            }?></div>
    </div>
</div>
</div>
<div class="row separadorTop sin-padding-laterales">
    <div class="col-md-5 col-xs-6 ">
        <div class="row">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto titulo-alinear-izq movi-headline-regular"
                style="color:#095A7C;">
                Entrenador <?php echo $registro->nombre_local ?></div>
            <div
                class="col-md-12 col-xs-12  margen0 texto-minuto"><?php foreach ($alineacion_local as $row) {
                    if (strtolower($row->posicion) == "entrenador") {
                        ?>
                        <div class="col-md-2 col-xs-12 margen0 " id="jugador-<?php echo $row->id ?>"></div>
                        <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto ?></div>
                    <?php
                    }
                }?></div>
        </div>
    </div>
    <div class="col-md-2 col-xs-0"></div>
    <div class="col-md-5 col-xs-6 ">
        <div class="row">
            <div
                class="col-md-12 col-xs-12 cabecera-minutoaminuto titulo-alinear-izq movi-headline-regular"
                style="color:#095A7C;">
                Entrenador <?php echo $registro->nombre_visitante ?></div>
            <div
                class="col-md-12 col-xs-12 texto-minuto"><?php foreach ($alineacion_visitante as $row) {
                    if (strtolower($row->posicion) == "entrenador") {
                        ?>
                        <div class="col-md-8 col-xs-8 margen0 "><?php echo $row->corto ?></div>

                        <div class="col-md-2 col-xs-2 margen0 "></div>
                    <?php
                    }
                }?></div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    var accion = "<?php echo base_url('site/ajxminutoaminuto/'.$registro->id)?>"
    var coment = "<?php echo base_url('site/ajxcomentario/'.$registro->id)?>"
    var myVar;
    var cargaContenedor;
    function inicio() {
        myVar = setTimeout(reloadView, 50000);
    }
    ;

    function comments() {
        cargaContenedor = setInterval(reloadComentario, 5000);
    }
    ;

    function limpiarSettime() {
        clearTimeout(myVar);
    }
    ;

    function reloadView() {
        $("#partidoMinuto").load(accion);
    }
    ;

    function reloadComentario() {
        $("#comentarios").load(coment);
    }
    ;

    inicio();
    comments();


</script>
