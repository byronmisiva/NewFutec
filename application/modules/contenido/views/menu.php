<div class="navbar-header">
    <a href="#" class=""><img src="assets/img/logotipo.png" alt="" class=" media-object">
    </a>
</div>
<!-- end navbar-header -->
<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
        <!-- list elements -->
        <li class="dropdown fhmm-fw"><a href="#" data-toggle="dropdown"
                                        class="dropdown-toggle">Equipos<b
                    class="caret"></b></a>
            <ul class="dropdown-menu fullwidth">
                <li class="fhmm-content withoutdesc">
                    <div class="row">
                        <?php for ($i = 0; $i<4;$i++){
                            $desp = 3;
                            $separador = ($i < 3) ? 'separador-dotted' : '';
                            $nombreEquipo1 = $teams[$i*$desp]['name'];
                            $nombreEquipo2 = $teams[$i*$desp + 1]['name'];
                            $nombreEquipo3 = $teams[$i*$desp + 2]['name'];

                            //caso nombre muy largo en menu
                            $nombreEquipo1 = ($nombreEquipo1 == "Universidad Católica de Quito") ? 'U. Católica de Quito' : $nombreEquipo1;
                            $nombreEquipo2 = ($nombreEquipo2 == "Universidad Católica de Quito") ? 'U. Católica de Quito' : $nombreEquipo2;
                            $nombreEquipo3 = ($nombreEquipo3 == "Universidad Católica de Quito") ? 'U. Católica de Quito' : $nombreEquipo3;

                            ?>
                            <div class="col-sm-3 <?php echo $separador ?>">
                                <ul class="menu-option">
                                    <li class="clearfix">
                                        <a href="#">
                                            <div class="equipos sprite-<?php echo strtolower ($this->contenido->_clearStringGion ($teams[$i*$desp]['name'] )) ?>-icon  "></div>
                                            <div class="menu-name"><?php echo  $nombreEquipo1?></div>
                                            <div class="menu-points text-right"><?php echo $teams[$i*$desp]['points']?> pts</div>
                                        </a></li>
                                    <li class="clearfix">
                                        <a href="#">
                                            <div class="equipos sprite-<?php echo strtolower ($this->contenido->_clearStringGion ($teams[$i*$desp + 1]['name'] )) ?>-icon  "></div>
                                            <div class="menu-name"><?php echo $nombreEquipo2?></div>
                                            <div class="menu-points text-right"><?php echo $teams[$i*$desp + 1]['points']?> pts</div>
                                        </a>
                                    </li>
                                    <li class="clearfix">
                                        <a href="#">
                                            <div class="equipos sprite-<?php echo strtolower ($this->contenido->_clearStringGion ($teams[$i*$desp + 2]['name'] )) ?>-icon  "></div>
                                            <div class="menu-name"><?php echo $nombreEquipo3?></div>
                                            <div class="menu-points text-right"><?php echo $teams[$i*$desp + 2]['points']?> pts</div>
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
        <li class="dropdown fhmm-fw">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Futbol Nacional<b
                    class="caret"></b></a>
            <ul class="dropdown-menu fullwidth">
                <li class="fhmm-content">
                    <div class="row">
                        <div class="col-sm-4 separador-dotted">
                            <h3 class="title">Serie A</h3>
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="assets/dummys/noticiaMenu.jpg" alt=""
                                             class="img-thumbnail media-object"
                                             width="61">
                                    </a>

                                    <div class="media-body">
                                        <h4>Deportivo Aucas</h4>

                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit
                                            amet, consectetur, adipisci velit</p>

                                        <p class="pull-right link-menu">Ver noticia</p>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <!-- end col-4 -->
                        <div class="col-sm-4 separador-dotted">
                            <h3 class="title">Serie B</h3>
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="assets/dummys/noticiaMenu.jpg" alt=""
                                             class="img-thumbnail media-object"
                                             width="61">
                                    </a>

                                    <div class="media-body">
                                        <h4>Deportivo Aucas</h4>

                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit
                                            amet, consectetur, adipisci velit</p>

                                        <p class="pull-right link-menu">Ver noticia</p>

                                    </div>
                                </li>

                            </ul>
                        </div>
                        <!-- end col-4 -->
                        <div class="col-sm-4">
                            <h3 class="title">Selección</h3>
                            <ul class="media-list">
                                <li class="media">
                                    <a href="#" class="pull-left">
                                        <img src="assets/dummys/noticiaMenu.jpg" alt=""
                                             class="img-thumbnail media-object"
                                             width="61">
                                    </a>

                                    <div class="media-body">
                                        <h4>Deportivo Aucas</h4>

                                        <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit
                                            amet, consectetur, adipisci velit</p>

                                        <p class="pull-right link-menu">Ver noticia</p>
                                    </div>
                                </li>
                            </ul>
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
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Futbol Internacional</a>
            <!-- dropdown-menu -->
        </li>
        <!-- mega menu -->
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Nuestros embajadores</a>
        </li>
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Copas<b class="caret"></b></a>
            <ul class="dropdown-menu fullwidth">
                <li class="fhmm-content">
                    <div class="row">
                        <div class="col-sm-1  ">
                        </div>
                        <div class="col-sm-3  text-center separador-dotted">
                            <img src="assets/img/copa-libertadores.png">
                        </div>
                        <!-- end col-4 -->
                        <div class="col-sm-3 text-center separador-dotted">
                            <img src="assets/img/copa-sudamericana.png">
                        </div>
                        <!-- end col-4 -->
                        <div class="col-sm-3 text-center">
                            <img src="assets/img/copa-america-2015.png">
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
        <li class="dropdown fhmm-fw">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Zona FE</a>
            <!-- dropdown-menu -->
        </li>
        <!-- mega menu -->
        <!-- Mega Menu -->
        <li class="dropdown fhmm-fw">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">FE Magazine</a>
        </li>
    </ul>
    <!-- end nav navbar-nav -->
</div>
<!-- end #navbar-collapse-1 -->