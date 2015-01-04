<?php
$this->load->view('header');
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="page-header top1 ">
    <div class="container">
        <div class="row clearfix separador10 separador10bot">
            <?php echo $top1; ?>
        </div>
    </div>
</div>

<div class=" visible-xs-block">
    <nav class="navbar navbar-futec navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <div class="col-xs-10 margen0">
                    <a href="<?php echo base_url() ?>" class="navbar-brand"><img
                            src="<?= base_url('assets/img/logotipo.png') ?>"
                            alt="FutbolEcuador" class=" media-object img-responsive">
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
                    <li class="active"><a href="#">Home<span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Posiciones
                            <span class="caret  link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Resultados
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Calendario
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>

                        </ul>
                    </li>
                    <li><a href="#">Futbol Nacional</a></li>
                    <li><a href="#">Futbol Internacional</a></li>
                    <li><a href="#">Nuestros embajadores</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Copas
                            <span class="caret link-menu"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>

                        </ul>
                    </li>
                    <li><a href="#">Zona FE</a></li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</div>

<div class="page-header header1 hidden-xs">
    <div class="container">
        <div class="row clearfix">
            <nav class="navbar  fhmm  menutype" role="navigation">
                <?php echo $header1; ?>
            </nav>
        </div>
    </div>
</div>


<div class="container">
    <!-- Example row of columns -->
    <?php if (isset($header2)) { ?>
        <div class="row separador20respon">
            <?php echo $header2; ?>
        </div>
    <?php } ?>
    <?php if (isset($top2)) { ?>
        <div class="row separador10">
            <div class="col-md-12 margen0">
                <?php echo $top2; ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-8">
            <div class="row margen0 content">
                <?php
                echo $content;
                ?>
            </div>
        </div>
        <div class="col-md-4 sidebar hidden-xs">
            <?php
            echo $sidebar;
            ?>
        </div>
    </div>
</div>


<!-- footer -->
<div class="top1">
    <div class="container">
        <?php
        echo $footer;
        echo $bottom;
        ?>
    </div>
</div>
<?php
$this->load->view('footer');
?>
<!-- /container -->

