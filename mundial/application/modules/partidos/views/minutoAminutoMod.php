<!-- Partido on line-->
<?php
$this->load->module ("partidos");
foreach ($partidos as $key => $partido) {
    $partidoRef = $this->partidos->_clearStringGion($partido['partidoResumen']->local->nombre) . "-". $this->partidos->_clearStringGion($partido['partidoResumen']->visitante->nombre);
    ?>
    <a
       href="<?php echo base_url('site/minutoAminuto/' .$partidoRef  .  "/" . $partido['partidoResumen']->id) ?>">
        <div class="col-md-12 partido-on-line">
            <?= $partido['partidoResumen']->estadoDescripcion . ' | ' . strftime('%d %b %H:%M', $partido['partidoResumen']->fechas) ?>
        </div>

        <div class="col-md-12  ">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5 partido-on-line partido-on-line-cuerpo margen2">
                                <span
                                    class="iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido['partidoResumen']->local->nombre)) ?>"></span>
                    <? echo $partido['partidoResumen']->local->nombre ?>
                </div>
                <div
                    class="col-md-2 col-lg-2 col-sm-2 col-xs-2 partido-on-line partido-on-line-cuerpo partido-on-line-centro text-center">
                    <? echo $partido['partidoResumen']->glocal ?> - <? echo $partido['partidoResumen']->gvisitante ?>
                </div>
                <div
                    class="col-md-5 col-lg-5 col-sm-5 col-xs-5 pull-right partido-on-line partido-on-line-cuerpo margen2 text-right">
                        <span class="margen5r"><? echo $partido['partidoResumen']->visitante->nombre ?></span><span
                        class="iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($partido['partidoResumen']->visitante->nombre)) ?>"></span>
                </div>
            </div>
        </div>
    </a>
<?php } ?>
<!-- Fin Partido on line-->
