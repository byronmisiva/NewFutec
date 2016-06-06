<div class="navbar-header hidden-xs" style="padding-left: 60px;">
    <a href="<?php echo base_url('copa-america') ?>">
        <img src="<?= base_url('assets/img/logo-copa-america-mini-2016.png') ?>"
             alt="FutbolEcuador"
             width="220"
             title="Copa América Centeanario 2016 USA"
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
        <li class="dropdown fhmm-fw">
        	<a href="#" data-toggle="dropdown" class="dropdown-toggle">Equipos
        		<b class="caret"></b>
        	</a>
            <ul class="dropdown-menu fullwidth">
                <li class="fhmm-content withoutdesc">
                    <div class="row"> 
                        <?php
                        $pos = 0;
						if ($campeonato=="56")
						$campeonato = 63;
                        for ($i = 0; $i < 4; $i++) {
                        	$separador = ($i < 3) ? 'separador-dotted' : '';?>
                        	<div class="col-sm-3 <?php echo $separador ?>">
                        		<ul class="menu-option">
                        	<?php for ($x = 0; $x < 4; $x++) {
                        		if ($teams[$pos+$x]->section == NULL)
                        			$url =  base_url('copa_america');
                        			else{
									$url =	base_url('site/equipo/' . strtolower($this->contenido->_clearStringGion($teams[$pos+$x]->name)) . "/" . $teams[$pos+$x]->section) . '/' . $campeonato;
                        		}
                        		?>
								<li class="clearfix">
                                        <a href="<?php echo $url ?>">
                                            <div class="pull-left">
                                                <img src="http://www.futbolecuador.com/<?php echo $teams[$pos+$x]->thumb_shield; ?>"
                                                    alt="<?php $teams[$pos+$x]->name; ?>">
                                            </div>
                                            <div class="menu-name"><?php echo $teams[$pos+$x]->name ?></div>
                                            <div class="menu-points text-right">
                                            </div>
                                        </a>
                                 </li>
								<?php
								
							}	
							?>
								</ul>
							</div>
							<?php 
							$pos = $pos+4;
						}?>
                    </div>
                </li>
            </ul>
        </li>        
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('zona-fe') ?>" class="pull-left">Zona FE</a>
        </li>
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
                    </div>
                </li>
            </ul>
        </li>
        
        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('don-balon') ?>" class="pull-left">
                <div class="logodonbalon"></div>
            </a>
        </li>

        <li class="dropdown fhmm-fw">
            <a href="<?= base_url('fuera-de-juego') ?>" class="pull-left">Fuera de Juego</a>
        </li>
    </ul>
</div>
