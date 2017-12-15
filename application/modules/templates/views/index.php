<?php
 $data["verMobile"]=$verMobile;
$this->load->view('header', $data);
?>
<style>
.navbar-fixed-top .navbar-collapse, .navbar-fixed-bottom .navbar-collapse {
    max-height: 430px;
}
</style>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="page-header top1 hidden-xs arriba ">
        <div class="fondo-notificaciones" onclick="instalarExtension()">
            <div class="texto-notificacion">
                ¿La actualidad del fútbol en tiempo real? Acepta las notificaciones de Google Chrome 
		<img class="logochr" src="<?php echo base_url('imagenes/icono-notificaciones.png') ?>"/>
            </div>
        </div>
    <div class="container margen0">
        <div class="row clearfix separador10 separador10bot">
            <?php echo $top1; ?>
        </div>
    </div>
</div>

<div class=" visible-xs-block">
    <nav class="navbar navbar-futec navbar-fixed-top">
        <?php
        if (isset($fe_header)) echo $fe_header ?>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <div class="col-xs-10 margen0">
                    <a href="<?php echo base_url('site/movil/') ?>" class="navbar-brand"><img
                            src="<?php echo base_url('assets/img/logotipo.png') ?>"
                            alt="FutbolEcuador" title="Lo mejor del futbol ecuatoriano" class=" media-object img-responsive">
                    </a>
                </div>
                <div class="col-xs-2 margen0">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Navegacion</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>

                    </button>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
			<!--	<li>
				  <a href="<?php echo base_url('copa-america') ?>">
				        <img src="<?= base_url('assets/img/logo-copa-america-mini-2016.png') ?>"
				             alt="FutbolEcuador"
				             title="Copa América Centeanario 2016 USA"
				             class=" media-object" width="130px">
				    </a>
				</li>-->
					
					
                    <li><a class="clickmenu" href="<?php echo base_url('site/marcadorenvivo') ?>">Marcador en Vivo</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Posiciones
                            <span class="caret  link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
			  <li>
			   <a class="clickmenu" href="<?php echo base_url()?>site/tabladeposiciones/<?php echo SERIE_A; ?>/<?php echo SERIE_A_TIPOTABLA;?>"> Serie A 				   </a> 
			 </li>
	                 <li><a class="clickmenu" href="<?php echo base_url('site/tabladeposiciones/' . SERIE_B) ?>">Serie B</a></li>
			 <li><a class="clickmenu" href="<?php echo base_url()?>site/tabladeposiciones/<?php echo ELIMINATORIAS; ?>/<?php echo ELIMINATORIAS_TIPOTABLA;?>"> Eliminatorias </a> </li>
<!--                        <li><a class="clickmenu" href="<?php echo base_url('site/tabladeposiciones/' . AMERICA . "/simple") ?>">Copa América 2015</a></li>-->
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Calendario
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="clickmenu" href="<?= base_url() ?>site/resultados/<?php echo SERIE_A; ?>/campeonato-serie-a">Serie A</a></li>
                            <li><a class="clickmenu" href="<?= base_url() ?>site/resultados/<?php echo SERIE_B; ?>/campeonato-serie-b">Serie B</a></li>
			    <li><a class="clickmenu" href="<?= base_url() ?>site/resultados/<?php echo ELIMINATORIAS; ?>/eliminatorias-2018">Eliminatorias</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Fútbol Nacional
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="clickmenu" href="<?= base_url('site/seriea') ?>">Serie A</a></li>
                            <li><a class="clickmenu" href="<?= base_url('site/serieb') ?>">Serie B</a></li>
                            <li><a class="clickmenu" href="<?= base_url('site/seleccion') ?>">Selección</a></li>
                        </ul>
                    </li>
		<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Equipos
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="clickmenu" href="<?= base_url('site/equipo/barcelona-sporting-club/23') ?>">Barcelona S. C.</a></li>
                            <li><a class="clickmenu" href="<?= base_url('site/equipo/el-nacional/15') ?>">El Nacional</a></li>
                            <li><a class="clickmenu" href="<?= base_url('site/equipo/emelec/18') ?>">Emelec</a></li>
                            <li><a class="clickmenu" href="<?= base_url('site/equipo/liga-de-quito/14') ?>">Liga de Quito</a></li>
			   <li><a class="clickmenu" href="<?= base_url('site/equipo/independiente-del-valle/44') ?>">Independiente del Valle</a></li>
                        </ul>
                    </li>
                    <li><a class="clickmenu" href="<?= base_url('futbol-internacional') ?>">Fútbol Internacional</a></li>
                    <li><a class="clickmenu" href="<?= base_url('don-balon') ?>">Don Balon</a></li>
                    <li><a class="clickmenu" href="<?= base_url('site/lavoz') ?>">La Voz de las Tribunas</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Copas
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="clickmenu" href="<?= base_url('eliminatorias') ?>">Eliminatorias</a></li>
                            <li><a class="clickmenu" href="<?= base_url('copa-sudamericana') ?>">Copa Sudamericana</a></li>
                           <!-- <li><a class="clickmenu" href="<?= base_url('copa-america') ?>">Copa América Centenario</a></li>-->
                        </ul>
                    </li>
                    <li><a class="clickmenu" href="<?= base_url('site/zonafe') ?>">Zona FE</a></li>
                    <li><a class="clickmenu" href="<?= base_url('goleadores') ?>">Goleadores</a></li>
                     
                    <li><a class="clickmenu" href="<?= base_url('fuera-de-juego') ?>">Fuera de juego</a></li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>

<div class="page-header header1 ">
    <div class="container">
        <div class="row clearfix">
            <nav class="navbar  fhmm  menutype " role="navigation">
                <?php echo $header1; ?>
            </nav>
        </div>
    </div>
</div>

<?php
    echo $this->uri->segment(2);
   if ( $this->uri->segment(2) == "partido")
  {?>
        <div class="row separador10-xs margen0">
            <div class="col-md-12 margen0">
                <?php  
                    $this->load->module('banners');
                    echo $this->banners->FE_Megabanner();
                ?>
            </div>
        </div>
 <?php
   }   
  ?>


<div class="container blanco">
    <!-- Example row of columns -->
    <?php
    if (isset($cinta_banner)){?>
    	<div class="row separador10-xs margen0">
    		<div class="col-md-12 margen0">
    			<?php echo $cinta_banner;?>
    		</div>
    	</div>
    <?php }?>
    
    
    <?php if (isset($header2)) { ?>
        <div class="row separador10-xs">
            <?php echo $header2; ?>
        </div>
    <?php } ?>
    <?php if (isset($top2)) { ?>
        <div class="row separador10sec">
            <div class="col-md-12 margen0">
                <?php echo $top2; ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-8  col-sm-8 zonacontenido">
            <div class="row margen0  content ">
                <?php
                echo $content;
                ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 sidebar hidden-xs zonasidebar">
            <?php
            echo $sidebar;
            ?>
        </div>
    </div>
</div>
<!-- footer -->
<div class="top1 separador10sec">
    <div class="container">
        <?php
        echo $footer;
        echo $bottom;
        ?>
    </div>
</div>

<div class="flechaariba">
    <img src="<?= base_url('assets/img/boton-arriba.png') ?>" alt="boton arriba" title="Botón ir arriba">
</div>
<?php
$this->load->view('footerend',$data);
?>
<!-- /container -->
