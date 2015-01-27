<div class="navbar-header hidden-xs">
    <a href="<?php echo base_url() ?>" class=""><img src="<?= base_url('assets/img/logotipo.png') ?>"
                                                     alt="FutbolEcuador" class=" media-object">
    </a>
</div>
<!-- end navbar-header -->
<div class="navbar-collapse collapse hidden-xs">
<ul class="nav navbar-nav">
<!-- list elements -->
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
                                <a href="<?= base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$i * $desp]['name'])) . "/" . $teams[$i * $desp]['section']) ?>">
                                    <div
                                        class="equipos sprite-<?php echo strtolower($this->contenido->_clearStringGion($teams[$i * $desp]['name'])) ?>-icon  "></div>
                                    <div class="menu-name"><?php echo $nombreEquipo1 ?></div>
                                    <div
                                        class="menu-points text-right"><?php echo $teams[$i * $desp]['points'] ?>
                                        pts
                                    </div>
                                </a></li>
                            <li class="clearfix">
                                <a href="<?= base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$i * $desp + 1]['name'])) . "/" . $teams[$i * $desp + 1]['section']) ?>">
                                    <div
                                        class="equipos sprite-<?php echo strtolower($this->contenido->_clearStringGion($teams[$i * $desp + 1]['name'])) ?>-icon  "></div>
                                    <div class="menu-name"><?php echo $nombreEquipo2 ?></div>
                                    <div
                                        class="menu-points text-right"><?php echo $teams[$i * $desp + 1]['points'] ?>
                                        pts
                                    </div>
                                </a>
                            </li>
                            <li class="clearfix">
                                <a href="<?= base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$i * $desp + 2]['name'])) . "/" . $teams[$i * $desp + 2]['section']) ?>">
                                    <div
                                        class="equipos sprite-<?php echo strtolower($this->contenido->_clearStringGion($teams[$i * $desp + 2]['name'])) ?>-icon  "></div>
                                    <div class="menu-name"><?php echo $nombreEquipo3 ?></div>
                                    <div
                                        class="menu-points text-right"><?php echo $teams[$i * $desp + 2]['points'] ?>
                                        pts
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
<li class="dropdown fhmm-fw">
    <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($seriea[0]->title) . '/' . $seriea[0]->id) ?>" data-toggle="dropdown" class="dropdown-toggle">Fútbol Nacional<b
            class="caret"></b></a>
    <ul class="dropdown-menu fullwidth">
        <li class="fhmm-content">
            <div class="row">
                <div class="col-sm-4 separador-dotted">
                    <a href="<?= base_url('site/seriea') ?>">
                        <h3 class="title">Serie A</h3>
                    </a>
                    <ul class="media-list">
                        <li class="media">
                            <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($seriea[0]->title) . '/' . $seriea[0]->id) ?>"
                               class="pull-left">
                                <img src="<?= 'http://www.futbolecuador.com/' . $seriea[0]->thumb3 ?>"
                                     alt="Noticia Serie A"
                                     class="img-thumbnail media-object"
                                     width="61">
                            </a>

                            <div class="media-body">
                                <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($seriea[0]->title) . '/' . $seriea[0]->id) ?>"
                                   class="pull-left">
                                    <h4><?= $seriea[0]->title ?></h4>
                                    <p><?= $seriea[0]->subtitle ?></p>
                                </a>
                                <a href="<?= base_url('site/seriea') ?>">
                                    <p class="pull-right link-menu">Ver sección</p>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- end col-4 -->
                <div class="col-sm-4 separador-dotted">
                    <a href="<?= base_url('site/serieb') ?>">
                        <h3 class="title">Serie B</h3>
                    </a>
                    <ul class="media-list">
                        <li class="media">
                            <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($serieb[0]->title) . '/' . $serieb[0]->id) ?>"
                               class="pull-left">

                                <img src="<?= 'http://www.futbolecuador.com/' . $serieb[0]->thumb3 ?>"
                                     alt="Noticia Serie B"
                                     class="img-thumbnail media-object"
                                     width="61">
                            </a>

                            <div class="media-body">
                                <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($serieb[0]->title) . '/' . $serieb[0]->id) ?>"
                                   class="pull-left">
                                    <h4><?= $serieb[0]->title ?></h4>

                                    <p><?= $serieb[0]->subtitle ?></p>

                                </a>
                                <a href="<?= base_url('site/serieb') ?>">
                                    <p class="pull-right link-menu">Ver sección</p>
                                </a>
                            </div>
                        </li>

                    </ul>

                </div>
                <!-- end col-4 -->
                <div class="col-sm-4">
                    <a href="<?= base_url('site/seleccion') ?>">
                        <h3 class="title">Selección</h3>
                    </a>
                    <ul class="media-list">
                        <li class="media">
                            <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($seleccion[0]->title) . '/' . $seleccion[0]->id) ?>"
                               class="pull-left">

                                <img src="<?= 'http://www.futbolecuador.com/' . $seleccion[0]->thumb3 ?>"
                                     alt="Noticias Seleccion"
                                     class="img-thumbnail media-object"
                                     width="61">
                            </a>

                            <div class="media-body">
                                <a href="<?= base_url('site/noticia/' . $this->contenido->_urlFriendly($seleccion[0]->title) . '/' . $seleccion[0]->id) ?>"
                                   class="pull-left">
                                    <h4><?= $seleccion[0]->title ?></h4>
                                    <p><?= $seleccion[0]->subtitle ?></p>
                                </a>
                                <a href="<?= base_url('site/seleccion') ?>">
                                    <p class="pull-right link-menu">Ver sección</p>
                                </a>
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
    <a href="<?= base_url('zona-fe') ?>" class="pull-left">Zona FE</a>
    <!-- dropdown-menu -->
</li>
<!-- mega menu -->
<!-- Mega Menu -->
<li class="dropdown fhmm-fw">
    <a href="<?= base_url('en-el-exterior') ?>" class="pull-left">En el exterior</a>
</li>
<!-- Mega Menu -->
<li class="dropdown fhmm-fw">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Copas<b class="caret"></b></a>
    <ul class="dropdown-menu fullwidth">
        <li class="fhmm-content">
            <div class="row">
                <div class="col-sm-1  ">
                </div>
                <div class="col-sm-4  text-center separador-dotted">
                    <a href="<?= base_url('copa-libertadores') ?>" class="pull-left">
                        <img src="<?= base_url('assets/img/copa-libertadores.png') ?>" alt="Copa Libertadores">
                    </a>

                </div>
                <!-- end col-4 -->
                <div class="col-sm-4 text-center separador-dotted">
                    <a href="<?= base_url('copa-sudamericana') ?>" class="pull-left">
                        <img src="<?= base_url('assets/img/copa-sudamericana.png') ?>" alt="Copa Sudamericana">
                    </a>
                </div>
                <!-- end col-4 -->
                <div class="col-sm-3 text-center hidden">
                    <a href="<?= base_url('copa-america') ?>" class="pull-left">
                        <img src="<?= base_url('assets/img/copa-america-2015.png') ?>" alt="Copa America">
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
<li class="dropdown fhmm-fw">
    <a href="<?= base_url('futbol-internacional') ?>" class="pull-left">Fútbol Internacional</a>
    <!-- dropdown-menu -->
</li>
<!-- mega menu -->
<!-- Mega Menu -->
<li class="dropdown fhmm-fw">
    <a href="<?= base_url('fe-magazine') ?>" class="pull-left">FE Magazine</a>
</li>
<li class="dropdown fhmm-fw">
    <a href="<?= base_url('fuera-de-juego') ?>" class="pull-left">Fuera de Juego</a>
</li>
</ul>
<!-- end nav navbar-nav -->
</div>
<!-- end #navbar-collapse-1 -->
