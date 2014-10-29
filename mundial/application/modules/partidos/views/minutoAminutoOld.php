<?php
$this->load->module("partidos");
setlocale(LC_ALL, "es_ES");
?>
<div class="col-md-12 separador clearfix"></div>
<div class="btn-group btn-group-justified calendar-dia partidos-calendar">
    <div class="btn-group ">
        <a href="#" onclick="$('#06-12').animatescroll();">
            <button type="button" class="btn btn-default jueves active">12</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-13').animatescroll();">
            <button type="button" class="btn btn-default viernes active">13</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-14').animatescroll();">
            <button type="button" class="btn btn-default sabado active">14</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-15').animatescroll();">
            <button type="button" class="btn btn-default domingo active">15</button>
        </a>
    </div>

    <div class="btn-group">
        <a href="#" onclick="$('#06-16').animatescroll();">
            <button type="button" class="btn btn-default lunes active">16</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-17').animatescroll();">
            <button type="button" class="btn btn-default martes active">17</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-18').animatescroll();">
            <button type="button" class="btn btn-default miercoles active">18</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-19').animatescroll();">
            <button type="button" class="btn btn-default jueves active">19</button>
        </a>
    </div>

    <div class="btn-group">
        <a href="#" onclick="$('#06-20').animatescroll();">
            <button type="button" class="btn btn-default viernes active">20</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-21').animatescroll();">
            <button type="button" class="btn btn-default sabado active">21</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-22').animatescroll();">
            <button type="button" class="btn btn-default domingo active">22</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-23').animatescroll();">
            <button type="button" class="btn btn-default lunes active">23</button>
        </a>
    </div>

    <div class="btn-group">
        <a href="#" onclick="$('#06-24').animatescroll();">
            <button type="button" class="btn btn-default martes active">24</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-25').animatescroll();">
            <button type="button" class="btn btn-default miercoles active">25</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-26').animatescroll();">
            <button type="button" class="btn btn-default jueves active">26</button>
        </a>
    </div>
    <div class="btn-group">

        <button type="button" class="btn btn-default viernes">27</button>

    </div>

</div>


<div class="btn-group btn-group-justified calendar-dia partidos-calendar">
    <div class="btn-group">
        <a href="#" onclick="$('#06-28').animatescroll();">
            <button type="button" class="btn btn-default sabado active">28</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-29').animatescroll();">
            <button type="button" class="btn btn-default domingo active">29</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#06-30').animatescroll();">
            <button type="button" class="btn btn-default lunes active">30</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-01').animatescroll();">
            <button type="button" class="btn btn-default martes active">01</button>
        </a>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-default miercoles">02</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default jueves">03</button>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-04').animatescroll();">
            <button type="button" class="btn btn-default viernes active">04</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-05').animatescroll();">
            <button type="button" class="btn btn-default sabado active">05</button>
        </a>
    </div>

    <div class="btn-group">
        <a href="#" onclick="$('#07-06').animatescroll();">
            <button type="button" class="btn btn-default domingo active">06</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-07').animatescroll();">
            <button type="button" class="btn btn-default lunes active">07</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-08').animatescroll();">
            <button type="button" class="btn btn-default martes active">08</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-09').animatescroll();">
            <button type="button" class="btn btn-default miercoles active">09</button>
        </a>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-default jueves">10</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default viernes">11</button>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-12').animatescroll();">
            <button type="button" class="btn btn-default sabado  active">12</button>
        </a>
    </div>
    <div class="btn-group">
        <a href="#" onclick="$('#07-123').animatescroll();">
            <button type="button" class="btn btn-default domingo active">13</button>
        </a>
    </div>

</div>

<div class="clearfix"></div>
<div class="panel-group" id="accordion">
    <?php
    $fechaTemp = "";
    foreach ($partidos as $key => $partido) {
        $fecha = $partido->fecha;
        if ($fecha != $fechaTemp) {
            echo '<div class="col-md-12 separador"></div><div class="col-md-12 movi-headline-regular minuto-a-minuto-fecha" id="' . ucfirst(strftime('%m-%d', strtotime($partido->fecha))) . '"><a name="' . ucfirst(strftime('%m-%d', strtotime($partido->fecha))) . '">' .$this->partidos->_clearfecha(utf8_encode(ucfirst(strftime('%A %d de %b. %Y', strtotime($partido->fecha))))) . '</a></div>';
            $fechaTemp = $fecha;
        }
        ?>
        <?php $in = '' ?>
        <div class="panel panel-default">
            <div class="panel-heading movi-headline-regular panel-minute">
                <a data-toggle="collapse" data-parent="#accordion"
                   href="<?php echo '#partido' . $partido->id ?>"
                   name="<?php echo 'partido' . $partido->id ?>">
                    <div class="row minuto-header margen2">
                        <div class="col-md-9 col-xs-12">
                            <div class="row">
                                <div class="col-md-5  col-xs-5">
                                    <div class="row">
                                        <div class="col-md-2 col-xs-4 text-right margen0">
                                                    <span
                                                        class="sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ?>"></span>
                                        </div>
                                        <div class="col-md-10 col-xs-8 text-center margen0">
                                                        <span
                                                            class="margen5l"><a href="<?php echo base_url("site/equipo/".$partido->local. "/".strtolower($this->partidos->_clearStringGion($partido->nombre_local)) ) ?>"> <? echo $partido->nombre_local ?></a></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-2  col-xs-2 text-center margen0">
                                    <? //echo $partido->golesLocal . " - " .$partido->golesVisitante ?>
                                    <? echo " vs "; //todo aumentar cuando el marcador cambia    ?>
                                </div>
                                <div class="col-md-5  col-xs-5">
                                    <div class="row">
                                        <div class="col-md-10 col-xs-8 text-center margen0">
                                            <span
                                                class="left"><a href="<?php echo base_url("site/equipo/".$partido->visitante. "/".strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ) ?>"> <? echo $partido->nombre_visitante ?></a> </span>
                                        </div>
                                        <div class="col-md-2 col-xs-4 text-left margen0"><span
                                                class="right sprite-bandera-<?php echo strtolower($this->partidos->_clearStringGion($partido->nombre_visitante)) ?>"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12  col-xs-12 ">
                                    <div class="col-md-12 col-xs-12 text-center minuto-horario">
                                        <?php echo '<b>' . $partido->hora . '</b> - ' . $partido->estadio_nombre ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 partidos-calendar opciones deshabilitado">
                            <div class="row">

                                <div class="col-md-12 col-xs-12 text-right">
                                    <span class="iconos sprite-icono_video text-right"></span> Ver Video
                                </div>
                                <div class="col-md-12 col-xs-12 text-right">
                                    <span class="iconos sprite-icono_minutoaminuto text-right"></span> Minuto a minuto
                                </div>
                            </div>
                        </div>

                    </div>


                </a>
            </div>

            <?php if ($partidoOpen === FALSE) { ?>
                <?php if ($key == 0) { ?>
                    <?php $in = 'in' ?>
                <?php } ?>
            <?php
            } else {
                ?>
                <?php if ($partidoOpen == $partido['partidoResumen']->id) { ?>
                    <?php $in = 'in' ?>
                <?php } ?>
            <?php
            }
            /* ?>
            <div id="<?php echo 'partido' . $partido['partidoResumen']->id ?>"
                 class="panel-collapse collapse <?php echo $in; ?>">
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td><b>Alineaci&oacute;n</b></td>
                            <td>
                                <div class="text-right"><b>Alineaci&oacute;n</b></div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-md-6">
                                <table class="table table-striped">
                                    <?php $title = 0; ?>
                                    <? foreach ($partido['alineacion_local'] as $row) { ?>
                                        <?php if ($title == 11) { ?>
                                            <tr>
                                                <td colspan="3">
                                                    <b>Suplentes</b>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>
                                                <?php foreach ($row->eventos as $row2) { ?>
                                                    <? if ($row2['accion'] == 1) { ?>
                                                        <img
                                                            src="<?= base_url('imagenes/partido/c' . $row2['tipo'] . '.png') ?>"
                                                            title="<?= $row2['minuto'] . '\' ' . $row2['corto'] ?>"/>
                                                    <?php } ?>
                                                    <?php if ($row2['accion'] == 2) {
                                                        if ($row2['tipo'] == 2) {
                                                            $extra = 'Autogol - ';
                                                        } else {
                                                            $extra = '';
                                                        }?>
                                                        <img
                                                            src="<?= base_url() . 'imagenes/partido/g' . $row2['tipo'] . '.png' ?>"
                                                            title="<?= $extra . $row2['minuto'] . '\'' ?>"/>
                                                    <?php } ?>
                                                    <?php if ($row2['accion'] == 3) { ?>
                                                        <img
                                                            src="<?= base_url() . 'imagenes/partido/t' . $row2['tipo'] . '.png' ?>"
                                                            title="<?= $row2['minuto'] . '\'' ?>"/>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?= $row->corto ?>
                                            </td>
                                            <td>
                                                <?= $row->numero ?>
                                            </td>
                                        </tr>
                                        <?php $title = $title + 1; ?>
                                    <?php } ?>
                                </table>
                            </td>
                            <td class="col-md-6">
                                <table class="table table-striped">
                                    <?php $title = 0; ?>
                                    <? foreach ($partido['alineacion_visitante'] as $row) { ?>
                                        <?php if ($title == 11) { ?>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="text-right"><b>Suplentes</b></div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>
                                                <?= $row->numero ?>
                                            </td>
                                            <td>
                                                <div class="text-right"> <?= $row->corto ?></div>
                                            </td>
                                            <td>
                                                <?php foreach ($row->eventos as $row2) { ?>
                                                    <? if ($row2['accion'] == 1) { ?>
                                                        <img
                                                            src="<?= base_url() . 'imagenes/partido/c' . $row2['tipo'] . '.png' ?>"
                                                            title="<?= $row2['minuto'] . '\' ' . $row2['corto'] ?>"/>
                                                    <? } ?>
                                                    <?if ($row2['accion'] == 2) {
                                                        if ($row2['tipo'] == 2) {
                                                            $extra = 'Autogol - ';
                                                        } else {
                                                            $extra = '';
                                                        }?>
                                                        <img
                                                            src="<?= base_url() . 'imagenes/partido/g' . $row2['tipo'] . '.png' ?>"
                                                            title="<?= $extra . $row2['minuto'] . '\'' ?>"/>
                                                    <? } ?>
                                                    <? if ($row2['accion'] == 3) { ?>
                                                        <img
                                                            src="<?= base_url() . 'imagenes/partido/t' . $row2['tipo'] . '.png' ?>"
                                                            title="<?= $row2['minuto'] . '\'' ?>"/>
                                                    <? } ?>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <?php $title = $title + 1; ?>
                                    <?php } ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
          */
            ?>


        </div>
    <?php } ?>
</div>


