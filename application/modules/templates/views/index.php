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
<div class="navbar navbar-inverse navbar-fixed-top hide" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>

        <!--/.navbar-collapse -->
    </div>
</div>

<div class="page-header header1 ">
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
    <div class="row separador20">
        <?php echo $header2;?>
    </div>

    <div class="row separador10">
        <div class="col-md-12 margen0">
            <?php echo $top2;?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="row margen0 content">
                <?php
                echo $content;
                ?>
            </div>
        </div>
        <div class="col-md-4 sidebar">
            <?php
            echo $sidebar;
            ?>
        </div>

    </div>
</div>



<!-- /container -->
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


<!-- /container --><!-- /container --><!-- /container --><!-- /container -->
<!-- /container --><!-- /container --><!-- /container --><!-- /container -->


<div class="container">








</div>
<!-- /container -->

