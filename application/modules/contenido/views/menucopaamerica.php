<div class="navbar-header hidden-xs" style="padding-left: 60px;">
    <a href="<?php echo base_url('copa-america') ?>" class=""
       onclick="ga('send', 'event', 'menu', 'click', 'home');"><img src="<?= base_url('assets//img/logo-copa-america-mini.png') ?>"
                                                                    alt="FutbolEcuador"
                                                                    width="220"
                                                                    title="Lo mejor del futbol ecuatoriano"
                                                                    class=" media-object">
    </a>
</div>
<!-- end navbar-header -->
<div class="navbar-collapse collapse hidden-xs">
    <ul class="nav navbar-nav">
        <!-- list elements -->
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('home') ?>" class="pull-left">
                <div class="logofutbolecuadormini"></div>
            </a>
            <!-- dropdown-menu -->
        </li>
        <!-- mega menu -->
        <li class="dropdown fhmm-fw"><a href="#" data-toggle="dropdown"
                                        class="dropdown-toggle">Equipos<b
                    class="caret"></b></a>
            <ul class="dropdown-menu fullwidth">
                <li class="fhmm-content withoutdesc">
                    <div class="row">
                        <?php for ($i = 0; $i < 4; $i++) {
                            $desp = 3;
                            $separador = ($i < 3) ? 'separador-dotted' : '';
                            $nombreEquipo1 = $teams[$i * $desp]['name'];
                            $nombreEquipo2 = $teams[$i * $desp + 1]['name'];
                            $nombreEquipo3 = $teams[$i * $desp + 2]['name'];

                            //caso nombre muy largo en menu
                            $nombreEquipo1 = ($nombreEquipo1 == "Universidad Católica de Quito") ? 'U. Católica de Quito' : $nombreEquipo1;
                            $nombreEquipo2 = ($nombreEquipo2 == "Universidad Católica de Quito") ? 'U. Católica de Quito' : $nombreEquipo2;
                            $nombreEquipo3 = ($nombreEquipo3 == "Universidad Católica de Quito") ? 'U. Católica de Quito' : $nombreEquipo3;

                            ?>
                            <div class="col-sm-3 <?php echo $separador ?>">
                                <ul class="menu-option">
                                    <li class="clearfix">
                                        <a href="<?= base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$i * $desp]['name'])) . "/" . $teams[$i * $desp]['section']) . '/' . $campeonato ?>">
                                            <div style="float: left">
                                                <img
                                                    src="http://www.futbolecuador.com/<?php echo $teams[$i * $desp]['thumb_shield']; ?>"
                                                    alt="<?php $teams[$i * $desp]['thumb_shield']; ?>">
                                            </div>


                                            <div class="menu-name"><?php echo $nombreEquipo1 ?></div>
                                            <div
                                                class="menu-points text-right"><?php //echo $teams[$i * $desp]['points'] . " pts"?>

                                            </div>
                                        </a></li>
                                    <li class="clearfix">
                                        <a href="<?= base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$i * $desp + 1]['name'])) . "/" . $teams[$i * $desp + 1]['section']) . '/' . $campeonato ?>">
                                            <div style="float: left">
                                                <img
                                                    src="http://www.futbolecuador.com/<?php echo $teams[$i * $desp + 1]['thumb_shield']; ?>"
                                                    alt="<?php $teams[$i * $desp + 1]['thumb_shield']; ?>">
                                            </div>
                                            <div class="menu-name"><?php echo $nombreEquipo2 ?></div>
                                            <div
                                                class="menu-points text-right"><?php //echo $teams[$i * $desp + 1]['points']   . " pts" ?>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="clearfix">
                                        <a href="<?= base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$i * $desp + 2]['name'])) . "/" . $teams[$i * $desp + 2]['section']) . '/' . $campeonato ?>">
                                            <div style="float: left">
                                                <img
                                                    src="http://www.futbolecuador.com/<?php echo $teams[$i * $desp + 2]['thumb_shield']; ?>"
                                                    alt="<?php $teams[$i * $desp + 2]['thumb_shield']; ?>">
                                            </div>
                                            <div class="menu-name"><?php echo $nombreEquipo3 ?></div>
                                            <div
                                                class="menu-points text-right"><?php //echo $teams[$i * $desp + 2]['points']  . " pts"?>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- end row -->
                </li>
                <!-- end grid demo -->
            </ul>
            <!-- end drop down menu -->
        </li>
        <!-- end list elements -->
        <!-- Mega Menu -->

        <!-- mega menu -->
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('zona-fe') ?>" class="pull-left">Zona FE</a>
            <!-- dropdown-menu -->
        </li>
        <!-- mega menu -->
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('en-el-exterior') ?>" class="pull-left">En el Exterior</a>
        </li>
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw hidden">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Copas<b class="caret"></b></a>
            <ul class="dropdown-menu fullwidth">
                <li class="fhmm-content">
                    <div class="row">
                        <div class="col-sm-3  ">
                        </div>
                        <!-- end col-4 -->
                        <div class="col-sm-3 text-center separador-dotted">
                            <a href="<?= base_url('copa-america') ?>" class="pull-left">
                                <img src="<?= base_url('assets/img/copa-america-2015.png') ?>" alt="Copa America"
                                     title="Lea todo sobre la Copa America">
                            </a>
                        </div>
                        <div class="col-sm-3  text-center separador-dotted">
                            <a href="<?= base_url('copa-libertadores') ?>" class="pull-left">
                                <img src="<?= base_url('assets/img/copa-libertadores.png') ?>" alt="Copa Libertadores"
                                     title="Lea todo la Copa Libertadores">
                            </a>

                        </div>
                        <!-- end col-4 -->
                        <div class="col-sm-3 text-center">
                            <a href="<?= base_url('copa-sudamericana') ?>" class="pull-left">
                                <img src="<?= base_url('assets/img/copa-sudamericana.png') ?>" alt="Copa Sudamericana"
                                     title="Lea todo sobre la Copa Sudamericana">
                            </a>
                        </div>
                        <!-- end col-4 -->
                    </div>
                    <!-- end row -->
                </li>
                <!-- fhmm-content -->
            </ul>
            <!-- dropdown-menu -->
        </li>
        <!-- mega menu -->
        <!-- list elements -->
        <!-- Mega Menu -->

        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('don-balon') ?>" class="pull-left">
                <div class="logodonbalon"></div>
            </a>
            <!-- dropdown-menu -->
        </li>
        <!-- mega menu -->
        <!-- Mega Menu -->

        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('fuera-de-juego') ?>" class="pull-left">Fuera de Juego</a>
        </li>
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('fe-magazine') ?>" class="pull-left">
                <div class="logomagazina"></div>
            </a>
        </li>
    </ul>
    <!-- end nav navbar-nav -->
</div>
<!-- end #navbar-collapse-1 -->
