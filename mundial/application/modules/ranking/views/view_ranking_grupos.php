<?php $this->load->module("partidos"); ?>
<div class="panel panel-default panel-calendario">
    <div class="panel-body">
        <div class="row">
            <!--Calendarios y Grupos-->
            <div class="col-md-12">


                <!-- Nav tabs -->
                <ul class="nav nav-tabs movi-headline-regular tab-calendario">
                    <li class="active"><a href="#calendario" data-toggle="tab">
                            Fase de Grupos</a></li>

                </ul>
                <div class="clearfix"></div>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="calendario">
                        <!--Genera la tabla de posiciones-->
                        <div class="rowmargen">
                            <?
                            foreach ($ranking as $rank) {
                                echo ' <div class="col-md-3 col-lg-3 col-sm-3 col-xs-6 grupohome">';
                                echo '<div class="col-md-12 movi-headline-regular cabecera-grupos1 margen5"><a href="'.base_url("site/grupos#") . strtolower($this->partidos->_clearStringGion($rank->nombre)) .'">' . $rank->nombre . '</a></div>';
                                ?>
                                <div class="col-md-12 movi-headline-regular cabecera-grupos2 margen5 ">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">Equipo</div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 pull-right"
                                             style="text-align:right">Puntos
                                        </div>
                                    </div>
                                </div>
                                <?php

                                //           foreach ($row->tabla as $equipo) {
                                foreach ($rank->tabla as $rankGroup) {
                                    ?>
                                    <div class="col-md-12 cuerpo">
                                        <div class="row">
                                            <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9  margen5">
                                                    <a href="<?php echo base_url('site/equipo') . '/'. $rankGroup->equipos_campeonato_id; ?>/<?php echo strtolower($this->partidos->_clearStringGion($rankGroup->name)) ?>" alt="<?php echo $rankGroup->name ?>" title="<?php echo $rankGroup->name ?>">
                                <span
                                    class="iconos sprite-<?php echo strtolower($this->partidos->_clearStringGion($rankGroup->name)) ?>"></span>
                                                    <?php echo (string)$rankGroup->short_name; ?>
                                                </a>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3 text-center  "
                                                 style="text-align:right"><?php echo $rankGroup->n_puntos; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                </div>

            </div>
            <!--Fin Calendarios y Grupos-->
        </div>
    </div>
</div>

<!--<div class="col-md-12 boton-more-fondo">
    <a href="<?php echo base_url("site/grupos");  ?>" class="boton-more">Ver detalles ></a>
</div>-->
<div class="clearfix"></div>
